<?php
namespace controller;

use core\Controller;
use core\DB;
use core\ORM;
use core\Response;

class Booking extends Controller {

	public function api(): void {}

	public function run(): void {
		if (empty($_SESSION["user"])) {
			header("Location: /");
		}

		if (empty($_GET["id"])) {
			header("Location: /");
		}

		$err = "";
		if (isset($_POST["submit"])) {
			$err = $this->insertRoom();
		}

		Response::Show("booking", [
			"room" => $this->getRoom(),
			"error" => $err,
		]);
	}

	private function getRoom(): array|bool {
		$result = ORM::Query("Room", array(["id", "=", $_GET["id"]]));
		if (!$result) {
			return $result;
		}

		$result["booking"] = ORM::QueryRows(
			"Booking",
			array(
				["room_id", "=", $result["id"]],
				["date_max", ">=", date("Y-m-d")],
				["date_min", "<", date("Y-m-d", strtotime(date("Y-m-d") . " + 30 days"))]
			)
		);

		return $result;
	}

	private function insertRoom(): string {
		if (!isset($_POST["room_name"]) || !isset($_POST["room_type"])) {
			return "Un des champs n'a pas été remplis";
		}

		if (strlen(trim($_POST["room_name"])) < 4) {
			return "Le nom de la chambre doit contenir plus de trois lettres/chiffres";
		}

		try {
			DB::Get()->Begin();
			DB::Get()->Insert("INSERT INTO room(`name`, room_type_id) VALUES(?, ?)", $_POST["room_name"], $_POST["room_type"]);
			DB::Get()->Commit();
			setToast(TOAST_SUCCESS, "La chambre à bien été créer");
			header("Location: /");
		}catch (\Exception $e) {
			DB::Get()->Rollback();
			return "Une erreur est survenue";
		}
	}

}