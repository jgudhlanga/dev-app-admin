<?php

namespace App\Services\Modules;

use App\Repositories\Modules\PageRepository;
use App\Models\Modules\Page;

/**
 * Class PageService
 * @package App\Services\Modules
 */
class PageService
{
	/**
	 * @var PageRepository
	 */
	protected $pageRepository;
	
	/**
	 * PageService constructor.
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
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll( $where=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->pageRepository->findAll($where, $paginate, $limit);
	}
	
	/**
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns=[], $where=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->pageRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
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
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->pageRepository->count($where);
	}
}

