<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Title
 * @package App\Models\General
 */
class Title extends Model
{
	const MR = 1;
	const MRS = 2;
	const DR = 3;
	
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
