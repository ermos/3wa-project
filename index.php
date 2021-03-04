<?php
require_once "core/autoload.php";
require_once "core/controller.php";
require_once "core/response.php";
require_once "core/head.php";

$page = $_GET["p"] ? ucfirst($_GET["p"]) : "Home";
$class_name = "controller\\$page";
$path = "src/controller/class.$page.php";

if(file_exists($path)) {
    require_once $path;
    (new $class_name)->run();
} else {
    $error = "404";
    include "src/views/error.php";
}