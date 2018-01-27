<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/12/17
 * Time: 05:49 PM
 */

namespace App\Repositories\Modules;

use App\Contracts\RepositoryInterface;
use App\Models\Modules\Page;
use Illuminate\Support\Facades\DB;

class PageRepository implements RepositoryInterface
{
	/**
	 * @var $page
	 */
	protected $page;
	
	/**
	 * PageRepository constructor.
	 * @param Page $page
	 */
	public function __construct(Page $page)
	{
		$this->page = $page;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->page->where('id', $id)->first();
	}
	
	/**
	 * @param array $args
	 * @param null $paginate
	 * @param null $limit
	 * @param null $orderBy
	 * @return mixed
	 */
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		$query =  DB::table('pages AS p')
			->leftJoin('statuses AS s', 's.id', '=', 'p.status_id' )
			->select('p.*', 's.title as status')
			->where('p.id', '>', 0);
		
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
			$query->orderBy('position', 'asc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$query->paginate($paginate);
		}
		return $query->get();
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
		$pages = $this->page->where('id', '>', 0);
		if(!empty($args) && is_array($args))
		{
			for ($i=0; $i<count($args); $i++)
			{
				if(is_array(array_values($args)[$i])){
					$pages->wherein(array_keys($args)[$i],array_values($args)[$i]);
				}
				else{
					$pages->where(array_keys($args)[$i], '=', array_values($args)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$pages->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$pages->orderBy('position', 'asc')->take($limit);
		}
		
		// Paginate if we need to
		if (!is_null($paginate)) {
			$pages->paginate($paginate);
		}
		
		return $pages->get();
		
	}
	
	/**
	 * @param $page
	 * @return mixed
	 */
	public function delete($page)
	{
		return $page->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->page->getTableColumns();
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
		$created = Page::create($data);
		return $created;
	}
	
	/**
	 * @param $page
	 * @param $data
	 * @return mixed
	 */
	public function update($page, $data)
	{
		$page->update($data);
		return $page;
	}
	
	/**
	 * @param $page
	 * @return mixed
	 */
	public function positionPage($page)
	{
		$maxPos = $page->where('module_id', $page->module_id)->max('position');
		$page->update(['position' => $maxPos + 1]);
		return $page;
	}
	
	
	/**
	 * @param $page
	 * @param string $direction
	 * @return mixed
	 */
	public function orderPages($page, $direction = "up")
	{
		//refresh the order to avoid gaps
		$pages = $this->findAll(['module_id' => $page->module_id], null, null, ['position' => 'asc']);
		
		$count = 0;
		foreach ($pages as $row)
		{
			$count++;
			$row->update(['position' => $count]);
		}
		
		if(isset($page->position) && $page->position > 0)
		{
			$pagePosition = $page->position;
			
			//get the next page and position
			$position = (strtolower($direction) == "up") ? ($page->position - 1) : ($page->position + 1);
			$currentPage = $this->page->where('position', $position)->first();
			
			if(isset($currentPage->position) && $currentPage->position > 0)
			{
				//swap the pages
				$page->update(['position' => $currentPage->position]);
				$currentPage->update(['position' => $pagePosition]);
			}
		}
		return $page;
	}
	
}