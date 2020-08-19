<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$servers = Capsule::table("servers")
    ->orderBy("id", "ASC")
    ->get();
$result .= '<h3>Sunucular aktarılıyor ...</h3>';

$tblServers = [];
foreach ($servers as $server) {
    $secure = "off";
    if ($server->secure == 1) {
        $secure = "on";
    }
    $tblServers = [
        'id' => $server->id,
        'name' => $server->name,
        'ipaddress' => $server->ip,
        'assignedips' => '',
        'hostname' => $server->name,
        'monthlycost' => 0.00,
        'noc' => '',
        'statusaddress' => '',
        'nameserver1' => $server->ns1,
        'nameserver1ip' => '',
        'nameserver2' => $server->ns2,
        'nameserver2ip' => '',
        'nameserver3' => $server->ns3,
        'nameserver3ip' => '',
        'nameserver4' => $server->ns4,
        'nameserver4ip' => '',
        'nameserver5' => '',
        'nameserver5ip' => '',
        'maxaccounts' => $server->maxaccounts,
        'type' => strtolower($server->type),
        'username' => $server->username,
        'password' => $server->password,
        'accesshash' => '',
        'secure' => $secure,
        'port' => $server->port,
        'active' => 1,
        'disabled' => 0
    ];
    $buildQuery = insert_query('tblservers', $tblServers);
    if($whmcsDB->query($buildQuery)){
        $result .= '<div class="text-success">Sunucu aktarıldı: Sunucu Adı: '.$server->name.'</div>';
    }else{
        $result .= '<div class="text-danger">Sunucu aktarılmadı! Sunucu Adı: '.$server->name.'<br />Hata: '.$whmcsDB->error.'</div>';
        error_log("Sunucu aktarılmıyor. Hata: ".$whmcsDB->error);
    }
}