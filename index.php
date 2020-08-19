<?php

require 'init.php';

$result = "";

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

$ticketrepliescount = Capsule::table("tickets_replies")
    ->count();
assign("ticketrepliescount", $ticketrepliescount);

assign("is_form_posted", false);

assign("error_log", $result);

if ($_POST && $_POST["action"] == "import_whmcs" && $_POST["import_whmcs"]) {
    assign("is_form_posted", true);
    $result = "";
    if ($_POST["clients"])
        require __DIR__.'/lists/list.clients.php';
    if ($_POST["currency"])
        require __DIR__.'/lists/list.currencies.php';
    if ($_POST["domains"])
        require __DIR__.'/lists/list.domains.php';
    if ($_POST["hosting"])
        require __DIR__.'/lists/list.hosting.php';
    if ($_POST["invoices"])
        require __DIR__.'/lists/list.invoices.php';
    if ($_POST["invoiceitems"])
        require __DIR__.'/lists/list.invoiceitems.php';
    if ($_POST["pricing"])
        require __DIR__.'/lists/list.price.php';
    if ($_POST["products"])
        require __DIR__.'/lists/list.products.php';
    if ($_POST["servers"])
        require __DIR__.'/lists/list.servers.php';
    if ($_POST["ticketdepartments"])
        require __DIR__.'/lists/list.supportdepartments.php';
    if ($_POST["tickets"])
        require __DIR__.'/lists/list.tickets.php';
    if ($_POST["domaintlds"])
        require __DIR__.'/lists/list.tldlist.php';
    if ($_POST["ticketreplies"])
        require __DIR__.'/lists/list.ticketreplies.php';

    assign("error_log", $result);
}

display("install-step1");