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


class OccupationsController extends Controller
{
	use CommonTrait;
	
	protected $occupationService;
	
	public function __construct(OccupationService $occupationService)
	{
		$this->occupationService = $occupationService;
	}
	
	public function index()
	{
		$occupations =$this->occupationService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.occupation', compact('occupations', 'statusActive', 'statusInActive'));
	}
	
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
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
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
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
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
