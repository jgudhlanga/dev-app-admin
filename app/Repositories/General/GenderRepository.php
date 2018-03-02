<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\Gender;


/**
 * Class GenderRepository
 * @package App\Repositories\General
 */
class GenderRepository implements RepositoryInterface
{
	
	/**
	 * @var Gender
	 */
	protected $gender;
	
	
	/**
	 * GenderRepository constructor.
	 * @param Gender $gender
	 */
	public function __construct(Gender $gender)
	{
		$this->gender = $gender;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->gender->where('id', $id)->first();
	}
	
	/**
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns=[], $where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		$query =  DB::table('genders AS g')->leftJoin('statuses AS s', 's.id', '=', 'g.status_id' );
		if(!empty($columns)) {
			$cols = "";
			foreach ($columns as $column){
				$cols .= "g.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		}
		else
			$query->select('g.*', 's.title as status');
		
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$query->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$query->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if ($orderBy != '') {
			if (is_array($orderBy)) {
				$query->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		} else {
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
	public function findAll($where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		$titles = $this->gender->where('id', '>', 0);
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$titles->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$titles->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if ($orderBy != '') {
			if (is_array($orderBy)) {
				$titles->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		} else {
			$titles->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$titles->paginate($paginate);
		}
		
		return $titles->get();
	}
	
	/**
	 * @param $gender
	 * @return mixed
	 */
	public function delete($gender)
	{
		return $gender->delete();
	}
	
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->gender->getTableColumns();
	}
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params)
	{
		$columns = $this->getTableColumns();
		$data = [];
		foreach ($columns as $column) {
			if ($column == 'id' || $column == 'created_at' || $column == 'updated_at' || $column == 'status_id') {
				continue;
			}
			$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : null;
		}
		$created = Gender::create($data);
		return $created;
	}
	
	/**
	 * @param $gender
	 * @param $data
	 * @return mixed
	 */
	public function update($gender, $data)
	{
		$gender->update($data);
		return $gender;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->gender->where('id', '>', 0);
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$count->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$count->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		return $count->count();
	}
}