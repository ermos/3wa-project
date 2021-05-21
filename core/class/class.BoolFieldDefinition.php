<?php
namespace core;

class BoolFieldDefinition extends FieldDefinition {

	public static function Create(int $size = 255): Field {
		$f = new Field(ORM_BOOL);
		return $f->setSize($size);
	}

}
