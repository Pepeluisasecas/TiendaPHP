<?php include_once (dirname(__DIR__) . ROOT . 'header.php') ?>

<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Detalles de venta</h1>
	</div>
	<div class="card-body">
		<table class="table table-stripped text-center" width="100%">
			<thead>
				<th>Nombre</th>
				<th>Fecha</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Descuento</th>
				<th>Envio</th>
				<th>Total</th>
				
			</thead>
			<tbody>
				<?php foreach ($data['data'] as $sale): ?>
					<tr>
						<td class="text-center"><?= $sale->name ?></td>
						<td class="text-center"><?= substr($data['date'], 0, 10) ?></td>
						<td class="text-right"><?= number_format($sale->price,2) ?> &euro;</td>
						<td class="text-right"><?= number_format($sale->quantity,2) ?></td>
						<td class="text-right"><?= number_format($sale->discount,2) ?> &euro; </td>
						<td class="text-right"><?= number_format($sale->send)?>;</td>
						<td class="text-right"><a href="<?= ROOT ?>cart/show/<?= substr($sale->date, 0, 10) ?>/<?= $sale->user_id ?>">Ver</a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<a href="<?= ROOT ?>" class="btn bnt-info">Gráfico de ventas</a>
	</div>
</div>

<?php include_once (dirname(__DIR__) . ROOT . 'footer.php') ?>
