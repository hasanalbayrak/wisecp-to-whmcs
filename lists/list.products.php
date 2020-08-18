<?php

require 'Connection.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$types = [
    // WiseCP => WHMCS
    'hosting' => 'hostingaccount',
    'reseller' => 'reselleraccount',
    'server' => 'server',
    'sms' => 'other',
    'special' => 'other'
];

$products = Capsule::table("products")
    ->get();

foreach ($products as $product) {
    $hidden = 1;
    if ($product->visibility == "visible") {
        $hidden = 0;
    }
    $categories = Capsule::table("categories")
        ->where("id", $product->category)
        ->first();
    $categories_lang = Capsule::table("categories_lang")
        ->where("owner_id", $product->category)
        ->where("lang", "=", "tr")
        ->first();
    $product_lang = Capsule::table("products_lang")
        ->where("owner_id", $product->id)
        ->where("lang", "=", "tr")
        ->first();

    $regenerateWhmcsTypes = $types[$product->type];

    $type = $types[$product->type];
    if (strpos($product_lang->title, "reseller") !== false || strpos($product_lang->title, "Reseller") !== false || strpos($product_lang->title, "RESELLER") !== false || strpos($product_lang->title, "bayi") !== false || strpos($product_lang->title, "Bayi") !== false || strpos($product_lang->title, "BAYİ") !== false) {
        $type = $types["reseller"];
    }

    $showdomainoptions = 1;
    if ($regenerateWhmcsTypes == "other") {
        $showdomainoptions = 0;
    }

    $stockcontrol = 0;
    $qty = 0;
    if ($product->stock != "" || $product->stock != NULL) {
        $stockcontrol = 1;
        $qty = $product->stock;
    }
    $whmcsExcluded[] = [
        'id' => $product->id,
        'type' => $type,
        'gid' => $product->category,
        'name' => $product_lang->title,
        'description' => $product_lang->features,
        'hidden' => $hidden,
        'showdomainoptions' => $showdomainoptions,
        'welcomemail' => NULL, // Tanımlama gerekli
        'stockcontrol' => $stockcontrol,
        'qty' => $qty,
        'proratabiling' => 0,
        'proratadate' => 0,
        'proratachargenextmonth' => 0,
        'paytype' => 'recurring',
        'allowqty' => $stockcontrol,
        'subdomain' => '',
        'autosetup' => '',
        'servertype' => '',
        'servergroup' => 0,
        'configoption1' => '',
        'configoption2' => '',
        'configoption3' => '',
        'configoption4' => '',
        'configoption5' => '',
        'configoption6' => '',
        'configoption7' => '',
        'configoption8' => '',
        'configoption9' => '',
        'configoption10' => '',
        'configoption11' => '',
        'configoption12' => '',
        'configoption13' => '',
        'configoption14' => '',
        'configoption15' => '',
        'configoption16' => '',
        'configoption17' => '',
        'configoption18' => '',
        'configoption19' => '',
        'configoption20' => '',
        'configoption21' => '',
        'configoption22' => '',
        'configoption23' => '',
        'configoption24' => '',
        'freedomain' => '',
        'freedomainpaymentterms' => '',
        'freedomaintlds' => '',
        'recurringcycles' => 0,
        'autoterminatedays' => 0,
        'autoterminateemail' => 0,
        'configoptionsupgrade' => 0,
        'billingcycleupgrade' => '',
        'upgradeemail' => 0,
        'overagesenabled' => '',
        'overagesdisklimit' => 0,
        'overagesbwlimit' => 0,
        'overagesdiskprice' => 0.0000,
        'overagesbwprice' => 0.0000,
        'tax' => 0,
        'affiliateonetime' => 0,
        'affiliatepaytype' => '',
        'affiliatepayamount' => 0.00,
        'order' => $product->rank,
        'retired' => 0,
        'is_featured' => 0,
        'created_at' => $product->ctime,
        'updated_at' => $product->ctime
    ];
}

echo json_encode($whmcsExcluded, true);