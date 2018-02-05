<?php

namespace App\Services\General;


use App\Repositories\General\OccupationRepository;

class OccupationService
{
	
	protected $occupationRepository;
	
	public function __construct(OccupationRepository $occupationRepository)
	{
		$this->occupationRepository = $occupationRepository;
	}
	
	public function find( $id )
	{
		return $this->occupationRepository->find($id);
	}
	
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->occupationRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->occupationRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	public function create($params)
	{
		return $this->occupationRepository->create($params);
	}
	
	public function update($occupation, $data)
	{
		return $this->occupationRepository->update($occupation, $data);
	}
	
	public function delete($occupation)
	{
		return $this->occupationRepository->delete($occupation);
	}
	
	public function count($args = [])
	{
		return $this->occupationRepository->count($args);
	}
}