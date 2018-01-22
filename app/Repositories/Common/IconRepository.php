<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/01/07
 * Time: 07:27 AM
 */

namespace App\Repositories\Common;


use App\Contracts\RepositoryInterface;
use App\Models\Common\Icon;

class IconRepository implements RepositoryInterface
{
	/**
	 * @var $icon
	 */
	protected $icon;
	
	
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
	 * @param array $args
	 * @param null $paginate
	 * @param bool $single
	 * @return Status
	 */
	public function findBy($args=[], $paginate=null, $single=false )
	{
		return $this->icon;
	}
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$icons = $this->icon->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$icons->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$icons->where(array_keys($args)[$i], '=', array_values($args)[$i]);
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
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$icons->paginate($paginate);
		}
		
		return $icons->get();
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		$icon = $this->find($id);
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
	 * @param $id
	 * @param $status
	 * @return mixed
	 */
	public function changeStatus($id, $status)
	{
		$class = $this->find($id);
		$class->update(['status_id' => $status]);
		return $class;
	}
}