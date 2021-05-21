<?php
namespace core;

class RelatedFieldDefinition extends FieldDefinition {

	public static function Create(string $field): Field {
		$f = new Field(ORM_RELATED);
		return $f->setRelated($field);
	}

}
