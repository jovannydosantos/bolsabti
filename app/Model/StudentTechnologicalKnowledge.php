<?php
	class StudentTechnologicalKnowledge extends AppModel{

		var $name = 'StudentTechnologicalKnowledge';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// ),
			'Tecnology' => array(
				'className' => 'Tecnology',
				'foreignKey' => 'tecnology_id',
			),
			'Program' => array(
				'className' => 'Program',
				'foreignKey' => 'name',
			)
		);
		
		var $validate = array (
			
			'tecnology_id' => array(
				'category_idRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una categoría.',          
					'last'    => true
				)
			),
			
			
			'level' => array(
				'levelRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el nivel',          
					'last'    => true
				)
			),
			
		
		);
	} 
?>