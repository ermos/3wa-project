<?php
namespace controller;

use core\Controller;
use core\Response;

class Logout extends Controller {

	public function api(): void {}

    public function run(): void {
        unset($_SESSION["user"]);
        header('Location: /');
    }

}