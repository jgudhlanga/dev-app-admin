<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Modules\PageRequest;
use App\Models\Modules\Page;
use App\Services\Common\IconService;
use App\Services\Common\StatusService;
use App\Services\Modules\PageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
	/**
	 * @var $pageService
	 */
	protected $pageService;
	
	/**
	 * @var $iconService
	 */
	protected $iconService;
	
	/**
	 * @var
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
	
	
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }
	
	/**
	 * @param PageRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws Exception
	 */
    public function store(PageRequest $request)
    {
	    try{
		    //validation here
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
		    DB::rollback();
		    throw new \Exception($e->getMessage());
	    }
    }

   
    public function show(Page $page)
    {
        //
    }
	
	/**
	 * @param Page $page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function edit(Page $page)
    {
	    $icons = $this->iconService->findAll();
	    return view('admin.modules.edit-page', compact('page','icons'));
    }

    
    public function update(Request $request, Page $page)
    {
	    try{
		    //validation here
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
		    DB::rollback();
		    throw new \Exception($e->getMessage());
	    }
    }
	
	/**
	 * @param Page $page
	 * @throws Exception
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
