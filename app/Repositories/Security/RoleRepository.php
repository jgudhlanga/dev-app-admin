<?php
namespace App\Repositories\Security;

use App\Contracts\RepositoryInterface;
use App\Models\Roles\Role;
use Illuminate\Support\Facades\DB;

/**
 * Class RoleRepository
 * @package App\Repositories\Security
 */
class RoleRepository implements RepositoryInterface
{
	/**
	 * @var Role
	 */
	protected $role;
	
	/**
	 * RoleRepository constructor.
	 * @param Role $role
	 */
	public function __construct(Role $role)
	{
		$this->role = $role;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->role->where('id', $id)->first();
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
		
		$query = DB::table('roles AS r')->leftJoin('statuses AS s', 's.id', '=', 'r.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "r.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('r.*', 's.title as status');
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
			$query->orderBy('display_name', 'asc')->take($limit);
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
		$roles = $this->role->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$roles->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$roles->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$roles->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$roles->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$roles->paginate($paginate);
		}
		
		return $roles->get();
	}
	
	/**
	 * @param $role
	 * @return mixed
	 */
	public function delete($role)
	{
		return $role->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->role->getTableColumns();
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		$columns = $this->getTableColumns();
		$skip = ['id', 'created_at', 'updated_at', 'status_id', 'permissions'];
		$data = [];
		foreach ( $columns as $column ) {
			if(in_array($column, $skip)) {
				continue;
			}
			$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
		}
		
		$role = Role::create($data);
		if(isset($params['permissions']))
			$this->syncPermissions($role, $params['permissions']);
		return $role;
	}
	
	/**
	 * @param Role $role
	 * @param array $permissions
	 */
	public function syncPermissions(Role $role, $permissions=[])
	{
		if((!empty($permissions)) && (count($permissions) > 0))
			$role->permissions()->sync($permissions);
	}
	
	/**
	 * @param $role
	 * @param $data
	 * @return mixed
	 */
	public function update($role, $data)
	{
		$permissions = [];
		if(isset($data['permissions']))
		{
			$permissions = $data['permissions'];
			unset($data['permissions']);
		}
		$role->update($data);
		$this->syncPermissions($role, $permissions);
		return $role;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->role->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$count->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$count->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		return $count->count();
	}
}