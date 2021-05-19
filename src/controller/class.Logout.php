<?php
namespace controller;

use core\Controller;
use core\Response;

class Logout extends Controller {

	public function api(){}

    public function run() {
        unset($_SESSION["user"]);
        header('Location: /');
    }

}