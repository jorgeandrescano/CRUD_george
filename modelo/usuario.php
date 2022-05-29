<?php
require_once('conexion.php');
class Usuario{
    private $idUsuario;
    private $nombreUsuario;
    private $contrasena;
    private $idRol;
    private $estado;
    private $logueado;

    public function __construct() {
    }

    public function setidUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function setnombreUsuario($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setcontrasena($contrasena){
        $this->contrasena = $contrasena;
    }

    public function setidRol($idRol){
        $this->idRol= $idRol;
    }

    public function setestado($estado){
        $this->estado = $estado;
    }

    public function setlogueado($logueado){
        $this->logueado = $logueado;
    }

    public function getidUsuario(){
        return $this->idUsuario;
    }

    public function getnombreUsuario(){
        return $this->nombreUsuario;
    }

    public function getcontrasena(){
        return $this->contrasena;
    }

    public function getidRol(){
        return $this->idRol;
    }

    public function getestado(){
        return $this->estado;
    }

    public function getlogueado(){
        return $this->logueado;
    }

    public function validarAccceso(){
        
        $nombreUsuario = Usuario::getnombreUsuario();
        Usuario::setlogueado(0);
        $contrasena = hash('sha512',Usuario::getcontrasena());
        $baseDatos = Conexion::conectar();
        $sql = $baseDatos->query("SELECT * FROM usuario
                WHERE nombreUsuario='$nombreUsuario' 
                AND contrasena='$contrasena' ");

                try{
                    $sql->execute();
                    if($sql->rowCount() > 0){ //Se devolvieron registros
                        $datosUsuario = $sql->fetch();
                        Usuario::setidUsuario($datosUsuario['idUsuario']);
                        Usuario::setidRol($datosUsuario['idRol']);
                        Usuario::setestado($datosUsuario['estado']);
                        Usuario::setlogueado(1);

                    }
                }
                catch(Exception $e){
                    echo "Problemas en el login";
                }
        $sql->execute();
        Conexion::desconectar($baseDatos); //Cierra la conexión
        //var_dump($sql->fetch());
    }

}

?>