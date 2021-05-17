<?php

/*SERVICIO PARA GUARDAR BIEN*/
    require_once 'conexion.php';

    $id=$_POST['id'];

    $sql = "UPDATE datos_generales SET Guardado=1 WHERE Id=$id;";
    $resultado = $conexion->query($sql);


    if($resultado){
        $respuesta = array(       
            0 => 'guardado',
         );
    }else{
        $respuesta = array(       
            0 => 'noguardado',
         );
    }
    echo json_encode($respuesta );
    

?>