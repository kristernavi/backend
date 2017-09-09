<?php

use Faker\Generator as Faker;

$factory->define(App\Folder::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word,
        'description' => $faker->sentence
    ];
});
$factory->define(App\WorkPaper::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word,
        'content' => $faker->sentence,
        'folder_id' => function () {
            return factory('App\Folder')->create()->id;
        }
    ];
});
