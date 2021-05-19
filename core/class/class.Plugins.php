<?php

class Plugins {

	public function __construct()
	{
		foreach (glob("src/plugins/*.php") as $filename)
		{
			require_once $filename;
		}
	}

}