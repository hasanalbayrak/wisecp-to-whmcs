<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$tickets = Capsule::table("tickets")
    ->orderBy("id", "ASC")
    ->get();

$tblTickets = [];

function genTicketMask($id = "")
{
    global $CONFIG;
    $lowercase = "abcdefghijklmnopqrstuvwxyz";
    $uppercase = "ABCDEFGHIJKLMNOPQRSTUVYWXYZ";
    $ticketmaskstr = "";
    $ticketmask = trim($CONFIG["TicketMask"]);
    if (!$ticketmask) {
        $ticketmask = "%n%n%n%n%n%n";
    }
    $masklen = strlen($ticketmask);
    for ($i = 0; $i < $masklen; $i++) {
        $maskval = $ticketmask[$i];
        if ($maskval == "%") {
            $i++;
            $maskval .= $ticketmask[$i];
            if ($maskval == "%A") {
                $ticketmaskstr .= $uppercase[rand(0, 25)];
            } else {
                if ($maskval == "%a") {
                    $ticketmaskstr .= $lowercase[rand(0, 25)];
                } else {
                    if ($maskval == "%n") {
                        $ticketmaskstr .= strlen($ticketmaskstr) ? rand(0, 9) : rand(1, 9);
                    } else {
                        if ($maskval == "%y") {
                            $ticketmaskstr .= date("Y");
                        } else {
                            if ($maskval == "%m") {
                                $ticketmaskstr .= date("m");
                            } else {
                                if ($maskval == "%d") {
                                    $ticketmaskstr .= date("d");
                                } else {
                                    if ($maskval == "%i") {
                                        $ticketmaskstr .= $id;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $ticketmaskstr .= $maskval;
        }
    }
    return $ticketmaskstr;
}
$result .= '<h3>Destek biletleri aktarılıyor ...</h3>';

foreach ($tickets as $ticket) {
    $lastreply = new \DateTime($ticket->lastreply);

    $urgency = "";
    if ($ticket->priority == 1) {
        $urgency = "Low";
    }elseif ($ticket->priority == 2) {
        $urgency = "Medium";
    }elseif ($ticket->priority == 3) {
        $urgency = "High";
    }

    $status = "";
    if ($ticket->status == "process") {
        $status = "In Progress";
    }elseif ($ticket->status == "waiting") {
        $status = "Open";
    }elseif ($ticket->status == "replied") {
        $status = "Answered";
    }elseif ($ticket->status == "solved") {
        $status = "Closed";
    }

    $date = new \DateTime($ticket->ctime);

    $message = Capsule::table("tickets_replies")
        ->where("user_id", $ticket->user_id)
        ->where("owner_id", $ticket->id)
        ->orderBy("id", "ASC")
        ->first();

    $length = 8;
    $seeds = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $c = NULL;
    $seeds_count = strlen($seeds) - 1;
    for ($i = 0; $i < $length; $i++) {
        $c .= $seeds[rand(0, $seeds_count)];
    }

    $tblTickets = [
        'id' => $ticket->id,
        'tid' => genTicketMask($ticket->id), // Random 6 haneli rakam
        'did' => $ticket->did, // Department ID
        'userid' => $ticket->user_id, // Client ID
        'contactid' => 0, // Contact varsa ki taşıma da 0 yap
        'name' => '', // Contact
        'email' => '', // Contact
        'cc' => '', // Contact
        'c' => $c, // Random 8 haneli harf/rakam
        'date' => $date->format("Y-m-d H:i:s"), // Format("Y-m-d H:i:s")
        'title' => $ticket->title,
        'message' => $message->message,
        'status' => $status,
        'urgency' => $urgency,
        'admin' => $message->admin,
        'attachment' => '',
        'attachments_removed' => 0,
        'lastreply' => $lastreply->format("Y-m-d H:i:s"),
        'flag' => 0,
        'clientunread' => 0,
        'adminunread' => '',
        'replyingadmin' => 0,
        'replyingtime' => $lastreply->format("Y-m-d H:i:s"),
        'service' => $ticket->service,
        'merged_ticket_id' => 0,
        'editor' => 'markdown',
        'updated_at' => $lastreply->format("Y-m-d H:i:s")
    ];
    $buildQuery = insert_query('tbltickets', $tblTickets);
    if($whmcsDB->query($buildQuery)){
        $result .= '<div class="text-success">Destek bileti aktarıldı: Bilet Adı: '.$ticket->title.'</div>';
    }else{
        $result .= '<div class="text-danger">Destek bileti aktarılmadı! Bilet Adı: '.$ticket->title.'<br />Hata: '.$whmcsDB->error.'</div>';
        error_log("Destek bileti aktarılmıyor. Hata: ".$whmcsDB->error);
    }
}