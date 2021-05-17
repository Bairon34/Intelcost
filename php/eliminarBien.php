<?php
    /*SERVICIO PARA ELIMINAR UN BIEN DE LAS LISTA MIS BIENES*/
    require_once 'conexion.php';

    $id=$_POST['id'];

    $sql = "UPDATE datos_generales SET Guardado=0 WHERE Id=$id;";
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