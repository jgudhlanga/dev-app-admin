<?php

namespace App\Http\Traits\General;

use App\Models\General\Status;

/**
 * Trait CommonTrait
 * @package App\Http\Traits\General
 */
trait CommonTrait
{
	
	/**
	 * @return int
	 */
	public function getStatusActive()
	{
		return Status::ACTIVE;
	}
	
	/**
	 * @return int
	 */
	public function getStatusInActive()
	{
		return Status::INACTIVE;
	}
}