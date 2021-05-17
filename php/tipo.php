<?php
/*SERVICIO PARA LA CONSULTA DE DATOS DESDE LA TABLA TYPE */
    require_once 'conexion.php';

    $sql = "SELECT * FROM type";
    $resultado = $conexion->query($sql);
    echo '<option value="" selected disabled>Elige un Tipo</option>';     
    while($fila = $resultado->fetch_assoc()) {
        echo '<option value="'.$fila['name_type'].'">'.$fila['name_type'].'</option>';   
     }
           
?>