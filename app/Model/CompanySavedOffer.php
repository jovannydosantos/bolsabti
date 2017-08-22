<?php
	class CompanySavedOffer extends AppModel{
		
		var $name = 'CompanySavedOffer';
		
		var $validate = array (
		
		'company_folder_id' => array(
			'company_folder_idRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione una carpeta',          
				'last'    => true
			),
			
		)
		
	);
	
	}
?>