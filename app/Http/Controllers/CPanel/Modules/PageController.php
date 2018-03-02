<?php

namespace App\Http\Controllers\CPanel\Modules;

use App\Http\Requests\CPanel\Modules\PageRequest;
use App\Models\Modules\Page;
use App\Services\General\IconService;
use App\Services\General\StatusService;
use App\Services\Modules\PageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PageController
 * @package App\Http\Controllers\CPanel\Modules
 */
class PageController extends Controller
{
	/**
	 * @var PageService
	 */
	protected $pageService;
	
	/**
	 * @var IconService
	 */
	protected $iconService;
	
	/**
	 * @var StatusService
	 */
	protected $statusService;
	
	/**
	 * PageController constructor.
	 * @param PageService $pageService
	 * @param IconService $iconService
	 * @param StatusService $statusService
	 */
	public function __construct(PageService $pageService, IconService $iconService, StatusService $statusService)
	{
		$this->pageService = $pageService;
		$this->iconService = $iconService;
		$this->statusService = $statusService;
	}
	
	/**
	 * @param PageRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function store(PageRequest $request)
    {
	    try{
		    DB::beginTransaction();
		    $data = $request->all();
		    $data['created_by'] = Auth::id();
		    $page = $this->pageService->create($data);
		    if($page instanceof Page) {
			    $created = $page;
			    $status = Response::HTTP_CREATED;
			    $message = trans('modules.pages.alerts.created');
		    }
		    else{
			    $created = null;
			    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
			    $message = trans('modules.pages.alerts.error');
		    }
		    DB::commit();
		    return response()->json(['page' => $created, 'message' => $message], $status);
	    }
	    catch (\Exception $e)
	    {
		    throw new \Exception($e->getMessage());
	    }
    }
	
	/**
	 * @param Page $page
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(Page $page)
    {
	    if($page instanceof Page){
		    return response([
			    'data' => $page
		    ], Response::HTTP_OK);
	    }
	    else{
		    notify()->flash(trans('modules.pages.not_found'), 'error');
	    }
    }
	
	/**
	 * @param Request $request
	 * @param Page $page
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function update(Request $request, Page $page)
    {
	    try{
		    DB::beginTransaction();
		    $data = $request->all();
		    $data['updated_by'] = Auth::id();
		    $page = $this->pageService->update($page, $data);
		    if($page instanceof Page) {
			    $updated = $page;
			    $status = Response::HTTP_CREATED;
			    $message = trans('modules.pages.alerts.updated');
		    }
		    else{
			    $updated = null;
			    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
			    $message = trans('modules.pages.alerts.error');
		    }
		    DB::commit();
		    return response()->json(['page' => $updated, 'message' => $message], $status);
	    }
	    catch (\Exception $e)
	    {
		    throw new \Exception($e->getMessage());
	    }
    }
	
	/**
	 * @param Page $page
	 * @throws \Exception
	 */
	public function destroy(Page $page)
    {
	    try{
		    $this->pageService->delete($page);
	    }
	    catch (\Exception $e) {
		    throw new \Exception($e->getMessage());
	    }
    }
}
