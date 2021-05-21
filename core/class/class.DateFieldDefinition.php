<?php
namespace core;

class DateFieldDefinition extends FieldDefinition {

	public static function Create(int $size = 255): Field {
		$f = new Field(ORM_TIMESTAMP);
		return $f->setSize($size);
	}

}
