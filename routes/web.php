<?php

Route::get('/home', function () {
    return view('home.index');
})->middleware('auth');

Route::get('/', function () {
    return view('home.index');
})->middleware('auth');

Auth::routes();

/* CPANEL ROUTES */
Route::group(['prefix' => 'cpanel/general'], function () {
	Route::resource('status', 'CPanel\General\Status\StatusController');
	Route::resource('icons', 'CPanel\General\Icon\IconController');
	Route::resource('titles', 'CPanel\General\Title\TitleController');
	Route::resource('gender', 'CPanel\General\Gender\GenderController');
	Route::resource('marital-statuses', 'CPanel\General\MaritalStatus\MaritalStatusController');
	Route::resource('occupations', 'CPanel\General\Occupations\OccupationsController');
	Route::resource('races', 'CPanel\General\Races\RaceController');
});
Route::group(['prefix' => 'cpanel'], function (){
	Route::resource('general', 'CPanel\General\IndexController');
});

Route::resource('cpanel', 'CPanel\Index\CPanelController');

/*Chms  Routes*/
Route::post('chms/search', 'Chms\Index\ChmsController@search');
Route::resource('chms', 'Chms\Index\ChmsController');

/*Hms Routes*/
Route::resource('hms', 'Hms\Index\HmsController');

/*Modules Routes*/
Route::resource('modules', 'CPanel\Modules\ModuleController');
Route::group(['prefix' => 'modules'], function(){
	Route::resource('pages', 'CPanel\Modules\PageController');
});


/*Procurement Routes*/
Route::resource('procurement', 'Procurement\Index\ProcurementController');


/*USERS ROUTES*/
Route::resource('users', 'Users\UserController');

