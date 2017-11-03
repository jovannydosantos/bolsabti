<?php 
	$this->layout = 'company'; 
?>

<?php
	ini_set('memory_limit', '256M');
	ini_set('max_execution_time', 60);
    
	$companyexp = ''; 
	$areaexp = ''; 
	$fechexp = ''; 
	$puestexp = ''; 
	$titref = ''; 
	$titexp = ''; 
	$arearesp = '';
	$titlogs = ''; 
	$areaslogr = ''; 
	$experienciasall = '';
    $contador = 1;
	
	foreach($student['StudentProfessionalExperience'] as $k => $experiencia):
       
		$companyName =  $experiencia['company_name'];
		
		foreach($experiencia['StudentWorkArea'] as $k => $puesto):
			$anosExperiencia = 0;
            $mesesExperiencia = 0;
            $mesesToYear = 0;
            $resAnosExperiencia = 0;
            $fecha1 = new DateTime($puesto['start_date'] . "00:00:00");
			if(($puesto['end_date'] == '0000-00-00') || ($puesto['end_date'] == null)):
                $puesto['end_date'] = date ("Y/m/d");
                $fechexp = '<br /><table width="100%"><tr><td width="79%"><strong>'. $companyName .'</strong></td><td width="10%" style="text-align: center"><strong>'.date("m-Y",strtotime($puesto['start_date'])).'</strong></td><td width="1%">/</td><td width="10%" style="text-align: center"><strong>Actual</strong></td></tr></table>';
            else:
                $fechexp = '<br /><table width="100%"><tr><td width="79%"><strong>'. $companyName .'</strong></td><td width="10%" style="text-align: center"><strong>'.date("m-Y",strtotime($puesto['start_date'])).'</strong></td><td width="1%">/</td><td width="10%" style="text-align: center"><strong>'.date("m-Y",strtotime($puesto['end_date'])).'</strong></td></tr></table>';
            endif;
            
			$fecha1 = new DateTime($puesto['start_date'] . "00:00:00");
            $fecha2 = new DateTime($puesto['end_date']. "00:00:00");
            $fecha = $fecha1->diff($fecha2);
            $anosExperiencia = $anosExperiencia + $fecha->y;
            $mesesExperiencia = $mesesExperiencia + $fecha->m;
            $mesesToYear = round ($mesesExperiencia / 12);
            $resAnosExperiencia = $anosExperiencia + $mesesToYear;
            
			if($resAnosExperiencia==0):
                $resAnosExperiencia = '<br /> menor a 6 meses';
            endif;

			$areaexp = '<table width="100%" ><tr><td width="78%">'.$puesto['ExperienceArea']['experience_area'].'</td><td width="38%">Años de experiencia: '.$resAnosExperiencia.' </td></tr></table>';
			$puestexp = '<table width="100%" ><br /><tr><td width="100%"><strong>'.$contador.'.- ' .$puesto['job_name'].'</strong></td></tr></table>';  
   
			if(!empty($puesto['StudentResponsability'])): 
				$titexp = '<table width="100%" ><tr><td width="100%"><strong>Principales Responsabilidades:</strong></td></tr></table>';              

				foreach($puesto['StudentResponsability'] as $k => $experiencias):
					$arearesp .= '<table width="100%" ><tr><td width="98%"><ul><li>' . $experiencias['responsability'] . '</li></ul></td><td width="2%"></td></tr></table>';
                endforeach;
			endif;
		   
			if(!empty($puesto['StudentAchievement'])):           
				$titlogs = '<br /><table width="100%" ><tr><td width="100%"><strong>Principales Logros:</strong></td></tr></table>';
				foreach($puesto['StudentAchievement'] as $k => $logros):
                    $areaslogr .='<table width="100%" ><tr><td width="98%"><ul><li>' . $logros['achievement'] .'</li></ul></td><td width="2%"></td></tr></table>';
				endforeach; 
			endif; 
			
			$experienciasall .= $fechexp.$areaexp.$puestexp.$titexp.$arearesp.$titlogs.$areaslogr;      
			$companyexp = ''; $areaexp = '';$fechexp = ''; $puestexp = ''; $titref = ''; $titexp = ''; $arearesp = '';$areaslogr = '';
			$contador++;
        endforeach;
	endforeach; 

	if($experienciasall<>''):
		$experiencias1 = '<br /><span><strong>EXPERIENCIA PROFESIONAL</strong></span><br />';
		$experiencias2 = $experiencias1.$experienciasall; 
	else:
		$experiencias2 = ''; 
	endif;
	 
//------------------------ VALIDA PROYECTOS EXTRACURICULAES -------------------------------------------------

  $experiencias1p = '';
  $experiencias2p = ''; 
 
   if(!empty($student['StudentAcademicProject'])):   
         $experienciasallp = '';
        foreach($student['StudentAcademicProject'] as $k => $proyecto):
            $areaexpp = ''; $fechexpp = ''; $empInst = ''; $nomPais = '';  $titexpp = ''; $arearespp = ''; $titlogsp = ''; $areaslogrp = ''; 
        
            $fechexpp = '<br /><span><strong>'.$proyecto['name'].'</strong></span>';
            $empInst  = '<br /><span><strong>'.$proyecto['company'].'</strong></span>';
            $nomPais  = '<br /><span><strong>País: '.$Paises[$proyecto['country']].'</strong></span>';
            
            $titexpp   = '<br /><br /><span><strong>Principales Responsabilidades</strong></span>';              
            $arearespp = '<br /><table width="100%"><tr><td width="98%"><ul><li>'.$proyecto['responsability'].'</li></ul></td></tr></table>';

            $titlogsp   = '<span><strong>Principales Logros</strong></span>';
            $areaslogrp = '<br /><table width="100%"><tr><td width="98%"><ul><li>'.$proyecto['achievement'].'</li></ul></td></tr></table>';

            $experienciasallp .= $fechexpp.$empInst.$nomPais.$titexpp.$arearespp.$titlogsp.$areaslogrp;

        endforeach;
        $experiencias1p = '<span><strong>PROYECTOS EXTRACURRICULARES</strong></span>';
        $experiencias2p = $experiencias1p.$experienciasallp;   
  endif; 

	//------------------------ CIERRE VALIDA PROYECTOS ACADEMICOS -------------------------------------------------

	// atrapa idiomas
	$idio1 = '';
	$idio2 = '';     
	$numidio = 0;
    $fcmdidio ='';
	
	if(!empty($student['StudentLenguage'])):
		foreach($student['StudentLenguage'] as $k => $idioma):
			$fcmdidio='Conversación - '.$NivelesIdioma[$idioma['conversation_level']];
            $idio1 .= '<tr><td width="22%">'.$idioma['Lenguage']['lenguage'] .'</td><td width="25%">Lectura - '.$NivelesIdioma[$idioma['reading_level']]. '</td><td width="25%">Escritura - '.$NivelesIdioma[$idioma['writing_level']]. '</td><td width="25%">'.$fcmdidio.'</td></tr>';  
			$numidio++;
        endforeach; 
		
		$idio2 = '<br /><table width="100%" ><tr><td><strong>IDIOMAS</strong></td></tr></table>';
        if($numidio > 0):
			$idio2 .='<table width="100%" >'.$idio1.'</table>';
		endif;
    endif;
	
	// atrapa conocimientos
	$cono1 = '';
	$cono2 = '';     
	$numcono = 0;
    $fcmdcono ='';
	
	if(!empty($student['StudentJobSkill'])):
		foreach($student['StudentJobSkill'] as $k => $curso):
			$fcmdcono='';
            $cono1 .= '<tr><td width="32%" style="text-align: left">'.$TipoCursos[$curso['type_course_id']].'</td><td width="32%" style="text-align: left">'.$curso['name'].'</td><td width="30%" style="text-align: left">'.$curso['company']. '</td><td width="6%">'.$fcmdcono.'</td></tr>';  
			$numcono++;
        endforeach; 

		$cono2 = '<br /><table width="100%"><tr><td><strong>CONOCIMIENTOS Y HABILIDADES PROFESIONALES</strong></td></tr></table>';
        if($numcono > 0):
			$cono2 .='<table width="100%" >'.$cono1.'</table>';
		endif;
    endif;

	// atrapa computo
	$compu1 = '';
	$compu2 = '';     
	$numcompu = 0;
	
	if(!empty($student['StudentTechnologicalKnowledge'])):

		foreach($student['StudentTechnologicalKnowledge'] as $k => $computo):
            $compu1 .= '<tr><td width="45%">'.$computo['Tecnology']['tecnology'].': ';
					
			if($computo['name']<>''):
				$compu1.= $software[$computo['name']].'</td>';
			else:
				$compu1.= $computo['other'].'</td>';
			endif;
					
			$compu1 .='<td width="25%">'.$NivelesSoftware[$computo['level']].'</td><td width="30%">';

			if($computo['institution']<>''):
				$compu1.= $computo['institution'].'</td></tr>'; 
			else:
				$compu1.= 'Ninguna</td></tr>';  
			endif;

			$numcompu++;
           
        endforeach; 
		
		$compu2 = '<table width="100%" ><tr><td><strong>CÓMPUTO</strong></td></tr></table>';
        $titulo = '<table width="100%" ><tr><td width="45%"><strong>Categoría y Nombre </strong></td><td  width="25%"><strong>Nivel </strong></td><td  width="30%"><strong>Certificación</strong></td></tr></table>';
		if($numcompu > 0):
			$compu2 .= $titulo.'<table width="100%" >'.$compu1.'</table>';
		endif;
    endif;

	$dispviaj = '';
	$dispchange = '';

    if($student['StudentProspect']['can_travel']=='s'):
        $dispviaj = '<table width="100%" ><tr><td><strong>Disponibilidad para viajar:</strong> Si</td></tr></table>';
        if($student['StudentProspect']['can_travel_option']=='1'):
            $dispviaj = '<table width="100%" ><tr><td><strong>Disponibilidad para viajar:</strong> Si, dentro del país</td></tr></table>';
        else:
            $dispviaj = '<table width="100%" ><tr><td><strong>Disponibilidad para viajar:</strong> Si, fuera del país</td></tr></table>';
        endif;
    else:
        $dispviaj = '<table width="100%" ><tr><td><strong>Disponibilidad para viajar:</strong> No</td></tr></table>';
    endif;
                    
	if($student['StudentProspect']['change_residence']=='s'):
        $dispchange = '<table width="100%" ><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Si</td></tr></table>';
        if($student['StudentProspect']['change_residence_option']=='1'):
			$dispchange = '<table width="100%" ><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Si, dentro del país</td></tr></table>';
        else:
            $dispchange = '<table width="100%" ><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Si, fuera del país</td></tr></table>';
		endif;
    else:
        $dispchange = '<table width="100%" ><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> No</td></tr></table>';
    endif;

	//------------------------ CIERRE VALIDA FORMACIÓN ACADEMICA -------------------------------------------------
	if($student['StudentHeader']['header'] <> ''):
        $header = $student['StudentHeader']['header'];
    else:
        $header = '';
    endif;
		
	//imagen de CV
	$dir1 = 'img/uploads/student/filename/'.$student['Student']['filename'];
	$existe = is_file( $dir1 );

	if ($existe):
		$mime1 = $student['Student']['mimetype'];
		$porciones = explode(".", $student['Student']['filename']);
		$mime2 = $porciones[1];
	endif;

	// atrapa las competencias
	$compet = '';
	$compet1 = '';
	if(!empty($student['StudentProfessionalSkill'])):
		$numeroCompetencias = count($student['StudentProfessionalSkill']);
           
		foreach($student['StudentProfessionalSkill'] as $k => $competencia){
            $numeroCompetencias --;
            if($competencia['Competency']['description'] <> ''):
                $compet .= '' . $competencia['Competency']['description'];
            else:
                $compet .= '';
            endif;
			($numeroCompetencias > 0) ? $compet .= ' / ' : '';
        }
    endif;
	$compet1 = '<span><strong>COMPETENCIAS PROFESIONALES: </strong>'.$compet.'</span>';

	//atrapa area de interes
	$areainter1 = '';
	if(!empty($student['StudentInterestJob'])): 
		$contador1 = 1;
        foreach($student['StudentInterestJob'] as $k => $areaInteres):
            $areainter1 .= '    '.$contador1.'.- '.$areaInteres['InterestArea']['interest_area'];
			$contador1++;
        endforeach; 
	endif;

	// MOVILIDAD ESTUDIANTIL
	$mob1 = '';
	$mob2 = '';     
	$numFormaciones = 0;
    $fcm = '';
    $fcmd ='';
            
	foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
		if($formacionAcademica['student_mobility'] == 's'):
            if(!empty($formacionAcademica['Country'])):
				$fcm = $formacionAcademica['Country']['country'];
                if(($formacionAcademica['mobility_start_date']<>'0000-00-00') && ($formacionAcademica['mobility_start_date']<>null)):
					$fcmd = ' / ' . date("Y",strtotime($formacionAcademica['mobility_start_date']));
                endif;
            endif;  
            
			$mob1 .= '<tr><td>'.$formacionAcademica['student_mobility_institution'].' </td><td>'.$formacionAcademica['student_mobility_program'] .' </td><td>'.$fcm.$fcmd.'</td></tr><br />';  
			$numFormaciones++;
		endif;
	endforeach;

	$mob2 = '<br /><table width="100%"><tr><td><strong>MOVILIDAD ESTUDIANTIL</strong></td></tr></table>';
    if($numFormaciones > 0):
		$mob2 .='<table><tr width="100%"><td width="40%"><strong>Institución edicucativa</strong></td><td width="40%"><strong>Nombre del Programa</strong></td><td width="20%"><strong>País / Año</strong></td></tr>'.$mob1.'</table>';
    else: 
		$mob2 = '';
	endif;
	
	$ladacelularestudiante = '';
	$celularestudiante = '';
	$celularestudiante1 = '';
    
	if(!empty($student['StudentProfile']['cell_phone'])): 
		$ladacelularestudiante = '';
		$celularestudiante = $student['StudentProfile']['cell_phone'];
		$ladacelularestudiante = $student['StudentProfile']['lada_cell_phone'];
		$celularestudiante1 = 'Cel: ('.$ladacelularestudiante.') '.$celularestudiante;
	endif;  
		
	$objetivop = '';
	if(!empty($student['StudentJobProspect']['professional_objective'])): 
		$objetivop = '<span><strong>OBJETIVO PROFESIONAL</strong><br />'.$student['StudentJobProspect']['professional_objective'].'</span>';
    endif;

//-----------------------------------------ARMADO CV PDF---------------------------------------------
App::import('Vendor','tcpdf');
App::import('Vendor','eng');
global $l;
$l = Array();
$l['a_meta_charset'] = 'UTF-8';
$l['a_meta_dir'] = 'ltr'; 
$l['a_meta_language'] = 'en';
$l['w_page'] = 'page';
 
class MYPDF extends TCPDF {
  public function Footer() {
    $this->SetY(-15);
    $this->SetX(300);
    $this->SetFont('helvetica', 'I', 10.5);
    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');   // Page number
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bolsa de trabajo bti');
$pdf->SetTitle('Currículum');
$pdf->SetSubject('Currículum');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
$pdf->SetFont('pdfahelvetica', '', 16);
$pdf->AddPage();
$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
$img_file = K_PATH_IMAGES.'image_demo2.jpg';
$pdf->setPrintFooter(true);
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
if ($existe):
	$pdf->Image($dir1, 175, 5, 27.7, 31, $mime2, '', '', true, 150, '', false, false, 1, false, false, false);
endif;

$pdf->setPageMark();
$txt = <<<EOD
EOD;

	$dicapacidad = '';
	if($student['StudentProfile']['disability'] == 's'):
	    $dicapacidad .= '<br /><br /><span><strong>TIPO DE DISCAPACIDAD: </strong>'.$TiposDiscapacidad[$student['StudentProfile']['disability_type']].'</span>';
	else:
	    $dicapacidad .= '<br /><br /><span><strong>TIPO DE DISCAPACIDAD: </strong>Ninguna'.'</span>';
	endif;

	$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);

	if($areainter1<>''):
		$areasInteres = '<br /><br /><span><strong>ÁREAS DE INTERÉS: </strong>'.$areainter1.'</span>';
	else:
		$areasInteres = '';
	endif;
	
	$html = '<div style="text-align: center;">
			 <span style="font-size:9.5pt;">'.$header.'</span><br />
			 <span style="font-weight:bold;font-size:14pt;">'.$student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' '.$student['StudentProfile']['second_last_name'].'</span><br />
			 <span style="font-size:9.5pt;">'.$student['StudentProfile']['street']. ' '.$student['StudentProfile']['subdivision']. ' '.$student['StudentProfile']['city'].'<br />'.
			 $student['StudentProfile']['date_of_birth'].'<br />'.
			 'Tel: ('.$student['StudentProfile']['lada_telephone_contact'].') '.$student['StudentProfile']['telephone_contact'].' '. $celularestudiante1.'<br />'.
			 $student['Student']['email'].'</div>
			
			<div style="font-size:10.5pt;text-align: justify;">';

	if($objetivop<>''):
		$html .= $objetivop;
	endif;
	
	if($areasInteres<>''):
		$html .= $areasInteres;
	endif;
	
	if($dicapacidad<>''):
		$html .= $dicapacidad;
	endif;
	
	if(!empty($student['StudentProfessionalProfile'])):
		$html .= '<br /><br /><span><strong>FORMACIÓN ACADÉMICA</strong></span>';
	endif;
		
	for ($i=1; $i < 4; $i++):
		foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
		
			if($formacionAcademica['academic_level_id']==$i):
	
				if($formacionAcademica['egress_year_degree']<>''):
					$licunamegresado = ': ';
				else:
					$licunamegresado = '';
				endif;

				$aclevel10 = '<br /><table width="100%" ><tr><td width="55%"><strong>'.$formacionAcademica['AcademicLevel']['academic_level'].$licunamegresado.'</strong></td>';

				if($formacionAcademica['AcademicSituation']['academic_situation'] <> 'Estudiante'):
					$licunamegreso = '<td width="25%"><strong>Año de egreso: </strong>'.date("Y",strtotime($formacionAcademica['egress_year_degree'])).'</td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';
				else:
					$licunamegreso = '<td width="25%"><strong>Actual </strong></td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';
				endif;

				if($formacionAcademica['undergraduate_institution']<>''):
					if($i==1):
						$licunam = '<table width="100%"><tr><td width="100%">Universidad Nacional Autónoma de México</td></tr></table><table width="100%" ><tr><td width="100%">'.$Escuelas[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
						$licunamid = '<table width="100%"><tr><td width="100%">'.$carreras[$formacionAcademica['career_id']].'</td></tr></table>';                             
					else:
						$espeunam = '<table width="100%"><tr><td width="100%">Universidad Nacional Autónoma de México</td></tr></table><table width="100%" ><tr><td width="100%">' .$Facultades[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
						$areaposid = '<table width="100%"><tr><td width="100%">'.$programas[$formacionAcademica['posgrado_program_id']].'</td></tr></table>';      
					endif;
				else:
                    $licunam = '<table width="100%" ><tr><td width="100%">'.$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
                    $licunamid = '  <table width="100%"><tr><td width="100%">'.$formacionAcademica['another_career'].'</td></tr></table>';
                endif;

				if($formacionAcademica['AcademicSituation']['academic_situation'] === 'Estudiante'):
					$licunamsemester = '<table width="100%" ><tr><td width="100%">Semestre: ' . $formacionAcademica['semester'].'</td></tr></table>';
                else:
					$licunamsemester = '';
                endif;
                    
				$html.=$aclevel10.$licunamegreso.$licunam.$licunamid.$licunamsemester;
				
			endif;
		endforeach; 
	endfor;
	
	if($mob2<>''):
		$html .= $mob2.'<br />';
	endif;
	
	if($compet1<>''):
		$html .= $compet1.'<br />';
	endif;
	
	if($experiencias2<>''):
		$html .= $experiencias2.'<br />';
	endif;
	
	if($experiencias2p<>''):
		$html .= $experiencias2p.'<br />';
	endif;
  
	if($idio2<>''):
		$html .= $idio2.'<br />';
	endif;
	
	if($cono2<>''):
		$html .= $cono2.'<br />';
	endif;
	
	if($compu2<>''):
		$html .= $compu2.'<br />';
	endif;
	
	if($dispviaj<>''):
		$html .= $dispviaj.'<br />';
	endif;
	
	if($dispchange<>''):
		$html .= $dispchange.'<br />';
	endif;
	
	$html .='</div>';
	
$pdf->writeHTML($html, true, false, true, false, '');

$nombrepdf = $student['Student']['username'].'.pdf';
echo $pdf->Output('files/pdf' . DS . $nombrepdf, 'F');
//----------------------------------------- TERMINA ARMADO CV PDF ---------------------------------------------
?>
	
	<div class="embed-responsive embed-responsive-16by9">
		<iframe src="<?php echo $this->webroot; ?>files/pdf/<?php echo $nombrepdf ?>" style="width:100%; height:650px;" frameborder="0" allowfullscreen>Your browser does not support inline frames or is currently configured not to display inline frames.</iframe>
	</div>

	
	<div class="col-md-12">
		<div class="col-md-9">
			<label>Fecha de última actualización:<?php echo ' '.date("d/m/Y",strtotime($student['StudentLastUpdate']['modified'])); ?></label>
		</div>
		<div class="col-md-3">
			<?php 
				$caracteres = strlen($student['Student']['id']);
				$faltantes = 5 - $caracteres;	
				if($faltantes > 0):
					$ceros = '';
					for($cont=0; $cont<=$faltantes;$cont++):
						$ceros .= '0';
					endfor;
					$folio = $ceros.$student['Student']['id'];
				else:
					$folio = strlen($student['Student']['id']);
				endif;
			?>
			<label style="float: right;">Folio:<span style="color: #FFB71F;"><?php echo ' '.$folio; ?></span></label>
		</div>
	</div>

</div>