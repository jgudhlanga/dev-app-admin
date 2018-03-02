<?php

namespace App\Services\General;


use App\Repositories\General\CountryRepository;

/**
 * Class CountryService
 * @package App\Services\General
 */
class CountryService
{
	
	/**
	 * @var CountryRepository
	 */
	protected $countryRepository;
	
	
	/**
	 * CountryService constructor.
	 * @param CountryRepository $countryRepository
	 */
	public function __construct(CountryRepository $countryRepository)
	{
		$this->countryRepository = $countryRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->countryRepository->find($id);
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
		return $this->countryRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->countryRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->countryRepository->create($params);
	}
	
	/**
	 * @param $country
	 * @param $data
	 * @return mixed
	 */
	public function update($country, $data)
	{
		return $this->countryRepository->update($country, $data);
	}
	
	/**
	 * @param $country
	 * @return mixed
	 */
	public function delete($country)
	{
		return $this->countryRepository->delete($country);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->countryRepository->count($where);
	}
}