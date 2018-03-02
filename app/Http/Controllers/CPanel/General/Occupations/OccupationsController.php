<?php

namespace App\Http\Controllers\Cpanel\General\Occupations;

use App\Http\Requests\CPanel\General\OccupationRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\Occupation;
use App\Services\General\OccupationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;


/**
 * Class OccupationsController
 * @package App\Http\Controllers\Cpanel\General\Occupations
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
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$occupations =$this->occupationService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.occupation', compact('occupations', 'statusActive', 'statusInActive'));
	}
	
	/**
	 * @param OccupationRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function store(OccupationRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$occupation = $this->occupationService->create($data);
			if($occupation instanceof Occupation) {
				$created = $occupation;
				$status = Response::HTTP_CREATED;
				$message = trans('occupations.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('occupations.alerts.error');
			}
			DB::commit();
			return response()->json(['occupation' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Occupation $occupation
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(Occupation $occupation)
	{
		if($occupation instanceof Occupation){
			return response([
				'data' => $occupation
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('occupations.not_found'), 'error');
		}
	}
	
	/**
	 * @param Request $request
	 * @param Occupation $occupation
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function update(Request $request, Occupation $occupation)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$occupation = $this->occupationService->update($occupation, $data);
			if($occupation instanceof Occupation) {
				$updated = $occupation;
				$status = Response::HTTP_CREATED;
				$message = trans('occupations.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('occupations.alerts.error');
			}
			DB::commit();
			return response()->json(['occupation' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Occupation $occupation
	 * @throws Exception
	 */
	public function destroy(Occupation $occupation)
	{
		try{
			$this->occupationService->delete($occupation);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
