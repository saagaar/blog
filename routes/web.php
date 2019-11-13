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

Route::get('/logincheck', function () {
    return response()->json([
   'status'=> \Auth::check()
]);
});

Route::get('/image/{code}/{width}/{name}', 'Frontend\BlogController@resizeImage')->name('image.resize');
Route::get('/blog/detail/{code}', 'Frontend\HomeController@blogDetail')->name('blog.detail');
Route::get('api/blog/detail/{code}', 'Frontend\HomeController@blogDetail')->name('api');
Route::post('/create/comment/{code}', 'Frontend\UserInteractionController@createComment')->name('create.comment');
Route::post('/like/blog/{code}', 'Frontend\UserInteractionController@likeBlog')->name('like.blog');
Route::get('/api/unfollowuser/{username}/{offset}','Frontend\UserController@unfollowuser');
Route::get('/api/followuser/{username}/{offset}','Frontend\UserController@followuser');

Route::get('/api/blog/list/','Frontend\UserController@myBlogs')->name('api');

Route::get('api/dashboard','Frontend\HomeController@dashboard')->name('api');

Route::get('api/profile','Frontend\UserController@profile')->name('api');
Route::get('/profile','Frontend\UserController@profile')->name('profile');
Route::post('/user/changeprofile', 'Frontend\UserController@changeProfile');
Route::get('/settings','Frontend\UserController@settings')->name('settings');

Route::post('/user/change/address', 'Frontend\UserController@changeAddress');
Route::post('/user/change/bio', 'Frontend\UserController@changeBio');
Route::post('/user/change/details', 'Frontend\UserController@changeDetails');
Route::post('/user/change/password', 'Frontend\UserController@changePassword');


Route::get('/dashboard','Frontend\HomeController@dashboard')->name('dashboard');

Route::get('/blog/list','Frontend\UserController@myBlogs')->name('my.blog');

Route::get('/categories', 'Frontend\UserInterestController@categories')->name('categories');
Route::get('/api/categories', 'Frontend\UserInterestController@categories')->name('api');

Route::get('/api/remove/userinterest/{slug}','Frontend\UserInterestController@removeUserInterest');
Route::get('/api/add/userinterest/{slug}','Frontend\UserInterestController@addUserInterest');
Route::get('/api/update-notification-status','Frontend\UserController@updateNotificationStatus')->name('update-notification-status');
Route::get('/category/{slug}','Frontend\HomeController@blogByCategory')->name('blogbycategory');
Route::get('/getblogbycategory/{slug}','Frontend\HomeController@getBlogByCategory')->name('getblogbycategory');
Route::get('/api/getlatestblog','Frontend\HomeController@getLatestBlog')->name('getlatestblog');
Route::get('/api/getfollowers','Frontend\UserController@getFollowers')->name('getfollowers');
Route::get('/api/getfollowings','Frontend\UserController@getFollowings')->name('getfollowings');


Route::get('/test', 'Frontend\FrontendController@index')->name('test');
Route::get('/blog','Frontend\HomeController@index')->name('home');
Route::post('/blog/getTagName','Frontend\HomeController@getTagName')->name('getTagName');


// Route::get('/tests', 'Frontend\UserInteractionController@testinglike')->name('test');
Route::get('/blogs','Frontend\HomeController@index')->name('home');


Route::get('/dashboard/{provider}','Frontend\LoginController@dashboard')->name('dashboard');
Route::get('/social-login/{provider}','Frontend\LoginController@socialLogin')->name('social.login');
// Route::match(['get','post'],'/admin/login','AdminController@login');
Route::post('/blog/login', 'Frontend\LoginController@login')->name('login');
Route::post('/blog/register', 'Frontend\LoginController@register')->name('register');

Route::get('/blog/isemailregistered/{email}', 'Frontend\LoginController@isEmailAlreadyRegistered')->name('useremail');
Route::get('/user/emailupdatecheck/{email}', 'Frontend\UserController@emailAvailabilityForUpdate')->name('useremailupdate');

/**
 * for blog
 */
Route::match(['get','post'],'/blog/add', 'Frontend\BlogController@create');
Route::match(['get','post'],'api/blog/edit/{postid}/step2', 'Frontend\BlogController@updateBlogDetail')->name('api');
Route::match(['get','post'],'api/blog/edit/{postid}', 'Frontend\BlogController@update')->name('api');
Route::match(['get','post'],'blog/edit/{postid}/step2', 'Frontend\BlogController@updateBlogDetail');
Route::match(['get','post'],'/blog/edit/{postid}', 'Frontend\BlogController@update');
Route::match(['get','post'],'api/blog/add', 'Frontend\BlogController@create')->name('api');
Route::match(['get','post'],'api/blog/add', 'Frontend\BlogController@create')->name('api');
Route::get('api/blog/deleteBlog/{code}', 'Frontend\BlogController@delete');
/**
 * for user
 */

Route::get('api/followings','Frontend\UserController@followings')->name('api');
Route::get('/followings','Frontend\UserController@followings')->name('followings');
	
Route::get('api/followers','Frontend\UserController@followers')->name('api');
Route::get('/followers','Frontend\UserController@followers')->name('followers');

Route::get('users/notifications','Frontend\UserController@notifications')->name('user.notification');
Route::get('api/users/notifications','Frontend\UserController@notifications')->name('api');
Auth::routes();

Route::get('/logout/{guard}', 'Controller@logout')->name('logout');

Auth::routes(['register' => false]);


Route::get('/admin/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');



    Route::get('admin/login', 'Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');
    //admin users



	Route::get('admin/login', 'Admin\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('admin/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');

    Route::get('/home', 'Frontend\HomeController@index')->name('home');
    Route::get('api/home', 'Frontend\HomeController@index')->name('api');
    Route::prefix('admin')->group(function()
    {

	Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');

	Route::get('/mail', 'Admin\AdminController@checkmail')->name('admin.checkmail');

	//help category
	Route::match(['get','post'],'/create/helpcategory','Admin\HelpCategoryController@create')->name('helpcat.create');
	Route::get('/helpcategory','Admin\HelpCategoryController@list')->name('helpcat.list');
	Route::match(['get','post'],'/edit/helpcategory/{id}','Admin\HelpCategoryController@edit')->name('helpcat.edit');
	Route::get('/delete/helpcategory/{id}','Admin\HelpCategoryController@delete')->name('helpcat.delete');
	Route::get('changedisplay/helpcategory', 'Admin\HelpCategoryController@changeDisplay')->name('helpcat.changedisplay');
	//**end help category

	// Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

	//admin users
	Route::get('/list/users','Admin\AdminUserController@list')->name('adminuser.list');
	Route::match(['get','post'],'/create/user','Admin\AdminUserController@create')->name('adminuser.create');
	Route::match(['get','post'],'/edit/user/{id}','Admin\AdminUserController@edit')->name('adminuser.edit');
	Route::get('/delete/user/{id}','Admin\AdminUserController@delete')->name('adminuser.delete');
	Route::get('changestatus/user', 'Admin\AdminUserController@changeStatus')->name('adminuser.changestatus');


	//route for changing admin passwords
	Route::match(['get','post'],'/change/password/{id}','Admin\AdminUserController@password')->name('adminuser.change');
	
	//admin roles
	Route::get('/list/adminrole','Admin\AdminRoleController@list')->name('adminrole.list');
	Route::match(['get','post'],'/create/adminrole','Admin\AdminRoleController@create')->name('adminrole.create');
	Route::match(['get','post'],'/edit/adminrole/{id}','Admin\AdminRoleController@edit')->name('adminrole.edit');
	Route::get('/delete/adminrole/{id}','Admin\AdminRoleController@delete')->name('adminrole.delete');
	Route::match(['get','post'],'/manage/adminrole/{roleid}','Admin\AdminPermissionController@manage')->name('adminrole.managepermission');
	Route::get('changestatus/role', 'Admin\AdminRoleController@changeStatus')->name('adminrole.change');

	//admin roles
	Route::match(['get','post'],'/sitesetting','Admin\SiteOptionController@edit')->name('sitesetting');

	//blog category
	Route::get('/list/blogcategory','Admin\CategoryController@list')->name('adminblogcategory.list');
	Route::match(['get','post'],'/create/blogcategory','Admin\CategoryController@create')->name('adminblogcategory.create');
	Route::match(['get','post'],'/edit/blogcategory/{id}','Admin\CategoryController@edit')->name('adminblogcategory.edit');
	Route::get('/delete/blogcategory/{id}','Admin\CategoryController@delete')->name('adminblogcategory.delete');
	Route::get('changestatus/blogcategory', 'Admin\CategoryController@changeStatus')->name('adminblogcategory.changestatus');

	//blog category


	//Route for Tags
	Route::get('/list/tags','Admin\TagController@list')->name('tags.list');
	Route::match(['get','post'],'/create/tags','Admin\TagController@create')->name('tags.create');
	Route::match(['get','post'],'/edit/tags/{id}','Admin\TagController@edit')->name('tags.edit');
	Route::get('/delete/tags/{name}','Admin\TagController@delete')->name('tags.delete');
	Route::get('changestatus/tags', 'Admin\TagController@changeStatus')->name('tags.changestatus');
	/**
	*Routes for Creating Blog
	**/
	Route::get('/list/blog','Admin\BlogController@list')->name('blog.list');
	Route::match(['get','post'],'/create/blog','Admin\BlogController@create')->name('blog.create');
	Route::match(['get','post'],'/edit/blog/{id}/{slug}','Admin\BlogController@edit')->name('blog.edit');
	Route::get('/delete/blog/{id}','Admin\BlogController@delete')->name('blog.delete');
	Route::get('blog/changesavemethod', 'Admin\BlogController@changeSaveMethod')->name('blog.changemethod');

	// route for user account
	Route::get('/list/account','Admin\AccountController@list')->name('account.list');
	Route::match(['get','post'],'/create/account','Admin\AccountController@create')->name('account.create');
	Route::match(['get','post'],'/edit/account/{id}','Admin\AccountController@edit')->name('account.edit');
	Route::get('/view/account/{id}','Admin\AccountController@view')->name('account.view');
	Route::get('/delete/account/{id}','Admin\AccountController@delete')->name('account.delete');

	//Route for user Account roles
	Route::get('/list/roles','Admin\RoleController@list')->name('roles.list');
	Route::match(['get','post'],'/create/roles','Admin\RoleController@create')->name('roles.create');
	Route::match(['get','post'],'/edit/roles/{id}','Admin\RoleController@edit')->name('roles.edit');
	Route::get('/delete/roles/{id}','Admin\RoleController@delete')->name('roles.delete');

	//Route for Account Permission
	Route::get('/list/permission','Admin\PermissionController@list')->name('permission.list');
	Route::match(['get','post'],'/create/permission','Admin\PermissionController@create')->name('permission.create');
	Route::match(['get','post'],'/edit/permission/{id}','Admin\PermissionController@edit')->name('permission.edit');
	Route::get('/delete/permission/{id}','Admin\PermissionController@delete')->name('permission.delete');
	
	//Route for Cms
	Route::get('/list/cms','Admin\CmsController@list')->name('cms.list');
	Route::match(['get','post'],'/create/cms','Admin\CmsController@create')->name('cms.create');
	Route::match(['get','post'],'/edit/cms/{id}','Admin\CmsController@edit')->name('cms.edit');
	Route::get('/delete/cms/{id}','Admin\CmsController@delete')->name('cms.delete');
	Route::get('changestatus/cms', 'Admin\CmsController@changeStatus')->name('cms.changestatus');
	Route::get('changecmstype/cms', 'Admin\CmsController@changeCmsType')->name('cms.cmstype');

	//Route for Testimonial
	Route::get('/list/testimonial','Admin\TestimonialController@list')->name('testimonial.list');
	Route::match(['get','post'],'/create/testimonial','Admin\TestimonialController@create')->name('testimonial.create');
	Route::match(['get','post'],'/edit/testimonial/{id}','Admin\TestimonialController@edit')->name('testimonial.edit');
	Route::get('/delete/testimonial/{id}','Admin\TestimonialController@delete')->name('testimonial.delete');
	Route::get('changestatus/testimonial', 'Admin\TestimonialController@changeStatus')->name('testimonial.changestatus');


//Route for Services
	Route::get('/list/services','Admin\ServiceController@list')->name('services.list');
	Route::match(['get','post'],'/create/services','Admin\ServiceController@create')->name('services.create');
	Route::match(['get','post'],'/edit/services/{id}','Admin\ServiceController@edit')->name('services.edit');
	Route::get('/delete/services/{id}','Admin\ServiceController@delete')->name('services.delete');
	Route::get('changestatus/services', 'Admin\ServiceController@changeStatus')->name('services.changestatus');


//Route for team
	Route::get('/list/team','Admin\TeamController@list')->name('team.list');
	Route::match(['get','post'],'/create/team','Admin\TeamController@create')->name('team.create');
	Route::match(['get','post'],'/edit/team/{id}','Admin\TeamController@edit')->name('team.edit');
	Route::get('/delete/team/{id}','Admin\TeamController@delete')->name('team.delete');
	Route::get('changestatus/team', 'Admin\TeamController@changeStatus')->name('team.changestatus');

	// Route for clients
	Route::get('/list/client','Admin\ClientController@list')->name('client.list');
	Route::match(['get','post'],'/create/client','Admin\ClientController@create')->name('client.create');
	Route::match(['get','post'],'/edit/client/{id}','Admin\ClientController@edit')->name('client.edit');
	Route::get('/delete/client/{id}','Admin\ClientController@delete')->name('client.delete');
	Route::get('changestatus/client', 'Admin\ClientController@changeStatus')->name('client.changestatus');


	// Route for banners
	Route::get('/list/banner','Admin\BannerController@list')->name('banner.list');
	Route::match(['get','post'],'/create/banner','Admin\BannerController@create')->name('banner.create');
	Route::match(['get','post'],'/edit/banner/{id}','Admin\BannerController@edit')->name('banner.edit');
	Route::get('/delete/banner/{id}','Admin\BannerController@delete')->name('banner.delete');
	Route::get('changestatus/banner', 'Admin\BannerController@changeStatus')->name('banner.changestatus');


	// Route for payment gateway
	Route::get('/list/paymentgateway','Admin\PaymentGatewayController@list')->name('paymentgateway.list');
	Route::match(['get','post'],'/create/paymentgateway','Admin\PaymentGatewayController@create')->name('paymentgateway.create');
	Route::match(['get','post'],'/edit/paymentgateway/{id}','Admin\PaymentGatewayController@edit')->name('paymentgateway.edit');
	Route::get('/delete/paymentgateway/{id}','Admin\PaymentGatewayController@delete')->name('paymentgateway.delete');
	Route::get('changestatus/paymentgateway', 'Admin\PaymentGatewayController@changeStatus')->name('paymentgateway.changestatus');
	Route::get('changemode/paymentgateway', 'Admin\PaymentGatewayController@changeMode')->name('paymentgateway.changemode');

		// Route for Subscription Manager
	Route::get('/list/subscriptionmanager','Admin\SubscriptionController@list')->name('subscription.list');
	Route::match(['get','post'],'/edit/subscriptionmanager/{id}','Admin\SubscriptionController@edit')->name('subscription.edit');
	Route::get('changestatus/subscriptionmanager', 'Admin\SubscriptionController@changeStatus')->name('subscription.changestatus');
	
	//route for contact
	Route::get('/list/contact','Admin\ContactController@list')->name('contact.list');
	Route::match(['get','post'],'/edit/contact/{id}','Admin\ContactController@edit')->name('contact.edit');

	//route for gallery category
	Route::get('/list/gallery/category','Admin\GalleryCategoryController@list')->name('gallerycategory.list');
	Route::match(['get','post'],'/create/gallery/category','Admin\GalleryCategoryController@create')->name('gallerycategory.create');
	Route::match(['get','post'],'/edit/gallery/category/{id}','Admin\GalleryCategoryController@edit')->name('gallerycategory.edit');
	Route::get('/delete/gallery/category/{id}','Admin\GalleryCategoryController@delete')->name('gallerycategory.delete');
	Route::get('/view/gallery/category/{id}','Admin\GalleryCategoryController@view')->name('gallerycategory.view');
	Route::get('changestatus/category', 'Admin\GalleryCategoryController@changeStatus')->name('gallerycategory.changestatus');

	//route for Gallery
	Route::get('/list/gallery','Admin\GalleryController@list')->name('gallery.list');
	Route::match(['get','post'],'/create/gallery','Admin\GalleryController@create')->name('gallery.create');
	Route::match(['get','post'],'/edit/gallery/{id}','Admin\GalleryController@edit')->name('gallery.edit');
	Route::get('/delete/gallery/{id}','Admin\GalleryController@delete')->name('gallery.delete');

	//Route for Websitelog
	Route::get('/list/websitelog','Admin\VisitorLogController@list')->name('websitelog.list');
	Route::get('/view/websitelog/{id}','Admin\VisitorLogController@view')->name('websitelog.view');
	Route::get('/block/websitelog/{id}','Admin\VisitorLogController@block')->name('websitelog.block');

	//Route for IP Block List
	Route::get('/list/blocklist','Admin\BlockListController@list')->name('blocklist.list');
	Route::match(['get','post'],'/create/blocklist','Admin\BlockListController@create')->name('blocklist.create');
	Route::match(['get','post'],'/edit/blocklist/{id}','Admin\BlockListController@edit')->name('blocklist.edit');
	Route::get('/delete/blocklist/{id}','Admin\BlockListController@delete')->name('blocklist.delete');

	//route for SEO
	Route::get('/list/seo','Admin\SeoController@list')->name('seo.list');
	Route::match(['get','post'],'/create/seo','Admin\SeoController@create')->name('seo.create');
	Route::match(['get','post'],'/edit/seo/{id}','Admin\SeoController@edit')->name('seo.edit');
	Route::get('/delete/seo/{id}','Admin\SeoController@delete')->name('seo.delete');
	

	//route for languages
	Route::get('/list/language','Admin\LanguageController@list')->name('language.list');
	Route::match(['get','post'],'/create/language','Admin\LanguageController@create')->name('language.create');
	Route::match(['get','post'],'/edit/language/{id}','Admin\LanguageController@edit')->name('language.edit');
	Route::get('/delete/language/{id}','Admin\LanguageController@delete')->name('language.delete');
	Route::get('changestatus/language', 'Admin\LanguageController@changeStatus')->name('language.changestatus');
	
//route for notifications
	Route::get('/list/notification','Admin\NotificationSettingController@list')->name('notification.list');
	Route::match(['get','post'],'/create/notification','Admin\NotificationSettingController@create')->name('notification.create');
	Route::match(['get','post'],'/edit/notification/{id}','Admin\NotificationSettingController@edit')->name('notification.edit');
	Route::get('/delete/notification/{id}','Admin\NotificationSettingController@delete')->name('notification.delete');
	Route::get('changestatus/notification', 'Admin\NotificationSettingController@changeStatus')->name('notification.changestatus');
	
Route::get('/importmodules','Admin\AdminUserController@ImportModules')->name('adminuser.importmodules');

});




		
