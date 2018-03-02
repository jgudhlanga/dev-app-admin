<?php

namespace App\Repositories\Modules;

use App\Contracts\RepositoryInterface;
use App\Models\Modules\Module;
use Illuminate\Support\Facades\DB;

/**
 * Class ModuleRepository
 * @package App\Repositories\Modules
 */
class ModuleRepository implements RepositoryInterface
{
	
	/**
	 * @var Module
	 */
	protected $module;
	
	/**
	 * ModuleRepository constructor.
	 * @param Module $module
	 */
	public function __construct(Module $module)
    {
        $this->module = $module;
    }
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
    {
       return $this->module->where('id', $id)->first();
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
    	
	    $query = DB::table('modules AS m')->leftJoin('statuses AS s', 's.id', '=', 'm.status_id');
	    if (!empty($columns)) {
		    $cols = "";
		    foreach ($columns as $column) {
			    $cols .= "m.{$column},";
		    }
		    $query->select(rtrim(',', $cols), 's.title as status');
	    } else {
		    $query->select('m.*', 's.title as status');
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
		    $query->orderBy('position', 'asc')->take($limit);
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
		$modules = $this->module->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$modules->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$modules->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$modules->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$modules->orderBy('position', 'asc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$modules->paginate($paginate);
		}
		
		return $modules->get();
	}
	
	/**
	 * @param $module
	 * @return mixed
	 */
	public function delete($module)
    {
	    return $module->delete();
    }
	
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->module->getTableColumns();
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
			$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
		}
		$created = Module::create($data);
		return $created;
	}
	
	/**
	 * @param $module
	 * @param $data
	 * @return mixed
	 */
	public function update($module, $data)
	{
		$module->update($data);
		return $module;
	}
	
	/**
	 * @param $module
	 * @return mixed
	 */
	public function positionModule($module)
	{
		$maxPos = $module->max('position');
		$module->update(['position' => $maxPos + 1]);
		return $module;
	}
	
	/**
	 * @param $module
	 * @param string $direction
	 * @return mixed
	 */
	public function orderModules($module, $direction = "up")
	{
		//refresh the order to avoid gaps
		$modules = $this->findAll(null, null, null, ['position' => 'asc']);
		$count = 0;
		foreach ($modules as $row)
		{
			$count++;
			$row->update(['position' => $count]);
		}
		
		
		if(isset($module->position) && $module->position > 0)
		{
			$modulePosition = $module->position;
			
			//get the next module and position
			$position = (strtolower($direction) == "up") ? ($module->position - 1) : ($module->position + 1);
			$currentModule = $this->module->where('position', $position)->first();
			
			if(isset($currentModule->position) && $currentModule->position > 0)
			{
				//swap the modules
				$module->update(['position' => $currentModule->position]);
				$currentModule->update(['position' => $modulePosition]);
			}
		}
		
		return $this->find($module->id);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->module->where('id', '>', 0);
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