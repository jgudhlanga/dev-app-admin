<?php

namespace App\Http\Controllers\CPanel\General\Title\Api;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Title;
use App\Services\General\TitleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class TitleController
 * @package App\Http\Controllers\CPanel\General\Title\Api
 */
class TitleController extends Controller
{
	use CommonTrait;
	
	/**
	 * @var TitleService
	 */
	protected $titleService;
	
	/**
	 * TitleController constructor.
	 * @param TitleService $titleService
	 */
	public function __construct(TitleService $titleService)
	{
		$this->titleService = $titleService;
	}
	
	
	/**
	 * @param Request $request
	 * @param Title $title
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function changeStatus(Request $request, Title $title)
	{
		try
		{
			DB::beginTransaction();
			$status = ($title->status_id == $this->getStatusActive()) ? $this->getStatusInActive() : $this->getStatusActive();
			$title = $this->titleService->update($title, ['status_id' => $status]);
			DB::commit();
			$message = ($title->status_id == $this->getStatusActive()) ? 'titles.alerts.reactivated' : 'titles.alerts.deactivated';
			$title = ($title->status_id == $this->getStatusActive()) ? 'alerts.reactivated' : 'alerts.deactivated';
			return response()->json(['data' => $title, 'message' => trans($message), 'title' => trans($title)], Response::HTTP_OK);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
 
}
