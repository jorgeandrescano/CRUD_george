<?php
class Categoria{
    //Definir los atributos
    private $idCategoria;
    private $nombre;

    //Definir el constructor
    public function __construct(){

    }

    /*
    public function __construct($idCategoria,$nombre){
        this->idCategoria = $idCategoria;
        this->nombre = $nombre;
    }
    */

    //Definir los métodos set y get
    public function setidCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    public function setnombre($nombre){
        $this->nombre = $nombre;
    }

    public function getidCategoria(){
        return $this->idCategoria;
    }

    public function getnombre(){
        return $this->nombre;
    }       
}
?>