<?php
	class CompanyFolder extends AppModel{
		
		var $name = 'CompanyFolder';
		
		public $hasAndBelongsToMany = array(
			'Student' => array(
				'className' => 'Student',
				'joinTable' => 'company_saved_offers',
				'foreignKey' => 'company_folder_id',
				'associationForeignKey' => 'student_id',
				'dependent' => true, 
			)
		);
	
	
	}
?>