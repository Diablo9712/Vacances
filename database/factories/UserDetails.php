<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\UserDetails::class, function (Faker $faker) {
    return [
        'matricule' => 'awdawd',
        'date_embauche' => now(),
        'situation' => 'marie',
        'nbr_enfants' => 3
    ];
});
