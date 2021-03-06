<?php

use core\Plugins;

session_start();
require_once "../core/const.php";
require_once "../config/config.php";

if (DEV_MODE) {
	error_reporting(E_ALL);
}

require_once "../core/autoload.php";
require_once "../config/db.php";

Plugins::init();

$api = false;

setcookie("toast", "", 1);

if (isset($_GET["api"])) {
	$api = true;
	$page = ucfirst($_GET["api"]);
} else {
	$page = isset($_GET["p"]) ? ucfirst($_GET["p"]) : "Home";
	$page = ucfirst(lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $page)))));
}

$class_name = "controller\\$page";
$path = "../src/controller/class.$page.php";

define("CURRENT_PAGE", $page);

if(file_exists($path)) {
    require_once $path;
    $api ? (new $class_name)->api() : (new $class_name)->run();
} else {
    $error = "404";
    include "../src/views/error.php";
}