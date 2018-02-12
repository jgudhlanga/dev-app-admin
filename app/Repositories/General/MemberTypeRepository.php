<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\MemberType;

class MemberTypeRepository implements RepositoryInterface
{
	
	protected $memberType;
	
	public function __construct(MemberType $memberType)
	{
		$this->memberType = $memberType;
	}
	
	public function find($id)
	{
		return $this->memberType->where('id', $id)->first();
	}
	
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('member_types AS mt')
			->leftJoin('statuses AS s', 's.id', '=', 'mt.status_id' )
			->select('mt.*', 's.title as status')
			->where('mt.id', '>', 0);
		
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
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$memberTypes = $this->memberType->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$memberTypes->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$memberTypes->where(array_keys($args)[$i], '=', array_values($args)[$i]);
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
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$memberTypes->paginate($paginate);
		}
		
		return $memberTypes->get();
	}
	
	public function delete($memberType)
	{
		return $memberType->delete();
	}
	
	public function getTableColumns()
	{
		return $this->memberType->getTableColumns();
	}
	
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
	
	public function update($memberType, $data)
	{
		$memberType->update($data);
		return $memberType;
	}
	
	public function count($args = [])
	{
		$count = $this->memberType->where('id', '>', 0);
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