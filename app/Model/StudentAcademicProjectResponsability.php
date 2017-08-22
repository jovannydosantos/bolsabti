<?php
	class StudentAcademicProjectResponsability extends AppModel{

		var $name = 'StudentAcademicProjectResponsability';
		
		public $belongsTo = array(
			'StudentAcademicProject' => array(
				'className' => 'StudentAcademicProject',
				'foreignKey' => 'student_academic_project_id',
			)
		);
		
		var $validate = array (
			
			'responsability' => array(
				'responsabilityRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la responsabilidad adquirida',          
					'last'    => true
				)
			),
			
		
		);
	} 
?>