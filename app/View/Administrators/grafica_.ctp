<?php
	App::import('Vendor', 'Classes/PHPExcel');
		
	$workbook = new PHPExcel();
	$workbook->getProperties()->setCreator("SISBUT UNAM")
								 ->setLastModifiedBy("SISBUT UNAM")
								 ->setTitle("Reporte - Universitarios")
								 ->setSubject("Reporte - Universitarios")
								 ->setDescription("Reporte - Universitarios")
								 ->setKeywords("Reporte - Universitarios")
								 ->setCategory("Reporte - Universitarios");
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
		
	// Cargamos los titulos de la hoja
		$workbook->setActiveSheetIndex(0)->setCellValue('A1','SISBUT UNAM');
		$workbook->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
	//Se combinan las celdas
		$workbook->setActiveSheetIndex(0)->mergeCells('A2:C2');
		
		$workbook->setActiveSheetIndex(0)->setCellValue('A2','Informe de currículums');
		$workbook->getActiveSheet()->getStyle('A2')->applyFromArray($styleTextArray);
		$workbook->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleBorderArray);
	
		$workbook->getActiveSheet()->getStyle('A3:C3')->applyFromArray($styleTextArray2);
		$workbook->getActiveSheet()->getStyle('A3:C3')->applyFromArray($styleBorderArray2);
		$workbook->getActiveSheet()->getColumnDimension('A')->setWidth(27);
		$workbook->getActiveSheet()->getColumnDimension('B')->setWidth(27);
		$workbook->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		
	//Se agregan los titulos de las celdas
		
	
		$workbook->getActiveSheet()->getStyle('A4:C4')->applyFromArray($styleTextArray);
		$workbook->getActiveSheet()->getStyle('A4:C4')->applyFromArray($styleBorderArray);
	
		$arrayDescription = array('Fechas','Activos','Inactivos');
		
		$index = 0;
		for($i = 'A'; $i <='C'; $i++){
			//Se asigna la descripción de los encabezados
			$workbook->setActiveSheetIndex(0)->setCellValue($i.'5',$arrayDescription[$index]);
			$workbook->getActiveSheet()->getStyle($i.'5')->getFont()->setSize(11);
			$workbook->getActiveSheet()->getStyle($i.'5')->getFont()->setBold(true);
			
			// Se ajustan las columnas al tamaño
			$workbook->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
			// Se incrementa la columna
			$index++;
		}
		
		$sheet->fromArray(  
            array(
                array('Courses','A','B','C','D'),
                array('PHP','130','170','90','30'),  
                array('JAVA','100','50','110','80'),  
                array('ASP.NET','110','200','40','140'),  
                array('C#','60','80','60','40'),
                array('Python','120','130','150','100'),
                array('Perl','160','180','160','140'),
                )  
        );

		//Fechas
		$workbook->setActiveSheetIndex(0)->setCellValue('A6','12/02/2015');
		$workbook->setActiveSheetIndex(0)->setCellValue('A7','12/02/2015');
		
		// Activos
		$workbook->setActiveSheetIndex(0)->setCellValue('B6',23);
		$workbook->setActiveSheetIndex(0)->setCellValue('B7',45);
		
		// Inactivos
		$workbook->setActiveSheetIndex(0)->setCellValue('C6',54);
		$workbook->setActiveSheetIndex(0)->setCellValue('C7',6);
		
		$labels = array(
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$5', null, 1),
			new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$5', null, 1),
		);

		$categories = array(
		  new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$6:$A$17', null, 12),  		  
		);
		$values = array(
		  new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$6:$B$17', null, 12),   
		  new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$6:$C$17', null, 12),  
		  
		);
	
	
    $series = new PHPExcel_Chart_DataSeries(
      PHPExcel_Chart_DataSeries::TYPE_BARCHART ,     	// plotType
      PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  	// plotGrouping
      array(0),                                   		// plotOrder
      $labels,                                        	// plotLabel
      $categories,                                 		// plotCategory
      $values                                        	// plotValues
    );  
	
    $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
    $layout1  = new PHPExcel_Chart_Layout();    			// Create object of chart layout to set data label 
    $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
    $title    = new PHPExcel_Chart_Title('Informe de currículums');  
    $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
    $xTitle   = new PHPExcel_Chart_Title('Rango de fechas');
    $yTitle   = new PHPExcel_Chart_Title('Currículums');
    $chart    = new PHPExcel_Chart(
										'chart1',        // name
										$title,          // title
										$legend,		 // legend 
										$plotarea,       // plotArea
										true,            // plotVisibleOnly
										0,               // displayBlanksAs
										$xTitle,         // xAxisLabel
										$yTitle          // yAxisLabel
    ); 
	
    $chart->setTopLeftPosition('F2');
    $chart->setBottomRightPosition('O16');
    $sheet->addChart($chart);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Informe de currículums.xlsx"');
	header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
    $writer->setIncludeCharts(TRUE);
	$writer->save('php://output');
	exit;
?>