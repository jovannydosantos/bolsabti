<?php
	class StudentJobSkill extends AppModel{

		var $name = 'StudentJobSkill';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// ),
			'TypeCourse' => array(
				'className' => 'TypeCourse',
				'foreignKey' => 'student_id',
			),
		);
		
		var $validate = array (
			
			'type_course_id' => array(
				'category_idRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una categoría.',          
					'last'    => true
				)
			),
			
			'name' => array(
				'nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el nombre.',          
					'last'    => true
				)
			),
			
			'company' => array(
				'companyRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la empresa / institución.',          
					'last'    => true
				)
			),
			
			'duration' => array(
				'durationRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la duración.',          
					'last'    => true
				),
				'durationRule-2' => array(
						'rule' => 'numeric',
						'allowEmpty' => true,
						'message' => 'La duración no es correcta.',
						'last'    =>true,
					)
			),
		
		);
	} 
?>