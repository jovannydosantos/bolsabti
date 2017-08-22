<?php
	// Importamos la clase PHPExcel
	App::import('Vendor', 'Classes/PHPExcel');

	$objPHPExcel = new PHPExcel();
	 
	$objPHPExcel->getProperties()->setCreator("Postulaciones")
								 ->setLastModifiedBy("Postulaciones")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Ejemplo de integracion cakephp 2.x y phpExcel.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");
	
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','SISBUT UNAM');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
	//Se combinan las celdas
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:C2');
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Descarga de currículums / Postulados Oferta "'.$nombrePuesto.'"');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleBorderArray);
	
	//Se ponen los valores N/A a rango de celdas
		for($i = 0; $i <= 423; $i++){
			 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 3, 'N/A');
		}
		$objPHPExcel->getActiveSheet()->getStyle('A3:PH3')->applyFromArray($styleTextArray2);
		$objPHPExcel->getActiveSheet()->getStyle('A3:PH3')->applyFromArray($styleBorderArray2);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		
	//Se agregan los titulos de las celdas
		
	
		$objPHPExcel->getActiveSheet()->getStyle('A4:PH4')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A4:PH4')->applyFromArray($styleBorderArray);
	
		$arrayHeader = array('Información del currículum','Información del currículum','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Objetivo profesional','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Nivel académico','Nivel académico','Nivel académico','Nivel académico','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Empresa / Institución','Empresa / Institución 1','Empresa / Institución 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 2','Empresa / Institución 2','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 3','Empresa / Institución 3','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 4','Empresa / Institución 4','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 5','Empresa / Institución 5','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 6','Empresa / Institución 6','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 7','Empresa / Institución 7','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Idiomas','Computo','Conocimientos y habilidades profesionales','Idiomas','Idiomas','Idiomas','Idiomas','Idiomas','Idiomas','Idiomas','Computo','Computo','Computo','Computo','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales');	
		$arrayDescription = array('Folio','Número de cuenta','Encabezado de currículum','Nombre(s)','Apellido materno','Apellido paterno','Sexo','Fecha de nacimiento','Edad','País de nacimiento','Estado civil','Correo 1','Correo 2','Dirección','Estado','Delegación','Población / Colonia','Código Postal','Teléfono local','Teléfono celular','Tipo de discapacidad','Objetivo profesional','Competencia 1','Competencia 2','Competnecia 3','Competencia 4','Competencia 5','Competencia 6','Competencia 7','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Licenciatura','Especialidad','Mestría ','Doctorado','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Total','Total','Total','Idioma','Nivel de lectura','Nivel de escritura','Nivel de conversación','Certificación / Institución que lo acredita','Año de certificación','Puntaje','Categoría','Nombre / Otro','Nivel','Certificación','Categoría','Nombre','Empresa / Insitución','Duración','Año');
		
		$index = 0;
		for($i = 'A'; $i <='Z'; $i++){
			
			
			if($i == 'PI'):
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
		

		
	$i=6;
	foreach ($datos as $dato){
		
		$date2 = date('Y-m-d');
		$diff = abs(strtotime($date2) - strtotime($dato['StudentProfile']['date_of_birth']));
		$years = floor($diff / (365*60*60*24));

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $dato['Student']['id']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $dato['Student']['username']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $dato['StudentHeader']['header']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $dato['StudentProfile']['name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $dato['StudentProfile']['last_name']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $dato['StudentProfile']['second_last_name']);
		
		if($dato['StudentProfile']['disability_type'] <> ''):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $Sexo[$dato['StudentProfile']['sex']]);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, 'Sin especificar');
		endif;

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $dato['StudentProfile']['date_of_birth']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $years);

		if($dato['StudentProfile']['born_country'] <> ''):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, $Paises[$dato['StudentProfile']['born_country']]);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, 'Sin especificar');
		endif;

		if($dato['StudentProfile']['marital_status']):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $EstadoCivil[$dato['StudentProfile']['marital_status']]);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, 'Sin especificar');
		endif;

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i, $dato['Student']['email']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i, $dato['StudentProfile']['secondary_email']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i, $dato['StudentProfile']['street']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i, $dato['StudentProfile']['state']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i, $dato['StudentProfile']['city']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i, $dato['StudentProfile']['subdivision']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i, $dato['StudentProfile']['zip']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i, $dato['StudentProfile']['telephone_contact']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$i, $dato['StudentProfile']['cell_phone']);
		
		if($dato['StudentProfile']['disability_type'] <> ''):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$i, $TiposDiscapacidad[$dato['StudentProfile']['disability_type']]);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$i, 'Ninguna');
		endif;

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$i, $dato['StudentJobProspect']['professional_objective']);
		$columna = 'W';
		foreach($dato['StudentProfessionalSkill'] as $competencia):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$i, $Competencias[$competencia['competency_id']]);
			$columna++;
		endforeach;

		$columna = 'AD';
		foreach($dato['StudentInterestJob'] as $expectativa):
			if($expectativa['business_activity'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Giros[$expectativa['business_activity']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Sin especificar');
			endif;

			if($expectativa['interest_area_id'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $AreasExperiencia[$expectativa['interest_area_id']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Sin especificar');
			endif;

			if($dato['StudentProspect']['contract_type']):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $TiposContratos[$dato['StudentProspect']['contract_type']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
			endif;

			if($dato['StudentProspect']['workday'] <> ''): 
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $JornadasLaborales[$dato['StudentProspect']['workday']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Sin especificar');
			endif;

			if($dato['StudentProspect']['economic_pretension']):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Salarios[$dato['StudentProspect']['economic_pretension']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
			endif;

			if($dato['StudentProspect']['can_travel'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
			endif;
			if($dato['StudentProspect']['can_travel'] == 'n'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin disponibilidad');
			else:
				if($dato['StudentProspect']['can_travel_option'] == '1'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Dentro del país');
				else:
					if($dato['StudentProspect']['can_travel_option'] == '2'):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Fuera del país');
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
					endif;
				endif;
			endif;
			
			if($dato['StudentProspect']['change_residence'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
			endif;
			
			if($dato['StudentProspect']['change_residence'] == 'n'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin disponibilidad');
			else:
				if($dato['StudentProspect']['change_residence_option'] == '1'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Dentro del país');
				else:
					if($dato['StudentProspect']['change_residence_option'] == '2'):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Fuera del país');
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
					endif;
				endif;
			endif;
		endforeach;	
		
		// Formación Académica
		$columna = 'BN';
		$ban = 0;
		foreach($dato['StudentProfessionalProfile'] as $professionalProfile):
			if($ban == 0):
				if($professionalProfile['academic_level_id']==1):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
				endif;
				if($professionalProfile['academic_level_id']==2):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
				endif;
				if($professionalProfile['academic_level_id']==3):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
				endif;
				if($professionalProfile['academic_level_id']==4):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
				endif;
			endif;
			if($professionalProfile['academic_level_id']==1):
				if($professionalProfile['career_id'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $careers[$professionalProfile['career_id']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile['another_career']);
				endif;
			else:
				if($professionalProfile['posgrado_program_id'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $AreasPosgrado[$professionalProfile['posgrado_program_id']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile['another_career']);
				endif;
			endif;
			if($professionalProfile['academic_level_id']=='1'):
				if($professionalProfile['undergraduate_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Escuelas[$professionalProfile['undergraduate_institution']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile['another_undergraduate_institution']);
				endif;
			else:
				if($professionalProfile['undergraduate_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Facultades[$professionalProfile['undergraduate_institution']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile['another_undergraduate_institution']);
				endif;
			endif;
			
			if($professionalProfile['academic_situation_id'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $SituacionesAcademicas[$professionalProfile['academic_situation_id']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
			endif;

			if($professionalProfile['semester'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Semestres[$professionalProfile['semester']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Sin especificar');
			endif;
			
			$añoIngresoString = '';
			$objPHPExcel->getActiveSheet()
    		->getStyle($columna)
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
    		if($professionalProfile['entrance_year_degree'] <> '0000-00-00'):
    			$yearIngreso = explode("-",$professionalProfile['entrance_year_degree']);
    			$añoIngresoString .= $yearIngreso[0];
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $añoIngresoString);
    		else:
    			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Sin especificar');
    		endif;
	
			
			$añoEgresoString = '';
			$objPHPExcel->getActiveSheet()
    		->getStyle($columna)
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
			if($professionalProfile['egress_year_degree'] <> '0000-00-00'):
				$yearEgreso = explode("-",$professionalProfile['egress_year_degree']);
				$añoEgresoString .= $yearEgreso[0];
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $añoEgresoString);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Sin especificar');
			endif;
			
			if($professionalProfile['average_id'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Promedios[$professionalProfile['average_id']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Sin especificar');
			endif;

			if($professionalProfile['decimal_average_id'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Decimales[$professionalProfile['decimal_average_id']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
			endif;
		
			if($professionalProfile['scholarship'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
			endif;
			
			if($ban == 6):
				break;
			endif;
			
			$ban++;
		endforeach;

		//Mobilidad estudiantil
			$columna = 'EC';
			$ban = 0;
		foreach($dato['StudentProfessionalProfile'] as $professionalProfile2):
				if($professionalProfile2['student_mobility'] == 's'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Si');
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'No');
				endif;
				
				if($professionalProfile2['student_mobility_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile2['student_mobility_institution']);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
				endif;

				if($professionalProfile2['student_mobility_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile2['student_mobility_program']);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
				endif;

				if($professionalProfile2['mobility_start_date'] <> '0000-00-00'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile2['mobility_start_date']);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
				endif;
				
				if($professionalProfile2['mobility_end_date'] <> '0000-00-00'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $professionalProfile2['mobility_end_date']);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
				endif;

				if($professionalProfile2['student_mobility_city'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Paises[$professionalProfile2['student_mobility_city']]);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
				endif;


				if($ban == 6):
					break;
				endif;
				$ban++;
		endforeach;

		// //Empresa  / Intitución y Puestos
		$columna = 'FS';
		$ban = 0;
		foreach($dato['StudentProfessionalExperience'] as $studentProfessionalExperience):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentProfessionalExperience['company_name']);
				if($studentProfessionalExperience['company_rotation'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Giros[$studentProfessionalExperience['company_rotation']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
				endif;
				
				if($studentProfessionalExperience['country'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Paises[$studentProfessionalExperience['country']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
				endif;
					
				$contPuesto = 0;
				foreach($studentProfessionalExperience['StudentWorkArea'] as $studentWorkArea):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentWorkArea['job_name']);
					
					if($studentProfessionalExperience['contract_type']<> ''):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $TiposContratos[$studentProfessionalExperience['contract_type']]);
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,$studentProfessionalExperience['other']);
					endif;

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $AreasExperiencia[$studentWorkArea['experience_area']]);
					
					$fechaInicio = $studentWorkArea['start_date'];
					
					if($studentWorkArea['current'] == 0):
						$fechaFinal = $studentWorkArea['end_date'];
					else:
						$fechaFinal = date('Y-m-d');
					endif;
				
					$datetime1 = new DateTime($fechaInicio);
					$datetime2 = new DateTime($fechaFinal);
					$fecha = $datetime1->diff($datetime2);

					$year=$fecha->y;
					$meses=$fecha->m;
					if($meses >= 6):
						$year++;
					endif;	
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $year);
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentWorkArea['start_date']);

					if($studentWorkArea['current'] == 0):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentWorkArea['end_date']);
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, date('Y-m-d'));
					endif;

					
					$respString = '';
					$numeroResponsabilidades = count($studentWorkArea['StudentResponsability']);
					foreach($studentWorkArea['StudentResponsability']  as $studentResponsability):
						$numeroResponsabilidades--;
						$respString .= $studentResponsability['responsability'];
						($numeroResponsabilidades > 0) ? $respString .=  ';' : '';
					endforeach;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,$respString);

					$logrosString = '';
					$numeroLogros = count($studentWorkArea['StudentAchievement']);
					foreach($studentWorkArea['StudentAchievement'] as $studentAchievement):
						$numeroLogros--;
						$logrosString .= $studentAchievement['achievement'];
						($numeroLogros > 0) ? $logrosString .=  ';' : '';
					endforeach;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $logrosString);
		

					if($contPuesto == 2):
						break;
					endif;

				endforeach;
				
				$numeroPuestos = count($studentProfessionalExperience['StudentWorkArea']);
				$puestosFaltantes = 3 - $numeroPuestos;
				$columnasFaltantes = $puestosFaltantes * 8;
				for($j = 0; $j < $columnasFaltantes; $j++):
					$columna++;
				endfor;

			    if($ban == 6):
					break;
				endif;
		endforeach;

		//Proyectos extracuriculares
		$columna = 'MZ';
		$ban = 0;
		foreach($dato['StudentAcademicProject'] as $studentAcademicProject):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentAcademicProject['name']);
			
			if($studentAcademicProject['team'] == '1'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i,'Grupal');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Individual');
			endif;

			if($studentAcademicProject['country'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $Paises[$studentAcademicProject['country']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, 'Sin especificar');
			endif;

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentAcademicProject['company']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentAcademicProject['responsability']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna++.$i, $studentAcademicProject['achievement']);

		if($ban == 6):
				break;
		endif;
		$ban++;

		endforeach;

	
		// Total Idiomas,computo y conocimientos y habilidades profesionales
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OP'.$i,count($dato['StudentLenguage']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OQ'.$i,count($dato['StudentTechnologicalKnowledge']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OR'.$i,count($dato['StudentJobSkill']));

		//Nomnbre Idiomas
		$idiomasString = '';
		$numIdiomas = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $idioma):
			$numIdiomas--;
			$idiomasString .= $idioma['Lenguage']['lenguage'];
			($numIdiomas > 0) ? $idiomasString .=  ';' : '';
		endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OS'.$i,$idiomasString);

		//Niveles reading_level
		$readingString = '';
		$numReading = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $reading):
			$numReading--;
			if($reading['reading_level'] <> ''):
				$readingString .= $NivelesIdioma[$reading['reading_level']];
			else:
				$readingString .= 'Sin especificar';
			endif;
			($numReading > 0) ? $readingString .= ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OT'.$i,$readingString);

		//Niveles writing_level
		$writingString = '';
		$numWriting = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $writing):
			$numWriting--;
			if($writing['writing_level'] <> ''):
				$writingString .= $NivelesIdioma[$writing['writing_level']];
			else:
				$writingString .= 'Sin especificar';
			endif;
			($numWriting > 0) ? $writingString .= ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OU'.$i,$writingString);

		//Niveles conversation_level
		$conversationString = '';
		$numConversation = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $conversation):
			$numConversation--;
			if($conversation['conversation_level']):
				$conversationString .= $NivelesIdioma[$conversation['conversation_level']];
			else:
				$conversationString .= 'Sin especificar';
			endif;
			($numConversation > 0) ? $conversationString .= ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OV'.$i,$conversationString);
			
		 //certificaciones
		$certificationString = '';
		$numCertificacion = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $certifications):	
			$numCertificacion--;
			if($certifications['certification'] <> ''):
				$certificationString .= $certifications['certification'];
			else:
				$certificationString .= 'Sin especificar';
			endif;
			($numCertificacion > 0) ? $certificationString .= ';' : '';
		
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OW'.$i,$certificationString);	

		 //Año certificaciones
		$objPHPExcel->getActiveSheet()
    		->getStyle('OX')
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$certificationYearString = '';
		$numCertificacionYear = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $certificationsYear):	
			$numCertificacionYear--;
			if($certificationsYear['certification_year'] <> ''):
				$certificationYearString .= $certificationsYear['certification_year'];
			else:
				$certificationYearString .= 'Sin especificar';
			endif;
			($numCertificacionYear > 0) ? $certificationYearString .= ';' : '';
		
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OX'.$i,$certificationYearString);	

		 //Puntaje certificaciones
		$scoreString = '';
		$numScore = count($dato['StudentLenguage']);
		$objPHPExcel->getActiveSheet()
    		->getStyle('OY')
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		foreach($dato['StudentLenguage'] as $certificationsScore):	
			$numScore--;
			if($certificationsScore['score'] <> 0):
				$scoreString .= $certificationsScore['score'];
			else:
				$scoreString .= 'Sin puntaje';
			endif;
			($numScore > 0) ? $scoreString .= ';' : '';	
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OY'.$i,$scoreString);	


		//categoria computo
		$categoriaString = '';
		$numeroCategorias = count($dato['StudentTechnologicalKnowledge']);
		foreach($dato['StudentTechnologicalKnowledge'] as $studentTechnolicalKnowledge):
				$numeroCategorias--;
				if($studentTechnolicalKnowledge['tecnology_id'] <> ''):
			 		$categoriaString .= $Tecnologias[$studentTechnolicalKnowledge['tecnology_id']];
			 	else:
			 		$categoriaString .= 'Sin especificar';
			 	endif;
			 	($numeroCategorias > 0) ? $categoriaString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('OZ'.$i,$categoriaString);

		//Nombre computo
		$nombreString = '';
		$numeroNombre = count($dato['StudentTechnologicalKnowledge']);
		foreach($dato['StudentTechnologicalKnowledge'] as $studentTechnolicalName):
				$numeroNombre--;
				if($studentTechnolicalName['name'] <> ''):
			 		$nombreString .= $Programas[$studentTechnolicalName['name']];
			 	else:
			 		$nombreString .= $studentTechnolicalName['other'];
			 	endif;
			 	($numeroNombre > 0) ? $nombreString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PA'.$i,$nombreString);

		//Nivel Computo
		$nivelComputoString = '';
		$numeroNivelComputo = count($dato['StudentTechnologicalKnowledge']);
		foreach($dato['StudentTechnologicalKnowledge'] as $studentTechnolicalLevel):
				$numeroNivelComputo--;
				if($studentTechnolicalLevel['level']):
			 		$nivelComputoString .= $NivelesSoftware[$studentTechnolicalLevel['level']];
			 	else:
			 		$nivelComputoString .= 'Sin especificar';
			 	endif;
			 	($numeroNivelComputo > 0) ? $nivelComputoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PB'.$i,$nivelComputoString);

		//Certificacion computo
		$certificacionString = '';
		$numeroCertificacionComputo = count($dato['StudentTechnologicalKnowledge']);
		foreach($dato['StudentTechnologicalKnowledge'] as $studentTechnolicalCertification):
				$numeroCertificacionComputo--;
				if($studentTechnolicalCertification['institution']<> ''):
			 		$certificacionString .= $studentTechnolicalCertification['institution'];
			 	else:
			 		$certificacionString .= 'Sin especificar';
			 	endif;
			 	($numeroCertificacionComputo > 0) ? $certificacionString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PC'.$i,$certificacionString);

		//Cursos / Talleres / Diplomados / Certificaciones categoria
		$categoriaCursosString = '';
		$numeCursos = count($dato['StudentJobSkill']);
		foreach($dato['StudentJobSkill'] as $studentJobSkill):
				$numeCursos--;
				if($studentJobSkill['type_course_id']):
			 		$categoriaCursosString .= $TipoCursos[$studentJobSkill['type_course_id']];
			 	else:
			 		$categoriaCursosString .= 'Sin especificar';
			 	endif;
			 	($numeCursos > 0) ? $categoriaCursosString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PD'.$i,$categoriaCursosString);

 
		//Cursos / Talleres / Diplomados / Certificaciones nombre
		$nombreCursoString = '';
		$numeCursosNombre = count($dato['StudentJobSkill']);	
		foreach($dato['StudentJobSkill'] as $studentJobSkillName):
				$numeCursosNombre--;
			 	$nombreCursoString .= $studentJobSkillName['name'];
			 	($numeCursosNombre > 0) ? $nombreCursoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PE'.$i,$nombreCursoString);

		//Cursos / Talleres / Diplomados / Certificaciones empresa
		$empresaCursoString = '';
		$numEmpresa = count($dato['StudentJobSkill']);	
		foreach($dato['StudentJobSkill'] as $studentJobSkillCompany):
				$numEmpresa--;
				if($studentJobSkillCompany['company'] <> ''):
			 		$empresaCursoString .= $studentJobSkillCompany['company'];
			 	else:
			 		$empresaCursoString .= 'Sin especificar';
			 	endif;
			 	($numEmpresa > 0) ? $empresaCursoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PF'.$i,$empresaCursoString);

		//Cursos / Talleres / Diplomados / Certificaciones duración
		$objPHPExcel->getActiveSheet()
    		->getStyle('PG')
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$duracionCursoString = '';
		$numDuracion= count($dato['StudentJobSkill']);	
		foreach($dato['StudentJobSkill'] as $studentJobSkillDuration):
				$numDuracion--;
				if($studentJobSkillDuration['duration'] <> 0):
			 		$duracionCursoString .= $studentJobSkillDuration['duration'];
			 	else:
			 		$duracionCursoString .= 'Sin especificar';
			 	endif;
			 	($numDuracion > 0) ? $duracionCursoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PG'.$i,$duracionCursoString);

		//Cursos / Talleres / Diplomados / Certificaciones año
		$objPHPExcel->getActiveSheet()
    		->getStyle('PH')
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$añoCursoString = '';
		$numAños= count($dato['StudentJobSkill']);	
		foreach($dato['StudentJobSkill'] as $studentJobSkillYear):
				$numAños--;
				if($studentJobSkillYear['date'] <> '0000-00-00'):
					$yearConocimiento = explode("-",$studentJobSkillYear['date']);
					$añoCursoString .= $yearConocimiento[0];
				else:
					$añoCursoString .= 'Sin especificar';
				endif;	
			 	($numAños > 0) ? $añoCursoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('PH'.$i,$añoCursoString);


	$i++;
	}
	
	// echo '<pre>';
	// print_r($datos);
	// echo '</pre>';
	
	
	$objPHPExcel->getActiveSheet()->setTitle('Postulaciones');
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Postulados en '.$nombrePuesto.'.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>