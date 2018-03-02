<?php

namespace App\Services\General;


use App\Repositories\General\OccupationRepository;

/**
 * Class OccupationService
 * @package App\Services\General
 */
class OccupationService
{
	
	/**
	 * @var OccupationRepository
	 */
	protected $occupationRepository;
	
	/**
	 * OccupationService constructor.
	 * @param OccupationRepository $occupationRepository
	 */
	public function __construct(OccupationRepository $occupationRepository)
	{
		$this->occupationRepository = $occupationRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->occupationRepository->find($id);
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
		return $this->occupationRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->occupationRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->occupationRepository->create($params);
	}
	
	/**
	 * @param $occupation
	 * @param $data
	 * @return mixed
	 */
	public function update($occupation, $data)
	{
		return $this->occupationRepository->update($occupation, $data);
	}
	
	/**
	 * @param $occupation
	 * @return mixed
	 */
	public function delete($occupation)
	{
		return $this->occupationRepository->delete($occupation);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->occupationRepository->count($where);
	}
}