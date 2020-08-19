<?php

// Initialize
$configuration = [];

require 'config.php';
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$whmcsDB = new mysqli($configuration["whmcs"]["host"], $configuration["whmcs"]["username"], $configuration["whmcs"]["password"], $configuration["whmcs"]["database"]);
if ($whmcsDB->connect_errno) {
    echo json_encode(['status' => 'error', 'message' => 'WHMCS veritabanına bağlanılamadı. '.$whmcsDB->connect_error]);
    exit();
}

$whmcsDB->set_charset("utf8");

$current = new Capsule;
$current->addConnection($configuration["wisecp"]);
$current->setAsGlobal();
$current->bootEloquent();

$smarty = new Smarty();
$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";
$smarty->cache_dir = "cache";
$smarty->config_dir = "configs";

$now = new \DateTime("now");

session_start();

$sitetitle = "WAGONN Software and Design Solutions";
$version = "v1.0";

function page_title($title)
{
    global $sitetitle;
    global $smarty;
    $smarty->assign("page_title", $title . " - " . $sitetitle);
}

function display($templatefile)
{
    global $smarty;
    $smarty->display($templatefile.".tpl");
}

function assign($smarty_variable, $variable)
{
    global $smarty;
    $smarty->assign($smarty_variable, $variable);
}

function insert_query($table, $array)
{
    global $whmcsDB;
    $fieldnamelist = $fieldvaluelist = "";
    $query = "INSERT INTO " . ($table) . " ";
    foreach ($array as $key => $value) {
        $fieldnamelist .= "`{$key}`,";

        if ($value === "now()") {
            $fieldvaluelist .= "'" . date("YmdHis") . "',";
            continue;
        }

        if ($value === "NULL") {
            $fieldvaluelist .= "NULL,";
            continue;
        }
        $fieldvaluelist .= "'" . $whmcsDB->real_escape_string($value) . "',";
    }

    $fieldnamelist = substr($fieldnamelist, 0, 0 - 1);
    $fieldvaluelist = substr($fieldvaluelist, 0, 0 - 1);
    $query .= "(" . $fieldnamelist . ") VALUES (" . $fieldvaluelist . ")";
    return $query;
}

assign("version", $version);
assign("currentyear", $now->format("Y"));