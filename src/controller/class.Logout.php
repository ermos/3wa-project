<?php
namespace controller;

use config\Controller;

class Logout extends Controller {

	public function api(){}

    public function run() {
        unset($_SESSION["user"]);
        header('Location: /');
    }

}