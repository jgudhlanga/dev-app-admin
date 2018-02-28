<?php
namespace App\Repositories\Security;

use App\Contracts\RepositoryInterface;
use App\Models\Roles\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements RepositoryInterface
{
	protected $permission;
	
	public function __construct(Permission $permission)
	{
		$this->permission = $permission;
	}
	
	public function find($id)
	{
		return $this->permission->where('id', $id)->first();
	}
	
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('permissions AS p')
			->leftJoin('statuses AS s', 's.id', '=', 'p.status_id' )
			->select('p.*', 's.title as status')
			->where('p.id', '>', 0);
		
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
		$permissions = $this->permission->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$permissions->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$permissions->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$permissions->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$permissions->orderBy('created_at', 'desc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$permissions->paginate($paginate);
		}
		
		return $permissions->get();
	}
	
	public function delete($permission)
	{
		return $permission->delete();
	}
	
	public function getTableColumns()
	{
		return $this->permission->getTableColumns();
	}
	
	public function create($params)
	{
		$columns = $this->getTableColumns();
		$data = [];
		foreach ( $columns as $column ) {
			if($column == 'id' || $column == 'created_at'|| $column == 'updated_at' || $column == 'status_id' ) {
				continue;
			}
			$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
		}
		$created = Permission::create($data);
		return $created;
	}
	
	public function update($permission, $data)
	{
		$permission->update($data);
		return $permission;
	}
	
	public function count($args = [])
	{
		$count = $this->permission->where('id', '>', 0);
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