<?php

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;

/**
 * Class GeneralRepository
 * @package App\Repositories\General
 */
class GeneralRepository implements RepositoryInterface
{
	/**
	 * @var string
	 */
	protected $model;
	
	/**
	 * @var string
	 */
	protected $modelName;
	
	/**
	 * @var string
	 */
	protected $tableName;
	
	/**
	 * GeneralRepository constructor.
	 * @param $model
	 * @param $tableName
	 */
	public function __construct($model, $tableName)
	{
		$this->modelName = $model;
		$this->model = config('system.general_model_namespace').$model;
		$this->tableName = $tableName;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->model->where('id', $id)->first();
	}
	
	/**
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns = [], $where = [], $paginate = null, $limit = null, $orderBy = null)
	{
		$query = DB::table("{$this->tableName} AS tn")->leftJoin('statuses AS s', 's.id', '=', 'tn.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "tn.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('tn.*', 's.title as status');
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
			$query->orderBy('tn.name', 'asc')->take($limit);
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
		$query = $this->model->where('id', '>', 0);
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
			$query->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		
		return $query->get();
	}
	
	/**
	 * @param $model
	 * @return mixed
	 */
	public function delete($model)
	{
		return $model->delete();
	}
	
	/**
	 * @return mixed
	 */
	public function getTableColumns()
	{
		return $this->model->getTableColumns();
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
		$created = $this->modelName::create($data);
		return $created;
	}
	
	/**
	 * @param $model
	 * @param $data
	 * @return mixed
	 */
	public function update($model, $data)
	{
		$model->update($data);
		return $model;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->model->where('id', '>', 0);
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