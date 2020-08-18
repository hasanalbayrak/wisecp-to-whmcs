<?php

require 'Connection.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Ramsey\Uuid\Uuid as UUID;

$uuid = UUID::uuid4();
$uuid -> toString();

$DEFAULT_PASSWORD = "DEFAULT_PASSWORD";

$clients = Capsule::table("users")
    ->where("type", "member")
    ->get();
$tblClients = [];
foreach ($clients as $client) {
    $clientAddress = Capsule::table("users_addresses")
        ->where("owner_id", $client->id)
        ->first();
    $city = Capsule::table("cities")
        ->where("id", $clientAddress->city)
        ->first();
    $country = Capsule::table("countries")
        ->where("id", $clientAddress->country_id)
        ->first();
    $creation_time = new \DateTime($client->creation_time);
    $notes = Capsule::table("users_informations")
        ->where("owner_id", $client->id)
        ->where("name", "notes")
        ->first();
    $last_login_time = new \DateTime($client->last_login_time);
    $status = $client->status;
    if ($status == "active") {
        $status = "Active";
    }
    $updated_at = new \DateTime("now");
    $tblClients[] = [
        'id' => $client->id,
        'uuid' => $uuid,
        'firstname' => $client->name,
        'lastname' => $client->surname,
        'companyname' => $client->company_name,
        'email' => $client->email,
        'streetaddress' => $clientAddress->address,
        'streetaddress2' => '',
        'city' => $city->name,
        'state' => '',
        'country' => $country->a2_iso,
        'phonenumber' => $client->phone,
        'tax_id' => '',
        'password' => password_hash($DEFAULT_PASSWORD, PASSWORD_DEFAULT),
        'authmodule' => '',
        'authdata' => '',
        'currency' => $client->currency,
        'defaultgateway' => '',
        'credit' => $client->balance,
        'taxexempt' => 0,
        'latefeeoveride' => 0,
        'overideduenotices' => 0,
        'separateinvoices' => 0,
        'disableautocc' => 0,
        'datecreated' => $creation_time->format("Y-m-d"),
        'notes' => $notes->content,
        'billingcid' => 0,
        'securityqid' => 0,
        'securityqans' => '',
        'groupid' => 0,
        'cartype' => '',
        'cardlastfour' => '',
        'cardnum' => '',
        'startdate' => '',
        'expdate' => '',
        'issuenumber' => '',
        'bankname' => '',
        'banktype' => '',
        'bankcode' => '',
        'bankacct' => '',
        'gatewayid' => '',
        'lastlogin' => $last_login_time->format("Y-m-d H:i:s"),
        'ip' => $client->ip,
        'host' => '',
        'status' => $status,
        'language' => 'turkish',
        'pwresetkey' => '',
        'emailoptout' => 1,
        'marketing_emails_opt_in' => 1,
        'overrideautoclose' => 0,
        'allow_sso' => 1,
        'email_verified' => 0,
        'created_at' => NULL,
        'updated_at' => $updated_at->format("Y-m-d H:i:s"),
        'pwresetexpiry' => NULL
    ];
}

echo json_encode($tblClients, true);