<?php

namespace App\Models\Modules;

use App\Models\General\Status;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package App\Models\Modules
 */
class Page extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['title', 'description', 'class', 'page_url', 'status_id','position', 'module_id', 'created_by', 'updated_by'];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function module()
	{
		return $this->belongsTo(Module::class);
	}
	
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
