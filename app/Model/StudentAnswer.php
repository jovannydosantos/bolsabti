<?php
	class StudentAnswer extends AppModel{

		var $name = 'StudentAnswer';
		
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