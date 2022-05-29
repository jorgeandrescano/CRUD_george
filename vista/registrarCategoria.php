<?php
require_once('layoutSuperior.php');
?>
<h3>-- Registrar Categoría --</h3>
<form action="../controlador/controladorCategoria.php" method="POST">
    <label>Nombre</label>
    <input type="text" name="nombre" id="nombre" required />
    <br><br>
    <button type="submit" name="registrar">Registrar</button>
</form>
<?php
require_once('layoutInferior.php');
?>