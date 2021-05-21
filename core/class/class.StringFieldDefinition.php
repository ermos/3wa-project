<?php
namespace core;

class StringFieldDefinition extends FieldDefinition {

	public static function Create(int $size = 255): Field {
		$f = new Field(ORM_STRING);
		return $f->setSize($size);
	}

}
