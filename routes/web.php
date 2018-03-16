<?php

Route::get('/home', function () {
    return view('home.index');
})->middleware('auth');

Route::get('/', function () {
    return view('home.index');
})->middleware('auth');

Auth::routes();

/* CPANEL ROUTES */
Route::group(['prefix' => 'cpanel'], function (){
	
	/*GENERAL*/
	Route::group(['prefix' => 'general'], function (){
		Route::resource('status', 'CPanel\General\Status\StatusController');
		Route::resource('icons', 'CPanel\General\Icon\IconController');
		Route::resource('titles', 'CPanel\General\Title\TitleController');
		Route::resource('gender', 'CPanel\General\Gender\GenderController');
		Route::resource('marital-statuses', 'CPanel\General\MaritalStatus\MaritalStatusController');
		Route::resource('occupations', 'CPanel\General\Occupations\OccupationsController');
		Route::resource('races', 'CPanel\General\Races\RaceController');
		Route::resource('countries', 'CPanel\General\Countries\CountriesController');
		Route::resource('member-types', 'CPanel\General\MemberTypes\MemberTypesController');
		Route::resource('address-types', 'CPanel\General\AddressTypes\AddressTypesController');
	});
	
	/*MODULES & PAGES */
	Route::group(['prefix' => 'modules'], function(){
		Route::resource('pages', 'CPanel\Modules\PageController');
	});
	Route::resource('modules', 'CPanel\Modules\ModuleController');
	
	/*SECURITY*/
	Route::group(['prefix' => 'security'], function(){
		Route::resource('roles', 'CPanel\Security\RolesController');
		Route::group(['prefix' => 'permissions'], function (){
			Route::post('store-crud', 'CPanel\Security\PermissionsController@storeCrud');
		});
		Route::resource('permissions', 'CPanel\Security\PermissionsController');
	});
});

Route::resource('cpanel', 'CPanel\Index\CPanelController');

/*Chms  Routes*/
Route::resource('chms', 'Chms\Index\ChmsController');

/*Hms Routes*/
Route::resource('hms', 'Hms\Index\HmsController');


/*Procurement Routes*/
Route::resource('procurement', 'Procurement\Index\ProcurementController');


/*USERS ROUTES*/
Route::resource('users', 'Users\UsersController');

