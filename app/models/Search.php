<?php
/**
 * Modelo del motor de busqueda
 */
class Search

{
	private $db;
	public function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}

	public function getProducts($string)
	{
		$sql = 'SELECT * FROM products WHERE deleted=0 AND ( name LIKE :string OR publisher LIKE :string OR author LIKE :string OR people LIKE :string OR description LIKE :string)';
		$query = $this->db->prepare($sql);

		$params = [
			':string' => '%'.$string.'%'
		];
		
		$query->execute($params);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}