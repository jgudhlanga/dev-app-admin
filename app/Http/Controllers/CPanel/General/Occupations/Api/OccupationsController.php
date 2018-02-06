<?php

namespace App\Http\Controllers\Cpanel\General\Occupations\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Occupation;
use App\Services\General\OccupationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class OccupationsController extends Controller
{
	use CommonTrait;
	
	protected $occupationService;
	
	public function __construct(OccupationService $occupationService)
	{
		$this->occupationService = $occupationService;
	}
	
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
			//DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
}
