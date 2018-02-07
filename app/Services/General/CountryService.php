<?php

namespace App\Services\General;


use App\Repositories\General\CountryRepository;

class CountryService
{
	
	protected $countryRepository;
	
	
	public function __construct(CountryRepository $countryRepository)
	{
		$this->countryRepository = $countryRepository;
	}
	
	public function find( $id )
	{
		return $this->countryRepository->find($id);
	}
	
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->countryRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->countryRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	public function create($params)
	{
		return $this->countryRepository->create($params);
	}
	
	public function update($title, $data)
	{
		return $this->countryRepository->update($title, $data);
	}
	
	public function delete($title)
	{
		return $this->countryRepository->delete($title);
	}
	
	public function count($args = [])
	{
		return $this->countryRepository->count($args);
	}
}