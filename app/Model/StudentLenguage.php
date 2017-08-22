<?php
	class StudentLenguage extends AppModel{

		var $name = 'StudentLenguage';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// ),
			'Lenguage' => array(
				'className' => 'Lenguage',
				'foreignKey' => 'language_id',
			)
		);
		
		var $validate = array (
			
			'language_id' => array(
				'language_idRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione un idioma.',          
					'last'    => true
				)
			),
			
			'reading_level' => array(
				'reading_levelRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el nivel de lectura',          
					'last'    => true
				)
			),
			
			'writing_level' => array(
				'writing_levelRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el nivel de escritura',          
					'last'    => true
				)
			),
			
			'conversation_level' => array(
				'conversation_levelRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el nivel de comprensión',          
					'last'    => true
				),
			),
			
			// 'certification' => array(
				// 'certificationRule-1' => array(
					// 'rule'    => 'notEmpty',
					// 'required'=> true,
					// 'message' => 'Ingrese la certificación',          
					// 'last'    => true
				// ),
			// ),
			
			'certification_year' => array(
				'certification_yearRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el año de la certificación',          
					'last'    => true
				),
			),
			
			'score' => array(
				'scoreRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el puntaje del idioma',          
					'last'    => true
				),
			),
		
		);
	} 
?>