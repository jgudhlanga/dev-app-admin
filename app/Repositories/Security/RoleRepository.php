<?php
namespace App\Repositories\Security;

use App\Contracts\RepositoryInterface;
use App\Models\Roles\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RepositoryInterface
{
	protected $role;
	
	public function __construct(Role $role)
	{
		$this->role = $role;
	}
	
	public function find($id)
	{
		return $this->role->where('id', $id)->first();
	}
	
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('roles AS r')
			->leftJoin('statuses AS s', 's.id', '=', 'r.status_id' )
			->select('r.*', 's.title as status')
			->where('r.id', '>', 0);
		
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$query->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$query->where(array_keys($args)[$i], '=', array_values($args)[$i]);
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
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		return $query->get();
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$roles = $this->role->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$roles->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$roles->where(array_keys($args)[$i], '=', array_values($args)[$i]);
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
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$roles->paginate($paginate);
		}
		
		return $roles->get();
	}
	
	public function delete($role)
	{
		return $role->delete();
	}
	
	public function getTableColumns()
	{
		return $this->role->getTableColumns();
	}
	
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
	
	public function syncPermissions(Role $role, $permissions=[])
	{
		if((!empty($permissions)) && (count($permissions) > 0))
			$role->permissions()->sync($permissions);
	}
	
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
	
	public function count($args = [])
	{
		$count = $this->role->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$count->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$count->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		return $count->count();
	}
}