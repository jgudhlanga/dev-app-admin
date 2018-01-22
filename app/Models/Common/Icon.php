<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

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
