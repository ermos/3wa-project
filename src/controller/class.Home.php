<?php
namespace controller;

use core\Controller;
use core\DB;
use core\Response;

class Home extends Controller {

	public function api()
	{
		if ($_SERVER['REQUEST_METHOD'] !== "GET") {
			Response::API(403, [ "message" => "only get request is allowed on this object" ]);
			return;
		}

		if (!isset($_GET["method"])) {
			Response::API(403, [ "message" => "method's query is required" ]);
			return;
		}

		switch (strtolower($_GET["method"])) {
			case "room_list":
				$this->room_list();
				break;
			default:
				Response::API(403, [ "message" => "method not found" ]);
		}
	}

	private function room_list() {

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

        Response::Show("se-connecter", [
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

        $res = DB::Get()->Query("SELECT password FROM user WHERE login = ?", $_POST["username"]);

        if ($res !== false) {
        	if (password_verify($_POST["password"], $res["password"])) {
        		return "";
			}
		}

		return "Le nom d'utilisateur ou le mot de passe est incorrect..";
    }

    private function board() {
        Response::Show("board", [
        	"cards" => array(
        		[ "title" => "Chambres 1L disponible", "free" => 123, "count" => 210 ],
				[ "title" => "Chambres 2L disponible", "free" => 9, "count" => 27 ],
				[ "title" => "Chambres 3L dispoinble", "free" => 2, "count" => 16 ],
				[ "title" => "Chambres 4L dispoinble", "free" => 4, "count" => 10 ],
			)
        ]);
    }

}