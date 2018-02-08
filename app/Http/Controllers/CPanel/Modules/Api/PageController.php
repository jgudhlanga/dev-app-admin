<?php

namespace App\Http\Controllers\Cpanel\Modules\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\Modules\Module;
use App\Models\Modules\Page;
use App\Services\General\IconService;
use App\Services\Modules\PageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
	use CommonTrait;
	
	protected $pageService;
	
	protected $iconService;
	
	public function __construct(PageService $pageService, IconService $iconService)
	{
		$this->pageService = $pageService;
		$this->iconService = $iconService;
	}
	
	public function getPages(Module $module)
	{
		$pages = $this->pageService->findBy(['module_id' => $module->id], null, null, ['position' => 'asc']);
		return Datatables::of($pages)->make(true);
	}
	
	public function changeStatus(Request $request, Page $page)
	{
		try
		{
			DB::beginTransaction();
			$status = ($page->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$page = $this->pageService->update($page, ['status_id' => $status]);
			DB::commit();
			$message = ($page->status_id == $this->getStatusActive()) ? 'modules.pages.alerts.reactivated' : 'modules.pages.alerts.deactivated';
			return response()->json(['page' => $page, 'message' => trans($message)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
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