<?php

namespace App\Http\Controllers\Errors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorsController extends Controller
{
    public function forbidden()
    {
	    return view('errors.403');
    }
}
