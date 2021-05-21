<?php
namespace core;

class Field {

	private int $type;
	private int $size = 255;
	private bool $nullable = false;
	private int|null $relation_type = null;
	private string|null $relation = null;
	private string|null $related = null;

	public function __construct(int $type)
	{
		$this->type = $type;
	}

	public function getType(): string {
		return $this->type;
	}

	public function setSize(int $size): Field {
		$this->size = $size;
		return $this;
	}

	public function setRelated(string $related): Field {
		$this->related = $related;
		return $this;
	}

	public function setNullable(bool $nullable): Field {
		$this->nullable = $nullable;
		return $this;
	}

	public function manyToOne(string $field_name): Field {
		$this->relation_type = ORM_MANY_TO_ONE;
		$this->relation = $field_name;
		return $this;
	}

	public function oneToMany(string $field_name): Field {
		$this->relation_type = ORM_ONE_TO_MANY;
		$this->relation = $field_name;
		return $this;
	}

	public function manyToMany(string $field_name): Field {
		$this->relation_type = ORM_MANY_TO_MANY;
		$this->relation = $field_name;
		return $this;
	}

}