<?php 
/**
 * Modelo shop de administración
 */
class Adminshop
{
	private $db;
	public function __construct()
	{
		$this->db=MySQLdb::getInstance();
	}
}