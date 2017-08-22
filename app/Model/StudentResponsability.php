<?php
	class StudentResponsability extends AppModel{

		var $name = 'StudentResponsability';
		
		public $belongsTo = array(
			'StudentWorkArea' => array(
				'className' => 'StudentWorkArea',
				'foreignKey' => 'student_work_area_id',
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