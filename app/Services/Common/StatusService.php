<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/01/04
 * Time: 09:16 AM
 */

namespace App\Services\Common;


use App\Repositories\Common\StatusRepository;

class StatusService
{
	/**
	 * @var $statusRepository
	 */
	protected $statusRepository;
	
	/**
	 * StatusService constructor.
	 * @param StatusRepository $statusRepository
	 */
	public function __construct(StatusRepository $statusRepository)
	{
		$this->statusRepository = $statusRepository;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id )
	{
		return $this->statusRepository->find($id);
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
		return $this->statusRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	
	/**
	 * @param $params
	 * @return Status
	 */
	public function create($params)
	{
		return $this->statusRepository->create($params);
	}
	
	/**
	 * @param $status
	 * @param $data
	 * @return mixed
	 */
	public function update($status, $data)
	{
		return $this->statusRepository->update($status, $data);
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->statusRepository->delete($id);
	}
	
	/**
	 * @return int
	 */
	public function statusActive()
	{
		return $this->statusRepository->statusActive();
	}
	
	/**
	 * @return int
	 */
	public function statusInActive()
	{
		return $this->statusRepository->statusInActive();
	}
}