<?php
namespace model;

use core\Model;
use core\IntFieldDefinition;
use core\DateFieldDefinition;
use core\BoolFieldDefinition;

class RoomBooking extends Model {

	public function __construct()
	{
		$this->table = "user";
		$this->primary_key = null;

		$this->room_id = IntFieldDefinition::Create(10)
			->manyToOne("room");

		$this->customer_id = IntFieldDefinition::Create()
			->manyToOne("customer");

		$this->date_min = DateFieldDefinition::Create();

		$this->date_max = DateFieldDefinition::Create();

		$this->is_paid = BoolFieldDefinition::Create();
	}
}