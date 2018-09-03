<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Building::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Rack::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'size' => rand(20, 42)
    ];
});

$factory->define(App\Unit::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'position' => 1,
        'type_id' => 1,
        'rack_id' => 1,
    ];
});