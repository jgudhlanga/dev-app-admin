<?php

namespace App\Http\Controllers\CPanel\General\Status;

use App\Http\Requests\CPanel\General\StatusRequest;
use App\Models\General\Status;
use App\Services\General\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StatusController
 * @package App\Http\Controllers\CPanel\General\Status
 */
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
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
    {
    	$statuses = $this->statusService->findAll(null,null, null, ['id' => 'asc']);
	    return view('cpanel.general.status', compact('statuses'));
    }
	
	/**
	 * @param StatusRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
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
		    throw new \Exception($e->getMessage());
	    }
    }
	
	/**
	 * @param Status $status
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
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
	
	/**
	 * @param Request $request
	 * @param Status $status
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
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
	
	/**
	 * @param Status $status
	 */
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
