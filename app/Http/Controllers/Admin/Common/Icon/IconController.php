<?php

namespace App\Http\Controllers\Admin\Common\Icon;

use App\Http\Requests\Admin\Common\IconRequest;
use App\Models\Common\Icon;
use App\Services\Common\IconService;
use App\Services\Common\StatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class IconController extends Controller
{
	/**
	 * @var IconService
	 */
	protected $iconService;
	/**
	 * @var StatusService
	 */
	protected $statusService;
	
	/**
	 * IconController constructor.
	 * @param IconService $iconService
	 * @param StatusService $statusService
	 */
	public function __construct(IconService $iconService, StatusService $statusService)
	{
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
	    $classes = $this->iconService->findAll(null,null, null, ['id' => 'asc']);
	    $statusActive = $this->statusService->statusActive();
	    $statusInActive = $this->statusService->statusInActive();
	    return view('admin.common.icons', compact('classes', 'statusActive', 'statusInActive'));
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
	
	/**
	 * @param IconRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function store(IconRequest $request)
    {
	    try{
		    //validation here
		    DB::beginTransaction();
		    $created = $this->iconService->create($request->all());
		    if($created instanceof Icon) {
			    $message = trans('icons.alerts.success');
			    $icon = $created;
			    $status = Response::HTTP_CREATED;
		    }
		    else{
			    $message = trans('icons.alerts.error');
			    $icon = null;
			    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
		    }
		    DB::commit();
		    
		    return response()->json(['data' => $icon, 'message' => $message], $status);
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
	    $class = $this->iconService->find($id);
	    if($class instanceof Icon){
		    return response([
			    'data' => $class
		    ], Response::HTTP_CREATED);
	    }
	    else{
		    notify()->flash(trans('icons.not_found'), 'error');
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
		    $class = $this->iconService->find($id);
		    if($class instanceof Icon)
		    {
			    if($class->update($request->all())){
				    notify()->flash(trans('icons.alerts.updated'), 'success', ['title' => trans('alerts.updated')]);
			    }
		    }
		    else{
			    notify()->flash(trans('icons.not_found'), 'error', ['title' => trans('alerts.not_found')]);
		    }
		    return response([
			    'data' => $class
		    ], Response::HTTP_OK);
	    }
	    catch (\Exception $e)
	    {
		    notify()->flash($e->getMessage(), 'error', ['title'=>trans('alerts.error'), 'timer' => 600000]);
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    try{
		    $this->iconService->delete($id);
		    notify()->flash(trans('icons.alerts.deleted'), 'success', ['title'=>trans('alerts.deleted')]);
	    }
	    catch (\Exception $e) {
		    notify()->flash($e->getMessage(), 'error', ['title'=>trans('alerts.error'), 'timer' => 600000]);
	    }
    }
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function changeStatus(Request $request)
	{
		try
		{
			//DB::beginTransaction();
			$status = $request->status_id;
			$id = $request->class_id;
			$class = $this->iconService->changeStatus($id, $status);
			DB::commit();
			$message = ($class->status_id == $this->statusService->statusActive()) ? 'icons.alerts.reactivated' : 'icons.alerts.deactivated';
			$title = ($class->status_id == $this->statusService->statusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['class' => $class, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
			
		}
		catch (\Exception $e)
		{
			DB:rollback();
			notify()->flash(trans($e->getMessage()), 'error', ['title'=>trans('alerts.error')]);
		}
	}
}
