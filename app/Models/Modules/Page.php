<?php

namespace App\Models\Modules;

use App\Models\Common\Status;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $fillable = ['title', 'description', 'icon_id', 'page_url', 'status_id','position', 'module_id', 'created_by', 'updated_by'];
	
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
