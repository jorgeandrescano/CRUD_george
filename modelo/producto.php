<?php
class Producto{
    //Definir atributos reservados
    private $idProducto;
    private $idCategoria;
    private $nombre;
    private $precio;
    private $estado;

    //DEfinir el constructor
    public function __construct(){

    }

    public function setidProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function setidCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    public function setnombre($nombre){
        $this->nombre = $nombre;
    }

    public function setprecio($precio){
        $this->precio = $precio;
    }

    public function setestado($estado){
        $this->estado = $estado;
    }
    
    public function getidProducto(){
        return $this->idProducto;
    }

    public function getidCategoria(){
        return $this->idCategoria;
    }

    public function getnombre(){
        return $this->nombre;
    }

    public function getprecio(){
        return $this->precio;
    }

    public function getestado(){
        return $this->estado;
    }       
}
?>