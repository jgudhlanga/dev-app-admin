<?php

namespace App\Http\Controllers\CPanel\General\Icon;

use App\Http\Requests\CPanel\General\IconRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\Icon;
use App\Services\General\IconService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class IconController extends Controller
{
	use CommonTrait;
	
	protected $iconService;
	
	public function __construct(IconService $iconService)
	{
		$this->iconService = $iconService;
	}
	
    public function index()
    {
	    $classes = $this->iconService->findAll(null,null, null, ['id' => 'asc']);
	    $statusActive = $this->getStatusActive();
	    $statusInActive = $this->getStatusInActive();
	    return view('cpanel.general.icons', compact('classes', 'statusActive', 'statusInActive'));
    }
    
	
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
			    $messages = trans('icons.alerts.error');
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
	
    
    public function edit(Icon $icon)
    {
	    if($icon instanceof Icon){
		    return response([
			    'data' => $icon
		    ], Response::HTTP_OK);
	    }
	    else{
		    notify()->flash(trans('icons.not_found'), 'error');
	    }
    }
    
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
