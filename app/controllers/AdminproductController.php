<?php
/**
 * Controlador de administración de productos
 */
class AdminproductController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model=$this->model('Adminproduct');
	}

	public function index()
	{
		$session = new Session();

		if ($session->getLogin()){
			$products = $this->model->getProducts();
			$type = $this->model->getConfig('productType');

			$data = [
				'title' => 'Administración de productos',
				'menu' => false,
				'admin' => true,
				'type' => $type,
				'data' => $products
			];

			$this->view('admin/products/index', $data);


		}else{
			header('location:'.ROOT.'admin');
		}
	}

	public function create()
	{

		$errors=[];
		$dataform=[];
		$typeConfig = $this->model->getConfig('productType');
		$statusConfig = $this->model->getConfig('productStatus');
		$catalogue = $this->model->getCatalogue();

		if($_SERVER['REQUEST_METHOD']=='POST'){
			//Recbimos la informacion del formulario
			$type = $_POST['type'] ?? '';
			$name =Validate::text($_POST['name'] ?? '');
			$description = Validate::text($_POST['description'] ?? '');
			$price = Validate::number($_POST['price'] ?? '');
			$discount = Validate::number($_POST['discount'] ?? '');
			$send = Validate::number($_POST['send'] ?? '');
			$image = Validate::file($_FILES['image']['name']);
			$published = $_POST['published'] ?? '';
			$relation1 = $_POST['relation1'] ?? '';
			$relation2 = $_POST['relation2'] ?? '';
			$relation3 = $_POST['relation3'] ?? '';
			$mostSold = isset($_POST['mostSold'] ? '1' : '0';
			$new = isset($_POST['new']) ? '1' : '0';
			$status = $_POST['status'] ?? '';
			
			//Libros en ingles
			
			$author = Validate::text($_POST['author'] ?? '');
			$publisher = Validate::text($_POST['publisher'] ?? '');
			$pages = $_POST['pages'] ?? '';

			//Cursos
			$people = Validate::text($_POST['people'] ?? '');
			$objetives = Validate::text($_POST['objetives'] ?? '');
			$necesities = Validate::text($_POST['necesities'] ?? '');
			
			//validamos la informacion

			if (empty($name)) {
				array_push($errors, 'El nombre del producto es requerido');
			}

			if (empty($description)) {
				array_push($errors, 'La descripción del producto es requerida');
			}

			if (! is_numeric($price)) {
				array_push($errors, 'El precio del producto debe ser un numero');
			}

			if (! is_numeric($discount)) {
				array_push($errors, 'El descuento del producto debe ser un numero');
			}

			if (! is_numeric($send)) {
				array_push($errors, 'Los gastos de envio del producto debe ser un numero');
			}

			if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
				array_push($errors, 'El descuento no puede ser mayor que el producto');
			}

			if (! Validate::date($published))			{
				array_push($errors, 'La fecha o su formato no es correcto');
			}elseif(Validate::dateDiff($published)){
				array_push($errors, 'La fecha de publicacion no puede ser posterior a hoy');
			}



			if ($type == 1) {
				
				if (empty($people)) {
					array_push($errors, 'El público objetivo del curso es obligatorio');
				}

				if (empty($objetives)) {
					array_push($errors, 'Los objetivos del curso son necesarios');
				}

				if (empty($necesities)) {
					array_push($errors, 'Las necesidades del curso son necesarias');
				}

			} elseif ($type == 2) {

				if (empty($author)) {
					array_push($errors, 'El autor del libro es necesario');
				}

				if (empty($publisher)) {
					array_push($errors, 'La editorial del libro es necesaria');
				}

				if (! is_numeric($pages)) {
					$pages = 0;
					array_push($errors, 'Las paginas del libro son necesarias');
				}
				
			}else{
				array_push($errors, 'Debes seleccionar un tipo valido');
			}

			if($image){

				if(Validate::imageFile($_FILES['images']['tmp_name'])){

					$image = $strtolower($image);

					if (is_uploaded_file($_FILES['images']['tmp_name'])) {
						move_uploaded_file($_FILES['images']['tmp_name'], 'img/'.$image);
						Validate::resizeImage($image, 240);
					}else{
						array_push($errors, 'Error al subir la imagen');
					}
				}else{
					array_push($errors, 'El formato de la imagen no es valido');
				}
			}else{
				array_push($errors, 'No he recibido una imagen');
			}

			if(Validate::imageFile($_FILES['images']['tmp_name'])){

				$image = $strtolower($image);

				if (is_uploaded_file($_FILES['images']['tmp_name'])) {
					move_uploaded_file($_FILES['images']['tmp_name'], 'img/'.$image);
					Validate::resizeImage($image, 240);
				}else{
					array_push($errors, 'Error al subir la imagen');
				}
			}else{
				array_push($errors, 'El formato de la imagen no es valido');
			}

			
			



			//creaos el array con los datos

			$dataForm=[
				'type' => $type,
				'name' => $name,
				'description' => $description,
				'author' => $author,
				'publisher' => $publisher,
				'people' => $people,
				'objetives' => $objetives,
				'necesities' => $necesities,
				'discount' => $discount,
				'send' => $pages,
				'pages' => $pages,
				'published' => $published,
				'image' => $image,
				'mostSold' => $mostSold,
				'new' => $new,
				'relation1' => $relation1,
				'relation2' => $relation2,
				'relation3' => $relation3,
				'status' => $status
			];

			if (empty($errors)){

				if($this->model->createProduct($dataForm)){
					header('location:'.ROOT.'adminProduct');
				}
				array_push($errors, 'Se ha producido algun problema durante la inserccion del registro en la base de datos');
			}
		}

		$data = [
			'title' => 'Administracion de Productos - Alta',
			'menu' => false,
			'admin' => true,
			'type' => $typeConfig,
			'status' => $statusConfig,
			'catalogue' => $catalogue,
			'errors' => $errors,
			'data' => $data
		];

		$this->view('admin/products/create',$data);
	}

	public function update($id)
	{

		$errors=[];
		$typeConfig = $this->model->getConfig('productType');
		$statusConfig = $this->model->getConfig('productStatus');
		$catalogue = $this->model->getCatalogue();

		if($_SERVER['REQUEST_METHOD']=='POST'){
			//Recbimos la informacion del formulario
			$type = $_POST['type'] ?? '';
			$name =Validate::text($_POST['name'] ?? '');
			$description = Validate::text($_POST['description'] ?? '');
			$price = Validate::number($_POST['price'] ?? '');
			$discount = Validate::number($_POST['discount'] ?? '');
			$send = Validate::number($_POST['send'] ?? '');
			$image = Validate::file($_FILES['image']['name']);
			$published = $_POST['published'] ?? '';
			$relation1 = $_POST['relation1'] ?? '';
			$relation2 = $_POST['relation2'] ?? '';
			$relation3 = $_POST['relation3'] ?? '';
			$mostSold = isset($_POST['mostSold'] ? '1' : '0';
			$new = isset($_POST['new']) ? '1' : '0';
			$status = $_POST['status'] ?? '';
			
			//Libros en ingles
			
			$author = Validate::text($_POST['author'] ?? '');
			$publisher = Validate::text($_POST['publisher'] ?? '');
			$pages = $_POST['pages'] ?? '';

			//Cursos
			$people = Validate::text($_POST['people'] ?? '');
			$objetives = Validate::text($_POST['objetives'] ?? '');
			$necesities = Validate::text($_POST['necesities'] ?? '');
			
			//validamos la informacion

			if (empty($name)) {
				array_push($errors, 'El nombre del producto es requerido');
			}

			if (empty($description)) {
				array_push($errors, 'La descripción del producto es requerida');
			}

			if (! is_numeric($price)) {
				array_push($errors, 'El precio del producto debe ser un numero');
			}

			if (! is_numeric($discount)) {
				array_push($errors, 'El descuento del producto debe ser un numero');
			}

			if (! is_numeric($send)) {
				array_push($errors, 'Los gastos de envio del producto debe ser un numero');
			}

			if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
				array_push($errors, 'El descuento no puede ser mayor que el producto');
			}

			if (! Validate::date($published))			{
				array_push($errors, 'La fecha o su formato no es correcto');
			}elseif(Validate::dateDiff($published)){
				array_push($errors, 'La fecha de publicacion no puede ser posterior a hoy');
			}



			if ($type == 1) {
				
				if (empty($people)) {
					array_push($errors, 'El público objetivo del curso es obligatorio');
				}

				if (empty($objetives)) {
					array_push($errors, 'Los objetivos del curso son necesarios');
				}

				if (empty($necesities)) {
					array_push($errors, 'Las necesidades del curso son necesarias');
				}

			} elseif ($type == 2) {

				if (empty($author)) {
					array_push($errors, 'El autor del libro es necesario');
				}

				if (empty($publisher)) {
					array_push($errors, 'La editorial del libro es necesaria');
				}

				if (! is_numeric($pages)) {
					$pages = 0;
					array_push($errors, 'Las paginas del libro son necesarias');
				}
				
			}else{
				array_push($errors, 'Debes seleccionar un tipo valido');
			}

			if($image){

				if(Validate::imageFile($_FILES['images']['tmp_name'])){

					$image = $strtolower($image);

					if (is_uploaded_file($_FILES['images']['tmp_name'])) {
						move_uploaded_file($_FILES['images']['tmp_name'], 'img/'.$image);
						Validate::resizeImage($image, 240);
					}else{
						array_push($errors, 'Error al subir la imagen');
					}
				}else{
					array_push($errors, 'El formato de la imagen no es valido');
				}
			}else{
				array_push($errors, 'No he recibido una imagen');
			}

			if($image){
				if(Validate::imageFile($_FILES['images']['tmp_name'])){
					$image = $strtolower($image);
					if (is_uploaded_file($_FILES['images']['tmp_name'])) {
						move_uploaded_file($_FILES['images']['tmp_name'], 'img/'.$image);
						Validate::resizeImage($image, 240);
					}else{
						array_push($errors, 'Error al subir la imagen');
					}
				}else{
					array_push($errors, 'El formato de la imagen no es valido');
				}
			}

			
			



			//creaos el array con los datos

			$dataForm=[
				'id' => $id,
				'type' => $type,
				'name' => $name,
				'description' => $description,
				'author' => $author,
				'publisher' => $publisher,
				'people' => $people,
				'objetives' => $objetives,
				'necesities' => $necesities,
				'discount' => $discount,
				'send' => $pages,
				'pages' => $pages,
				'published' => $published,
				'image' => $image,
				'mostSold' => $mostSold,
				'new' => $new,
				'relation1' => $relation1,
				'relation2' => $relation2,
				'relation3' => $relation3,
				'status' => $status
			];

			if (empty($errors)){

				if($this->model->updateProduct($dataForm)){
					header('location:'.ROOT.'adminProduct');
				}
				array_push($errors, 'Se ha producido algun problema durante la actualizacion del registro en la base de datos');
			}
		}

		$product = $this->model->getProductById($id);

		$data = [
			'title' => 'Administracion de Productos - Alta',
			'menu' => false,
			'admin' => true,
			'type' => $typeConfig,
			'status' => $statusConfig,
			'catalogue' => $catalogue,
			'errors' => $errors,
			'product' => $product
		];

		$this->view('admin/products/update',$data);
	}
		
	}

	public function delete($id)
	{
		$errors = [];

		if ($_SERVER['REQUEST_METHOD']=='POST') {

			$errors = $this->model->delete($id);

			if (empty($errors)) {
				header('location:' . ROOT. 'adminproduct');
			}

		}
		$product = $this->model->getProductById($id);
		$typeConfig = $this->model->getConfig('productType');
		$statusConfig = $this->model->getConfig('productStatus');

		$data = [
			'title' => 'Eliminacion de productos',
			'menu' => false,
			'admin' => true,
			'data' => $product,
			'type'=>$typeConfig,
			'errors'=>$errors
		];
		$this->view('admin/products/delete', $data);
	}
}