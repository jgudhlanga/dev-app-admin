<?php

namespace App\Http\Controllers\CPanel\General\Countries\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Country;
use App\Services\General\CountryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class CountriesController extends Controller
{
	use CommonTrait;
	
	protected $countryService;
	
	public function __construct(CountryService $countryService)
	{
		$this->countryService = $countryService;
	}
	
	
	public function changeStatus(Request $request, Country $country)
	{
		try
		{
			DB::beginTransaction();
			$status = ($country->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$country = $this->countryService->update($country, ['status_id' => $status]);
			DB::commit();
			$message = ($country->status_id == $this->getStatusActive()) ? 'countries.alerts.reactivated' : 'countries.alerts.deactivated';
			$title = ($country->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $title, 'message' => trans($message), 'country' => trans($country)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			DB:rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
}
