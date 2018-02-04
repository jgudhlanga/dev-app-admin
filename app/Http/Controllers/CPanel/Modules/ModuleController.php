<?php

namespace App\Http\Controllers\CPanel\Modules;

use App\Http\Requests\CPanel\Modules\ModuleRequest;
use App\Services\General\IconService;
use App\Services\General\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Modules\ModuleService;
use App\Models\Modules\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class ModuleController extends Controller
{
    protected $moduleService;
	
    protected $iconService;
	
    protected $statusService;
    
    public function __construct(ModuleService $modulesService, IconService $iconService, StatusService $statusService)
    {
        $this->moduleService = $modulesService;
        $this->iconService = $iconService;
        $this->statusService = $statusService;
    }

    public function index()
    {
    	$icons = $this->iconService->findAll();
        return view('cpanel.modules.index', compact('icons'));
    }
	
    public function store(ModuleRequest $request)
    {
        try{
	        DB::beginTransaction();
	        $data = $request->all();
	        $data['created_by'] = Auth::id();
	        $module = $this->moduleService->create($data);
	        if($module instanceof Module) {
		        $created = $module;
	            $status = Response::HTTP_CREATED;
	            $message = trans('modules.alerts.created');
	        }
	        else{
		        $created = null;
		        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
		        $message = trans('modules.alerts.error');
	        }
	        DB::commit();
	        return response()->json(['module' => $created, 'message' => $message], $status);
        }
        catch (\Exception $e)
        {
	        DB::rollback();
        	throw new \Exception($e->getMessage());
        }
    	
    }
	
    public function show(Module $module)
    {
	    $icons = $this->iconService->findAll();
        return view('cpanel.modules.edit', compact('module', 'icons'));
    }
	
    public function update(Request $request, Module $module)
    {
     
	    try{
		    DB::beginTransaction();
		    $data = $request->all();
		    $data['updated_by'] = Auth::id();
		    $module = $this->moduleService->update($module, $data);
		    if($module instanceof Module) {
			    $updated = $module;
			    $status = Response::HTTP_CREATED;
			    $message = trans('modules.alerts.updated');
		    }
		    else{
			    $updated = null;
			    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
			    $message = trans('modules.alerts.error');
		    }
		    DB::commit();
		    return response()->json(['module' => $updated, 'message' => $message], $status);
	    }
	    catch (\Exception $e)
	    {
		    DB::rollback();
		    throw new \Exception($e->getMessage());
	    }
    }
	
    public function destroy(Module $module)
    {
    	try{
		    $this->moduleService->delete($module);
	    }
	    catch (\Exception $e) {
	    	throw new \Exception($e->getMessage());
	    }
    }
}
