<?php

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;
use App\Models\General\Occupation;

class OccupationRepository implements RepositoryInterface
{
	
	protected $occupation;
	
	
	public function __construct(Occupation $occupation)
	{
		$this->occupation = $occupation;
	}
	
	public function find($id)
	{
		return $this->occupation->where('id', $id)->first();
	}
	
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('occupations AS o')
			->leftJoin('statuses AS s', 's.id', '=', 'o.status_id' )
			->select('o.*', 's.title as status')
			->where('o.id', '>', 0);
		
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
		$occupations = $this->occupation->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$occupations->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$occupations->where(array_keys($args)[$i], '=', array_values($args)[$i]);
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
	
	public function delete($occupation)
	{
		return $occupation->delete();
	}
	
	public function getTableColumns()
	{
		return $this->occupation->getTableColumns();
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
		$created = Occupation::create($data);
		return $created;
	}
	
	public function update($occupation, $data)
	{
		$occupation->update($data);
		return $occupation;
	}
	
	public function count($args = [])
	{
		$count = $this->occupation->where('id', '>', 0);
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