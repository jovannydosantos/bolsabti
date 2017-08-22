<?php
	class StudentProfessionalExperience extends AppModel{

		var $name = 'StudentProfessionalExperience';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// ),
		);
		
		public $hasMany = array(
			'StudentWorkArea' => array(
				'className'  => 'StudentWorkArea',
				'foreignKey' => 'student_professional_experience_id',
				'dependent' => true, 	
			),
		);
		
		var $validate = array (
			
			'country' => array(
				'countryRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el país',          
					'last'    => true
				)
			),
		
			
			'company_name' => array(
				'company_nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la empresa / institución.',          
					'last'    => true
				),
			),
			
			'company_rotation' => array(
				'company_rotationRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el giro de la empresa.',          
					'last'    => true
				),
			),
		
		);
	} 
?>