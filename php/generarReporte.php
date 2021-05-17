<?php

/*SERVICIO PARA GENERAR REPORTE EN XLSX */
require_once 'conexion.php';

$ciudad=$_GET['ciudad'];
$tipo=$_GET['tiposelect'];



if (PHP_SAPI == 'cli')
	die('Este ejemplo sólo se puede ejecutar desde un navegador Web');

/** Incluye PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("Obed Alvarado")
							 ->setLastModifiedBy("Obed Alvarado")
							 ->setTitle("Office 2010 XLSX Documento de prueba")
							 ->setSubject("Office 2010 XLSX Documento de prueba")
							 ->setDescription("Documento de prueba para Office 2010 XLSX, generado usando clases de PHP.")
							 ->setKeywords("office 2010 openxml php")
							 ->setCategory("Archivo con resultado de prueba");



// Combino las celdas desde A1 hasta E1
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'REPORTE BIENES INTELCOST')
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'DIRECCION')
            ->setCellValue('C2', 'CIUDAD')
			->setCellValue('D2', 'TELEFONO')
			->setCellValue('E2', 'CODIGO POSTAL')
            ->setCellValue('F2', 'TIPO')
            ->setCellValue('G2', 'PRECIO');
			
// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($boldArray);		

	
			
//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);	
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);	
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);	
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);		
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);	
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);


   


	/*Extraer datos de MYSQL*/
	# conectare la base de datos



    $sql = "SELECT * FROM datos_generales WHERE Ciudad='$ciudad' AND Tipo='$tipo'";
    $resultado = $conexion->query($sql);


	$cel=3;//Numero de fila donde empezara a crear  el reporte
    while($fila = $resultado->fetch_assoc()) {
	
		$id=$fila['Id'];
		$direccion=$fila['Direccion'];
		$ciudad=$fila['Ciudad'];
		$telefono=$fila['Telefono'];
		$codigo_postal=$fila['Codigo_Postal'];
        $tipo=$fila['Tipo'];
        $precio=$fila['Precio'];
		
			$a="A".$cel;
			$b="B".$cel;
			$c="C".$cel;
			$d="D".$cel;
			$e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
			// Agregar datos
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($a, $id)
            ->setCellValue($b, $direccion)
            ->setCellValue($c, $ciudad)
            ->setCellValue($d, $telefono)
			->setCellValue($e, $codigo_postal)
            ->setCellValue($f, $tipo)
            ->setCellValue($g, $precio);
			$cel+=1;
	}

/*Fin extracion de datos MYSQL*/
$rango="A2:G2";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte de bienes');


// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);


// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportebienes.xlsx"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
header('Cache-Control: max-age=1');

// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;



?>