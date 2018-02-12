<?php

namespace App\Http\Controllers\CPanel\General\AddressTypes\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\AddressType;
use App\Services\General\AddressTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class AddressTypesController extends Controller
{
	use CommonTrait;
	
	protected $addressTypeService;
	
	public function __construct(AddressTypeService $addressTypeService)
	{
		$this->addressTypeService = $addressTypeService;
	}
	
	public function changeStatus(Request $request, AddressType $addressType)
	{
		try
		{
			DB::beginTransaction();
			$status = ($addressType->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$addressType = $this->addressTypeService->update($addressType, ['status_id' => $status]);
			DB::commit();
			$message = ($addressType->status_id == $this->getStatusActive()) ? 'address-types.alerts.reactivated' : 'address-types.alerts.deactivated';
			$title = ($addressType->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $addressType, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
}
