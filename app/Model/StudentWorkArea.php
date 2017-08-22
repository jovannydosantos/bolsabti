<?php
	class StudentWorkArea extends AppModel{

		var $name = 'StudentWorkArea';
		
		public $belongsTo = array(
			'StudentProfessionalExperience' => array(
				'className' => 'StudentProfessionalExperience',
				'foreignKey' => 'student_professional_experience_id',
			),
			'ExperienceArea' => array(
				'className' => 'ExperienceArea',
				'foreignKey' => 'experience_area',
			),
			
		);
		
		public $hasMany = array(
			'StudentResponsability' => array(
				'className'  => 'StudentResponsability',
				'foreignKey' => 'student_work_area_id',
				'dependent' => true, 	
			),
			'StudentAchievement' => array(
				'className'  => 'StudentAchievement',
				'foreignKey' => 'student_work_area_id',
				'dependent' => true, 	
			),
		);
		
		var $validate = array (
			
			'job_name' => array(
				'job_nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Indique el nombre del puesto',          
					'last'    => true
				)
			),
			
			// 'equivalent_job' => array(
				// 'equivalent_jobRule-1' => array(
					// 'rule'    => 'notEmpty',
					// 'required'=> true,
					// 'message' => 'Indique el puesto equivalente en el mercado',          
					// 'last'    => true
				// )
			// ),
			
			'experience_area' => array(
				'experience_areaRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Indique su área de experiencia',          
					'last'    => true
				)
			),
			
			'start_date' => array(
				'start_dateRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione la fecha de inicio',          
					'last'    => true
				)
			),
			
			// 'experience_subarea' => array(
				// 'experience_subareaRule-1' => array(
					// 'rule'    => 'notEmpty',
					// 'required'=> true,
					// 'message' => 'Indique la subárea de experiencia.',          
					// 'last'    => true
				// ),
			// ),
			
		
		);
	} 
?>