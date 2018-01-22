<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/01/03
 * Time: 05:52 PM
 */

namespace App\Services\Users;

use App\Models\Users\User;
use App\Repositories\Users\UserRepository;

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