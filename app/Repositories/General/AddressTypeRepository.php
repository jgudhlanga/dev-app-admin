<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\AddressType;

/**
 * Class AddressTypeRepository
 * @package App\Repositories\General
 */
class AddressTypeRepository implements RepositoryInterface
{
	
	/**
	 * @var AddressType
	 */
	protected $addressType;
	
	/**
	 * AddressTypeRepository constructor.
	 * @param AddressType $addressType
	 */
	public function __construct(AddressType $addressType)
	{
		$this->addressType = $addressType;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->addressType->where('id', $id)->first();
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
		$query = DB::table('address_types AS at')->leftJoin('statuses AS s', 's.id', '=', 'at.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "at.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('at.*', 's.title as status');
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
		$addressTypes = $this->addressType->where('id', '>', 0);
		if (!empty($where) && is_array($where)) {
			for ($i = 0; $i < count($where); $i++) {
				if (is_array(array_values($where)[$i])) {
					$addressTypes->wherein(array_keys($where)[$i], array_values($where)[$i]);
				} else {
					$addressTypes->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if ($orderBy != '') {
			if (is_array($orderBy)) {
				$addressTypes->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		} else {
			$addressTypes->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$addressTypes->paginate($paginate);
		}
		
		return $addressTypes->get();
	}
	
	/**
	 * @param $addressType
	 * @return mixed
	 */
	public function delete($addressType)
	{
		return $addressType->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->addressType->getTableColumns();
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
		$created = AddressType::create($data);
		return $created;
	}
	
	/**
	 * @param $addressType
	 * @param $data
	 * @return mixed
	 */
	public function update($addressType, $data)
	{
		$addressType->update($data);
		return $addressType;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->addressType->where('id', '>', 0);
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