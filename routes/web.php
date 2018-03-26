<?php

Route::get('/home', function () {
    return view('home.index');
})->middleware('auth');

Route::get('/', function () {
    return view('home.index');
})->middleware('auth');

Auth::routes();

/* CPANEL ROUTES */
Route::prefix('cpanel')->group(function () {
	
	/*GENERAL*/
	Route::prefix('general')->middleware('role:senior-developer|junior-developer|administrator')->group(function () {
		Route::resource('status', 'CPanel\General\Status\StatusController')->middleware('auth');
		Route::resource('icons', 'CPanel\General\Icon\IconController')->middleware('auth');
		Route::resource('titles', 'CPanel\General\Title\TitleController')->middleware('auth');
		Route::resource('gender', 'CPanel\General\Gender\GenderController')->middleware('auth');
		Route::resource('marital-statuses', 'CPanel\General\MaritalStatus\MaritalStatusController')->middleware('auth');
		Route::resource('occupations', 'CPanel\General\Occupations\OccupationsController')->middleware('auth');
		Route::resource('races', 'CPanel\General\Races\RaceController')->middleware('auth');
		Route::resource('countries', 'CPanel\General\Countries\CountriesController')->middleware('auth');
		Route::resource('member-types', 'CPanel\General\MemberTypes\MemberTypesController')->middleware('auth');
		Route::resource('address-types', 'CPanel\General\AddressTypes\AddressTypesController')->middleware('auth');
	});
	
	/*MODULES & PAGES */
	Route::prefix('modules')->middleware('role:senior-developer')->group(function () {
		Route::resource('pages', 'CPanel\Modules\PageController')->middleware('auth');
	});
	Route::resource('modules', 'CPanel\Modules\ModuleController')->middleware('role:senior-developer')->middleware('auth');
	
	/*SECURITY*/
	Route::prefix('security')->middleware('role:senior-developer')->group(function () {
		Route::resource('roles', 'CPanel\Security\RolesController')->middleware('auth');
		Route::prefix('permissions')->group(function () {
			Route::post('store-crud', 'CPanel\Security\PermissionsController@storeCrud')->middleware('auth');
		});
		Route::resource('permissions', 'CPanel\Security\PermissionsController')->middleware('auth');
	});
});

Route::resource('cpanel', 'CPanel\Index\CPanelController')->middleware('auth');

/*Chms  Routes*/
Route::resource('chms', 'Chms\Index\ChmsController')->middleware('auth');

/*Hms Routes*/
Route::resource('hms', 'Hms\Index\HmsController')->middleware('auth');


/*Procurement Routes*/
Route::resource('procurement', 'Procurement\Index\ProcurementController')->middleware('auth');


/*USERS ROUTES*/
Route::resource('users', 'Users\UsersController')->middleware('auth');

/*ERROR ROUTES*/
Route::get('403', 'Errors\ErrorsController@forbidden');