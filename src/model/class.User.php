<?php
namespace model;

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

}