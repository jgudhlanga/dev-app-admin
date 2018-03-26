<?php

namespace App\Http\Middleware;

use Closure;
use Laratrust\Middleware\LaratrustRole;

class LaratrustRoleCustom extends LaratrustRole
{
	protected function unauthorized()
	{
		$parameter = config('laratrust.middleware.params');
		return redirect($parameter);
	}
}
