<?php include_once "includes/header.php"; 
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['descripcion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $nombre = $_POST['nombre'];
        $marca = $_POST['marca'];
        $telefono = $_POST['telefono'];
        $descripcion = $_POST['descripcion'];
        $estado= $_POST['estado'];
        $usuario_id = $_SESSION['idUser'];

            $query_insert = mysqli_query($conexion, "INSERT INTO reparacion(nombre,marca,telefono,descripcion,estado, usuario_id) values ('$nombre', '$marca', '$telefono', '$descripcion', '$estado', '$usuario_id')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    reparacion Registrada
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al Guardar la reparacion
                            </div>';
            }
        
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nuevo Reparacion</h1>
        <a href="lista_reparacion.php" class="btn btn-primary">Regresar</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                    <label for="nombre">Nombre del cliente</label>
                    <input type="text" placeholder="Ingrese Nombre completo del cliente" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="marca">Marca y Modelo del dispositivo</label>
                    <input type="text" placeholder="Ingrese Marca y el Modelo del dispositivo" name="marca" id="marca" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="number" placeholder="Ingrese el numero del Teléfono" name="telefono" id="telefono" class="form-control" required minlength="8" maxlength="8">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion de la reparacion</label>
                    <input type="text" placeholder="Ingrese Descripcion de la reparacion" name="descripcion" id="descripcion" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado del telefono</label>
                    <select placeholder="Ingrese el estado del telefono" name="estado" id="estado" class="form-control" required>
                        <option value="Por Revision">Por Revision</option>
                        <option value="En Proceso">En Proceso</option>
                        <option value="En Proceso">Reparado</option>
                    </select>
                </div>
                <input type="submit" value="Guardar Reparacion" class="btn btn-primary">
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>


<?php include_once "includes/footer.php"; ?>