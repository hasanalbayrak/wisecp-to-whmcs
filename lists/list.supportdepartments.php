<?php

require 'Connection.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$tickets_departments = Capsule::table("tickets_departments")
    ->get();

$tblTicketDepartments = [];

foreach ($tickets_departments as $tickets_department) {
    $department_lang = Capsule::table("tickets_departments_lang")
        ->where("owner_id", $tickets_department->id)
        ->where("lang", "tr")
        ->first();
    $tblTicketDepartments[] = [
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
}

echo json_encode($tblTicketDepartments, true);