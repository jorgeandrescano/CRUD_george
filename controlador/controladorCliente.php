<?php
require_once('../modelo/crudCliente.php');

class controladorCliente{
    
    public function __construct(){

    }
    public function listarCliente(){
        $crudCliente = new crudCliente();
        return $crudCliente->listarCliente();
    }
}
$controladorCliente = new controladorCliente();
?>