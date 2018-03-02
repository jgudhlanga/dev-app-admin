<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @package App\Models\General
 */
class Country extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = [
		'capital', 'citizenship', 'country_code', 'currency', 'currency_code', 'currency_sub_unit',
		'currency_symbol', 'currency_decimals', 'full_name', 'iso_3166_2', 'iso_3166_3', 'name', 'region_code',
		'sub_region_code', 'eea','calling_code', 'flag', 'status_id'
	];
	
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
