<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Icon
 * @package App\Models\General
 */
class Icon extends Model
{
	/**
	 * @var array
	 */
    protected $fillable = ['class', 'status_id'];
	
	/**
	 * @return array
	 */
	public function getTableColumns() {
		return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
	}
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function status()
	{
		return $this->belongsTo(Status::class);
	}
}
