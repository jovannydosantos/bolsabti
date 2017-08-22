<?php 
	$this->layout = 'student'; 
?>

<script>
	$(window).load(function() {
		var helpText = [
						"Seleccione este campo si desea que los reclutadores de las empresas vean sus áreas de interés o en la que cuenta con experiencia laboral, para la vacante.", 
						"",
						"Seleccione este campo si desea  mostrar cuantos años tiene de experiencia en el área antes seleccionada.",
						];
		
		$('.form-group').each(function(index, element) {
			$(this).find(".cambia").attr("id", index);
			$(this).find('#'+index).attr("data-original-title", helpText[index]);
		});
		
		desabilityAreas();
		
	});	
	
	function ageCalculator(){
		// var ano = document.getElementById("StudentProfileDateOfBirthYear").value;
		// var mes = document.getElementById("StudentProfileDateOfBirthMonth").value;
		// var dia = document.getElementById("StudentProfileDateOfBirthDay").value;
		var ano = 1990;
		var mes = 2;
		var dia =1;
		
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();

        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes ){
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia)){
            edad--;
        }
        if (edad > 1900){
            edad -= 1900;
        }

        var meses = 0;
        if(ahora_mes > mes)
            meses = ahora_mes-mes;
        if(ahora_mes < mes)
            meses = 12 - (mes-ahora_mes);
        if(ahora_mes == mes && dia>ahora_dia)
            meses = 11;

        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia){
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        document.getElementById("idAge").innerHTML=" "+edad+" años";
	}
	
	function desabilityAreas(){ 
	if($("#StudentHeaderShowExperienceArea").is(':checked')) {  
            var disabilityValue = 's';    
        } else {
			var disabilityValue = 'n';   
		}

		if(disabilityValue == "s"){
			// document.getElementById('StudentHeaderStudentWorkAreaId').options[0].selected = 'selected';
			$("#bloque1").show();
			$("#bloque2").show();
		} else {
			$("#bloque1").hide();
			$("#bloque2").hide();
		}
	}
</script>
<style> 
.resizable-iframe{
    overflow: visible;
    height: auto;
    width: auto;
    position: relative;
}
 
.resizable-iframe iframe{
    position: relative;
    z-index: -1; 
}   
 
.iframe-cover{
    position: absolute;   
    z-index: 99999;
    background: yellow;
}
</style> 
  
	<?php 
		echo $this->Session->flash();
	?>	
	
	<div class="col-md-10 col-md-offset-1" style="margin-top: 30px;">	
		<b style="font-size: 19px; color: #fff">Así se verá el encabezado de su currículum</b>
	</div>
	
	<?php if(count($areasExperiencia) > 0): 
		foreach($areasExperiencia as $k => $areaExperiencia):
			$areasOptions[$areaExperiencia['StudentWorkArea']['id']] = $areaExperiencia['ExperienceArea']['experience_area'];
		endforeach;
	?>
		<div class="col-md-12" style="margin-top: 40px;">	
			<?php 	
				echo $this->Form->create('Student', array(
												'class' => 'form-horizontal', 
												'role' => 'form',
												'inputDefaults' => array(
														'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
														'div' => array('class' => 'form-group'),
														'class' => 'form-control',
														'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 35px;margin-top: -40px;">',
														'between' => ' <div class="col-md-11">',
														'after' => '</div></div>',
														'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
												),
										'action' => 'studentHeader',
				)); ?>		
						
				<fieldset>

				<div class="col-md-7">
					
					<?php 
					echo $this->Form->input('StudentHeader.id', array(					
											'label' => array(
												'class' => 'col-md-3 control-label col-md-offset-1',
												'text' => 'id',),
											'placeholder' => 'id',
					)); 
					?>	

					<div style="height: 0;">
						<label class="col-md-11 control-label" style= "font-size:9pt; margin-left: 35px;" >Desea que aparesca algún área de su experiencia profesional:<img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 10px;"></label>
					</div>

					<?php echo $this->Form->input('StudentHeader.show_experience_area', array(
																'type'=>'checkbox', 
																'between' => ' <div class="col-md-1" style ="margin-top: -23px;">',
																'before' => '<div class="col-md-12 ">',
																'style' => 'margin-left: 50px; margin-top: -5px; width:15px;',	
																'label' => array(
																				'class' => 'col-md-0 control-label',
																				'text' => ''),
																'onclick' => 'desabilityAreas()'
					));	?>
					<div id="bloque1">		
					<?php 	
						echo $this->Form->input('StudentHeader.student_work_area_id', array(
													'type'=>'select',
													'between' => ' <div class="col-md-12">',
													'before' => '<div class="col-md-10  col-md-offset-1">',
													'label' => '',
													'options' => $areasOptions,'default'=>'0', 'empty' => 'Seleccionar área de experiencia profesional',
						));	
					?>
					</div>
				</div>

				<div class="col-md-5">
					<div id="bloque2">	
						<div style="height: 0;">
							<label class="col-md-10 control-label" style= "font-size:9pt;" >Desea que aparezcan los años de <br> experiencia del área seleccionada: </label><img data-toggle="tooltip" id="" data-placement="right" title="Seleccione este campo si desea  mostrar cuantos años tiene de experiencia en el área antes seleccionada." class="img-circle cambia" alt="help.png" src="/unam/img/help.png"  style="margin-top: 20px;">
						</div>
							
						<?php 	echo $this->Form->input('StudentHeader.show_experience_time', array(
																	'type'=>'checkbox', 
																	'between' => ' <div class="col-md-1" style ="margin-top: -45px;  margin-left: 10px;">',
																	'style' => 'width:15px;',
																	'before' => '<div class="col-md-12 ">',																		
																	'label' => array(
																					'class' => 'col-md-1 control-label',
																					'text' => ''),
						));	?>
					
					
						<div class="form-group">
							<div class="col-xs-12 ">
								<label class="col-xs-4 control-label" for="StudentProfileSex"></label>
								<div class="col-xs-6" id="idAge"  style="border-top-width: 0; color: white; margin-top: -25px; padding-left: 0; margin-left: 5px; padding-right: 0; text-align:right; color: #FFB71F;"></div>
							</div>
						</div>
							
					</div>
				</div>
			</fieldset>
		</div>
				
				
	<?php 
			echo $this->Form->submit('Continuar', array(
											'div' => 'form-group',
											'class' => 'btn btnBlue btn-default col-md-offset-10',
											'style' => 'margin-bottom: -600px;',
											
			));
			echo $this->Form->end(); 
	
		endif;
	?>
	</div>

<?php 
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
    $companyexp = ''; $areaexp = ''; $fechexp = ''; $puestexp = ''; $titref = ''; $titexp = ''; $arearesp = ''; $experienciasall = '';
    foreach($student['StudentProfessionalExperience'] as $k => $experiencia):
       
      $companyName =  $experiencia['company_name'];
      $contador = 1;
      foreach($experiencia['StudentWorkArea'] as $k => $puesto):

        $fechexp = '<table width="100%" border="0"><tr><td width="36%"><strong> ' . $companyName .'</strong></td>'.
                   '<td width="32%"><strong>Año de ingreso- '.$puesto['start_date'].'</strong></td>'.
                   '<td width="32%"><strong>Año de egreso- '. $puesto['end_date'].'</strong></td></tr></table>';
              
        $areaexp = '<table width="100%" border="0"><tr><td width="100%">' . $puesto['ExperienceArea']['experience_area'] . '</td></tr></table>';
               
        $puestexp = '<table width="100%" border="0"><tr>'.
                    '<td width="22%"><strong>'.$contador.'.- ' . $puesto['job_name'] .'</strong></td>'.
                    '<td width="78%">'.$Num_Meses=numero_de_meses($puesto['end_date'],$puesto['start_date']).' meses</td></tr></table>';  

         $titexp = '<table width="100%" border="0"><tr><td width="100%"><strong>Principales Responsabilidades</strong></td></tr></table>';              
          
          foreach($puesto['StudentResponsability'] as $k => $experiencias):
            $arearesp .= '<table width="100%" border="0"><tr>'.
                         '<td width="22%"><strong>' . $experiencias['responsability'] . '</strong></td>'.
                         '<td width="78%"></td></tr></table>';
          endforeach;

      endforeach; 

      $contador++;
      $experienciasall .= $fechexp.$areaexp.$puestexp.$titexp.$arearesp;      
      $companyexp = ''; $areaexp = '';$fechexp = ''; $puestexp = ''; $titref = ''; $titexp = ''; $arearesp = '';
    endforeach; 

$experiencias1 = '';
$experiencias2 = ''; 
$experiencias1 = '<table width="100%" border="0"><tr><td><strong>EXPERIENCIA PROFESIONAL</strong></td></tr></table>';
$experiencias2 = $experiencias1.$experienciasall;    

//------------------------ VALIDA FORMACIÓN ACADEMICA -------------------------------------------------
$aclevel10 = ''; $aclevel11 = ''; $aclevel12 = ''; $aclevel13 = ''; $licunam = ''; $licunamid = ''; $licunamsemester = ''; $licunamingreso = ''; $licunamegreso = '';
$espeunam = ''; $areaposid = ''; $espeunamsemester =''; $espeunamingreso = ''; $espeunamegreso = ''; $masterunam = ''; $areaposidmaster = ''; $masterunamsemester ='';
$masterunamingreso = ''; $masterunamegreso = ''; $doctoradounam = ''; $areaposiddoctorado = ''; $doctoradounamsemester =''; $doctoradounamingreso = '';
$doctoradounamegreso = ''; $licunamegresado = ''; $espeunamegresado = ''; $masterunamegresado = ''; $doctoradounamegresado = ''; $licenciaturas ='';
$especialidades = ''; $maestrias = '';  $doctorados = '';

    foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
//----------------------------------- LICENCIATURA ----------------------------------------------------
		if($formacionAcademica['academic_level_id']== 1):

			if($formacionAcademica['egress_year_degree']<>''):
				$licunamegresado = ' / egresado';
			endif;

			$aclevel10 ='<table width="100%" border="">'.
						'<tr><td width="61%">'.
						'<strong>'.$formacionAcademica['AcademicLevel']['academic_level'] .$licunamegresado.': </strong>'.
						'</td>';

			if($formacionAcademica['egress_year_degree']<>''):
				$licunamegreso ='<td width="21%"><strong>Año de egreso:</strong>' . $formacionAcademica['egress_year_degree'].'</td>'.
								'<td width="18%">(egresado/titulado)</td>'.
								'</tr></table>';
			  else:
				$licunamegreso ='<td></td><td></td></tr></table>';
			endif;
										 
			if($formacionAcademica['undergraduate_institution']<>''):
				$licunam = '<table width="100%" border=""><tr><td width="100%">'.$Escuelas[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
			else:
				$licunam = '<table width="100%" border=""><tr><td width="100%">'.$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
			endif;
				$licunamid = '<table width="100%" border=""><tr><td width="100%">'.$CarrerasLicenciatura[$formacionAcademica['career_id']].'</td></tr></table>';
													
			if($formacionAcademica['semester']<>''):
				$licunamsemester = '<table width="100%" border=""><tr><td width="100%"><strong>Semestre: </strong>' . $formacionAcademica['semester'].'</td></tr></table>';
			else:
				$licunamsemester = '';
			endif;
				$licenciaturas .=$aclevel10.$licunamegreso.$licunam.$licunamid.$licunamsemester;
		endif;
	endforeach; 
//-----------------------------  CIERRE LICENCIATURA ----------------------------------------------------            

    foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
//-----------------------------  ESPECIALIDAD  ------------------------------------------  
              if($formacionAcademica['academic_level_id']== 2):

      if($formacionAcademica['egress_year_degree']<>''):
            $espeunamegresado = ' / egresado';
      endif;

      $aclevel11 = '<table width="100%" border="">'.
                   '<tr><td width="61%">'.
                          '<strong> '  . $formacionAcademica['AcademicLevel']['academic_level'] .$espeunamegresado. ': </strong>'.
                          '</td>';
      if($formacionAcademica['egress_year_degree']<>''):
          $espeunamegreso = '<td width="21%"><strong>Año de egreso:</strong>' . $formacionAcademica['egress_year_degree'].'</td>'.
                            '<td width="18%">(egresado/titulado)</td>'.
                            '</tr></table>';
      else:
          $espeunamegreso = '<td></td><td></td></tr></table>';                                
      endif;

      if($formacionAcademica['undergraduate_institution']<>''):
          $espeunam = '<table width="100%" border=""><tr><td width="100%"> ' .$Facultades[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
      else:
          $espeunam = '<table width="100%" border=""><tr><td width="100%"> ' .$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
      endif;
          $areaposid = '<table width="100%" border=""><tr><td width="100%"> '.$AreasPosgrado[$formacionAcademica['posgrado_program_id']].'</td></tr></table>';
      if($formacionAcademica['semester']<>''):
      $espeunamsemester = '<table width="100%" border=""><tr><td width="100%" ><strong> Semestre: </strong>' .$formacionAcademica['semester'].'</td></tr></table>';
      else:
      $espeunamsemester = ''; 
      endif;
          $especialidades .=$aclevel11.$espeunamegreso.$espeunam.$areaposid.$espeunamsemester;
              endif;
    endforeach; 
 //-----------------------------  CIERRE ESPECIALIDAD  ------------------------------------------
    foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
 //-----------------------------  MAESTRIA  ------------------------------------------               
              if($formacionAcademica['academic_level_id']== 3):

    if($formacionAcademica['egress_year_degree']<>''):
           $masterunamegresado = ' / egresado';
    endif;
              
    $aclevel12 = '<table width="100%" border="">'.
                   '<tr><td width="61%">'.
                          '<strong> '  . $formacionAcademica['AcademicLevel']['academic_level'] .$masterunamegresado. ': </strong>'.
                          '</td>';

    if($formacionAcademica['egress_year_degree']<>''):
                  $masterunamegreso = '<td width="21%"><strong>Año de egreso:</strong>' . $formacionAcademica['egress_year_degree'].'</td>'.
                            '<td width="18%">(egresado/titulado)</td>'.
                            '</tr></table>';
    else:
        $masterunamegreso = '<td></td><td></td></tr></table>';     
    endif;
    
    if($formacionAcademica['undergraduate_institution']<>''):
        $masterunam = '<table width="100%" border=""><tr><td width="100%"> ' .$Facultades[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
    else:
        $masterunam = '<table width="100%" border=""><tr><td width="100%"> ' .$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
    endif;
        $areaposidmaster = '<table width="100%" border=""><tr><td width="100%"> '.$AreasPosgrado[$formacionAcademica['posgrado_program_id']].'</td></tr></table>';
    if($formacionAcademica['semester']<>''):
    $masterunamsemester = '<table width="100%" border=""><tr><td width="100%" ><strong> Semestre: </strong>' .$formacionAcademica['semester'].'</td></tr></table><br>';
    else:
      $masterunamsemester = '';
    endif;
        $maestrias .=$aclevel12.$masterunamegreso.$masterunam.$areaposidmaster.$masterunamsemester;
                      endif;
    endforeach; 

 //-----------------------------  CIERRE MAESTRIA  ------------------------------------------
    foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
 //-----------------------------  DOCTORADO  ------------------------------------------
              if($formacionAcademica['academic_level_id']== 4):

		if($formacionAcademica['egress_year_degree']<>''):
			   $doctoradounamegresado = ' / egresado';
		endif;
		
		$aclevel13 = '<table width="100%" border="">'.
					   '<tr><td width="61%">'.
							  '<strong> '  . $formacionAcademica['AcademicLevel']['academic_level'] .$doctoradounamegresado. ': </strong>'.
							  '</td>';
		if($formacionAcademica['egress_year_degree']<>''):
					  $doctoradounamegreso = '<td width="21%"><strong>Año de egreso:</strong>' . $formacionAcademica['egress_year_degree'].'</td>'.
								'<td width="18%">(egresado/titulado)</td>'.
								'</tr></table>';
		else:
			$doctoradounamegreso = '<td></td><td></td></tr></table>';               
		endif;

		if($formacionAcademica['undergraduate_institution']<>''):
			$docunam = '<table width="100%" border=""><tr><td width="100%"> ' .$Facultades[$formacionAcademica['undergraduate_institution']].'</td></tr></table>';
		else:
			$docunam = '<table width="100%" border=""><tr><td width="100%"> ' .$formacionAcademica['another_undergraduate_institution'].'</td></tr></table>';
		endif;
		   $areaposiddoctorado = '<table width="100%" border=""><tr><td width="100%"> '.$AreasPosgrado[$formacionAcademica['posgrado_program_id']].'</td></tr></table>';
		if($formacionAcademica['semester']<>''):
		$doctoradounamsemester = 'Semestre:' . $formacionAcademica['semester'].'<br>';
		else:
		  $doctoradounamsemester = '';
		endif;
			$doctorados .=$aclevel13.$doctoradounamegreso.$doctoradounam.$areaposiddoctorado.$doctoradounamsemester;

				  endif;
    endforeach;
//-----------------------------  CIERRE DOCTORADO  ------------------------------------------  
//------------------------ CIERRE VALIDA FORMACIÓN ACADEMICA -------------------------------------------------
      
// arma parametros de imagen de CV
	if($student['Student']['filename']<>''):
		$dir1 = 'img/uploads/student/filename/'.$student['Student']['filename'];
		$mime1 = $student['Student']['mimetype'];
		$mime2 = substr($mime1, -3);
	else:
		$dir1 = 'img/student/avatar';
		$mime2 = '.png';
	endif;

	// atrapa las competencias
	$compet = '';
	$compet1 = '';
	foreach($student['StudentProfessionalSkill'] as $k => $competencia):
		$compet .= ' ' . $competencia['Competency']['description'] . ' / ';
	endforeach;
	$compet1 = '<table width="100%" border="0"><tr><td width="38%"><strong>COMPETENCIAS PROFESIONALES</strong></td><td width="62%">'.$compet.'</td></tr></table>';

	// atrapa area de interes
	$areainter1 = '';
    
	foreach($interesesAreacv as $k => $areaInteres):
        $areainter1 .= $areaInteres['InterestArea']['interest_area'].', ';
	endforeach;		

// atrapa mobilidades
$mob1 = '';
$mob2 = '';     
$numFormaciones = 0;
            foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
				if($formacionAcademica['student_mobility'] == 's'):
          
                    $mob1 .= '<tr><td>' . 
								$formacionAcademica['student_mobility_institution'] .'</td><td>'.
								$formacionAcademica['student_mobility_program'] .'</td><td>'.
								$formacionAcademica['Country']['country'] .
							'</td></tr>';  
					$numFormaciones++;
           
				endif;
            endforeach; 
$mob2 = '<br><table width="100%" border="0"><tr><td><strong>MOVILIDAD ESTUDIANTIL</strong></td></tr></table>';
        if($numFormaciones > 0):
			$mob2 .='<table width="100%" border="0">'.$mob1.'</table>';
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
$pdf->Image($dir1, 179.8, 5, 27.7, 31, $mime2, '#', '', true, 150, '', false, false, 1, false, false, false);
$pdf->setPageMark();
$txt = <<<EOD
EOD;
// print a block of text using Write()
$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);


$html = 
		'<div style="font-family:helvetica;font-size:9.5pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
('.$student['AcademicSituation']['academic_situation'].' / '.$student['AcademicLevel']['academic_level'].' / '.$student['Career']['career'].') 
</div>

<div style="font-family:helvetica;font-weight:bold;font-size:14pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
'.$student['StudentProfile']['name'].' / '.$student['StudentProfile']['second_last_name'].'/ '.$student['StudentProfile']['last_name'].'
</div>
<div style="font-family:helvetica;font-size:9.5pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
'.$student['StudentProfile']['street']. ' '.$student['StudentProfile']['subdivision']. ' '.$student['StudentProfile']['city'].'<br>
'.'Tel: '.$student['StudentProfile']['telephone_contact']. ' Cel: '.$student['StudentProfile']['cell_phone'].'<br>
'.$student['Student']['email'].' 
</div>'.
		'<div style="font-family:helvetica; font-size:10.5pt;position:relative; margin: 0 auto; left: 0; right: 0; text-align: left;">
			<table width="100%" border="0">
				<tr><td width="100%"><strong>OBJETIVO PROFESIONAL</strong></td></tr>
			</table>
				  
			<table width="100%" border="0">
				<tr><td width="100%"><p>'.$student['StudentJobProspect']['professional_objective'].'</p></td></tr>
			</table><br>
			
			<table width="100%" border="0">
				<tr>
					<td width="22%"><strong>ÁREAS DE INTERÉS:</strong></td>
					<td width="78%">'.$areainter1.'</td>
				</tr>
			</table>
			
			<table width="100%" border="0">
				<tr><td><strong>FORMACIÓN ACADÉMICA</strong></td></tr>
			</table>

			  '.$licenciaturas.'<br>'.$especialidades.'<br>'.$maestrias.'<br>'.$doctorados.'<br>'.$mob2.'<br>'.$compet1.'<br>'.$experiencias2.
  '</div>';
$pdf->writeHTML($html, true, false, true, false, '');

$nombrepdf = $student['Student']['username'].'.pdf';
//Close and output PDF document
//$pdf->Output('oferta-plantilla.pdf', 'I');
//echo $pdf->Output('files/pdf' . DS . 'MYCV.pdf', 'F');
echo $pdf->Output('files/pdf' . DS . $nombrepdf, 'F');
?>

	
	<div class="col-md-12">
		<center>
		<div class="resizable-iframe" style ='margin-left: 60 px;'>
		<div style="height: 240px; width: 900px; top: 300px; background-color: transparent;" class="iframe-cover"></div>
		<iframe src="<?php echo $this->webroot; ?>files/pdf/<?php echo $nombrepdf ?>" style="width:900px; height:240px;" 
		frameborder="0">Your browser does not support inline frames or is currently configured not to display inline frames.</iframe></div>
		</center>
	</div>

	