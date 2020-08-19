<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$tickets_departments = Capsule::table("tickets_departments")
    ->get();

$tblTicketDepartments = [];
$result .= '<h3>Destek bileti departmanları aktarılıyor ...</h3>';

foreach ($tickets_departments as $tickets_department) {
    $department_lang = Capsule::table("tickets_departments_lang")
        ->where("owner_id", $tickets_department->id)
        ->where("lang", "tr")
        ->first();
    $tblTicketDepartments = [
        'id' => $tickets_department->id,
        'name' => $department_lang->name,
        'description' => $department_lang->description,
        'email' => '',
        'clientsonly' => '',
        'piperepliesonly' => '',
        'noautoresponder' => '',
        'hidden' => '',
        'order' => $tickets_department->rank,
        'host' => '',
        'port' => 110,
        'login' => '',
        'password' => '',
        'feedback_request' => 0
    ];
    $buildQuery = insert_query('tblticketdepartments', $tblTicketDepartments);
    if($whmcsDB->query($buildQuery)){
        $result .= '<div class="text-success">Destek bileti departmanı aktarıldı: Departman Adı: '.$department_lang->name.'</div>';
    }else{
        $result .= '<div class="text-danger">Destek bileti departmanı aktarılmadı! Departman Adı: '.$department_lang->name.'<br />Hata: '.$whmcsDB->error.'</div>';
        error_log("Destek departmanı aktarılmıyor. Hata: ".$whmcsDB->error);
    }
}