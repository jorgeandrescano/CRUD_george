<?php
require_once('conexion.php');
class crudCategoria{

    public function __construct(){
        
    }

    public function listarCategoria(){
        //Establecer al conexión a la base de datos
        $baseDatos = Conexion::conectar();
        //Definir la sentencia sql
        //sql: Struct Query Language Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM categoria ORDER BY idCategoria ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos); //Cierra la conexión
        return($sql->fetchAll()); //Retornar todos los registros
    }

    public function registrarCategoria($categoria){
        $mensaje = "";
        //Establecer la conexion a base de datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO
        categoria(idCategoria, nombre)
        VALUES(:idCategoria, :nombre) ');
        $sql->bindValue('idCategoria', '');
        $sql->bindValue('nombre', $categoria->getnombre());

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

    public function buscarCategoria($Categoria){
        //Establecer al conexión a la base de datos
        $baseDatos = Conexion::conectar();
        //Definir la sentencia sql
        //sql: Struct Query Language Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM categoria
                WHERE idCategoria=".$Categoria->getidCategoria());
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos); //Cierra la conexión
        return $sql->fetch();
        //return($sql->fetchAll()); //Retornar todos los registros
    }
    
    public function actualizarCategoria($categoria){
        $mensaje = "";
        //Establecer la conexion a base de datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE categoria
        SET nombre =:nombre
        WHERE idCategoria=:idCategoria');
        $sql->bindValue('idCategoria', $categoria->getidCategoria());
        $sql->bindValue('nombre', $categoria->getnombre());

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

    public function eliminarCategoria($categoria){
        $mensaje = "";
        //Establecer la conexion a base de datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM categoria
        WHERE idCategoria=:idCategoria');
        $sql->bindValue('idCategoria', $categoria->getidCategoria());

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