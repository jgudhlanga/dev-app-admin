<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\Race;

/**
 * Class RaceRepository
 * @package App\Repositories\General
 */
class RaceRepository implements RepositoryInterface
{
	
	/**
	 * @var Race
	 */
	protected $race;
	
	/**
	 * RaceRepository constructor.
	 * @param Race $race
	 */
	public function __construct(Race $race)
	{
		$this->race = $race;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->race->where('id', $id)->first();
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
		
		$query = DB::table('races AS r')->leftJoin('statuses AS s', 's.id', '=', 'r.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "r.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('r.*', 's.title as status');
		}
		
		
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
		$races = $this->race->where('id', '>', 0);
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$races->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$races->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if ($orderBy != '') {
			if (is_array($orderBy)) {
				$races->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		} else {
			$races->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$races->paginate($paginate);
		}
		
		return $races->get();
	}
	
	/**
	 * @param $race
	 * @return mixed
	 */
	public function delete($race)
	{
		return $race->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->race->getTableColumns();
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
		$created = Race::create($data);
		return $created;
	}
	
	/**
	 * @param $race
	 * @param $data
	 * @return mixed
	 */
	public function update($race, $data)
	{
		$race->update($data);
		return $race;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->race->where('id', '>', 0);
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