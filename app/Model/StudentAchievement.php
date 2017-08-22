<?php
	class StudentAchievement extends AppModel{

		var $name = 'StudentAchievement';
		
		public $belongsTo = array(
			'StudentWorkArea' => array(
				'className' => 'StudentWorkArea',
				'foreignKey' => 'student_work_area_id',
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