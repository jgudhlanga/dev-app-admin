<?php

namespace App\Services\General;


use App\Repositories\General\TitleRepository;

class TitleService
{
	
	protected $titleRepository;
	
	
	public function __construct(TitleRepository $titleRepository)
	{
		$this->titleRepository = $titleRepository;
	}
	
	public function find( $id )
	{
		return $this->titleRepository->find($id);
	}
	
	public function findBy($args=[], $paginate=null, $limit=null, $orderBy=null)
	{
		return $this->titleRepository->findBy($args, $paginate, $limit, $orderBy);
	}
	
	public function findAll( $args=[], $paginate=null, $limit=null, $orderBy=null )
	{
		return $this->titleRepository->findAll($args, $paginate, $limit, $orderBy);
	}
	
	public function create($params)
	{
		return $this->titleRepository->create($params);
	}
	
	public function update($title, $data)
	{
		return $this->titleRepository->update($title, $data);
	}
	
	public function delete($title)
	{
		return $this->titleRepository->delete($title);
	}
	
	public function count($args = [])
	{
		return $this->titleRepository->count($args);
	}
}