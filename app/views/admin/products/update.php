<?php include_once (VIEWS . 'header.php') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
<script src="<?= ROOT ?>js/admincreateproduct.js"></script>
<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Modificacion de un producto</h1>
	</div>
	<div class="card-body">
		<form action="<?php  ROOT ?>adminproduct/update/<?= $data['product']->id ?>" method="POST" enctype="multipart/form-data">
			
				<div class="form-group text-left">
					<label for="type">Tipo de producto</label>
					<select name="type" id="type" class="form-control">
						<option value="">-Selecciona el tipo de producto</option>
						
						<?php? foreach($data['type'] as $type): ?>
						<option value="<?= $type->value ?>" <?= (isset($data['product']->type) && $data['product']->type==$type->value) ? 'selected' : ''?> ><?php $type->description ?></option>
						<?php? endforeach ?>
					</select>
				</div>
				<div class="form-group text-left">
					<label for="name">Nombre:</label>
					<input type="text" name="name" class="form-control" required placeholder="Escribe el nombre del producto" value="<?= $data['product']->name ?? '' ) ?>">
				</div>
				<div class="form-group text-left">
					<label for="description">Descripción:</label>
					<textarea name="description" id="editor" rows="10"><?= $data['product']->description ?? ''; ?></textarea>
				</div>

				<div id="book">
					<div class="form-group text-left">
						<label for="author">Autor:</label>
						<input type="text" name="author" class="form-contol" placeholder="Escribe el autor del libro" value="<?= $data['product']->author ?? '' ?>">
					</div>
					
					<div class="form-group text-left">
						<label for="publisher">Editorial:</label>
						<input type="text" name="publisher" class="form-contol" placeholder="Escribe la editorial del libro" value="<?= $data['product']->publisher ?? '' ?>">
					</div>
					
					<div class="form-group text-left">
						<label for="pages">Páginas:</label>
						<input type="text" name="pages" class="form-contol" placeholder="Escribe el numero de páginas del libro" value="<?= $data['product']->pages-> ?? '' ?>">
					</div>
				</div>

				<div id="course">
					<div class="form-group text-left">
						<label for="people">Publico objetivo:<label>
						<input type="text" name="people" class="form-contol" placeholder="Escriba el publico objetivo del curso" value="<?= $data['product']->people ?? '' ?>">
					</div>
					
					<div class="form-group text-left">
						<label for="objetives">Objetivos:</label>
						<input type="text" name="objetives" class="form-contol" placeholder="Escribe los objetivos del curo" value="<?= $data['product']->objetives ?? '' ?>">
					</div>
					
					<div class="form-group text-left">
						<label for="necesities">Conocimientos previos:</label>
						<input type="text" name="necesities" class="form-contol" placeholder="Escribe las necesidades del curso" value="<?= $data['product']->necesities ?? '' ?>">
					</div>
					
				</div>

				<div class="form-group text-left">
					<label for="price">Precio del producto:</label>
					<input type="text" name="price" class="form-control" pattern="^(\d\-)?\d*\.?\d+$" placeholder="Introduzca el precio sin coma ni simbolos" value="<?= $data['product']->price ?? '' ?>" required>
				</div>
				<div class="form-group text-left">
					<label for="discount">Descuento del producto:</label>
					<input type="text" name="discount" class="form-control" pattern="^(\d\-)?\d*\.?\d+$" placeholder="Introduzca el descuento" value="<?= $data['product']->discount ?? '' ?>">
				</div>

				<div class="form-group text-left">
					<label for="send">Coste del envio del producto:</label>
					<input type="text" name="send" class="form-control" patter="^(\d\-)?\d*\.?\d+$" placeholder="Introduzca el coste del envio" value="<?= $data['product']->send ?? '' ?>" required>
				</div>

				<div class="form-group text-left">
					<label for="image">Imagen del producto:</label>
					<input type="file" name="image" class="form-control" accept="image/jpeg,image/x-png,image/gif">
				</div>
				<div class="form-group text-left">
					<label for="published">Fecha del producto:</label>
					<input type="date" name="published" class="form-control" placeholder="Fecha de creación o publicación del producto (AAAA-MM-DD)" value="<?= $data['product']->send ?? '' ?>" required>

				</div>

				<div class="form-group text-left">
					<label for="relation1">Producto relacionado:</label>
					<select name="relation1" id="relation1" class="form-control">
						<option value="">-Selecciona un producto relacionado-</option>

						<?php? foreach($data['catalogue'] as $type): ?>
						<option value="<?= $catalogue->value ?>" <?= (isset($data['product']->relation1) && $data['product']->relation1==$type->value) ? 'selected' : ''?> ><?php $catalogue->description ?></option>
						<?php? endforeach ?>

					</select>
				</div>
				<div class="form-group text-left">
					<label for="relation2">Producto relacionado:</label>
					<select name="relation2" id="relation2" class="form-control">
						<option value="">-Selecciona un producto relacionado-</option>

						<?php? foreach($data['catalogue'] as $item): ?>
						<option value="<?= $catalogue->value ?>" <?= (isset($data['product']->relation2) && $data['product']->relation2==$type->value) ? 'selected' : ''?>><?php $catalogue->description ?></option>
						<?php? endforeach ?>
					
					</select>
				</div>
				<div class="form-group text-left">
					<label for="relation3">Producto relacionado:</label>
					<select name="relation3" id="relation3" class="form-control">
						<option value="">-Selecciona un producto relacionado-</option>
						<?php? foreach($data['catalogue'] as $type): ?>
						<option value="<?= $catalogue->value ?>" <?= (isset($data['product']->relation3->) && $data['product']->relation3==$catalogue->value) ? 'selected' : ''?> ><?php $catalogue->description ?></option>
						<?php? endforeach ?>
					</select>
				</div>

				<div class="form-group text-left">
					<label for="status">Estado del producto:</label>
					<select name="status" id="status">
						<option value="">-Selecciona el estado del producto</option>
						<?php? foreach($data['status'] as $status): ?>
						<option value="<?= $status->value ?>" ><?php $status->description ?></option>
						<?php? endforeach ?>
					</select>
				</div>

				<div class="form-check text-left">
					<input type="checkbox" name="mostSold" id="mostSold" class="form-check-input" <?= (isset($data['product']->mostSold) && $data['product']->mostSold == 1) ? 'checked' : ''?>>Producto más vendido<label for="mostSold" class="form-check-label"></label>
				</div>

				<div class="form-check text-left">
					<input type="checkbox" name="new" id="new" class="form-check-input" <?= (isset($data['product']->new) && $data['product']->new == 1) ? 'checked' : ''?>>Producto nuevo<label for="new" class="form-check-label"></label>
				</div>

			<div class="form-group text-left">
				<input type="submit" value="Enviar" class="btn btn-success">
				<a href="<?= ROOT ?>adminproduct" class="btn btn-info">Cancelar</a>
			</div>


		</form>
	</div>
</div><?php include_once (VIEWS . 'footer.php') ?>
<script>
	ClassicEditor
		.create(document.querySelector('#editor'))
		.catch(error => {
			console.error(error);
		})
</script>