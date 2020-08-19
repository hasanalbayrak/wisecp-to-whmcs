<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$prices = Capsule::table("prices")
    ->get();

$tblPricing = [];

foreach ($prices as $price) {

    /**
     * WHMCS Types
     * product
     * domainaddons
     * domainregister
     * domaintransfer
     * domainrenew
     * configoptions
     */

    $type = "";
    if ($price->owner == "tld") {
        if ($price->type == "transfer") {
            $type = "domaintransfer";
        }elseif ($price->type == "renewal") {
            $type = "domainrenew";
        }elseif ($price->type == "register") {
            $type = "domainregister";
        }
    }elseif ($price->owner == "products") {
        $type = "product";
    }

    $tblPricing = [
        'id' => $price->id,
        'type' => $type,
        'currency' => $price->cid,
        'relid' => $price->owner_id, // product id
        'msetupfee' => '0.00', // aylık kurulum ücreti
        'qsetupfee' => '0.00', // 3 aylık kurulum ücreti
        'ssetupfee' => '0.00', // 6 aylık kurlum ücreti
        'asetupfee' => '0.00', // yıllık kurulum ücreti
        'bsetupfee' => '0.00', // 2 yıllık kurulum ücreti
        'tsetupfee' => '0.00', // 3 yıllık kurulum ücret
        'monthly' => '0.00', // aylık
        'quarterly' => '0.00', // 3 aylık
        'semiannually' => '0.00', // 6 aylık
        'annually' => '0.00', // yıllık
        'biennially' => '0.00', // 2 yıllık
        'triennially' => '0.00', // 3 yıllık
    ];

    $buildQuery = insert_query('tblpricing', $tblPricing);
    if($whmcsDB->query($buildQuery)){
        echo 'Ürün fiyat alanı eklendi: Ürün ID: '.$price->owner_id.'<br />';
    }else{
        echo 'Ürün fiyat alanı AKTARILMADI! -- Ürün ID: '.$price->owner_id.' - Hata: '.$whmcsDB->error.'<br />';
        error_log("PID Price aktarılmıyor. Hata: ".$whmcsDB->error);
    }
}