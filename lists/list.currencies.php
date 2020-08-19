<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$currencies = Capsule::table("currencies")
    ->where("status", "active")
    ->get();
$tblcurrencies = [];
foreach ($currencies as $currency) {
    $tblcurrencies = [
        'id' => $currency->id,
        'code' => $currency->code,
        'prefix' => $currency->prefix,
        'suffix' => $currency->suffix,
        'format' => 1,
        'rate' => $currency->rate,
        'default' => $currency->local
    ];
    $buildQuery = insert_query('tblcurrencies', $tblcurrencies);
    if($whmcsDB->query($buildQuery)){
        echo 'Para birimi aktarıldı: Para birimi kodu: '.$currency->code.'<br />';
    }else{
        echo 'Para birimi AKTARILAMADI! -- Para birimi kodu: '.$currency->code.' - Hata: '.$whmcsDB->error.'<br />';
        error_log("Currency aktarilmiyor. Hata: ".$whmcsDB->error);
    }
}