<?php

namespace App\Http\Controllers\CPanel\Security;

use App\Http\Requests\CPanel\Security\PermissionRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\Roles\Permission;
use App\Services\Security\PermissionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

class PermissionsController extends Controller
{
	use CommonTrait;
	
	protected $permissionService;
	
	public function __construct(PermissionService $permissionService)
	{
		$this->permissionService = $permissionService;
	}
	
	public function index()
	{
		$permissions =$this->permissionService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.security.permissions', compact('permissions', 'statusActive', 'statusInActive'));
	}
	
	public function create()
	{
		return view('cpanel.security.create-permissions');
	}
	
	public function store(PermissionRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$permission = $this->permissionService->create($data);
			if($permission instanceof Permission) {
				$created = $permission;
				$status = Response::HTTP_CREATED;
				$message = trans('permissions.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('permissions.alerts.error');
			}
			DB::commit();
			return response()->json(['permission' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	public function storeCrud(Request $request)
	{
		
		try{
			DB::beginTransaction();
			$resources = $request->input('resources');
			$count = 0;
			foreach ($resources as $resource)
			{
				if(isset($resource['id']))
				{
					unset($resource['id']);
					$resource['created_by'] = Auth::id();
					$permission = $this->permissionService->create($resource);
					if($permission instanceof Permission) {
						$count++;
					}
				}
				
			}
			
			if($count) {
				$created = $count;
				$status = Response::HTTP_CREATED;
				$message = trans('permissions.alerts.crud_created', ['count' => $count]);
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('permissions.alerts.error');
			}
			DB::commit();
			return response()->json(['permission' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	public function update(Request $request, Permission $permission)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$permission = $this->permissionService->update($permission, $data);
			if($permission instanceof Permission) {
				$updated = $permission;
				$status = Response::HTTP_CREATED;
				$message = trans('permissions.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('permissions.alerts.error');
			}
			DB::commit();
			return response()->json(['permission' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	public function destroy(Permission $permission)
	{
		try{
			$this->permissionService->delete($permission);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
