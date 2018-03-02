<?php

namespace App\Http\Controllers\CPanel\General\MaritalStatus\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\MaritalStatus;
use App\Services\General\MaritalStatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Class MaritalStatusController
 * @package App\Http\Controllers\CPanel\General\MaritalStatus\Api
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
	 * @param Request $request
	 * @param MaritalStatus $maritalStatus
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function changeStatus(Request $request, MaritalStatus $maritalStatus)
	{
		try
		{
			DB::beginTransaction();
			$status = ($maritalStatus->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$maritalStatus = $this->maritalStatusService->update($maritalStatus, ['status_id' => $status]);
			DB::commit();
			$message = ($maritalStatus->status_id == $this->getStatusActive()) ? 'marital-status.alerts.reactivated' : 'marital-status.alerts.deactivated';
			$maritalStatus = ($maritalStatus->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $maritalStatus, 'message' => trans($message), 'title' => trans($maritalStatus)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
}
