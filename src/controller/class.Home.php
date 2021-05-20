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
		$query = "
		SELECT room.id, room.name as room_name, picture, room_type.name as `type`
		FROM room
		JOIN room_type ON room_type.id = room.room_type_id
		";

		$custom = [];
		$value = [];

		if (isset($_GET["available"])) {
			$c = "";
			$c .= $_GET["available"] == "1" ? "NOT EXISTS (" : "EXISTS (";
			$c .= "
			SELECT 1
			FROM room_booking
			WHERE room_booking.room_id = room.id
			AND room_booking.date_min < ?
			";
			if (isset($_GET["date-min"])) {
				$value[] = $_GET["date-min"];
			} else {
				$value[] = date("Y-m-d");
			}
			if (isset($_GET["date-max"])) {
				$c .= "AND room_booking.date_max > ?";
				$value[] = $_GET["date-max"];
			}
			$c .= ")";

			$custom[] = $c;
		}

		if (isset($_GET["type"])) {
			$c = "room.room_type_id = ?";
			$value[] = $_GET["type"];
			$custom[] = $c;
		}

		if (count($custom) > 0) {
			$query .= "WHERE " . implode(" AND ", $custom);
		}

		$res = DB::Get()->QueryRows($query, ...$value);
		Response::API(200, $res);
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
        	"room_type" => DB::Get()->QueryRows("SELECT * FROM room_type"),
        	"cards" => $this->getCards(),
        ]);
    }

    private function getCards() {
		return DB::Get()->QueryRows("
SELECT
	room_type.name as title,
	(SELECT count(*) FROM room WHERE room_type_id = room_type.id) as `count`,
	(
	SELECT count(*)
	FROM room
	WHERE room_type_id = room_type.id
	AND NOT EXISTS (
	SELECT 1
	FROM room_booking
	WHERE room_booking.room_id = room.id
	AND room_booking.date_min < NOW()
	AND room_booking.date_max > NOW()
	)) as free
FROM room_type
			");
	}

}