<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/12/17
 * Time: 05:49 PM
 */

namespace App\Repositories\Modules;

use App\Contracts\RepositoryInterface;
use App\Models\Modules\Module;
use Illuminate\Support\Facades\DB;

class ModulesRepository implements RepositoryInterface
{
    /**
     * @var $module
     */
    protected $module;
    
    /**
     * ModulesRepository constructor.
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
	 * @param array $args
	 * @param null $paginate
	 * @param bool $single
	 * @return Module
	 */
    public function findBy($args=[], $paginate=null, $single=false )
    {
        return $this->module;
    }
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
    public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
    {
	    $query =  DB::table('modules AS m')
		    ->leftJoin('statuses AS s', 's.id', '=', 'm.status_id' )
		    ->leftJoin('icons AS i', 'i.id', '=', 'm.icon' )
		    ->select('m.*', 's.title as status', 'i.class as class')
		    ->where('m.id', '>', 0);
	
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
		    $query->orderBy('position', 'asc')->take($limit);
	    }
	
	    // Paginate if we need to
	    if (!is_null($paginate)) {
		    $query->paginate($paginate);
	    }
	    return $query->get();
    }
	
	/**
	 * @param $id
	 * @return mixed
	 */
    public function delete($id)
    {
	    $module = $this->find($id);
	    return $module->delete();
    }
	
	/**
	 * @param $id
	 * @param $status
	 * @return mixed
	 */
    public function changeStatus($id, $status)
    {
	    $module = $this->find($id);
	    $module->update(['status_id' => $status]);
	    return $module;
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
		$module = $this->find($module);
		$module->update($data);
		return $module;
	}
	/**
	 * @param $module
	 * @return mixed
	 */
	public function positionModule($module)
	{
		$module = $this->find($module);
		$maxPos = DB::table('modules')->max('position');
		$module->update(['position' => $maxPos + 1]);
		return $module;
	}
}