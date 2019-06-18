<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '123456', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(admin_users::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' => '123456', // password
        'role_id' => function () {
            return factory(admin_roles::class)->create()->id;
        },
    ];
});
// $factory->define(admin_roles::class, function (Faker $faker) {
//     return [
//         'role_name' => $faker->unique()->username,
        
//     ];
// });
