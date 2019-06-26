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

// Route::get('/test',function(){
// 	$controllers = [];
// foreach (Route::getRoutes() as $route)
// {
//     $action = $route->getAction();

//     if (array_key_exists('controller', $action))
//     {
//         // You can also use explode('@', $action['controller']); here
//         // to separate the class name from the method
//         $controllers[] = $action['controller'];
//     }
// }
// echo '<pre>';
// print_r($controllers);exit;
// });

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
//help category
Route::get('/create/helpcat','HelpCategoryController@create')->name('helpcat.create');
Route::post('/create/helpcat','HelpCategoryController@store')->name('helpcat.store');
Route::get('/helpcat','HelpCategoryController@index')->name('helpcat');
Route::get('/edit/helpcat/{id}','HelpCategoryController@edit')->name('helpcat.edit');
Route::post('/edit/helpcat/{id}','HelpCategoryController@update')->name('helpcat.update');
Route::delete('/delete/helpcat/{id}','HelpCategoryController@destroy');
// help category

//admin roles
Route::get('/adminrole','AdminRoleController@index')->name('adminroles');
Route::get('/create/adminrole','AdminRoleController@create')->name('adminrole.create');
Route::post('/create/adminrole','AdminRoleController@store')->name('adminrole.store');
Route::get('/edit/adminrole/{id}','AdminRoleController@edit')->name('adminrole.edit');
Route::post('/edit/adminrole/{id}','AdminRoleController@update')->name('adminrole.update');
Route::delete('/delete/adminrole/{id}','AdminRoleController@destroy')->name('adminrole.delete');

//admin roles
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
