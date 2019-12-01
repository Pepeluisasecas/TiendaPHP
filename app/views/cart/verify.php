<?php include_once (dirname(__DIR__) . ROOT . 'header.php') ?>

<div class="card" id="container">
	<nav aria-label="breadcrumbs">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
			<li class="breadcrumb-item"><a href="#">Datos envío</a></li>
			<li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
			<li class="breadcrumb-item">Comprobar datos</li>
		</ol>


	</nav>
	<div class="card-header">
		<h1><?= $data['title'] ?></h1>
		<p>Verifique los datos antes del pago</p>
	</div>
	<div class="card-body">
		<?php $verify=false; $subtotal = 0; $discount = 0; $send = 0 ?>
		Modo de pago : <?= $data['payment'] ?><br/>
		Nombre: <?= $data['user']->first_name?> <?= $data['user']->last_name1 ?> <?= $data['user']->last_name2 ?><br/>
		Dirección: <?= $data['user']->address ?><br/>
		Ciudad: <?= $data['user']->city ?><br/>
		Estado: <?= $data['user']->state ?><br/>
		Código postal: <?= $data['user']->zipcode ?><br/>
		País: <?= $data['user']->country ?>

		<table class="table table-stripped" width="100%">

			<tr>
				<th width="12%">Producto</th>
				<th width="58%">Descripción</th>
				<th width="2%">Cant.</th>
				<th width="10%">Precio</th>
				<th width="10%">Subtotal</th>
			</tr>
			<?php foreach ($$data['data'] as $key => $value): ?>
			<tr>
				<td><img src="<?= ROOT ?>img/<?= $value->image ?>" width="105px" alt="<?= $value->name?>" ></td>
				<td><b><?= $value->name ?></b> <?= substr(html_entity_decode($value->description), 0,100) ?>...</td>
				<td class="text-right"><?= number_format($value->quantity, 0) ?></td>
				<td class="text-right"><?= number_format($value->price, 2) ?></td>
				<td class="text-right"><?= number_format($value->quantity * $value->price,2) ?>&euro;</td>
			</tr>
			
		</table>
		<?php $subto

	</div>

</div>


<?php include_once (dirname(__DIR__) . ROOT . 'footer.php') ?>
