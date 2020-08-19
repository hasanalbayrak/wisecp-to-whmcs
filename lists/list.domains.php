<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$domains = Capsule::table("users_products")
    ->where("type", "domain")
    ->get();

$tblDomains = [];
$now = new \DateTime("now");

foreach ($domains as $domain) {
    $cdate = new \DateTime($domain->cdate);
    $duedate =  new \DateTime($domain->duedate);

    /**
     * WHMCS Status
     * -----------------------
     *
     * Pending
     * Pending Registration
     * Pending Transfer
     * Active
     * Grace
     * Redemption
     * Expired
     * Transferred Away
     * Cancelled
     * Fraud
     */

    if ($domain->status == "inprocess") {
        $status = "Pending";
    }elseif ($domain->status == "waiting") {
        $status = "Pending";
    }elseif ($domain->status == "cancelled") {
        $status = "Cancelled";
    }elseif ($domain->status == "active") {
        $status = "Active";
    }

    if (($now->getTimestamp() > $duedate->getTimestamp()) && ($domain->status != "waiting" || $domain->status != "cancelled")) {
        $status = "Expired";
    }

    if ($domain->status = "inprocess" && $domain->options->tcode) {
        $status = "Pending Transfer";
    }

    $paymentmethod = "";

    if ($domain->pmethod == "Balance") {
        $paymentmethod = "banktransfer";
    }else{
        $paymentmethod = strtolower($domain->pmethod);
    }

    $domainOptions = json_decode($domain->options);

    $domainAddons = Capsule::table("users_products_addons")
        ->where("owner_id", $domain->id)
        ->where("addon_key", "whois-privacy")
        ->first();

    $idprotection = 0;

    if ($domainAddons) {
        $idprotection = 1;
    }

    $type = "Register";
    if ($domainOptions->tcode) {
        $type = "Transfer";
    }

    $getCheckout = Capsule::table("checkouts")
        ->where("data", "LIKE", "%\"invoice_id\":\"".$domain->invoice_id."\"%")
        ->first();

    $tbldomains = [
        'id' => $domain->id,
        'userid' => $domain->owner_id,
        //'orderid' => $getCheckout->id,
        'orderid' => 0,
        'type' => $type,
        'registrationdate' => $cdate->format("Y-m-d"),
        'domain' => $domain->name,
        'firstpaymentamount' => $domain->total_amount,
        'recurringamount' => $domain->total_amount,
        'registrar' => strtolower($domain->module),
        'registrationperiod' => $domain->period_time,
        'expirydate' => $duedate->format("Y-m-d"),
        'subscriptionid' => '',
        'promoid' => 0,
        'status' => $status,
        'nextduedate' => $duedate->format("Y-m-d"),
        'nextinvoicedate' => $duedate->format("Y-m-d"),
        'additionalnotes' => $domain->notes,
        'paymentmethod' => $paymentmethod,
        'dnsmanagement' => 0,
        'emailforwarding' => 0,
        'idprotection' => $idprotection,
        'is_premium' => 0,
        'donotrenew' => 0,
        'reminders' => '',
        'synced' => 0,
        'created_at' => null,
        'updated_at' => null
    ];
    $buildQuery = insert_query('tbldomains', $tbldomains);
    if($whmcsDB->query($buildQuery)){
        echo 'Satılan alan adı aktarıldı: Alan Adı: '.$domain->name.'<br />';
    }else{
        echo 'Satılan alan adı AKTARILAMADI! -- Alan Adı: '.$domain->name.' - Hata: '.$whmcsDB->error.'<br />';
        error_log("Client domain aktarilmiyor. Hata: ".$whmcsDB->error);
    }
}