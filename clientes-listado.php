<?php
  include_once "config.php";
  include_once "entidades/cliente.php";
  $pg = "listado de clientes";
  $entidadCliente = new Cliente();
  $aClientes = $entidadCliente->obtenerTodos();
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
    include_once("menu.php")
  ?>
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Listado de clientes</h1>
    <div class="row">
      <div class="col">
        <a href="cliente-formulario.php" class="btn btn-primary btn-md mr-2 mb-4">Nuevo</a>
      </div>
    </div>
    <table class="table table-hover border">
      <thead>
        <tr>
          <th>CUIT</th>
          <th>Nombre</th>
          <th>Fecha nac.</th>
          <th>Telefono</th>
          <th>Correo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <?php foreach($aClientes as $cliente){ ?>
        <tr>
          <td> <?php echo $cliente->cuit; ?> </td>
          <td> <?php echo $cliente->nombre; ?> </td>
          <td> <?php echo $cliente->fecha_nac; ?> </td>
          <td> <?php echo $cliente->telefono; ?> </td>
          <td> <?php echo $cliente->correo; ?> </td>
          <td><a href="cliente-formulario.php?id=<?php echo $cliente->idcliente;?>"><i class="fas fa-search"></i></a></td>
        </tr>
      <?php }?>
    </table>
      




  </div>
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

</body>

</html>
