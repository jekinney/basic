<?php

Route::get('/', 'PageController@home')->name('home');
Route::get('/about', 'PageController@about')->name('about');

Route::get('/support/create', 'SupportController@create')->name('support.create');
Route::get('/support/show/{support}', 'SupportController@show')->name('support.show');
Route::post('/support/store', 'SupportController@store')->name('support.store');
Route::post('/support-reply/store', 'SupportReplyController@store')->name('support-reply.store');

Route::get('/login', 'LoginController@create')->middleware('guest')->name('login.create');
Route::post('/login', 'LoginController@store')->middleware('guest')->name('login.store');
Route::post('/logout', 'LoginController@destroy')->middleware('auth')->name('login.destroy');

Route::prefix('register')->middleware('guest')->group( function() {
	Route::get('/', 'RegisterController@create')->name('register.create');
	Route::post('/', 'RegisterController@store')->name('register.store');
});

Route::prefix('blog')->namespace('Blog')->group( function() {
	Route::get('/article', 'ArticleController@index')->name('blog.article.index');
	Route::get('/article/show/{article}', 'ArticleController@show')->name('blog.article.show');

	Route::get('/category', 'CategoryController@index')->name('blog.category.index');
	Route::get('/category/show/{category}', 'CategoryController@show')->name('blog.category.show');
});

Route::middleware( 'auth' )->group( function() {
	Route::get('/support', 'SupportController@index')->name('support.index');

	Route::prefix('profile')->group( function() {
		Route::get('/', 'ProfileController@index')->name('profile.index');
		Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
		Route::get('/profile/show/{user}', 'ProfileController@show')->name('profile.show');
		Route::post('/profile/name', 'ProfileController@updateName')->name('profile.name');
		Route::post('/profile/email', 'ProfileController@updateEmail')->name('profile.email');
		Route::post('/profile/password', 'ProfileController@updatePassword')->name('profile.password');
	});
});

Route::prefix('dash')->middleware(['auth', 'perm:access-dash'])->group( function() {
	Route::get('/', 'DashController@index')->name('dash.home');
	
	Route::get('/user', 'UserController@index')->middleware('perm:view-user')->name('dash.user.index');
	Route::get('/user/edit/{user}', 'UserController@edit')->middleware('perm:update-user')->name('dash.user.edit');
	Route::put('/user/{user}', 'UserController@ban')->middleware('perm:update-user')->name('dash.user.ban');
	Route::patch('/user/{user}', 'UserController@update')->middleware('perm:update-user')->name('dash.user.update');
	Route::delete('/user/{user}', 'UserController@destroy')->middleware('perm:delete-user')->name('dash.user.destroy');

	Route::get('/role', 'RoleController@index')->middleware('perm:view-role')->name('dash.role.index');
	Route::get('/role/create', 'RoleController@create')->middleware('perm:create-role')->name('dash.role.create');
	Route::get('/role/edit/{role}', 'RoleController@edit')->middleware('perm:update-role')->name('dash.role.edit');
	Route::post('/role', 'RoleController@store')->middleware('perm:create-role')->name('dash.role.store');
	Route::patch('/role/{role}', 'RoleController@update')->middleware('perm:update-role')->name('dash.role.update');
	Route::delete('/role/{role}', 'RoleController@destroy')->middleware('perm:delete-role')->name('dash.role.destroy');

	Route::get('/support', 'SupportController@admin')->middleware('perm:view-assigned-support')->name('dash.support.index');
	Route::get('/support/edit/{support}', 'SupportController@edit')->middleware('perm:update-support')->name('dash.support.edit');
	Route::patch('/support/{support}', 'SupportController@update')->middleware('perm:update-support')->name('dash.support.update');
});
