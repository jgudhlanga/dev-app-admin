<?php

namespace App\Services\General;

use App\Repositories\General\MemberTypeRepository;

/**
 * Class MemberTypeService
 * @package App\Services\General
 */
class MemberTypeService
{
	
	/**
	 * @var MemberTypeRepository
	 */
	protected $memberTypeRepository;
	
	
	/**
	 * MemberTypeService constructor.
	 * @param MemberTypeRepository $memberTypeRepository
	 */
	public function __construct(MemberTypeRepository $memberTypeRepository)
	{
		$this->memberTypeRepository = $memberTypeRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->memberTypeRepository->find($id);
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
		return $this->memberTypeRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->memberTypeRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->memberTypeRepository->create($params);
	}
	
	/**
	 * @param $title
	 * @param $data
	 * @return mixed
	 */
	public function update($title, $data)
	{
		return $this->memberTypeRepository->update($title, $data);
	}
	
	/**
	 * @param $title
	 * @return mixed
	 */
	public function delete($title)
	{
		return $this->memberTypeRepository->delete($title);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->memberTypeRepository->count($where);
	}
}