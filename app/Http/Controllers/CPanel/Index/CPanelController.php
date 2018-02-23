<?php

namespace App\Http\Controllers\CPanel\Index;

use App\Http\Controllers\Controller;
use App\Services\General\AddressTypeService;
use App\Services\General\MemberTypeService;
use App\Services\Modules\ModuleService;
use App\Services\General\CountryService;
use App\Services\General\GenderService;
use App\Services\General\IconService;
use App\Services\General\MaritalStatusService;
use App\Services\General\OccupationService;
use App\Services\General\RaceService;
use App\Services\General\StatusService;
use App\Services\General\TitleService;
use App\Services\Security\PermissionService;
use App\Services\Security\RoleService;

class CpanelController extends Controller
{
    protected $moduleService;
	protected $titleService;
	protected $iconService;
	protected $statusService;
	protected $maritalStatusService;
	protected $genderService;
	protected $occupationService;
	protected $raceService;
	protected $countryService;
	protected $memberTypeService;
	protected $addressTypeService;
	protected $roleService;
	protected $permissionService;
	
    public function __construct(ModuleService $modulesService, StatusService $statusService, IconService $iconService,
	    TitleService $titleService,MaritalStatusService $maritalStatusService, GenderService $genderService,
	    OccupationService $occupationService,RaceService $raceService, CountryService $countryService,
	    MemberTypeService $memberTypeService, AddressTypeService $addressTypeService, PermissionService $permissionService,
	    RoleService $roleService)
    {
        $this->moduleService = $modulesService;
	    $this->statusService = $statusService;
	    $this->iconService = $iconService;
	    $this->titleService = $titleService;
	    $this->maritalStatusService = $maritalStatusService;
	    $this->genderService = $genderService;
	    $this->occupationService = $occupationService;
	    $this->raceService = $raceService;
	    $this->countryService = $countryService;
	    $this->memberTypeService = $memberTypeService;
	    $this->addressTypeService = $addressTypeService;
	    $this->permissionService = $permissionService;
	    $this->roleService = $roleService;
    }
    
    public function index()
    {
        $moduleCount = $this->moduleService->count(null);
	    $statusCount = $this->statusService->count(null);
	    $iconCount = $this->iconService->count(null);
	    $titleCount = $this->titleService->count(null);
	    $maritalStatusCount = $this->maritalStatusService->count(null);
	    $genderCount = $this->genderService->count(null);
	    $occupationCount = $this->occupationService->count(null);
	    $raceCount = $this->raceService->count(null);
	    $countryCount = $this->countryService->count(null);
	    $memberTypeCount = $this->memberTypeService->count(null);
	    $addressTypeCount = $this->addressTypeService->count(null);
	    $permissionCount = $this->permissionService->count(null);
	    $roleCount = $this->roleService->count(null);
        return view('cpanel.index.index', compact('moduleCount','statusCount','iconCount', 'titleCount',
	        'maritalStatusCount', 'genderCount', 'occupationCount', 'raceCount', 'countryCount', 'memberTypeCount',
	        'addressTypeCount', 'permissionCount', 'roleCount'));
    }
   
}
