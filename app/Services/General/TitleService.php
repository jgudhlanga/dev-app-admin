<?php

namespace App\Services\General;


use App\Repositories\General\TitleRepository;

/**
 * Class TitleService
 * @package App\Services\General
 */
class TitleService
{
	/**
	 * @var TitleRepository
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
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns=[], $where=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->titleRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->titleRepository->findAll($where, $paginate, $limit, $orderBy);
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
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->titleRepository->count($where);
	}
}