<?php

namespace App\Contracts;

/**
 * Interface RepositoryInterface
 * @package App\Contracts
 */
interface RepositoryInterface
{
	/**
	 * @param $id
	 * @return mixed
	 */
	public function find( $id );
	
	/**
	 * @param array $columns
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param array $orderBy
	 * @return mixed
	 */
	public function findBy( $columns=[], $where=[], $paginate=null, $limit=null, $orderBy=[] );
	
	/**
	 * @param array $where
	 * @param null $paginate
	 * @param null $limit
	 * @param array $orderBy
	 * @return mixed
	 */
	public function findAll( $where=[], $paginate=null, $limit=null, $orderBy=[]);
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete( $id );
	
	/**
	 * @param $params
	 * @return mixed
	 */
	public function create($params);
	
	/**
	 * @param $model
	 * @param $params
	 * @return mixed
	 */
	public function update($model, $params);
	
	/**
	 * @param array $where
	 * @return mixed
	 */
	public function count($where=[]);
}