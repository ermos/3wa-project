<?php
session_start();
error_reporting(E_ALL);
require_once "config/config.php";
require_once "core/autoload.php";
require_once "core/controller.php";
require_once "core/response.php";
require_once "core/head.php";

$page = isset($_GET["p"]) ? ucfirst($_GET["p"]) : "Home";
$class_name = "controller\\$page";
$path = "src/controller/class.$page.php";

define("CURRENT_PAGE", $page);

if(file_exists($path)) {
    require_once $path;
    (new $class_name)->run();
} else {
    $error = "404";
    include "src/views/error.php";
}