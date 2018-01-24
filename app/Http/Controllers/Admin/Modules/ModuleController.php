<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Modules\ModuleRequest;
use App\Services\Common\IconService;
use App\Services\Common\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Modules\ModuleService;
use App\Models\Modules\Module;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class ModuleController extends Controller
{
    /**
     * Module Service
     * @var $moduleService
     */
    protected $moduleService;
	
	/**
	 * @var $iconService
	 */
    protected $iconService;
	
	/**
	 * @var
	 */
    protected $statusService;
    
	/**
	 * ModuleController constructor.
	 * @param ModuleService $modulesService
	 * @param IconService $iconService
	 * @param StatusService $statusService
	 */
    public function __construct(ModuleService $modulesService, IconService $iconService, StatusService $statusService)
    {
        $this->moduleService = $modulesService;
        $this->iconService = $iconService;
        $this->statusService = $statusService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$icons = $this->iconService->findAll();
        return view('admin.modules.index', compact('icons'));
    }
	
	/**
	 *
	 */
    public function create()
    {
        //
    }
	
	/**
	 * @param ModuleRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function store(ModuleRequest $request)
    {
        try{
        	//validation here
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
	
	/**
	 * @param Module $module
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function show(Module $module)
    {
	    $icons = $this->iconService->findAll();
        return view('admin.modules.edit', compact('module', 'icons'));
    }
	
	
	/**
	 * @param Request $request
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
    public function update(Request $request, Module $module)
    {
     
	    try{
		    //validation here
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
	
	/**
	 * @param $module
	 * @throws Exception
	 */
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
