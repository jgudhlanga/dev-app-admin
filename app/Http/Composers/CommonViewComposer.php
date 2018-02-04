<?php

namespace App\Http\Composers;

use App\Http\Traits\General\CommonTrait;
use App\Models\General\Status;
use App\Services\Modules\ModuleService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;


class CommonViewComposer
{
	use CommonTrait;
	
	protected $moduleService;
	
	public function __construct(ModuleService $moduleService)
	{
		$this->moduleService = $moduleService;
	}
	
	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		$systemModules = $this->moduleService->findAll(['status_id' => $this->getStatusActive()], null, null, ['position' => 'asc']);
		
		$modulesArray = [];
		
		if(count($systemModules) > 0)
		{
			foreach ($systemModules as $module)
			{
				array_push($modulesArray, strtolower($module->title));
			}
		}
		
		$currentModule = Request::segment(1);
		if((!empty($currentModule)) && (!in_array(strtolower($currentModule), $modulesArray))){
			$currentModule = 'cpanel';
		}
		
		$data = [
			'systemModules' => $systemModules,
			'currentModule' => $currentModule,
		];
		$view->with($data);
	}
	
}