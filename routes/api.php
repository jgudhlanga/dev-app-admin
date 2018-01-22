<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*MODULES ROUTES*/
Route::group(['prefix' => 'modules'], function () {
	Route::get('/get-modules', 'Admin\Modules\ModuleController@getModules');
	Route::put('/change-status', 'Admin\Modules\ModuleController@changeStatus');
});

/*COMMON ROUTES*/
Route::group(['prefix' => 'icons'], function () {
	Route::put('/change-status', 'Admin\Common\Icon\IconController@changeStatus');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*PRODUCTS ROUTE*/
Route::apiResource('/products', 'Products\Api\ProductController');

/*PRODUCT REVIEW ROUTES*/
Route::group(['prefix' => 'products'], function (){
	Route::apiResource('/{product}/reviews', 'Reviews\Api\ReviewController');
});

/*USER ROUTES*/
Route::apiResource('/users', 'Users\Api\UserController');



