<?php
namespace core;

class QueryBuilder {

	private Model $object;
	private array $search;
	private array $fields;
	private string $request_string;
	private array $request_fields = [];
	private array $request_joins = [];
	private array $request_cond = [];
	private array $request_parameters = [];
	private ?int $limit;
	private ?int $offset;

	public function Query(): array|bool  {
		$this->generateRequest();
		return DB::Get()->Query($this->request_string, ...$this->request_parameters);
	}

	public function QueryRows(): array|bool  {
		$this->generateRequest();
		return DB::Get()->QueryRows($this->request_string, ...$this->request_parameters);
	}

	public function Alias(string $name, string $query): QueryBuilder{
		$this->request_fields[] = sprintf("(%s) as %s", $query, $name);
		return $this;
	}

	public function Where(string $cond, ...$args): QueryBuilder{
		$this->request_cond[] = $cond;
		foreach ($args as $arg) {
			$this->request_parameters[] = $arg;
		}
		return $this;
	}

	public function __construct(Model $model, array $search = [], ?int $limit = null, ?int $offset = null)
	{
		$this->object = $model;
		$this->search = $search;
		$this->limit = $limit;
		$this->offset = $offset;

		$this->extractFields();
		$this->generateRequestFields();
		$this->generateConds();
	}

	private function extractFields() {
		foreach (array_keys(get_object_vars($this->object)) as $field) {
			if ($field === "primary_key" || $field === "table") {
				continue;
			}

			$this->fields[$field] = $this->object->$field;
		}
	}

	private function extractRelations(object $object): array {
		$f = [];
		foreach (array_keys(get_object_vars($object)) as $field) {
			if ($field === "primary_key" || $field === "table") {
				continue;
			}

			if ($object->$field->relation_type !== null) {
				$f[$field] = $object->$field;
			}
		}
		return $f;
	}

	private function generateRequestFields() {
		foreach ($this->fields as $name => $field) {
			$table = $this->object->table;
			$field_name = $name;

			switch ($field->getType()) {
				case ORM_RELATED:
					$table = $field->getRelated($this->object)->table;
					$field_name = $field->getRelatedFieldName($this->object);
					break;
				case ORM_ALIAS:
					$this->request_fields[] = sprintf("(%s) as %s", $field->getAliasQuery(), $field->getAliasName());
					continue 2;
				default:
			}

			if ($field->isSelectable()) {
				if ($field->getCustomName() !== null) {
					$this->request_fields[] = sprintf("%s.%s as %s", $table, $field_name, $field->getCustomName());
				} elseif ($field->getType() === ORM_RELATED) {
					$this->request_fields[] = sprintf("%s.%s as %s", $table, $field_name, $name);
				} else {
					$this->request_fields[] = sprintf("%s.%s", $table, $field_name);
				}
			}

			if ($field->relation_type === ORM_MANY_TO_ONE) {
				$this->addRequestJoin($this->object->table, $name, $field->relation);
			}
		}
	}

	private function addRequestJoin(string $current_table, string $field_name, object $relation) {
		$this->request_joins[] = sprintf(
			"JOIN %s ON %s.%s = %s.%s",
			$relation->table,
			$relation->table,
			$relation->primary_key,
			$current_table,
			$field_name
		);
		foreach ($this->extractRelations($relation) as $name => $field) {
			$this->addRequestJoin($relation->table, $name, $field->relation);
		}
	}

	private function generateConds() {
		foreach ($this->search as $value) {
			if (count($value) !== 3) {
				throw new \Exception("search condition need at least three index");
			}
			if (empty($this->fields[$value[0]])) {
				throw new \Exception($value[0] . "'s isn't declared into this object");
			}
			$field = $this->fields[$value[0]];
			if ($field->getType() === ORM_RELATED) {
				$table = $field->getRelated($this->object)->table;
				$field_name = $field->getRelatedFieldName($this->object);
			} else {
				$table = $this->object->table;
				$field_name = $value[0];
			}
			$this->request_cond[] = sprintf("%s.%s %s ?", $table, $field_name, $value[1]);
			$this->request_parameters[] = $value[2];
		}
	}

	private function generateRequest() {
		$this->request_string = "SELECT " . implode(",", $this->request_fields) . "\n";
		$this->request_string .= "FROM " . $this->object->table . "\n";
		if (count($this->request_joins) !== 0) {
			$this->request_string .= implode("\n", $this->request_joins) . "\n";
		}
		if (count($this->request_cond) !== 0) {
			$this->request_string .= "WHERE " . implode("\nAND ", $this->request_cond) . "\n";
		}
		if ($this->limit !== null) {
			$this->request_string .= "LIMIT " . $this->limit . "\n";
			if ($this->offset !== null) {
				$this->request_string .= "OFFSET " . $this->offset . "\n";
			}
		}
	}

}