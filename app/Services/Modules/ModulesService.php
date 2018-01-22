<?php

namespace App\Services\Modules;

use App\Repositories\Modules\ModulesRepository;
use App\Models\Modules\Module;

class ModulesService
{
    /**
     * @var $moduleRepository
     */
    protected $moduleRepository;
    
    /**
     * ModulesService constructor.
     * @param ModulesRepository $modulesRepository
     */
    public function __construct(ModulesRepository $modulesRepository)
    {
        $this->moduleRepository = $modulesRepository;
    }
    
    /**
     * @param $id
     * @return mixed
     */
    public function find( $id )
    {
        return $this->moduleRepository->find($id);
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
        return $this->moduleRepository->findAll($args, $paginate, $limit);
    }
    
   
    /**
     * @param $params
     * @return Module
     */
    public function create($params)
    {
        $module =  $this->moduleRepository->create($params);
        return $this->positionModule($module->id);
    }
	
	/**
	 * @param $module
	 * @param $data
	 * @return mixed
	 */
	public function update($module, $data)
	{
		return $this->moduleRepository->update($module, $data);
	}
 
	/**
	 * @param $id
	 * @return mixed
	 */
    public function delete($id)
    {
    	return $this->moduleRepository->delete($id);
    }
	
	/**
	 * @param $id
	 * @param $status
	 * @return mixed
	 */
    public function changeStatus($id, $status)
    {
    	return $this->moduleRepository->changeStatus($id, $status);
    }
	
	/**
	 * @param $module
	 * @return mixed
	 */
    public function positionModule($module)
    {
    	return $this->moduleRepository->positionModule($module);
    }
}

