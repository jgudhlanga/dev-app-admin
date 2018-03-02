<?php

namespace App\Services\General;


use App\Repositories\General\GenderRepository;

/**
 * Class GenderService
 * @package App\Services\General
 */
class GenderService
{
	
	/**
	 * @var GenderRepository
	 */
	protected $genderRepository;
	
	/**
	 * GenderService constructor.
	 * @param GenderRepository $genderRepository
	 */
	public function __construct(GenderRepository $genderRepository)
	{
		$this->genderRepository = $genderRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->genderRepository->find($id);
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
		return $this->genderRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->genderRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->genderRepository->create($params);
	}
	
	/**
	 * @param $gender
	 * @param $data
	 * @return mixed
	 */
	public function update($gender, $data)
	{
		return $this->genderRepository->update($gender, $data);
	}
	
	/**
	 * @param $gender
	 * @return mixed
	 */
	public function delete($gender)
	{
		return $this->genderRepository->delete($gender);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->genderRepository->count($where);
	}
}