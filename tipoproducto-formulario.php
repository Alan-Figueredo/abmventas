<?php
  include_once "config.php";
  include_once "entidades/tipoproducto.php";
  $pg = "Edicion de tipo de producto";
  $tipoProducto = new TipoProducto();
  $tipoProducto->cargarFormulario($_REQUEST);

  if($_POST){
    if(isset($_POST["btnGuardar"])){
      if(isset($_GET["id"]) && $_GET["id"] > 0){
        $tipoProducto->actualizar();
      }
    }else if(isset($_POST["btnBorrar"])){
      $tipoProducto->eliminar();
    }
  }
  if(isset($_GET["id"]) && $_GET["id"] > 0){
    $tipoProducto->idtipoproducto = $_GET["id"];
    $tipoProducto->obtenerPorId();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edición de tipo de producto</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->

  <link href="css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>

</head>
<body id="page-top">
<?php include_once("menu.php");?>
        <form action="" method="POST">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Productos</h1>
                <div class="row">
                    <div class="col">
                        <a href="tipoproducto-listado.php" class="btn btn-primary btn-md active mr-2">Listado</a> 
                        <a href="#" class="btn btn-primary btn-md active mr-2">Nuevo</a> 
                        <button class="btn btn-success btn-md mr-2" name="btnGuardar">Guardar</button>
                        <button class="btn btn-danger btn-md mr-2" name="btnBorrar">Borrar</button>
                    </div>
                </div>
                    <divm class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="txtNombre">Nombre:</label>
                                <input class="form-control mb-3" type="text" name="txtNombre" id="txtNombre" value="<?php echo $tipoProducto->nombre; ?>">
                            </div>
                    </div>
            </div>
          </form>
    <!-- End of Main Content -->
    <?php 
              if(isset($_POST["btnBorrar"])){
                $producto->eliminar();
                echo "<div class='alert alert-success text-center'>";
                echo "<strong>El producto se borró con exito.</strong>";
                echo "</div>";
              }
            ?>
            <?php 
              if(isset($_POST["btnGuardar"])){
                $producto->insertar();
                echo "<div class='alert alert-success text-center'>";
                echo "<strong>El producto se guardó con exito.</strong>";
                echo "</div>";
              }
            ?>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>