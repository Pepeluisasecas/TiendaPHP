<?php include_once (dirname(__DIR__) . ROOT . 'header.php') ?>
<div class="card p-4 bg-light">
	<div class="card-header">
		<h1><?= $data['subtitle']?></h1>
	</div>

	<div class="card-body">
		<form action="<?=ROOT?>admin/verifyUser" method="POST">
			<div class="form-group text-left">
				<label for="user">Usuario</label>
				<input type="email" name="user" class="form-control" placeholder="Escribe tu correo electrónico" value="<?= (isset($data['data']['user'])) ? $data['data']['user'] : '' ?>">
			</div>
			<div class="form-group text-left">
				<label for="password">Contraseña</label>
				<input type="password" name="password" class="form-control" placeholder="Escribe tu contraseña">
			</div>
			<div class="form-group text-left">
				<input type="submit" value="Enviar" class="btn btn-success">
			</div>
		</form>
	</div>
</div>
<?php include_once (dirname(__DIR__) . ROOT . 'footer.php') ?>