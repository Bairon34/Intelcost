<?php

/*SERVICIO PARA LA CARGA DE DATOS DESDE EL ARCHIVO JSON */
require_once 'conexion.php';

$tableName = 'datos_generales';

$jsonFile = '../data-1.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);

foreach ($jsonData as $id=>$row) {
    $insertPairs = array();
    foreach ($row as $key=>$val) {
        $insertPairs[addslashes($key)] = addslashes($val);
    }
    $insertKeys = '`' . implode('`,`', array_keys($insertPairs)) . '`';
    $insertVals = '"' . implode('","', array_values($insertPairs)) . '"';

    $sql = "INSERT INTO `{$tableName}` ({$insertKeys}) VALUES ({$insertVals});" . "\n";
    $resultado = $conexion->query($sql);
}


?>