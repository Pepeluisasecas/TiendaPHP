<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $data['title'] ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/f45765d70c.js" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<a href="<?=ROOT?>index.php" class="navbar-brand">Tienda</a>
		<div class="collapse navbar-collapse" id="menu">
			<?php if($data['menu']): ?>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a href="<?= ROOT . 'courses' ?>" class="nav-link <?= (isset($data['active']) && ($data['active'] == 'courses')) ? 'active' : '' ?>">Cursos</a>
					</li>
					<li class="nav-item">
						<a href="<?= ROOT . 'books' ?>" class="nav-link <?= (isset($data['active']) && ($data['active'] == 'books')) ? 'active' : '' ?>">Libros</a>
					</li>
					<li class="nav-item">
						<a href="<?= ROOT . 'shop/whoami' ?>" class="nav-link <?= (isset($data['active']) && ($data['active'] == 'whoami')) ? 'active' : '' ?>">Quienes somos</a>
					</li>
					<li class="nav-item">
						<a href="<?= ROOT . 'shop/contact' ?>" class="nav-link <?= (isset($data['active']) && ($data['active'] == 'contact')) ? 'active' : '' ?>">Contacto</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item">
						<form action="<?= ROOT ?>search/products" method="POST" class="form-inline">
							<input type="text" name="search" id="search" class="form-control" size="20" placeholder="Buscar..." required/>
							<button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
						</form>
						
					</li>
					<li class="nav-item">
						<a href="<?= ROOT .'shop/logout' ?>" class="nav-link">Salir</a>
					</li>
				</ul>
			<?php endif ?>
			<?php if (isset($data['admin']) && $data['admin']) : ?>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a href="<?= ROOT ?>adminuser" class="nav-link">Usuarios</a>
					</li>
					<li class="nav-item">
						<a href="<?= ROOT ?>adminproduct" class="nav-link">Products</a>
					</li>
					<li class="nav-item">
						<a href="<?= ROOT ?>cart/sales" class="nav-link">Ventas</a>
					</li>
				</ul>
			<?php endif ?>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-2">
				
			</div>
			<div class="col-sm-8">
				<?php if (isset($data['errors'])&&count($data['errors']) > 0): ?>
					<div class="alert alert-danger mt-3">
						<ul class="list">
							<?php foreach ($data['errors'] as $value): ?>
								<li class="list-item"><?= $value ?></li>
							<?php endforeach ?>
						</ul>
					</div>

				<?php endif ?>