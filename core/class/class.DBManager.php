<?php
namespace core;

class DBManager {

	// Database Object
	private $_database = null;

	// Initialize Database.
	public function __construct($db_name, $db_host, $db_user, $db_password) {
		$this->_database = new PDO(sprintf("mysql:dbname=%s;host=%s", $db_name, $db_host), $db_user, $db_password);
	}

	// Begin method start a transaction.
	public function Begin() {
		return $this->_database->beginTransaction();
	}

	// Commit method commit a transaction.
	public function Commit() {
		return $this->_database->commit();
	}

	// Rollback method rollback a transaction.
	public function Rollback() {
		return $this->_database->commit();
	}

	// Query method fetch only one row.
	public function Query($query, ...$args) {
		$stmt = $this->_database->prepare($query);
		$stmt->execute([...$args]);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// QueryRows fetch many rows and returns them in a associative array.
	public function QueryRows($query, ...$args) {
		$stmt = $this->_database->prepare($query);
		$stmt->execute([...$args]);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function Exec($query, ...$args) {
		$stmt = $this->_database->prepare($query);
		$stmt->execute([...$args]);

		if ($stmt->errorInfo()[2] !== null) {
			return false;
		}

		return true;
	}

	public function Insert($query, ...$args) {
		$stmt = $this->_database->prepare($query);
		$stmt->execute([...$args]);

		if ($stmt->errorInfo()[2] !== null && ENVIRONMENT === "dev") {
			var_dump($stmt->errorInfo()[2]);
		}

		return $this->_database->lastInsertId();
	}

}
