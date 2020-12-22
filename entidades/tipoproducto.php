<?php
include_once "config.php";
class TipoProducto{
        private $idtipoproducto;
        private $nombre;
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
        //$this->imagen = isset($request["txtImagen"])? $request["txtImagen"] :"";
    }
    public function insertar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "INSERT INTO tipoproducto(
            idtipoproducto,
            nombre
            ) VALUES(
                '" . $this->nombre ."'
                '" . $this->idtipoproducto ."'
            );";
        if (!$mysqli->query($sql)){
            printf("Erro en query: %s\n", $mysqli->error . " ".$sql);
        }
        $this->idtipoproducto = $mysqli->insert_id;
        $mysqli->close();
    }
    public function actualizar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE tipoproducto SET
            nombre = '" . $this->nombre ."',
            idtipoproducto = '" . $this->idtipoproducto ."',
            WHERE idtipoproducto = " .$this->idtipoproducto;

        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $mysqli->close();
    }
    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM tipoproducto WHERE idtipoproducto = ". $this->idtipoproducto;
        if (!$mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        $mysqli->close();
    }
    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idtipoproducto,
                        nombre
                FROM tipoproducto
                WHERE idtipoproducto = ". $this->idtipoproducto;
        if(!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\n", $mysqli->error . " ".$sql);
        }
        if($fila = $resultado->fetch_assoc()){
            //fetch_assoc --->convertir en un array asociativo
            $this->idtipoproducto = $fila["idtipoproducto"];
            $this->nombre = $fila["nombre"];
        }
        $mysqli->close();
    }
    public function obtenerTodos(){
        $aTipoProducto = null;
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $resultado = $mysqli->query("SELECT
                    A.idtipoproducto,
                    A.nombre
                FROM tipoproducto A");
            if ($resultado){
                while($fila = $resultado->fetch_assoc()){
                    $obj = new TipoProducto();
                    $obj->idtipoproducto = $fila["idtipoproducto"];
                    $obj->nombre = $fila["nombre"];
                    $aTipoProducto[] = $obj;
                }
                return $aTipoProducto;
            }
    }
}
?>