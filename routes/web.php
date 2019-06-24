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
Route::get('/create/helpcat','HelpCategoryController@create')->name('admin.helpcat');
Route::post('/create/helpcat','HelpCategoryController@store')->name('helpcat.store');
Route::get('/helpcat','HelpCategoryController@index')->name('helpcat');
Route::delete('/delete/helpcat/{id}','HelpCategoryController@destroy');
// help category

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
Route::get('/adminrole','AdminRoleController@create')->name('admin.role');

// Route::get('/test', 'HomeController@index')->name('home');
