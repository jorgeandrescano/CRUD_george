<?php
require_once('conexion.php');
class crudProducto{

    public function __construct(){
    
    }

    public function listarProducto(){
        //Establecer al conexión a la base de datos
        $baseDatos = Conexion::conectar();
        //Definir la sentencia sql
        //sql: Struct Query Language Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM producto ORDER BY idProducto ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos); //Cierra la conexión
        return($sql->fetchAll()); //Retornar todos los registros
    }

    public function registrarProducto($producto){
        $mensaje = "";
        //Establecer la conexion a base de datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO
        producto(idProducto, idCategoria, nombre, precio, estado)
        VALUES(:idProducto, :idCategoria, :nombre, :precio, :estado)');
        $sql->bindValue('idProducto', '');
        $sql->bindValue('idCategoria', $producto->getidCategoria());
        $sql->bindValue('nombre', $producto->getnombre());
        $sql->bindValue('precio', $producto->getprecio());
        $sql->bindValue('estado', $producto->getestado());
        

        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje = "Registro exitoso";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage();//Obtener el mensaje de
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión
        return $mensaje;
    }

    public function buscarProducto($producto){
        //Establecer al conexión a la base de datos
        $baseDatos = Conexion::conectar();
        //Definir la sentencia sql
        //sql: Struct Query Language Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM producto
                WHERE idProducto=".$producto->getidProducto());
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos); //Cierra la conexión
        return $sql->fetch();
        //return($sql->fetchAll()); //Retornar todos los registros
    }
    
    public function actualizarProducto($producto){
        $mensaje = "";
        //Establecer la conexion a base de datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE producto
        SET 
        idCategoria = :idCategoria,
        nombre = :nombre,
        precio = :precio,
        estado = :estado
        WHERE idProducto=:idProducto');
        $sql->bindValue('idProducto', $producto->getidProducto());
        $sql->bindValue('idCategoria', $producto->getidCategoria());
        $sql->bindValue('nombre', $producto->getnombre());
        $sql->bindValue('precio', $producto->getprecio());
        $sql->bindValue('estado', $producto->getestado());
        

        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje = "Actualización exitosa";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage();//Obtener el mensaje de
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión
        return $mensaje;
    }

    public function eliminarProducto($producto){
        $mensaje = "";
        //Establecer la conexion a base de datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM producto
        WHERE idProducto=:idProducto');
        $sql->bindValue('idProducto', $producto->getidProducto());

        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje = "Eliminación exitosa";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage();//Obtener el mensaje de
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión
        return $mensaje;
    }
}

//$prueba = new crudCategoria();
//var_dump($prueba->listarCategoria());
?>