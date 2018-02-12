<?php

namespace App\Services\General;


use App\Repositories\General\AddressTypeRepository;

class AddressTypeService
{
	
	protected $addressTypeRepository;
	
	public function __construct(AddressTypeRepository $addressTypeRepository)
	{
		$this->addressTypeRepository = $addressTypeRepository;
	}
	
	public function find( $id )
	{
		return $this->addressTypeRepository->find($id);
	}
	
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->addressTypeRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->addressTypeRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	public function create($params)
	{
		return $this->addressTypeRepository->create($params);
	}
	
	public function update($addressType, $data)
	{
		return $this->addressTypeRepository->update($addressType, $data);
	}
	
	public function delete($addressType)
	{
		return $this->addressTypeRepository->delete($addressType);
	}
	
	public function count($args = [])
	{
		return $this->addressTypeRepository->count($args);
	}
}