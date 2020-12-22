<?php 
include_once "config.php";
include_once "venta.php";
class Producto{
    private $idproducto;
    private $nombre;
    private $idtipoproducto;
    private $cantidad;
    private $precio;
    private $descripcion;
    private $imagen;
    public function __construct(){
        $this->cantidad = 0;
        $this->precio = 0.00;
    }
    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo,$valor){
        $this->$atributo = $valor;
            return $this;
    }
    public function cargarFormulario($request){
        $this->idproducto = isset($request["id"])? $request["id"] :"";
        $this->nombre = isset($request["txtNombre"])? $request["txtNombre"] :"";
        $this->fk_idtipoproducto = isset($request["lstTipoProducto"])? $request["lstTipoProducto"] :"";
        $this->cantidad = isset($request["txtCantidad"])? $request["txtCantidad"] :"";
        $this->precio = isset($request["txtPrecio"])? $request["txtPrecio"] :"";
        $this->descripcion = isset($request["txtDescripcion"])? $request["txtDescripcion"] :"";
        //$this->imagen = isset($request["txtImagen"])? $request["txtImagen"] :"";
    }
    public function insertar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "INSERT INTO productos(
            nombre,
            cantidad,
            precio,
            descripcion,
            imagen
            ) VALUES(
                '" . $this->nombre ."',
                '" . $this->cantidad ."',
                '" . $this->precio ."',
                '" . $this->descripcion ."',
                '" . $this->imagen ."'
            );";
        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $this->idproducto = $mysqli->insert_id;
        $mysqli->close();
    }
    public function actualizar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE productos SET
            nombre = '" . $this->nombre ."',
            fk_idtipoproducto = ". $this->fk_idtipoproducto."
            cantidad = '" . $this->cantidad ."',
            precio = '" . $this->precio ."',
            descripcion = '" . $this->descripcion ."',
            imagen = '" . $this->imagen ."'
            WHERE idproducto = " .$this->idproducto;

        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $mysqli->close();
    }
    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM productos WHERE idproducto = ". $this->idproducto;
        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $mysqli->close();
    }
    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idproducto,
                       fk_idtipoproducto,
                       nombre,
                       cantidad,
                       precio,
                       descripcion,
                       imagen
                FROM productos
                WHERE idproducto = ".$this->idproducto;
        if (!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        if($fila = $resultado->fetch_assoc()){
            //fetch_assoc --->convertir en un array asociativo
            $this->idproducto = $fila["idproducto"];
            $this->fk_idtipoproducto = $fila["fk_idtipoproducto"];
            $this->nombre = $fila["nombre"];
            $this->cantidad = $fila["cantidad"];
            $this->precio = $fila["precio"];
            $this->descripcion = $fila["descripcion"];
            $this->imagen = $fila["imagen"];
        }
        $mysqli->close();
    }
    public function obtenerTodos(){
        $aProductos = null;
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT
                    A.idproducto,
                    A.nombre,
                    A.fk_idtipoproducto,
                    A.cantidad,
                    A.precio,
                    A.descripcion,
                    A.imagen
                FROM productos A");
            if ($resultado){
                while($fila = $resultado->fetch_assoc()){
                    $obj = new Producto();
                    $obj->idproducto = $fila["idproducto"];
                    $obj->nombre = $fila["nombre"];
                    $obj->fk_idtipoproducto = $fila["fk_idtipoproducto"];
                    $obj->cantidad = $fila["cantidad"];
                    $obj->precio = $fila["precio"];
                    $obj->descripcion = $fila["descripcion"];
                    $obj->imagen = $fila["imagen"];
                    $aProductos[] = $obj;
                }
                return $aProductos;
            }
    }
}
?>