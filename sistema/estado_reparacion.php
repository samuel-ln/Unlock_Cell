<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['descripcion'])) {
    $alert = '<p class"error">Todo los campos son requeridos</p>';
  } else {
    $idreparacion = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $telefono = $_POST['telefono'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    $result = 0;
    if (is_numeric($telefono) and $telefono != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM reparacion where (telefono = '$telefono' AND idreparacion != $idreparacion)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class"error">La reparacion ya existe</p>';
    } else {
      if ($telefono == '') {
        $telefono = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE reparacion SET nombre = '$nombre', marca = '$marca' , telefono = '$telefono', descripcion = '$descripcion', estado = '$estado' WHERE idreparacion = $idreparacion");

      if ($sql_update) {
        $alert = '<p class"exito">Reparacion Actualizada correctamente</p>';
        
      } else {
        $alert = '<p class"error">Error al Actualizar la reparacion</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_reparacion.php");
}
$idreparacion = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM reparacion WHERE idreparacion = $idreparacion");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_reparacion.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idreparcion = $data['idreparacion'];
    $nombre = $data['nombre'];
    $marca = $data['marca'];
    $telefono = $data['telefono'];
    $descripcion = $data['descripcion'];
    $estado = $data['estado'];
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Estado de la Reparacion</h1>
                <a href="lista_reparacion.php" class="btn btn-primary">Regresar</a>
        </div>
          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idreparacion; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre del cliente</label>
                    <input type="text" placeholder="Ingrese Nombre completo del cliente" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" readonly=»readonly» >
                </div>
                <div class="form-group">
                    <label for="marca">Marca y Modelo del dispositivo</label>
                    <input type="text" placeholder="Ingrese Marca y el Modelo del dispositivo" name="marca" id="marca" class="form-control" value="<?php echo $marca; ?>" readonly=»readonly» >
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="number" placeholder="Ingrese el numero del Teléfono" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono; ?>" readonly=»readonly» >
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion de la reparacion</label>
                    <input type="text" placeholder="Ingrese Descripcion de la reparacion" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>"readonly=»readonly»>
                </div>
                <div class="form-group">
                    <label for="estado">Estado del dispositivo</label>
                    <label for="estado">Selecionar estado de dispositivo</label>
                    <select placeholder="Ingrese el estado del telefono" name="estado" id="estado" class="form-control" required>
                        <option value="0"><?php echo $estado; ?></option>    
                        <option value="Por Revision">Por Revision</option>
                        <option value="En Proceso">En Proceso</option>
                        <option value="Reparado">Reparado</option>
                    </select>
                </div>
        
                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Modificar estado de la reparacion</button>
              </form>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>