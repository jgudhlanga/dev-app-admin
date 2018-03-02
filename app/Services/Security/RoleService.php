<?php

namespace App\Services\Security;

use App\Repositories\Security\RoleRepository;
use App\Models\Roles\Role;

/**
 * Class RoleService
 * @package App\Services\Security
 */
class RoleService
{
	/**
	 * @var RoleRepository
	 */
	protected $roleRepository;
	
	/**
	 * RoleService constructor.
	 * @param RoleRepository $roleRepository
	 */
	public function __construct(RoleRepository $roleRepository)
	{
		$this->roleRepository = $roleRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->roleRepository->find($id);
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
		return $this->roleRepository->findAll($where, $paginate, $limit);
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
		return $this->roleRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->roleRepository->create($params);
	}
	
	/**
	 * @param $role
	 * @param $data
	 * @return mixed
	 */
	public function update($role, $data)
	{
		return $this->roleRepository->update($role, $data);
	}
	
	/**
	 * @param $role
	 * @return mixed
	 */
	public function delete($role)
	{
		return $this->roleRepository->delete($role);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->roleRepository->count($where);
	}
}

