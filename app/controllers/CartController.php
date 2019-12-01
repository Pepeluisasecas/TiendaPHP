<?php
/**
 * Controlador de los carritos
 */
class CartController extends Controller
{
	
	private $model;

	function __construct(argument)
	{
		$this->model = $this->model('cart');
	}

	public function index()
	{
		
	}

	public function addProduct($product_id, $user_id)
	{
		$errors =[];

		if ( ! $this->model->verifyProduct($product_id, $user_id)){
			if ( ! $this->model->addProduct($product_id, $user_id)){
				array_push($errors, 'Error al insertar producto en el carrito');
			}
		}

		$this->index();
	}


	public function thanks()
	{
		$session = new Session();
		$user = $session->getUser();


		if ($this->model->closeCart($user->id, 1)) {


			$data = [
				'title' => 'Carrito - Gracias por su compra',
				'user' => $user,
				'menu' => true
			];

			$this->view('carts/thanks', $data);

		}else{
			$data =[
							'title'=>'Error en la actualización del carrito',
							'menu'=>false,
							'subtitle'=>'Cosas de error',
							'text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, vitae explicabo aliquam voluptatum, ut magnam labore at! Perspiciatis corporis, modi cumque error fugit ipsa dignissimos, maxime incidunt, delectus atque veniam.',
							'color'=>'danger',
							'url'=>'shop',
							'colorButton'=>'danger',
							'textButton'=>'Regresar'
						];

						$this->view('mensaje',$data);
		}


	}

	public function sales()
	{
		$sales = $this->model->sales();

		$data = [
			'title' => 'Ventas',
			'menu' => false,
			'admin' => true,
			'data' => $sales
		];
		$this->view('admin/carts/index',$data);
		var_dump($data);
	}

	public function show ($date, $id)
	{
		$cart = $this->model->show($date, $id);

		$data = [
			'title' => 'Detalle',
			'menu' => false,
			'admin' => true,
			'data' => $cart,
			'date' => $date
		];
		$this->view('admin/carts/show', $data);
	}

	public function chartDailySales()
	{
		$sales = $this->model->dailySales();

		$data = [
		]
	}
}