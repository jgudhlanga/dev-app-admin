<?php

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;
use App\Models\General\Status;

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
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('statuses AS s')
			->select('s.*')
			->where('i.id', '>', 0);
		
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$query->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$query->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$query->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$query->orderBy('class', 'asc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		return $query->get();
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
	 * @param $status
	 * @return mixed
	 */
	public function delete($status)
	{
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
	 * @param $status
	 * @param $data
	 * @return mixed
	 */
	public function update($status, $data)
	{
		return $status->update($data);
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
	
	/**
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		$count = $this->status->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$count->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$count->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		return $count->count();
	}
}