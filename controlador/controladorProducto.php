<?php
require_once('../modelo/producto.php');
require_once('../modelo/crudProducto.php');
class controladorProducto{

    public function __construct(){
            
    }

    public function listarProducto(){
        //crear objeto de la clase producto
        $crudProducto = new crudProducto();
        return $crudProducto->listarProducto();
    }

    public function registrarProducto($idCategoria, $nombre, $precio, $estado){
        //Crear un objeto de la clase producto
        $crudProducto = new crudProducto();
        $Producto = new Producto();
        $Producto->setidProducto('');
        $Producto->setidCategoria($idCategoria);
        $Producto->setnombre($nombre);
        $Producto->setprecio($precio);
        $Producto->setestado($estado);
        $mensaje = $crudProducto->registrarProducto($Producto);
        echo "<script>
        alert('$mensaje');
        document.location.href='../vista/listarProducto.php';
        </script>";
    }

    public function buscarProducto($idProducto){
        $crudProducto = new crudProducto();
        $Producto= new Producto();
        $Producto->setidProducto($idProducto);
        //Buscar los datos de la categoría en la BD
        $datosProducto = $crudProducto->buscarProducto($Producto);
        $Producto->setidCategoria($datosProducto['idCategoria']);
        $Producto->setnombre($datosProducto['nombre']);
        $Producto->setprecio($datosProducto['precio']);
        $Producto->setestado($datosProducto['estado']);
        //var_dump($Categoria);
        return $Producto;
    }

    public function actualizarProducto($idProducto,$idCategoria,$nombre,$precio,$estado){
        //Crear un objeto de la clase categoria
        $crudProducto = new crudProducto();
        $Producto = new Producto();
        $Producto->setidProducto($idProducto);
        $Producto->setidCategoria($idCategoria);
        $Producto->setnombre($nombre);
        $Producto->setprecio($precio);
        $Producto->setestado($estado);
        $mensaje = $crudProducto->actualizarProducto($Producto);
        echo "<script>
        alert('$mensaje);
        document.location.href='../vista/listarProducto.php';
        </script>";
    }

    public function eliminarProducto($idProducto){
        //Crear un objeto de la clase categoria
        $crudProducto = new crudProducto();
        $Producto = new Producto();
        $Producto->setidProducto($idProducto);
        $mensaje = $crudProducto->eliminarProducto($Producto);
        //echo $mensaje;
        //El siguiente script muestra eventos con Javascript
        echo "<script>
        alert('$mensaje');
        document.location.href='../vista/listarProducto.php';
                </script>";
    }

    public function buscarPrecio($idProducto){
        $crudProducto = new crudProducto();
        $Producto= new Producto();
        $Producto->setidProducto($idProducto);
        $datosProducto = $crudProducto->buscarProducto($Producto);
        return $datosProducto['precio'];
    }

    public function desplegarVista($pagina){
        header("Location:../vista/".$pagina);
    }
}

$controladorProducto = new controladorProducto();

if (isset($_POST['registrar'])){ //Si la variable existe
    //Recibir variables del formulario
    $idCategoria = $_POST['idCategoria'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $controladorProducto->registrarProducto($idCategoria, $nombre, $precio, $estado);
}
else if(isset($_REQUEST['editar'])){
    //Recibir variables desde el formulario
    $idProducto = base64_encode($_REQUEST['idProducto']);
    $idProducto = base64_encode($idProducto);
    //base_ decode: función que encripta una variable
    $controladorProducto->desplegarVista('editarProducto.php?idProducto='.$idProducto);
}
else if (isset($_POST['actualizar'])){ //Si la variable existe
    //Recibir variables del formulario
    $idProducto = $_POST['idProducto'];
    $idCategoria = $_POST['idCategoria'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $controladorProducto->actualizarProducto($idProducto,$idCategoria,$nombre,$precio,$estado);
    $controladorProducto->desplegarVista('listarProducto.php');
}
else if(isset($_GET['eliminar'])){
    //Recibir variables desde el formulario
    $idProducto = $_REQUEST['idProducto'];
    $controladorProducto->eliminarProducto($idProducto);
}

elseif(isset($_POST['buscarPrecio'])){
    $idProducto =$_REQUEST['idProducto'];
    echo $controladorProducto->buscarPrecio($idProducto);
}
elseif(isset($_REQUEST['vista'])){
    $controladorProducto->desplegarVista($_REQUEST['vista']);
}

?>