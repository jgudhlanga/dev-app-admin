<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\Title;

/**
 * Class TitleRepository
 * @package App\Repositories\General
 */
class TitleRepository implements RepositoryInterface
{
	
	/**
	 * @var Title
	 */
	protected $title;
	
	/**
	 * TitleRepository constructor.
	 * @param Title $title
	 */
	public function __construct(Title $title)
	{
		$this->title = $title;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->title->where('id', $id)->first();
	}
	
	/**
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy($columns=[],$where=[], $paginate=null, $limit=null, $orderBy=null )
	{
		
		$query = DB::table('titles AS t')->leftJoin('statuses AS s', 's.id', '=', 't.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "t.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('t.*', 's.title as status');
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
		$titles = $this->title->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$titles->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$titles->where(array_keys($where)[$i], '=', array_values($where)[$i]);
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
			$titles->orderBy('name', 'asc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$titles->paginate($paginate);
		}
		
		return $titles->get();
	}
	
	/**
	 * @param $title
	 * @return mixed
	 */
	public function delete($title)
	{
		return $title->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->title->getTableColumns();
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
		$created = Title::create($data);
		return $created;
	}
	
	/**
	 * @param $title
	 * @param $data
	 * @return mixed
	 */
	public function update($title, $data)
	{
		$title->update($data);
		return $title;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->title->where('id', '>', 0);
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