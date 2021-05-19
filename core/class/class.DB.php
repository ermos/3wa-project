<?php

class DB {

	// Instance
	private static $_database = null;
	// Params
	private static $db_name;
	private static $db_host;
	private static $db_user;
	private static $db_password;

	// Initialize database parameters.
	public static function Init($db_name, $db_host, $db_user, $db_password) {
		self::$db_name = $db_name;
		self::$db_host = $db_host;
		self::$db_user = $db_user;
		self::$db_password = $db_password;

		return true;
	}

	// Get Database instance.
	public static function Get() {
		if (self::$_database === null) {
			self::$_database = new DBManager(self::$db_name, self::$db_host, self::$db_user, self::$db_password);
		}
		return self::$_database;
	}

}
