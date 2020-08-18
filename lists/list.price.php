<?php

require 'Connection.php';

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

    $tblPricing[] = [
        'id' => $price->id,
        'type' => $type,
        'currency' => $price->cid,
        'relid' => $price->owner_id, // product id
        'msetupfee' => '', // aylık kurulum ücreti
        'qsetupfee' => '', // 3 aylık kurulum ücreti
        'ssetupfee' => '', // 6 aylık kurlum ücreti
        'asetupfee' => '', // yıllık kurulum ücreti
        'bsetupfee' => '', // 2 yıllık kurulum ücreti
        'tsetupfee' => '', // 3 yıllık kurulum ücret
        'monthly' => '', // aylık
        'quarterly' => '', // 3 aylık
        'semiannually' => '', // 6 aylık
        'annually' => '', // yıllık
        'biennially' => '', // 2 yıllık
        'triennially' => '', // 3 yıllık
    ];
}

echo json_encode($tblPricing, true);