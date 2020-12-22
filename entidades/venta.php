<?php 
include_once "config.php";
include_once "producto.php";
include_once "cliente.php";
include_once "tipoproducto.php";
    class Venta{
        private $idventa;
        private $fk_idcliente;
        private $fk_idproducto;
        private $fecha;
        private $hora;
        private $cantidad;
        private $preciounitario;
        private $total;
        public function __construct(){
            $this->preciounitario = 0.00;
            $this->total = 0.00;
        }
        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo,$valor){
            $this->$atributo = $valor;
            return $this;
        }
    public function cargarFormulario($request){
        $this->idventa = isset($request["id"])? $request["id"] :"";
        $this->fecha = isset($request["txtFecha"])? $request["txtFecha"] :"";
        $this->hora = isset($request["txtHora"])? $request["txtHora"] :"";
        $this->cantidad = isset($request["txtCantidad"])? $request["txtCantidad"] :"";
        $this->preciounitario = isset($request["txtPrecioUnitario"])? $request["txtPrecioUnitario"] :"";
        $this->total = isset($request["txtTotal"])? $request["txtTotal"] :"";
        $this->fk_idproducto = isset($request["txtProducto"])? $request["txtProducto"] :"";
        $this->fk_idcliente = isset($request["txtCliente"])? $request["txtCliente"] :"";
    }

    public function obtenerVentasClientes($id){
        $cantidad = 0;
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT count(*) as cantidad FROM ventas WHERE fk_idcliente = $id";
        if(!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        if($fila = $resultado->fetch_assoc()){
            $cantidad = $fila['cantidad'];
        }

        $mysqli->close();
        return $cantidad;
    }
    public function insertar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "INSERT INTO ventas(
            fecha,
            hora,
            fk_idcliente,
            fk_idproducto,
            cantidad,
            preciounitario,
            total
            ) VALUES(
                '" . $this->fecha ."',
                '" . $this->hora ."',
                '" . $this->fk_idcliente ."',
                '" . $this->fk_idproducto ."',
                '" . $this->cantidad ."',
                '" . $this->preciounitario ."',
                '" . $this->total ."'
            );";
        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $this->idventa = $mysqli->insert_id;
        $mysqli->close();
    }
    public function actualizar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE ventas SET
            fecha = '" . $this->fecha ."',
            hora = '" . $this->hora ."',
            fk_idcliente = '".$this->fk_idcliente."',
            fk_idproducto = '".$this->fk_idproducto."',
            cantidad = '" . $this->cantidad ."',
            preciounitario = '" . $this->preciounitario ."',
            total = '" . $this->total ."'
            WHERE idventa = " .$this->idventa;

        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $mysqli->close();
    }
    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM ventas WHERE idventa = ". $this->idventa;
        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $mysqli->close();
    }
    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT  idventa,
                        fk_idcliente,
                        fk_idproducto,
                        fecha,
                        hora,
                        cantidad,
                        preciounitario,
                        total
                FROM ventas
                WHERE idventa = ". $this->idventa;
        if(!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        if($fila = $resultado->fetch_assoc()){
            //fetch_assoc --->convertir en un array asociativo
            $this->idventa = $fila["idventa"];
            $this->fk_idcliente = $fila["fk_idcliente"];
            $this->fk_idproducto = $fila["fk_idproducto"];
            $this->fecha = $fila["fecha"];
            $this->hora = $fila["hora"];
            $this->cantidad = $fila["cantidad"];
            $this->preciounitario = $fila["preciounitario"];
            $this->total = $fila["total"];
        }
        $mysqli->close();
    }
    public function obtenerTodos(){
        $aVentas = null;
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT
                A.idventa,
                A.fk_idcliente,
                A.fk_idproducto,
                A.fecha,
                A.hora,
                B.nombre as nombre_cliente,
                C.nombre as nombre_producto,
                A.cantidad,
                A.preciounitario,
                A.total
                FROM 
                    ventas A
                INNER JOIN clientes B ON A.fk_idcliente = B.idcliente
                INNER JOIN productos C ON A.fk_idproducto = C.idproducto
                ORDER BY A.fecha DESC");
        if(!$resultado){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        if ($resultado){
            while($fila = $resultado->fetch_assoc()){
                $entidadAux = new Venta();
                $entidadAux->idventa = $fila["idventa"];
                $entidadAux->fk_idcliente = $fila["fk_idcliente"];
                $entidadAux->fk_idproducto = $fila["fk_idproducto"];
                $entidadAux->fecha = $fila["fecha"];
                $entidadAux->hora = $fila["hora"];
                $entidadAux->nombre_cliente = $fila["nombre_cliente"];
                $entidadAux->nombre_producto = $fila["nombre_producto"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->preciounitario = $fila["preciounitario"];
                $entidadAux->total = $fila["total"];
                $aVentas[] = $entidadAux;
            }
            return $aVentas;
        }
    }
    public function obtenerFacturacionMensual($mes){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT SUM(total) AS total FROM ventas WHERE MONTH(fecha) = $mes";
        if(!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $fila = $resultado->fetch_assoc();
        return $fila["total"];
    }
    public function obtenerFacturacionAnual($anio){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT SUM(total) AS total FROM ventas WHERE YEAR(fecha) = $anio";
        if(!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $fila = $resultado->fetch_assoc();
        return $fila["total"];
    }
}
?>