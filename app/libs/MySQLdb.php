<?php

/**
 * Manejo de la base de datos
 */
class MySQLdb
{

	private $host = 'mysql';
	private $user = 'homestead';
	private $pass = 'secret';
	private $dbname = 'tienda';

	private static $instance = null;
	private $db = null;

	private function __construct()
	{
		$options = [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		];

		try {
			$this->db = new PDO(
				'mysql:host='.$this->host.';dbname='.$this->dbname,
				$this->user,
				$this->pass,
				$options
			);
		} catch(PDOException $e) {
			exit('La base de datos esta inaccesible');
		}
	}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new MySQLdb();
		}

		return self::$instance;
	}

	public function getDatabase()
	{
		return $this->db;
	}
}