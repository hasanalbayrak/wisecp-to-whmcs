<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$tickets_departments = Capsule::table("tickets_departments")
    ->get();

$tblTicketDepartments = [];

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
        echo 'Destek talebi departmanı eklendi: Departman Adı: '.$department_lang->name.'<br />';
    }else{
        echo 'Destek talebi departmanı AKTARILMADI! -- Departman Adı: '.$department_lang->name.'<br />';
    }
}