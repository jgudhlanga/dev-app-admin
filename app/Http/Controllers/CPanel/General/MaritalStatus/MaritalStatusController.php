<?php

namespace App\Http\Controllers\CPanel\General\MaritalStatus;

use App\Http\Requests\CPanel\General\MaritalStatusRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\MaritalStatus;
use App\Services\General\MaritalStatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Auth;

/**
 * Class MaritalStatusController
 * @package App\Http\Controllers\CPanel\General\MaritalStatus
 */
class MaritalStatusController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var MaritalStatusService
	 */
	protected $maritalStatusService;
	
	/**
	 * MaritalStatusController constructor.
	 * @param MaritalStatusService $maritalStatusService
	 */
	public function __construct(MaritalStatusService $maritalStatusService)
	{
		$this->maritalStatusService = $maritalStatusService;
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$maritalStatuses =$this->maritalStatusService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.marital-status', compact('maritalStatuses', 'statusActive', 'statusInActive'));
	}
	
	/**
	 * @param MaritalStatusRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function store(MaritalStatusRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$maritalStatus = $this->maritalStatusService->create($data);
			if($maritalStatus instanceof MaritalStatus) {
				$created = $maritalStatus;
				$status = Response::HTTP_CREATED;
				$message = trans('marital-status.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('marital-status.alerts.error');
			}
			DB::commit();
			return response()->json(['marital_status' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	
	/**
	 * @param $id
	 */
	public function show($id)
	{
		
	}
	
	/**
	 * @param MaritalStatus $maritalStatus
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(MaritalStatus $maritalStatus)
	{
		if($maritalStatus instanceof MaritalStatus){
			return response([
				'data' => $maritalStatus
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('marital-status.not_found'), 'error');
		}
	}
	
	/**
	 * @param Request $request
	 * @param MaritalStatus $maritalStatus
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function update(Request $request, MaritalStatus $maritalStatus)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$maritalStatus = $this->maritalStatusService->update($maritalStatus, $data);
			if($maritalStatus instanceof MaritalStatus) {
				$updated = $maritalStatus;
				$status = Response::HTTP_CREATED;
				$message = trans('marital-status.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('marital-status.alerts.error');
			}
			DB::commit();
			return response()->json(['marital_status' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param MaritalStatus $maritalStatus
	 * @throws \Exception
	 */
	public function destroy(MaritalStatus $maritalStatus)
	{
		try{
			$this->maritalStatusService->delete($maritalStatus);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
