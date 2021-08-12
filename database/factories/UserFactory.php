<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as FakerCall;

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

$factory->define(User::class, function (FakerCall $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Compania::class, function (FakerCall $faker) {
    $faker = Faker\Factory::create('es_VE');

    return [
        'id' => $faker->numberBetween(0, 123456789),
        'razonSocial' => $faker->word,
        'giro' => $faker->word,
        'rut' => $faker->word,
        'direccion' => $faker->word,
        'telefono' => $faker->word,
        'comuna_id' => $faker->numberBetween(0, 123456789),
        'ciudad_id' => $faker->numberBetween(0, 123456789),
    ];
});

$factory->define(App\Ciudad::class, function (FakerCall $faker) {
    $faker = Faker\Factory::create('es_VE');

    return [
        'id' => $faker->numberBetween(0, 123456789),
        'codigo' => $faker->numberBetween(0, 123456789),
        'nombre' => $faker->word,
    ];
});

$factory->define(App\Comuna::class, function (FakerCall $faker) {
    $faker = Faker\Factory::create('es_VE');

    return [
        'id' => $faker->numberBetween(0, 123456789),
        'codigo' => $faker->numberBetween(0, 123456789),
        'nombre' => $faker->word,
    ];
});