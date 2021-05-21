<?php
namespace core;

class IntFieldDefinition extends FieldDefinition {

	public static function Create(int $size = 255): Field {
		$f = new Field(ORM_INT);
		return $f->setSize($size);
	}

}
