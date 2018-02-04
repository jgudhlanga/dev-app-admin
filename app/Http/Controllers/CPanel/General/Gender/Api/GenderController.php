<?php

namespace App\Http\Controllers\CPanel\General\Gender\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Gender;
use App\Services\General\GenderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class GenderController extends Controller
{
	use CommonTrait;
	
	protected $genderService;
	
	public function __construct(GenderService $genderService)
	{
		$this->genderService = $genderService;
	}
	
	public function changeStatus(Request $request, Gender $gender)
	{
		try
		{
			DB::beginTransaction();
			$status = ($gender->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$gender = $this->genderService->update($gender, ['status_id' => $status]);
			DB::commit();
			$message = ($gender->status_id == $this->getStatusActive()) ? 'gender.alerts.reactivated' : 'gender.alerts.deactivated';
			$title = ($gender->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $gender, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
}
