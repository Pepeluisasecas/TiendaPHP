<?php include_once (VIEWS . 'header.php') ?>

<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Listado de administradores</h1>
	</div>
	<div class="card-body">
		<table class="table tablestriped text-center" width="100%">
			<thead>
				<th>Id</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Modificar</th>
				<th>Borrar</th>
			</thead>
			<tbody>
				<?php foreach ($data['data'] as $user): ?>
					<tr>
						<td class="text-center"><?php $user->id ?></td>
						<td class="text-center"><?php $user->name ?></td>
						<td class="text-center"><?php $user->email ?></td>
						<td class="text-center"><a href="<?= ROOT ?>adminuser/update/<?= $data['user->id'] ?>" class="btn btn-info">Modificar</a></td>
						<td class="text-center"><a href="<?= ROOT ?>adminuser/delete/<?= $data['user->id'] ?>" class="btn btn-info">Borrar</a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-sm-6">
				<a href="<?= ROOT ?>adminUser/create" class="btn btn-success">Crear un usuario administrador</a>
			</div>
		</div>
	</div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>
