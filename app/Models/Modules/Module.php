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
    protected $fillable = ['title', 'description', 'icon', 'module_url', 'status_id','created_by', 'updated_by'];
    
    public function status()
    {
        return $this->belongsTo('App\Models\Common\Status');
    }
}