<?php

namespace App\Http\Controllers\CPanel\Index;

use App\Http\Controllers\Controller;
use App\Services\Modules\ModuleService;


class CpanelController extends Controller
{
    protected $moduleService;
    
    public function __construct(ModuleService $modulesService)
    {
        $this->moduleService = $modulesService;
    }
    
    public function index()
    {
        $moduleCount = $this->moduleService->count(null);
        return view('cpanel.index.index', compact('moduleCount'));
    }
   
}
