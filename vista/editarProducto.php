<?php
//Incluir el controlado a emplear
require_once('../controlador/controladorProducto.php');
require_once('../controlador/controladorCategoria.php');
//Recibir valor del id a buscar
$idProducto = base64_decode($_REQUEST['idProducto']);
$idProducto = base64_decode($idProducto);
//base64_decode: Desencripta
//Buscar la categoría en la bd y guardarlo en un objeto
$producto = $controladorProducto->buscarProducto($idProducto);
//var_dump($categoria);

//Listar las categorías
$controladorCategoria = new controladorCategoria();
$listarCategoria = $controladorCategoria->listarCategoria();

?>
<?php
require_once('layoutSuperior.php');
?>

<h1 align='center'>Editar producto</h1>
<form action="../controlador/controladorProducto.php" method="POST">
<label>Id</label>
<input type="text" name="idProducto" id="idProducto" readonly value="<?php echo $producto->getidProducto(); ?>" />
<br><br>
<label>Nombre</label>
<input type="text" name="nombre" id="nombre" value="<?php echo $producto->getnombre(); ?>" />
<br><br>
<label>Categoria</label>
<select name="idCategoria" id="idCategoria">
    <option value="">Seleccione la categoría</option>
    <?php
    foreach ($listarCategoria as $categoria) {
    ?>
        <option value="<?php echo $categoria['idCategoria'] ?>" <?php if ($categoria['idCategoria'] == $producto->getidCategoria()) { ?> selected <?php } ?>>
            <?php echo $categoria['nombre'] ?>
        </option>
    <?php
    }
    ?>
</select>
<br><br>
<label>Precio</label>
<input type="text" name="precio" id="precio" value="<?php echo $producto->getprecio(); ?>" />
<br><br>
<label>Estado</label>
<input type="radio" name="estado" id="estadoD" <?php if ($producto->getestado() == 1) { ?> checked <?php } ?> />Disponible
<input type="radio" name="estado" id="estadoND" <?php if ($producto->getestado() == 0) { ?> checked <?php } ?> />No Disponible
<br><br>
<button type="submit" name="actualizar">Actualizar</button>
</form>
<?php
require_once('layoutInferior.php');
?>