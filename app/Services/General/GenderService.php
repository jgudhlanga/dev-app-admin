<?php

namespace App\Services\General;


use App\Repositories\General\GenderRepository;

class GenderService
{
	
	protected $genderRepository;
	
	public function __construct(GenderRepository $genderRepository)
	{
		$this->genderRepository = $genderRepository;
	}
	
	public function find( $id )
	{
		return $this->genderRepository->find($id);
	}
	
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->genderRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->genderRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	
	public function create($params)
	{
		return $this->genderRepository->create($params);
	}
	
	public function update($gender, $data)
	{
		return $this->genderRepository->update($gender, $data);
	}
	
	public function delete($gender)
	{
		return $this->genderRepository->delete($gender);
	}
	
	public function count($args = [])
	{
		return $this->genderRepository->count($args);
	}
}