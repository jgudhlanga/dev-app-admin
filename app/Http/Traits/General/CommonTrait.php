<?php

namespace App\Http\Traits\General;

use App\Models\General\Status;

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