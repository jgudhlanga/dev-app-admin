<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gender
 * @package App\Models\General
 */
class Gender extends Model
{
	const MALE = 1;
	const FEMALE = 2;
	const UNKNOWN = 3;
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
