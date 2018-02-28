<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\Title;

class TitleRepository implements RepositoryInterface
{
	
	protected $title;
	
	public function __construct(Title $title)
	{
		$this->title = $title;
	}
	
	public function find($id)
	{
		return $this->title->where('id', $id)->first();
	}
	
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('titles AS t')
			->leftJoin('statuses AS s', 's.id', '=', 't.status_id' )
			->select('t.*', 's.title as status')
			->where('t.id', '>', 0);
		
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
		$titles = $this->title->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$titles->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$titles->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$titles->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$titles->orderBy('created_at', 'desc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$titles->paginate($paginate);
		}
		
		return $titles->get();
	}
	
	public function delete($title)
	{
		return $title->delete();
	}
	
	public function getTableColumns()
	{
		return $this->title->getTableColumns();
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
		$created = Title::create($data);
		return $created;
	}
	
	public function update($title, $data)
	{
		$title->update($data);
		return $title;
	}
	
	public function count($args = [])
	{
		$count = $this->title->where('id', '>', 0);
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