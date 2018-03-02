<?php

namespace App\Http\Controllers\Cpanel\General\Occupations\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Occupation;
use App\Services\General\OccupationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OccupationsController
 * @package App\Http\Controllers\Cpanel\General\Occupations\Api
 */
class OccupationsController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var OccupationService
	 */
	protected $occupationService;
	
	/**
	 * OccupationsController constructor.
	 * @param OccupationService $occupationService
	 */
	public function __construct(OccupationService $occupationService)
	{
		$this->occupationService = $occupationService;
	}
	
	/**
	 * @param Request $request
	 * @param Occupation $occupation
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function changeStatus(Request $request, Occupation $occupation)
	{
		try
		{
			DB::beginTransaction();
			$status = ($occupation->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$occupation = $this->occupationService->update($occupation, ['status_id' => $status]);
			DB::commit();
			$message = ($occupation->status_id == $this->getStatusActive()) ? 'occupations.alerts.reactivated' : 'occupations.alerts.deactivated';
			$title = ($occupation->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $occupation, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
}
