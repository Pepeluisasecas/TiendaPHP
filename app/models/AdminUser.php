<?php 
/**
 * Administración de usuarios
 */
class AdminUser
{
	private $db;


	public function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}

	public function createAdminUser($data)
	{
		if ( ! $this->existsEmail($data['email'])){

			$sql = 'INSERT INTO admins(name, email, password, status, deleted, login_at, created_at, updated_at, deleted_at) VALUES (:name, :email, :password, :status, :deleted, :login_at, :created_at, :updated_at, :deleted_at)';
			$query = $this->db->prepare($sql);
			$params = [
				':name' => $data['name'],
				':email' => $data['email'],
				':password' => hash_hmac('sha512', $data['password'], 'ENCRIPTKEY'),
				':status' => 1,
				':deleted' => 0,
				':login_at' => null,
				':created_at' => date('Y-m-d H:i:s'),
				':updated_at' => null,
		        ':deleted_at' => null
			];
			return $query->execute($params);
		}
	}

	public function existsEmail($email){
		$sql = 'SELECT * FROM admins WHERE email=:email';
		$query = $this->db->prepare($sql);
		$query->execute([':email'=>$email]);
		return $query->rowCount();

	}

	public function getUsers()
	{
		$sql = 'SELECT * FROM admins WHERE deleted=0';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function getUserById($id)
	{
		$sql = 'SELECT * FROM admins WHERE id=:id';
		$query = $this->db->prepare($sql);
		$query->execute([':id'=>$id]);

		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function getConfig($type)
	{
		$sql = 'SELECT * FROM config WHERE type=:type ORDER BY value DESC';
		$query = $this->db->prepare($sql);
		$query->execute([':type' => $type]);
		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function setUser($user)
	{
		$errors = [];

		if(!empty($user['password'])){

			$sql = 'UPDATE admins SET name=:name, email=:email password=:password status=:status, updated_at=:update_at WHERE id=:id';

			$password = hash_hmac('sha512', $user['password'], ENCRIPTKEY);

			$params = [
				':id'=>$user['id'],
				':name'=>$user['name'],
				':email'=>$user['email'],
				':password'=>$password,
				':status'=>$user['status'],
				':updated_at'=>date('Y-m-d H:i:s')
			];
		}else{
			$sql = 'UPDATE admins SET name=:name, email=:email status=:status, updated_at=:update_at WHERE id=:id';
			$params = [
				':id'=>$user['id'],
				':name'=>$user['name'],
				':email'=>$user['email'],
				':status'=>$user['status'],
				':updated_at'=>date('Y-m-d H:i:s')
			];
		}

		$query = $this->db->prepare($sql);

		if (!$query->execute($params)){
			array_push($errors, 'Error al modificar el usuario.');
		}

		return $errors;
	}

	public function delete($id)
	{
		$errors = [];

		$sql = 'UPDATE admins SET deleted=:deleted, deleted_at=:deleted_at WHERE id:id';

		$params = [
			':id'	=>$id,
			':deleted' => 1,
			':deleted_at'=>date('Y-m-d H:i:s')

		];

		$query = $this->db->prepare($sql);
		
		if(!$query->execute($params)){
			array_push($errors, 'Error al eliminar el usuario administrador');
		}
		return $errors;
	}
}