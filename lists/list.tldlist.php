<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$tldList = Capsule::table("tldlist")
    ->get();
$result .= '<h3>Alan Adı Uzantıları aktarılıyor ...</h3>';

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
        'grace_period' => '-1',
        'grace_period_fee' => '0.00',
        'redemption_grace_period' => '-1',
        'redemption_grace_period_fee' => '-1.00',
        'created_at' => $created_at->format("Y-m-d H:i:s"),
        'updated_at' => $created_at->format("Y-m-d H:i:s")
    ];

    $buildQuery = insert_query('tbldomainpricing', $tbldomainpricing);
    if($whmcsDB->query($buildQuery)){
        $result .= '<div class="text-success">Alan adı uzantısı aktarıldı: Alan adı uzantısı: '.$item->name.'</div>';
    }else{
        $result .= '<div class="text-danger">Alan adı aktarılmadı! Alan Adı uzantısı: '.$item->name.'<br />Hata: '.$whmcsDB->error.'</div>';
        error_log("Alan adı aktarılmıyor. Hata: ".$whmcsDB->error);
    }
}