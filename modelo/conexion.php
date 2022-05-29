<?php
//Conexión a usar en el proyecto es: PDO
//Libreria de php para conexión orientada a objetos
class Conexion{
    private static $conexion = NULL;
    private $host = '127.0.0.1'; //Servidor de base de datos
    private $baseDatos = 'crud_george'; //Base de datos
    private $usuario = 'root'; //Usuario de base de datos
    private $contrasena = ''; //Contraseña

    //mysqli: Conexiones exclusivas a mysql soporta POO
    //mysql: Conexiones exclusivas a mysql no soporta POO

    private function __construct(){}

    public static function conectar(){
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$conexion = new PDO('mysql:host=localhost;dbname=crud_george','root','',$pdo_options);
        return self::$conexion;
    }

    static function desconectar(&$conexion){
        $conexion = null;
    }   
}
$baseDatos = Conexion::conectar(); 

?>