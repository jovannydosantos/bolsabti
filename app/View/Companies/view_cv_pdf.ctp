<?php 
	$this->layout = 'pdf'; 
?>
<script>
	<?php
		if($show==1):
	?>
		setTimeout ("alert('El número de visualizaciones y/o descargas en pdf ha llegado a su límite', 'Mensaje');  window.close() ", 3000);
	<?php
		endif;
	?>
</script>
<?php
if($descargas<$company['CompanyOfferOption']['max_cv_download']):
ini_set('memory_limit', '256M');
	ini_set('max_execution_time', 60);
	function numero_de_meses($hoy,$fecha_anterior)
	{
	$meses=0;
	while($fecha_anterior<=$hoy)
	{
	$meses++;
	$fecha_anterior=date("Y-m-d", strtotime("$fecha_anterior +1 month"));
	}

	return $meses;
	}
    
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
			if($puesto['end_date'] == '0000-00-00'):
                $puesto['end_date'] = date ("Y/m/d");
                $fechexp = '<table width="100%" border="0"><br><tr><td width="83%"><strong>'. $companyName .'</strong></td><td width="10%"><strong>'.date("m-Y",strtotime($puesto['start_date'])).' /</strong></td><td width="10%"><strong> Actual</strong></td></tr></table>';
            else:
                $fechexp = '<table width="100%" border="0"><tr><td width="80%"><strong>'. $companyName .'</strong></td><td width="10%"><strong>'.date("m-Y",strtotime($puesto['start_date'])).' /</strong></td><td width="10%"><strong> '.date("m-Y",strtotime($puesto['end_date'])).'</strong></td></tr></table>';
            endif;
            
			$fecha1 = new DateTime($puesto['start_date'] . "00:00:00");
            $fecha2 = new DateTime($puesto['end_date']. "00:00:00");
            $fecha = $fecha1->diff($fecha2);
            $anosExperiencia = $anosExperiencia + $fecha->y;
            $mesesExperiencia = $mesesExperiencia + $fecha->m;
            $mesesToYear = round ($mesesExperiencia / 12);
            $resAnosExperiencia = $anosExperiencia + $mesesToYear;
            
			if($resAnosExperiencia==0):
                $resAnosExperiencia = '<br> menor a 6 meses';
            endif;

			$areaexp = '<table width="100%" border="0"><tr><td width="78%">'.$puesto['ExperienceArea']['experience_area'].'</td><td width="38%">Años de experiencia: '.$resAnosExperiencia.' </td></tr></table>';
			$puestexp = '<table width="100%" border="0"><br><tr><td width="100%"><strong>'.$contador.'.- ' .$puesto['job_name'].'</strong></td></tr></table>';  
   
			if(!empty($puesto['StudentResponsability'])): 
				$titexp = '<table width="100%" border="0"><tr><td width="100%"><strong>Principales Responsabilidades</strong></td></tr></table>';              

				foreach($puesto['StudentResponsability'] as $k => $experiencias):
					$arearesp .= '<table width="100%" border="0"><tr><td width="98%">-' . $experiencias['responsability'] . '</td><td width="2%"></td></tr></table>';
                endforeach;
			endif;
		   
			if(!empty($puesto['StudentAchievement'])):           
				$titlogs = '<br><table width="100%" border="0"><tr><td width="100%"><strong>Principales Logros</strong></td></tr></table>';
				foreach($puesto['StudentAchievement'] as $k => $logros):
                    $areaslogr .='<table width="100%" border="0"><tr><td width="98%">-' . $logros['achievement'] .'</td><td width="2%"></td></tr></table>';
				endforeach; 
			endif; 
			
			$experienciasall .= $fechexp.$areaexp.$puestexp.$titexp.$arearesp.$titlogs.$areaslogr;      
			$companyexp = ''; $areaexp = '';$fechexp = ''; $puestexp = ''; $titref = ''; $titexp = ''; $arearesp = '';$areaslogr = '';
			$contador++;
	  
        endforeach;
	
    endforeach; 

	if($experienciasall<>''):
		$experiencias1 = '<table width="100%" border="0"><tr><td><strong>EXPERIENCIA PROFESIONAL</strong></td></tr></table>';
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
            $areaexpp = '';
            $fechexpp = ''; 
            $empInst = ''; 
            $nomPais = ''; 
            $titexpp = ''; 
            $arearespp = '';
            $titlogsp = '';
            $areaslogrp = ''; 
        
            $fechexpp = '<table width="100%" border="0"><br><tr><td><strong>Nombre del proyecto:'.$proyecto['name'].'</strong></td></tr></table>';
            $empInst  = '<table width="100%" border="0"><tr><td><strong>Empresa / institucion:'.$proyecto['company'].'</strong></td></tr></table>';
            $nomPais  = '<table width="100%" border="0"><tr><td><strong>Pais: '.$Paises[$proyecto['country']].'</strong></td></tr></table>';
            
            $titexpp   = '<table width="100%" border="0"><br><tr><td width="100%"><strong>Principales Responsabilidades</strong></td></tr></table>';              
            $arearespp = '<table width="100%" border="0"><tr><td width="95%">' . $proyecto['responsability'] . '</td><td width="5%"></td></tr></table>';

            $titlogsp   = '<table width="100%" border="0"><br><tr><td width="100%"><strong>Principales Logros</strong></td></tr></table>';
            $areaslogrp = '<table width="100%" border="0"><tr><td width="95%">' . $proyecto['achievement'].  '</td><td width="5%"></td></tr></table>';

            $experienciasallp .= $fechexpp.$empInst.$nomPais.$titexpp.$arearespp.$titlogsp.$areaslogrp;

        endforeach;
        $experiencias1p = '<br><table width="100%" border="0"><tr><td><strong>PROYECTOS EXTRACURRICULARES</strong></td></tr></table>';
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
		
		$idio2 = '<br><table width="100%" border="0"><tr><td><strong>IDIOMA</strong></td></tr></table><br>';
        if($numidio > 0):
			$idio2 .='<table width="100%" border="0">'.$idio1.'</table>';
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

		$cono2 = '<br><table width="100%" border="0"><tr><td><strong>CONOCIMIENTOS Y HABILIDADES PROFESIONALES</strong></td></tr></table>';
        if($numcono > 0):
			$cono2 .='<table width="100%" border="0"><br>'.$cono1.'</table>';
		endif;
    endif;


	// atrapa computo
	$compu1 = '';
	$compu2 = '';     
	$numcompu = 0;
	
	if(!empty($student['StudentTechnologicalKnowledge'])):

		foreach($student['StudentTechnologicalKnowledge'] as $k => $computo):
            $compu1 .= '<tr><td width="45%" style="text-align: left">'.$computo['Tecnology']['tecnology'].': ';
					
			if($computo['name']<>''):
				$compu1.= $software[$computo['name']].'</td>';
			else:
				$compu1.= $computo['other'].'</td>';
			endif;
					
			$compu1 .='<td width="15%" style="text-align: left">'.$NivelesSoftware[$computo['level']].'</td><td width="35%" style="text-align: left">'.$computo['institution'].'</td></tr>';  
			$numcompu++;
           
        endforeach; 
		
		$compu2 = '<br><table width="100%" border="0"><tr><td><strong>CÓMPUTO</strong></td></tr></table>';
        $titulo = '<tr><td width="45%"><strong>Categoría y Nombre </strong></td><td  width="15%"><strong>Nivel </strong></td><td  width="35%"><strong>Certificación</strong></td></tr>';
		if($numcompu > 0):
			$compu2 .='<table width="100%" border="0"><br>'.$titulo.$compu1.'</table>';
		endif;
    endif;

	$dispviaj = '';
	$dispchange = '';

    if($student['StudentProspect']['can_travel']=='s'):
        $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> Si</td></tr></table>';
        if($student['StudentProspect']['can_travel_option']=='1'):
            $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> Si, dentro del país</td></tr></table>';
        else:
            $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> Si, fuera del país</td></tr></table>';
        endif;
    else:
        $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> No</td></tr></table>';
    endif;
                    
	if($student['StudentProspect']['change_residence']=='s'):
        $dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Si</td></tr></table>';
        if($student['StudentProspect']['change_residence_option']=='1'):
			$dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Si, dentro del país</td></tr></table>';
        else:
            $dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Si, fuera del país</td></tr></table>';
		endif;
    else:
        $dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> No</td></tr></table>';
    endif;

	//------------------------ VALIDA FORMACIÓN ACADEMICA INICIALIZA EN VACIOS -------------------------------------------------
		
		$aclevel10 = ''; 
		$aclevel11 = ''; 
		$aclevel12 = ''; 
		$aclevel13 = ''; 
		$licunam = ''; 
		$licunamid = ''; 
		$licunamsemester = ''; 
		$licunamingreso = ''; 
		$licunamegreso = '';
		$espeunam = ''; 
		$areaposid = ''; 
		$espeunamsemester =''; 
		$espeunamingreso = ''; 
		$espeunamegreso = ''; 
		$masterunam = ''; 
		$areaposidmaster = ''; 
		$masterunamsemester ='';
		$masterunamingreso = ''; 
		$masterunamegreso = ''; 
		$doctoradounam = ''; 
		$areaposiddoctorado = ''; 
		$doctoradounamsemester =''; 
		$doctoradounamingreso = '';
		$doctoradounamegreso = ''; 
		$licunamegresado = ''; 
		$espeunamegresado = ''; 
		$masterunamegresado = ''; 
		$doctoradounamegresado = ''; 
		$licenciaturas ='';
		$especialidades = ''; 
		$maestrias = '';  
		$doctorados = '';

	//----------------------------------- LICENCIATURA ----------------------------------------------------	
        foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
		
			if($formacionAcademica['academic_level_id']== 1):
	
				if($formacionAcademica['egress_year_degree']<>''):
					$licunamegresado = ': ';
				endif;

				$aclevel10 = '<table width="100%" border=""><tr><td width="55%"><strong>'.$formacionAcademica['AcademicLevel']['academic_level'].$licunamegresado.'</strong></td>';

				if($formacionAcademica['AcademicSituation']['academic_situation'] <> 'Estudiante'):
					$licunamegreso = '<td width="25%"><strong>Año de egreso: </strong>'.date("Y",strtotime($formacionAcademica['egress_year_degree'])).'</td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';
				else:
					$licunamegreso = '<td width="25%"><strong>Actual </strong></td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';
				endif;

				if($formacionAcademica['undergraduate_institution']<>''):
					$licunam = '<table width="100%" border=""><tr><td width="100%">Universidad Nacional Autónoma de México</td></tr></table><table width="100%" border=""><tr><td width="100%">'.$Escuelas[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
					$licunamid = '<table width="100%" border=""><tr><td width="100%">'.$carreras[$formacionAcademica['career_id']].'</td></tr></table>';                             
				else:
                    $licunam = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
                    $licunamid = '  <table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_career'].'</td></tr></table>';
                endif;

				if($formacionAcademica['AcademicSituation']['academic_situation'] === 'Estudiante'):
					$licunamsemester = '<table width="100%" border=""><tr><td width="100%"><strong>Semestre: </strong>' . $formacionAcademica['semester'].'</td></tr></table>';
                else:
					$licunamsemester = '';
                endif;
                    
				$licenciaturas .=$aclevel10.$licunamegreso.$licunam.$licunamid.$licunamsemester;
				
			endif;
		endforeach; 
		
	//-----------------------------  CIERRE LICENCIATURA ----------------------------------------------------            
	
	
	//-----------------------------  ESPECIALIDAD  ------------------------------------------  
        foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):

			if($formacionAcademica['academic_level_id']== 2):

				if($formacionAcademica['egress_year_degree']<>''):
					$espeunamegresado = ': ';
				endif;

				$aclevel11 = '<table width="100%" border=""><tr><td width="55%"><strong>'.$formacionAcademica['AcademicLevel']['academic_level'].':</strong></td>';
      
				if($formacionAcademica['AcademicSituation']['academic_situation'] <> 'Estudiante'):
					$espeunamegreso = '<td width="25%"><strong>Año de egreso: </strong>' . date("Y",strtotime($formacionAcademica['egress_year_degree'])).'</td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';
				else:
					$espeunamegreso = '<td width="25%"><strong>Actual </strong></td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';                                  
				endif;

				if($formacionAcademica['undergraduate_institution']<>''):
					$espeunam = '<table width="100%" border=""><tr><td width="100%">Universidad Nacional Autónoma de México</td></tr></table><table width="100%" border=""><tr><td width="100%">' .$Facultades[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
					$areaposid = '<table width="100%" border=""><tr><td width="100%">'.$programas[$formacionAcademica['posgrado_program_id']].'</td></tr></table>';      
				else:
					$espeunam = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
					$areaposid = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_career'].'</td></tr></table>';
				endif;

                if($formacionAcademica['AcademicSituation']['academic_situation'] === 'Estudiante'):
					$espeunamsemester = '<table width="100%" border=""><tr><td width="100%" ><strong> Semestre: </strong>' .$formacionAcademica['semester'].'</td></tr></table><br>';
				else:
					$espeunamsemester = ''; 
				endif;
				
				$especialidades .=$aclevel11.$espeunamegreso.$espeunam.$areaposid.$espeunamsemester;
				
            endif;
			
        endforeach; 
	//-----------------------------  CIERRE ESPECIALIDAD  ------------------------------------------
           
	//-----------------------------  MAESTRIA  ------------------------------------------               
        foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
			if($formacionAcademica['academic_level_id']== 3):

				if($formacionAcademica['egress_year_degree']<>''):
					$masterunamegresado = ':';
				endif;
				  
				$aclevel12 = '<table width="100%" border=""><tr><td width="55%"><strong>'.$formacionAcademica['AcademicLevel']['academic_level'].$masterunamegresado.'</strong></td>';

				if($formacionAcademica['AcademicSituation']['academic_situation'] <> 'Estudiante'):
					$masterunamegreso = '<td width="25%"><strong>Año de egreso: </strong>' . date("Y",strtotime($formacionAcademica['egress_year_degree'])).'</td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';
				else:
					$masterunamegreso = '<td width="25%"><strong>Actual </strong></td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';    
				endif;
		
				if($formacionAcademica['undergraduate_institution']<>''):
					$masterunam = '<table width="100%" border=""><tr><td width="100%">Universidad Nacional Autónoma de México</td></tr></table><table width="100%" border=""><tr><td width="100%">'.$Facultades[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
					$areaposidmaster = '<table width="100%" border=""><tr><td width="100%">'.$programas[$formacionAcademica['posgrado_program_id']].'</td></tr></table>';    
				else:
					$masterunam = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
					$areaposidmaster = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_career'].'</td></tr></table>';
				endif;

				if($formacionAcademica['AcademicSituation']['academic_situation'] === 'Estudiante'):
					$masterunamsemester = '<table width="100%" border=""><tr><td width="100%" ><strong> Semestre: </strong>'.$formacionAcademica['semester'].'</td></tr></table><br>';
				else:
					$masterunamsemester = '';
				endif;
				
				$maestrias .=$aclevel12.$masterunamegreso.$masterunam.$areaposidmaster.$masterunamsemester;
				
			endif;
        endforeach; 

	//-----------------------------  CIERRE MAESTRIA  ------------------------------------------
  
	//-----------------------------  DOCTORADO  ------------------------------------------
		foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
            if($formacionAcademica['academic_level_id']== 4):

				if($formacionAcademica['egress_year_degree']<>''):
					$doctoradounamegresado = ':';
				endif;
    
				$aclevel13 ='<table width="100%" border=""><tr><td width="55%"><strong>'.$formacionAcademica['AcademicLevel']['academic_level'].$doctoradounamegresado.'</strong></td>';
				
				if($formacionAcademica['AcademicSituation']['academic_situation'] <> 'Estudiante'):
					$doctoradounamegreso = '<td width="25%"><strong>Año de egreso: </strong>' . date("Y",strtotime($formacionAcademica['egress_year_degree'])).'</td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';
				else:
					$doctoradounamegreso = '<td width="25%"><strong>Actual </strong></td><td width="20%">'.$formacionAcademica['AcademicSituation']['academic_situation'].'</td></tr></table>';               
				endif;

				if($formacionAcademica['undergraduate_institution']<>''):
					$docunam = '<table width="100%" border=""><tr><td width="100%">Universidad Nacional Autónoma de México</td></tr></table><table width="100%" border=""><tr><td width="100%">'.$Facultades[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
					$areaposiddoctorado = '<table width="100%" border=""><tr><td width="100%">'.$AreasPosgrado[$formacionAcademica['posgrado_program_id']].'</td></tr></table>';    
				else:
					$docunam = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
					$areaposiddoctorado = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_career'].'</td></tr></table>';
				endif;


                if($formacionAcademica['AcademicSituation']['academic_situation'] === 'Estudiante'):
					$doctoradounamsemester = 'Semestre: ' . $formacionAcademica['semester'].'<br>';
				else:
					$doctoradounamsemester = '';
				endif;
				
				$doctorados .=$aclevel13.$doctoradounamegreso.$docunam.$areaposiddoctorado.$doctoradounamsemester;

              endif;
        endforeach;
		
	//-----------------------------  CIERRE DOCTORADO  ------------------------------------------  


	//------------------------ CIERRE VALIDA FORMACIÓN ACADEMICA -------------------------------------------------
		if($student['StudentHeader']['header'] <> ''):
            $header = '';
            $header = $student['StudentHeader']['header'];
        else:
            $header = '';
        endif;
		
	//imagen de CV
	$dir1 = 'img/uploads/student/filename/'.$student['Student']['filename'];
	$mime1 = $student['Student']['mimetype'];
	$mime2 = substr($mime1, -3);


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
	
	$compet1 = '<table width="100%" border="0"><tr><td width="38%"><strong>COMPETENCIAS PROFESIONALES:</strong></td><td width="60%">'.$compet.'</td></tr></table>';

	// atrapa area de interes

	$areainter1 = '';
	if(!empty($student['StudentInterestJob'])): 
		$contador1 = 1;
        foreach($student['StudentInterestJob'] as $k => $areaInteres):
            $areainter1 .= $contador1.'.- '.$areaInteres['InterestArea']['interest_area'].'  ';
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
                if($formacionAcademica['mobility_start_date']<>'0000-00-00'):
					$fcmd = ' / ' . date("Y",strtotime($formacionAcademica['mobility_start_date']));
                endif;
            endif;  
            
			$mob1 .= '<tr><td style="text-align: left">'.$formacionAcademica['student_mobility_institution'].' </td><td style="text-align: left">'.$formacionAcademica['student_mobility_program'] .' </td><td style="text-align: left">'.$fcm.$fcmd.'</td></tr><br>';  
			$numFormaciones++;
		endif;
	endforeach;

	$mob2 = '<br><table width="100%" border=""><tr><td><strong>MOVILIDAD ESTUDIANTIL</strong></td></tr></table><br>';
    if($numFormaciones > 0):
		$mob2 .='<table border=""><tr width="100%" style="text-align: left"><td width="40%" style="text-align: left"><strong>Institución edicucativa</strong></td><td width="40%" style="text-align: left"><strong>Nombre del Programa</strong></td><td width="20%" style="text-align: left"><strong>País / Año</strong></td></tr>'.$mob1.'</table>';
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
		$objetivop = '<table width="100%" border="0"><tr><td width="100%"><strong>OBJETIVO PROFESIONAL</strong></td></tr></table><table width="100%" border="0"><tr><td width="100%"><p>'.$student['StudentJobProspect']['professional_objective'].'</p></td></tr></table>';
    endif;


//-----------------------------------------ARMADO CV PDF---------------------------------------------
App::import('Vendor','tcpdf');
App::import('Vendor','eng');
 global $l;
$l = Array();

// PAGE META DESCRIPTORS --------------------------------------

$l['a_meta_charset'] = 'UTF-8';
$l['a_meta_dir'] = 'ltr'; 
$l['a_meta_language'] = 'en';

// TRANSLATIONS --------------------------------------
$l['w_page'] = 'page';
 
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
  //Page header
// Page footer
  public function Footer() {
    // Position at 15 mm from bottom
    $this->SetY(-15);
      $this->SetX(300);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bolsa de trabajo UNAM');
$pdf->SetTitle('TCPDF Example 051');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// remove default footer
$pdf->setPrintFooter(false);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('pdfahelvetica', '', 14);

// add a page
$pdf->AddPage();// -- set new background ---


// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'image_demo.jpg';
$pdf->setPrintFooter(true);
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
if ($student['Student']['filename'] <> ''):
$pdf->Image($dir1, 179.8, 5, 27.7, 31, $mime2, '#', '', true, 150, '', false, false, 1, false, false, false);
endif;

$pdf->setPageMark();
$txt = <<<EOD
EOD;

$dicapacidad = '';

    if($student['StudentProfile']['disability'] == 's'):
        $dicapacidad .= $TiposDiscapacidad[$student['StudentProfile']['disability_type']];
      else:
        $dicapacidad .= 'Ninguna';
      endif;



// print a block of text using Write()
$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);

	if($areainter1<>''):
		$areasInteres = '<table width="100%" border="0"><br><tr><td width="22%"><strong>ÁREAS DE INTERÉS:</strong></td><td width="78%">'.$areainter1.'</td></tr></table>';
	else:
		$areasInteres = '';
	endif;
	

	$html = '<table border="0"><tr><td width="10%"></td><td width="78%"><div style="font-family:helvetica;font-size:9.5pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">'.$header.'</div></td><td width="12%"></td></tr></table>
<div style="font-family:helvetica;font-weight:bold;font-size:14pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
'.$student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' '.$student['StudentProfile']['second_last_name'].'
</div>
<div style="font-family:helvetica;font-size:9.5pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
'.$student['StudentProfile']['street']. ' '.$student['StudentProfile']['subdivision']. ' '.$student['StudentProfile']['city'].'<br>
'.$student['StudentProfile']['date_of_birth'].'<br>
'.'Tel: ('.$student['StudentProfile']['lada_telephone_contact'].') '.$student['StudentProfile']['telephone_contact'].' '. $celularestudiante1.'<br>
'.$student['Student']['email'].' 
</div>
<div style="font-family:helvetica; font-size:10.5pt;position:relative; margin: 0 auto; left: 0; right: 0; text-align: justify;">';

	if($objetivop<>''):
		$html .= $objetivop;
	endif;
	
	if($areasInteres<>''):
		$html .= $areasInteres;
	endif;
	
	if($dicapacidad<>''):
		$html .='<table width="100%" border="0">
				<br>
				<tr>
					<td width="22%"><strong>Tipo de discapacidad:</strong></td>
					<td width="78%">'.$dicapacidad.'</td>
				</tr>
				</table>';
	endif;
	
	if(($doctorados<>'') OR ($maestrias<>'') OR ($especialidades<>'') OR ($licenciaturas<>'')):
		$html .= '<table width="100%" border="0"><br><tr><td><strong>FORMACIÓN ACADÉMICA</strong></td></tr></table>';
		
		if($doctorados<>''):
			$html .= $doctorados.'<br>';
		endif;
		
		if($maestrias<>''):
			$html .= $maestrias.'<br>';
		endif;
		
		if($especialidades<>''):
			$html .= $especialidades.'<br>';
		endif;
		
		if($licenciaturas<>''):
			$html .= $licenciaturas.'<br>';
		endif;
	
	endif;
	
	if($mob2<>''):
		$html .= $mob2.'<br>';
	endif;
	
	if($compet1<>''):
		$html .= $compet1.'<br>';
	endif;
	
	if($experiencias2<>''):
		$html .= $experiencias2.'<br>';
	endif;
	
	if($experiencias2p<>''):
		$html .= $experiencias2p.'<br>';
	endif;
  
	if($idio2<>''):
		$html .= $idio2.'<br>';
	endif;
	
	if($cono2<>''):
		$html .= $cono2.'<br>';
	endif;
	
	if($compu2<>''):
		$html .= $compu2.'<br>';
	endif;
	
	if($dispviaj<>''):
		$html .= $dispviaj.'<br>';
	endif;
	
	if($dispchange<>''):
		$html .= $dispchange.'<br>';
	endif;
	
	$html .='</div>';

	
$pdf->writeHTML($html, true, false, true, false, '');

$nombrepdf = $student['Student']['username'].'.pdf';
//Close and output PDF document
//$pdf->Output('oferta-plantilla.pdf', 'I');
//echo $pdf->Output('files/pdf' . DS . 'MYCV.pdf', 'F');
echo $pdf->Output('files/pdf' . DS . $nombrepdf, 'F');
	//----------------------------------------- TERMINA ARMADO CV PDF ---------------------------------------------
endif;
?>
	<div class="col-md-12" style="text-align: left">
		<?php echo $this->Session->flash(); ?>
	</div>
	
	<?php 
		if($descargas<$company['CompanyOfferOption']['max_cv_download']):
	?>
		
	<iframe src="<?php echo $this->webroot; ?>files/pdf/<?php echo $nombrepdf ?>" style="width:1000px; height:700px;" frameborder="0">Your browser does not support inline frames or is currently configured not to display inline frames.</iframe>

	<?php 
		endif;
	?>
