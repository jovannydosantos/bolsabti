<?php
	class StudentProfessionalSkill extends AppModel{

		var $name = 'StudentProfessionalSkill';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// ),
			'Competency' => array(
				'className' => 'Competency',
				'foreignKey' => 'competency_id',
			)
		);

	} 
?>