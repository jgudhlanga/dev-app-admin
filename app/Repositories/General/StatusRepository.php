<?php

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;
use App\Models\General\Status;

/**
 * Class StatusRepository
 * @package App\Repositories\General
 */
class StatusRepository implements RepositoryInterface
{
	
	/**
	 * @var Status
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
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns=[], $where=[], $paginate=null, $limit=null, $orderBy=null )
	{
		
		$query = DB::table('statuses AS s');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "s.{$column},";
			}
			$query->select(rtrim(',', $cols));
		} else {
			$query->select('s.*');
		}
		
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$query->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$query->where(array_keys($where)[$i], '=', array_values($where)[$i]);
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
		
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		return $query->get();
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
		$statuses = $this->status->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$statuses->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$statuses->where(array_keys($where)[$i], '=', array_values($where)[$i]);
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
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->status->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$count->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$count->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		return $count->count();
	}
}