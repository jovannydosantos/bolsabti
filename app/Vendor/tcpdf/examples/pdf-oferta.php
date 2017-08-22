<?php
//============================================================+
// File name   : example_051.php
// Begin       : 2009-04-16
// Last Update : 2011-06-01
//
// Description : Example 051 for TCPDF class
//               Full page background
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Full page background
 * @author Nicola Asuni
 * @since 2009-04-16
 */

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');


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
<div style="font-family:helvetica;font-weight:bold;font-size:14pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
Procter &amp; Gamble / Oferta  confidencial
</div>
<div style="font-family:helvetica;font-weight:bold;font-size:18pt; position:relative; margin: 0 auto; left: 0; right: 0; text-align: center;">
Brand Manager Jr.
</div>
<div style="font-family:helvetica; font-size:10.5pt;position:relative; margin: 0 auto; left: 0; right: 0; text-align: left;">
<table width="100%" border="0">
  <tr>
    <td><strong>RESPONSABLE DE LA OFERTA</strong></td>
  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td><strong>Nombre / Confidencial:</strong> </td>
    <td>Marisol Gómez Carrera</td>
    <td width="10%"><strong>Puesto:</strong></td>
    <td width="40%">Ejecutiva de reclutamiento & selección</td>
  </tr></table>


     <table width="100%" border="0">   <tr><td width="5%"><strong>Tel:</strong></td>
    <td width="45%">55-5139-5690 – ext. 1450</td>
    <td width="10%"><strong>Cel:</strong></td>
    <td width="40%">044-55-4792-2789</td>
  </tr>
  </table>
  <table width="100%" border="0">
  <tr>
    <td width="6%"><strong>Sede:</strong></td>
    <td width="94%">México D.F. – Col. Polanco – Del. Cuauhtémoc - Homero 345</td>
  </tr>
</table>

  <table width="100%" border="0">
  <tr>
    <td width="45%"><strong>PERFIL DE LA OFERTA</strong></td>
    <td width="15%">&nbsp;</td>
    <td width="27%"><strong>NÚMERO DE VACANTES</strong></td>
    <td width="13%">4</td>
  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td width="7%"><strong>Giro: </strong></td>
    <td width="93%">Consumo masivo</td>
  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td width="7%"><strong>Área: </strong></td>
    <td width="43%">mercado emergentes</td>
    <td width="13%"><strong>Experiencia</strong></td>
    <td width="37%">4 años</td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td width="7%"><strong>Área: </strong></td>
    <td width="43%">publicidad y desarrollo</td>
    <td width="13%"><strong>Experiencia</strong></td>
    <td width="37%">2 años</td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td width="11%"><strong>Sub-área: </strong></td>
    <td width="89%">desarrollo de campañas 2.0</td>

  </tr></table>
  <br>
    <table width="100%" border="0">
  <tr>
    <td width="100%"><strong>Actividades a desarrollar</strong></td>

  </tr></table>
      <table width="100%" border="0">
  <tr>
    <td width="100%"><p>Investigación de mercados con  respecto al producto asignado<br>
      Encargado de la proyección de  nuevos mercados<br>
      Responsable de los reportes de  las campañas publicitarias en redes sociales</p></td>

  </tr></table>
  <br>    <table width="100%" border="0">
  <tr>
    <td width="19%"><strong>Oferta Incluyente:</strong></td>
    <td width="81%">discapacidad auditiva / discapacidad motriz</td>

  </tr></table>
<br>
<table width="100%" border="0">
  <tr>
    <td><p><strong>MODALIDAD  DE CONTRATACIÓN</strong><strong> </strong></p></td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td width="9%"><strong>Sueldo:</strong></td>
    <td width="41%">$30,000 m.n. / confidencial</td>
    <td width="18%"><strong>Periodo de pago:</strong></td>
    <td width="32%"><p>mensual</p></td>
  </tr></table>
  
    <table width="100%" border="0">
  <tr>
    <td width="15%"><strong>Prestaciones: </strong></td>
    <td width="85%">SGMM / vales de despensa / préstamo de nómina /  comedor / estacionamiento</td>
  </tr></table><br>
      <table width="100%" border="0">
  <tr>
    <td width="23%"><strong>Lugar de trabajo:</strong></td>
    <td width="77%">México D.F. – Col. Polanco – Del. Cuauhtémoc - Homero  345</td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td width="23%"><strong>Tipo  de contrato: </strong></td>
    <td width="27%">planta</td>
    <td width="28%"><strong>Duración  del contrato: </strong></td>
    <td width="22%">Indefinido</td>
  </tr></table>  <table width="100%" border="0">
  <tr>
    <td width="23%"><strong>Jornada  laboral: </strong></td>
    <td width="27%">tiempo completo</td>
    <td width="16%"><strong>Horario: </strong></td>
    <td width="14%">9 am – 5 pm </td>
        <td width="9%"><strong>/ Días</strong></td>
            <td width="11%">L - V</td>
  </tr></table>
      <table width="100%" border="0">
  <tr>
    <td width="41%"><strong>Disponibilidad para viajar:</strong></td>
    <td width="59%">fuera del país – Alemania</td>

  </tr></table>    <table width="100%" border="0">
  <tr>
    <td width="48%"><strong>Disponibilidad para cambiar residencia:</strong></td>
    <td width="52%">dentro del país – Monterrey / Nuevo león</td>

  </tr></table>
<br>
<table width="100%" border="0">
  <tr>
    <td><p><strong>PERFIL DE CANDIDATO</strong><strong></strong></p></td>
  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td><p><strong>Licenciatura - titulados:</strong><strong></strong></p></td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td><ul>
      <li>Mercadotecnía</li>
      <li>Publicidad</li>
      <li>Administración de empresas</li>
    </ul></td>
  </tr></table><br>
    <table width="100%" border="0">
  <tr>
    <td><p><strong>Maestría - estudiante 3er. Semestre / Trunca:</strong><strong></strong></p></td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td><ul>
      <li>Ingeniería de proyectos</li>
      <li>MBA</li>
    </ul></td>
  </tr></table>
  <br>
      <table width="100%" border="0">
  <tr>
    <td><p><strong>Idiomas</strong><strong></strong>:</p></td>
  </tr></table>
      <table width="100%" border="0">
  <tr>
    <td width="18%"><ul>
      <li><strong>Inglés</strong></li>
    </ul></td>
    <td width="82%">lectura –  avanzado / escritura – básico / conversación – medio</td>

  </tr></table>    <table width="100%" border="0">
  <tr>
    <td width="18%"><ul>
      <li><strong>Francés</strong></li>
    </ul></td>
    <td width="82%">lectura –  avanzado / escritura – básico / conversación – medio</td>

  </tr></table>
  <br>
    <table width="100%" border="0">
  <tr>
    <td><p><strong>Cómputo</strong></p></td>
  </tr></table>
      <table width="100%" border="0">
  <tr>
    <td width="36%"><ul>
      <li><strong>Software</strong></li>
    </ul></td>
    <td width="64%">PHP – avanzado</td>

  </tr></table>    <table width="100%" border="0">
  <tr>
    <td width="36%"><ul>
      <li><strong>Sistema Operativo</strong></li>
    </ul></td>
    <td width="64%">PHP – avanzado</td>

  </tr></table>
  <table width="100%" border="0">
  <tr>
    <td width="36%"><ul>
      <li><strong>Lenguaje de programación</strong></li>
    </ul></td>
    <td width="64%">PHP – avanzado</td>

  </tr></table><br>
</div>';
$pdf->writeHTML($html, true, false, true, false, '');



// add a page
$pdf->AddPage();


// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'image_demo1.jpg';
$pdf->setPrintFooter(true);
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


// Print a text
$html = '<div style="font-family:helvetica; font-size:10.5pt;position:relative; margin: 0 auto; left: 0; right: 0; text-align: left;"> 
<br> <br> <br> <br><table width="100%" border="0">
  <tr>
    <td><p><strong>Conocimiento y habilidades profesionales:</strong></p></td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td><ul>
      <li>
        Certificación en Java Script
      </li>
      <li>Curso en manejo delos módulos de SAP FF y MA</li>
    </ul></td>
  </tr></table>
  <br>
      <table width="100%" border="0">
  <tr>
    <td><p><strong>Competencias requeridas por el puesto</strong></p></td>
  </tr></table>
    <table width="100%" border="0">
  <tr>
    <td><ol>
      <li>Proactividad</li>
      <li>Creatividad</li>
      <li>Trabajo bajo presión</li>
      <li>Resolución de problemas</li>
<li>Rápido aprendizaje</li>
<li>Compromiso</li>
<li>Actitud de servicio</li>
    </ol></td>
  </tr></table></div>';
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('oferta-plantilla.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
