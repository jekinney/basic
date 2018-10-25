<?php

Route::get('/', 'PageController@home')->name('home');
Route::get('/about', 'PageController@about')->name('about');

Route::get('/login', 'LoginController@create')->middleware('guest')->name('login.create');
Route::post('/login', 'LoginController@store')->middleware('guest')->name('login.store');
Route::post('/logout', 'LoginController@destroy')->middleware('auth')->name('login.destroy');

Route::prefix('register')->middleware('guest')->group( function() {
	Route::get('/', 'RegisterController@create')->name('register.create');
	Route::post('/', 'RegisterController@store')->name('register.store');
});

Route::prefix('dash')->middleware(['auth', 'perm:access-dash'])->group( function() {
	Route::get('/', 'DashController@index')->name('dash.home');
	
	Route::get('/user', 'UserController@index')->middleware('perm:view-user')->name('dash.user.index');
	Route::get('/user/show/{role}', 'UserController@show')->middleware('perm:view-user')->name('dash.user.show');
	Route::get('/user/edit/{role}', 'UserController@edit')->middleware('perm:update-user')->name('dash.user.edit');
	Route::patch('/user/{role}', 'UserController@update')->middleware('perm:update-user')->name('dash.user.update');
	Route::delete('/user/{role}', 'UserController@destroy')->middleware('perm:delete-user')->name('dash.user.destroy');

	Route::get('/role', 'RoleController@index')->middleware('perm:view-role')->name('dash.role.index');
	Route::get('/role/create', 'RoleController@create')->middleware('perm:create-role')->name('dash.role.create');
	Route::get('/role/show/{role}', 'RoleController@show')->middleware('perm:view-role')->name('dash.role.show');
	Route::get('/role/edit/{role}', 'RoleController@edit')->middleware('perm:update-role')->name('dash.role.edit');
	Route::post('/role', 'RoleController@store')->middleware('perm:create-role')->name('dash.role.store');
	Route::patch('/role/{role}', 'RoleController@update')->middleware('perm:update-role')->name('dash.role.update');
	Route::delete('/role/{role}', 'RoleController@destroy')->middleware('perm:delete-role')->name('dash.role.destroy');
});
