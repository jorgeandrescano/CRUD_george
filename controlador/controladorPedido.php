<?php
require_once('../modelo/pedido.php');
require_once('../modelo/detallePedido.php');

function listarPedido(){
    $pedido = new Pedido();
    return $pedido->listarPedido(); //Llamar el método que lista el pedido
}

function listarDetallePedido($detallePedido){
    $detallePedido = new DetallePedido();
    return $detallePedido->listarDetallePedido($detallePedido);
}

function desplegarVista($pagina){
    header("location:../vista/".$pagina);
}

if(isset($_POST['accion'])){
    session_start(); //Permitir trabajar con variables de sesión
    switch($_POST['accion']){
        case 'registrar':
                $idPedido = $_POST['idPedido'];
                $idCliente = $_POST['idCliente'];
                $idProducto = $_POST['idProducto'];
                $cantidad =  $_POST['cantidad'];
                $precio = $_POST['precio'];
                $idUsuario = $_SESSION['idUsuario'];
                $pedido = new Pedido();
                $pedido->setidPedido($idPedido);
                $pedido->setidCliente($idCliente);
                $pedido->setestado(1);
                $pedido->setidUsuario($idUsuario);
                //Instanciar Pedido

                if($idPedido == ""){
                    $pedido = new Pedido();
                    $pedido->setidPedido($idPedido);
                    $pedido->setidCliente($idCliente);
                    $pedido->setestado(1);
                    $pedido->setidUsuario($idUsuario);
                    $idPedido = $pedido->registrarPedido($pedido);
                }
                //Instanciar DetallePedido
                $detallePedido = new DetallePedido();
                $detallePedido->setidDetallePedido('');
                $detallePedido->setidPedido($idPedido);
                $detallePedido->setidProducto($idProducto);
                $detallePedido->setcantidad($cantidad);
                $detallePedido->setprecio($precio);
                $detallePedido->registrarDetallePedido($detallePedido); 
                echo $idPedido;
                break;

                case 'listarDetalle':
                    $idPedido = $_POST['idPedido'];
                    $detallePedido = new DetallePedido();
                    $detallePedido->setidPedido($idPedido);
                    $listaDetalle = $detallePedido->listarDetallePedido($detallePedido);
                    $header = "table border='1' align='center'>
                    <thead>
                    <tr>
                    <th>Id</th>
                    <th>Cantidad</th>
                    </tr></thead>";
                    $content = "";
                    foreach($listaDetalle as $detalle){
                        $content = $content."<tr>
                        <td>$detalle[idProducto]</td>
                        <td>$detalle[cantidad]</td>
                        </tr>";
                    }
                    $footer = "</table>";
                    break;
    }   
}
else if(isset($_REQUEST['vista'])){
    desplegarVista($_REQUEST['vista']);
}
?>