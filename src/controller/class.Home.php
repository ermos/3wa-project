<?php
namespace controller;

use config\Controller;

class Home extends Controller {

	public function api()
	{
		if ($_SERVER['REQUEST_METHOD'] !== "GET") {
			\Response::API(403, [ "message" => "only get request is allowed on this object" ]);
			return;
		}
		\Response::API(200, [ "message" => $_SERVER['REQUEST_METHOD'] ]);
	}

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
        	"cards" => array(
        		[ "title" => "Chambres 1L disponible", "free" => 123, "count" => 210 ],
				[ "title" => "Chambres 2L disponible", "free" => 9, "count" => 27 ],
				[ "title" => "Chambres 3L dispoinble", "free" => 2, "count" => 16 ],
				[ "title" => "Chambres 4L dispoinble", "free" => 4, "count" => 10 ],
			)
        ]);
    }

}