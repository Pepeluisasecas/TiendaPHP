<?php include_once (VIEWS . 'header.php') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Alta de un producto</h1>
	</div>
		<div class="card-body">
			<form action="<?php  ROOT ?>adminproduct/delete/<?= $data['data']->id ?>" method="POST">
				<div class="form-group text-left">
					<label for="type">Tipo de producto</label>
					<select name="type" id="type" class="form-control">
						<option value="">-Selecciona el tipo de producto</option>
						<?php? foreach($data['type'] as $type): ?>
							<option value="<?= $type->value ?>" <?= (isset($data['data']->type) && $data['data']->type==$type->value) ? 'selected' : ''?> ><?php $type->description ?></option>
						<?php? endforeach ?>
					</select>
				</div>
				<div class="form-group text-left">
					<label for="name">Nombre:</label>
					<input type="text" name="name" class="form-control" required placeholder="Escribe el nombre del producto" value="<?= $data['data']->name ?? '' ) ?>">
				</div>
				<div class="form-group text-left">
					<label for="price">Precio del producto:</label>
					<input type="text" name="price" class="form-control" pattern="^(\d\-)?\d*\.?\d+$" placeholder="Introduzca el precio sin coma ni simbolos" value="<?= $data['data']->price ?? '' ?>" required>
				</div>
				<div class="form-group text-left">
					<input type="submit" value="Borrar" class="btn btn-danger">
					<a href="<?= ROOT ?>adminproduct" class="btn btn-info">Cancelar</a>
					<p>Una vez borrado no se podra recuperar</p>
				</div>
			</form>
	</div>
</div>

<?php include_once (VIEWS . 'footer.php') ?>
