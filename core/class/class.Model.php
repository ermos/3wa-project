<?php
namespace core;

abstract class Model {

	public string|null $primary_key = null;
	public string|null $table = null;
	private ?QueryBuilder $qb;

	public function __construct() {
		if ($this->table === null) {
			throw new \ErrorException("table name is required");
		}
	}

	public function Query(?array $conditions = [], ?int $limit = null, ?int $offset = null): array|bool {
		$q = new QueryBuilder($this, $conditions, $limit, $offset);
		return $q->Query();
	}

	public function QueryRows(?array $conditions = [], ?int $limit = null, ?int $offset = null): array|bool {
		$q = new QueryBuilder($this, $conditions, $limit, $offset);
		return $q->QueryRows();
	}

	public function Prepare(?array $conditions = [], ?int $limit = null, ?int $offset = null): void {
		$this->qb = new QueryBuilder($this, $conditions, $limit, $offset);
	}

	public function Get(): QueryBuilder {
		if (empty($this->qb)) {
			throw new \Exception("cannot get model's query builder before initialization");
		}
		return $this->qb;
	}
}
