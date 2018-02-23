<?php

namespace App\Services\Security;

use App\Repositories\Security\PermissionRepository;
use App\Models\Roles\Permission;

class PermissionService
{
	/**
	 * @var $permissionRepository
	 */
	protected $permissionRepository;
	
	public function __construct(PermissionRepository $permissionRepository)
	{
		$this->permissionRepository = $permissionRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->permissionRepository->find($id);
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
		return $this->permissionRepository->findAll($args, $paginate, $limit);
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
		return $this->permissionRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return Permission
	 */
	public function create($params)
	{
		return $this->permissionRepository->create($params);
	}
	
	/**
	 * @param $permission
	 * @param $data
	 * @return mixed
	 */
	public function update($permission, $data)
	{
		return $this->permissionRepository->update($permission, $data);
	}
	
	/**
	 * @param $permission
	 * @return mixed
	 */
	public function delete($permission)
	{
		return $this->permissionRepository->delete($permission);
	}
	
	
	/**
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		return $this->permissionRepository->count($args);
	}
}

