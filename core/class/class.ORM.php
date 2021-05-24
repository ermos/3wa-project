<?php
namespace core;

use core\Model;

class ORM {

	public static function Query(string $object, ?array $conditions = [], ?int $limit = null, ?int $offset = null): array|bool {
		$className = "model\\" . $object;
		$model = new $className;
		return $model->Query($conditions, $limit, $offset);
	}

	public static function QueryRows(string $object, ?array $conditions = [], ?int $limit = null, ?int $offset = null): array|bool {
		$className = "model\\" . $object;
		$model = new $className;
		return $model->QueryRows($conditions, $limit, $offset);
	}

	public static function Prepare(string $object, ?array $conditions = [], ?int $limit = null, ?int $offset = null): Model {
		$className = "model\\" . $object;
		$model = new $className;
		$model->Prepare($conditions, $limit, $offset);
		return $model;
	}

}