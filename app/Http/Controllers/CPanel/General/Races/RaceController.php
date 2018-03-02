<?php

namespace App\Http\Controllers\CPanel\General\Races;

use App\Http\Requests\CPanel\General\RaceRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\Race;
use App\Services\General\RaceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * Class RaceController
 * @package App\Http\Controllers\CPanel\General\Races
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
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$races =$this->raceService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.races', compact('races', 'statusActive', 'statusInActive'));
	}
	
	/**
	 * @param RaceRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function store(RaceRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$race = $this->raceService->create($data);
			if($race instanceof Race) {
				$created = $race;
				$status = Response::HTTP_CREATED;
				$message = trans('races.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('races.alerts.error');
			}
			DB::commit();
			return response()->json(['race' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Race $race
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(Race $race)
	{
		if($race instanceof Race){
			return response([
				'data' => $race
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('races.not_found'), 'error');
		}
	}
	
	/**
	 * @param Request $request
	 * @param Race $race
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function update(Request $request, Race $race)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$race = $this->raceService->update($race, $data);
			if($race instanceof Race) {
				$updated = $race;
				$status = Response::HTTP_CREATED;
				$message = trans('races.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('races.alerts.error');
			}
			DB::commit();
			return response()->json(['race' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Race $race
	 * @throws Exception
	 */
	public function destroy(Race $race)
	{
		try{
			$this->raceService->delete($race);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
