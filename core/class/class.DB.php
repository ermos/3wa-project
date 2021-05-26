<?php
namespace core;

class DB {

	// Instance
	private static ?DBManager $_database = null;
	// Params
	private static ?string $db_name;
	private static ?string $db_host;
	private static ?string $db_user;
	private static ?string $db_password;

	// Initialize database parameters.
	public static function Init($db_name, $db_host, $db_user, $db_password): bool {
		self::$db_name = $db_name;
		self::$db_host = $db_host;
		self::$db_user = $db_user;
		self::$db_password = $db_password;

		return true;
	}

	// Get Database instance.
	public static function Get(): DBManager {
		if (self::$_database === null) {
			self::$_database = new DBManager(self::$db_name, self::$db_host, self::$db_user, self::$db_password);
		}
		return self::$_database;
	}

}
