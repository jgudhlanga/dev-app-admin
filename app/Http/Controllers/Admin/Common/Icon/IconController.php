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
	 * @param Icon $icon
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
    public function edit(Icon $icon)
    {
	    if($icon instanceof Icon){
		    return response([
			    'data' => $icon
		    ], Response::HTTP_CREATED);
	    }
	    else{
		    notify()->flash(trans('icons.not_found'), 'error');
	    }
    }
	
	/**
	 * @param Request $request
	 * @param Icon $icon
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
    public function update(Request $request, Icon $icon)
    {
	    try{
		    if($icon instanceof Icon)
		    {
			    if($icon->update($request->all())){
				    notify()->flash(trans('icons.alerts.updated'), 'success', ['title' => trans('alerts.updated')]);
			    }
		    }
		    else{
			    notify()->flash(trans('icons.not_found'), 'error', ['title' => trans('alerts.not_found')]);
		    }
		    return response([
			    'data' => $icon
		    ], Response::HTTP_OK);
	    }
	    catch (\Exception $e)
	    {
		    notify()->flash($e->getMessage(), 'error', ['title'=>trans('alerts.error'), 'timer' => 600000]);
	    }
    }
	
	/**
	 * @param Icon $icon
	 */
    public function destroy(Icon $icon)
    {
	    try{
		    $this->iconService->delete($icon);
		    notify()->flash(trans('icons.alerts.deleted'), 'success', ['title'=>trans('alerts.deleted')]);
	    }
	    catch (\Exception $e) {
		    notify()->flash($e->getMessage(), 'error', ['title'=>trans('alerts.error'), 'timer' => 600000]);
	    }
    }
    
}
