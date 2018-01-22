<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/01/03
 * Time: 05:54 PM
 */

namespace App\Repositories\Users;


use App\Contracts\RepositoryInterface;
use App\Models\Users\User;

class UserRepository implements RepositoryInterface
{
	/**
	 * @var User
	 */
	protected $user;
	
	/**
	 * UserRepository constructor.
	 */
	public function __construct()
	{
		$this->user = new User();
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns()
	{
		return $this->user->getTableColumns();
	}
	
	public function create($params)
	{
		$columns = $this->getTableColumns();
		$data = [];
		foreach ( $columns as $column ) {
			if($column == 'id' || $column == 'created_at'|| $column == 'updated_at' ) {
				continue;
			}
			
			if($column == 'password' && ($params['password'] != '')) {
				$data[$column] = bcrypt($params[$column]);
			}
			else {
				$data[$column] = (isset($params[$column]) && $params[$column] != '') ? $params[$column] : NULL;
			}
		}
		$created = User::create($data);
		return $created;
	}
	
	public function find($id)
	{
		// TODO: Implement find() method.
	}
	
	public function findBy($args = [], $paginate = null, $single = false)
	{
		// TODO: Implement findBy() method.
	}
	
	public function findAll($args = [], $paginate = null, $limit = null, $orderBy=null)
	{
		// TODO: Implement findAll() method.
	}
	
	public function delete($id)
	{
		// TODO: Implement delete() method.
	}
}