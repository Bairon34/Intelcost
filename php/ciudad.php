<?php
/*SERVICIO PARA CONSULTAR CIUDADES REGISTRADAS EN LA BASE DE DATOS*/
    require_once 'conexion.php';

    $sql = "SELECT * FROM CITY";
    $resultado = $conexion->query($sql);

    echo '<option value="" selected disabled="">Elige una ciudad</option>';     


    while($fila = $resultado->fetch_assoc()) {
        echo '<option value="'.$fila['name_city'].'">'.$fila['name_city'].'</option>';   
     }
           
?>