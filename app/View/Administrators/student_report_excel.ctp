<?php
	ini_set('max_execution_time', 300);
	ini_set('memory_limit', '2048M');
	// Importamos la clase PHPExcel
	header( 'Content-type: text/html; charset=utf-8' );
	App::import('Vendor', 'Classes/PHPExcel');

	$objPHPExcel = new PHPExcel();
	 
	$objPHPExcel->getProperties()->setCreator("Sistema de Bolsa Universitaria de Trabajo bti")
								 ->setLastModifiedBy("SISBUT bti")
								 ->setTitle("Reporte - Universitarios")
								 ->setSubject("Reporte - Universitarios")
								 ->setDescription("Reporte - Universitarios")
								 ->setKeywords("Reporte - Universitarios")
								 ->setCategory("Reporte - Universitarios");
	
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','Sistema de Bolsa Universitaria de Trabajo bti');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
	//Se combinan las celdas
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:C2');
	
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Descarga de currículums / Estatus de alumnos: '.$estatus);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleBorderArray);

		$arrayExperiencia = array('Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 1','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 2','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 3','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 4','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 5','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 6','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7','Experiencia profesional 7');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(27);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(27);

		//Se agregan los titulos de las celdas
	
		$arrayHeader = array('Información del currículum','Información del currículum','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Datos personales','Objetivo profesional','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Competencias profesionales','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 1','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 2','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 3','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Expectativa laboral 4','Nivel académico','Nivel académico','Nivel académico','Nivel académico','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 1','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 2','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 3','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 4','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 5','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 6','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Formación académica 7','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 1','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 2','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 3','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 4','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 5','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 6','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Mobilidad estudiantil 7','Empresa / Institución','Empresa / Institución 1','Empresa / Institución 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 2','Empresa / Institución 2','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 3','Empresa / Institución 3','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 4','Empresa / Institución 4','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 5','Empresa / Institución 5','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 6','Empresa / Institución 6','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Empresa / Institución','Empresa / Institución 7','Empresa / Institución 7','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 1','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 2','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Puesto 3','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 1','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 2','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 3','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 4','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 5','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 6','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Proyectos extracurriculares 7','Idiomas','Computo','Conocimientos y habilidades profesionales','Idiomas','Idiomas','Idiomas','Idiomas','Idiomas','Idiomas','Idiomas','Computo','Computo','Computo','Computo','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales','Conocimientos y habilidades profesionales');	
		
		$arrayDescription = array('Folio','Número de cuenta','Encabezado de currículum','Nombre(s)','Apellido materno','Apellido paterno','Sexo','Fecha de nacimiento','Edad','País de nacimiento','Estado civil','Correo 1','Correo 2','Dirección','Estado','Delegación','Población / Colonia','Código Postal','Teléfono local','Teléfono celular','Tipo de discapacidad','Objetivo profesional','Competencia 1','Competencia 2','Competnecia 3','Competencia 4','Competencia 5','Competencia 6','Competencia 7','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Giro de interés','Área de interés','Tipo de contrato','Jornada laboral','Pretenciones económicas','Disponibilidad para viajar','Tipo','Disponibilidad para cambiar de residencia','Tipo','Licenciatura','Especialidad','Mestría ','Doctorado','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Carrera / Área','Escuela / Facultad / Institución','Situación académica','Semestre','Año de ingreso','Año de egreso','Promedio','Décimas','Beca','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Mobilidad estudiantil','Institución','Nombre del programa / Proyecto','Fecha de incio','Fecha de término / Actual','País','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Empresa / Institución','Giro','País','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Puesto','Tipo de contrato / Otro','Área de experiencia','Años de experiencia','Fecha de inicio','Fecha de término / Actual','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Nombre','Tipo','País','Empresa / Institución','Responsabilidades','Logros','Total','Total','Total','Idioma','Nivel de lectura','Nivel de escritura','Nivel de conversación','Certificación / Institución que lo acredita','Año de certificación','Puntaje','Categoría','Nombre / Otro','Nivel','Certificación','Categoría','Nombre','Empresa / Insitución','Duración','Año');
		
		//Descripcion Agrega datos personales 
		$accesa = 0;
		foreach ($columnas as $c):
			if(($c == 1) OR ($c == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=0; $i<=20; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		//Descripcion Agrega objetivo
		$accesa = 0;
		foreach ($columnas as $c):
			if(($c == 2) OR ($c == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			$arrayHeader2[] = $arrayHeader[21];
			$arrayDescription2[] = $arrayDescription[21];
		endif;

	 //Descripcion Agrega competencias
		$accesa = 0;
		foreach ($columnas as $c):
			if(($c == 3) OR ($c == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=22; $i<=28; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		//Descripcion Agrega expectativa laboral
		$accesa = 0;
		foreach ($columnas as $c):
			if(($c == 4) OR ($c == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=29; $i<=64; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		// //Descripcion Agrega nivel academico y formacion academica
		$accesa = 0;
		foreach ($columnas as $c):
			if(($c == 5) OR ($c == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=65; $i<=131; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		// //Descripcion Mobilidad estudiantil
		$accesa = 0;
		foreach ($columnas as $columna):
			if(($columna == 6) OR ($columna == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=132; $i<=173; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		// //Descripcion Experiecia profesional
		$accesa = 0;
		foreach ($columnas as $columna):
			if(($columna == 7) OR ($columna == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=174; $i<=362; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		// //Descripcion Proyectos extracurriculares
		$accesa = 0;
		foreach ($columnas as $columna):
			if(($columna == 8) OR ($columna == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=363; $i<=404; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		// //Descripcion Idiomas
		$accesa = 0;
		foreach ($columnas as $columna):
			if(($columna == 9) OR ($columna == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=405; $i<=414; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		// //Descripcion Computos
		$accesa = 0;
		foreach ($columnas as $columna):
			if(($columna == 10) OR ($columna == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=415; $i<=418; $i++):
				$arrayHeader2[] = $arrayHeader[$i];
				$arrayDescription2[] = $arrayDescription[$i];
			endfor;
		endif;

		// //Descripcion Conocimientos y habilidades profesionales
		$accesa = 0;
		foreach ($columnas as $columna):
			if(($columna == 11) OR ($columna == 0)):
				$accesa = 1;
				break;
			endif;
		endforeach;

		if($accesa == 1):
			for($i=419; $i<=423; $i++):
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

	$i=6;
	foreach ($datos as $dato){
    ob_flush(); 
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 1) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

//IMPORTANTE
//Datos personales
	$indiceColumna = 'A';
	if($accesa == 1):
		if(isset($dato['Student']['id'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['Student']['id']);
		endif;

		if(isset($dato['Student']['username'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['Student']['username']);
		endif;

		if($dato['StudentHeader']['header'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentHeader']['header']);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin encabezado');
		endif;

		if(isset($dato['StudentProfile']['name'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['name']);
		endif;

		if(isset($dato['StudentProfile']['last_name'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['last_name']);
		endif;

		if(isset($dato['StudentProfile']['second_last_name'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['second_last_name']);
		endif;
			
		if($dato['StudentProfile']['sex']<>''):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Sexo[$dato['StudentProfile']['sex']]);
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
		endif;
			
			if($dato['StudentProfile']['date_of_birth']<>'0000-00-00'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['date_of_birth']);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
			endif;
			if($dato['StudentProfile']['date_of_birth']<>'0000-00-00'):
				$date2 = date('Y-m-d');
				$diff = abs(strtotime($date2) - strtotime($dato['StudentProfile']['date_of_birth']));
				$years = floor($diff / (365*60*60*24));
			else:
				$years = 'Sin especificar';
			endif;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $years);
			
			if($dato['StudentProfile']['born_country']<>''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Paises[$dato['StudentProfile']['born_country']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
			endif;
			
			if($dato['StudentProfile']['marital_status']<>''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $EstadoCivil[$dato['StudentProfile']['marital_status']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
			endif;
			
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['Student']['email']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['secondary_email']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['street']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['state']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['city']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['subdivision']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['zip']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['telephone_contact']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentProfile']['cell_phone']);
			if($dato['StudentProfile']['disability_type'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $TiposDiscapacidad[$dato['StudentProfile']['disability_type']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Ninguna');
			endif;
	endif;

//Objetivo profesional
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 2) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

	if($accesa == 1):
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $dato['StudentJobProspect']['professional_objective']);
	endif;

//Competencias
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 3) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

	if($accesa == 1):
		foreach($dato['StudentProfessionalSkill'] as $competencia):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Competencias[$competencia['competency_id']]);
		endforeach;	
	endif;
	
//Expectativa laboral
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 4) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

	if($accesa == 1):
		foreach($dato['StudentInterestJob'] as $expectativa):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Giros[$expectativa['business_activity']]);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $AreasExperiencia[$expectativa['interest_area_id']]);
			if($dato['StudentProspect']['contract_type']<>''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $TiposContratos[$dato['StudentProspect']['contract_type']]);
			else:
				$indiceColumna++;
			endif;
			if($dato['StudentProspect']['workday']<>''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $JornadasLaborales[$dato['StudentProspect']['workday']]);
			else:
				$indiceColumna++;
			endif;
			if($dato['StudentProspect']['economic_pretension']<>''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Salarios[$dato['StudentProspect']['economic_pretension']]);
			else:
				$indiceColumna++;
			endif;
			
			// echo "<pre>";
			// print_r($dato);
			// echo "</pre>";
			// exit;
			$indiceColumna++;$indiceColumna++;$indiceColumna++;
			if($dato['StudentProspect']['can_travel'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
			endif;
			if($dato['StudentProspect']['can_travel'] == 'n'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin disponibilidad');
			else:
				if($dato['StudentProspect']['can_travel_option'] == '1'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Dentro del país');
				else:
					if($dato['StudentProspect']['can_travel_option'] == '2'):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Fuera del país');
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
					endif;
				endif;
			endif;
			
			if($dato['StudentProspect']['change_residence'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
			endif;
			
			if($dato['StudentProspect']['change_residence'] == 'n'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin disponibilidad');
			else:
				if($dato['StudentProspect']['change_residence_option'] == '1'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Dentro del país');
				else:
					if($dato['StudentProspect']['change_residence_option'] == '2'):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Fuera del país');
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
					endif;
				endif;
			endif;
			
		endforeach;	
		
		$numeroExpectativas = count($dato['StudentInterestJob']);
		$expectativasFaltantes = 4 - $numeroExpectativas ;
		$columnasFaltantes = $expectativasFaltantes * 9;
		for($j = 0; $j < $columnasFaltantes; $j++):
			$indiceColumna++;
		endfor;		
	endif;
	
// Formación Académica
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 5) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

	if($accesa == 1):
		$ban = 0;
		foreach($dato['StudentProfessionalProfile'] as $professionalProfile):
		
			if($ban == 0):
				if($professionalProfile['academic_level_id']==1):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
				endif;
				if($professionalProfile['academic_level_id']==2):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
				endif;
				if($professionalProfile['academic_level_id']==3):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
				endif;
				if($professionalProfile['academic_level_id']==4):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
				endif;
			endif;
			if($professionalProfile['academic_level_id']==1):
				if($professionalProfile['career_id'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $careers[$professionalProfile['career_id']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile['another_career']);
				endif;
			else:
				if($professionalProfile['posgrado_program_id'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $AreasPosgrado[$professionalProfile['posgrado_program_id']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile['another_career']);
				endif;
			endif;
			if($professionalProfile['academic_level_id']=='1'):
				if($professionalProfile['undergraduate_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Escuelas[$professionalProfile['undergraduate_institution']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile['another_undergraduate_institution']);
				endif;
			else:
				if($professionalProfile['undergraduate_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Facultades[$professionalProfile['undergraduate_institution']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile['another_undergraduate_institution']);
				endif;
			endif;
			
			if(isset($professionalProfile['academic_situation_id']) and ($professionalProfile['academic_situation_id']<>'') and ($professionalProfile['academic_situation_id']<>0)):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $SituacionesAcademicas[$professionalProfile['academic_situation_id']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
			endif;
			
			if(isset($professionalProfile['semester']) and ($professionalProfile['semester']<>'') and ($professionalProfile['semester']<>0)):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Semestres[$professionalProfile['semester']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
			endif;

			
			$añoIngresoString = '';
			$objPHPExcel->getActiveSheet()
    		->getStyle($indiceColumna)
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
    		if($professionalProfile['entrance_year_degree'] <> '0000-00-00'):
    			$yearIngreso = explode("-",$professionalProfile['entrance_year_degree']);
    			$añoIngresoString .= $yearIngreso[0];
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $añoIngresoString);
    		else:
    			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
    		endif;
	
			
			$añoEgresoString = '';
			$objPHPExcel->getActiveSheet()
    		->getStyle($indiceColumna)
    		->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
			if($professionalProfile['egress_year_degree'] <> '0000-00-00'):
				$yearEgreso = explode("-",$professionalProfile['egress_year_degree']);
				$añoEgresoString .= $yearEgreso[0];
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $añoEgresoString);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
			endif;
			
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Promedios[$professionalProfile['average_id']]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Decimales[$professionalProfile['decimal_average_id']]);
		
			if($professionalProfile['scholarship'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
			endif;
			
			if($ban == 6):
				break;
			endif;
			
			$ban++;
		endforeach;
		$numeroFormaciones = count($dato['StudentProfessionalProfile']);
		$formacionesFaltantes = 7 - $numeroFormaciones ;
		$columnasFaltantes = $formacionesFaltantes * 9;
		for($j = 0; $j < $columnasFaltantes; $j++):
			$indiceColumna++;
		endfor;	
			
	endif;
	
//Mobilidad estudiantil
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 6) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

	if($accesa == 1):
			$ban = 0;
		foreach($dato['StudentProfessionalProfile'] as $professionalProfile2):
				if($professionalProfile2['student_mobility'] == 's'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
				endif;
				
				if($professionalProfile2['student_mobility_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile2['student_mobility_institution']);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;

				if($professionalProfile2['student_mobility_institution'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile2['student_mobility_program']);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;

				if($professionalProfile2['mobility_start_date'] <> '0000-00-00'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile2['mobility_start_date']);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;
				
				if($professionalProfile2['mobility_end_date'] <> '0000-00-00'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $professionalProfile2['mobility_end_date']);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;

				if($professionalProfile2['student_mobility_city'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Paises[$professionalProfile2['student_mobility_city']]);
			else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;


				if($ban == 6):
					break;
				endif;
				$ban++;
		endforeach;
		$numeroMobilidades = count($dato['StudentProfessionalProfile']);
		$mobilidadesFaltantes = 7 - $numeroMobilidades ;
		$columnasFaltantes = $mobilidadesFaltantes * 6;
		for($j = 0; $j < $columnasFaltantes; $j++):
			$indiceColumna++;
		endfor;	
	endif;

	//Empresa / Intitución y Puestos
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 7) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

	if($accesa == 1):
		$ban = 0;
		$indiceArray = 0;
		$columnaInicial = $indiceColumna;

		foreach($dato['StudentProfessionalExperience'] as $studentProfessionalExperience):
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentProfessionalExperience['company_name']);
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
				if($studentProfessionalExperience['company_rotation'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Giros[$studentProfessionalExperience['company_rotation']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
				if($studentProfessionalExperience['country'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Paises[$studentProfessionalExperience['country']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;
					
				$contPuesto = 0;
				foreach($studentProfessionalExperience['StudentWorkArea'] as $studentWorkArea):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentWorkArea['job_name']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					if($studentProfessionalExperience['contract_type']<> ''):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $TiposContratos[$studentProfessionalExperience['contract_type']]);
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$studentProfessionalExperience['other']);
					endif;

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $AreasExperiencia[$studentWorkArea['experience_area']]);
					
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
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $year);
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentWorkArea['start_date']);

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					if($studentWorkArea['current'] == 0):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentWorkArea['end_date']);
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, date('Y-m-d'));
					endif;

					
					$respString = '';
					$numeroResponsabilidades = count($studentWorkArea['StudentResponsability']);
					foreach($studentWorkArea['StudentResponsability']  as $studentResponsability):
						$numeroResponsabilidades--;
						$respString .= $studentResponsability['responsability'];
						($numeroResponsabilidades > 0) ? $respString .=  ';' : '';
					endforeach;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$respString);

					$logrosString = '';
					$numeroLogros = count($studentWorkArea['StudentAchievement']);
					foreach($studentWorkArea['StudentAchievement'] as $studentAchievement):
						$numeroLogros--;
						$logrosString .= $studentAchievement['achievement'];
						($numeroLogros > 0) ? $logrosString .=  ';' : '';
					endforeach;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $logrosString);
		

					if($contPuesto == 2):
						break;
					 endif;


				endforeach;
				
				// $numeroPuestos = count($studentProfessionalExperience['StudentWorkArea']);
				$numeroPuestos = 2;
				$puestosFaltantes = 3 - $numeroPuestos ;
				$columnasFaltantes = $puestosFaltantes * 8;
				for($j = 0; $j < $columnasFaltantes; $j++):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
					$indiceColumna++;
				endfor;

			    if($ban == 6):
					break;
				endif;
		endforeach;

		$numeroExperiencias = count($dato['StudentProfessionalExperience']);
		$experienciasFaltantes = 7 - $numeroExperiencias;
		$columnasFaltantes = $experienciasFaltantes * 27;
		for($j = 0; $j < $columnasFaltantes; $j++):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna.'3', $arrayExperiencia[$indiceArray++]);
			$indiceColumna++;
		endfor;

		$objPHPExcel->getActiveSheet()->getStyle($columnaInicial.'3:'.$indiceColumna.'3')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle($columnaInicial.'3:'.$indiceColumna.'3')->applyFromArray($styleBorderArray);
		$objPHPExcel->getActiveSheet()->getStyle($columnaInicial.'3:'.$indiceColumna.'3')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle($columnaInicial.'3:'.$indiceColumna.'3')->applyFromArray($styleBorderArray);
	endif;

//Proyectos extracuriculares
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 8) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;

	if($accesa == 1):
		$ban = 0;
		foreach($dato['StudentAcademicProject'] as $studentAcademicProject):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentAcademicProject['name']);
			
			if($studentAcademicProject['team'] == '1'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Grupal');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Individual');
			endif;

			if($studentAcademicProject['country'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $Paises[$studentAcademicProject['country']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
				endif;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentAcademicProject['company']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentAcademicProject['responsability']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, $studentAcademicProject['achievement']);

			if($ban == 6):
					break;
			endif;
			$ban++;

		endforeach;

		$numeroProyectos = count($dato['StudentAcademicProject']);
		$proyectosFaltantes = 7 - $numeroProyectos;
		$columnasFaltantes = $proyectosFaltantes * 6;
		for($j = 0; $j < $columnasFaltantes; $j++):
			$indiceColumna++;
		endfor;

	endif;

	
	
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 9) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;
	//Idiomas
	if($accesa == 1):
		// Total Idiomas,computo y conocimientos y habilidades profesionales
		if(count($dato['StudentLenguage'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['StudentLenguage']));
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'');
		endif;

		if(count($dato['StudentTechnologicalKnowledge'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['StudentTechnologicalKnowledge']));
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'');
		endif;

		if(count($dato['StudentJobSkill'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['StudentJobSkill']));
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'');
		endif;

		//Nomnbre Idiomas
	
		$idiomasString = '';
		$numIdiomas = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $idioma):
			$numIdiomas--;
			$idiomasString .= $idioma['Lenguage']['lenguage'];
			($numIdiomas > 0) ? $idiomasString .=  ';' : '';
		endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$idiomasString);

		//Niveles reading_level
		$readingString = '';
		$numReading = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $reading):
			$numReading--;
			$readingString .= $NivelesIdioma[$reading['reading_level']];
			($numReading > 0) ? $readingString .= ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$readingString);

		//Niveles writing_level
		$writingString = '';
		$numWriting = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $writing):
			$numWriting--;
			$writingString .= $NivelesIdioma[$writing['writing_level']];
			($numWriting > 0) ? $writingString .= ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$writingString);

		//Niveles conversation_level
		$conversationString = '';
		$numConversation = count($dato['StudentLenguage']);
		foreach($dato['StudentLenguage'] as $conversation):
			$numConversation--;
			$conversationString .= $NivelesIdioma[$conversation['conversation_level']];
			($numConversation > 0) ? $conversationString .= ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$conversationString);
			
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$certificationString);	

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$certificationYearString);	

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$scoreString);
	endif;

//Computos
//categoria computo
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 10) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;
	if($accesa == 1):
		$categoriaString = '';
		$numeroCategorias = count($dato['StudentTechnologicalKnowledge']);
		foreach($dato['StudentTechnologicalKnowledge'] as $studentTechnolicalKnowledge):
				$numeroCategorias--;
			 	$categoriaString .= $Tecnologias[$studentTechnolicalKnowledge['tecnology_id']];
			 	($numeroCategorias > 0) ? $categoriaString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$categoriaString);

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$nombreString);

//Nivel Computo
		$nivelComputoString = '';
		$numeroNivelComputo = count($dato['StudentTechnologicalKnowledge']);
		foreach($dato['StudentTechnologicalKnowledge'] as $studentTechnolicalLevel):
				$numeroNivelComputo--;
			 	$nivelComputoString .= $NivelesSoftware[$studentTechnolicalLevel['level']];
			 	($numeroNivelComputo > 0) ? $nivelComputoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$nivelComputoString);

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$certificacionString);
	endif;

//Cursos / Talleres / Diplomados / Certificaciones categoria
	$accesa = 0;
	foreach ($columnas as $c):
		if(($c == 11) OR ($c == 0)):
			$accesa = 1;
			break;
		endif;
	endforeach;
	if($accesa == 1):
		$categoriaCursosString = '';
		$numeCursos = count($dato['StudentJobSkill']);
		foreach($dato['StudentJobSkill'] as $studentJobSkill):
				$numeCursos--;
			 	$categoriaCursosString .= $TipoCursos[$studentJobSkill['type_course_id']];
			 	($numeCursos > 0) ? $categoriaCursosString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$categoriaCursosString);

 
//Cursos / Talleres / Diplomados / Certificaciones nombre
		$nombreCursoString = '';
		$numeCursosNombre = count($dato['StudentJobSkill']);	
		foreach($dato['StudentJobSkill'] as $studentJobSkillName):
				$numeCursosNombre--;
			 	$nombreCursoString .= $studentJobSkillName['name'];
			 	($numeCursosNombre > 0) ? $nombreCursoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$nombreCursoString);

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$empresaCursoString);

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$duracionCursoString);

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$añoCursoString);
	endif;


	$i++;
	}
	
	// echo '<pre>';
	// print_r($datos);
	// echo 'Columnas a graficar: ';
	// print_r($columnas);
	// echo '</pre>';
	// exit;
	
	$objPHPExcel->getActiveSheet()->setTitle('Reporte - Universitarios');
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Reporte - Universitarios.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>