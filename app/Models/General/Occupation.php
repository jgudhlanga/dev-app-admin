<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
	protected $fillable = ['name', 'description', 'status_id', 'created_by', 'updated_by'];
	
	public function status()
	{
		return $this->belongsTo(Status::class);
	}
	
	public function getTableColumns() {
		return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
	}
}
