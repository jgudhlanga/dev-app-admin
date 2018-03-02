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

/**
 * Class ModuleController
 * @package App\Http\Controllers\Cpanel\Modules\Api
 */
class ModuleController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var ModuleService
	 */
	protected $moduleService;
	
	/**
	 * ModuleController constructor.
	 * @param ModuleService $modulesService
	 */
	public function __construct(ModuleService $modulesService)
	{
		$this->moduleService = $modulesService;
	}
	
	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getModules()
	{
		$modules = $this->moduleService->findBy(null,null, null, null, ['position' => 'asc']);
		return Datatables::of($modules)->make(true);
	}
	
	/**
	 * @param Request $request
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
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
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Request $request
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
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
			throw new \Exception($e->getMessage());
		}
	}
}
