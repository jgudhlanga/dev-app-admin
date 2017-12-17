<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/12/06
 * Time: 08:17 PM
 */
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const ACTIVE = 1;
    
    protected $fillable = ['title', 'description'];
    
}