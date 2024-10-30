<?php 

class Conexion{
    public static function Conexion() {
        $dsn = 'mysql:host=localhost;port=3306;dbname=bd_pruebalogro2024';
        $username = 'root';
        $password = '';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $conexion = new PDO($dsn, $username, $password, $options);
            return $conexion;
        } catch (PDOException $e) {
            die('Error inesperado en la conexión a base de datos: ' . $e->getMessage());
        }
    }    
}



?>