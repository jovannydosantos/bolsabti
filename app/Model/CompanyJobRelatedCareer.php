<?php 

class CompanyJobRelatedCareer extends AppModel{

	var $name = 'CompanyJobRelatedCareer';
	
	public $belongsTo = array(
			// 'Company' => array(
				// 'className' => 'Company',
				// 'foreignKey' => 'company_id',
				// 'dependent' => false, 
			// ),
			// 'CompanyJobProfile' => array(
				// 'className' => 'CompanyJobProfile',
				// 'foreignKey' => 'company_job_profile_id',
				// 'dependent' => false, 
			// ),
			// 'CompanyCandidateProfile' => array(
				// 'className' => 'CompanyCandidateProfile',
				// 'foreignKey' => 'company_job_profile_id',
				// 'dependent' => true, 
			// )
		);
}
?>