<?php

require 'Connection.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$currencies = Capsule::table("currencies")
    ->where("status", "active")
    ->get();
$tblcurrencies = [];
foreach ($currencies as $currency) {
    $tblcurrencies[] = [
        'id' => $currency->id,
        'code' => $currency->code,
        'prefix' => $currency->prefix,
        'suffix' => $currency->suffix,
        'format' => 1,
        'rate' => $currency->rate,
        'default' => $currency->local
    ];
}

echo json_encode($tblcurrencies, true);