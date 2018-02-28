<?php

namespace App\Http\Controllers\Cpanel\Modules\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\Modules\Module;
use App\Services\Modules\ModuleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
	use CommonTrait;

	protected $moduleService;
	
	public function __construct(ModuleService $modulesService)
	{
		$this->moduleService = $modulesService;
	}
	
	public function getModules()
	{
		$modules = $this->moduleService->findBy(null, null, null, ['position' => 'asc']);
		return Datatables::of($modules)->make(true);
	}
	
	public function changeStatus(Request $request, Module $module)
	{
		try
		{
			DB::beginTransaction();
			$status = ($module->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$module = $this->moduleService->update($module, ['status_id' => $status]);
			DB::commit();
			$message = ($module->status_id == $this->getStatusActive()) ? 'modules.alerts.reactivated' : 'modules.alerts.deactivated';
			return response()->json(['module' => $module, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	public function order(Request $request, Module $module)
	{
		try
		{
			DB::beginTransaction();
			$direction = $request->direction;
			$module = $this->moduleService->orderModules($module, $direction);
			DB::commit();
			$message = 'alerts.operation_successful';
			return response()->json(['module' => $module, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
}
