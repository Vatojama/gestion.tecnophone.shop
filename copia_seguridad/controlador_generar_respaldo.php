<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

require_once '../../model/modelo_conexion.php';

try {
    $c = conexionBD::conexionPDO();
    $tables = array();
    $result = $c->query("SHOW TABLES");
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }

    $sql_dump = "-- SQL Dump tecnophone.shop\n";
    $sql_dump .= "-- Generado: " . date("Y-m-d H:i:s") . "\n\n";
    $sql_dump .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

    foreach ($tables as $table) {
        // Estructura
        $res = $c->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
        $sql_dump .= "\n\n-- Estructura de tabla para `$table` --\n\n";
        $sql_dump .= "DROP TABLE IF EXISTS `$table`;\n";
        $sql_dump .= $res['Create Table'] . ";\n\n";

        // Datos
        $res = $c->query("SELECT * FROM `$table` ");
        $num_fields = $res->columnCount();

        while ($row = $res->fetch(PDO::FETCH_NUM)) {
            $sql_dump .= "INSERT INTO `$table` VALUES(";
            for ($j = 0; $j < $num_fields; $j++) {
                if (isset($row[$j])) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n", "\\n", $row[$j]);
                    $sql_dump .= '"' . $row[$j] . '"';
                } else {
                    $sql_dump .= 'NULL';
                }
                if ($j < ($num_fields - 1)) {
                    $sql_dump .= ',';
                }
            }
            $sql_dump .= ");\n";
        }
    }

    $sql_dump .= "\nSET FOREIGN_KEY_CHECKS=1;";

    // Guardar en archivo temporal para descargar
    $filename = "respaldo_" . date("Ymd_His") . ".sql";

    // Devolvemos el contenido para descarga directa o guardado
    ob_clean();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    echo $sql_dump;
    exit;

} catch (Exception $e) {
    ob_clean();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>