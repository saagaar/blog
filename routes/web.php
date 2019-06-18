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

// Route::get('/', function () {
//     return view('welcome');
// });
// // Route::match(['get','post'],'/admin/login','AdminController@login');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
// Route::get('/logout', 'AdminController@logout');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(funciton()
{
	Route::get('/login', 'Auth\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
})


// Route::get('/test', 'HomeController@index')->name('home');
