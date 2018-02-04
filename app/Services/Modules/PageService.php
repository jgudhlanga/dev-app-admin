<?php

namespace App\Services\Modules;

use App\Repositories\Modules\PageRepository;
use App\Models\Modules\Page;

class PageService
{
	/**
	 * @var $pageRepository
	 */
	protected $pageRepository;
	
	/**
	 * ModuleService constructor.
	 * @param PageRepository $pageRepository
	 */
	public function __construct(PageRepository $pageRepository)
	{
		$this->pageRepository = $pageRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->pageRepository->find($id);
	}
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->pageRepository->findAll($args, $paginate, $limit);
	}
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->pageRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return Page
	 */
	public function create($params)
	{
		$page =  $this->pageRepository->create($params);
		return $this->positionPage($page);
	}
	
	/**
	 * @param $page
	 * @param $data
	 * @return mixed
	 */
	public function update($page, $data)
	{
		return $this->pageRepository->update($page, $data);
	}
	
	/**
	 * @param $page
	 * @return mixed
	 */
	public function delete($page)
	{
		return $this->pageRepository->delete($page);
	}
	
	
	/**
	 * @param $page
	 * @return mixed
	 */
	public function positionPage($page)
	{
		return $this->pageRepository->positionPage($page);
	}
	
	/**
	 * @param $page
	 * @param $direction
	 * @return mixed
	 */
	public function orderPages($page, $direction)
	{
		return $this->pageRepository->orderPages($page, $direction);
	}
	
	/**
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		return $this->pageRepository->count($args);
	}
}

