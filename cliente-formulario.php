<?php
  include_once "config.php";
  include_once "entidades/cliente.php";
  $pg = "Edicion de cliente";
  $cliente = new Cliente();
  $cliente->cargarFormulario($_REQUEST);

  if($_POST){
    if(isset($_POST["btnGuardar"])){
      if(isset($_GET["id"]) && $_GET["id"] > 0){
        $cliente->actualizar();
      }
    }else if(isset($_POST["btnBorrar"])){
      $cliente->eliminar();
    }
  }
  if(isset($_GET["id"]) && $_GET["id"] > 0){
    $cliente->idcliente = $_GET["id"];
    $cliente->obtenerPorId();
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

  <title>SB Admin 2 - Blank</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <?php
   include_once("menu.php"); 
  ?>
  <form action="" method="POST">
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Cliente</h1>
            <div class="row">
                  <div class="col">
                      <a href="clientes-listado.php" class="btn btn-primary btn-lg active mr-2">Listado</a>
                      <button class="btn btn-primary btn-lg mr-2">Nuevo</button>
                      <button class="btn btn-success btn-lg mr-2" name="btnGuardar">Guardar</button>
                      <button class="btn btn-danger btn-lg mr-2" name="btnBorrar">Borrar</button>
                  </div>
            </div>
            <div>
              
                <div class="row mt-3">
                    <div class="col-12 col-sm-6">
                      <div>
                        <label for="txtNombre">Nombre:</label>
                        <input class="form-control mb-3" type="text" name="txtNombre" id="txtNombre" 
                        value="<?php echo $cliente->nombre ?>" required>
                      </div>
                      <div>
                        <label for="txtFechaNac">Fecha de nacimiento:</label>
                        <input class="form-control mb-3" type="date" name="txtFechaNac" id="txtFechaNac"
                        value="<?php echo $cliente->fecha_nac ?>" >
                      </div>
                      <div>
                        <label for="txtCorreo">Correo:</label>
                        <input class="form-control mb-3" type="email" name="txtCorreo" id="txtCorreo"
                        value="<?php echo $cliente->correo ?>" required>
                      </div>
                    </div>
                    <div class="col-6">
                      <div>
                        <label for="txtCuit">Cuit:</label>
                        <input class="form-control mb-3" type="text" name="txtCuit" id="txtCuit"
                        value="<?php echo $cliente->cuit ?>" required maxlenght= "11">
                      </div>
                      <div>
                        <label for="txtTelefono">Telefono:</label>
                        <input class="form-control mb-3" type="tel" name="txtTelefono" id="txtTelefono"
                        value="<?php echo $cliente->telefono ?>">
                      </div>
                    </div>
                </div>
            </div>
          </div>
        <!-- End of Main Content -->
            <?php 
              if(isset($_POST["btnBorrar"])){
                $cliente->eliminar();
                echo "<div class='alert alert-success text-center'>";
                echo "<strong>El cliente se borró con exito.</strong>";
                echo "</div>";
              }
            ?>
            <?php 
              if(isset($_POST["btnGuardar"])){
                $cliente->insertar();
                echo "<div class='alert alert-success text-center'>";
                echo "<strong>El cliente se guardó con exito.</strong>";
                echo "</div>";
              }
            ?>
        <!-- End of Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span>Copyright &copy; Your Website 2020</span>
          </div>
          </div>
        </footer>

      </div>
      <!-- End of Content Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
  </form>
</body>

</html>
