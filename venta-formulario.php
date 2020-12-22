<?php
    include_once "config.php";
    include_once "entidades/venta.php";
    include_once "entidades/cliente.php";
    include_once "entidades/producto.php";
    $pg = "listado de ventas";
    $venta = new Venta();
    $venta->cargarFormulario($_REQUEST);

    $cliente = new Cliente();
    $aClientes = $cliente->obtenerTodos();

    $producto = new Producto();
    $aProductos = $producto->obtenerTodos();
    if($_POST){
        if(isset($_POST["btnGuardar"])){
            if(isset($_GET["id"]) && $_GET["id"] > 0){
                $venta->actualizar();
        }else{
            $venta->insertar();
        }
        }else if(isset($_POST["btnBorrar"])){
        $venta->eliminar();
        }
    }
    if(isset($_GET["id"]) && $_GET["id"] > 0){
        $venta->idventa = $_GET["id"];
        $venta->obtenerPorId();
    }
    if(isset($_GET["do"]) && $_GET["do"] == "buscarProducto"){
        $idproducto = $_GET["id"];
        $producto = new Producto();
        $producto->idproducto = $idproducto;
        $producto->obtenerPorId();
        echo json_encode($producto->precio);
        exit;
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <title>Edición de producto</title>

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
                <h1 class="h3 mb-4 text-gray-800">Venta</h1>
                <div class="row">
                    <div class="col">
                        <a href="ventas-listado.php"class="btn btn-primary btn-md active mr-2">Listado</a>
                        <a href="#"class="btn btn-primary btn-md active mr-2">Nuevo</a>
                        <button class="btn btn-success btn-md mr-2" name="btnGuardar">Guardar</button>
                        <button class="btn btn-danger btn-md mr-2" name="btnBorrar">Borrar</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-6">
                        <label for="txtFecha">Fecha:</label>
                        <input value="<?php echo isset($_GET['id']) ? date_format(date_create($venta->fecha), 'Y-m-d') : date('Y') . '-' . date('m') . '-' . date('d'); ?>" class="form-control mb-3" type="date" name="txtFecha" id="txtFecha">
                    </div>



                    <div class="col-12 col-sm-6">
                        <label for="txtHora">Hora:</label>
                        <input class="form-control mb-3" type="time" name="txtHora" id="txtHora"
                        value="<?php echo isset($_GET['id'])? $venta->hora :date('H:i')?> " required>
                    </div>



                    <div class="col-12 col-sm-6 form-group">
                        <label for="txtCliente">Cliente:</label>
                        <select name="txtCliente" id="txtCliente" class="form-control selectpicker" data-live-search="true">
                            <option value="" disabled selected>Seleccionar</option>
                            <?php foreach($aClientes as $cliente):?>
                                <option>
                                    <?php echo $cliente->idcliente;?>
                                    <?php echo $cliente->nombre?>
                            <?php endforeach; ?>
                                </option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 form-group">
                        <label for="txtProducto">Producto:</label>
                        <select name="txtProducto" id="txtProducto" class="form-control selectpicker" data-live-search="true" onchange="fBuscarPrecioUnitario();">
                            <option value="" disabled selected>Seleccionar</option>
                            <?php foreach($aProductos as $producto):?>
                                <option>
                                    <?php  $producto->idproducto;?>
                                    <?php echo $producto->nombre?>
                            <?php endforeach; ?>
                                </option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="txtPrecioUnitario">Precio unitario:</label>
                        <input class="form-control mb-3" type="text" name="txtPrecioUnitario" id="txtPrecioUnitario" placeholder="0">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="txtCantidad">Cantidad:</label>
                        <input class="form-control mb-3" type="text" name="txtCantidad" id="txtCantidad" placeholder="0">
                    </div>
                    <divm class="col-12 col-sm-6">
                        <label for="txtTotal">Total:</label>
                        <input class="form-control mb-3" type="text" name="txtTotal" id="txtTotal" placeholder="0">
                    </div>
                </div>
            </div>
        </form>
            <?php 
              if(isset($_POST["btnBorrar"])){
                $venta->eliminar();
                echo "<div class='alert alert-success text-center'>";
                echo "<strong>El producto se borró con exito.</strong>";
                echo "</div>";
              }
            ?>
            <?php 
              if(isset($_POST["btnGuardar"])){
                $venta->insertar();
                echo "<div class='alert alert-success text-center'>";
                echo "<strong>El producto se guardó con exito.</strong>";
                echo "</div>";
              }
            ?>
    <!-- End of Main Content -->
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
    <script>
    function fBuscarPrecioUnitario(){
        idproducto = $("#txtProducto").val();
        $.ajax({
            type: "GET",
            url: "venta-formulario.php?do=buscarProducto",
            data: { id:idproducto },
            async: true,
            dataType: "json",
            success: function(respuesta){
                $("#txtPrecioUnitario").val(respuesta);
            }
        });
    }
    </script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>