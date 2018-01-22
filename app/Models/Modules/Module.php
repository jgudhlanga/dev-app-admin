<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/12/06
 * Time: 08:17 PM
 */
namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	
    protected $fillable = ['title', 'description', 'icon', 'module_url', 'status_id','position','created_by', 'updated_by'];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function status()
    {
        return $this->belongsTo('App\Models\Common\Status');
    }
	
	/**
	 * @return array
	 */
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    
}