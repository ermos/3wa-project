<?php
namespace model;

use core\AliasFieldDefinition;
use core\Model;
use core\IntFieldDefinition;
use core\StringFieldDefinition;
use core\DateFieldDefinition;

class Card extends Model {

	public function __construct()
	{
		$this->table = "room_type";
		$this->primary_key = "id";

		$this->id = IntFieldDefinition::Create(10);

		$this->name = StringFieldDefinition::Create(45)
			->setCustomName("title");

		$this->count = AliasFieldDefinition::Create(
			"count",
			"SELECT count(*) FROM room WHERE room_type_id = room_type.id"
		);

		$this->free = AliasFieldDefinition::Create(
			"free",
			"SELECT count(*)
	FROM room
	WHERE room_type_id = room_type.id
	AND NOT EXISTS (
	SELECT 1
	FROM room_booking
	WHERE room_booking.room_id = room.id
	AND room_booking.date_min < NOW()
	AND room_booking.date_max > NOW()
	)"
		);
	}

}