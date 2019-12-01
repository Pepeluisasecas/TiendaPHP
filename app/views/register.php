<?php include_once 'header.php'?>
<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Registro</h1>
	</div>
	<div class="card-body">
		<form action="<?=ROOT?>login/registro" method="post">
			<div class="form-group text-left">
				<label for="first_name">Nombre</label>
				<input type="text" name="first_name" id="first_name" class="form-control" required="required" placeholder="Escriba su nombre" value="<?= isset($data['data']['first_name']) ? $data['data']['first_name'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="last_name_1">Apellido 1</label>
				<input type="text" name="last_name_1" id="last_name_1" class="form-control" required="required" placeholder="Escriba su primer apellido" value="<?= isset($data['data']['last_name_1']) ? $data['data']['last_name_1'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="last_name_2">Apellido 2</label>
				<input type="text" name="last_name_2" id="last_name_2" class="form-control" placeholder="Escriba su segundo apellido" value="<?= isset($data['data']['last_name_2']) ? $data['data']['last_name_2'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="email">Correo Electrónico</label>
				<input type="email" name="email" id="email" class="form-control" required="required" placeholder="Escriba su correo electrónico" value="<?= isset($data['data']['email']) ? $data['data']['email'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="password1">Contraseña</label>
				<input type="password" name="password1" id="password1" class="form-control" required="required" placeholder="Escriba su contraseña">
			</div>
			<div class="form-group text-left">
				<label for="password2">Repita su contraseña</label>
				<input type="password" name="password2" id="password2" class="form-control" required="required" placeholder="Repita su contraseña">
			</div>
			<div class="form-group text-left">
				<label for="address">Direccion</label>
				<input type="text" name="address" id="address" class="form-control" required="required" placeholder="Escriba su direccion" value="<?= isset($data['data']['address']) ? $data['data']['address'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="city">Ciudad</label>
				<input type="city" name="city" id="city" class="form-control" required="required" placeholder="Escriba su ciudad" value="<?= isset($data['data']['city']) ? $data['data']['city'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="state">Provincia</label>
				<input type="text" name="state" id="state" class="form-control" required="required" placeholder="Escriba su provincia" value="<?= isset($data['data']['state']) ? $data['data']['state'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="postcode">Código postal</label>
				<input type="text" name="postcode" id="postcode" class="form-control" required="required" placeholder="Escriba su código postal" value="<?= isset($data['data']['postcode']) ? $data['data']['postcode'] : "" ?>">
			</div>
			<div class="form-group text-left">
				<label for="country">País</label>
				<input type="country" name="country" id="country" class="form-control" required="required" placeholder="Escriba su país" value="<?= isset($data['data']['country']) ? $data['data']['country'] : "" ?>">
			</div>
			<div>
				<input type="submit" value="Enviar datos" class="btn btn-success">
				<a href="<?=ROOT?>login/" class="btn btn-info">Cancelar</a>
			</div>
		</form>
	</div>
</div>

<?php include_once 'footer.php'?>