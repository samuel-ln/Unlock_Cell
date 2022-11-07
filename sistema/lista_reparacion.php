<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Listado de reparaciones</h1>
		<a href="registro_reparacion.php" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>NOMBRE COMPLETO</th>
							<th>MARCA / MODELO</th>
							<th>TELEFONO</th>
							<th>DECRIPCION</th>
							<th>ESTADO REPARACION</th>
							<?php if ($_SESSION['rol'] == 1) { ?>
							<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT * FROM reparacion");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['idreparacion']; ?></td>
									<td><?php echo $data['nombre']; ?></td>
									<td><?php echo $data['marca']; ?></td>
									<td><?php echo $data['telefono']; ?></td>
									<td><?php echo $data['descripcion']; ?></td>
									<td><?php 
											if($data['estado'] == "Por Revision"){
												echo '<button class="btn btn-danger btn-xs btnActivar" idreparaciom="'.$data['idreparacion'].'" estado="Por Revision">Por Revision</button>';
											}
											if($data['estado'] == "En Proceso"){
												echo '<button class="btn btn-warning btn-xs btnActivar" idreparaciom="'.$data['idreparacion'].'" estado="En Proceso">En Proceso</button>';
											}
											if($data['estado'] == "Reparado"){
												echo '<button class="btn btn-success btn-xs btnActivar" idreparaciom="'.$data['idreparacion'].'" estado="Reparado">Reparado</button>';
											} ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
									<td>
										<a href="estado_reparacion.php?id=<?php echo $data['idreparacion']; ?>" class="btn btn-primary"><i class='fas fa-random'></i></a>
										<a href="editar_reparacion.php?id=<?php echo $data['idreparacion']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
										<form action="eliminar_reparacion.php?id=<?php echo $data['idreparacion']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td>
									<?php } ?>
								</tr>
						<?php }
						} ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>