<?php
namespace model;

use core\Model;
use core\IntFieldDefinition;
use core\StringFieldDefinition;

class Room extends Model {

	public function __construct()
	{
		$this->table = "room";
		$this->primary_key = "id";

		$this->id = IntFieldDefinition::Create(10);

		$this->room_type_id = IntFieldDefinition::Create(10)
			->manyToOne("room_type");

		$this->name = StringFieldDefinition::Create();

		$this->picture = StringFieldDefinition::Create();
	}

}