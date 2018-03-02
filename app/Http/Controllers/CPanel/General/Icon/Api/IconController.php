<?php

namespace App\Http\Controllers\CPanel\General\Icon\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Icon;
use App\Services\General\IconService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IconController
 * @package App\Http\Controllers\CPanel\General\Icon\Api
 */
class IconController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var IconService
	 */
	protected $iconService;
	
	/**
	 * IconController constructor.
	 * @param IconService $iconService
	 */
	public function __construct(IconService $iconService)
	{
		$this->iconService = $iconService;
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
			$message = ($icon->status_id == $this->getStatusActive()) ? 'icons.alerts.reactivated' : 'icons.alerts.deactivated';
			$title = ($icon->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['class' => $icon, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			notify()->flash(trans($e->getMessage()), 'error', ['title'=>trans('alerts.error')]);
		}
	}
}
