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

class MaritalStatusController extends Controller
{
	use CommonTrait;
	
	protected $maritalStatusService;
	
	public function __construct(MaritalStatusService $maritalStatusService)
	{
		$this->maritalStatusService = $maritalStatusService;
	}
	
	public function index()
	{
		$maritalStatuses =$this->maritalStatusService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.marital-status', compact('maritalStatuses', 'statusActive', 'statusInActive'));
	}
	
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
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	
	public function show($id)
	{
		
	}
	
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
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
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
