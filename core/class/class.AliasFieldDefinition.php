<?php
namespace core;

class AliasFieldDefinition extends FieldDefinition {

	public static function Create(string $name, string $query): Field {
		$f = new Field(ORM_ALIAS);
		return $f->setAlias($name, $query);
	}

}
