<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongToUser extends Exception
{
    public function render()
    {
    	return ['errors' => 'You can not update or delete this item, it does not belong to you'];
    }
}
