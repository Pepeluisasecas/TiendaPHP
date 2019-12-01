<?php 
/**
 * Administracion de usuarios
 */
class AdminUserController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model = $this->model('AdminUser');
	}

	public function index()
	{

		$session = new Session();

		if ($session->getLogin()){

			$users = $this->model->getUsers();

			$data = [
				'title' => 'Administración de usuarios',
				'menu' => false,
				'menu' => true,
				'data' => $users
			];
			$this->view('admin/users/index',$data);
		}else{
			header('location:'.ROOT.'admin');
		}
	}

	public function create()
	{
		if($_SERVER['REQUEST_METHOD']=='POST'){

			print('hola :D');

			$errors =[];

			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$password1 = isset($_POST['password1']) ? $_POST['password1']:'';
			$password2 = isset($_POST['password2']) ? $_POST['password2']:'';

			$dataForm = [
				'name' => $name,
				'email' => $email,
				'password' => $password1
			];

			if(empty($name)){
				array_push($errors, 'El nombre del usuario es obligatorio');
			}
			if (empty($email)) {
				array_push($errors, 'El correo del usuario es obligatorio');
			}
			if (empty($password1)) {
				array_push($errors, 'La contraseña es obligatoria');
			}
			if ($password1!=$password2) {
				array_push($errors, 'Las contraseñas deben ser iguales');
			}

			if(count($errors)==0){

				if($this->model->createAdminUser($dataForm)){
					header('location:' .ROOT.'adminUser');
				}else{
					$data =[
							'title'=>'Error',
							'menu'=>false,
							'subtitle'=>'Error al crear el administrador',
							'text'=>'Existió un problema al crear el usuario administrador',
							'color'=>'danger',
							'url'=>'adminUser',
							'colorButton'=>'danger',
							'textButton'=>'Volver'
						];
				}

			}else{
				$data = [
					'title' => 'Administración de usuarios - Alta',
					'menu' => false,
					'menu' => true,
					'data' => $dataForm,
					'errors' => $errors
				];

				$this->view('admin/users/create',$data);
			}
		}else{
			$data = [
				'title' => 'Administración de usuarios - Alta',
				'menu' => false,
				'menu' => true
			];
			
			$this->view('admin/users/create',$data);
		}
	}

	public function update($id)
	{
		$errors=[];

		if ($_SERVER['REQUEST_METHOD']=='POST') {

			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
			$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
			$status = isset($_POST['status']) ? $_POST['status'] : '';

			$dataForm=[
				'name'=>$name,
				'email'=>$email,
				'password'=>$password1,
				'status'=>$status
			];

			if (empty($name)) {
				array_push($error, 'El nombre del administrador es obligatorio.');
			}

			if (empty($email)) {
				array_push($error, 'El correo del administrador es obligatorio.');
			}

			if ($status=='') {
				array_push($error, 'El estado del administrador es obligatorio.');
			}

			if ( ! empty($password1) || ! empty($password2)){
				if ($password1!=$password2){
					array_push($errors, 'Las contraseñas deben ser iguales.');
				}
			}

			if (count($errors)==0) {
				$dataForm = [
					'name' => $name,
					'email' => $email,
					'password' => $password1,
					'status' => $status
				];

				$errors = $this->model->setUser($dataForm);
			}
		
		}
			
		$user = $this->model->getUserById($id);
			
		$status = $this->model->getConfig('adminStatus');

		$data = [
			'title' => 'Modificacion de usuarios',
			'menu' => false,
			'admin' => true,
			'data' => $user,
			'status'=>$status,
			'errors'=>$errors
		];


		$this->view('admin/users/update', $data);
	}

	public function delete($id)
	{
		$errors = [];
		if ($_SERVER['REQUEST_METHOD']=='POST') {

			$errors = $this->model->delete($id);

			if (empty($errors)) {
				header('location:' . ROOT. 'adminUser');
			}

		}
		$user = $this->model->getUserById($id);
			
		$status = $this->model->getConfig('adminStatus');

		$data = [
			'title' => 'Eliminacion de usuarios',
			'menu' => false,
			'admin' => true,
			'data' => $user,
			'status'=>$status,
			'errors'=>$errors
		];
		$this->view('admin/users/delete', $data);

	}
}