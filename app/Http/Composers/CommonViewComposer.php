<?php

namespace App\Http\Composers;

use App\Models\Common\Status;
use App\Services\Modules\ModuleService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;


class CommonViewComposer
{
	/**
	 * @var
	 */
	protected $moduleService;
	
	/**
	 * CommonViewComposer constructor.
	 * @param ModuleService $moduleService
	 */
	public function __construct(ModuleService $moduleService)
	{
		$this->moduleService = $moduleService;
	}
	
	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		$systemModules = $this->moduleService->findAll(['status_id' => Status::ACTIVE], null, null, ['position' => 'asc']);
		$modulesArray = [];
		
		if(count($systemModules) > 0)
		{
			foreach ($systemModules as $module)
			{
				array_push($modulesArray, strtolower($module->title));
			}
		}
		
		$currentModule = Request::segment(1);
		if(!in_array(strtolower($currentModule), $modulesArray)){
			$currentModule = 'admin';
		}
		
		$data = [
			'systemModules' => $systemModules,
			'currentModule' => $currentModule,
		];
		$view->with($data);
	}
	
}