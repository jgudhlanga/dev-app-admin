<?php

namespace App\Http\Controllers\Admin\Modules\Api;

use App\Models\Common\Status;
use App\Models\Modules\Module;
use App\Models\Modules\Page;
use App\Services\Common\IconService;
use App\Services\Common\StatusService;
use App\Services\Modules\PageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiPageController extends Controller
{
	
	/**
	 * @var $pageService
	 */
	protected $pageService;
	
	/**
	 * @var $iconService
	 */
	protected $iconService;
	
	/**
	 * @var
	 */
	protected $statusService;
	
	/**
	 * PageController constructor.
	 * @param PageService $pageService
	 * @param IconService $iconService
	 * @param StatusService $statusService
	 */
	public function __construct(PageService $pageService, IconService $iconService, StatusService $statusService)
	{
		$this->pageService = $pageService;
		$this->iconService = $iconService;
		$this->statusService = $statusService;
	}
	
	/**
	 * @param $module
	 * @return mixed
	 * @throws \Exception
	 */
	public function getPages(Module $module)
	{
		$pages = $this->pageService->findBy(['module_id' => $module->id], null, null, ['position' => 'asc']);
		return Datatables::of($pages)->make(true);
	}
	
	/**
	 * @param Request $request
	 * @param Page $page
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function changeStatus(Request $request, Page $page)
	{
		try
		{
			DB::beginTransaction();
			$status = ($page->status_id == Status::ACTIVE) ? Status::INACTIVE : Status::ACTIVE;
			$page = $this->pageService->update($page, ['status_id' => $status]);
			DB::commit();
			$message = ($page->status_id == Status::ACTIVE) ? 'modules.pages.alerts.reactivated' : 'modules.pages.alerts.deactivated';
			return response()->json(['page' => $page, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Request $request
	 * @param Page $page
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function order(Request $request, Page $page)
	{
		try
		{
			DB::beginTransaction();
			$direction = $request->direction;
			$page = $this->pageService->orderPages($page, $direction);
			DB::commit();
			$message = 'alerts.operation_successful';
			return response()->json(['pages' => $page, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
}
