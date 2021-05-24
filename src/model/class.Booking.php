<?php
namespace model;


use core\DateFieldDefinition;
use core\IntFieldDefinition;
use core\Model;

class Booking extends Model {

	public function __construct()
	{
		$this->table = "room_booking";
		$this->primary_key = null;

		$this->room_id = IntFieldDefinition::Create(10)->select(false);

		$this->date_min = DateFieldDefinition::Create();

		$this->date_max = DateFieldDefinition::Create();
	}

}