<?php
	class CompanyJobLanguage extends AppModel{

		var $name = 'CompanyJobLanguage';
		
		public $belongsTo = array(
			// 'CompanyJobProfile' => array(
				// 'className' => 'CompanyJobProfile',
				// 'foreignKey' => 'company_job_profile_id',
			// ),
			'Lenguage' => array(
				'className' => 'Lenguage',
				'foreignKey' => 'language_id',
			)
		);
		
	} 
?>