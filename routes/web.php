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
Route::get('/logout', 'Admin\AdminController@logout')->name('admin.logout');

Auth::routes(['register' => false]);


Route::get('/admin/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
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

	Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');

	Route::get('/mail', 'Admin\AdminController@checkmail')->name('admin.checkmail');

	Route::match(['get','post'],'/create/helpcategory','Admin\HelpCategoryController@create')->name('helpcat.create');
	Route::get('/helpcategory','Admin\HelpCategoryController@list')->name('helpcat.list');
	Route::match(['get','post'],'/edit/helpcategory/{id}','Admin\HelpCategoryController@edit')->name('helpcat.edit');
	Route::get('/delete/helpcategory/{id}','Admin\HelpCategoryController@delete')->name('helpcat.delete');

	// Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

	//admin users
	Route::get('/list/users','Admin\AdminUserController@list')->name('adminuser.list');
	Route::match(['get','post'],'/create/user','Admin\AdminUserController@create')->name('adminuser.create');
	Route::match(['get','post'],'/edit/user/{id}','Admin\AdminUserController@edit')->name('adminuser.edit');
	Route::get('/delete/user/{id}','Admin\AdminUserController@delete')->name('adminuser.delete');
	//admin users
	//admin roles
	Route::get('/list/adminrole','Admin\AdminRoleController@list')->name('adminrole.list');
	Route::match(['get','post'],'/create/adminrole','Admin\AdminRoleController@create')->name('adminrole.create');
	Route::match(['get','post'],'/edit/adminrole/{id}','Admin\AdminRoleController@edit')->name('adminrole.edit');
	Route::get('/delete/adminrole/{id}','Admin\AdminRoleController@delete')->name('adminrole.delete');
	Route::match(['get','post'],'/manage/adminrole/{roleid}','Admin\ModuleController@manage')->name('adminrole.managepermission');



	//admin roles
	Route::match(['get','post'],'/sitesetting','Admin\SiteOptionController@edit')->name('sitesetting');

	//blog category
	Route::get('/list/blogcategory','Admin\CategoryController@list')->name('adminblogcategory.list');
	Route::match(['get','post'],'/create/blogcategory','Admin\CategoryController@create')->name('adminblogcategory.create');
	Route::match(['get','post'],'/edit/blogcategory/{id}','Admin\CategoryController@edit')->name('adminblogcategory.edit');
	Route::get('/delete/blogcategory/{id}','Admin\CategoryController@delete')->name('adminblogcategory.delete');
	//blog category

	/**
	*Routes for Creating Blog
	**/
	Route::get('/list/blog','Admin\BlogController@list')->name('blog.list');
	Route::match(['get','post'],'/create/blog','Admin\BlogController@create')->name('blog.create');
	Route::match(['get','post'],'/edit/blog/{id}/{slug}','Admin\BlogController@edit')->name('blog.edit');
	Route::get('/delete/blog/{id}','Admin\BlogController@delete')->name('blog.delete');

	// route for user account
	Route::get('/list/account','Admin\AccountController@list')->name('account.list');
	Route::match(['get','post'],'/create/account','Admin\AccountController@create')->name('account.create');
	Route::match(['get','post'],'/edit/account/{id}','Admin\AccountController@edit')->name('account.edit');
	Route::get('/view/account/{id}','Admin\AccountController@view')->name('account.view');
	Route::get('/delete/account/{id}','Admin\AccountController@delete')->name('account.delete');

	//Route for user Account roles
	Route::get('/list/roles','Admin\RolesController@list')->name('roles.list');
	Route::match(['get','post'],'/create/roles','Admin\RolesController@create')->name('roles.create');
	Route::match(['get','post'],'/edit/roles/{id}','Admin\RolesController@edit')->name('roles.edit');
	Route::get('/delete/roles/{id}','Admin\RolesController@delete')->name('roles.delete');

	//Route for Account Permission
	Route::get('/list/permission','Admin\PermissionsController@list')->name('permission.list');
	Route::match(['get','post'],'/create/permission','Admin\PermissionsController@create')->name('permission.create');
	Route::match(['get','post'],'/edit/permission/{id}','Admin\PermissionsController@edit')->name('permission.edit');
	Route::get('/delete/permission/{id}','Admin\PermissionsController@delete')->name('permission.delete');

	//Route for Cms
	Route::get('/list/cms','Admin\CmsController@list')->name('cms.list');
	Route::match(['get','post'],'/create/cms','Admin\CmsController@create')->name('cms.create');
	Route::match(['get','post'],'/edit/cms/{id}','Admin\CmsController@edit')->name('cms.edit');
	Route::get('/delete/cms/{id}','Admin\CmsController@delete')->name('cms.delete');

	//ROute for Testimonial

	Route::get('/list/testimonial','Admin\TestimonialController@list')->name('testimonial.list');
	Route::match(['get','post'],'/create/testimonial','Admin\TestimonialController@create')->name('testimonial.create');
	Route::match(['get','post'],'/edit/testimonial/{id}','Admin\TestimonialController@edit')->name('testimonial.edit');
	Route::get('/delete/testimonial/{id}','Admin\TestimonialController@delete')->name('testimonial.delete');
});
Route::get('/admin/importmodules','Admin\AdminUserController@ImportModules')->name('adminuser.importmodules');


		
