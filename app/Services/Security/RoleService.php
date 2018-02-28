<?php

namespace App\Services\Security;

use App\Repositories\Security\RoleRepository;
use App\Models\Roles\Role;

class RoleService
{
	/**
	 * @var $roleRepository
	 */
	protected $roleRepository;
	
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
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll($args = [], $paginate = null, $limit = null, $orderBy = null)
	{
		return $this->roleRepository->findAll($args, $paginate, $limit);
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
		return $this->roleRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return Role
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
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		return $this->roleRepository->count($args);
	}
}

