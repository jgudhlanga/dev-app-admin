<?php

namespace App\Repositories\General;

use App\Contracts\RepositoryInterface;
use App\Models\General\Country;
use Illuminate\Support\Facades\DB;

/**
 * Class CountryRepository
 * @package App\Repositories\General
 */
class CountryRepository implements RepositoryInterface
{
	
	/**
	 * @var Country
	 */
	protected $country;
	
	/**
	 * CountryRepository constructor.
	 * @param Country $country
	 */
	public function __construct(Country $country)
	{
		$this->country = $country;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->country->where('id', $id)->first();
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
		$query =  DB::table('countries AS c')->leftJoin('statuses AS s', 's.id', '=', 'c.status_id' );
		if(!empty($columns)) {
			$cols = "";
			foreach ($columns as $column){
				$cols .= "c.{$column},";
			}
			$query->select(rtrim(',', $cols), 's.title as status');
		}
		else
			$query->select('c.*', 's.title as status');
		
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
		$countries = $this->country->where('id', '>', 0);
		if(!empty($where) && is_array($where))
		{
			for ($i=0; $i<count($where); $i++)
			{
				if(is_array(array_values($where)[$i])){
					$countries->wherein(array_keys($where)[$i],array_values($where)[$i]);
				}
				else{
					$countries->where(array_keys($where)[$i], '=', array_values($where)[$i]);
				}
			}
		}
		
		if($orderBy != '')
		{
			if(is_array($orderBy)){
				$countries->orderBy(array_keys($orderBy)[0], array_values($orderBy)[0]);
			}
		}
		else{
			$countries->orderBy('created_at', 'desc')->take($limit);
		}
		
		if (!is_null($paginate)) {
			$countries->paginate($paginate);
		}
		
		return $countries->get();
	}
	
	/**
	 * @param $country
	 * @return mixed
	 */
	public function delete($country)
	{
		return $country->delete();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->country->getTableColumns();
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
		$created = Country::create($data);
		return $created;
	}
	
	/**
	 * @param $country
	 * @param $data
	 * @return mixed
	 */
	public function update($country, $data)
	{
		$country->update($data);
		return $country;
	}
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where = [])
	{
		$count = $this->country->where('id', '>', 0);
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