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

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/logout', 'AdminController@logout')->name('admin.logout');

Auth::routes(['register' => false]);


Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
//help category
Route::match(['get','post'],'/create/helpcategory','HelpCategoryController@create')->name('helpcat.create');
Route::get('/admin/helpcategory','HelpCategoryController@index')->name('helpcat');
Route::match(['get','post'],'/edit/helpcategory/{id}','HelpCategoryController@edit')->name('helpcat.edit');
Route::get('/delete/helpcategory/{id}','HelpCategoryController@destroy')->name('helpcat.delete');
// help category

//admin roles
Route::get('/admin/roles','AdminRoleController@index')->name('adminroles');
// Route::get('/admin/createrole','AdminRoleController@create')->name('adminrole.create');
// Route::post('/admin/createrole','AdminRoleController@store')->name('adminrole.store');

Route::match(['get','post'],'/admin/createrole','AdminRoleController@create')->name('adminrole.create');

// Route::match(['get','post'],'/admin/editrole/{id}','AdminRoleController@edit')->name('adminrole.edit');

Route::get('/admin/editrole/{id}','AdminRoleController@edit')->name('adminrole.edit');
Route::post('/admin/editrole/{id}','AdminRoleController@update')->name('adminrole.update');
Route::get('/admin/deleterole/{id}','AdminRoleController@destroy')->name('adminrole.delete');

//admin roles

//admin users
Route::get('/admin/users','AdminUserController@index')->name('adminusers');
Route::get('/admin/createuser','AdminUserController@create')->name('adminuser.create');
Route::post('/admin/createuser','AdminUserController@store')->name('adminuser.store');
Route::get('/admin/edituser/{id}','AdminUserController@edit')->name('adminuser.edit');
Route::post('/admin/edituser/{id}','AdminUserController@update')->name('adminuser.update');
Route::get('/admin/deleteuser/{id}','AdminUserController@destroy')->name('adminuser.delete');
//admin users

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function()
{
	Route::get('/login', 'Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
	Route::get('/mail', 'AdminController@checkmail')->name('admin.checkmail');

	// Route::group(['middleware' => ['auth:admin']], function () 
	// {
	// });
	// Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

});
