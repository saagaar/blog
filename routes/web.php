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

	Route::match(['get','post'],'/create/helpcategory','HelpCategoryController@create')->name('helpcat.create');
	Route::get('/helpcategory','HelpCategoryController@list')->name('helpcat.list');
	Route::match(['get','post'],'/edit/helpcategory/{id}','HelpCategoryController@edit')->name('helpcat.edit');
	Route::get('/delete/helpcategory/{id}','HelpCategoryController@delete')->name('helpcat.delete');

	// Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

	//admin users
	Route::get('/list/users','AdminUserController@list')->name('adminuser.list');
	Route::match(['get','post'],'/create/user','AdminUserController@create')->name('adminuser.create');
	Route::match(['get','post'],'/edit/user/{id}','AdminUserController@edit')->name('adminuser.edit');
	Route::get('/delete/user/{id}','AdminUserController@delete')->name('adminuser.delete');
	//admin users
	//admin roles
	Route::get('/list/adminrole','AdminRoleController@list')->name('adminrole.list');
	Route::match(['get','post'],'/create/adminrole','AdminRoleController@create')->name('adminrole.create');
	Route::match(['get','post'],'/edit/adminrole/{id}','AdminRoleController@edit')->name('adminrole.edit');
	Route::get('/delete/adminrole/{id}','AdminRoleController@delete')->name('adminrole.delete');
	Route::match(['get','post'],'/manage/adminrole/{roleid}','ModuleController@manage')->name('adminrole.managepermission');



	//admin roles
	Route::match(['get','post'],'/sitesetting','SiteOptionController@edit')->name('sitesetting');

	//blog category
	Route::get('/list/blogcategory','CategoryController@list')->name('adminblogcategory.list');
	Route::match(['get','post'],'/create/blogcategory','CategoryController@create')->name('adminblogcategory.create');
	Route::match(['get','post'],'/edit/blogcategory/{id}','CategoryController@edit')->name('adminblogcategory.edit');
	Route::get('/delete/blogcategory/{id}','CategoryController@delete')->name('adminblogcategory.delete');
	//blog category

	/**
	*Routes for Creating Blog
	**/
	Route::get('/list/blog','BlogController@list')->name('blog.list');
	Route::match(['get','post'],'/create/blog','BlogController@create')->name('blog.create');
	Route::match(['get','post'],'/edit/blog/{id}/{slug}','BlogController@edit')->name('blog.edit');
	Route::get('/delete/blog/{id}','BlogController@delete')->name('blog.delete');
	// route for user account
	Route::get('/list/account','AccountController@list')->name('account.list');
	Route::match(['get','post'],'/create/account','AccountController@create')->name('account.create');
	Route::match(['get','post'],'/edit/account/{id}','AccountController@edit')->name('account.edit');
	Route::get('/delete/account/{id}','AccountController@delete')->name('account.delete');

	//Route for user Account roles
	Route::get('/list/roles','RolesController@list')->name('roles.list');
	Route::match(['get','post'],'/create/roles','RolesController@create')->name('roles.create');
	Route::match(['get','post'],'/edit/roles/{id}','RolesController@edit')->name('roles.edit');
	Route::get('/delete/roles/{id}','RolesController@delete')->name('roles.delete');

	//Route for Account Permission
	Route::get('/list/permission','PermissionsController@list')->name('permission.list');
	Route::match(['get','post'],'/create/permission','PermissionsController@create')->name('permission.create');
	Route::match(['get','post'],'/edit/permission/{id}','PermissionsController@edit')->name('permission.edit');
	Route::get('/delete/permission/{id}','PermissionsController@delete')->name('permission.delete');
});
Route::get('/admin/importmodules','AdminUserController@ImportModules')->name('adminuser.importmodules');