<?php
	// Importamos la clase PHPExcel
	App::import('Vendor', 'Classes/PHPExcel');

	$objPHPExcel = new PHPExcel();
	 
	$objPHPExcel->getProperties()->setCreator("SISBUT UNAM")
								 ->setLastModifiedBy("SISBUT UNAM")
								 ->setTitle("Administrar ofertas")
								 ->setSubject("Administrar ofertas")
								 ->setDescription("Ejemplo de integracion cakephp 2.x y phpExcel.")
								 ->setKeywords("Administrar ofertas")
								 ->setCategory("Administrar ofertas");
	
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

	if(!isset($tipoDescarga)):
		$tipoDescarga = 'Todas las ofertas';
	endif;
	
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Descarga de ofertas / '.$tipoDescarga);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleBorderArray);
		
	//Se agregan los titulos de las celdas
		
	
		$objPHPExcel->getActiveSheet()->getStyle('A4:BE4')->applyFromArray($styleTextArray);
		$objPHPExcel->getActiveSheet()->getStyle('A4:BE4')->applyFromArray($styleBorderArray);
	
		$arrayHeader = array('Responsable de la oferta','Responsable de la oferta','Responsable de la oferta','Responsable de la oferta','Responsable de la oferta','Responsable de la oferta','Responsable de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Perfil de la oferta','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Modalidad de contratación','Competencias','Competencias','Competencias','Competencias','Competencias','Competencias','Competencias','Conocimeintos y habildiades profesionales','Idiomas','Computo','Idiomas','Idiomas','Idiomas','Idiomas','Computo','Computo','Computo','Nivel académico','Formación académica','Formación académica','Formación académica',);	
		
	
		$arrayDescription = array('Nombre(s)','Apellido materno','Apellido paterno','Cargo','Teléfono de contacto','Extensión','Correo institucional','Folio oferta','Confidencial','Nombre Empresa / Institución','Puesto','Vacantes','Giro','Área de experiencia','Experiencia','Actividades','Ofera incluyente','Tipo de discapacidad','Vigencia de la oferta','Tipo de contrato','Duración del contrato','Jornada laboral','Horario','Sueldo neto','Sueldo confidencial','Prestaciones / apoyos','Prestaciones / Apoyos / Otras','Estado / Entidad federativa','Delgación / Municipio','Referencia de ubicación','Disponibilidad para viajar','Tipo','Lugar','Disponibilidad para cambiar de residencia','Tipo','País','Competencia 1','Competencia 2','Competencia 3','Competencia 4','Competencia 5','Competencia 6','Competencia 7','Conocimeintos y habildiades profesionales','Total','Total','Idioma','Nivel de lectura','Nivel de escritura','Nivel de conversación','Categoría','Nombre / Otro','Nivel','Nivel de estudios','Carrera / Área','Situación académica','Semestre');
		
		//Responsable de la oferta
	$accesa = 1;

	for($i=0; $i<=6; $i++):
		$arrayHeader2[] = $arrayHeader[$i];
		$arrayDescription2[] = $arrayDescription[$i];
	endfor;


	//Perfil de la oferta
	if($accesa == 1):
		for($i=7; $i<=18; $i++):
			$arrayHeader2[] = $arrayHeader[$i];
			$arrayDescription2[] = $arrayDescription[$i];
		endfor;
	endif;

		//Mobilidad de contratacíon
	if($accesa == 1):
		for($i=19; $i<=35; $i++):
			$arrayHeader2[] = $arrayHeader[$i];
			$arrayDescription2[] = $arrayDescription[$i];
		endfor;
	endif;

	//Competencias profesionales
	if($accesa == 1):
		for($i=36; $i <=42; $i++):
			$arrayHeader2[] = $arrayHeader[$i];
			$arrayDescription2[] = $arrayDescription[$i];
		endfor;
	endif;

	//Conocimientos y habilidades profesionales
	if($accesa == 1):
			$arrayHeader2[] = $arrayHeader[43];
			$arrayDescription2[] = $arrayDescription[43];
	endif;

	//Idiomas
	if($accesa == 1):
		for($i=44; $i <=49; $i++):
			$arrayHeader2[] = $arrayHeader[$i];
			$arrayDescription2[] = $arrayDescription[$i];
		endfor;
	endif;

	//Computo
	if($accesa == 1):
		for($i=50; $i <=52; $i++):
			$arrayHeader2[] = $arrayHeader[$i];
			$arrayDescription2[] = $arrayDescription[$i];
		endfor;
	endif;
	
	// Nivel academico y formación academica
	if($accesa == 1):
		for($i=53; $i <=56; $i++):
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
	$indiceColumna = 'A';
	
	foreach ($datos as $dato){
		if(isset($dato['CompanyJobOffer']['same_contact'])):
			if($dato['CompanyJobOffer']['same_contact'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['CompanyContact']['name']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['CompanyContact']['last_name']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['CompanyContact']['second_last_name']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['CompanyContact']['job_title']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['CompanyContact']['telephone_number']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['CompanyContact']['phone_extension']);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobOffer']['responsible_name']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobOffer']['responsible_last_name']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobOffer']['responsible_second_last_name']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobOffer']['responsible_position']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobOffer']['responsible_telephone']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobOffer']['responsible_phone_extension']);
				
			endif;
		endif;

		if(isset($dato['Company']['email'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['email']);
		endif;

		if(isset($dato['CompanyJobProfile']['id'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobProfile']['id']);
		endif;

		if(isset($dato['CompanyJobOffer']['confidential_job_offer'])):
			if($dato['CompanyJobOffer']['confidential_job_offer'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
			endif;
		endif;

		if(isset($dato['CompanyJobOffer']['confidential_job_offer'])):
			if($dato['CompanyJobOffer']['confidential_job_offer'] == 'n'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['Company']['CompanyProfile']['company_name']);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobOffer']['company_name']);
			endif;
		endif;

		if(isset($dato['CompanyJobProfile']['job_name'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobProfile']['job_name']);
		endif;

		if(isset($dato['CompanyJobProfile']['vacancy_number'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobProfile']['vacancy_number']);
		endif;

		if(isset($dato['CompanyJobProfile']['rotation'])):
			if($dato['CompanyJobProfile']['rotation'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$Giros[$dato['CompanyJobProfile']['rotation']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
			endif;
		endif;

		if(isset($dato['CompanyJobProfile']['interest_area'])):
			if($dato['CompanyJobProfile']['interest_area'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$AreasInteres[$dato['CompanyJobProfile']['interest_area']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
			endif;
		endif;

		if(isset($dato['ExperienceTime']['experience_time'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['ExperienceTime']['experience_time']);
		endif;

		if(isset($dato['ExperienceTime']['experience_time'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobProfile']['activity']);
		endif;

		if(isset($dato['CompanyJobProfile']['disability'])):
			if($dato['CompanyJobProfile']['disability'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'No');
			endif;
		endif;

		if(isset($dato['CompanyJobProfile']['disability_type'])):
			if($dato['CompanyJobProfile']['disability_type'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$TiposDiscapacidad[$dato['CompanyJobProfile']['disability_type']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Ninguna');
			endif;
		endif;

		if(isset($dato['CompanyJobProfile']['expiration'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobProfile']['expiration']);
		endif;

		if(isset($dato['CompanyJobContractType']['contract_type'])):
			if($dato['CompanyJobContractType']['contract_type'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$TiposContratos[$dato['CompanyJobContractType']['contract_type']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
			endif;
		endif;

		if(isset($dato['CompanyJobContractType']['contract_length'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobContractType']['contract_length']);
		endif;

		if(isset($dato['CompanyJobContractType']['workday'])):	
			if($dato['CompanyJobContractType']['workday'] <> ''):	
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$JornadasLaborales[$dato['CompanyJobContractType']['workday']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
			endif;
		endif;

		if(isset($dato['CompanyJobContractType']['schedule'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobContractType']['schedule']);
		endif;

		if(isset($dato['CompanyJobContractType']['salary'])):
			if($dato['CompanyJobContractType']['salary']):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$Salarios[$dato['CompanyJobContractType']['salary']]);
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
			endif;
		endif;

		if(isset($dato['CompanyJobContractType']['confidential_salary'])):
			if($dato['CompanyJobContractType']['confidential_salary'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'No');
			endif;
		endif;

		if(isset($dato['CompanyJobContractType']['CompanyJobContractTypeBenefit'])):
			if($dato['CompanyJobContractType']['CompanyJobContractTypeBenefit'] <> ''):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['CompanyJobContractType']['CompanyJobContractTypeBenefit']));
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
			endif;
		endif;

		if(isset($dato['CompanyJobContractType']['CompanyJobContractTypeBenefit'])):
			$beneficioString = '';
			$numBeneficio = count($dato['CompanyJobContractType']['CompanyJobContractTypeBenefit']);
			foreach($dato['CompanyJobContractType']['CompanyJobContractTypeBenefit'] as $benedicios):
				$numBeneficio--;
				if($Prestaciones[$benedicios['benefit_id']] <> ''):
					$beneficioString .= $Prestaciones[$benedicios['benefit_id']];
				else:
					$beneficioString .= 'Sin especificar';
				endif;
				($numBeneficio > 0) ? $beneficioString .=  ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$beneficioString);
		endif;

		if(isset($dato['CompanyJobContractType']['state'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobContractType']['state']);
		endif;

		if(isset($dato['CompanyJobContractType']['subdivision'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobContractType']['subdivision']);
		endif;

		if(isset($dato['CompanyJobContractType']['location_reference'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobContractType']['location_reference']);
		endif;

		if(isset($dato['CompanyJobContractType']['mobility'])):
			if($dato['CompanyJobContractType']['mobility'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'No');
			endif;
			if($dato['CompanyJobContractType']['mobility'] == 'n'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin disponibilidad');
			else:
				if($dato['CompanyJobContractType']['mobility_option'] == '1'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Dentro del pais');
				else:
					if($dato['CompanyJobContractType']['mobility_option'] == '2'):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Fuera del pais');
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
					endif;
				endif;
			endif;
			$numeroModalidades= count($dato['CompanyJobContractType']);
			$modalidadesFaltantes = 17 - $numeroModalidades;
			$columnasFaltantes = $modalidadesFaltantes * 1;
			for($j = 0; $j < $columnasFaltantes; $j++):
				$indiceColumna++;
			endfor;
		endif;

		if(isset($dato['CompanyJobContractType']['mobility_city'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobContractType']['mobility_city']);
		endif;

		if(isset($dato['CompanyJobContractType']['change_residence'])):
			if($dato['CompanyJobContractType']['change_residence'] == 's'):
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Si');
			else:
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'No');
			endif;
			if($dato['CompanyJobContractType']['change_residence'] == 'n'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin disponibilidad');
			else:
				if($dato['CompanyJobContractType']['change_residence_option'] == '1'):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Dentro del pais');
				else:
					if($dato['CompanyJobContractType']['change_residence_option'] == '2'):
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Fuera del pais');
					else:
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i, 'Sin especificar');
					endif;
				endif;
			endif;
		endif;

		if(isset($dato['CompanyJobContractType']['mobility_city'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobContractType']['mobility_city']);
		endif;
		
		if(isset($dato['CompanyJobOfferCompetency'])):
			foreach($dato['CompanyJobOfferCompetency'] as  $competencia):
				if($Competencias[$competencia['competency_id']] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$Competencias[$competencia['competency_id']]);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
				endif;
			endforeach;

			$numeroCompetencias = count($dato['CompanyJobOfferCompetency']);
			$competenciasFaltantes = 7 - $numeroCompetencias;
			$columnasFaltantes = $competenciasFaltantes * 1;
			for($j = 0; $j < $columnasFaltantes; $j++):
				$indiceColumna++;
			endfor;
		endif;

		if(isset($dato['CompanyJobProfile']['professional_skill'])):
			if(isset($dato['CompanyJobProfile']['professional_skill'])):
				if($dato['CompanyJobProfile']['professional_skill'] <> ''):
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$dato['CompanyJobProfile']['professional_skill']);
				else:
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'Sin especificar');
				endif;
			endif;
		endif;

		if(count($dato['CompanyJobLanguage'])):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['CompanyJobLanguage']));
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'');
		endif;

		if(count($dato['CompanyJobComputingSkill']) <> '' ):
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,count($dato['CompanyJobComputingSkill']));
		else:
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,'');
		endif;
	
		if(isset($dato['CompanyJobLanguage'])):
			$idiomasString = '';
			$numIdiomas = count($dato['CompanyJobLanguage']);
			foreach($dato['CompanyJobLanguage'] as $idioma):
				$numIdiomas--;
				if($idioma['Lenguage']['lenguage'] <> ''):
					$idiomasString .= $idioma['Lenguage']['lenguage'];
				else:
					$idiomasString .= 'Sin especificar';
				endif;
				($numIdiomas > 0) ? $idiomasString .=  ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$idiomasString);
		endif;

		//Niveles reading_level
		if(isset($dato['CompanyJobLanguage'])):
			$readingString = '';
			$numReading = count($dato['CompanyJobLanguage']);
			foreach($dato['CompanyJobLanguage'] as $reading):
				$numReading--;
				if($NivelesIdioma[$reading['reading_level']] <> ''):
					$readingString .= $NivelesIdioma[$reading['reading_level']];
				else:
					$readingString .= 'Sin especificar';
				endif;
				($numReading > 0) ? $readingString .= ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$readingString);
		endif;

		if(isset($dato['CompanyJobLanguage'])):
			//Niveles writing_level
			$writingString = '';
			$numWriting = count($dato['CompanyJobLanguage']);
			foreach($dato['CompanyJobLanguage'] as $writing):
				$numWriting--;
				if($NivelesIdioma[$writing['writing_level']]):
					$writingString .= $NivelesIdioma[$writing['writing_level']];
				else:
					$writingString .= 'Sin especificar';
				endif;
				($numWriting > 0) ? $writingString .= ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$writingString);
		endif;

		if(isset($dato['CompanyJobLanguage'])):
			//Niveles conversation_level
			$conversationString = '';
			$numConversation = count($dato['CompanyJobLanguage']);
			foreach($dato['CompanyJobLanguage'] as $conversation):
				$numConversation--;
				if($NivelesIdioma[$conversation['conversation_level']] <> ''):
					$conversationString .= $NivelesIdioma[$conversation['conversation_level']];
				else:
					$conversationString .= 'Sin especificar';
				endif;
				($numConversation > 0) ? $conversationString .= ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$conversationString);
		endif;
		
		if(isset($dato['CompanyJobComputingSkill'])):
			$categoriaString = '';
			$numeroCategorias = count($dato['CompanyJobComputingSkill']);
			foreach($dato['CompanyJobComputingSkill'] as $companyJobComputingSkill):
				$numeroCategorias--;
				if($Tecnologias[$companyJobComputingSkill['category_id']] <> ''):
					$categoriaString .= $Tecnologias[$companyJobComputingSkill['category_id']];
				else:
					$categoriaString .= 'Sin especificar';
				endif;
				($numeroCategorias > 0) ? $categoriaString .=  ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$categoriaString);
		endif;

		if(isset($dato['CompanyJobComputingSkill'])):
			// Nombre computo
			$nombreString = '';
			$numeroNombre = count($dato['CompanyJobComputingSkill']);
			foreach($dato['CompanyJobComputingSkill'] as $companyJobComputingName):
				$numeroNombre--;
				if($companyJobComputingName['name'] <> ''):
					$nombreString .= $Programas[$companyJobComputingName['name']];
				else:
					$nombreString .= $companyJobComputingName['name'];
				endif;
				($numeroNombre > 0) ? $nombreString .=  ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$nombreString);
		endif;

		if(isset($dato['CompanyJobComputingSkill'])):
			// Nivel Computo
			$nivelComputoString = '';
			$numeroNivelComputo = count($dato['CompanyJobComputingSkill']);
			foreach($dato['CompanyJobComputingSkill'] as $companyJobComputingLevel):
				$numeroNivelComputo--;
				if($NivelesSoftware[$companyJobComputingLevel['level']] <> ''):
					$nivelComputoString .= $NivelesSoftware[$companyJobComputingLevel['level']];
				else:
					$nivelComputoString .= 'Sin especificar';
				endif;
				($numeroNivelComputo > 0) ? $nivelComputoString .=  ';' : '';
			endforeach;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$nivelComputoString);
		endif;
		
		// Nivel Computo
		$nivelAcademicoString = '';
		$numeroNivelAcademico = count($dato['CompanyCandidateProfile']);
		foreach($dato['CompanyCandidateProfile'] as $companyCandidateProfileLevel):
			$numeroNivelAcademico--;
			if($companyCandidateProfileLevel['AcademicLevel']['academic_level'] <> ''):
				$nivelAcademicoString .= $companyCandidateProfileLevel['AcademicLevel']['academic_level'];
			else:
				$nivelAcademicoString .= 'Sin especificar';
			endif;
			($numeroNivelAcademico > 0) ? $nivelAcademicoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$nivelAcademicoString);

		
		// Carreas / Áreas
		$numeroNivelAcademico = count($dato['CompanyCandidateProfile']);
		$CarrerasAreasString = '';
		foreach($dato['CompanyCandidateProfile'] as $companyCandidateProfileCarreras):
			
			$numeroNivelAcademico--;
			$numeroCarreras = count($companyCandidateProfileCarreras['CompanyJobRelatedCareer']);
			
			
			foreach($companyCandidateProfileCarreras['CompanyJobRelatedCareer'] as $carrera):
				$numeroCarreras--;
				
				if($companyCandidateProfileCarreras['academic_level_id']==1):
					$CarrerasAreasString .= $careers[$carrera['career_id']];
				else:
					$CarrerasAreasString .= $AreasPosgrado[$carrera['career_id']];
				endif;
				
				
				($numeroCarreras > 0) ? $CarrerasAreasString .=  '/' : '';
			endforeach;
			($numeroNivelAcademico > 0) ? $CarrerasAreasString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$CarrerasAreasString);

		
		// Nivel Computo
		$situacionAcademicoString = '';
		$numeroNivelAcademico = count($dato['CompanyCandidateProfile']);
		foreach($dato['CompanyCandidateProfile'] as $companyCandidateProfileSituation):
			$numeroNivelAcademico--;
			$situacionAcademicoString .= $companyCandidateProfileSituation['AcademicSituation']['academic_situation'];
			($numeroNivelAcademico > 0) ? $situacionAcademicoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$situacionAcademicoString);
		
		
		//Semestre
		$SemestreAcademicoString = '';
		$numeroNivelAcademico = count($dato['CompanyCandidateProfile']);
		foreach($dato['CompanyCandidateProfile'] as $companyCandidateProfileSituation):
			$numeroNivelAcademico--;
			if($companyCandidateProfileSituation['semester']<>''):
				$SemestreAcademicoString .= $companyCandidateProfileSituation['semester'].'° Semestre';
			else:
				$SemestreAcademicoString .= 'Sin Semestre';
			endif;
			($numeroNivelAcademico > 0) ? $SemestreAcademicoString .=  ';' : '';
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($indiceColumna++.$i,$SemestreAcademicoString);
		
	$i++;
	}
	
	
	$objPHPExcel->getActiveSheet()->setTitle('Administrar ofertas');
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Administrar ofertas.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>