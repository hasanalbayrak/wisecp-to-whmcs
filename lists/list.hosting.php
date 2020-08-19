<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$hostings = Capsule::table("users_products")
    ->where("type", "!=", "domain")
    ->get();

$tblHosting = [];

$now = new \DateTime("now");
$result .= '<h3>Ürün ve hizmetler aktarılıyor ...</h3>';

foreach ($hostings as $hosting) {
    $getCheckout = Capsule::table("checkouts")
        ->where("data", "LIKE", "%\"invoice_id\":\"" . $hosting->invoice_id . "\"%")
        ->first();

    $cdate = new \DateTime($hosting->cdate);
    $duedate = new \DateTime($hosting->duedate);
    $hostingOptions = json_decode($hosting->options);

    $domain = "";
    if ($hostingOptions->domain) {
        $domain = $hostingOptions->domain;
    } elseif ($hostingOptions->hostname) {
        $domain = $hostingOptions->hostname;
    }

    $paymentmethod = "";

    if ($hosting->pmethod == "Balance") {
        $paymentmethod = "banktransfer";
    } else {
        $paymentmethod = strtolower($hosting->pmethod);
    }

    $billingcycle = "";
    if ($hosting->period == "month") {
        if ($hosting->period_time == 1) {
            $billingcycle = "Monthly";
        } elseif ($hosting->period_time == 3) {
            $billingcycle = "Quarterly";
        } elseif ($hosting->period_time == 6) {
            $billingcycle = "Semi-Annually";
        }
    } elseif ($hosting->period == "year") {
        if ($hosting->period_time == 1) {
            $billingcycle = "Annually";
        } elseif ($hosting->period_time == 2) {
            $billingcycle = "Biennially";
        } elseif ($hosting->period_time == 3) {
            $billingcycle = "Triennially";
        }
    }

    /**
     * WHMCS
     * Pending
     * Active
     * Completed
     * Suspended
     * Terminated
     * Cancelled
     * Fraud
     */

    $status = "";

    if ($hosting->status == "inprocess") {
        $status = "";
    }elseif ($hosting->status == "waiting") {
        $status = "Pending";
    }elseif ($hosting->status == "cancelled") {
        $status = "Cancelled";
    }elseif ($hosting->status == "active") {
        $status = "Active";
    }elseif ($hosting->status == "suspended") {
        $status = "Suspended";
    }

    if ($now->getTimestamp() > $duedate->getTimestamp()) {
        $status = "Completed";
    }

    $server = 0;
    if ($hostingOptions->server_id) {
        $server = $hostingOptions->server_id;
    }

    $tblHosting = [
        'id' => $hosting->id,
        'userid' => $hosting->owner_id,
        'orderid' => 0,
        //'orderid' => $getCheckout->id,
        'packageid' => $hosting->product_id,
        'server' => $server,
        'regdate' => $cdate->format("Y-m-d"),
        'domain' => $domain,
        'paymentmethod' => $paymentmethod,
        'firstpaymentamount' => $hosting->total_amount,
        'amount' => $hosting->amount,
        'billingcycle' => $billingcycle,
        'nextduedate' => $duedate->format("Y-m-d"),
        'nextinvoicedate' => $duedate->format("Y-m-d"),
        'termination_date' => null,
        'completed_date' => null,
        'domainstatus' => $status,
        'username' => $hostingOptions->config->user,
        'password' => $hostingOptions->config->password,
        'notes' => $hosting->notes,
        'subscriptionid' => '',
        'promoid' => 0,
        'suspendreason' => '',
        'overideautosuspend' => 0,
        'overidesuspenduntil' => null,
        'dedicatedip' => $hostingOptions->ip,
        'assignedips' => $hostingOptions->assigned_ips,
        'ns1' => $hostingOptions->ns1,
        'ns2' => $hostingOptions->ns2,
        'diskusage' => 0,
        'disklimit' => $hostingOptions->disk_limit,
        'bwusage' => 0,
        'bwlimit' => $hostingOptions->bandwidth_limit,
        'lastupdate' => null,
        'created_at' => null,
        'updated_at' => null
    ];
    $buildQuery = insert_query('tblhosting', $tblHosting);
    if($whmcsDB->query($buildQuery)){
        $result .= '<div class="text-success">Ürün / Hizmet aktarıldı: Tanımlı Alan adı: '.$domain.'</div>';
    }else{
        $result .= '<div class="text-danger">Ürün / Hizmet aktarılmadı! - Tanımlı Alan Adı: '.$domain.'<br />Hata mesajı: '.$whmcsDB->error.'</div>';
        error_log("Client hosting aktarilmiyor. Hata: ".$whmcsDB->error);
    }
}