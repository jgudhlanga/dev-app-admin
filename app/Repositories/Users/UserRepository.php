<?php

namespace App\Repositories\Users;

use App\Contracts\RepositoryInterface;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 * @package App\Repositories\Users
 */
class UserRepository implements RepositoryInterface
{
	
	/**
	 * @var User
	 */
	protected $user;
	
	/**
	 * UserRepository constructor.
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->user->where('id', $id)->first();
	}
	
	/**
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns=[], $where=[], $paginate=null, $limit=null, $orderBy=null )
	{
		
		$query = DB::table('users AS u')
			->leftJoin('statuses AS s', 's.id', '=', 'u.status_id')
			->leftJoin('genders AS g', 'g.id', '=', 'u.gender_id')
			->leftJoin('titles AS t', 't.id', '=', 'u.title_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "u.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status', 'g.name as gender', 't.name as title');
		} else {
			$query->select('u.*', 's.title as status', 'g.name as gender', 't.name as title');
		}
		
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$query->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$query->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$query->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$query->orderBy('created_at', 'asc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		return $query->get();
	}
	
	/**
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll( $where=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$users = $this->user->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$users->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$users->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$users->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$users->orderBy('first_name', 'asc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$users->paginate($paginate);
		}
		
		return $users->get();
	}
	
	/**
	 * @param $user
	 * @return mixed
	 */
	public function delete($user)
	{
		return $user->delete();
	}
	
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->user->getTableColumns();
	}
	
	/**
	 * @param $request
	 * @return mixed
	 */
	public function create($request)
	{
		$columns = $this->getTableColumns();
		$skip = ['id', 'created_at', 'updated_at', 'status_id', 'roles'];
		$params = $request->all();
		$data = [];
		$data['created_by'] = Auth::id();
		foreach ( $params as $key => $value ) {
			if(in_array($key, $skip)) continue;
			if(!in_array($key, $columns)) continue;
			$data[$key] = ($value != '') ? $value : NULL;
		}
		
		if(isset($data['password'])) {
			$data['password'] = bcrypt($data['password']);
		}
		$user = User::create($data);
		if(isset($params['roles']))
			$user = $this->syncRoles($user, $params['roles']);
			
		return $user;
	}
	
	
	/**
	 * @param User $user
	 * @param array $roles
	 * @return User
	 */
	public function syncRoles(User $user, $roles=[])
	{
		if((!empty($roles)) && (count($roles) > 0))
			$user->roles()->sync($roles);
		return $user;
	}
	
	/**
	 * @param $user
	 * @param $request
	 * @return mixed
	 */
	public function update($user, $request)
	{
		$params = $request->all();
		$data = [];
		$columns = $this->getTableColumns();
		$skip = ['roles', 'edit_id'];
		foreach ( $params as $key => $value ) {
			if((in_array($key, $skip)) || (!in_array($key, $columns))) {
				continue;
			}
			$data[$key] = ($value != '') ? $value : NULL;
		}
		
		$user->update($data);
		if(isset($params['roles']))
			$user = $this->syncRoles($user, $params['roles']);
		return $user;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->user->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])) {
					$count->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else {
					$count->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		return $count->count();
	}
	
	/**
	 * @param $request
	 * @param $user
	 * @return mixed
	 */
	public function uploadProfilePicture($user, $request)
	{
		if ($request->hasFile('profile_picture')) {
			$file = $request->file('profile_picture');
			$ext = $file->getClientOriginalExtension();
			$fileName = $user->email . '_' . time() . '.' . $ext;
			$file->storeAs(
				config('system.uploads.users') . $user->id, $fileName
			);
			$user->update(['profile_picture' => $fileName]);
		}
		return $user;
	}
	
	/**
	 * @param $user
	 * @return string
	 */
	public function getUserProfilePicture($user =  null)
	{
		if(!$user) {
			return null;
		}
		/* Profile picture */
		$profileImage = "unknown.png";
		if(File::exists(storage_path(config('system.storage_path.users').$user->id.'/'.$user->profile_picture))) {
			$profileImage = $user->id.'/'.$user->profile_picture;
		}
		return $profileImage;
	}
}