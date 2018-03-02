<?php

namespace App\Http\Controllers\CPanel\General\Countries\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Country;
use App\Services\General\CountryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;


/**
 * Class CountriesController
 * @package App\Http\Controllers\CPanel\General\Countries\Api
 */
class CountriesController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var CountryService
	 */
	protected $countryService;
	
	/**
	 * CountriesController constructor.
	 * @param CountryService $countryService
	 */
	public function __construct(CountryService $countryService)
	{
		$this->countryService = $countryService;
	}
	
	
	/**
	 * @param Request $request
	 * @param Country $country
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
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
			return response()->json(['data' => $country, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getCountries()
	{
		$countries = $this->countryService->findBy(null,null, null, null, ['name' => 'asc']);
		return Datatables::of($countries)->make(true);
	}
	
}
