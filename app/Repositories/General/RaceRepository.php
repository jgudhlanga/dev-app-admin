<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\Race;

class RaceRepository implements RepositoryInterface
{
	
	protected $race;
	
	public function __construct(Race $race)
	{
		$this->race = $race;
	}
	
	public function find($id)
	{
		return $this->race->where('id', $id)->first();
	}
	
	public function findBy($args = [], $paginate = null, $limit = null, $orderBy = null)
	{
		$query = DB::table('races AS r')
			->leftJoin('statuses AS s', 's.id', '=', 'r.status_id')
			->select('r.*', 's.race as status')
			->where('r.id', '>', 0);
		
		if (!empty($args) && is_array($args)) {
			for ($i = 0; $i < count($args); $i++) {
				if (is_array(array_values($args)[$i])) {
					$query->wherein(array_keys($args)[$i], array_values($args)[$i]);
				} else {
					$query->where(array_keys($args)[$i], '=', array_values($args)[$i]);
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
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		return $query->get();
	}
	
	public function findAll($args = [], $paginate = null, $limit = null, $orderBy = null)
	{
		$races = $this->race->where('id', '>', 0);
		if (!empty($args) && is_array($args)) {
			for ($i = 0; $i < count($args); $i++) {
				if (is_array(array_values($args)[$i])) {
					$races->wherein(array_keys($args)[$i], array_values($args)[$i]);
				} else {
					$races->where(array_keys($args)[$i], '=', array_values($args)[$i]);
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
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$races->paginate($paginate);
		}
		
		return $races->get();
	}
	
	public function delete($race)
	{
		return $race->delete();
	}
	
	public function getTableColumns()
	{
		return $this->race->getTableColumns();
	}
	
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
	
	public function update($race, $data)
	{
		$race->update($data);
		return $race;
	}
	
	public function count($args = [])
	{
		$count = $this->race->where('id', '>', 0);
		if (!empty($args) && is_array($args)) {
			for ($i = 0; $i < count($args); $i++) {
				if (is_array(array_values($args)[$i])) {
					$count->wherein(array_keys($args)[$i], array_values($args)[$i]);
				} else {
					$count->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		return $count->count();
	}
}