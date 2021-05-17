<?php

  /*SERVICIO PARA LA CONSULTA DE BIENES GUARDADOS*/
    require_once 'conexion.php';


    $sql = "SELECT * FROM datos_generales WHERE Guardado=1;";
    $resultado = $conexion->query($sql);



    echo'<table>
  
        <tbody>';

        while($fila = $resultado->fetch_assoc()) {
        
    
        echo '<tr>
            <td>
            <img src="././img/home.jpg" width="190" height="120">
            </td>
            <td>
            
                <b>Dirección:</b>'.$fila['Direccion'].'<br/>
                <b>Ciudad:</b>'.$fila['Ciudad'].'<br/>
                <b>Teléfono:</b>'.$fila['Telefono'].'<br/>
                <b>Código Postal:</b>'.$fila['Codigo_Postal'].'<br/>
                <b>Tipo:</b>'.$fila['Tipo'].'<br/>
                <b>Precio:</b>'.$fila['Precio'].'<br/>
                <a class="waves-effect waves-light btn" href="javascript:eliminarBienes('.$fila['Id'].');">Eliminar</a>
            </td
          </tr>';
        }
        echo '</tbody>
      </table';

?>