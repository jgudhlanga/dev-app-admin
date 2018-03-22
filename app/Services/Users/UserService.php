<?php

namespace App\Services\Users;

use App\Repositories\Users\UserRepository;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService
{
	/**
	 * @var UserRepository
	 */
	protected $userRepository;
	
	/**
	 * UserService constructor.
	 * @param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->userRepository->find($id);
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
		return $this->userRepository->findAll($where, $paginate, $limit);
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
		return $this->userRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->userRepository->create($params);
	}
	
	/**
	 * @param $user
	 * @param $data
	 * @return mixed
	 */
	public function update($user, $data)
	{
		return $this->userRepository->update($user, $data);
	}
	
	/**
	 * @param $user
	 * @return mixed
	 */
	public function delete($user)
	{
		return $this->userRepository->delete($user);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->userRepository->count($where);
	}
	
	/**
	 * @param $user
	 * @param $request
	 * @return mixed
	 */
	public function uploadProfilePicture($user, $request)
	{
		return $this->userRepository->uploadProfilePicture($user, $request);
	}
	
	/**
	 * @param $user
	 * @return string
	 */
	public function getUserProfilePicture($user)
	{
		return $this->userRepository->getUserProfilePicture($user);
	}
}

