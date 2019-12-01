<?php 
/**
 * Panel de admiistracion de la tienda
 */
class AdminshopController extends Controller
{
	private $model;
	function __construct()
	{
		$this->model = $this->model('Adminshop');

	}

	public function index()
	{
		$session = new Session();

		if($session->getLogin()){				
			$data = [
				'title' => 'Administración | Inicio',
				'subtitles' => 'Módulo de Administracion',
				'menu' => false,
				'admin' => true,
				'subtitle' => 'Administración de la tienda'
			];

			$this->view('admin/shop/index',$data);
		}else{
			header('location:'.ROOT.'admin');
		}
	}
}