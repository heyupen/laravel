<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
     'nome' => $faker->name, 
     'username' => $faker->username, 
     'password' => $faker->password,
     'email' => $faker->email, 
     'banca' => $faker->word, 
     'nomeintestatario' => $faker->name,
     'cognomeintestatario' => $faker->lastName,
     'contocarta' => $faker->bankAccountNumber,
     'mesescadenza' => $faker->month,
     'annoscadenza' => $faker->year, 
     'abi' => $faker->ean8, 
     'cab' => $faker->ean8,
     'cin' => $faker->ean8, 
     'rid' => $faker->ean8, 
     'iban' => $faker->iban('IT'),
     'tipologia_pagamento' => '1', 
     'idtipologiacliente' => '1', 
     'telefono' => $faker->phoneNumber, 
     'fax' => $faker->phoneNumber, 
     'pivacf' => $faker->ean8, 
     'indirizzo' => $faker->address, 
     'localita' => $faker->cityPrefix, 
     'comune' => $faker->city,
     'provincia' => $faker->state, 
     'stato' => $faker->country,
     'cap' => $faker->postcode, 
    ];
});
