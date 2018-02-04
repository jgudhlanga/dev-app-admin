<?php

namespace App\Http\Controllers\CPanel\General\Status;

use App\Http\Requests\CPanel\General\StatusRequest;
use App\Models\General\Status;
use App\Services\General\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
	public $statusService;
	
	public function __construct(StatusService $statusService)
	{
		$this->statusService = $statusService;
	}

    public function index()
    {
    	$statuses = $this->statusService->findAll(null,null, null, ['id' => 'asc']);
	    return view('cpanel.general.status', compact('statuses'));
    }

  
    public function store(StatusRequest $request)
    {
	    try{
		    DB::beginTransaction();
		    $insert = $this->statusService->create($request->all());
		    if($insert instanceof Status) {
			    $message = trans('status.alerts.success');
			    $status = Response::HTTP_CREATED;
			    $created = $insert;
		    }
		    else{
			    $message = trans('status.alerts.error');
			    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
			    $created = null;
		    }
		    DB::commit();
		    return response()->json(['data' => $created, 'message' => $message], $status);
	    }
	    catch (\Exception $e)
	    {
		    DB::rollback();
		    throw new \Exception($e->getMessage());
	    }
    }
	
    public function edit(Status $status)
    {
        if($status instanceof Status){
	        return response([
		        'data' => $status
	        ], Response::HTTP_OK);
        }
        else{
        	notify()->flash(trans('status.not_found'), 'error');
        }
    }
	
    public function update(Request $request, Status $status)
    {
    	try{
		    if($status instanceof Status)
		    {
			    if($this->statusService->update($status, $request->all())){
				    notify()->flash(trans('status.alerts.updated'), 'success', ['title' => trans('alerts.updated')]);
			    }
		    }
		    else{
			    notify()->flash(trans('status.not_found'), 'error', ['title' => trans('alerts.not_found')]);
		    }
		    return response([
			    'data' => $status
		    ], Response::HTTP_OK);
	    }
		catch (\Exception $e)
		{
			notify()->flash($e->getMessage(), 'error', ['title'=>trans('alerts.error'), 'timer' => 600000]);
		}
    }
	
    public function destroy(Status $status)
    {
	    try{
		    $this->statusService->delete($status);
		    notify()->flash(trans('status.alerts.deleted'), 'success', ['title'=>trans('alerts.deleted')]);
	    }
	    catch (\Exception $e) {
		    notify()->flash($e->getMessage(), 'error', ['title'=>trans('alerts.error'), 'timer' => 600000]);
	    }
    }
}
