<?php
	// Importamos la clase PHPExcel
	App::import('Vendor', 'Classes/PHPExcel');

	$objPHPExcel = new PHPExcel();
	 
	$objPHPExcel->getProperties()->setCreator("Sistema de Bolsa Universitaria de Trabajo UNAM")
								 ->setLastModifiedBy("SISBUT UNAM")
								 ->setTitle("Empresas-Instituciones")
								 ->setSubject("Empresas-Instituciones")
								 ->setDescription("Ejemplo de integracion cakephp 2.x y phpExcel.")
								 ->setKeywords("Empresas-Instituciones")
								 ->setCategory("Empresas-Instituciones");
	
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
		// $tipoDescarga = 'Todas las ofertas';
	// endif;
	
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Descarga de empresas / Búsqueda específica');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleBorderArray);
	
	//Se ponen los valores N/A a rango de celdas
		for($i = 0; $i <= 36; $i++){
			 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 3, 'N/A');
		}
		$objPHPExcel->getActiveSheet()->getStyle('A3:Ak3')->applyFromArray($styleTextArray2);
		$objPHPExcel->getActiveSheet()->getStyle('A3:Ak3')->applyFromArray($styleBorderArray2);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		
	//Se agregan los titulos de las celdas
		
	
		$objPHPExcel->getActiveSheet()->getStyle('A4:Ak4')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A4:Ak4')->applyFromArray($styleBorderArray);
	
		$arrayHeader = array('Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Datos institucionales','Domiclio fiscal','Domiclio fiscal','Domiclio fiscal','Domiclio fiscal','Domiclio fiscal','Domicilio sede','Domicilio sede','Domicilio sede','Domicilio sede','Domicilio sede','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Acceso','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación','Lineamientos de publicación',);	
		
		$arrayDescription = array('RFC','Razón social','Nombre comercial','Tipo','Sector','Giro','Núemro de empleados','Sitio web','Descripción emrpesa','Calle y núemro','Entidad federativa / Estado','Delegación / Municipio','Población / Colonia','Código postal','Calle y núemro','Entidad federativa / Estado','Delegación / Municipio','Población / Colonia','Código postal','Nombre','Apellido materno','Apellido paterno','Cargo','Horario de atención','Correo institucional','Teléfono de contacto','Extensión','Teléfono celular','Usuario','Fecha de activación','Fecha de vencimiento','Ofertas a publicar','Ofertas publicadas','Currículums a extraer','Currículums extraidos','Status','Observaciones');

		$index = 0;
		for($i = 'A'; $i <='Z'; $i++){
			
			
			if($i == 'AL'):
				break;
			endif;
			
			//Se asignan los encabezados
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.'4',$arrayHeader[$index]);
			$objPHPExcel->getActiveSheet()->getStyle($i.'4')->getFont()->setSize(12);
			$objPHPExcel->getActiveSheet()->getStyle($i.'4')->getFont()->setBold(true);
			
			//Se asigna la descripción de los encabezados
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($i.'5',$arrayDescription[$index]);
			$objPHPExcel->getActiveSheet()->getStyle($i.'5')->getFont()->setSize(11);
			$objPHPExcel->getActiveSheet()->getStyle($i.'5')->getFont()->setBold(true);
			
			// Se ajustan las columnas al tamaño
			$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			// Se incrementa la columna
			$index++;
		}

	$i = 6;
	foreach ($empresas as $dato){

	//Datos institucionales
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i,$dato['CompanyProfile']['rfc']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i,$dato['CompanyProfile']['social_reason']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i,$dato['CompanyProfile']['company_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i,$tipoEmpresas[$dato['CompanyProfile']['company_type']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i,$Sectores[$dato['CompanyProfile']['sector']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i,$Giros[$dato['CompanyProfile']['company_rotation']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i,$numeroEmpleados[$dato['CompanyProfile']['employees_number']]);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i,$dato['CompanyProfile']['web_site']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i,$dato['CompanyProfile']['company_description']);

	//Domicilio fiscal
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i,$dato['CompanyProfile']['street']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i,$dato['CompanyProfile']['state']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i,$dato['CompanyProfile']['city']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,$dato['CompanyProfile']['subdivision']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i,$dato['CompanyProfile']['zip']);

	//Domicilio sede
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i,$dato['CompanyProfile']['street_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i,$dato['CompanyProfile']['state_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i,$dato['CompanyProfile']['city_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i,$dato['CompanyProfile']['subdivision_sede']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i,$dato['CompanyProfile']['zip_sede']);
	
	//Datos de contacto
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$i,$dato['CompanyContact']['name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$i,$dato['CompanyContact']['last_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$i,$dato['CompanyContact']['second_last_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$i,$dato['CompanyContact']['job_title']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$i,$dato['CompanyContact']['schedule_atention']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$i,$dato['Company']['email']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$i,$dato['CompanyContact']['telephone_number']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$i,$dato['CompanyContact']['phone_extension']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$i,$dato['CompanyContact']['cell_phone']);

	//Usuario
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$i,$dato['Company']['username']);
	
	//Lineamientos de publicación
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.$i,$dato['Company']['created']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE'.$i,$dato['CompanyOfferOption']['end_date_company']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.$i,$dato['CompanyOfferOption']['max_offer_publication']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG'.$i,count($dato['CompanyJobProfile']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH'.$i,$dato['CompanyOfferOption']['max_cv_download']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.$i,count($dato['CompanyDownloadedStudent']));
		if($dato['Company']['status'] == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.$i,'Acceso');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK'.$i,'Bloqueado');
		endif;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK'.$i,$dato['CompanyOfferOption']['comment']);
	

	$i++;
	}
	
		
	
	// echo '<pre>';
	// print_r($empresas);
	// echo '</pre>';
	// exit;
	
	$objPHPExcel->getActiveSheet()->setTitle('Empresas-Instituciones');
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Empresas-Instituciones.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>