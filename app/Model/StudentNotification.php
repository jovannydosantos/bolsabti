<?php
	class StudentNotification extends AppModel{
		
		var $name = 'StudentNotification';
		
		public $belongsTo = array(
				'CompanyJobProfile' => array(
											'className'  => 'CompanyJobProfile',
											'foreignKey' => 'company_job_profile_id',
											'dependent' => false, 	
											),
				'Student' => array(
											'className'  => 'Student',
											'foreignKey' => 'student_id',
											'dependent' => false, 	
											),
				'Company' => array(
											'className'  => 'Company',
											'foreignKey' => 'company_id',
											'dependent' => false, 	
											),
								);
					
					
		var $validate = array (
			'company_job_profile_id' => array(
				'company_job_profile_idRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
		);				
	}
?>