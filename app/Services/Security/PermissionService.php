<?php

namespace App\Services\Security;

use App\Repositories\Security\PermissionRepository;
use App\Models\Roles\Permission;

/**
 * Class PermissionService
 * @package App\Services\Security
 */
class PermissionService
{
	/**
	 * @var PermissionRepository
	 */
	protected $permissionRepository;
	
	/**
	 * PermissionService constructor.
	 * @param PermissionRepository $permissionRepository
	 */
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
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll($where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		return $this->permissionRepository->findAll($where, $paginate, $limit);
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
		return $this->permissionRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
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
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->permissionRepository->count($where);
	}
}

