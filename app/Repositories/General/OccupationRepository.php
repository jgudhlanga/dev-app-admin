<?php

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;
use App\Models\General\Occupation;

/**
 * Class OccupationRepository
 * @package App\Repositories\General
 */
class OccupationRepository implements RepositoryInterface
{
	
	/**
	 * @var Occupation
	 */
	protected $occupation;
	
	
	/**
	 * OccupationRepository constructor.
	 * @param Occupation $occupation
	 */
	public function __construct(Occupation $occupation)
	{
		$this->occupation = $occupation;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->occupation->where('id', $id)->first();
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
		
		$query = DB::table('occupations AS o')->leftJoin('statuses AS s', 's.id', '=', 'o.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "o.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('o.*', 's.title as status');
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
		
		// Paginate if we need to
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
		$occupations = $this->occupation->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$occupations->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$occupations->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$occupations->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$occupations->orderBy('created_at', 'desc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$occupations->paginate($paginate);
		}
		
		return $occupations->get();
	}
	
	/**
	 * @param $occupation
	 * @return mixed
	 */
	public function delete($occupation)
	{
		return $occupation->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->occupation->getTableColumns();
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
		$created = Occupation::create($data);
		return $created;
	}
	
	/**
	 * @param $occupation
	 * @param $data
	 * @return mixed
	 */
	public function update($occupation, $data)
	{
		$occupation->update($data);
		return $occupation;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->occupation->where('id', '>', 0);
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