<?php
namespace App\Repositories\Security;

use App\Contracts\RepositoryInterface;
use App\Models\Roles\Permission;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionRepository
 * @package App\Repositories\Security
 */
class PermissionRepository implements RepositoryInterface
{
	/**
	 * @var Permission
	 */
	protected $permission;
	
	/**
	 * PermissionRepository constructor.
	 * @param Permission $permission
	 */
	public function __construct(Permission $permission)
	{
		$this->permission = $permission;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->permission->where('id', $id)->first();
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
		
		$query = DB::table('permissions AS p')->leftJoin('statuses AS s', 's.id', '=', 'p.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "p.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('p.*', 's.title as status');
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
			$query->orderBy('id', 'asc')->take($limit);
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
		$permissions = $this->permission->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$permissions->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$permissions->where(array_keys($where)[$i], '=', array_values($where)[$i]);
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
		
		if (!is_null($paginate)) {
			$permissions->paginate($paginate);
		}
		
		return $permissions->get();
	}
	
	/**
	 * @param $permission
	 * @return mixed
	 */
	public function delete($permission)
	{
		return $permission->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->permission->getTableColumns();
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		$columns = $this->getTableColumns();
		$data = [];
		foreach ( $columns as $column ) {
			if($column == 'id' || $column == 'created_at'|| $column == 'updated_at' || $column == 'status_id' ) {
				continue;
			}
			if(in_array($column, ['display_name', 'description'])) {
				$data[$column] = (isset($params[$column]) && $params[$column] != '') ? ucwords(strtolower($params[$column])) : NULL;
			}
			else {
				$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
			}
		}
		$created = Permission::create($data);
		return $created;
	}
	
	/**
	 * @param $permission
	 * @param $data
	 * @return mixed
	 */
	public function update($permission, $data)
	{
		$permission->update($data);
		return $permission;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->permission->where('id', '>', 0);
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