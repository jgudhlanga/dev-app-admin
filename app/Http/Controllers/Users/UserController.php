<?php

namespace App\Http\Controllers\Users;

use App\Services\General\GenderService;
use App\Services\General\StatusService;
use App\Services\General\TitleService;
use App\Services\Security\RoleService;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Users
 */
class UserController extends Controller
{
	
	/**
	 * @var UserService
	 */
	protected $userService;
	/**
	 * @var GenderService
	 */
	protected $genderService;
	/**
	 * @var TitleService
	 */
	protected $titleService;
	/**
	 * @var RoleService
	 */
	protected $roleService;
	/**
	 * @var StatusService
	 */
	protected $statusService;
	
	/**
	 * UserController constructor.
	 * @param UserService $userService
	 * @param GenderService $genderService
	 * @param TitleService $titleService
	 * @param RoleService $roleService
	 * @param StatusService $statusService
	 */
	public function __construct(UserService $userService, GenderService $genderService, TitleService $titleService,
	    RoleService $roleService, StatusService $statusService)
    {
    	$this->userService = $userService;
    	$this->genderService = $genderService;
    	$this->titleService = $titleService;
    	$this->roleService = $roleService;
    	$this->statusService = $statusService;
    }
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
    {
        return view('users.index');
    }
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
    {
    	$titles = $this->titleService->findAll(['status_id' => $this->statusService->statusActive()]);
    	$genders = $this->genderService->findAll(['status_id' => $this->statusService->statusActive()]);
    	$roles = $this->roleService->findAll(['status_id' => $this->statusService->statusActive()]);
        return view('users.create', compact('titles', 'genders', 'roles'));
    }
	
	/**
	 * @param Request $request
	 */
	public function store(Request $request)
    {
    
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
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function dashboard()
    {
    	return view('users.dashboard');
    }
}
