<?php

namespace App\Http\Controllers\CPanel\General\Title;

use App\Http\Requests\CPanel\General\TitleRequest;
use App\Http\Traits\General\CommonTrait;
use App\Models\General\Title;
use App\Services\General\TitleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

class TitleController extends Controller
{
	use CommonTrait;
	
	protected $titleService;
	
   public function __construct(TitleService $titleService)
   {
   	$this->titleService = $titleService;
   }
	
	public function index()
    {
	    $titles =$this->titleService->findAll(null, null, null, ['name' => 'asc']);
	    $statusActive = $this->getStatusActive();
	    $statusInActive = $this->getStatusInActive();
	    return view('cpanel.general.titles', compact('titles', 'statusActive', 'statusInActive'));
    }
    
    public function store(TitleRequest $request)
    {
	    try{
		    DB::beginTransaction();
		    $data = $request->all();
		    $data['created_by'] = Auth::id();
		    $title = $this->titleService->create($data);
		    if($title instanceof Title) {
			    $created = $title;
			    $status = Response::HTTP_CREATED;
			    $message = trans('titles.alerts.created');
		    }
		    else{
			    $created = null;
			    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
			    $message = trans('titles.alerts.error');
		    }
		    DB::commit();
		    return response()->json(['title' => $created, 'message' => $message], $status);
	    }
	    catch (\Exception $e)
	    {
		    DB::rollback();
		    throw new \Exception($e->getMessage());
	    }
    }
    
    public function edit(Title $title)
    {
	    if($title instanceof Title){
		    return response([
			    'data' => $title
		    ], Response::HTTP_OK);
	    }
	    else{
		    notify()->flash(trans('titles.not_found'), 'error');
	    }
    }

    public function update(Request $request, Title $title)
    {
	    try{
		    DB::beginTransaction();
		    $data = $request->all();
		    $data['updated_by'] = Auth::id();
		    $title = $this->titleService->update($title, $data);
		    if($title instanceof Title) {
			    $updated = $title;
			    $status = Response::HTTP_CREATED;
			    $message = trans('titles.alerts.updated');
		    }
		    else{
			    $updated = null;
			    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
			    $message = trans('titles.alerts.error');
		    }
		    DB::commit();
		    return response()->json(['title' => $updated, 'message' => $message], $status);
	    }
	    catch (\Exception $e)
	    {
		    DB::rollback();
		    throw new \Exception($e->getMessage());
	    }
    }
	
    public function destroy(Title $title)
    {
	    try{
		    $this->titleService->delete($title);
	    }
	    catch (\Exception $e) {
		    throw new \Exception($e->getMessage());
	    }
    }
}
