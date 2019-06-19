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
    return [
        'role_name' => $faker->unique()->name,
        
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('123456'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(AdminUsers::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' =>  Hash::make('123456'),// password
        'role_id' => function () {
            return factory(AdminRoles::class)->create()->id;
        },
    ];
});
$factory->define(ModulePermission::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->username,
        'code' => $faker->unique()->name,
        'parent_id'=>$faker->id
    ];
});
$factory->define(SiteOptions::class, function (Faker $faker) {
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
        'country'           =>$faker->country,
        'city'              =>$faker->city 
    ];
});
$factory->define(Countrys::class, function (Faker $faker) {
    return [
        'currency'     =>$faker->currencyCode,
        'country'           =>$faker->country,
    ];
});
