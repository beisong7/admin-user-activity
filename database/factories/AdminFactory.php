<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'uid'=>$faker->uuid,
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'phone'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'email_verified_at' => now(),
        'is_disabled'=>false,
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
    ];
});
