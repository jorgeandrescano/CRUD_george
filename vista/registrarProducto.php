<?php
require_once('../controlador/controladorCategoria.php');
$controladorCategoria = new controladorCategoria();
$listarCategoria = $controladorCategoria->listarCategoria();
?>
<?php 
require_once('layoutSuperior.php');
?>
    <h1 align='center'>Registrar producto</h1>
    <form action="../controlador/controladorProducto.php" method="POST">
    <label>Nombre</label>
    <input type="text" name="nombre" id="nombre" />
    <br><br>
    <label>Categoria</label>
    <select name="idCategoria" id="idCategoria">
        <option value="">Seleccione la categoría</option>
        <?php
        foreach($listarCategoria as $categoria){
        ?>
        <option value="<?php echo $categoria['idCategoria'] ?>">
            <?php echo $categoria['nombre'] ?>
        </option>
        <?php
            }
        ?>
    </select>
    <br><br>
    <label>Precio</label>
    <input type="text" name="precio" id="precio" />
    <br><br>
    <label>Estado</label>
    <input type="radio" name="estado" id="estadoD" />Disponible
    <input type="radio" name="estado" id="estadoND" />No Disponible
    <br><br>
    <button type="submit" name="registrar" id="registrar">Registrar</button>
    </form>
    <?php
require_once('layoutInferior.php');
?>