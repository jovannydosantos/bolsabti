<?php 
  $this->layout = 'company'; 
?>

<?php
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
$pdf->setPageMark();
$txt = <<<EOD
EOD;

	// print a block of text using Write()
	$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
	
		// DATOS DEL RESPONSABLE DE LA OFERTA
			if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): 
				if($oferta['CompanyJobOffer']['same_contact']=='n'):
					$conName = '<strong>Nombre: </strong>' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'];
				else:
					$conName = '<strong>Nombre: </strong>' . $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'];
				endif;
			else:
				$conName = '<strong>Confidencial</strong>';
			endif;

			  if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): 
				if($oferta['CompanyJobOffer']['same_contact']=='n'):
					  $conTelefono = '<strong>Tel: </strong>(' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'];
					  if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
						 $conTelefono .=' - ext. '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
					  endif;
				else:
					 $conTelefono ='<strong>Tel: </strong>('.$oferta['Company']['CompanyContact']['long_distance_cod'].') '. $oferta['Company']['CompanyContact']['telephone_number'];
					 if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
						 $conTelefono .=' - ext. '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
					  endif;
				endif;
			  else:
				   $conTelefono = '';
			  endif;

			  if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): 
				if($oferta['CompanyJobOffer']['same_contact']=='n'):
					  $conEmail = '<strong>Correo: </strong>'.$oferta['CompanyJobOffer']['company_email'];
				else:
					 $conEmail ='<strong>Correo: </strong>'.$oferta['Company']['email'];
				endif;
			  else:
				   $conEmail = '';
			  endif;
			  
			  if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): 
				if($oferta['CompanyJobOffer']['same_contact']=='n'):
					if($oferta['CompanyJobOffer']['responsible_cell_phone']<>''):
						$conCel = '<strong>Cel: </strong>(' .$oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']. ') ' .$oferta['CompanyJobOffer']['responsible_cell_phone'];
					else:
						$conCel = '';
					endif;
				else:
					if($oferta['CompanyJobOffer']['responsible_cell_phone']<>''):
						$conCel ='<strong>Cel: </strong>('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'];
					else:
						$conCel = '';
					endif;
				endif;
			  else:
				   $conCel = '';
			  endif;
		  
			  if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): 
				if($oferta['CompanyJobOffer']['same_contact']=='n'):
					  $conSede = '';
				else:
					 $conSede ='<strong>Sede: </strong>'. 
						$oferta['Company']['CompanyProfile']['state_sede'] . ' - ' .
						$oferta['Company']['CompanyProfile']['city_sede'] . ' - ' .
						$oferta['Company']['CompanyProfile']['subdivision_sede'] . ' - ' .
						$oferta['Company']['CompanyProfile']['street_sede'];
				endif;
			  else:
				   $conSede = '';
			  endif;
		  
  // PERFIL DE OFERTA
  
  
  
	//Atrapar disponibilidad para viajar y cambiar de residencia
						$dispviaj = '';
						$dispchange = '';

                        if($oferta['CompanyJobContractType']['mobility']=='s'):
                          $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> si</td></tr></table>';
                           if($oferta['CompanyJobContractType']['mobility_option']=='1'):
                             $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> Dentro del país - '.$oferta['CompanyJobContractType']['mobility_city'].'</td></tr></table>';
                          else:
                          $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> Fuera del país - '.$oferta['CompanyJobContractType']['mobility_city'].'</td></tr></table>';
                          endif;
                        else:
                             $dispviaj = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para viajar:</strong> no</td></tr></table>';
                        endif;
                   
                    if($oferta['CompanyJobContractType']['change_residence']=='s'):
                      $dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> si</td></tr></table>';
                          if($oferta['CompanyJobContractType']['change_residence_option']=='1'):
                         $dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Dentro del país - '.$oferta['CompanyJobContractType']['change_residence_state'].'</td></tr></table>';
                          else:
                          $dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> Fuera del país - '.$oferta['CompanyJobContractType']['change_residence_state'].'</td></tr></table>';
                          endif;
                        else:
                         $dispchange = '<table width="100%" border="0"><tr><td><strong>Disponibilidad para cambiar de residencia:</strong> no</td></tr></table>';
                     endif;

					 $prestacion = '';
					 if(!empty($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'])):
						$numeroPrestaciones = count($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit']);
						foreach ($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'] as $key => $prestaciones) {
							$numeroPrestaciones --;
							if($prestaciones['benefit_id'] <> ''):
								$prestacion .= ''. $Prestaciones[$prestaciones['benefit_id']];
							else:
								$prestacion .= '';
							endif;
							($numeroPrestaciones > 0) ? $prestacion .=  ' / ' : '';
						}
					endif;
					
					$otrasPrestaciones ='';
					if($oferta['CompanyJobContractType']['other_benefits']<>''):
						$otrasPrestaciones .= '<table width="100%" border="0"><tr><td><strong>Otras prestaciones: </strong>'.$oferta['CompanyJobContractType']['other_benefits'].'</td></tr></table>';
					endif;
					

	$caracteres = strlen($oferta['CompanyJobProfile']['id']);
    $faltantes = 5 - $caracteres; 
        if($faltantes > 0):
            $ceros = '';
            for($cont=0; $cont<=$faltantes;$cont++):
                $ceros .= '0';
            endfor;
			$folio = $ceros.$oferta['CompanyJobProfile']['id'];
        else:
            $folio = strlen($oferta['CompanyJobProfile']['id']);
       endif;

     // atrapa idiomas
	$idio1 = '';
	$idio2 = '';     
	$numidio = 0;
                    
    $fcmdidio ='';
	if(!empty($oferta['CompanyJobLanguage'])):

		foreach($oferta['CompanyJobLanguage'] as $k => $idioma):
			$fcmdidio='Conversación- '.$NivelesIdioma[$idioma['conversation_level']];
            $idio1 .= '<tr><td width="10%">'.$idioma['Lenguage']['lenguage'].'</td><td width="26%">Lectura- '.$NivelesIdioma[$idioma['reading_level']]. '</td><td width="35%">Escritura- '.$NivelesIdioma[$idioma['writing_level']]. '</td><td width="30%">'.$fcmdidio.'</td></tr>';  
			$numidio++;
		endforeach; 
		
		$idio2 = '<br><table width="100%" border="0"><tr><td><strong>Idiomas:</strong></td></tr></table>';
        if($numidio > 0):
			$idio2 .='<table width="100%" border="0">'.$idio1.'</table>';
		endif;
    endif;

    // atrapa computo
	$compu1 = '';
	$compu2 = '';     
	$numcompu = 0;
	$fcmdcompu ='';
	
	if(!empty($oferta['CompanyJobComputingSkill'])):

		foreach($oferta['CompanyJobComputingSkill'] as $k => $computo):
			$fcmdcompu = ''.$NivelesSoftware[$computo['level']];
            $compu1 .= '<tr><td width="36%">' . $Tecnologias[$computo['category_id']] .':  </td><td width="35%">';
			if($computo['name']<>''):
				$compu1 .= $software[$computo['name']];
			else:
				$compu1 .= $computo['other'];
			endif;
			
			$compu1 .= '</td><td width="50%">'.$fcmdcompu.'</td></tr>';  
			$numcompu++;
          
        endforeach; 
		
		$compu2 = '<br><table width="100%" border="0"><tr><td><strong>Cómputo:</strong></td></tr></table>';
        if($numcompu > 0):
			$compu2 .='<table width="100%" border="0">'.$compu1.'</table>';
		endif;
    endif;

	$dicapacidad = '';

    if($oferta['CompanyJobProfile']['disability'] == 's'):
        $dicapacidad .= $TiposDiscapacidad[$oferta['CompanyJobProfile']['disability_type']];
    else:
        $dicapacidad .= 'Ninguna';
    endif;

	$conOfert = '';

	if($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n'):
		$conOfert .= $oferta['Company']['CompanyProfile']['company_name'];
	else:
		$conOfert .= '<strong>Oferta Confidencial</strong>';
	endif;

	$conSalary = '';
 
	if($oferta['CompanyJobContractType']['confidential_salary'] == 'n'):
		$conSalary .= '<strong>Sueldo: </strong>'.$oferta['CompanyJobContractType']['Salary']['salary'].' m.n.';
	else:
		if($oferta['CompanyJobContractType']['confidential_salary'] == 's'):
            $conSalary .= '<strong>Sueldo: </strong>'.'Confidencial';
		else:
            $conSalary .= '';
      endif;
	endif;

  $conPuesto = '';

  if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): 
    if($oferta['CompanyJobOffer']['same_contact']=='n'):
          $conPuesto .= '<strong>Puesto: </strong>' . $oferta['CompanyJobOffer']['responsible_position'];
    else:
         $conPuesto .='<strong>Puesto: </strong>'.$oferta['Company']['CompanyContact']['job_title'];
    endif;
  else:
       $conPuesto .= '';
  endif;

  

  $tipoContrato = '';
  if(!empty($oferta['CompanyJobContractType']['ContractType']['contract_type'])):
    if($oferta['CompanyJobContractType']['ContractType']['contract_type'] <> ''):
         $tipoContrato .= $oferta['CompanyJobContractType']['ContractType']['contract_type'];
    else:
        $tipoContrato .= '';
    endif;
  endif;

  $jornadaLab = '';
  if(!empty( $oferta['CompanyJobContractType']['Workday']['workday'])):
    if($oferta['CompanyJobContractType']['Workday']['workday'] <> ''):
         $jornadaLab .=  $oferta['CompanyJobContractType']['Workday']['workday'];
    else:
        $jornadaLab .= '';
    endif;
  endif;

	$lugarJob = '';
	$lugarJob .=
            $oferta['CompanyJobContractType']['state'] . ' - ' .
            $oferta['CompanyJobContractType']['subdivision'] . ' - ' .
            $oferta['CompanyJobContractType']['location_reference']; 
  
	// print a block of text using Write()
	$pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
	$html = 
	'<table width="100%" border="0">
	<tr><td><div style="font-family:helvetica;font-weight:bold;font-size:14pt; position:relative; margin: -30px 0px 0px 0px; left: 0; right: 0; text-align: center;">'.$conOfert.'</div></td></tr><br>
	<tr><td><div style="font-family:helvetica;font-weight:bold;font-size:18pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">'.$oferta['CompanyJobProfile']['job_name'].'</div></td></tr>
	<tr><td><div style="font-family:helvetica;font-size:11pt;text-align: center;">Folio: '.$folio.' / Vigencia: '. date("d/m/Y",strtotime($oferta['CompanyJobProfile']['expiration'])).'</div></td></tr>
	</table>
	<div style="font-family:helvetica; font-size:10.5pt;position:relative; margin: 0 auto; left: 0; right: 0; text-align: left;">
	
	<table width="100%" border="0"><tr><td><strong>RESPONSABLE DE LA OFERTA</strong></td></tr></table>
	
	<table width="100%" border="0"><tr><td>'.$conName.'</td><td width="50%">'.$conPuesto.'</td></tr></table>';

	if($conTelefono<>''):
		$html.= '<table width="100%" border="0"><tr><td>'.$conTelefono.'</td><td>'.$conCel.'</td></tr></table>';
	endif;

	if($conEmail<>''):
		$html.= '<table width="100%" border="0"><tr><td>'.$conEmail.'</td></tr></table>';
	endif;
	  
	$html.= '<br>
		<table width="100%" border="0">
		<tr>
			<td width="71%"><strong>PERFIL DE LA OFERTA</strong></td>
			<td width="27%"><strong>NÚMERO DE VACANTES:</strong></td>
			<td width="13%">'.$oferta['CompanyJobProfile']['vacancy_number'].'</td>
		 </tr>
		</table>
		
		<table width="100%" border="0">
		<tr>
			<td width="7%"><strong>Giro:</strong></td>
			<td width="90%">'.$oferta['Rotation']['rotation'].'</td>
		</tr>
		</table>
		
		<table width="100%" border="0">
		<tr>
			<td width="17%"><strong>Área de interés: </strong></td>
			<td width="54%">' . $oferta['ExperienceArea']['experience_area'].'</td>
			<td width="13%"><strong>Experiencia:</strong></td>
			<td width="37%">' . $oferta['ExperienceTime']['experience_time'].'</td>
		</tr>
		</table>
		
		<br>
		
		<table width="100%" border="0">
		<tr>
			<td width="100%" valign="left"><strong>Actividades a desarrollar:</strong></td>
		</tr>
		</table>
 
		<table width="100%" border="0">
		<tr>
			<td width="100%"><p>'. $oferta['CompanyJobProfile']['activity'].'</p></td>
		</tr>
		
		</table>
		
		<br>
		
		<table width="100%" border="0">
		<tr>
			<td><strong>Oferta Incluyente: </strong> ' .$dicapacidad.'</td>
		</tr>
		</table>
		
		<br>
		
		<table width="100%" border="0">
		<tr>
		  <td><p><strong>MODALIDAD  DE CONTRATACIÓN</strong><strong> </strong></p></td>
		</tr>
		</table>
  
		<table width="100%" border="0">
		<tr>
		  <td>'.$conSalary .'</td>
		</tr>
		</table>

		<table width="100%" border="0">
		<tr>
			<td width="15%"><strong>Prestaciones: </strong></td>
			<td width="85%">'.$prestacion.'</td>
		</tr></table>';
		
		if($otrasPrestaciones<>''):
			$html .= $otrasPrestaciones;
		endif;
		
		$html .= '
		<br>
		
		<table width="100%" border="0">
		<tr>
			<td width="18%"><strong>Lugar de trabajo:</strong></td>
			<td width="77%">'.$lugarJob.'</td>
		</tr>
		</table>
		
		<table width="100%" border="0">
		<tr>
			<td width="18%"><strong>Tipo  de contrato: </strong></td>
			<td width="54%">' .$tipoContrato.'</td>
			<td width="23%"><strong>Duración  del contrato: </strong>
			'.$oferta['CompanyJobContractType']['contract_length'].'</td>
		</tr>
		</table> 
  
		<table width="100%" border="0">
		<tr>
			<td width="18%"><strong>Jornada  laboral: </strong></td>
			<td width="54%">' . $jornadaLab.'</td>
			<td width="10%"><strong>Horario: </strong></td>
			<td width="20%">'.$oferta['CompanyJobContractType']['schedule'].'</td>
		</tr>
		</table>
  
		<table width="100%" border="0">
		<tr>
			<td width="100%">' . $dispviaj.'</td>
		</tr>
		</table>

		<table width="100%" border="0">
		<tr>
			<td width="100%">' . $dispchange.'</td>
		</tr>
		</table>
		
		<br>';
		
	if(count($oferta['CompanyCandidateProfile']>0) OR ($idio2<>'') OR ($compu2<>'') ):
		$html.='
		<table width="100%" border="0">
		<tr>
			<td><p><strong>PERFIL DEL CANDIDATO</strong></p></td>
		</tr>
		</table>';

		if(count($oferta['CompanyCandidateProfile'])>0):
			$html.='
				<table width="100%" border="0">
				<tr>
					<td><strong>Nivel de estudios:</strong></td>
				</tr><br>';
				
				
				foreach($oferta['CompanyCandidateProfile'] as $nivel):	
					$html.= '<tr><td><strong>'.$nivel['AcademicLevel']['academic_level'].' - '.$nivel['AcademicSituation']['academic_situation'];
					if($nivel['academic_situation_id']==1):
						$html.= ' ' . $nivel['semester'] . '° semestre';
					endif;
					$html.= ':</strong></td></tr>';
					$numeroCarreras = count($nivel['CompanyJobRelatedCareer']);	
					
					$html .= '<tr><td>';
						foreach($nivel['CompanyJobRelatedCareer'] as $k => $carrera):
							$numeroCarreras--;
							$html .= $CarrerasAreas[$carrera['career_id']];
							$html .= ($numeroCarreras > 0) ? ' / ' : '<br>';
						endforeach;	
					$html .=  '</td></tr>';
				endforeach;
				
			$html.='</table>';
		endif;

		if($idio2<>''):
			$html.='
				<br>
				<table width="100%" border="0">
				<tr>
					<td width="100%">'.$idio2.'</td>
				</tr>
				</table>';
		endif;
		
		if($compu2<>''):
			$html.='
				<br>
				<table width="100%" border="0">
				<tr>
					<td>'.$compu2.'</td>
				</tr>
				</table>';
		endif;
		
		$html.='</div>';
	endif;
	
	$pdf->writeHTML($html, true, false, true, false, '');

	// Print a text
	$competencias = '';
	$numero = 1;
	if(!empty($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'])):
		foreach ($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $key => $competencia) {
		  $competencias .= '<br>'.$numero.'. '. $tiposCompetencias[$competencia['competency_id']];
		  $numero++;
		}
	endif;

	$html = '<div style="font-family:helvetica; font-size:10.5pt;position:relative; margin: 0 auto; left: 0; right: 0; text-align: left;">';
	
	if($oferta['CompanyJobProfile']['professional_skill']<>''):
		$html.= '
			<br>
			<table width="100%" border="0">
			<tr>
				<td><p><strong>Conocimiento y habilidades profesionales:</strong></p></td>
			</tr>
			</table>
			
			<table width="100%" border="0">
			<tr>
				<td>'.$oferta['CompanyJobProfile']['professional_skill'].'</td>
			</tr>
			</table>';
	endif;	
	
	if($competencias<>''):
		$html.= '
			<br>
			<table width="100%" border="0">
			<tr>
				<td><p><strong>Competencias requeridas por el puesto:</strong></p></td>
			</tr>
			</table>
			
			<table width="100%" border="0">
			<tr>
			<td>'.$competencias .'</td>
			</tr>
			</table>';
	endif;

	$html.= '</div>';
	
	$pdf->writeHTML($html, true, false, true, false, '');

	//Close and output PDF document
	//$pdf->Output('oferta-plantilla.pdf', 'I');
	$namePdf = $oferta['CompanyJobProfile']['job_name'].'.pdf';
	echo $pdf->Output('files/pdf' . DS . $namePdf, 'F');

//----------------------------------------- TERMINA ARMADO CV PDF ---------------------------------------------
?>
	<div class="container"  style="width: 100%;  margin-right: 50px; margin-top: 30px;" align="center">
		
	<?php echo $this->Session->flash(); ?>

	<iframe src="<?php echo $this->webroot; ?>files/pdf/<?php echo $namePdf ?>" style="width:700px; height:980px;" frameborder="0">Your browser does not support inline frames or is currently configured not to display inline frames.</iframe>

</div>