<?php

namespace App\Http\Controllers\CPanel\Security;

use App\Http\Requests\CPanel\Security\RoleRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\Roles\Role;
use App\Services\Security\PermissionService;
use App\Services\Security\RoleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * Class RolesController
 * @package App\Http\Controllers\CPanel\Security
 */
class RolesController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var RoleService
	 */
	protected $roleService;
	/**
	 * @var PermissionService
	 */
	protected $permissionService;
	
	/**
	 * RolesController constructor.
	 * @param RoleService $roleService
	 * @param PermissionService $permissionService
	 */
	public function __construct(RoleService $roleService, PermissionService $permissionService)
	{
		$this->roleService = $roleService;
		$this->permissionService = $permissionService;
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$roles =$this->roleService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		
		return view('cpanel.security.roles', compact('roles', 'statusActive', 'statusInActive'));
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$permissions = $this->permissionService->findAll(null, null, null, ['display_name' => 'asc']);
		return view('cpanel.security.create-role', compact('permissions'));
	}
	
	/**
	 * @param RoleRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function store(RoleRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$role = $this->roleService->create($data);
			if($role instanceof Role) {
				$created = $role;
				$status = Response::HTTP_CREATED;
				$message = trans('roles.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('roles.alerts.error');
			}
			DB::commit();
			return response()->json(['role' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Role $role
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Role $role)
	{
		$permissions = $this->permissionService->findAll(null, null, null, ['display_name' => 'asc']);
		$rolePermissions = (count($role->permissions) > 0) ? $role->permissions()->pluck('id')->all() : [];
		return view('cpanel.security.edit-role', compact('role', 'permissions', 'rolePermissions'));
	}
	
	/**
	 * @param Request $request
	 * @param Role $role
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function update(Request $request, Role $role)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$role = $this->roleService->update($role, $data);
			if($role instanceof Role) {
				$updated = $role;
				$status = Response::HTTP_CREATED;
				$message = trans('roles.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('roles.alerts.error');
			}
			DB::commit();
			return response()->json(['role' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Role $role
	 * @throws Exception
	 */
	public function destroy(Role $role)
	{
		try{
			$this->roleService->delete($role);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
