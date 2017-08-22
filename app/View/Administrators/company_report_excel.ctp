<?php
	// Importamos la clase PHPExcel
	App::import('Vendor', 'Classes/PHPExcel');

	$objPHPExcel = new PHPExcel();
	 
	$objPHPExcel->getProperties()->setCreator("Sistema de Bolsa Universitaria de Trabajo UNAM")
								 ->setLastModifiedBy("Sistema de Bolsa Universitaria de Trabajo UNAM")
								 ->setTitle("Reporte - Empresas")
								 ->setSubject("Reporte - Empresas")
								 ->setDescription("Reporte - Empresas")
								 ->setKeywords("Reporte - Empresas")
								 ->setCategory("Reporte - Empresas");
	
	/*----Estilos-----*/
	$styleBorderArray = array(
			'borders' => array(
				'bottom' => array(
					'style' => PHPExcel_Style_Border::BORDER_THICK,
					'color' => array('rgb' => '000000'),
				),
			),
		);
		
	$styleBorderArray2 = array(
			'borders' => array(
				'bottom' => array(
					'style' => PHPExcel_Style_Border::BORDER_THICK,
					'color' => array('rgb' => 'C1C1C1'),
				),
			),
		);

	$styleTextArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => '000000'),
				'size'  => 14,
				'name'  => 'Calibri'
			));
			
	$styleTextArray2 = array(
			'font'  => array(
				'bold'  => true,
				'size'  => 12,
				'color' => array('rgb' => 'C1C1C1'),
			));		
			
	/*----/Estilos-----*/
		
	// Cargamos los titulos de la hoja
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','Sistema de Bolsa Universitaria de Trabajo UNAM');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
	//Se combinan las celdas
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:C2');

	// if(!isset($tipoDescarga)):
	// 	$tipoDescarga = 'Todas las ofertas';
	// endif;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Descarga de empresas / "Status" ');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleBorderArray);
	
	//Se ponen los valores N/A a rango de celdas
		// for($i = 0; $i <= 36; $i++){
		// 	 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 3, 'N/A');
		// }
		//$objPHPExcel->getActiveSheet()->getStyle('A3:Ak3')->applyFromArray($styleTextArray2);
		//$objPHPExcel->getActiveSheet()->getStyle('A3:Ak3')->applyFromArray($styleBorderArray2);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		
	//Se agregan los titulos de las celdas
		
	
		//$objPHPExcel->getActiveSheet()->getStyle('A4:Ak4')->applyFromArray($styleTextArray);
		//$objPHPExcel->getActiveSheet()->getStyle('A4:Ak4')->applyFromArray($styleBorderArray);
	
		$arrayHeader = array('Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Domiclio fiscal','Domiclio fiscal','Domiclio fiscal','Domiclio fiscal','Domiclio fiscal','Domicilio sede','Domicilio sede','Domicilio sede','Domicilio sede','Domicilio sede','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Acceso','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación',);	
		
		$arrayDescription = array('RFC','Razón social','Nombre comercial','Tipo','Sector','Giro','Núemro de empleados','Sitio web','Descripción emrpesa','Calle y núemro','Entidad federativa / Estado','Delegación / Municipio','Población / Colonia','Código postal','Calle y núemro','Entidad federativa / Estado','Delegación / Municipio','Población / Colonia','Código postal','Nombre','Apellido materno','Apellido paterno','Cargo','Horario de atención','Correo institucional','Teléfono de contacto','Extensión','Teléfono celular','Usuario','Fecha de activación','Fecha de vencimiento','Ofertas a publicar','Ofertas publicadas','Currículums a extraer','Currículums extraidos','Status','Observaciones');

		//Datos institucionales
		$accesa = 0;
		foreach ($columnas as $c):
			if($c == 0):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=0; $i<=8; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		//Domicilio fiscal
		$accesa = 0;
		foreach ($columnas as $c):
			if($c == 1):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=9; $i<=13; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		//Domicilio sede
		$accesa = 0;
		foreach ($columnas as $c):
			if($c == 2):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=14; $i<=18; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		//Datos de contacto
		$accesa = 0;
		foreach ($columnas as $c):
			if($c == 3):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=19; $i<=27; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		//Accesos
		$accesa = 0;
		foreach ($columnas as $c):
			if($c == 4):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
				$arrayHeader2[] = $arrayHeader[28];
				$arrayDescription2[] = $arrayDescription[28];
		endif;

		//Lineamientos de publicacion
		$accesa = 0;
		foreach ($columnas as $c):
			if($c == 5):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
				for($i=29; $i<=36; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;


		
		$index = 0;
		$columna = 'A';
		for($i = 0; $i < count($arrayHeader2); $i++){
			
			//Se asignan los encabezados
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.'4',$arrayHeader2[$index]);
			$objPHPExcel->getActiveSheet()->getStyle($columna.'4')->getFont()->setSize(12);
			$objPHPExcel->getActiveSheet()->getStyle($columna.'4')->getFont()->setBold(true);
			
			//Se asigna la descripción de los encabezados
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.'5',$arrayDescription2[$index]);
			$objPHPExcel->getActiveSheet()->getStyle($columna.'5')->getFont()->setSize(11);
			$objPHPExcel->getActiveSheet()->getStyle($columna.'5')->getFont()->setBold(true);
			
			// Se ajustan las columnas al tamaño
			$objPHPExcel->getActiveSheet()->getColumnDimension($columna)->setAutoSize(true);
			// Se incrementa la columna
			$index++;
			$columna++;
		}

	$i = 6;
	foreach ($datos as $dato){

	//Datos institucionales
	$accesa = 0;
	foreach ($columnas as $c):
		if($c == 0):
			$accesa = 1;
			break;
		endif;
	endforeach;

	
	$indiceColumna = 'A';
	if($accesa == 1):
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['rfc']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['social_reason']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['company_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$tipoEmpresas[$dato['CompanyProfile']['company_type']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$Sectores[$dato['CompanyProfile']['sector']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$Giros[$dato['CompanyProfile']['company_rotation']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$numeroEmpleados[$dato['CompanyProfile']['employees_number']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['web_site']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['company_description']);
	endif;

	//Domicilio fiscal
	$accesa = 0;
	foreach ($columnas as $c):
		if($c == 1):
			$accesa = 1;
			break;
		endif;
	endforeach;
	if($accesa == 1):	
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['street']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['state']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['city']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['subdivision']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['zip']);
	endif;

	//Domicilio sede
	$accesa = 0;
	foreach ($columnas as $c):
		if($c == 2):
			$accesa = 1;
			break;
		endif;
	endforeach;
	if($accesa == 1):
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['street_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['state_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['city_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['subdivision_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyProfile']['zip_sede']);
	endif;
	
	//Datos de contacto
	$accesa = 0;
	foreach ($columnas as $c):
		if($c == 3):
			$accesa = 1;
			break;
		endif;
	endforeach;
	if($accesa == 1):
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['last_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['second_last_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['job_title']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['schedule_atention']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['email']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['telephone_number']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['phone_extension']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyContact']['cell_phone']);
	endif;

	//Usuario
	$accesa = 0;
	foreach ($columnas as $c):
		if($c == 4):
			$accesa = 1;
			break;
		endif;
	endforeach;
	if($accesa == 1):
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['username']);
	endif;
	
	//Lineamientos de publicación
	$accesa = 0;
	foreach ($columnas as $c):
		if($c == 5):
			$accesa = 1;
			break;
		endif;
	endforeach;
	if($accesa == 1):
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['created']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyOfferOption']['end_date_company']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyOfferOption']['max_offer_publication']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['CompanyJobProfile']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyOfferOption']['max_cv_download']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['CompanyDownloadedStudent']));
		if($dato['Company']['status'] == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Con acceso');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Bloqueado');
		endif;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyOfferOption']['comment']);
	endif;
	

	$i++;
	}
	
	$objPHPExcel->getActiveSheet()->setTitle('Reporte - Empresas');
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Reporte - Empresas.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>