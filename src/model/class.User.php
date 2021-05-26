<?php
namespace model;

use core\DB;
use core\Model;
use core\IntFieldDefinition;
use core\StringFieldDefinition;
use core\DateFieldDefinition;

class User extends Model {

	public function __construct()
	{
		$this->table = "user";
		$this->primary_key = "id";

		$this->id = IntFieldDefinition::Create(10);
		$this->login = StringFieldDefinition::Create();
		$this->password = StringFieldDefinition::Create();
		$this->email = StringFieldDefinition::Create();
		$this->created_at = DateFieldDefinition::Create();
		$this->updated_at = DateFieldDefinition::Create();
	}

	public static function checkLogin($username, $password): string {
		if (empty($username)) {
			return "Nom d'utilisateur requis !";
		}

		if (empty($password)) {
			return "Mot de passe requis !";
		}

		$res = DB::Get()->Query("SELECT password FROM user WHERE login = ?", $username);

		if ($res !== false) {
			if (password_verify($password, $res["password"])) {
				return "";
			}
		}

		return "Le nom d'utilisateur ou le mot de passe est incorrect..";
	}

}