<?php

namespace App\Services\General;


use App\Models\General\Icon;
use App\Repositories\General\IconRepository;

/**
 * Class IconService
 * @package App\Services\General
 */
class IconService
{
	/**
	 * @var IconRepository
	 */
	protected $iconRepository;
	
	/**
	 * IconService constructor.
	 * @param IconRepository $iconRepository
	 */
	public function __construct(IconRepository $iconRepository)
	{
		$this->iconRepository = $iconRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->iconRepository->find($id);
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
		return $this->iconRepository->findBy($columns, $where, $paginate, $limit, $orderBy);
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
		return $this->iconRepository->findAll($where, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		return $this->iconRepository->create($params);
	}
	
	/**
	 * @param $icon
	 * @param $data
	 * @return mixed
	 */
	public function update($icon, $data)
	{
		return $this->iconRepository->update($icon, $data);
	}
	
	/**
	 * @param $icon
	 * @return mixed
	 */
	public function delete($icon)
	{
		return $this->iconRepository->delete($icon);
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		return $this->iconRepository->count($where);
	}
}