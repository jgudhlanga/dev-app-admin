<?php

namespace App\Http\Controllers\Admin\Modules\Api;

use App\Services\Common\IconService;
use App\Models\Common\Status;
use App\Models\Modules\Module;
use App\Services\Common\StatusService;
use App\Services\Modules\ModuleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
	/**
	 * Module Service
	 * @var $moduleService
	 */
	protected $moduleService;
	
	/**
	 * @var $iconService
	 */
	protected $iconService;
	
	/**
	 * @var
	 */
	protected $statusService;
	
	/**
	 * ModuleController constructor.
	 * @param ModuleService $modulesService
	 * @param IconService $iconService
	 * @param StatusService $statusService
	 */
	public function __construct(ModuleService $modulesService, IconService $iconService, StatusService $statusService)
	{
		$this->moduleService = $modulesService;
		$this->iconService = $iconService;
		$this->statusService = $statusService;
	}
	
	/**
	 * @return mixed
	 * @throws Exception
	 */
	public function getModules()
	{
		$modules = $this->moduleService->findBy(null, null, null, ['position' => 'asc']);
		return Datatables::of($modules)->make(true);
	}
	
	/**
	 * @param Request $request
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function changeStatus(Request $request, Module $module)
	{
		try
		{
			DB::beginTransaction();
			$status = ($module->status_id == Status::ACTIVE) ? Status::INACTIVE : Status::ACTIVE;
			$module = $this->moduleService->update($module, ['status_id' => $status]);
			DB::commit();
			$message = ($module->status_id == Status::ACTIVE) ? 'modules.alerts.reactivated' : 'modules.alerts.deactivated';
			return response()->json(['module' => $module, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Request $request
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
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
