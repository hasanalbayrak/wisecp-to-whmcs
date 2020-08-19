<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$invoiceitems = Capsule::table("invoices_items")
    ->get();
$tblInvoiceItems = [];

foreach ($invoiceitems as $invoiceitem) {

    $itemOptions = json_decode($invoiceitem->options);
    $description = $invoiceitem->description;
    if ($itemOptions->addons) {
        $addons = "";
        foreach ($itemOptions->addons as $addon) {
            $addons .= "\r\n".$addon->addon_name." ".$addon->option_name;
        }
        $description = $invoiceitem->description."".$addons;
    }

    $getInvoice = Capsule::table("invoices")
        ->where("id", $invoiceitem->owner_id)
        ->first();

    $dueDate = NULL;
    if ($getInvoice->datepaid != "1881-05-19 00:00:00") {
        $cdate = new \DateTime($getInvoice->datepaid);
        $ccdate = new \DateTime($getInvoice->datepaid);
        $dueDate = $ccdate->format("Y-m-d");
        if ($dueDate == "1970-01-01") {
            $dueDate = new \DateTime($dueDate);
            //$dueDate = $ccdate->modify("+".$itemOptions->period_time." ".$itemOptions->period)->format("Y-m-d");
        }
    }

    $paymentmethod = "banktransfer";
    if ($getInvoice->pmethod == "BankTransfer" || $getInvoice->pmethod == "none" || $getInvoice->pmethod == "Balance") {
        $paymentmethod = "banktransfer";
    }

    $type = "";
    if ($itemOptions->event == "addCredit") {
        $type = "AddFunds";
    }elseif ($itemOptions->event == "RenewalDomain") {
        $type = "Domain";
    }elseif ($itemOptions->event == "DomainNameRegisterOrder") {
        $type = "DomainRegister";
    }elseif ($itemOptions->event == "DomainNameTransferRegisterOrder") {
        $type = "DomainTransfer";
    }else{
        $type = "Hosting";
    }

    $tblInvoiceItems = [
        'id' => $invoiceitem->id,
        'invoiceid' => $invoiceitem->owner_id,
        'userid' => $invoiceitem->user_id,
        'type' => $type,
        'relid' => $invoiceitem->user_pid,
        'description' => $description,
        'amount' => $invoiceitem->total_amount,
        'taxed' => 0,
        'duedate' => $dueDate,
        'paymentmethod' => $paymentmethod,
        'notes' => '',
    ];
    $buildQuery = insert_query('tblinvoiceitems', $tblInvoiceItems);
    if($whmcsDB->query($buildQuery)){
        echo 'Fatura öğesi aktarıldı: Fatura No: '.$invoiceitem->id.'<br />';
    }else{
        echo 'Fatura öğesi AKTARILMADI! -- Fatura No: '.$invoiceitem->id.' - Hata: '.$whmcsDB->error.'<br />';
        error_log("Client invoice items aktarilmiyor. Hata: ".$whmcsDB->error);
    }
}