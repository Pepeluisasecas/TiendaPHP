<?php

/**
 * Modelo de los libros
 */
class Book
{
	private $db;
	public function __construct()
	{
		$this->db = MySQldb::getInstance()->getDatabase;
	}

	public function getBooks()
	{
		$sql = 'SELECT * FROM products WHERE deleted = 0 AND type = 2';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}