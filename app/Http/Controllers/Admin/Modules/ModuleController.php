<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Modules\ModuleRequest;
use App\Models\Common\Status;
use App\Services\Common\IconService;
use App\Services\Common\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Modules\ModulesService;
use App\Models\Modules\Module;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
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
	 * @param ModulesService $modulesService
	 * @param IconService $iconService
	 * @param StatusService $statusService
	 */
    public function __construct(ModulesService $modulesService, IconService $iconService, StatusService $statusService)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$module = $this->moduleService->find($id);
	    $icons = $this->iconService->findAll();
        return view('admin.modules.edit', compact('module', 'icons'));
    }
	
	
	
    public function update(Request $request, $id)
    {
     
	    try{
		    //validation here
		    DB::beginTransaction();
		    $data = $request->all();
		    $data['updated_by'] = Auth::id();
		    $module = $this->moduleService->update($id, $data);
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
	 * @param $id
	 * @throws Exception
	 */
    public function destroy($id)
    {
    	try{
		    $this->moduleService->delete($id);
	    }
	    catch (\Exception $e) {
	    	throw new \Exception($e->getMessage());
	    }
    }
	
	/**
	 * @return mixed
	 * @throws Exception
	 */
    public function getModules()
    {
        $modules = $this->moduleService->findAll(null, null, null, ['position' => 'asc']);
        return Datatables::of($modules)->make(true);
    }
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
    public function changeStatus(Request $request)
    {
    	try
	    {
    		DB::beginTransaction();
		    $id = $request->module_id;
		    $module = $this->moduleService->find($id);
		    $status = ($module->status_id == Status::ACTIVE) ? Status::INACTIVE : Status::ACTIVE;
		    $this->moduleService->changeStatus($id, $status);
		    DB::commit();
		    $module = $this->moduleService->find($id);
		    $message = ($module->status_id == Status::ACTIVE) ? 'modules.alerts.reactivated' : 'modules.alerts.deactivated';
		    return response()->json(['module' => $module, 'message' => trans($message)], Response::HTTP_OK);
		
	    }
	    catch (\Exception $e)
	    {
	    	DB:rollback();
		    throw new \Exception($e->getMessage());
	    }
    }
}
