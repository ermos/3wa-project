<?php
namespace model;

use core\Model;
use core\IntFieldDefinition;
use core\StringFieldDefinition;
use core\DateFieldDefinition;

class RoomType extends Model {

	public function __construct()
	{
		$this->table = "room_type";
		$this->primary_key = "id";

		$this->id = IntFieldDefinition::Create(10);
		$this->name = StringFieldDefinition::Create(45);
	}

}