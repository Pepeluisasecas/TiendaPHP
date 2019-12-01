<?php

/**
 * Clase para la administración
 */
class AdminController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model = $this->model('Admin');
	}

	public function index()
	{
		$data = [
			'title' => 'Administración',
			'subtitle' => 'Módulo de Administracion',
			'menu' => false
		];

		$this->view('admin/index',$data);
	}

	public function verifyUser()
	{
		$errors = [];
		if($_SERVER['REQUEST_METHOD']=='POST'){

			

			$email = isset($_POST['user']) ? $_POST['user'] : '';
			$password = isset($_POST['password']) ? $_POST['passwords']:'';

			if (empty($email)) {
				array_push($errors, 'El correo del usuario es obligatorio');
			}
			if (empty($password)) {
				array_push($errors, 'La contraseña es obligatoria');
			}
			$dataForm = [
				'email' => $email,
				'password' => $password
			];

			if(count($errors==0)){
				
				$errors = $this->model->verifyUser($dataForm);
				if(count($errors)==0){

					$session = new Session();

					$session->login($dataForm);
					header('location:'.ROOT.'adminshop');
				}
			}	
		}

		$data = [
			'title' => 'Administración',
			'subtitles' => 'Módulo de Administracion',
			'menu' => false
		];

		$this->view('admin/index',$data);
		
	}
}