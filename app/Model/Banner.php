<?php 

	class Banner extends AppModel{
	
		public $actsAs = array(
			'MeioUpload' => array('filename'),
		);
		
		var $validate = array (
		
		'description' => array(
			'descriptionRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Ingrese una descripción para el banner',
				'last'    =>true
			)
		),
		
		'web_site' => array(
				'web_siteRule-1' => array(
					'rule' => array('url', true),
					'message' => 'Ingrese una direccón web válida.',
					'last'    =>true,
				),
				'web_siteRule-2' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese una direccón web.',
					'last'    =>true
				)
			),
			
		'id' => array(
			'idRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione la posición del banner.',
				'last'    =>true
			)
		),
		
		);
		
	}
?>