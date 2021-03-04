<?php
namespace controller;

use config\Controller;

class Home extends Controller {

    public function run()
    {
        if (empty($_SESSION["user"])) {
            $this->signIn();
            return;
        }

        $this->board();
    }

    private function signIn() {
        \Response::Show("error", []);
    }

    private function board() {

    }

}