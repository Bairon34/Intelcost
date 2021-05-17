/*FUNCION PARA LA CARGA DE OPCIONES EN EL CAMPO SELECT CIUDAD */
function llenarCiudad (){

    $.ajax({

        type: 'GET',
        url: './php/ciudad.php',
        success: function (valores) {

            if (valores) {
                $("#selectCiudad").html(valores);

            } else {
                $("#selectCiudad").hide();
            }
        }

    });
}

/*FUNCION PARA LA CARGA DE OPCIONES EN EL CAMPO SELECT TIPO */

function llenarTipo (){

    $.ajax({

        type: 'GET',
        url: './php/tipo.php',
        success: function (valores) {

            if (valores) {
                $("#selectTipo").html(valores);

            } else {
                $("#selectTipo").hide();
            }
        }

    });
}

/*FUNCION PARA LA CARGA DE OPCIONES  Y DATOS EN EL CAMPO SELECT CIUDAD, TIPO  Y BIENES DISPONIBLES */
function cargar(){

    llenarCiudad();
    llenarTipo();
    cargarDatosGenerales();

}


/*FUNCION PARA LA CARGA DE OPCIONES DE DATOS EN EL BOTON BUSCAR */

function buscar(){

    var selectCiudad = document.getElementById("selectCiudad").value;
    var selectTipo = document.getElementById("selectTipo").value;
    var rangoPrecio = document.getElementById("rangoPrecio").value;



    if(selectCiudad !="" && selectTipo!=""){

            var rangos = rangoPrecio.split(";");
            var datos = { 'ciudad': selectCiudad,'tipo':selectTipo,'rangomenor':rangos[0],'rangomayor':rangos[1]};


            $.ajax({

                type: 'POST',
                url: './php/Buscar.php',
                data: datos,
                success: function (valores) {
        
                    if (valores) {
                        $("#datosGenerales").html(valores);
        
                    } else {
                        $("#datosGenerales").hide();
                    }
                }
        
            });


    }else{
        alert("Debe seleccionar ciudad y tipo")
    }

    


}

/*FUNCION PARA LA CARGA DE DATOS DESDE EL ARCHIVO JSON */
function subirDatos(){
    $.ajax({

        type: 'GET',
        url: './php/subir.php',
        success: function (valores) {

            if (valores) {
                $("#selectTipo").html(valores);

            } else {
                $("#selectTipo").hide();
            }
        }

    });

}


/*FUNCION PARA LA CARGA DE DATOS EN TABLA BIENES DISPONIBLES */
function cargarDatosGenerales(){
    $.ajax({

        type: 'GET',
        url: './php/datosgenerales.php',
        success: function (valores) {

            if (valores) {
                $("#datosGenerales").html(valores);

            } else {
                $("#datosGenerales").hide();
            }
        }

    });

}


/*FUNCION PARA GUARDAR Y CONSLTA DE BIENES */
function guardar(id_guardar){

    var bool=confirm("Desea guardar este Bien?");
    if(bool){
    
        var datos = { 'id': id_guardar};
        $.ajax({

            type: 'POST',
            url: './php/guardarBien.php',
            data: datos,
            success: function (valores) {
    
                if (datos[0] != "noguardado") {
                    
                        cargarDatosGenerales()
                        alert("Datos guardados con exito");

                } else {
                    alert("Datos no guardados");
                }
            }
    
        });
    }

    
}




/*FUNCION PARA LA CARGA DE OPCIONES EN MIS BIENES */
function misBienes(){
    $.ajax({

        type: 'GET',
        url: './php/misbienes.php',
        success: function (valores) {

            if (valores) {
                $("#misBienes").html(valores);

            } else {
                $("#misBienes").hide();
            }
        }

    });
}

/*FUNCION PARA ELIMINAR Y CONSTAR EN EL CAMPO MIS BIENES */

function eliminarBienes(id_eliminar){

    var bool=confirm("Desea eliminar este Bien?");
    if(bool){
    
        var datos = { 'id': id_eliminar};
        $.ajax({

            type: 'POST',
            url: './php/eliminarBien.php',
            data: datos,
            success: function (valores) {
    
                if (datos[0] != "noguardado") {
                    
                        misBienes()
                        alert("Dato eliminado  con exito");

                } else {
                    alert("Datos no guardados");
                }
            }
    
        });
    }

    
}


/*FUNCION PARA LA CARGA DE OPCIONES EN EL CAMPO SELECT CIUDAD PARA REPORTE XLSX */
function cargarSelect(){
    llenarCiudadReporte();
    llenarTipoReporte();
}

function llenarCiudadReporte (){

    $.ajax({

        type: 'GET',
        url: './php/ciudad.php',
        success: function (valores) {

            if (valores) {
                $("#selectCiudade").html(valores);

            } else {
                $("#selectCiudade").hide();
            }
        }

    });
}


/*FUNCION PARA LA CARGA DE OPCIONES EN EL CAMPO SELECT TIPO PARA REPORTE XLSX */
function llenarTipoReporte (){

    $.ajax({

        type: 'GET',
        url: './php/tipo.php',
        success: function (valores) {

            if (valores) {
                $("#selectTipoe").html(valores);

            } else {
                $("#selectTipoe").hide();
            }
        }

    });
}
/*FUNCION PARA LA CARGA DE OPCIONES EN EL CAMPO SELECT CIUDAD PARA REPORTE XLSX */

function generarReporte(){

    var selectCiudad = document.getElementById("selectCiudade").value;
    var selectTipo = document.getElementById("selectTipoe").value;


    
    if(selectCiudad !="" && selectTipo!=""){

        window.location.href = './php/generarReporte.php?ciudad='+selectCiudad+'&tiposelect='+selectTipo;

    }else{

        alert("Debe seleccionar ciudad y tipo")
    }

 
    
}



