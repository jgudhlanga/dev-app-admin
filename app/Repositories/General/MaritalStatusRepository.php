<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/02/02
 * Time: 06:04 PM
 */

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;
use App\Models\General\MaritalStatus;

class MaritalStatusRepository implements RepositoryInterface
{
	/**
	 * @var $maritalStatus
	 */
	protected $maritalStatus;
	
	
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
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('marital_statuses AS ms')
			->leftJoin('statuses AS s', 's.id', '=', 'ms.status_id' )
			->select('ms.*', 's.title as status')
			->where('ms.id', '>', 0);
		
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
			$query->orderBy('name', 'asc')->take($limit);
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
		$maritalStatuss = $this->maritalStatus->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$maritalStatuss->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$maritalStatuss->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$maritalStatuss->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$maritalStatuss->orderBy('created_at', 'desc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$maritalStatuss->paginate($paginate);
		}
		
		return $maritalStatuss->get();
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
	 * @param array $args
	 * @return mixed
	 */
	public function count($args = [])
	{
		$count = $this->maritalStatus->where('id', '>', 0);
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