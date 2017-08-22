<?php
	class CompanyJobContractType extends AppModel{
		
		var $name = 'CompanyJobContractType';
		
		public $hasMany = array(
			'CompanyJobContractTypeBenefit' => array(
				'className'  => 'CompanyJobContractTypeBenefit',
				'foreignKey' => 'company_job_contract_type_id',
				'dependent' => true, 	
			),
		);
			
		public $belongsTo = array(
			'CompanyJobProfile' => array(
				'className' => 'CompanyJobProfile',
				'foreignKey' => 'company_job_profile_id',
			),
			'Salary' => array(
				'className'  => 'Salary',
				'foreignKey' => 'salary',	
			),
			'ContractType' => array(
				'className'  => 'ContractType',
				'foreignKey' => 'contract_type',	
			),
			'Workday' => array(
				'className'  => 'Workday',
				'foreignKey' => 'workday',	
			),
			'State' => array(
				'className'  => 'State',
				'foreignKey' => 'state',	
			),
			'Subdivision' => array(
				'className'  => 'State',
				'foreignKey' => 'state',	
			),
			'Country' => array(
				'className'  => 'Country',
				'foreignKey' => 'mobility_city',	
			),
		);
		
		var $validate = array (
		
			'contract_type' => array(
				'contract_typeRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'contract_length' => array(
				'contract_lengthRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'workday' => array(
				'workdayRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'schedule' => array(
				'scheduleRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'salary' => array(
				'salaryRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'state' => array(
				'stateRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'subdivision' => array(
				'subdivisionRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'location_reference' => array(
				'location_referenceRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
		
		);
	}
?>