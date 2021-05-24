<?php
namespace core;

class Field {

	private int $type;
	private int $size = 255;
	private bool $nullable = false;
	public ?int $relation_type = null;
	public ?object $relation = null;
	private ?string $related = null;
	private ?string $related_field = null;
	private ?string $custom_name = null;
	private ?string $alias_name = null;
	private ?string $alias_query = null;

	public function __construct(int $type)
	{
		$this->type = $type;
	}

	public function setAlias(string $name, string $query): Field {
		$this->alias_name = $name;
		$this->alias_query = $query;
		return $this;
	}

	public function getAliasName(): ?string {
		return $this->alias_name;
	}

	public function getAliasQuery(): ?string {
		return $this->alias_query;
	}

	public function getRelated(Model $model): ?Model {
		$field = $this->related;
		if ($field === null) {
			return $model;
		}
		$related_field = $this->related_field;
		$related_model = $model->$field->relation;
		if ($related_model->$related_field->related !== null) {
			return $related_model->$related_field->getRelated($related_model);
		}
		return $related_model;
	}

	public function getRelatedFieldName(Model $model): ?string {
		$field = $this->related;
		if ($field === null) {
			return null;
		}
		$related_field = $this->related_field;
		$related_model = $model->$field->relation;
		if ($related_model->$related_field->related !== null) {
			return $related_model->$related_field->getRelatedFieldName($related_model);
		}
		return $related_field;
	}

	public function getType(): int {
		return $this->type;
	}

	public function setSize(int $size): Field {
		$this->size = $size;
		return $this;
	}

	public function setRelated(string $src, string $field): Field {
		$this->related = $src;
		$this->related_field = $field;
		return $this;
	}

	public function setNullable(bool $nullable): Field {
		$this->nullable = $nullable;
		return $this;
	}

	public function setCustomName(string $name): Field {
		$this->custom_name = $name;
		return $this;
	}

	public function getCustomName(): ?string {
		return $this->custom_name;
	}

	public function manyToOne(object $model): Field {
		$this->relation_type = ORM_MANY_TO_ONE;
		$this->relation = $model;
		return $this;
	}

	public function oneToMany(object $model): Field {
		$this->relation_type = ORM_ONE_TO_MANY;
		$this->relation = $model;
		return $this;
	}

	public function manyToMany(object $model): Field {
		$this->relation_type = ORM_MANY_TO_MANY;
		$this->relation = $model;
		return $this;
	}

}