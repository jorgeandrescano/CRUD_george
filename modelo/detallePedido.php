<?php
require_once('conexion.php');
class DetallePedido{
    private $idDetallePedido;
    private $idPedido;
    private $idProducto;
    private $cantidad;
    private $precio;
    

    public function __construct(){

    }

    public function setidDetallePedido($idDetallePedido){
        $this->idDetallePedido = $idDetallePedido;
    }

    public function setidPedido($idPedido){
        $this->idPedido = $idPedido;
    }

    public function setidProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function setcantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setprecio($precio){
        $this->precio = $precio;
    }

    public function getidDetallePedido(){
        return $this->idDetallePedido;
    }

    public function getidPedido(){
        return $this->idPedido;
    }

    public function getidProducto(){
        return $this->idProducto;
    }

    public function getcantidad(){
        return $this->cantidad;
    }

    public function getprecio(){
        return $this->precio;
    }

    public function listarDetallePedido($detallePedido){
        $baseDatos = Conexion::conectar();
        $sql = $baseDatos->query("SELECT detalle_pedido.* 
        FROM detalle_pedido 
        WHERE idPedido = ".$detallePedido->getidPedido()); 
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll());
    }

    public function registrarDetallePedido($detallePedido){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        detalle_pedido(idDetallePedido,idPedido,idProducto, cantidad, precio)
        VALUES(:idDetallePedido,:idPedido,:idProducto,:cantidad, :precio) ');
        $sql->bindValue('idDetallePedido', '');
        $sql->bindValue('idPedido', $detallePedido->getidPedido());
        $sql->bindValue('idProducto', $detallePedido->getidProducto());
        $sql->bindValue('cantidad', $detallePedido->getcantidad());
        $sql->bindValue('precio', $detallePedido->getprecio());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje = "Registro exitoso";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }
}

?>