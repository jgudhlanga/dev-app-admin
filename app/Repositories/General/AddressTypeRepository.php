<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\AddressType;

class AddressTypeRepository implements RepositoryInterface
{
	
	protected $addressType;
	
	public function __construct(AddressType $addressType)
	{
		$this->addressType = $addressType;
	}
	
	public function find($id)
	{
		return $this->addressType->where('id', $id)->first();
	}
	
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('address_types AS at')
			->leftJoin('statuses AS s', 's.id', '=', 'at.status_id' )
			->select('at.*', 's.title as status')
			->where('at.id', '>', 0);
		
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
		$addressTypes = $this->addressType->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$addressTypes->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$addressTypes->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$addressTypes->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$addressTypes->orderBy('created_at', 'desc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$addressTypes->paginate($paginate);
		}
		
		return $addressTypes->get();
	}
	
	public function delete($addressType)
	{
		return $addressType->delete();
	}
	
	public function getTableColumns()
	{
		return $this->addressType->getTableColumns();
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
		$created = AddressType::create($data);
		return $created;
	}
	
	public function update($addressType, $data)
	{
		$addressType->update($data);
		return $addressType;
	}
	
	public function count($args = [])
	{
		$count = $this->addressType->where('id', '>', 0);
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