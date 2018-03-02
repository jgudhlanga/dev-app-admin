<?php

namespace App\Models\Roles;

use Laratrust\Models\LaratrustRole;
use App\Models\General\Status;

/**
 * Class Role
 * @package App\Models\Roles
 */
class Role extends LaratrustRole
{
	/**
	 * @var array
	 */
	protected $fillable = ['name', 'display_name', 'description', 'status_id', 'created_by', 'updated_by'];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function status()
	{
		return $this->belongsTo(Status::class);
	}
	
	/**
	 * @return array
	 */
	public function getTableColumns() {
		return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
	}
}
