<?php
namespace core;

class Plugins {

	public static function init(): void {
		foreach (glob("../src/plugins/*.php") as $filename)
		{
			require_once $filename;
		}
	}

}