<?php
namespace model;

use core\Model;
use core\IntFieldDefinition;
use core\StringFieldDefinition;
use core\DateFieldDefinition;

class Customer extends Model {

	public function __construct()
	{
		$this->table = "customer";
		$this->primary_key = "id";

		$this->id = IntFieldDefinition::Create(10);

		$this->last_name = StringFieldDefinition::Create(45);

		$this->first_name = StringFieldDefinition::Create(45);

		$this->email = StringFieldDefinition::Create(45);

		$this->phone_numer = StringFieldDefinition::Create(45);

		$this->created_at = DateFieldDefinition::Create();

		$this->updated_at = DateFieldDefinition::Create();
	}

}