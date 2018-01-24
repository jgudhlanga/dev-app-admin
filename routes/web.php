<?php

Route::get('/home', function () {
    return view('home.index');
})->middleware('auth');

Route::get('/', function () {
    return view('home.index');
})->middleware('auth');

Auth::routes();

/*System Admin  Routes*/
Route::resource('admin', 'Admin\Index\AdminController');

/*Chms  Routes*/
Route::post('chms/search', 'Chms\Index\ChmsController@search');
Route::resource('chms', 'Chms\Index\ChmsController');

/*Hms Routes*/
Route::resource('hms', 'Hms\Index\HmsController');

/*Modules Routes*/
Route::resource('modules', 'Admin\Modules\ModuleController');
Route::group(['prefix' => 'modules'], function(){
	Route::resource('pages', 'Admin\Modules\PageController');
});


/*Procurement Routes*/
Route::resource('procurement', 'Procurement\Index\ProcurementController');

/* COMMON ROUTES */
Route::group(['prefix' => 'common'], function () {
	Route::resource('status', 'Admin\Common\Status\StatusController');
	Route::resource('icons', 'Admin\Common\Icon\IconController');
});
Route::resource('common', 'Admin\Common\CommonController');

/*USERS ROUTES*/
Route::resource('users', 'Users\UserController');

