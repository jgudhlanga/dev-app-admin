<?php

namespace App\Services\General;


use App\Models\General\Icon;
use App\Repositories\General\IconRepository;

class IconService
{
	/**
	 * @var $iconRepository
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
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->iconRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->iconRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	
	/**
	 * @param $params
	 * @return Icon
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
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		return $this->iconRepository->count($args);
	}
}