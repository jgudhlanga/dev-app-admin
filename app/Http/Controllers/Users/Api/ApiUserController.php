<?php

namespace App\Http\Controllers\Users\Api;

use App\Http\Requests\Users\UserRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiUserController extends Controller
{
	/**
	 * @var UserService
	 */
	protected $userService;
	
	/**
	 * ApiUserController constructor.
	 * @param UserService $userService
	 */
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}
	
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
