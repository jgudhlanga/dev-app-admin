<?php

namespace App\Services\Modules;

use App\Repositories\Modules\ModuleRepository;
use App\Models\Modules\Module;

class ModuleService
{
	/**
	 * @var $moduleRepository
	 */
	protected $moduleRepository;
	
	/**
	 * ModuleService constructor.
	 * @param ModuleRepository $modulesRepository
	 */
	public function __construct(ModuleRepository $modulesRepository)
	{
		$this->moduleRepository = $modulesRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
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
	public function findAll($args = [], $paginate = null, $limit = null, $orderBy = null)
	{
		return $this->moduleRepository->findAll($args, $paginate, $limit);
	}
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($args = [], $paginate = null, $limit = null, $orderBy = null)
	{
		return $this->moduleRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return Module
	 */
	public function create($params)
	{
		$module = $this->moduleRepository->create($params);
		return $this->positionModule($module);
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
	 * @param $module
	 * @return mixed
	 */
	public function delete($module)
	{
		return $this->moduleRepository->delete($module);
	}
	
	
	/**
	 * @param $module
	 * @return mixed
	 */
	public function positionModule($module)
	{
		return $this->moduleRepository->positionModule($module);
	}
	
	
	/**
	 * @param $module
	 * @param $direction
	 * @return mixed
	 */
	public function orderModules($module, $direction)
	{
		return $this->moduleRepository->orderModules($module, $direction);
	}
}

