<?php


class conexionBD
{
    private static $pdo = null;

    static public function conexionPDO()
    {
        if (self::$pdo === null) {
            $host = 'tecnopvsertec.mysql.db';
            $usuario = 'tecnopvsertec';
            $clave = 'Tecno18091975';
            $dbname = 'tecnopvsertec';
            try {
                self::$pdo = new PDO("mysql:host=$host; dbname=$dbname", $usuario, $clave);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // self::$pdo->exec("set names utf8");
                // 🔹 Charset
                self::$pdo->exec("SET NAMES utf8");

                // 🔹 Zona horaria para MySQL (Perú UTC-5)
                self::$pdo->exec("SET time_zone = '-05:00'");

                // 🔹 Zona horaria para PHP
                date_default_timezone_set("America/Lima");

            } catch (Exception $e) {
                throw new Exception("La base de datos reportó: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    static public function cerrar_conexion()
    {
        self::$pdo = null;
    }

    // public function set_names(){
    //     return $this->pdo->query("SET NAMES 'utf8'");
    // }

    static public function ruta()
    {
        return "https://gestion.tecnophone.shop";
    }

    static public function ruta_tienda()
    {
        return "http://localhost/sertec_multi/tienda";
    }
}




