<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Entities\Leads;
use Faker\Generator as Faker;

$factory->define(Leads::class, function (Faker $faker) {
    return [
        'lead_date' => date('d-m-Y'),
        'deadline_date' => date('d-m-Y', strtotime('+60 days')),
    ];
});
