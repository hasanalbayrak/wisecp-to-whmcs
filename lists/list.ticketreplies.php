<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$ticketreplies = Capsule::table("tickets_replies")
    ->get();

foreach ($ticketreplies as $ticketreply) {

    $date = new \DateTime($ticketreply->ctime);
    $userid = $ticketreply->user_id;
    if ($ticketreply->admin) {
        $userid = 0;
    }

    $admin = "";
    if ($ticketreply->admin) {
        $admin_query = Capsule::table("users")
            ->where("id", "=", $ticketreply->userid)
            ->first();
        $admin = $admin_query->name." ".$admin_query->surname;
    }

    $tblticketreplies = [
        'id' => $ticketreply->id,
        'tid' => $ticketreply->owner_id,
        'userid' => $userid,
        'contactid' => 0,
        'name' => '',
        'email' => '',
        'date' => $date->format("Y-m-d H:i:s"),
        'message' => $ticketreply->message,
        'admin' => $admin,
        'attachment' => '',
        'attachments_removed' => 1,
        'rating' => '0',
        'editor' => 'plain'
    ];

    $buildQuery = insert_query('tblticketreplies', $tblticketreplies);
    if($whmcsDB->query($buildQuery)){
        echo 'Bilet yanıtı eklendi. Yanıt No: '.$ticketreply->id.'<br />';
    }else{
        echo 'Bilet yanıtı AKTARILMADI -- Yanıt No: '.$ticketreply->id.'<br />';
    }
}