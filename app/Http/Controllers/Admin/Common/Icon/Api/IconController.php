<?php

namespace App\Http\Controllers\Admin\Common\Icon\Api;

use App\Models\Common\Icon;
use App\Services\Common\IconService;
use App\Services\Common\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IconController extends Controller
{
	/**
	 * @var IconService
	 */
	protected $iconService;
	/**
	 * @var StatusService
	 */
	protected $statusService;
	
	/**
	 * IconController constructor.
	 * @param IconService $iconService
	 * @param StatusService $statusService
	 */
	public function __construct(IconService $iconService, StatusService $statusService)
	{
		$this->iconService = $iconService;
		$this->statusService = $statusService;
	}
	
	/**
	 * @param Request $request
	 * @param Icon $icon
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function changeStatus(Request $request, Icon $icon)
	{
		try
		{
			DB::beginTransaction();
			$status = $request->status_id;
			$icon = $this->iconService->update($icon, ['status_id' => $status]);
			DB::commit();
			$message = ($icon->status_id == $this->statusService->statusActive()) ? 'icons.alerts.reactivated' : 'icons.alerts.deactivated';
			$title = ($icon->status_id == $this->statusService->statusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['class' => $icon, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			notify()->flash(trans($e->getMessage()), 'error', ['title'=>trans('alerts.error')]);
		}
	}
}
