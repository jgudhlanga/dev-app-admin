<?php

namespace App\Services\Users;

use App\Models\Users\User;
use App\Repositories\Users\UserRepository;

/**
 * Class UserService
 * @package App\Services\Users
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
	 * @param $params
	 * @return mixed
	 */
	public function createUser($params)
	{
		return $this->userRepository->create($params);
	}
}