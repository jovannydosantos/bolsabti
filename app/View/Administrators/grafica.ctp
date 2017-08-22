<?php
	App::import('Vendor', 'Classes/PHPExcel');
		
	$workbook = new PHPExcel();
	$workbook->getProperties()->setCreator("SISBUT UNAM")
								 ->setLastModifiedBy("SISBUT UNAM")
								 ->setTitle("Informe de ".$nombreInforme)
								 ->setSubject("Informe de ".$nombreInforme)
								 ->setDescription("Informe de ".$nombreInforme)
								 ->setKeywords("Informe de ".$nombreInforme)
								 ->setCategory("Informe de ".$nombreInforme);
    $sheet = $workbook->getActiveSheet();
		
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
		
	/*----Titulos y estilos------*/
		$workbook->setActiveSheetIndex(0)->setCellValue('A1','SISBUT UNAM');
		$workbook->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$workbook->setActiveSheetIndex(0)->mergeCells('A2:E2');
		$workbook->setActiveSheetIndex(0)->setCellValue('A2','Informe de '.$nombreInforme);
		$letraSerie = 'B'; //Valor donde termina la leyenda de grafica
		$plotOrder =  array(0,1); //Valor general del rango de valores que puede tomar para las leyendas
		
		if($tipoInforme==0): //Curriculums
			$arrayDescription = array('Fechas','Activos','Inactivos','Totales');
			$columnaFin = 3;
		else:
			if($tipoInforme==1): //Empresas
				$arrayDescription = array('Fechas','Activas','Inactivas','Por expirar','Expiradas','Pendientes','Totales');
				foreach($Giros as $giro):
					$arrayDescription[] = $giro;
				endforeach;
				$columnaFin = 26;
				$plotOrder =  array(0,1,2,3);
				$letraSerie = 'E';
			else:
				if($tipoInforme==2): //Ofertas
					$arrayDescription = array('Fechas','Activas','Inactivas','Vacantes','Por expirar','Expiradas','Totales');
					foreach($Giros as $giro):
						$arrayDescription[] = $giro;
					endforeach;
					$columnaFin = 26;
					$plotOrder =  array(0,1,2,3);
					$letraSerie = 'E';
				else:
					if($tipoInforme==3): //Postulaciones
						$arrayDescription = array('Fechas','Ofertas activas','Ofertas con postulación','Postulaciones');
						foreach($Giros as $giro):
							$arrayDescription[] = $giro;
						endforeach;
						$columnaFin = 23;
					else:
						if(($tipoInforme==4) OR ($tipoInforme==5)): //Notificaciones telefónicas
							$arrayDescription = array('Fechas','Confirmadas','No confirmadas','Total');
							$columnaFin = 3;
						else:
							if($tipoInforme==6): //Contrataciones
								$arrayDescription = array('Fechas','Contratados','No contratados','Total');
								$columnaFin = 3;
							else:
								if(($tipoInforme==7) OR ($tipoInforme==8)): //Estudiantes eliminados //Empresas eliminadas
									$arrayDescription = array('Fechas','Total');
									$columnaFin = 1;
									$plotOrder =  array(0);
									$letraSerie = 'B';
								else:
									if($tipoInforme==9): //Encuestas estuadiantes
										$arrayDescription = array('Fechas','Fui contratado en que encontré en este sistema','Ya tengo trabajo','No estoy en búsqueda de empleo','Estoy estudiando y no busco trabajo','Otro','Total');
										$columnaFin = 6;
										$plotOrder =  array(0,1,2,3,4);
										$letraSerie = 'F';
									else:
										if($tipoInforme==10): //Encuestas empresas
											$arrayDescription = array('Fechas','Cubrimos  la(s) vacantes  por  este  medio','Cubrimos  la(s) vacantes  por  otro medio ','Por  el momento no tenemos  más  ofertas  ','El  servicio no fue  de  utilidad','Por  cierre de  operaciones ','Por  cambio de  razón social ','Total');
											$columnaFin = 7;
											$plotOrder =  array(0,1,2,3,4,5);
											$letraSerie = 'G';
										else:
											if($tipoInforme==11): //Competencias
												$arrayDescription = array('Fechas','ADAPTABILIDAD','APRENDIZAJE CONTUNUO','CONFIANZA','ENERGIA','IMPACTO','INICIATIVA','INTEGRIDAD','TOLERANCIA AL ESTRÉS','CREATIVIDAD - INNOVACIÓN','TENACIDAD','ASESORIA', 'COMUNICACIÓN','TRABAJO EN EQUIPO','LIDERZGO','COMPARTIENDO RESPONSABILIDAD','PARTICIPACIÓN EN REUNIONES','TOMA DE DECISIONES','PLANEACIÓN Y ORGANIZACIÓN','ORIENTACION AL CLIENTE','HABILIDAD DE PERSUASIÓN','Total');
												$columnaFin = 21;
												$plotOrder =  array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19);
												$letraSerie = 'U';
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			endif;
		endif;
		
		$columna = 'A';
		for($i = 0; $i <= $columnaFin; $i++){	 
			 $workbook->getActiveSheet()->setCellValueByColumnAndRow($i, 5, $arrayDescription[$i]);
			 $workbook->getActiveSheet()->getStyle($columna.'5')->getFont()->setSize(11); 
			 $workbook->getActiveSheet()->getColumnDimension($columna)->setAutoSize(true);
			 $workbook->getActiveSheet()->getStyle($columna++.'5')->getFont()->setBold(true);
		}
		$endLine = 'A';
		for($i = 0; $i < $columnaFin; $i++){	
			$endLine++;
		}
		
		$workbook->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$workbook->getActiveSheet()->getStyle('A2:'.$endLine.'2')->applyFromArray($styleBorderArray);
		
		$workbook->getActiveSheet()->getStyle('A3:'.$endLine.'3')->applyFromArray($styleTextArray2);
		$workbook->getActiveSheet()->getStyle('A3:'.$endLine.'3')->applyFromArray($styleBorderArray2);
		
		$workbook->getActiveSheet()->getStyle('A4:'.$endLine.'4')->applyFromArray($styleTextArray);
		$workbook->getActiveSheet()->getStyle('A4:'.$endLine.'4')->applyFromArray($styleBorderArray);
	/*----/Titulos y estilos------*/

		// Si el tipo de descarga es por dia y el tipo de informe es por curriculum
		if($tipoInforme==0): //Curriculums
				$con = 6;
				$fechaAnterior = '';
				$ban = 0;
				foreach($datos as $dato):
					if($statusFecha==1):
						$fecha = $dato['Student']['created'];
					else:
						if($statusFecha==2):
							$fecha = date("Y-m", strtotime($dato['Student']['created']));
						else:
							if($statusFecha==3):
								$fecha = date("Y", strtotime($dato['Student']['created']));
							endif;
						endif;
					endif;
					
					if($ban==1):
						$fechaEntrada = $fecha;
						if($fechaAnterior <> $fechaEntrada):
							$con++;
							$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaEntrada);
							$fechaAnterior = $fechaEntrada;
						endif;
					else:
						$fechaAnterior = $fecha;
						$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
					endif;
					
					if($dato['Student']['status']==1):
						$valor = $dato[0]['totalStatus']+$workbook->getActiveSheet()->getCell('B'.$con)->getValue();
						$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$valor);
					else:
						$valor = $dato[0]['totalStatus']+$workbook->getActiveSheet()->getCell('C'.$con)->getValue();
						$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,$valor);
					endif;
					
					$ban = 1;
				endforeach;
				
				for($con2 = 6; $con2 <= $con; $con2++):
					$workbook->getActiveSheet()->setCellValue('D'.$con2,'=SUM(B'.$con2.':C'.$con2.')');
				endfor;
		else:
			if($tipoInforme==1): //Empresas
					$con = 6;
					$fechaAnterior = '';
					$ban = 0;
					$index = 6;
					
					foreach($datos as $dato):
						$columna = 'G'; 
						for($i = 1; $i <=$dato['CompanyProfile']['company_rotation']; $i++){$columna++;} //Verifica en que columna se encuentra el giro
						
						$valor = $porexpirar[$index]+$workbook->getActiveSheet()->getCell($columna.$con)->getValue();
						$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$valor+1);
									
						if($statusFecha==1):
							$fecha = $dato['Company']['created'];
						else:
							if($statusFecha==2):
								$fecha = date("Y-m", strtotime($dato['Company']['created']));
							else:
								if($statusFecha==3):
									$fecha = date("Y", strtotime($dato['Company']['created']));
								endif;
							endif;
						endif;
						
						if($ban==1):
							$fechaEntrada = $fecha;
							if($fechaAnterior <> $fechaEntrada):
								$con++;
								$fechaAnterior = $fechaEntrada;
								$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaEntrada);
								$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$porexpirar[$index]);
								$workbook->setActiveSheetIndex(0)->setCellValue('E'.$con,$expiradas[$index]);
								$workbook->setActiveSheetIndex(0)->setCellValue('F'.$con,$pendientes[$index]);
							else:
								if(($statusFecha==2) OR ($statusFecha==3)):
									$valor = $porexpirar[$index]+$workbook->getActiveSheet()->getCell('D'.$con)->getValue();
									$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$valor);
									$valor = $expiradas[$index]+$workbook->getActiveSheet()->getCell('E'.$con)->getValue();
									$workbook->setActiveSheetIndex(0)->setCellValue('E'.$con,$valor);
									$valor = $pendientes[$index]+$workbook->getActiveSheet()->getCell('F'.$con)->getValue();
									$workbook->setActiveSheetIndex(0)->setCellValue('F'.$con,$valor);
								else:
									$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$porexpirar[$index]);
									$workbook->setActiveSheetIndex(0)->setCellValue('E'.$con,$expiradas[$index]);
									$workbook->setActiveSheetIndex(0)->setCellValue('F'.$con,$pendientes[$index]);
								endif;
							endif;
						else:
							$fechaAnterior = $fecha;
							$ban = 1;
							$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
							$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$porexpirar[$index]);
							$workbook->setActiveSheetIndex(0)->setCellValue('E'.$con,$expiradas[$index]);
							$workbook->setActiveSheetIndex(0)->setCellValue('F'.$con,$pendientes[$index]);
						endif;
						
						if($dato['Company']['status']==1):
							$valor = $dato[0]['totalStatus']+$workbook->getActiveSheet()->getCell('B'.$con)->getValue();
							$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$valor);
						else:
							$valor = $dato[0]['totalStatus']+$workbook->getActiveSheet()->getCell('C'.$con)->getValue();
							$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,$valor);
						endif;
						$index++;
					endforeach;

					for($con2 = 6; $con2 <= $con; $con2++):
						$workbook->getActiveSheet()->setCellValue('G'.$con2,'=SUM(B'.$con2.':C'.$con2.')');
					endfor;
					
			else:
				if($tipoInforme==2): //Ofertas
						$con = 6;
						$index = 6;
						$conVacantes = 6;
						$fechaAnterior = '';
						$ban = 0;
						foreach($datos as $dato):
							$columna = 'G'; 
							for($i = 1; $i <=$dato['CompanyJobProfile']['rotation']; $i++){$columna++;} //Verifica en que columna se encuentra el giro
							
							if($statusFecha==1):
								$fecha = $dato['CompanyJobProfile']['created'];
							else:
								if($statusFecha==2):
									$fecha = date("Y-m", strtotime($dato['CompanyJobProfile']['created']));
								else:
									if($statusFecha==3):
										$fecha = date("Y", strtotime($dato['CompanyJobProfile']['created']));
									endif;
								endif;
							endif;
								
							if($ban==1):
								$fechaEntrada = $fecha;
								if($fechaAnterior == $fechaEntrada):
									if($dato['CompanyJobContractType']['status']==1):
										$valor = $dato[0]['totalStatus']+$workbook->getActiveSheet()->getCell('B'.$con)->getValue();
										$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$valor);
										$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$dato[0]['totalGiro']);//Solo para activas 
									else:
										$valor = $dato[0]['totalStatus']+$workbook->getActiveSheet()->getCell('C'.$con)->getValue();
										$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,$valor);
									endif;

									$conVacantes++;
									$SumaVacantes = 0;
									foreach($vacantes[$conVacantes] as $numVacantes):
										$SumaVacantes = $SumaVacantes + $numVacantes;
									endforeach;
									$valor = $SumaVacantes +$workbook->getActiveSheet()->getCell('D'.$con)->getValue();
									$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$valor);
									$valor = $porexpirar[$index]+$workbook->getActiveSheet()->getCell('E'.$con)->getValue();
									$workbook->setActiveSheetIndex(0)->setCellValue('E'.$con,$valor);
									$valor = $expiradas[$index] +$workbook->getActiveSheet()->getCell('F'.$con)->getValue();
									$workbook->setActiveSheetIndex(0)->setCellValue('F'.$con,$valor);	
								else:
									$fechaAnterior = $fechaEntrada;
									$con++;
									$conVacantes++;
									$SumaVacantes = 0;
									foreach($vacantes[$conVacantes] as $numVacantes):
										$SumaVacantes = $SumaVacantes + $numVacantes;
									endforeach;
									$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaEntrada);
									if($dato['CompanyJobContractType']['status']==1):
										$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$dato[0]['totalStatus']);
										$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$dato[0]['totalGiro']);//Solo para activas
									else:
										$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,$dato[0]['totalStatus']);
									endif;
									$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$SumaVacantes);
									$workbook->setActiveSheetIndex(0)->setCellValue('E'.$con,$porexpirar[$index]);
									$workbook->setActiveSheetIndex(0)->setCellValue('F'.$con,$expiradas[$index]);
									
								endif;
							else:
								$fechaAnterior = $fecha;
								$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
								if($dato['CompanyJobContractType']['status']==1):
									$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$dato[0]['totalStatus']);
									$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$dato[0]['totalGiro']);//Solo para activas
								else:
									$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,$dato[0]['totalStatus']);
								endif;
								
								$SumaVacantes = 0;
								foreach($vacantes[$conVacantes] as $numVacantes):
									$SumaVacantes = $SumaVacantes + $numVacantes;
								endforeach;
								$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$SumaVacantes);
								$workbook->setActiveSheetIndex(0)->setCellValue('E'.$con,$porexpirar[$index]);
								$workbook->setActiveSheetIndex(0)->setCellValue('F'.$con,$expiradas[$index]);
								$ban = 1;
							endif;
							$index++;
						endforeach;
						
						for($con2 = 6; $con2 <= $con; $con2++):
							$workbook->getActiveSheet()->setCellValue('G'.$con2,'=SUM(B'.$con2.':C'.$con2.')');
						endfor;
				else:
					if($tipoInforme==3): //Postulaciones
							$con = 6;
							$index = 0;
							$ban = 0;
							$onlyOfferId = array();
							foreach($datos as $oferta):
								if(!empty($oferta)):
									if($statusFecha==1):
										$fecha = $fechasPostulaciones[$index];
									else:
										if($statusFecha==2):
											$fecha = date("Y-m", strtotime($fechasPostulaciones[$index]));
										else:
											if($statusFecha==3):
												$fecha = date("Y", strtotime($fechasPostulaciones[$index]));
											endif;
										endif;
									endif;	
									
									if($ban==1):
										$fechaEntrada = $fecha;
										if($fechaAnterior <> $fechaEntrada):
											$fechaAnterior = $fechaEntrada;
											$con++;
											foreach($companyJobProfileIds[$index] as $idOffer):
												if(!in_array($idOffer, $onlyOfferId)):
													$onlyOfferId[] = $idOffer;
												endif;
											endforeach;
											$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,count($onlyOfferId));
											$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaEntrada);
											$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,count($onlyOfferId));
											$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,count($arrayTotalPostulaciones[$index]));
										else:
											$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,count($onlyOfferId));
											$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,count($onlyOfferId));
											$valor = count($arrayTotalPostulaciones[$index])+$workbook->getActiveSheet()->getCell('D'.$con)->getValue();
											$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,$valor);
										endif;
									else:
										foreach($companyJobProfileIds[$index] as $idOffer):
											if(!in_array($idOffer, $onlyOfferId)):
												$onlyOfferId[] = $idOffer;
											endif;
										endforeach;
										$fechaAnterior = $fecha;
										$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
										$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,count($onlyOfferId));
										$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,count($onlyOfferId));
										$workbook->setActiveSheetIndex(0)->setCellValue('D'.$con,count($arrayTotalPostulaciones[$index]));
										$ban=1;
									endif;
										
									foreach($oferta as $dato):
										$columna = 'D'; 
										for($i = 1; $i <=$dato['CompanyJobProfile']['rotation']; $i++){$columna++;} //Verifica en que columna se encuentra el giro
		
										if($fechaAnterior == $fecha):
											$valor = $dato[0]['total']+$workbook->getActiveSheet()->getCell($columna.$con)->getValue();
											$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$valor);	
										else:
											$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$dato[0]['total']);
										endif;
									endforeach;
									
								endif;
								$index++; //Para avanzar las fechas de postulaciones
							endforeach;	
					else:
						if(($tipoInforme==4) OR ($tipoInforme==5)): //Notificaciones telefonicas //Notificaciones Presenciales
								$con = 6;
								$ban = 0;

								foreach($datos as $dato):

									if($statusFecha==1):
										$fecha = $dato['StudentNotification']['company_interview_date'];
									else:
										if($statusFecha==2):
											$fecha = date("Y-m", strtotime($dato['StudentNotification']['company_interview_date']));
										else:
											if($statusFecha==3):
												$fecha = date("Y", strtotime($dato['StudentNotification']['company_interview_date']));
											endif;
										endif;
									endif;	
									
									if($ban==1):
										$fechaEntrada = $fecha;
										if($fechaAnterior <> $fechaEntrada):
											$fechaAnterior = $fechaEntrada;
											$con++;
											$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaEntrada);								
										endif;
									else:
										$fechaAnterior = $fecha;
										$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
										$ban = 1;
									endif;

									if(($dato['StudentNotification']['company_interview_status'] == 1) AND ($dato['StudentNotification']['student_interview_status'] == 1)):
										$valor = 1+$workbook->getActiveSheet()->getCell('B'.$con)->getValue();
										$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$valor);
									else:
										if(($dato['StudentNotification']['company_interview_status'] <> 1) OR ($dato['StudentNotification']['student_interview_status'] <> 1)):
											$valor = 1+$workbook->getActiveSheet()->getCell('C'.$con)->getValue();
											$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,$valor);
										endif;
									endif;		
								endforeach;
								
								for($con2 = 6; $con2 <= $con; $con2++):
									$workbook->getActiveSheet()->setCellValue('D'.$con2,'=SUM(B'.$con2.':C'.$con2.')');
								endfor;
						else:
							if($tipoInforme==6): //Contrataciones
									$con = 6;
									$ban = 0;
									foreach($datos as $dato):
										if($statusFecha==1):
											$fecha = $dato['Report']['fecha_contratacion'];
										else:
											if($statusFecha==2):
												$fecha = date("Y-m", strtotime($dato['Report']['fecha_contratacion']));
											else:
												if($statusFecha==3):
													$fecha = date("Y", strtotime($dato['Report']['fecha_contratacion']));
												endif;
											endif;
										endif;
											
										if($ban==1):
											$fechaEntrada = $fecha;
											if($fechaAnterior <> $fechaEntrada):
												$con++;
												$fechaAnterior = $fechaEntrada;
												$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaEntrada);			
											endif;
										else:
											$fechaAnterior = $fecha;
											$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
											$ban = 1;
										endif;
										
										if($dato['Report']['response_notification'] == 1):
											$valor = 1+$workbook->getActiveSheet()->getCell('B'.$con)->getValue();
											$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$valor);
										else:
											$valor = 1+$workbook->getActiveSheet()->getCell('C'.$con)->getValue();
											$workbook->setActiveSheetIndex(0)->setCellValue('C'.$con,$valor);
										endif;		
								
									endforeach;
									
									for($con2 = 6; $con2 <= $con; $con2++):
										$workbook->getActiveSheet()->setCellValue('D'.$con2,'=SUM(B'.$con2.':C'.$con2.')');
									endfor;
							else:
								if($tipoInforme==7): //Estudiantes eliminados
										$con = 6;
										$ban = 0;
										foreach($datos as $dato):
											if($statusFecha==1):
												$fecha = $dato['StudentDisabled']['created'];
											else:
												if($statusFecha==2):
													$fecha = date("Y-m", strtotime($dato['StudentDisabled']['created']));
												else:
													if($statusFecha==3):
														$fecha = date("Y", strtotime($dato['StudentDisabled']['created']));
													endif;
												endif;
											endif;
										
											if($ban==1):
												$fechaEntrada = $fecha;
												if($fechaAnterior <> $fechaEntrada ):
													$con++;
													$fechaAnterior = $fechaEntrada;
												endif;
											else:
												$fechaAnterior = $fecha;
												$ban = 1;
											endif;
											
											$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
											$valor = 1+$workbook->getActiveSheet()->getCell('B'.$con)->getValue();
											$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$valor);
										endforeach;
										
								else:
									if($tipoInforme==8): //Empresas eliminadas
											$con = 6;
											$ban = 0;
											foreach($datos as $dato):
												if($statusFecha==1):
													$fecha = $dato['CompanyDisabled']['created'];
												else:
													if($statusFecha==2):
														$fecha = date("Y-m", strtotime($dato['CompanyDisabled']['created']));
													else:
														if($statusFecha==3):
															$fecha = date("Y", strtotime($dato['CompanyDisabled']['created']));
														endif;
													endif;
												endif;
												
												if($ban==1):	
													$fechaEntrada = $fecha;
													if($fechaAnterior <> $fechaEntrada ):
														$con++;
														$fechaAnterior = $fechaEntrada;
													endif;
												else:
													$fechaAnterior = $fecha;
													$ban = 1;
												endif;
												
												$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
												$valor = 1+$workbook->getActiveSheet()->getCell('B'.$con)->getValue();
												$workbook->setActiveSheetIndex(0)->setCellValue('B'.$con,$valor);
											endforeach;
									else:
										if($tipoInforme==9): //Encuesta universitarios
												$con = 6;
												$ban = 0;
												foreach($datos as $dato):
													if($statusFecha==1):
														$fecha = $dato['StudentAnswer']['created'];
													else:
														if($statusFecha==2):
															$fecha = date("Y-m", strtotime($dato['StudentAnswer']['created']));
														else:
															if($statusFecha==3):
																$fecha = date("Y", strtotime($dato['StudentAnswer']['created']));
															endif;
														endif;
													endif;
													if($ban==1):
														$fechaEntrada = $fecha;
														if($fechaAnterior <> $fechaEntrada ):
															$con++;
															$fechaAnterior = $fechaEntrada;
														endif;
													else:
														$fechaAnterior = $fecha;
														$ban = 1;
													endif;
													
													$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
													$columna = 'A'; 
													for($i = 1; $i <=$dato['StudentAnswer']['answer']; $i++){$columna++;} 
													
													$valor = 1+$workbook->getActiveSheet()->getCell($columna.$con)->getValue();
													$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$valor);
													
													for($con2 = 6; $con2 <= $con; $con2++):
														$workbook->getActiveSheet()->setCellValue('G'.$con2,'=SUM(B'.$con2.':F'.$con2.')');
													endfor;
													
												endforeach;
										else:
											if($tipoInforme==10): //Encuesta Empresas
													$con = 6;
													$ban = 0;
													foreach($datos as $dato):
														if($statusFecha==1):
															$fecha = $dato['CompanyAnswer']['created'];
														else:
															if($statusFecha==2):
																$fecha = date("Y-m", strtotime($dato['CompanyAnswer']['created']));
															else:
																if($statusFecha==3):
																	$fecha = date("Y", strtotime($dato['CompanyAnswer']['created']));
																endif;
															endif;
														endif;
														
														if($ban==1):
															$fechaEntrada = $fecha;
															if($fechaAnterior <> $fechaEntrada ):
																$con++;
																$fechaAnterior = $fechaEntrada;
															endif;
														else:
															$fechaAnterior = $fecha;
															$ban = 1;
														endif;
														
														$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con,$fechaAnterior);
														$columna = 'A'; 
														for($i = 1; $i <=$dato['CompanyAnswer']['answer']; $i++){$columna++;} 
														
														$valor = 1+$workbook->getActiveSheet()->getCell($columna.$con)->getValue();
														$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$valor);
														
														for($con2 = 6; $con2 <= $con; $con2++):
															$workbook->getActiveSheet()->setCellValue('H'.$con2,'=SUM(B'.$con2.':G'.$con2.')');
														endfor;
														
													endforeach;
											else:
												if($tipoInforme==11): //Competencias
														$con = 6;
														$index = 6;
														$ban = 0;
														foreach($datos as $competencias):
															if($statusFecha==1):
																$fecha = $fechas[$index];
															else:
																if($statusFecha==2):
																	$fecha = date("Y-m", strtotime($fechas[$index]));
																else:
																	if($statusFecha==3):
																		$fecha = date("Y", strtotime($fechas[$index]));
																	endif;
																endif;
															endif;
															
															if($ban==1):
																$fechaEntrada = $fecha;
																if($fechaAnterior <> $fechaEntrada):
																	$con++;
																	$fechaAnterior = $fechaEntrada;	
																	$workbook->setActiveSheetIndex(0)->setCellValue('V'.$con,1);
																else:
																	$valor = 1+$workbook->getActiveSheet()->getCell('V'.$con)->getValue();
																	$workbook->setActiveSheetIndex(0)->setCellValue('V'.$con,$valor);
																endif;
															else:
																$fechaAnterior = $fecha;
																$workbook->setActiveSheetIndex(0)->setCellValue('V'.$con,1);
																$ban = 1;
															endif;														
															
															foreach($competencias as $competencia):
																$workbook->setActiveSheetIndex(0)->setCellValue('A'.$con, $fechaAnterior);
																$columna = 'A'; 
																for($i = 1; $i <=$competencia['StudentProfessionalSkill']['competency_id']; $i++){$columna++;} //Verifica en que columna se encuentra la competencia	
																$valor = 1+$workbook->getActiveSheet()->getCell($columna.$con)->getValue();
																$workbook->setActiveSheetIndex(0)->setCellValue($columna.$con,$valor);
															endforeach;	

															$index++;
														endforeach;
												endif;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			endif;	
		endif;
		
		if(($statusFecha==2) OR ($statusFecha==3)):
			if(($tipoInforme==0) OR ($tipoInforme==3)  OR ($tipoInforme==4) OR ($tipoInforme==5)  OR ($tipoInforme==6)):
				$labels = array(
					new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$5', null, 3),
					new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$5', null, 3),
				);
				$values = array(
					new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$6:$B$'.$con, null, 12),  
					new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$6:$C$'.$con, null, 12), 			   
				);
			else:
				if(($tipoInforme==1) OR ($tipoInforme==2)):
					$labels = array(
						new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$5', null, 3),
						new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$5', null, 3),
						new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$D$5', null, 3),
						new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$E$5', null, 3),
					);
					$values = array(
						new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$6:$B$'.$con, null, 12),  
						new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$6:$C$'.$con, null, 12), 			  
						new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$6:$D$'.$con, null, 12), 
						new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$6:$E$'.$con, null, 12),  
					);
				else:
					if(($tipoInforme==7) OR ($tipoInforme==8)):
						$labels = array(
							new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$5', null, 3),
						);
						$values = array(
							new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$6:$B$'.$con, null, 12),    
						);
					else:
						if($tipoInforme==9):
							$labels = array(
								new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$5', null, 4),
								new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$5', null, 4),
								new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$D$5', null, 4),
								new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$E$5', null, 4),
								new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$F$5', null, 4),
							);
							$values = array(
								new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$6:$B$'.$con, null, 12),  
								new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$6:$C$'.$con, null, 12), 			  
								new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$6:$D$'.$con, null, 12), 
								new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$6:$E$'.$con, null, 12),  
								new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$F$6:$F$'.$con, null, 12),  
							);
						else:
							if($tipoInforme==10):
								$labels = array(
									new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$5', null, 4),
									new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$5', null, 4),
									new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$D$5', null, 4),
									new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$E$5', null, 4),
									new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$F$5', null, 4),
									new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$G$5', null, 4),
								);
								$values = array(
									new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$6:$B$'.$con, null, 12),  
									new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$6:$C$'.$con, null, 12), 			  
									new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$6:$D$'.$con, null, 12), 
									new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$6:$E$'.$con, null, 12),  
									new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$F$6:$F$'.$con, null, 12), 
									new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$G$6:$G$'.$con, null, 12),  									
								);
							else:
								if($tipoInforme==11):
									$labels = array(
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$D$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$E$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$F$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$G$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$H$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$I$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$J$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$K$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$L$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$M$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$N$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$O$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$P$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$Q$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$R$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$S$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$T$5', null, 4),
										new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$U$5', null, 4),
									);
									$values = array(
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$6:$B$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$6:$C$'.$con, null, 12), 			  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$6:$D$'.$con, null, 12), 
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$6:$E$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$F$6:$F$'.$con, null, 12), 
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$G$6:$G$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$H$6:$H$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$I$6:$I$'.$con, null, 12), 			  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$J$6:$J$'.$con, null, 12), 
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$K$6:$K$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$L$6:$L$'.$con, null, 12), 
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$M$6:$M$'.$con, null, 12),  		
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$N$6:$N$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$O$6:$O$'.$con, null, 12), 			  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$P$6:$P$'.$con, null, 12), 
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$Q$6:$Q$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$R$6:$R$'.$con, null, 12), 
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$S$6:$S$'.$con, null, 12), 
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$T$6:$T$'.$con, null, 12),  
										new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$U$6:$U$'.$con, null, 12), 			   												
									);
								endif;
							endif;
						endif;
					endif;
				endif;
			endif;
			
			$categories = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$6:$A$'.$con, null, 12),
			);

			$series = new PHPExcel_Chart_DataSeries(
			  PHPExcel_Chart_DataSeries::TYPE_BARCHART,     	// plotType
			  PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  	// plotGrouping
			  $plotOrder,                                   	// plotOrder
			  $labels,                                        	// plotLabel
			  $categories,                                 		// plotCategory
			  $values                                        	// plotValues
			);  
			
			if($tipoInforme==11):
				$extraColumns = $con + 15;
				$bottom = '23';
				$legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_BOTTOM, null, false);
			else:
				$extraColumns = ($con / 2) + 8;
				$bottom = '16';
				$legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
			endif;
			
			$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
			$layout1  = new PHPExcel_Chart_Layout();    		// Create object of chart layout to set data label 
			$layout1->setShowVal(TRUE);   
			$plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
			$title    = new PHPExcel_Chart_Title('Informe de '.$nombreInforme);  
			$xTitle   = new PHPExcel_Chart_Title('Fechas');
			$yTitle   = new PHPExcel_Chart_Title($nombreInforme);
			$chart    = new PHPExcel_Chart(
											'chart',        // name
											$title,          // title
											$legend,		 // legend 
											$plotarea,       // plotArea
											true,            // plotVisibleOnly
											0,               // displayBlanksAs
											$xTitle,         // xAxisLabel
											$yTitle          // yAxisLabel
			); 
			
			for($i = 0; $i < 2; $i++){	
				$endLine++;
			}
			$chart->setTopLeftPosition($endLine.'2');
			
			for($i = 0; $i < $extraColumns; $i++){	
				$endLine++;
			}
			
			$chart->setBottomRightPosition($endLine.$bottom);
			$sheet->addChart($chart);
		endif;
	
		// echo '<pre>';
		// print_r($datos);
		// echo '</pre>';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Informe de '.$nombreInforme.'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
		$writer->setIncludeCharts(TRUE);
		$writer->save('php://output');
		exit;
?>