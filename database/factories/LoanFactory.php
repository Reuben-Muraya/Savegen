<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Loan;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Loan::class, function (Faker $faker) {
    return [
        // 'first_name' => $faker->first_name,
        // 'last_name' => $faker->last_name,
        // 'id_number' => $faker->id_number,
        // 'phone_no' => $faker->phone_no,
        // 'email' => $faker->email,
        // 'amount' => $faker->amount,
        // 'image' => $faker->image,
    ];
});
