<?php
	class  CompanyJobContractTypeBenefit extends AppModel{

		var $name = 'CompanyJobContractTypeBenefit';

		public $belongsTo = array(
			'Benefit' => array(
				'className'  => 'Benefit',
				'foreignKey' => 'benefit_id',
			),
			'CompanyJobContractType' => array(
				'className'  => 'CompanyJobContractType',
				'foreignKey' => 'company_job_contract_type_id',
			),
		);
	} 
?>