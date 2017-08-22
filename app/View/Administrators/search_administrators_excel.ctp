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
		// $tipoDescarga = 'Todas los administradores';
	// endif;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Administración del Sistema');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleBorderArray);
	
	//Se ponen los valores N/A a rango de celdas
		for($i = 0; $i <= 18; $i++){
			 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 3, 'N/A');
		}
		$objPHPExcel->getActiveSheet()->getStyle('A3:S3')->applyFromArray($styleTextArray2);
		$objPHPExcel->getActiveSheet()->getStyle('A3:S3')->applyFromArray($styleBorderArray2);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		
	//Se agregan los titulos de las celdas
		
	
		$objPHPExcel->getActiveSheet()->getStyle('A4:S4')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A4:S4')->applyFromArray($styleBorderArray);
	
		$arrayHeader = array('Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto','Datos de contacto',);	
		
		$arrayDescription = array('Escuela / Facultad','Apellido paterno','Apellido materno','Cargo','Usuario','Teléfono de contacto','Extensión','Teléfono celular','Correo institucional','Permiso Administrador ABC','Permiso Gestión Escuelas / Facultades','Permiso Universitarios','Permiso Empresas / Instituciones','Permiso Ofertas','Permiso Correos Masivos','Permiso Informes','Permiso Notificaciones ','Inicio vigencia de acceso','Fin vigencia de acceso');

		$index = 0;
		for($i = 'A'; $i <='S'; $i++){
			
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
	foreach ($administradores as $dato){

		//Escuelas o facultades
		if($dato['AdministratorProfile']['institution'] <> ''):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i,$EscuelasFacultades[$dato['AdministratorProfile']['institution']]);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i,'Sin especificar');	
		endif;

		//Nombre
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i,$dato['AdministratorProfile']['contact_last_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i,$dato['AdministratorProfile']['contact_second_last_name']);

		//Cargo y usuario
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i,$dato['AdministratorProfile']['contact_position']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i,$dato['Administrator']['username']);

		//Telefono celular, fijo y correo institucional
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i,$dato['AdministratorProfile']['telephone']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i,$dato['AdministratorProfile']['phone_extension']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i,$dato['AdministratorProfile']['cell_phone']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i,$dato['Administrator']['email']);

		//Permisos
		$permisos = explode(",", $dato['AdministratorProfile']['access']);

		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 1):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i,'No');
		endif;

		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 2):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i,'No');
		endif;

		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 3):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i,'No');
		endif;

		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 4):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'No');
		endif;

		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 5):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i,'No');
		endif;
		
		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 6):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i,'No');
		endif;

		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 7):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i,'No');
		endif;

		$accesa = 0;
		foreach ($permisos as $c):
			if($c == 8):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i,'Si');
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i,'No');
		endif;

		if($dato['AdministratorProfile']['start_date_expiration'] <> '0000-00-00'):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i,$dato['AdministratorProfile']['start_date_expiration']);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i,'Ilimitado');
		endif;

		if($dato['AdministratorProfile']['start_date_expiration'] <> '0000-00-00'):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i,$dato['AdministratorProfile']['end_date_expiration']);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i,'Ilimitado');
		endif;

	$i++;
	}
	
		
	
	// echo '<pre>';
	// print_r($administradores);
	// exit;
	
	$objPHPExcel->getActiveSheet()->setTitle('Administradores ABC');
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Administradores ABC.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>