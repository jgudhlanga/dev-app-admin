<?php

namespace App\Contracts;
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/01/04
 * Time: 07:53 AM
 */

interface RepositoryInterface
{
	public function find( $id );
	public function findBy( $args=[], $paginate=null, $limit=null, $orderBy=[] );
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=[]);
	public function delete( $id );
	public function create($params);
	public function update($model, $params);
	public function count($args=[]);
}