<?php
/**
 * Modelo Admin
 */
class Admin
{
	private $db;
	public function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}

	public function verifyUser($data)
	{
		$errors = [];

		$password = hash_hmac('sha512', $data['password'],ENCRIPTKEY);

		$sql = 'SELECT * FROM admins WHERE email = :email';
		$query = $this->db->prepare($sql);

		$query->execute([':email' => $data['email']]);

		$admins = $query->fetchAll(PDO::FETCH_OBJ);

		if (empty($admins)) {	
			array_push($errors, 'El usuario no existe');
		}elseif (count($admins) > 1) {
			array_push($errors, 'El correo electrónico está duplicado');
		}elseif($password!=$admins[0]->password){
			array_push($errors, 'La clave de acceso no es correcta');
		}elseif($admins[0]->status==0){
			array_push($errors, 'El usuario esta esactivado');
		}elseif($admins[0]->deleted==1){
			array_push($errors, 'El usuario dado de baja');
		}else{
			$sql2 = 'UPDATE admins SET login_at=:login_at WHERE id=:id';
			$query2 = $this->db->prepare($sql2);

			$params = [
				':login_at' => date('Y-m-d H:i:s'),
				':id' => $admins[0]->id
			];

			if (! $query2->execute($params)) {
				array_push($errors, 'Error al modificar la fecha de acceso del administrador');
			}
		}
	}
}