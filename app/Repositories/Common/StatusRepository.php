<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/01/04
 * Time: 09:18 AM
 */

namespace App\Repositories\Common;


use App\Contracts\RepositoryInterface;
use App\Models\Common\Status;

class StatusRepository implements RepositoryInterface
{
	/**
	 * @var $status
	 */
	protected $status;
	
	/**
	 * StatusRepository constructor.
	 * @param Status $status
	 */
	public function __construct(Status $status)
	{
		$this->status = $status;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->status->where('id', $id)->first();
	}
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param bool $single
	 * @return Status
	 */
	public function findBy($args=[], $paginate=null, $single=false )
	{
		return $this->status;
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
		$statuses = $this->status->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$statuses->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$statuses->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$statuses->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$statuses->orderBy('created_at', 'desc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$statuses->paginate($paginate);
		}
		
		return $statuses->get();
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		$status = $this->find($id);
		return $status->delete();
	}
	
	
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->status->getTableColumns();
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		$columns = $this->getTableColumns();
		$data = [];
		foreach ( $columns as $column ) {
			if($column == 'id' || $column == 'created_at'|| $column == 'updated_at' || $column == 'status_id' ) {
				continue;
			}
			$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
		}
		$created = Status::create($data);
		return $created;
	}
	
	/**
	 * @return int
	 */
	public function statusActive()
	{
		return Status::ACTIVE;
	}
	/**
	 * @return int
	 */
	public function statusInActive()
	{
		return Status::INACTIVE;
	}
}