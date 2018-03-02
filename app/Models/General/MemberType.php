<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberType
 * @package App\Models\General
 */
class MemberType extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'status_id', 'created_by', 'updated_by'];
	
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
