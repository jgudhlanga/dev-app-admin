<?php

namespace App\Models\Roles;

use Laratrust\Models\LaratrustRole;
use App\Models\General\Status;

class Role extends LaratrustRole
{
	protected $fillable = ['name', 'display_name', 'description', 'status_id', 'created_by', 'updated_by'];
	
	public function status()
	{
		return $this->belongsTo(Status::class);
	}
	
	public function getTableColumns() {
		return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
	}
}
