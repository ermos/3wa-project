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
        $error = "";

        if (!empty($_POST["username"]) || !empty($_POST["password"])) {
            $error = $this->checkLogin();
            if ($error === "") {
                $_SESSION["user"] = "admin";
                header("Location: /");
                return;
            }
        }

        \Response::Show("se-connecter", [
            'error' => $error
        ]);
    }

    private function checkLogin() {
        if (empty($_POST["username"])) {
            return "Nom d'utilisateur requis !";
        }

        if (empty($_POST["password"])) {
            return "Mot de passe requis !";
        }

        if ($_POST["username"] !== "ksmiti" || $_POST["password"] !== "ksmiti") {
            return "Le nom d'utilisateur ou le mot de passe est incorrect..";
        }

        return "";
    }

    private function board() {
        \Response::Show("board", [
        ]);
    }

}