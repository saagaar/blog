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
    return view('frontend.welcome');
});
// Route::match(['get','post'],'/admin/login','AdminController@login');

Auth::routes();

// Route::get('/home', 'HomeController@list')->name('home');
// Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/logout', 'Backend\AdminController@logout')->name('admin.logout');

Auth::routes(['register' => false]);


Route::get('/admin/dashboard', 'Backend\AdminController@dashboard')->name('admin.dashboard');
//help category

// help category


Route::get('admin/login', 'Backend\Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Backend\Admin\AdminLoginController@login')->name('admin.login.submit');
//admin users



	Route::get('admin/login', 'Backend\Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Backend\Admin\AdminLoginController@login')->name('admin.login.submit');

Route::get('/home', 'Frontend\HomeController@index')->name('home');

Route::prefix('admin')->group(function()
{

	Route::get('/dashboard', 'Backend\AdminController@dashboard')->name('admin.dashboard');

	Route::get('/mail', 'Backend\AdminController@checkmail')->name('admin.checkmail');

	Route::match(['get','post'],'/create/helpcategory','Backend\HelpCategoryController@create')->name('helpcat.create');
	Route::get('/helpcategory','Backend\HelpCategoryController@list')->name('helpcat.list');
	Route::match(['get','post'],'/edit/helpcategory/{id}','Backend\HelpCategoryController@edit')->name('helpcat.edit');
	Route::get('/delete/helpcategory/{id}','Backend\HelpCategoryController@delete')->name('helpcat.delete');

	// Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

	//admin users
	Route::get('/list/users','Backend\AdminUserController@list')->name('adminuser.list');
	Route::match(['get','post'],'/create/user','Backend\AdminUserController@create')->name('adminuser.create');
	Route::match(['get','post'],'/edit/user/{id}','Backend\AdminUserController@edit')->name('adminuser.edit');
	Route::get('/delete/user/{id}','Backend\AdminUserController@delete')->name('adminuser.delete');
	//admin users
	//admin roles
	Route::get('/list/adminrole','Backend\AdminRoleController@list')->name('adminrole.list');
	Route::match(['get','post'],'/create/adminrole','Backend\AdminRoleController@create')->name('adminrole.create');
	Route::match(['get','post'],'/edit/adminrole/{id}','Backend\AdminRoleController@edit')->name('adminrole.edit');
	Route::get('/delete/adminrole/{id}','Backend\AdminRoleController@delete')->name('adminrole.delete');
	Route::match(['get','post'],'/manage/adminrole/{roleid}','Backend\ModuleController@manage')->name('adminrole.managepermission');



	//admin roles
	Route::match(['get','post'],'/sitesetting','Backend\SiteOptionController@edit')->name('sitesetting');

	//blog category
	Route::get('/list/blogcategory','Backend\CategoryController@list')->name('adminblogcategory.list');
	Route::match(['get','post'],'/create/blogcategory','Backend\CategoryController@create')->name('adminblogcategory.create');
	Route::match(['get','post'],'/edit/blogcategory/{id}','CategoryController@edit')->name('adminblogcategory.edit');
	Route::get('/delete/blogcategory/{id}','CategoryController@delete')->name('adminblogcategory.delete');
	//blog category

	/**
	*Routes for Creating Blog
	**/
	Route::get('/list/blog','Backend\BlogController@list')->name('blog.list');
	Route::match(['get','post'],'/create/blog','Backend\BlogController@create')->name('blog.create');
	Route::match(['get','post'],'/edit/blog/{id}/{slug}','Backend\BlogController@edit')->name('blog.edit');
	Route::get('/delete/blog/{id}','Backend\BlogController@delete')->name('blog.delete');

	// route for user account
	Route::get('/list/account','Backend\AccountController@list')->name('account.list');
	Route::match(['get','post'],'/create/account','Backend\AccountController@create')->name('account.create');
	Route::match(['get','post'],'/edit/account/{id}','Backend\AccountController@edit')->name('account.edit');
	Route::get('/view/account/{id}','Backend\AccountController@view')->name('account.view');
	Route::get('/delete/account/{id}','Backend\AccountController@delete')->name('account.delete');

	//Route for user Account roles
	Route::get('/list/roles','Backend\RolesController@list')->name('roles.list');
	Route::match(['get','post'],'/create/roles','Backend\RolesController@create')->name('roles.create');
	Route::match(['get','post'],'/edit/roles/{id}','Backend\RolesController@edit')->name('roles.edit');
	Route::get('/delete/roles/{id}','Backend\RolesController@delete')->name('roles.delete');

	//Route for Account Permission
	Route::get('/list/permission','Backend\PermissionsController@list')->name('permission.list');
	Route::match(['get','post'],'/create/permission','Backend\PermissionsController@create')->name('permission.create');
	Route::match(['get','post'],'/edit/permission/{id}','Backend\PermissionsController@edit')->name('permission.edit');
	Route::get('/delete/permission/{id}','Backend\PermissionsController@delete')->name('permission.delete');

	//Route for Cms
	Route::get('/list/cms','Backend\CmsController@list')->name('cms.list');
	Route::match(['get','post'],'/create/cms','Backend\CmsController@create')->name('cms.create');
	Route::match(['get','post'],'/edit/cms/{id}','Backend\CmsController@edit')->name('cms.edit');
	Route::get('/delete/cms/{id}','Backend\CmsController@delete')->name('cms.delete');

	//ROute for Testimonial

	Route::get('/list/testimonial','Backend\TestimonialController@list')->name('testimonial.list');
	Route::match(['get','post'],'/create/testimonial','Backend\TestimonialController@create')->name('testimonial.create');
	Route::match(['get','post'],'/edit/testimonial/{id}','Backend\TestimonialController@edit')->name('testimonial.edit');
	Route::get('/delete/testimonial/{id}','Backend\TestimonialController@delete')->name('testimonial.delete');
});
Route::get('/admin/importmodules','Backend\AdminUserController@ImportModules')->name('adminuser.importmodules');


		
