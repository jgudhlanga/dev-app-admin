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
	
	public function update($country, $data)
	{
		return $this->countryRepository->update($country, $data);
	}
	
	public function delete($country)
	{
		return $this->countryRepository->delete($country);
	}
	
	public function count($args = [])
	{
		return $this->countryRepository->count($args);
	}
}