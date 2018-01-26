<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*MODULES ROUTES*/
Route::group(['prefix' => 'modules'], function () {
	Route::get('/get-modules', 'Admin\Modules\Api\ModuleController@getModules');
	Route::put('/change-module-status/{module}', 'Admin\Modules\Api\ModuleController@changeStatus');
	Route::put('/order-modules/{module}', 'Admin\Modules\Api\ModuleController@order');
	
	/*PAGES*/
	Route::get('/get-pages/{module}', 'Admin\Modules\Api\PageController@getPages');
	Route::put('/change-page-status/{page}', 'Admin\Modules\Api\PageController@changeStatus');
	Route::put('/order-pages/{page}', 'Admin\Modules\Api\PageController@order');
	
});

/*COMMON ROUTES*/
Route::group(['prefix' => 'icons'], function () {
	Route::put('/change-status/{icon}', 'Admin\Common\Icon\Api\IconController@changeStatus');
});

/*AUTH ROUTE*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*PRODUCTS ROUTE*
Route::apiResource('/products', 'Products\Api\ProductController');/

/*PRODUCT REVIEW ROUTES
Route::group(['prefix' => 'products'], function (){
	Route::apiResource('/{product}/reviews', 'Reviews\Api\ReviewController');
});*/

/*USER ROUTES
Route::apiResource('/users', 'Users\Api\UserController');*/



