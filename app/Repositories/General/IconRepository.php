<?php

namespace App\Repositories\General;


use App\Contracts\RepositoryInterface;
use App\Models\General\Icon;

/**
 * Class IconRepository
 * @package App\Repositories\General
 */
class IconRepository implements RepositoryInterface
{
	
	/**
	 * @var Icon
	 */
	protected $icon;
	
	
	/**
	 * IconRepository constructor.
	 * @param Icon $icon
	 */
	public function __construct(Icon $icon)
	{
		$this->icon = $icon;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->icon->where('id', $id)->first();
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
		
		$query = DB::table('icons AS i')->leftJoin('statuses AS s', 's.id', '=', 'i.status_id');
		if (!empty($columns)) {
			$cols = "";
			foreach ($columns as $column) {
				$cols .= "i.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		} else {
			$query->select('i.*', 's.title as status');
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
			$query->orderBy('class', 'asc')->take($limit);
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
		$icons = $this->icon->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$icons->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$icons->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$icons->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$icons->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$icons->paginate($paginate);
		}
		
		return $icons->get();
	}
	
	/**
	 * @param $icon
	 * @return mixed
	 */
	public function delete($icon)
	{
		return $icon->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->icon->getTableColumns();
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
		$created = Icon::create($data);
		return $created;
	}
	
	/**
	 * @param $icon
	 * @param $data
	 * @return mixed
	 */
	public function update($icon, $data)
	{
		$icon->update($data);
		return $icon;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->icon->where('id', '>', 0);
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