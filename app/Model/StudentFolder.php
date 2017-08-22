<?php
	class StudentFolder extends AppModel{
		
		var $name = 'StudentFolder';
		
		public $hasAndBelongsToMany = array(
			'CompanyJobProfile' => array(
				'className' => 'CompanyJobProfile',
				'joinTable' => 'student_saved_offers',
				'foreignKey' => 'student_folder_id',
				'associationForeignKey' => 'company_job_profile_id',
				'dependent' => true, 
			)
		);
	
	
	}
?>