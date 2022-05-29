<?php
require_once('../modelo/categoria.php');
require_once('../modelo/crudCategoria.php');
class controladorCategoria{

    public function __construct(){
            
    }

    public function listarCategoria(){
        //crear objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $listaCategoria = $crudCategoria->listarCategoria();
        return $listaCategoria;
    }

    public function registrarCategoria($nombre){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $categoria = new Categoria();
        $categoria->setidCategoria('');
        $categoria->setnombre($nombre);
        $mensaje = $crudCategoria->registrarCategoria($categoria);
        echo "<script>
        alert('$mensaje');
        document.location.href='../vista/listarCategoria.php';
        </script>";
    }

    public function buscarCategoria($idCategoria){
        $crudCategoria = new crudCategoria();
        $categoria = new Categoria();
        $categoria->setidCategoria($idCategoria);
        //Buscar los datos de la categoría en la BD
        $datosCategoria = $crudCategoria->buscarCategoria($categoria);
        $categoria->setnombre($datosCategoria['nombre']);
        //var_dump($Categoria);
        return $categoria;
    }

    public function actualizarCategoria($idCategoria,$nombre){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $categoria = new Categoria();
        $categoria->setidCategoria($idCategoria);
        $categoria->setnombre($nombre);
        //var_dump($Categoria);
        $mensaje = $crudCategoria->actualizarCategoria($categoria);
        echo "<script>
        alert('$mensaje);
        document.location.href='../vista/listarCategoria.php';
        </script>";
    }

    public function eliminarCategoria($idCategoria){
        //Crear un objeto de la clase categoria
        $crudCategoria = new crudCategoria();
        $Categoria = new Categoria();
        $Categoria->setidCategoria($idCategoria);
        $Categoria->setnombre('');
        //var_dump($Categoria);
        $mensaje = $crudCategoria->eliminarCategoria($Categoria);
        //echo $mensaje;
        //El siguiente script muestra eventos con Javascript
        echo "<script>
        alert('$mensaje');
        document.location.href='../vista/listarCategoria.php';
                </script>";
    }

    public function desplegarVista($pagina){
        header("location:../vista/".$pagina);
    }
}

$controladorCategoria = new controladorCategoria();

if (isset($_POST['registrar'])){ //Si la variable existe
    //Recibir variables del formulario
    $nombre = $_POST['nombre'];
    $controladorCategoria->registrarCategoria($nombre);
}
else if(isset($_REQUEST['editar'])){
    //Recibir variables desde el formulario
    $idCategoria = base64_encode($_REQUEST['idCategoria']);
    $idCategoria = base64_encode($idCategoria);
    //base_ decode: función que encripta una variable
    //$controladorCategoria->buscarCategoria($idCategoria);
    $controladorCategoria->desplegarVista("editarCategoria.php?idCategoria=$idCategoria");
}
else if (isset($_POST['actualizar'])){ //Si la variable existe
    //Recibir variables del formulario
    $idCategoria = $_POST['idCategoria'];
    $nombre = $_POST['nombre'];
    $controladorCategoria->actualizarCategoria($idCategoria,$nombre);
    $controladorCategoria->desplegarVista('listarCategoria.php');
}
else if(isset($_GET['eliminar'])){
    //Recibir variables desde el formulario
    $idCategoria = $_REQUEST['idCategoria'];
    $controladorCategoria->eliminarCategoria($idCategoria);
    //$controladorCategoria->desplegarVista('listarCategoria.php');
}
elseif(isset($_REQUEST['vista'])){
    $controladorCategoria->desplegarVista($_REQUEST['vista']);
}

?>