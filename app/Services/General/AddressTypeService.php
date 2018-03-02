<?php

namespace App\Services\General;


use App\Repositories\General\AddressTypeRepository;

/**
 * Class AddressTypeService
 * @package App\Services\General
 */
class AddressTypeService
{
	
	/**
	 * @var AddressTypeRepository
	 */
	protected $addressTypeRepository;
	
	/**
	 * AddressTypeService constructor.
	 * @param AddressTypeRepository $addressTypeRepository
	 */
	public function __construct(AddressTypeRepository $addressTypeRepository)
	{
		$this->addressTypeRepository = $addressTypeRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->addressTypeRepository->find($id);
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
		return $this->addressTypeRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->addressTypeRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->addressTypeRepository->create($params);
	}
	
	/**
	 * @param $addressType
	 * @param $data
	 * @return mixed
	 */
	public function update($addressType, $data)
	{
		return $this->addressTypeRepository->update($addressType, $data);
	}
	
	/**
	 * @param $addressType
	 * @return mixed
	 */
	public function delete($addressType)
	{
		return $this->addressTypeRepository->delete($addressType);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->addressTypeRepository->count($where);
	}
}