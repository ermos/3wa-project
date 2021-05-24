<?php
namespace controller;

use core\Controller;
use core\ORM;
use core\Response;
use model\User;

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
		$r = ORM::Prepare("Room");
		if (isset($_GET["available"])) {
			$value = [];
			$date_max = "";
			$cond_type = $_GET["available"] == "1" ? "NOT EXISTS" : "EXISTS";

			$value[] = isset($_GET["date-min"]) ? $_GET["date-min"] : date("Y-m-d");

			if (isset($_GET["date-max"])) {
				$date_max = "AND room_booking.date_max > ?";
				$value[] = $_GET["date-max"];
			}

			$r->Get()->Where($cond_type . "(
			SELECT 1 FROM room_booking
			WHERE room_booking.room_id = room.id
			AND room_booking.date_min < ?
			" . $date_max . ")", ...$value);
		}

		if (isset($_GET["type"])) {
			$r->Get()->Where("room.room_type_id = ?", $_GET["type"]);
		}

		$result = $r->Get()->QueryRows();
		foreach ($result as &$line) {
			$line["booking"] = ORM::QueryRows("Booking", array(["room_id", "=", $line["id"]]));
		}

		Response::API(200, $result);
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
            $error = User::checkLogin($_POST["username"], $_POST["password"]);
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

    private function board() {
        Response::Show("board", [
        	"room_type" => ORM::QueryRows("RoomType"),
        	"cards" => ORM::QueryRows("Card"),
        ]);
    }

}