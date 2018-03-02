<?php

namespace App\Http\Controllers\CPanel\General\Races\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Race;
use App\Services\General\RaceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RaceController
 * @package App\Http\Controllers\CPanel\General\Races\Api
 */
class RaceController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var RaceService
	 */
	protected $raceService;
	
	/**
	 * RaceController constructor.
	 * @param RaceService $raceService
	 */
	public function __construct(RaceService $raceService)
	{
		$this->raceService = $raceService;
	}
	
	/**
	 * @param Request $request
	 * @param Race $race
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function changeStatus(Request $request, Race $race)
	{
		try
		{
			DB::beginTransaction();
			$status = ($race->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$race = $this->raceService->update($race, ['status_id' => $status]);
			DB::commit();
			$message = ($race->status_id == $this->getStatusActive()) ? 'races.alerts.reactivated' : 'races.alerts.deactivated';
			$title = ($race->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $race, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
}
