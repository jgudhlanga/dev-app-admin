<?php

namespace App\Http\Controllers\CPanel\General\AddressTypes;

use App\Http\Requests\CPanel\General\AddressTypeRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\AddressType;
use App\Services\General\AddressTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * Class AddressTypesController
 * @package App\Http\Controllers\CPanel\General\AddressTypes
 */
class AddressTypesController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var AddressTypeService
	 */
	protected $addressTypeService;
	
	/**
	 * AddressTypesController constructor.
	 * @param AddressTypeService $addressTypeService
	 */
	public function __construct(AddressTypeService $addressTypeService)
	{
		$this->addressTypeService = $addressTypeService;
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$addressTypes =$this->addressTypeService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.address-types', compact('addressTypes', 'statusActive', 'statusInActive'));
	}
	
	/**
	 * @param AddressTypeRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function store(AddressTypeRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$addressType = $this->addressTypeService->create($data);
			if($addressType instanceof AddressType) {
				$created = $addressType;
				$status = Response::HTTP_CREATED;
				$message = trans('address-types.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('address-types.alerts.error');
			}
			DB::commit();
			return response()->json(['address_type' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param AddressType $addressType
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(AddressType $addressType)
	{
		if($addressType instanceof AddressType){
			return response([
				'data' => $addressType
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('address-types.not_found'), 'error');
		}
	}
	
	/**
	 * @param Request $request
	 * @param AddressType $addressType
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function update(Request $request, AddressType $addressType)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$addressType = $this->addressTypeService->update($addressType, $data);
			if($addressType instanceof AddressType) {
				$updated = $addressType;
				$status = Response::HTTP_CREATED;
				$message = trans('address-types.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('address-types.alerts.error');
			}
			DB::commit();
			return response()->json(['address_type' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param AddressType $addressType
	 * @throws Exception
	 */
	public function destroy(AddressType $addressType)
	{
		try{
			$this->addressTypeService->delete($addressType);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
