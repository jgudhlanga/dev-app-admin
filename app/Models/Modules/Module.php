<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/12/06
 * Time: 08:17 PM
 */
namespace App\Models\Modules;

use App\Models\General\Status;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 * @package App\Models\Modules
 */
class Module extends Model
{
	
	/**
	 * @var array
	 */
	protected $fillable = ['title', 'description', 'class', 'module_url', 'status_id','position','created_by', 'updated_by'];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
	
    
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function pages()
    {
    	return $this->hasMany(Page::class);
    }
	
	
	/**
	 * @return array
	 */
	public function getTableColumns() {
		return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
	}
	
}