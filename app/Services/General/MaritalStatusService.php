<?php

namespace App\Services\General;


use App\Repositories\General\MaritalStatusRepository;

class MaritalStatusService
{
	/**
	 * @var $maritalStatusRepository
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
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->maritalStatusRepository->findBy($args, $paginate, $limit, $orderBy);
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
		return $this->maritalStatusRepository->findAll($args, $paginate, $limit, $orderBy);
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
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		return $this->maritalStatusRepository->count($args);
	}
}