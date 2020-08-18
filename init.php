<?php

require 'config.php';
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Current;
use Illuminate\Database\Capsule\Manager as Target;

$current = new Current;
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
$version = "v1.0 RC1";

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

assign("version", $version);
assign("currentyear", $now->format("Y"));