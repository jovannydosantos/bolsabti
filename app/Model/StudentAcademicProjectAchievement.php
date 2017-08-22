<?php
	class StudentAcademicProjectAchievement extends AppModel{

		var $name = 'StudentAcademicProjectAchievement';
		
		public $belongsTo = array(
			'StudentAcademicProject' => array(
				'className' => 'StudentAcademicProject',
				'foreignKey' => 'student_academic_project_id',
			)
		);
		
		var $validate = array (
			
			'achievement' => array(
				'achievementRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el logro adquirido en el puesto',          
					'last'    => true
				)
			),
		
		
		);
	} 
?>