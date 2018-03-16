<?php

namespace App\Repositories\Users;

use App\Contracts\RepositoryInterface;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;

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
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		$columns = $this->getTableColumns();
		$skip = ['id', 'created_at', 'updated_at', 'status_id', 'roles'];
		$data = [];
		foreach ( $columns as $column ) {
			if(in_array($column, $skip)) {
				continue;
			}
			$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
		}
		
		$user = User::create($data);
		if(isset($params['roles']))
			$this->syncRoles($user, $params['roles']);
		return $user;
	}
	
	/**
	 * @param User $user
	 * @param array $roles
	 */
	public function syncRoles(User $user, $roles=[])
	{
		if((!empty($roles)) && (count($roles) > 0))
			$user->roles()->sync($roles);
	}
	
	/**
	 * @param $user
	 * @param $data
	 * @return mixed
	 */
	public function update($user, $data)
	{
		$roles = [];
		if(isset($data['roles']))
		{
			$roles = $data['roles'];
			unset($data['roles']);
		}
		$user->update($data);
		$this->syncRoles($user, $roles);
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
}