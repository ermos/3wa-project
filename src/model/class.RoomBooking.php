<?php
namespace model;

use core\Model;
use core\IntFieldDefinition;
use core\DateFieldDefinition;
use core\BoolFieldDefinition;
use core\RelatedFieldDefinition;

class RoomBooking extends Model {

	public function __construct()
	{
		$this->table = "room_booking";
		$this->primary_key = null;

		$this->room_id = IntFieldDefinition::Create(10)
			->manyToOne(new Room());

//		$this->room_name = RelatedFieldDefinition::Create("room_id", "room_type_id");

		$this->room_type = RelatedFieldDefinition::Create("room_id", "room_type");

		$this->customer_id = IntFieldDefinition::Create()
			->manyToOne(new Customer());

		$this->last_name = RelatedFieldDefinition::Create("customer_id", "last_name");

		$this->date_min = DateFieldDefinition::Create();

		$this->date_max = DateFieldDefinition::Create();

		$this->is_paid = BoolFieldDefinition::Create();
	}
}