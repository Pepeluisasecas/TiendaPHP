<?php

/**
 * Modelo login
 */
class Login
{
	private $db;

	function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}

	public function createUser($data)
	{
		$response = false;
		if ( ! $this->existsEmail($data['email'])){
			$password = hash_hmac('sha512', $data['password'], 'ENCRIPTKEY');
			$sql = 'INSERT INTO users(first_name, last_name1, last_name2, email, password, address, city, state, zipcode, country) VALUES (:first_name, :last_name_1, :last_name_2, :email, :password, :address, :city, :state, :zipcode, :country)';

			$query = $this->db->prepare($sql);
			$params = [
				':first_name'=>$data['first_name'], 
				':last_name_1'=>$data['last_name_1'], 
				':last_name_2'=>$data['last_name_2'], 
				':email'=>$data['email'], 
				':password'=>$password, 
				':address'=>$data['address'], 
				':city'=>$data['city'], 
				':state'=>$data['state'], 
				':zipcode'=>$data['postcode'], 
				':country'=>$data['country'],
			];
			$response = $query->execute($params);
		}
		return $response;
	}


	public function existsEmail($email)
	{

		$sql = 'SELECT * FROM users WHERE email=:email';
		$query = $this->db->prepare($sql);
		$query->execute([':email'=>$email]);
		return $query->rowCount();

	}

	public function getUserByEmail($email)
	{
		$sql = 'SELECT * FROM users WHERE email=:email';
		$query = $this->db->prepare($sql);
		$query->execute([':email'=>$email]);
		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function sendEmail($email)
	{
		$user = $this->getUserByEmail($email);
		$fullName = $user->first_name.' '.$user->last_name1.($user->last_name2!=''?' '.$user->last_name2:'');
		$msg = $fullName . ' accede al siguiente enlace para cambiar tu contraseña.<br/>';
		$msg.='<a href="'.ROOT.'login/changepassword/'.$user->id.'">Cambia tu clave de acceso</a>';
		$headers = 'MIME-Version: 1.0\r\n';
		$headers.='Content-type:text/html; charset=UTF-8\r\n';
		$headers.='From: Tienda';
		$headers.='Reply-to:administracion@tienda.local';
		$subject='Cambio de contraseña en Tienda';
		return mail($email,$subject,$msg,$headers);
	}

	public function changePassword($id,$password)
	{
		$pass = hash_hmac('sha512',$password, ENCRIPTKEY);
		$sql = 'UPDATE users SET password=:password WHERE id=:id';
		$query = $this->db->prepare($sql);
		$params = [
			':password'=>$pass,
			':id'=>$id
		];
		return $query->execute($params);

	}

	public function verifyUser($email,$password)
	{
		$errors = [];

		$user = $this->getUserByEmail($email);

		$pass = hash_hmac('sha512', $password, ENCRIPTKEY);

		if ( ! $user) {

			array_push($errors, 'El correo electrónico no existe');
		
		}elseif($user->password != $pass){

			array_push($errors, 'La contraseña no es correcta');
		}
		return $errors;
	}
}