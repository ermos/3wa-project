<?php
namespace core;

abstract class Model {

	public string|null $primary_key = null;
	public string|null $table = null;

	public function __construct()
	{
		if ($this->table === null) {
			throw new \ErrorException("table name is required");
		}
	}

	public function Fetch(int $limit, int $offset): array|bool {
		new ORM($this, array(
			["last_name", "=", "SMITI"]
		), 1, 0);
		die();
		return true;
	}

}
