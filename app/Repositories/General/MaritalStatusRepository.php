<?php

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;
use App\Models\General\MaritalStatus;

/**
 * Class MaritalStatusRepository
 * @package App\Repositories\General
 */
class MaritalStatusRepository implements RepositoryInterface
{
	
	/**
	 * @var MaritalStatus
	 */
	protected $maritalStatus;
	
	/**
	 * MaritalStatusRepository constructor.
	 * @param MaritalStatus $maritalStatus
	 */
	public function __construct(MaritalStatus $maritalStatus)
	{
		$this->maritalStatus = $maritalStatus;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->maritalStatus->where('id', $id)->first();
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
		$query = DB::table('marital_statuses AS ms')->leftJoin('statuses AS s', 's.id', '=', 'ms.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "ms.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('ms.*', 's.title as status');
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
			$query->orderBy('name', 'asc')->take($limit);
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
		$maritalStatuses = $this->maritalStatus->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$maritalStatuses->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$maritalStatuses->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$maritalStatuses->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$maritalStatuses->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$maritalStatuses->paginate($paginate);
		}
		
		return $maritalStatuses->get();
	}
	
	/**
	 * @param $maritalStatus
	 * @return mixed
	 */
	public function delete($maritalStatus)
	{
		return $maritalStatus->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->maritalStatus->getTableColumns();
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
		$created = MaritalStatus::create($data);
		return $created;
	}
	
	/**
	 * @param $maritalStatus
	 * @param $data
	 * @return mixed
	 */
	public function update($maritalStatus, $data)
	{
		$maritalStatus->update($data);
		return $maritalStatus;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->maritalStatus->where('id', '>', 0);
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