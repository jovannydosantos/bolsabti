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


$html = '
<div style="font-family:helvetica;font-weight:bold;font-size:16pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
'.$student['StudentProfile']['name'].' / '.$student['StudentProfile']['second_last_name'].'/ '.$student['StudentProfile']['last_name'].'
</div>
<div style="font-family:helvetica;font-size:9.5pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
Folio: '.$student['StudentJobProspect']['Student']['id'].'<br>
'.$student['AcademicSituation']['academic_situation'].' / '.$student['AcademicSituation']['academic_situation'].' er'.' / '.$student['StudentProfile']['last_name'].') <br>
'.$student['StudentProfile']['street']. ' '.$student['StudentProfile']['subdivision']. ' '.$student['StudentProfile']['city'].'<br>
'.'Tel: '.$student['StudentProfile']['telephone_contact']. ' Cel: '.$student['StudentProfile']['cell_phone'].'<br>
'.$student['StudentJobProspect']['Student']['email'].' 
</div>

<div style="font-family:helvetica; font-size:10.5pt;position:relative; margin: 0 auto; left: 0; right: 0; text-align: left;">
    <table width="100%" border="0">
  <tr>
    <td width="100%"><strong>OBJETIVO PROFESIONAL</strong></td>

  </tr></table>
      <table width="100%" border="0">
  <tr>
    <td width="100%"><p>Nulla vel tellus odio. Pellentesque facilisis eros sit amet mattis iaculis. Curabitur mattis dui <br>
                    ficitur ullamcorper. Vivamus ut egestas lacus. Pellentesque pulvinar, mauris feugiat interdum luctus,<br> 
                    viverra nisi. Vestibulum accumsan sapien nec augue euismod, sed ornare nisi vulputate. Morbi diam e</p></td>

  </tr></table><br>
  <table width="100%" border="0">
  <tr>
    <td width="22%"><strong>ÁREAS DE INTERÉS:</strong></td>
    <td width="78%">área de interés1 / área de interés2 / área de interés3 / área de interés4</td>

  </tr></table>
<table width="100%" border="0">
  <tr>
    <td><strong>FORMACIÓN ACADÉMICA</strong></td>
  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td width="65%"><strong>Doctorado / Situación académica</strong></td>
    <td width="16%"><strong>Año de egreso:</strong></td>
    <td width="19%">(egresado/titulado)</td>
  </tr></table>
  <table width="100%" border="0">
    <tr>
    <td width="100%">Institución educativa</td>
  </tr>
</table>
  <table width="100%" border="0">
    <tr>
    <td width="100%">Área</td>
  </tr>
</table>
  <table width="100%" border="0">
    <tr>
    <td width="100%">Avance Semestre (solo estudiantes)</td>
  </tr>
</table>
<br>
  <table width="100%" border="0">
  <tr>
    <td width="65%"><strong>Maestría / Situación académica</strong></td>
    <td width="16%"><strong>Año de egreso:</strong></td>
    <td width="19%">(egresado/titulado)</td>
  </tr></table>
  <table width="100%" border="0">
    <tr>
    <td width="100%">Institución educativa</td>
  </tr>
</table>
  <table width="100%" border="0">
    <tr>
    <td width="100%">Área</td>
  </tr>
</table>
<br>
  <table width="100%" border="0">
  <tr>
    <td width="65%"><strong>Licenciatura / Situación académica</strong></td>
    <td width="16%"><strong>Año de egreso:</strong></td>
    <td width="19%">(egresado/titulado)</td>
  </tr></table>
  <table width="100%" border="0">
    <tr>
    <td width="100%">Institución educativa</td>
  </tr>
</table>
  <table width="100%" border="0">
    <tr>
    <td width="100%">Carrera</td>
  </tr>
</table>
<br>
<table width="100%" border="0">
  <tr>
    <td><strong>MOVILIDAD ESTUDIANTIL</strong></td>
  </tr></table>
  
<table width="100%" border="0">
  <tr>
    <td width="33%"><strong>Institución educativa: </strong></td>
    <td width="33%"><strong>Institución educativa: </strong></td>
    <td width="34%"><strong>Institución educativa: </strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="33%">Nombre del programa</td>
    <td width="33%">Nombre del programa</td>
    <td width="34%">Nombre del programa</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="33%">País</td>
    <td width="33%">País</td>
    <td width="34%">País</td>
  </tr>
</table>
<br>
  <table width="100%" border="0">
  <tr>
    <td width="38%"><strong>COMPETENCIAS PROFESIONALES</strong></td>
    <td width="62%">competencia1 / competencia2 / competencia3 / competencia4</td>

  </tr></table>

<br><table width="100%" border="0">
  <tr>
    <td><strong>EXPERIENCIA PROFESIONAL</strong></td>
  </tr></table>  <table width="100%" border="0">
  <tr>
    <td width="60%"><strong>Empresa o institución</strong></td>
    <td width="17%"><strong>Año de ingreso -</strong></td>
    <td width="23%"><strong>Año de egreso/Actual</strong></td>
  </tr></table>  <table width="100%" border="0">
    <tr>
    <td width="100%">Área de experiencia</td>
  </tr>
</table><table width="100%" border="0">
  <tr>
    <td width="22%"><ul>
      <li><strong>Puesto 1</strong></li>
    </ul></td>
    <td width="78%">Permanencia en el puesto</td>

  </tr></table><table width="100%" border="0">
  <tr>
    <td width="22%"><ul>
      <li><strong>Puesto 2</strong></li>
    </ul></td>
    <td width="78%">Permanencia en el puesto</td>

  </tr></table><table width="100%" border="0">
  <tr>
    <td width="22%"><ul>
      <li><strong>Puesto 3</strong></li>
    </ul></td>
    <td width="78%">Permanencia en el puesto</td>

  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td width="27%"><strong>Principales Responsabilidades</strong></td>
    <td width="73%">(No más de 5 con una extensión de 2 a 3 renglones)</td>

  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td width="22%"><ul>
      <li><strong> 1</strong></li>
    </ul></td>
    <td width="78%">Permanencia en el puesto</td>

  </tr></table><table width="100%" border="0">
  <tr>
    <td width="22%"><ul>
      <li><strong> 2</strong></li>
    </ul></td>
    <td width="78%">Permanencia en el puesto</td>

  </tr></table><table width="100%" border="0">
  <tr>
    <td width="22%"><ul>
      <li><strong> 3</strong></li>
    </ul></td>
    <td width="78%">Permanencia en el puesto</td>

  </tr></table>

</div>';

$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
//$pdf->Output('oferta-plantilla.pdf', 'I');
echo $pdf->Output('files/pdf' . DS . 'MYCV.pdf', 'F');

echo('<pre>');
var_dump($student);
echo('</pre>');