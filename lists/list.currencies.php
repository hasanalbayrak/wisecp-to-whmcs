<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$currencies = Capsule::table("currencies")
    ->where("status", "active")
    ->get();
$tblcurrencies = [];
$result .= '<h3>Para birimleri aktarılıyor ...</h3>';
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
        $result .= '<div class="text-success">Para birimi aktarıldı: Para birimi kodu: '.$currency->code.'</div>';
    }else{
        $result .= '<div class="text-danger">Para birimi aktarılmadı! - Para birimi kodu: '.$currency->code.'<br />Hata mesajı: '.$whmcsDB->error.'</div>';
        error_log("Currency aktarilmiyor. Hata: ".$whmcsDB->error);
    }
}