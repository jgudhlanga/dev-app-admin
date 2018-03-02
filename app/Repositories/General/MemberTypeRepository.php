<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\MemberType;

/**
 * Class MemberTypeRepository
 * @package App\Repositories\General
 */
class MemberTypeRepository implements RepositoryInterface
{
	
	/**
	 * @var MemberType
	 */
	protected $memberType;
	
	/**
	 * MemberTypeRepository constructor.
	 * @param MemberType $memberType
	 */
	public function __construct(MemberType $memberType)
	{
		$this->memberType = $memberType;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->memberType->where('id', $id)->first();
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
		
		$query = DB::table('member_types AS mt')->leftJoin('statuses AS s', 's.id', '=', 'mt.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "mt.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('mt.*', 's.title as status');
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
		$memberTypes = $this->memberType->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$memberTypes->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$memberTypes->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$memberTypes->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$memberTypes->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$memberTypes->paginate($paginate);
		}
		
		return $memberTypes->get();
	}
	
	/**
	 * @param $memberType
	 * @return mixed
	 */
	public function delete($memberType)
	{
		return $memberType->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->memberType->getTableColumns();
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
		$created = memberType::create($data);
		return $created;
	}
	
	/**
	 * @param $memberType
	 * @param $data
	 * @return mixed
	 */
	public function update($memberType, $data)
	{
		$memberType->update($data);
		return $memberType;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->memberType->where('id', '>', 0);
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