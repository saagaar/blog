<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::match(['get','post'],'/admin/login','AdminController@login');

Auth::routes();

// Route::get('/home', 'HomeController@list')->name('home');
// Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/logout', 'AdminController@logout')->name('admin.logout');

Auth::routes(['register' => false]);


Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
//help category
Route::match(['get','post'],'/create/helpcategory','HelpCategoryController@create')->name('helpcat.create');
Route::get('/admin/helpcategory','HelpCategoryController@list')->name('helpcat.list');
Route::match(['get','post'],'/edit/helpcategory/{id}','HelpCategoryController@edit')->name('helpcat.edit');
Route::get('/delete/helpcategory/{id}','HelpCategoryController@delete')->name('helpcat.delete');
// help category


Route::get('admin/login', 'Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');
//admin users



	Route::get('admin/login', 'Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function()
{

	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	Route::get('/mail', 'AdminController@checkmail')->name('admin.checkmail');



	// Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

	//admin users
	Route::get('/list/users','AdminUserController@list')->name('adminuser.list');
	Route::match(['get','post'],'/create/user','AdminUserController@create')->name('adminuser.create');
	Route::match(['get','post'],'/edit/user/{id}','AdminUserController@edit')->name('adminuser.edit');
	Route::get('/delete/user/{id}','AdminUserController@delete')->name('adminuser.delete');
	//admin users
	//admin roles
	Route::get('/roles','AdminRoleController@list')->name('adminrole.list');
	Route::match(['get','post'],'/createrole','AdminRoleController@create')->name('adminrole.create');
	Route::match(['get','post'],'/editrole/{id}','AdminRoleController@edit')->name('adminrole.edit');
	Route::get('/deleterole/{id}','AdminRoleController@delete')->name('adminrole.delete');


	//admin roles
	Route::match(['get','post'],'/sitesetting','SiteoptionsController@edit')->name('sitesetting.edit');
	//blog category
	Route::get('/list/blogcategory','BlogcategoriesController@list')->name('adminblogcategory.list');
	Route::match(['get','post'],'/create/blogcategory','BlogcategoriesController@create')->name('adminblogcategory.create');
	Route::match(['get','post'],'/edit/blogcategory/{id}','BlogcategoriesController@edit')->name('adminblogcategory.edit');
	Route::get('/delete/blogcategory/{id}','BlogcategoriesController@delete')->name('adminblogcategory.delete');
	//blog category
});
Route::get('/admin/importmodules','AdminUserController@ImportModules')->name('adminuser.importmodules');