<?php

namespace App\Http\Controllers\CPanel\General\MemberTypes\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\MemberType;
use App\Services\General\MemberTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class MemberTypesController extends Controller
{
	use CommonTrait;
	
	protected $memberTypeService;
	
	public function __construct(MemberTypeService $memberTypeService)
	{
		$this->memberTypeService = $memberTypeService;
	}
	
	
	public function changeStatus(Request $request, MemberType $memberType)
	{
		try
		{
			DB::beginTransaction();
			$status = ($memberType->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$memberType = $this->memberTypeService->update($memberType, ['status_id' => $status]);
			DB::commit();
			$message = ($memberType->status_id == $this->getStatusActive()) ? 'members.types.alerts.reactivated' : 'members.types.alerts.deactivated';
			$title = ($memberType->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $memberType, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
}
