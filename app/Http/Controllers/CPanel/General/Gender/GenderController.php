<?php

namespace App\Http\Controllers\CPanel\General\Gender;

use App\Http\Requests\Cpanel\General\GenderRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\Gender;
use App\Services\General\GenderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class GenderController
 * @package App\Http\Controllers\CPanel\General\Gender
 */
class GenderController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var GenderService
	 */
	protected $genderService;
	
	/**
	 * GenderController constructor.
	 * @param GenderService $genderService
	 */
	public function __construct(GenderService $genderService)
	{
		$this->genderService = $genderService;
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$genders =$this->genderService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.gender', compact('genders', 'statusActive', 'statusInActive'));
	}
	
	/**
	 * @param GenderRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function store(GenderRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$title = $this->genderService->create($data);
			if($title instanceof Gender) {
				$created = $title;
				$status = Response::HTTP_CREATED;
				$message = trans('gender.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('gender.alerts.error');
			}
			DB::commit();
			return response()->json(['gender' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Gender $gender
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(Gender $gender)
	{
		if($gender instanceof Gender){
			return response([
				'data' => $gender
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('gender.not_found'), 'error');
		}
	}
	
	/**
	 * @param Request $request
	 * @param Gender $gender
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function update(Request $request, Gender $gender)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$title = $this->genderService->update($gender, $data);
			if($title instanceof Gender) {
				$updated = $title;
				$status = Response::HTTP_CREATED;
				$message = trans('gender.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('gender.alerts.error');
			}
			DB::commit();
			return response()->json(['gender' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param Gender $gender
	 * @throws \Exception
	 */
	public function destroy(Gender $gender)
	{
		try{
			$this->genderService->delete($gender);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
