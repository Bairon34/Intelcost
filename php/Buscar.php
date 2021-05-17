<?php


/*SERVICIO PARA BUSCAR UN BIEN EN LA BASE DE DATOS*/
require_once 'conexion.php';


$ciudad=$_POST['ciudad'];
$tipo=$_POST['tipo'];
$rangoMenor=$_POST['rangomenor'];
$rangoMayor=$_POST['rangomayor'];


$sql = "SELECT * from datos_generales WHERE Ciudad='$ciudad' AND Tipo='$tipo'";
    $resultado = $conexion->query($sql);

    echo'<table>
        
        <tbody>';

        while($fila = $resultado->fetch_assoc()) {
            $precio = $fila['Precio'];
            $precio = str_replace ( '$', '', $precio );
            $precio = str_replace ( ",", '', $precio);
        

          if($precio>=$rangoMenor &&$precio<=$rangoMayor){
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
                <b>Precio:</b>'.$fila['Precio'].'<br/
                <a class="waves-effect waves-light btn" href="javascript:guardar('.$fila['Id'].');">Guardar</a>
            </td>
          </tr>';
         
          }
        echo '</tbody>
        </table'
      
      ;

    }

?>