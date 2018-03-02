<?php

namespace App\Services\Modules;

use App\Repositories\Modules\ModuleRepository;
use App\Models\Modules\Module;

/**
 * Class ModuleService
 * @package App\Services\Modules
 */
class ModuleService
{
	/**
	 * @var ModuleRepository
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
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll($where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		return $this->moduleRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns=[], $where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		return $this->moduleRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
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
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->moduleRepository->count($where);
	}
}

