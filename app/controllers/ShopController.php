<?php
/**
 * Controlador Shop para la tienda
 */
class ShopController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model = $this->model('Shop');
	}

	public function index()
	{
		$session = new Session();

		if($session->getLogin()){

			$mostSold = $this->model->getMostSold();
			$news = $this->model->getNews();

			$data = [
				'title'=> 'Bienvenid@ a nuestra tienda',
				'menu'=>true,
				'subtitle' => 'Los + de lo +',
				'subtitle2' => 'Los + nuevos',
				'data' => $mostSold,
				'news' => $news

			];
			$this->view('shop/index', $data);
		}else{
			header('location:' . ROOT);
		}


	}

	public function logout()
	{
		$session = new Session();
		$session->logout();
		header('location:' . ROOT);
	}

	public function show($id)
	{
		$session = new Session();

		$product = $this->model->getProductById($id);

		$data = [
			'title' => 'Detalle del producto',
			'subtitle' => $product->name,
			'menu' => true,
			'admin' => false,
			'data' => $product,
			'user_id' => $session->getUserId()
		];

		$this->view('shop/show', $data);
	}

	function whoami()
	{
		$session = new Session();

		if($session->getLogin()){

			$data = [
				'title' => 'Quienes somos',
				'menu' => true,
				'active' => 'whoami',
			];

			$this->view('shop/whoami', $data);

		}else{
			header('location:'.ROOT);
		}
	}

	function contact()
	{
		$session = new Session();
		$errors = [];

		if($session->getLogin()){

			if($_SERVER['REQUEST_METHOD']=='POST'){

				$name = $_POST['name'] ?? '';

				$email = $_POST['email'] ?? '';

				$message = $_POST['message'] ?? '';

				if(empty($name)){
					array_push($errors,'El nombre es necesario');
				}

				if (empty($email)) {
					array_push($errors,'El email es necesario.');
				}

				if (empty($message)) {
					array_push($errors,'El mensaje es obligatorio');
				}

				if ( ! filter_var($email, FILTER_VAR_EMAIL)) {
					array_push($errors,'El email no es valido');
				}

				if (count($errors)==0) {
					if($this->model->sendEmail($name,$email,$message)){

						$data = [

							'title' => 'Mensaje del usuario',
							'menu' => true,
							'subtitle' => 'Exito',
							'text' => 'En breve recibira noticias',
							'color' => 'succes',
							'url' => 'shop',
							'colorButton' => 'succes',
							'textButton' => 'Regresar'

						];

						$this->view('mensaje',$data);

					}else{

						$data = [

							'title' => 'Mensaje del usuario',
							'menu' => true,
							'subtitle' => 'Error',
							'text' => 'Sa matao',
							'color' => 'danger',
							'url' => 'shop',
							'colorButton' => 'danger',
							'textButton' => 'Regresar'

						];

						$this->view('mensaje',$data);

					}
				}else{
					$data = [
						'title' => 'Contacta con nosotrod',
						'menu' => true,
						'active' => 'contact',
						'errors' => $errors
					];

					$this->view('shop/contact', $data);	
				}
			

		}else{


			$data = [
				'title' => 'Contacta con nosotrod',
				'menu' => true,
				'active' => 'contact'
			];

			$this->view('shop/contact', $data);	
		}

	}else{
		header('location:'.ROOT);
	}
}
}