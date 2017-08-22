<?php
	class CompanyCandidateProfile extends AppModel{
		
		var $name = 'CompanyCandidateProfile';
		
		public $belongsTo = array(
			'AcademicSituation' => array(
				'className' => 'AcademicSituation',
				'foreignKey' => 'academic_situation_id',
			),
			'AcademicLevel' => array(
				'className' => 'AcademicLevel',
				'foreignKey' => 'academic_level_id',
			),
		);
		
		public $hasMany = array(
			// 'CompanyJobOfferCompetency' => array(
				// 'className'  => 'CompanyJobOfferCompetency',
				// 'foreignKey' => 'company_job_profile_id',
				// 'dependent' => true, 	
				// ),
			'CompanyJobRelatedCareer' => array(
				'className'  => 'CompanyJobRelatedCareer',
				'foreignKey' => 'company_job_profile_id',
				// 'order'           => 'AcademicLevel.released DESC',
				'dependent' => true, 	
			),
		);		
	
		var $validate = array (
			
		);
	}
?>