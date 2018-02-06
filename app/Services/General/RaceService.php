<?php

namespace App\Services\General;

use App\Repositories\General\RaceRepository;

class RaceService
{
	
	protected $raceRepository;
		
	public function __construct(RaceRepository $raceRepository)
	{
		$this->raceRepository = $raceRepository;
	}
	
	public function find( $id )
	{
		return $this->raceRepository->find($id);
	}
	
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->raceRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->raceRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	public function create($params)
	{
		return $this->raceRepository->create($params);
	}
	
	public function update($title, $data)
	{
		return $this->raceRepository->update($title, $data);
	}
	
	public function delete($title)
	{
		return $this->raceRepository->delete($title);
	}
	
	public function count($args = [])
	{
		return $this->raceRepository->count($args);
	}
}