<?php

namespace App\Http\Controllers\Admin\Common\Status;

use App\Http\Requests\Admin\Common\StatusRequest;
use App\Models\Common\Status;
use App\Services\Common\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
	/**
	 * @var StatusService
	 */
	public $statusService;
	
	/**
	 * StatusController constructor.
	 * @param StatusService $statusService
	 */
	public function __construct(StatusService $statusService)
	{
		$this->statusService = $statusService;
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$statuses = $this->statusService->findAll(null,null, null, ['id' => 'asc']);
	    return view('admin.common.status', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   
    public function store(StatusRequest $request)
    {
	    try{
		    //validation here
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = $this->statusService->find($id);
        if($status instanceof Status){
	        return response([
		        'data' => $status
	        ], Response::HTTP_CREATED);
        }
        else{
        	notify()->flash(trans('status.not_found'), 'error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	try{
		    $status = $this->statusService->find($id);
		    if($status instanceof Status)
		    {
			    if($status->update($request->all())){
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
	
	/**
	 * @param $id
	 */
    public function destroy($id)
    {
	    try{
		    $this->statusService->delete($id);
		    notify()->flash(trans('status.alerts.deleted'), 'success', ['title'=>trans('alerts.deleted')]);
	    }
	    catch (\Exception $e) {
		    notify()->flash($e->getMessage(), 'error', ['title'=>trans('alerts.error'), 'timer' => 600000]);
	    }
    }
}
