<?php

namespace App\Http\Controllers\Users\Api;

use App\Http\Requests\Users\UserRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package App\Http\Controllers\Users\Api
 */
class UserController extends Controller
{
	
	/**
	 * @var UserService
	 */
	protected $userService;
	
	/**
	 * UserController constructor.
	 * @param UserService $userService
	 */
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}
	
	
	/**
	 *
	 */
	public function index()
    {
    
    }
	
	
	/**
	 *
	 */
	public function create()
    {
    
    }
	
	
	/**
	 * @param UserRequest $userRequest
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 * @throws \Exception
	 */
	public function store(UserRequest $userRequest)
    {
    	try
	    {
		    $user = $this->userService->createUser($userRequest);
		    return response(['data' => new UserResource($user)], Response::HTTP_CREATED);
	    }
	    catch (\Exception $exc)
	    {
	    	throw new \Exception($exc->getMessage());
	    }
    }
	
	
	/**
	 * @param $id
	 */
	public function show($id)
    {
    
    }
	
	
	/**
	 * @param $id
	 */
	public function edit($id)
    {
    
    }
	
	
	/**
	 * @param Request $request
	 * @param $id
	 */
	public function update(Request $request, $id)
    {
    
    }
	
	
	/**
	 * @param $id
	 */
	public function destroy($id)
    {
    
    }
}
