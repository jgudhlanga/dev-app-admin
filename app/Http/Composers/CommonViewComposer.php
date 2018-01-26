<?php

namespace App\Http\Composers;

use App\Services\Modules\ModuleService;
use Illuminate\Contracts\View\View;


class CommonViewComposer
{
	/**
	 * @var
	 */
	protected $moduleService;
	
	public function __construct(ModuleService $moduleService)
	{
		$this->moduleService = $moduleService;
	}
	
	public function compose(View $view)
	{
		$data = [
			'modules' => $this->moduleService->findAll(null, null, null, ['position' => 'asc'])
		];
		$view->with($data);
	}
}