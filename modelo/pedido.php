<?php
require_once('conexion.php');
class Pedido{
    private $idPedido;
    private $idCliente;
    private $fecha;
    private $estado;
    private $idUsuario;
    

    public function __construct(){

    }

    public function setidPedido($idPedido){
        $this->idPedido = $idPedido;
    }

    public function setidCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    public function setfecha($fecha){
        $this->fecha = $fecha;
    }

    public function setestado($estado){
        $this->estado = $estado;
    }

    public function setidUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function getidPedido(){
        return $this->idPedido;
    }

    public function getidCliente(){
        return $this->idCliente;
    }

    public function getfecha(){
        return $this->fecha;
    }

    public function getestado(){
        return $this->estado;
    }

    public function getidUsuario(){
        return $this->idUsuario;
    }

    public function listarPedido(){
        $baseDatos = Conexion::conectar();
        $sql = $baseDatos->query('SELECT pedido.*,cliente.razonSocial AS nombreCliente
        FROM pedido INNER JOIN cliente ON pedido.idCliente = cliente.idCliente
        ORDER BY idPedido DESC');
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function registrarPedido($pedido){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        pedido(idPedido,idCliente, fecha, estado, idUsuario)
        VALUES(:idPedido,:idCliente, now(), :estado,:idUsuario) ');
        $sql->bindValue('idPedido', '');
        $sql->bindValue('idCliente', $pedido->getidCliente());
        $sql->bindValue('estado', $pedido->getestado());
        $sql->bindValue('idUsuario', $pedido->getidUsuario());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje = $baseDatos->lastInsertId();//Capturar el último id insertado
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }

}

?>