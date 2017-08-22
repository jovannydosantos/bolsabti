<?php
	class StudentProspect extends AppModel{

		var $name = 'StudentProspect';
		
		public $belongsTo = array(
			'Sector' => array(
				'className' => 'Sector',
				'foreignKey' => 'student_id',
			)
		);
		
		var $validate = array (
			
			'sector' => array(
				'sectorRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el tipo de sector.',          
					'last'    => true
				),	
			),
			
			'contract_type' => array(
				'contract_typeRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el tipo de contrato.',          
					'last'    => true
				),	
			),
			
			'workday' => array(
				'workdayRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la jornada laboral',          
					'last'    => true
				),	
			),
			
			'economic_pretension' => array(
				'economic_pretensionRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese las pretenciones económicas.',          
					'last'    => true
				),	
			),
			
			'can_travel' => array(
				'professional_objectiveRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Indique si puede viajar.',          
					'last'    => true
				),	
			),
			
			'change_residence' => array(
				'change_residenceRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Indique si puede cambiar de residencia',          
					'last'    => true
				),	
			),
				
		
		);
	} 
?>