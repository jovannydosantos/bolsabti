<?php
	class StudentProfessionalProfile extends AppModel{
	
		var $name = 'StudentProfessionalProfile';
		
		public $displayField = 'description';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// ),
			'Average' => array(
				'className'  => 'Average',
				'foreignKey' => 'average_id',
				'dependent' => false, 	
			),
			'AcademicSituation' => array(
				'className'  => 'AcademicSituation',
				'foreignKey' => 'academic_situation_id',
				'dependent' => false, 	
			),
			'AcademicLevel' => array(
				'className'  => 'AcademicLevel',
				'foreignKey' => 'academic_level_id',
				'dependent' => false, 	
			),
			'Country' => array(
				'className'  => 'Country',
				'foreignKey' => 'student_mobility_city',
				'dependent' => false, 	
			),
			'Career' => array(
				'className'  => 'Career',
				'foreignKey' => 'career_id',
				'dependent' => false, 	
			),
			'PosgradoProgram' => array(
				'className'  => 'PosgradoProgram',
				'foreignKey' => 'posgrado_program_id',
				'dependent' => false, 	
			),
		);
		
		var $validate = array(
		
		'unam_student'=> array(
			'unam_studentRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione una opción de la lista',
				'last'    =>true
			),
		),
			
		'entrance_year_degree'=> array(
			'undergraduate_institutionRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione el año de ingreso',
				'last'    =>true
			),
		),
		
		'academic_situation_id'=> array(
			'academic_statusRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione la situación académica',
				'last'    =>true
			),
		),
		
		'average_id'=> array(
			'average_degreeRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Ingrese el promedio',
				'last'    =>true
			),
		),
		
		'decimal_average_id'=> array(
			'average_degreeRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Ingrese los decimales del promedio',
				'last'    =>true
			),
		),
		
		'student_mobility'=> array(
			'average_degreeRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione una opción de la lista',
				'last'    =>true
			),
		),
		
		'scholarship'=> array(
			'average_degreeRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione una opción de la lista',
				'last'    =>true
			),
		),

		);
	}
?>