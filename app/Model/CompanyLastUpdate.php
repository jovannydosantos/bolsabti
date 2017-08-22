<?php
	class CompanyLastUpdate extends AppModel{
	
		var $name = 'CompanyLastUpdate';
		
		public $belongsTo = array(
			'Administrator' => array(
				'className'  => 'Administrator',
				'foreignKey' => 'administrator_id',
				'dependent' => false, 	
			),
		);
	} 
?>