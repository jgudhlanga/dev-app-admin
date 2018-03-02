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


/**
 * Class IconController
 * @package App\Http\Controllers\CPanel\General\Icon
 */
class IconController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var IconService
	 */
	protected $iconService;
	
	/**
	 * IconController constructor.
	 * @param IconService $iconService
	 */
	public function __construct(IconService $iconService)
	{
		$this->iconService = $iconService;
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
    {
	    $classes = $this->iconService->findAll(null,null, null, ['id' => 'asc']);
	    $statusActive = $this->getStatusActive();
	    $statusInActive = $this->getStatusInActive();
	    return view('cpanel.general.icons', compact('classes', 'statusActive', 'statusInActive'));
    }
	
	
	/**
	 * @param IconRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function store(IconRequest $request)
    {
	    try{
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
		    ], Response::HTTP_OK);
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
