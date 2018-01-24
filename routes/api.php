<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*MODULES ROUTES*/
Route::group(['prefix' => 'modules'], function () {
	Route::get('/get-modules', 'Admin\Modules\Api\ApiModuleController@getModules');
	Route::put('/change-module-status/{module}', 'Admin\Modules\Api\ApiModuleController@changeStatus');
	Route::put('/order-modules/{module}', 'Admin\Modules\Api\ApiModuleController@order');
	
	/*PAGES*/
	Route::get('/get-pages/{module}', 'Admin\Modules\Api\ApiPageController@getPages');
	Route::put('/change-page-status/{page}', 'Admin\Modules\Api\ApiPageController@changeStatus');
	Route::put('/order-pages/{page}', 'Admin\Modules\Api\ApiPageController@order');
	
});

/*COMMON ROUTES*/
Route::group(['prefix' => 'icons'], function () {
	Route::put('/change-status/{icon}', 'Admin\Common\Icon\Api\ApiIconController@changeStatus');
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
Route::apiResource('/users', 'Users\Api\ApiUserController');*/



