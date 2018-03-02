<?php

namespace App\Services\General;


use App\Repositories\General\MaritalStatusRepository;

/**
 * Class MaritalStatusService
 * @package App\Services\General
 */
class MaritalStatusService
{
	/**
	 * @var MaritalStatusRepository
	 */
	protected $maritalStatusRepository;
	
	/**
	 * MaritalStatusService constructor.
	 * @param MaritalStatusRepository $maritalStatusRepository
	 */
	public function __construct(MaritalStatusRepository $maritalStatusRepository)
	{
		$this->maritalStatusRepository = $maritalStatusRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->maritalStatusRepository->find($id);
	}
	
	/**
	 * @param $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns, $where=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->maritalStatusRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->maritalStatusRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->maritalStatusRepository->create($params);
	}
	
	/**
	 * @param $maritalStatus
	 * @param $data
	 * @return mixed
	 */
	public function update($maritalStatus, $data)
	{
		return $this->maritalStatusRepository->update($maritalStatus, $data);
	}
	
	/**
	 * @param $maritalStatus
	 * @return mixed
	 */
	public function delete($maritalStatus)
	{
		return $this->maritalStatusRepository->delete($maritalStatus);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->maritalStatusRepository->count($where);
	}
}