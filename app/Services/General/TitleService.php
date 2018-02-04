<?php

namespace App\Services\General;


use App\Repositories\General\TitleRepository;

class TitleService
{
	/**
	 * @var $titleRepository
	 */
	protected $titleRepository;
	
	/**
	 * TitleService constructor.
	 * @param TitleRepository $titleRepository
	 */
	public function __construct(TitleRepository $titleRepository)
	{
		$this->titleRepository = $titleRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->titleRepository->find($id);
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
		return $this->titleRepository->findBy($args, $paginate, $limit, $orderBy);
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
		return $this->titleRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->titleRepository->create($params);
	}
	
	/**
	 * @param $title
	 * @param $data
	 * @return mixed
	 */
	public function update($title, $data)
	{
		return $this->titleRepository->update($title, $data);
	}
	
	/**
	 * @param $title
	 * @return mixed
	 */
	public function delete($title)
	{
		return $this->titleRepository->delete($title);
	}
	
	/**
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		return $this->titleRepository->count($args);
	}
}