<?php
	class Question extends AppModel{

		var $name = 'Question';
		
		// public $displayField = 'question';
		
		public $hasOne = array(
			'StudentAnswer' => array(
				'className'  => 'StudentAnswer',
				'foreignKey' => 'question_id',
				'dependent' => false, 	
			)
		);
		
	} 
?>