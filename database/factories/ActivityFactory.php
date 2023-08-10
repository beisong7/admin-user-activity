<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activity;
use App\Models\Admin;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'uid'=>$faker->uuid,
        'created_by' => Admin::first()->uid,
        'title' => $faker->company,
        'description' => $faker->sentence,
        'image' => 'sample.jpg',
        'type' => 'global',
        'date' => date('Y-m-d')
    ];
});
