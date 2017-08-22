<?php
	class CompanyAnswer extends AppModel{

		var $name = 'CompanyAnswer';
		
		public $displayField = 'answer';
		
		public $belongsTo = array(
			'Question' => array(
				'className' => 'Question',
				'foreignKey' => 'question_id',
				'dependent' => false, 
			),
		);
		
	} 
?>