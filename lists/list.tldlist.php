<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$tldList = Capsule::table("tldlist")
    ->get();

foreach ($tldList as $item) {
    $created_at = new \DateTime($item->cdate);
    $tbldomainpricing = [
        'id' => $item->id,
        'extension' => '.'.$item->name,
        'dnsmanagement' => $item->dns_manage,
        'emailforwarding' => 0,
        'idprotection' => $item->whois_privacy,
        'eppcode' => $item->epp_code,
        'autoreg' => '',
        'order' => $item->rank,
        'group' => '',
        'grace_period' => '',
        'grace_period_fee' => '',
        'redemption_grace_period' => '',
        'redemption_grace_period_fee' => '',
        'created_at' => $created_at->format("Y-m-d H:i:s"),
        'updated_at' => $created_at->format("Y-m-d H:i:s")
    ];

    $buildQuery = insert_query('tbldomainpricing', $tbldomainpricing);
    if($whmcsDB->query($buildQuery)){
        echo 'Alan adı eklendi: Alan Adı Uzantısı: '.$item->name.'<br />';
    }else{
        echo 'Alan adı AKTARILMADI! -- Alan Adı Uzantısı: '.$item->name.'<br />';
    }
}