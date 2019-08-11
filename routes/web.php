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
Route::get('/logout', 'Backend\Admin\AdminController@logout')->name('admin.logout');

Auth::routes(['register' => false]);


Route::get('/admin/dashboard', 'Backend\Admin\AdminController@dashboard')->name('admin.dashboard');
//help category

// help category


Route::get('admin/login', 'Backend\Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Backend\Admin\AdminLoginController@login')->name('admin.login.submit');
//admin users



	Route::get('admin/login', 'Backend\Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Backend\Admin\AdminLoginController@login')->name('admin.login.submit');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function()
{

	Route::get('/dashboard', 'Backend\Admin\AdminController@dashboard')->name('admin.dashboard');

	Route::get('/mail', 'Backend\Admin\AdminController@checkmail')->name('admin.checkmail');

	Route::match(['get','post'],'/create/helpcategory','Backend\Admin\HelpCategoryController@create')->name('helpcat.create');
	Route::get('/helpcategory','Backend\Admin\HelpCategoryController@list')->name('helpcat.list');
	Route::match(['get','post'],'/edit/helpcategory/{id}','Backend\Admin\HelpCategoryController@edit')->name('helpcat.edit');
	Route::get('/delete/helpcategory/{id}','Backend\Admin\HelpCategoryController@delete')->name('helpcat.delete');

	// Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

	//admin users
	Route::get('/list/users','Backend\Admin\AdminUserController@list')->name('adminuser.list');
	Route::match(['get','post'],'/create/user','Backend\Admin\AdminUserController@create')->name('adminuser.create');
	Route::match(['get','post'],'/edit/user/{id}','Backend\Admin\AdminUserController@edit')->name('adminuser.edit');
	Route::get('/delete/user/{id}','Backend\Admin\AdminUserController@delete')->name('adminuser.delete');
	//admin users
	//admin roles
	Route::get('/list/adminrole','Backend\Admin\AdminRoleController@list')->name('adminrole.list');
	Route::match(['get','post'],'/create/adminrole','Backend\Admin\AdminRoleController@create')->name('adminrole.create');
	Route::match(['get','post'],'/edit/adminrole/{id}','Backend\Admin\AdminRoleController@edit')->name('adminrole.edit');
	Route::get('/delete/adminrole/{id}','Backend\Admin\AdminRoleController@delete')->name('adminrole.delete');
	Route::match(['get','post'],'/manage/adminrole/{roleid}','Backend\Admin\ModuleController@manage')->name('adminrole.managepermission');



	//admin roles
	Route::match(['get','post'],'/sitesetting','Backend\Admin\SiteOptionController@edit')->name('sitesetting');

	//blog category
	Route::get('/list/blogcategory','Backend\Admin\CategoryController@list')->name('adminblogcategory.list');
	Route::match(['get','post'],'/create/blogcategory','Backend\Admin\CategoryController@create')->name('adminblogcategory.create');
	Route::match(['get','post'],'/edit/blogcategory/{id}','Backend\Admin\CategoryController@edit')->name('adminblogcategory.edit');
	Route::get('/delete/blogcategory/{id}','Backend\Admin\CategoryController@delete')->name('adminblogcategory.delete');
	//blog category

	/**
	*Routes for Creating Blog
	**/
	Route::get('/list/blog','Backend\Admin\BlogController@list')->name('blog.list');
	Route::match(['get','post'],'/create/blog','Backend\Admin\BlogController@create')->name('blog.create');
	Route::match(['get','post'],'/edit/blog/{id}/{slug}','Backend\Admin\BlogController@edit')->name('blog.edit');
	Route::get('/delete/blog/{id}','Backend\Admin\BlogController@delete')->name('blog.delete');

	// route for user account
	Route::get('/list/account','Backend\Admin\AccountController@list')->name('account.list');
	Route::match(['get','post'],'/create/account','Backend\Admin\AccountController@create')->name('account.create');
	Route::match(['get','post'],'/edit/account/{id}','Backend\Admin\AccountController@edit')->name('account.edit');
	Route::get('/view/account/{id}','Backend\Admin\AccountController@view')->name('account.view');
	Route::get('/delete/account/{id}','Backend\Admin\AccountController@delete')->name('account.delete');

	//Route for user Account roles
	Route::get('/list/roles','Backend\Admin\RolesController@list')->name('roles.list');
	Route::match(['get','post'],'/create/roles','Backend\Admin\RolesController@create')->name('roles.create');
	Route::match(['get','post'],'/edit/roles/{id}','Backend\Admin\RolesController@edit')->name('roles.edit');
	Route::get('/delete/roles/{id}','Backend\Admin\RolesController@delete')->name('roles.delete');

	//Route for Account Permission
	Route::get('/list/permission','Backend\Admin\PermissionsController@list')->name('permission.list');
	Route::match(['get','post'],'/create/permission','Backend\Admin\PermissionsController@create')->name('permission.create');
	Route::match(['get','post'],'/edit/permission/{id}','Backend\Admin\PermissionsController@edit')->name('permission.edit');
	Route::get('/delete/permission/{id}','Backend\Admin\PermissionsController@delete')->name('permission.delete');

	//Route for Cms
	Route::get('/list/cms','Backend\Admin\CmsController@list')->name('cms.list');
	Route::match(['get','post'],'/create/cms','Backend\Admin\CmsController@create')->name('cms.create');
	Route::match(['get','post'],'/edit/cms/{id}','Backend\Admin\CmsController@edit')->name('cms.edit');
	Route::get('/delete/cms/{id}','Backend\Admin\CmsController@delete')->name('cms.delete');

	//ROute for Testimonial

	Route::get('/list/testimonial','Backend\Admin\TestimonialController@list')->name('testimonial.list');
	Route::match(['get','post'],'/create/testimonial','Backend\Admin\TestimonialController@create')->name('testimonial.create');
	Route::match(['get','post'],'/edit/testimonial/{id}','Backend\Admin\TestimonialController@edit')->name('testimonial.edit');
	Route::get('/delete/testimonial/{id}','Backend\Admin\TestimonialController@delete')->name('testimonial.delete');
});
Route::get('/admin/importmodules','Backend\Admin\AdminUserController@ImportModules')->name('adminuser.importmodules');


		
