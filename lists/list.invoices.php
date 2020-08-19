<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$invoices = Capsule::table("invoices")
    ->get();

$tblInvoices = [];
$result .= '<h3>Faturalar aktarılıyor ...</h3>';

foreach ($invoices as $invoice) {
    $cdate = new \DateTime($invoice->cdate);
    $duedate = new \DateTime($invoice->duedate);
    $datepaid = new \DateTime($invoice->datepaid);
    $refunddate = new \DateTime($invoice->refunddate);

    $datePaid = $datepaid->format("Y-m-d H:i:s");
    $refundDate = $refunddate->format("Y-m-d H:i:s");
    if ($datepaid->format("Y-m-d H:i:s") == "1881-05-19 00:00:00") {
        $datePaid = "0000-00-00 00:00:00";
    }
    if ($refunddate->format("Y-m-d H:i:s") == "1881-05-19 00:00:00") {
        $refundDate = "0000-00-00 00:00:00";
    }
    $credit = 0.00;
    if ($invoice->pmethod == "Balance") {
        $credit = $invoice->total;
    }

    $status = "";
    if ($invoice->status == "waiting") {
        $status = "Pending";
    }elseif ($invoice->status == "cancelled") {
        $status = "Cancelled";
    }elseif ($invoice->status == "unpaid") {
        $status = "Unpaid";
    }elseif ($invoice->status == "paid") {
        $status = "Paid";
    }elseif ($invoice->status == "refund") {
        $status = "Refund";
    }

    $paymentmethod = "banktransfer";
    if ($invoice->pmethod == "BankTransfer" || $invoice->pmethod == "none" || $invoice->pmethod == "Balance") {
        $paymentmethod = "banktransfer";
    }

    $tblInvoices = [
        'id' => $invoice->id,
        'userid' => $invoice->user_id,
        'invoicenum' => '',
        'date' => $cdate->format("Y-m-d"),
        'duedate' => $duedate->format("Y-m-d"),
        'datepaid' => $datePaid,
        'last_capture_attempt' => '0000-00-00 00:00:00',
        'date_refunded' => $refundDate,
        'date_cancelled' => '0000-00-00 00:00:00',
        'subtotal' => $invoice->subtotal,
        'credit' => $credit,
        'tax' => $invoice->tax,
        'tax2' => 0.00,
        'total' => $invoice->total,
        'taxrate' => $invoice->taxrate,
        'taxrate2' => 0.00,
        'status' => $status,
        'paymentmethod' => $paymentmethod,
        'paymethodid' => 0, // BAKILACAK
        'notes' => $invoice->notes,
        'created_at' => $cdate->format("Y-m-d H:i:s"),
        'updated_at' => $cdate->format("Y-m-d H:i:s")
    ];
    $buildQuery = insert_query('tblinvoices', $tblInvoices);
    if($whmcsDB->query($buildQuery)){
        $result .= '<div class="text-success">Fatura aktarıldı: Fatura ID: '.$invoice->id.'</div>';
    }else{
        $result .= '<div class="text-danger">Fatura aktarılmadı! Fatura ID: '.$invoice->id.'<br />Hata: '.$whmcsDB->error.'</div>';
        error_log("Client invoice aktarilmiyor. Hata: ".$whmcsDB->error);
    }
}