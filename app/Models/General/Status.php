<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2017/12/06
 * Time: 08:17 PM
 */
namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App\Models\General
 */
class Status extends Model
{
	/**
	 *
	 */
	const ACTIVE = 1;
	/**
	 *
	 */
	const INACTIVE = 2;
	
	/**
	 * @var array
	 */
	protected $fillable = ['title', 'description'];
	
	/**
	 * @return array
	 */
	public function getTableColumns() {
		return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
	}
}