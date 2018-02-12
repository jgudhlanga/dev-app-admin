<?php

namespace App\Services\General;


use App\Repositories\General\MemberTypeRepository;

class MemberTypeService
{
	
	protected $memberTypeRepository;
	
	
	public function __construct(MemberTypeRepository $memberTypeRepository)
	{
		$this->memberTypeRepository = $memberTypeRepository;
	}
	
	public function find( $id )
	{
		return $this->memberTypeRepository->find($id);
	}
	
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->memberTypeRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->memberTypeRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	public function create($params)
	{
		return $this->memberTypeRepository->create($params);
	}
	
	public function update($title, $data)
	{
		return $this->memberTypeRepository->update($title, $data);
	}
	
	public function delete($title)
	{
		return $this->memberTypeRepository->delete($title);
	}
	
	public function count($args = [])
	{
		return $this->memberTypeRepository->count($args);
	}
}