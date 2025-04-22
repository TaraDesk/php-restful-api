<?php

class Database {

	public function __construct(private $host, private $name, private $user, private $password) {} 

	public function getConnection() {
		$pdo = new PDO("mysql:host=$this->host;dbname=$this->name", $this->user, $this->password, [
			PDO::ATTR_EMULATE_PREPARES => false,
			PDO::ATTR_STRINGIFY_FETCHES => false
		]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $pdo;
	}
}

?>