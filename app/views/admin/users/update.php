<?php include_once (VIEWS . 'header.php') ?>
<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Modificacion de un usuario administrador</h1>
	</div>
	<div class="card-body">
		<form action="<?php  ROOT ?>adminuser/update/<?= $data['data']->id ?>" method="POST">
			<div class="form-group text-left">
				<label for="name">Usuario</label>
				<input type="text" name="name" class="form-control" placeholder="Escribe tu nombre completo" required value="<?= (isset($data['data']->name)) ? $data['data']['name'] : '' ?>">
			</div>
			<div class="form-group text-left">
				<label for="email">Correo electrónico</label>
				<input type="email" name="email" class="form-control" placeholder="Escribe tu correo electrónico" required value="<?= (isset($data['data']->email)) ? $data['data']['email'] : '' ?>">
			</div>
			<div class="form-group text-left">
				<label for="password1">Contraseña</label>
				<input type="pasword" name="password1" class="form-control" placeholder="(Dejar en blanco si no desea cambiarla)">
			</div>
			<div class="form-group text-left">
				<label for="password2">Repite contraseña</label>
				<input type="pasword" name="password2" class="form-control" placeholder="(solo en caso de cambio)">
			</div>
			<div class="form-group text-left">
				<label for="status">--Selecciona un estado--</label>
				<select name="status" id="status" class="form-control">
					<option value="">Selecciona el estado del usuario</option>
					<?php foreach ($data['status'] as $status): ?>
						<option value="<?= $status->value ?>" <?= $status->value == $data['data']->value ? ' selected ' : '' ?> ><?= $status->description ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group text-left">
				<input type="submit" value="Modificar" class="btn btn-success">
				<a href="<?= ROOT ?>adminuser" class="btn btn-info">Cancelar</a>
			</div>


		</form>
	</div>
</div><?php include_once (VIEWS . 'footer.php') ?>
