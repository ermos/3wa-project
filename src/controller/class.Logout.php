<?php
namespace controller;

use config\Controller;

class Logout extends Controller {

    public function run() {
        unset($_SESSION["user"]);
        header('Location: /');
    }

}