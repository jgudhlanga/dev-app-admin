<?php

namespace App\Http\Controllers\CPanel\General\MemberTypes;

use App\Http\Requests\CPanel\General\MemberTypeRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\MemberType;
use App\Services\General\MemberTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * Class MemberTypesController
 * @package App\Http\Controllers\CPanel\General\MemberTypes
 */
class MemberTypesController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var MemberTypeService
	 */
	protected $memberTypeService;
	
	/**
	 * MemberTypesController constructor.
	 * @param MemberTypeService $memberTypeService
	 */
	public function __construct(MemberTypeService $memberTypeService)
	{
		$this->memberTypeService = $memberTypeService;
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$memberTypes =$this->memberTypeService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.member-types', compact('memberTypes', 'statusActive', 'statusInActive'));
	}
	
	/**
	 * @param MemberTypeRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function store(MemberTypeRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$type = $this->memberTypeService->create($data);
			if($type instanceof MemberType) {
				$created = $type;
				$status = Response::HTTP_CREATED;
				$message = trans('members.types.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('members.types.alerts.error');
			}
			DB::commit();
			return response()->json(['member_type' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param MemberType $memberType
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(MemberType $memberType)
	{
		if($memberType instanceof MemberType){
			return response([
				'data' => $memberType
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('members.types.not_found'), 'error');
		}
	}
	
	/**
	 * @param Request $request
	 * @param MemberType $memberType
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
	public function update(Request $request, MemberType $memberType)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$memberType = $this->memberTypeService->update($memberType, $data);
			if($memberType instanceof MemberType) {
				$updated = $memberType;
				$status = Response::HTTP_CREATED;
				$message = trans('members.types.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('members.types.alerts.error');
			}
			DB::commit();
			return response()->json(['member_type' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param MemberType $memberType
	 * @throws Exception
	 */
	public function destroy(MemberType $memberType)
	{
		try{
			$this->memberTypeService->delete($memberType);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
