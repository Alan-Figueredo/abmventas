<?php
    class Usuario{
        private $idusuario;
        private $usuario;
        private $clave;
        private $nombre;
        private $apellido;
        private $correo;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo,$valor){
            $this->$atributo = $valor;
            return $this;
        }
        public function insertar(){
            $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
            $sql = "INSERT INTO usuario(
                            idusuario,
                            usuario,
                            clave,
                            nombre,
                            apellido,
                            correo
                ) VALUES(
                    '" . $this->idusuario ."',
                    '" . $this->usuario ."',
                    '" . $this->clave ."',
                    '" . $this->nombre ."',
                    '" . $this->apellido ."',
                    '" . $this->correo ."'
                );";
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " ".$sql);
            }
            $this->idusuario = $mysqli->insert_id;
            $mysqli->close();
        }
        public function actualizar(){
            $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
            $sql = "UPDATE usuario SET
                idusuario = '" . $this->idusuario ."',
                usuario = '" . $this->usuario ."',
                clave = '".$this->clave."',
                nombre = '".$this->nombre."',
                apellido = '" . $this->apellido ."',
                correo = '" . $this->correo ."',
                WHERE idusuario = " .$this->idusuario;
    
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " ".$sql);
            }
            $mysqli->close();
        }
        public function eliminar(){
            $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
            $sql = "DELETE FROM ventas WHERE idusuario = ". $this->idusuario;
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " ".$sql);
            }
            $mysqli->close();
        }
        public function obtenerPorUsuario($usuario){
            $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
            $sql = "SELECT  idusuario,
                            usuario,
                            clave,
                            nombre,
                            apellido,
                            correo
                    FROM usuario
                    WHERE usuario = '". $usuario."'";
            if(!$resultado = $mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " ".$sql);
            }
            if($fila = $resultado->fetch_assoc()){
                //fetch_assoc --->convertir en un array asociativo
                $this->idusuario = $fila["idusuario"];
                $this->usuario = $fila["usuario"];
                $this->clave = $fila["clave"];
                $this->nombre = $fila["nombre"];
                $this->apellido = $fila["apellido"];
                $this->correo = $fila["correo"];
            }
            $mysqli->close();
        }
        public function encriptarClave($clave){
            $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
            return $claveEncriptada;
        }
        public function verificarClave($claveIngresada, $claveEnBBDD){
            return password_verify($claveIngresada, $claveEnBBDD);
        }
    }


?>