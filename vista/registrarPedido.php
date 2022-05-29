<?php
require_once('../controlador/controladorProducto.php');
require_once('../controlador/controladorCliente.php');
$controladorProducto = new controladorProducto();
$listarProducto = $controladorProducto->listarProducto();
$listarCliente = $controladorCliente->listarCliente();
?>
<?php 
require_once('layoutSuperior.php');
?>
    <form action="" method="POST">
        <label>Id Pedido</label>
        <input readonly type="text" id="idPedido" name="idPedido" />
        <br><br>
        <label>Cliente</label>
        <select name="idCliente" id="idCliente" > 
        <option value="">Seleccione...</option>
        <?php
            foreach($listarCliente as $cliente){
                echo "<option value='$cliente[idCliente]'>
                $cliente[razonSocial]
                </option>";
            }
        ?>
        </select>
        <br><br>
        <label>Producto:</label>
        <select name="idProducto" id="idProducto" onchange="buscarPrecio(this.value)">
        <?php
            foreach($listarProducto as $producto){
        ?>
            <option value="<?php echo $producto['idProducto'] ?>">
                <?php echo $producto['nombre'] ?>
            </option>
        <?php
            }
        ?>
        </select>
        <br><br>
        <label>Precio</label>
        <input type="text" id="precio" name="precio" onkeypress="calcularSubtotal()" onkeydown="calcularSubtotal()" onkeyup="calcularSubtotal()" onblur="calcularSubtotal()" />
        <br><br>
        <label>Cantidad</label>
        <input type="text" id="cantidad" name="cantidad" onkeypress="calcularSubtotal()" onkeydown="calcularSubtotal()" onkeyup="calcularSubtotal()" onblur="calcularSubtotal()" />
        <br><br>
        <label>SubTotal:</label>
        <input readonly type="text" id="subtotal" name="subtotal" />
        <br><br>
        <input type="hidden" name="accion" value="registrar" />
        <button type="button" onclick="registrar()">Agregar</button>
    </form>
    <br>
    <div id="mensajeDetalle">

    </div>

    <script>
        function calcularSubtotal(){
            let precio = document.getElementById('precio').value;
            let cantidad = document.getElementById('cantidad').value;
            document.getElementById('subtotal').value = precio * cantidad;
        }

         async function registrar() {

            let formData = new FormData();
            formData.append("idPedido", document.getElementById('idPedido').value);
            formData.append("idCliente", document.getElementById('idCliente').value);
            formData.append("idProducto", document.getElementById('idProducto').value);
            formData.append("cantidad", document.getElementById('cantidad').value);
            formData.append("precio", document.getElementById('precio').value);
            formData.append("accion", 'registrar');
            //formData.append("image", imageBlob, "image.png");

            let response = await fetch('../controlador/controladorPedido.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.text();
            document.getElementById('idPedido').value = result;
            listarDetallePedido();
            alert(result);
        }

        async function buscarPrecio(idProducto) {
            let formData = new FormData();
            formData.append("idProducto", idProducto);
            formData.append("buscarPrecio", 'buscarPrecio');
            let response = await fetch('../controlador/controladorProducto.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.text();

            document.getElementById('precio').value = result;
        }

        async function listarDetallePedido() {
            let formData = new FormData();
            formData.append("idPedido", document.getElementById('idPedido').value);
            formData.append("accion", 'listarDetalle');
            let response = await fetch('../controlador/controladorPedido.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.text();
            document.getElementById('mensajeDetalle').innerHTML = result;
        }
    </script>
<?php 
require_once('layoutInferior.php');
?>