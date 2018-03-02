<?php

namespace App\Services\General;

use App\Repositories\General\RaceRepository;

/**
 * Class RaceService
 * @package App\Services\General
 */
class RaceService
{
	
	/**
	 * @var RaceRepository
	 */
	protected $raceRepository;
	
	/**
	 * RaceService constructor.
	 * @param RaceRepository $raceRepository
	 */
	public function __construct(RaceRepository $raceRepository)
	{
		$this->raceRepository = $raceRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->raceRepository->find($id);
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
		return $this->raceRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->raceRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->raceRepository->create($params);
	}
	
	/**
	 * @param $title
	 * @param $data
	 * @return mixed
	 */
	public function update($title, $data)
	{
		return $this->raceRepository->update($title, $data);
	}
	
	/**
	 * @param $title
	 * @return mixed
	 */
	public function delete($title)
	{
		return $this->raceRepository->delete($title);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->raceRepository->count($where);
	}
}