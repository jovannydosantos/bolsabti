<?php
	class StudentSavedOffer extends AppModel{
		
		var $name = 'StudentSavedOffer';
		
		var $validate = array (
		
		'student_folder_id' => array(
			'student_folder_idRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione una carpeta',          
				'last'    => true
			),
			
		)
		
	);
	
	}
?>