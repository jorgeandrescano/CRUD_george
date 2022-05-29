<?php
require_once('../controlador/controladorProducto.php');
$controladorProducto = new controladorProducto();
$listarProducto = $controladorProducto->listarProducto();
//var_dump($listarProducto);
?>
<?php
require_once('layoutSuperior.php');
?>

<link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
<a href="../controlador/controladorProducto.php?vista=registrarProducto.php">Registrar</a>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listarProducto as $producto) {
            echo "<tr>";
            echo "<td>" . $producto['idProducto'] . "</td>";
            echo "<td>" . $producto['nombre'] . "</td>";
            echo "<td>" . $producto['idCategoria'] . "</td>";
            echo "<td>" . $producto['precio'] . "</td>";
            echo "<td>" . $producto['estado'] . "</td>";
            echo "<td>
                <form method='POST' action='../controlador/controladorProducto.php'>
                <input type='hidden' name='idProducto' value=" . $producto['idProducto'] . " />
                <button type='submit' name='editar'>Editar</button>
                </form>
                <a href='#' onclick='validarEliminacion($producto[idProducto])'>Eliminar</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <th>Id</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Precio</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tfoot>
</table>
<script>
    function validarEliminacion(idProducto) {
        let eliminar = " ";
        if (confirm('¿Está seguro de eliminar el producto?')) {
            document.location.href = "../controlador/controladorProducto.php?idProducto=" + idProducto + "&eliminar";
        }
    }
</script>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>
<?php
require_once('layoutInferior.php');
?>