<?php

namespace App\Http\Controllers\CPanel\General\Countries;

use App\Http\Requests\CPanel\General\CountryRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\Country;
use App\Services\General\CountryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

class CountriesController extends Controller
{
	use CommonTrait;
	
	protected $countryService;
	
	public function __construct(CountryService $countryService)
	{
		$this->countryService = $countryService;
	}
	
	public function index()
	{
		$countries =$this->countryService->findAll(null, null, null, ['name' => 'asc']);
		$statusActive = $this->getStatusActive();
		$statusInActive = $this->getStatusInActive();
		return view('cpanel.general.countries', compact('countries', 'statusActive', 'statusInActive'));
	}
	
	public function store(CountryRequest $request)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['created_by'] = Auth::id();
			$country = $this->countryService->create($data);
			if($country instanceof Country) {
				$created = $country;
				$status = Response::HTTP_CREATED;
				$message = trans('countries.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('countries.alerts.error');
			}
			DB::commit();
			return response()->json(['country' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	public function edit(Country $country)
	{
		if($country instanceof Country){
			return response([
				'data' => $country
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('countries.not_found'), 'error');
		}
	}
	
	public function update(Request $request, Country $country)
	{
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['updated_by'] = Auth::id();
			$country = $this->countryService->update($country, $data);
			if($country instanceof Country) {
				$updated = $country;
				$status = Response::HTTP_CREATED;
				$message = trans('countries.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('countries.alerts.error');
			}
			DB::commit();
			return response()->json(['country' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			DB::rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	public function destroy(Country $country)
	{
		try{
			$this->countryService->delete($country);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
