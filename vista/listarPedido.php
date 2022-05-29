<?php
require_once('../controlador/controladorPedido.php');
$listarPedido = listarPedido();//Llamado a función
?>
<?php
require_once('layoutSuperior.php')
?>

    <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
    <a href="../Controlador/controladorPedido.php?vista=registrarPedido.php">Registrar</a>
    <table  id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listarPedido as $pedido){
                    echo "<tr>";
                    echo "<td>".$pedido['idPedido']."</td>";
                    echo "<td>".$pedido['idCliente']."-".$pedido['nombreCliente']."</td>";
                    echo "<td>".$pedido['fecha']."</td>";
                    echo "<td>
                    <form method='POST' action='../Controlador/controladorPedido.php'>
                    <input type='hidden' name='idPedido' value=".$pedido['idPedido']." />
                    <button type='submit' name='editar'>Editar</button>
                    </form>
                    <a href='#' onclick='validarEliminacion($pedido[idPedido])' >Eliminar</a>
                    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
<script>
    function validarEliminacion(idPedido){
        let eliminar = "";
        if(confirm('¿Está seguro de eliminar el pedido?')){
            document.location.href = "../controlador/controladorPedido.php?idPedido="+idPedido+"&eliminar";
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