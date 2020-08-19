<?php

require 'init.php';

use Illuminate\Database\Capsule\Manager as Capsule;

page_title("Kurulum");

$clientcounts = Capsule::table("users")
    ->where("type", "member")
    ->count();
assign("clientcounts", $clientcounts);

$currencycounts = Capsule::table("currencies")
    ->where("status", "active")
    ->count();
assign("currencycounts", $currencycounts);

$domaincounts = Capsule::table("users_products")
    ->where("type", "domain")
    ->count();
assign("domaincounts", $domaincounts);

$hostingcounts = Capsule::table("users_products")
    ->where("type", "!=", "domain")
    ->count();
assign("hostingcounts", $hostingcounts);

$invoiceitemcounts = Capsule::table("invoices_items")
    ->count();
assign("invoiceitemcounts", $invoiceitemcounts);

$invoicecounts = Capsule::table("invoices")
    ->count();
assign("invoicecounts", $invoicecounts);

$pricecounts = Capsule::table("prices")
    ->count();
assign("pricecounts", $pricecounts);

$productcounts = Capsule::table("products")
    ->count();
assign("productcounts", $productcounts);

$servercounts = Capsule::table("servers")
    ->count();
assign("servercounts", $servercounts);

$tickets_departmentscounts = Capsule::table("tickets_departments")
    ->count();
assign("ticketdepartmentcounts", $tickets_departmentscounts);

$ticketcounts = Capsule::table("tickets")
    ->count();
assign("ticketcounts", $ticketcounts);

$tldListcount = Capsule::table("tldlist")
    ->count();
assign("tldlistcount", $tldListcount);

if ($_POST && $_POST["action"] == "import_whmcs" && $_POST["import_whmcs"]) {
    require __DIR__.'/lists/list.clients.php';
    require __DIR__.'/lists/list.currencies.php';
    require __DIR__.'/lists/list.domains.php';
    require __DIR__.'/lists/list.hosting.php';
    require __DIR__.'/lists/list.invoiceitems.php';
    require __DIR__.'/lists/list.invoices.php';
    require __DIR__.'/lists/list.price.php';
    require __DIR__.'/lists/list.products.php';
    require __DIR__.'/lists/list.servers.php';
    require __DIR__.'/lists/list.supportdepartments.php';
    require __DIR__.'/lists/list.tickets.php';
    require __DIR__.'/lists/list.tldlist.php';
}

display("install-step1");