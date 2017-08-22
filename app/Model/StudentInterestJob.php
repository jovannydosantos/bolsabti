<?php
	class StudentInterestJob extends AppModel{

		var $name = 'StudentInterestJob';
		
		public $belongsTo = array(
			'InterestArea' => array(
				'className' => 'InterestArea',
				'foreignKey' => 'interest_area_id',
			),
			'Rotation' => array(
				'className' => 'Rotation',
				'foreignKey' => 'business_activity',
			)
		);
		
		var $validate = array (
			
			'business_activity' => array(
				'business_activityRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el giro',          
					'last'    => true
				),	
			),
			
			'interest_area_id' => array(
				'interest_areaRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el área de interés',          
					'last'    => true
				),	
			),
			
		
		);
	} 
?>