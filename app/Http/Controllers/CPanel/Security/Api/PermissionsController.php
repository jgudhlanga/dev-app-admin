<?php

namespace App\Http\Controllers\Cpanel\Security\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\Roles\Permission;
use App\Services\Security\PermissionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
	use CommonTrait;
	
	protected $permissionService;
	
	public function __construct(PermissionService $permissionService)
	{
		$this->permissionService = $permissionService;
	}
	
	public function getPermissions()
	{
		$permissions = $this->permissionService->findBy(null, null, null);
		return Datatables::of($permissions)->make(true);
	}
	
	public function changeStatus(Request $request, Permission $permission)
	{
		try
		{
			DB::beginTransaction();
			$status = ($permission->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$permission = $this->permissionService->update($permission, ['status_id' => $status]);
			DB::commit();
			$message = ($permission->status_id == $this->getStatusActive()) ? 'permissions.alerts.reactivated' : 'permissions.alerts.deactivated';
			return response()->json(['permission' => $permission, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
}
