<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Admi;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(AdminRoles::class, function (Faker $faker) {
    $name=$faker->unique()->name;
    $slug=str_replace(' ','-', $name);
    return [
        'role_name' =>$name ,
        'slug'=>$slug
        
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
         'phone' => random_int(9800000000, 9899999999),
         'status' =>'1',
        'email_verified_at' => now(),
        'password' => Hash::make('123456'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(AdminUsers::class, function (Faker $faker) {
    $rolesid = \DB::table('admin_roles')->select('id')->get();
    $role =1;// $faker->randomElement($rolesid)->id;
    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' =>  Hash::make('123456'),// password
        'role_id' => $role
    ];
});
$factory->define(ModulePermission::class, function (Faker $faker) {
    $moduleids = \DB::table('module_permissions')->select('id')->get();
    if($moduleids){
        $moduleid = $faker->randomElement($moduleids)->id;
    }
    else
    {
        $moduleid = '0';
    }
    return [
        'name' => $faker->unique()->username,
        'code' => $faker->unique()->name,
        'display_order'=> 0,
        'parent_id'=>$moduleid
    ];
});

$factory->define(ModuleRolePermissions::class, function (Faker $faker) use ($factory){
    $moduleids = App\Models\ModulePermissions::pluck('id');
    $module=[];
   // foreach($moduleids as $eachids)
   // {
     return [
                 'module_id'=>$moduleids->random(),
                 'role_id'=>1
            ];
   // }
    // return  $module;
});



// factory(ModulePermissions::class, 20)->create()->each(
//     function($modulerole) {
//         factory(App\Models\ModuleRolePermissions::class)->create(['module_id' => $modulerole->id,'role_id'=>1]);
//     }
// );

$factory->define(SiteOptions::class, function (Faker $faker) {
    $countryids = \DB::table('countrys')->select('id')->get();
    $countryid = $faker->randomElement($countryids)->id;
    return [
        'site_name'         =>$faker->unique()->username,
        'contact_name'      =>$faker->name,
        'contact_email'     =>$faker->unique()->safeEmail,
        'contact_number'    =>$faker->phoneNumber,
        'maintainence'      =>Str::random(6),
        'facebook_id'       =>$faker->url,
        'linkedin_id'       =>$faker->url,
        'twitter_id'        =>$faker->url,
        'instagram_id'      =>$faker->url,
        'youtube'           =>$faker->url,
        'timezone'          =>$faker->timezone,
        'currency_sign'     =>$faker->currencyCode,
        'currency_code'     =>$faker->currencyCode,
        'address'           =>$faker->streetAddress,
        'state'             =>$faker->state ,
        'country'           =>$countryid,
        'city'              =>$faker->city 
    ];
});
$factory->define(Countrys::class, function (Faker $faker) {
    return [
        'code'     =>$faker->currencyCode,
        'country'           =>$faker->country,
    ];
});
$factory->define(Cms::class, function (Faker $faker) {
    return [
        'heading'     =>$faker->text($maxNbChars = 20),
        'content'           =>$faker->text,
        'cms_slug'          =>$faker->slug,
        'page_title'        =>$faker->text($maxNbChars = 20),
        'meta_key'          =>$faker->text($maxNbChars = 20),
        'meta_description'  =>$faker->text($maxNbChars = 20)
    ];
});
$factory->define(HelpCategories::class, function (Faker $faker) {
    return 
    [
             'name'     =>$faker->text($maxNbChars = 20)
    ];
});
$factory->define(Helps::class, function (Faker $faker) {
    $categoryids = \DB::table('help_categorys')->select('id')->get();
    $categoryid = $faker->randomElement($categoryids)->id;

    return 
        [
            'category_id'     =>    $categoryid,
            'title'        =>$faker->text($maxNbChars = 20),
            'description'          =>$faker->text($maxNbChars = 20),
        ];
});
$factory->define(EmailSettings::class, function (Faker $faker) {
    return [
        'title'        =>$faker->text($maxNbChars = 20),
        'email_code'          =>$faker->unique()->text($maxNbChars = 20),
        'subject'          =>$faker->text($maxNbChars = 20),
        'email_body'          =>$faker->text,
        'display'             =>$faker->randomElement(['Y' ,'N'])
    ];
});
$factory->define(LogAdminActivitys::class, function (Faker $faker) {
    $usersid = \DB::table('admin_users')->select('id')->get();
    $userid = $faker->randomElement($usersid)->id;
    return [
        'log_time'              =>now(),
        'log_userid'            =>$userid,
        'log_usertype'          =>'1',
        'module_name'           =>$faker->text($maxNbChars = 20),
        'module_desc'           =>$faker->text($maxNbChars = 20),
        'log_action'            =>$faker->text($maxNbChars = 20),
        'log_ip'                =>$faker->text($maxNbChars = 20),
        'log_browser'           =>$faker->text($maxNbChars = 100),
        'log_platform'          =>$faker->text($maxNbChars = 100),
        'log_agent'             =>$faker->text($maxNbChars = 100),
        'log_referer'           =>$faker->text($maxNbChars = 100),
        'log_extra_info'        =>$faker->text($maxNbChars = 10),
        'updated_at'            =>now(),
        `created_at`            =>now()
    ];
});
$factory->define(Categories::class, function (Faker $faker) {
    return [
        'name'                =>$faker->text($maxNbChars = 20),
        'slug'          =>$faker->unique()->text($maxNbChars = 20),
        'display'             =>$faker->randomElement(['Y' ,'N'])
    ];
});
$factory->define(Blogs::class, function (Faker $faker) {
    $users = \DB::table('users')->select('id')->get();
    $userid = $faker->randomElement($users)->id;
    $locales_id = \DB::table('locales')->select('id')->get();
    return [
        'title'                 =>$faker->text($maxNbChars = 20),
        'user_id'               =>'1',
        'code'                  =>$faker->unique()->text($maxNbChars = 20),
        'content'               =>$faker->text($maxNbChars = 20),
        'save_method'             =>$faker->randomElement(['1' ,'2']),
        'locale_id'            =>1,
        'image'                 =>'1569324080.jpg',
        'featured'             =>$faker->randomElement(['1' ,'2']),
        'anynomous'             =>$faker->randomElement(['1' ,'2']),
    ];
});