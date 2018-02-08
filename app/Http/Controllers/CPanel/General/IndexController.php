<?php

namespace App\Http\Controllers\CPanel\General;

use App\Services\General\GenderService;
use App\Services\General\IconService;
use App\Services\General\MaritalStatusService;
use App\Services\General\OccupationService;
use App\Services\General\RaceService;
use App\Services\General\StatusService;
use App\Services\General\TitleService;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	
	protected $titleService;
	
	protected $iconService;
	
	protected $statusService;
	
	protected $maritalStatusService;
	
	protected $genderService;
	
	protected $occupationService;
	
	protected $raceService;
	
    public function __construct(StatusService $statusService, IconService $iconService, TitleService $titleService,
	    MaritalStatusService $maritalStatusService, GenderService $genderService, OccupationService $occupationService,
		RaceService $raceService
        )
    {
    	$this->statusService = $statusService;
    	$this->iconService = $iconService;
    	$this->titleService = $titleService;
    	$this->maritalStatusService = $maritalStatusService;
    	$this->genderService = $genderService;
    	$this->occupationService = $occupationService;
    	$this->raceService = $raceService;
    }
	
	public function index()
    {
    	$statusCount = $this->statusService->count(null);
    	$iconCount = $this->iconService->count(null);
    	$titleCount = $this->titleService->count(null);
    	$maritalStatusCount = $this->maritalStatusService->count(null);
    	$genderCount = $this->genderService->count(null);
    	$occupationCount = $this->occupationService->count(null);
    	$raceCount = $this->raceService->count(null);
	    return view('cpanel.general.index', compact('statusCount','iconCount', 'titleCount',
		    'maritalStatusCount', 'genderCount', 'occupationCount', 'raceCount'));
    }
    
    public function show()
    {
    
    }
}