<?php

namespace App\Http\Controllers\Cpanel\Security\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\Roles\Role;
use App\Services\Security\RoleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RolesController
 * @package App\Http\Controllers\Cpanel\Security\Api
 */
class RolesController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var RoleService
	 */
	protected $roleService;
	
	/**
	 * RolesController constructor.
	 * @param RoleService $roleService
	 */
	public function __construct(RoleService $roleService)
	{
		$this->roleService = $roleService;
	}
	
	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getRoles()
	{
		$roles = $this->roleService->findBy(null,null, null, null);
		return Datatables::of($roles)->make(true);
	}
	
	/**
	 * @param Request $request
	 * @param Role $role
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function changeStatus(Request $request, Role $role)
	{
		try
		{
			DB::beginTransaction();
			$status = ($role->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$role = $this->roleService->update($role, ['status_id' => $status]);
			DB::commit();
			$message = ($role->status_id == $this->getStatusActive()) ? 'roles.alerts.reactivated' : 'roles.alerts.deactivated';
			return response()->json(['role' => $role, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
}
