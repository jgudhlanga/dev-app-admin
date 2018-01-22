<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/01/07
 * Time: 07:35 AM
 */

namespace App\Services\Common;


use App\Models\Common\Icon;
use App\Repositories\Common\IconRepository;

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
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->iconRepository->delete($id);
	}
	
	/**
	 * @param $id
	 * @param $status
	 * @return mixed
	 */
	public function changeStatus($id, $status)
	{
		return $this->iconRepository->changeStatus($id, $status);
	}
}