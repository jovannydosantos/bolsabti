<?php
	class StudentAcademicProject extends AppModel{

		var $name = 'StudentAcademicProject';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// )
		);
		
		public $hasMany = array(
			'StudentAcademicProjectResponsability' => array(
				'className'  => 'StudentAcademicProjectResponsability',
				'foreignKey' => 'student_academic_project_id',
				'dependent' => true, 	
			),
			'StudentAcademicProjectAchievement' => array(
				'className'  => 'StudentAcademicProjectAchievement',
				'foreignKey' => 'student_academic_project_id',
				'dependent' => true, 	
			),
		);
		
		var $validate = array (
			
			'name' => array(
				'nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el nombre del proyecto',          
					'last'    => true
				),
				// 'nameRule-1' => array(
					// 'rule' => 'isUnique',
					// 'message' => 'El nombre del proyecto ya ha sido agregado anteriormente.',
					// 'last'    => true
				// ),
			),
			
			'team' => array(
				'teamRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el modo de realización del proyecto',          
					'last'    => true
				),
			),
			
			'company' => array(
				'companyRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la empresa / institución donde se realizó el proyecto',          
					'last'    => true
				),
			),
		
			'responsability' => array(
				'responsabilityRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la responsabilidad adquirida',          
					'last'    => true
				)
			),
			
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