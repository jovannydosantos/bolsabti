<?php
	class Report extends AppModel{

		var $name = 'Report';
		
			var $validate = array (
			
				'fecha_contratacion' => array(
					'fecha_contratacionRule-1' => array(
						'rule'    => 'notEmpty',
						'required'=> true,
						'message' => 'Este campo no pueden estar vacio.',          
						'last'    => true
					),
					'fecha_contratacionRule-2' =>array(
						'rule'    => 'date',
						'message' => 'Ingrese una fecha válida para este campo.',
						'last'    =>true
					),
				)
			);
			
			public $belongsTo = array(
			'CompanyJobProfile' => array(
				'className'  => 'CompanyJobProfile',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'Company' => array(
				'className'  => 'Company',
				'foreignKey' => 'company_id',
				'dependent' => true, 	
			),
			'Student' => array(
				'className'  => 'Student',
				'foreignKey' => 'student_id',
				'dependent' => true, 	
			),
		);
	} 
?>