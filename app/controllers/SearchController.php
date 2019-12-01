<?php
/**
 * Controlador del motor de busqueda
 */
class SearchController extends Controller
{
	private $model;
	function __construct()
	{
		$this->model = $this->model('Search');
	}

	public function products()
	{
		$search = $_POST['search'] ?? '';

		if ($search != '') {
			
			$dataSearch = $this->model->getProduct($search);

			if(count($dataSearch)>0){

				$data = [
					'title' => 'Busqueda',
					'menu' => true,
					'data' => $dataSearch
				];

				$this->view('search/index', $data);
			}else{
					$data = [

							'title' => 'Busqueda',
							'menu' => true,
							'subtitle' => 'No se ha encontrado',
							'text' => 'El termino '.$search.' no se encuentra en la base de datos',
							'color' => 'info',
							'url' => 'shop',
							'colorButton' => 'info',
							'textButton' => 'Regresar'

						];

						$this->view('mensaje',$data);
			}
		}else{
			header('location:' . ROOT);
		}
	}
}