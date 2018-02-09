<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*MODULES ROUTES*/
Route::group(['prefix' => 'modules'], function () {
	Route::get('/get-modules', 'CPanel\Modules\Api\ModuleController@getModules');
	Route::put('/change-module-status/{module}', 'CPanel\Modules\Api\ModuleController@changeStatus');
	Route::put('/order-modules/{module}', 'CPanel\Modules\Api\ModuleController@order');
	
	/*PAGES*/
	Route::get('/get-pages/{module}', 'CPanel\Modules\Api\PageController@getPages');
	Route::put('/change-page-status/{page}', 'CPanel\Modules\Api\PageController@changeStatus');
	Route::put('/order-pages/{page}', 'CPanel\Modules\Api\PageController@order');
	
});

/*GENERAL SETTINGS ROUTES*/
Route::group(['prefix' => 'icons'], function () {
	Route::put('/change-status/{icon}', 'CPanel\General\Icon\Api\IconController@changeStatus');
});
Route::group(['prefix' => 'titles'], function () {
	Route::put('/change-status/{title}', 'CPanel\General\Title\Api\TitleController@changeStatus');
});
Route::group(['prefix' => 'marital-statuses'], function () {
	Route::put('/change-status/{marital_status}', 'CPanel\General\MaritalStatus\Api\MaritalStatusController@changeStatus');
});
Route::group(['prefix' => 'gender'], function () {
	Route::put('/change-status/{gender}', 'CPanel\General\Gender\Api\GenderController@changeStatus');
});
Route::group(['prefix' => 'occupations'], function () {
	Route::put('/change-status/{occupation}', 'CPanel\General\Occupations\Api\OccupationsController@changeStatus');
});
Route::group(['prefix' => 'races'], function () {
	Route::put('/change-status/{race}', 'CPanel\General\Races\Api\RaceController@changeStatus');
});
Route::group(['prefix' => 'countries'], function () {
	Route::put('/change-status/{country}', 'CPanel\General\Countries\Api\CountriesController@changeStatus');
	Route::get('/get-countries', 'CPanel\General\Countries\Api\CountriesController@getCountries');
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



