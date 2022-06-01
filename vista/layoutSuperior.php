<?php
session_start();
//Garantizar que si no se está logueado se envíe al index
if(!isset($_SESSION['nombreUsuario'])){
    header("location:../index.html");
}

if(isset($_REQUEST['pagina'])){
    $pagina = $_REQUEST['pagina'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>CRUD Básico</title>
</head>
<body>
<div id="contenedor">
    <div id="superior">
        <a href="../controlador/controladorLogin.php?accion=Salir">Salir</a>
    </div>
    <div id="medio">
        <div id="izquierdo">
            <?php
            if ($_SESSION['idRol']==1){
            ?>
                <a href="../controlador/controladorCategoria.php?vista=listarCategoria.php">Categorias</a>
                <br>
                <a href="../controlador/controladorProducto.php?vista=listarProducto.php">Productos</a>
                <br>
                <a href="../controlador/controladorPedido.php?vista=listarPedido.php">Pedidos</a>
            <br>
            <?php
            }
            else{
            ?>
                <a href="../controlador/controladorProducto.php?vista=listarProducto.php">Productos</a>
            <?php
            }
            ?>
        </div>
        <div id="derecho">