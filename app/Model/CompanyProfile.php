<?php
	class CompanyProfile extends AppModel{
		
		var $name = 'CompanyProfile';
		
		var $validate = array (
			'rfc' => array(
				'rfcRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el RFC de la empresa.',
					'last'    =>true
				),
				'rfcRule-2' => array(
					'rule'    => 'alphaNumeric',
					'required'=> true,
					'message' => 'Sólo se aceptan letras y números.',
					'last'    =>true
				),
				'rfcRule-3' => array(
					 'rule' => array('between', 12, 13),
					 'message' => 'El rfc debe contener entre 12 y 13 caracteres',
					 'last'    =>true
				)
			),
			
			'social_reason' => array(
				'social_reasoncRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la razón social de la empresa.',
					'last'    =>true
				),
			),
			
			'company_name' => array(
				'company_nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el nombre comercial de la empresa o institución.',
					'last'    =>true
				),
			),
			
			'company_type' => array(
				'company_typeRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
			
			'sector' => array(
				'sectorRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
			
			'company_rotation' => array(
				'company_rotationRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
			
			'employees_number' => array(
				'employees_numberRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
			
			'web_site' => array(
				'web_siteRule-1' => array(
					'rule' => array('url', true),
					'allowEmpty' => true,
					'message' => 'Ingrese una direccón web válida.',
					'last'    =>true,
				),
			),
			
			'street' => array(
				'streetRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la dirección de la empresa o institución.',
					'last'    =>true
				),
			),
			
			'state' => array(
				'stateRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione un estado.',
					'last'    =>true
				),
			),
			
			'city' => array(
				'cityRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de Delegación / Municipio.',
					'last'    =>true
				),
			),
			
			'subdivision' => array(
				'subdivisionRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la Población / Colonia.',
					'last'    =>true
				),
			),
			
			'zip' => array(
				'zipRule-1' => array(
					'rule' => array('postal', null, 'us'),
					'allowEmpty' => false,
					'message' => 'Ingrese un código postal válido.',      
					'last'    =>true,
				),
			),
			
			'street_sede' => array(
				'street_sedeRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la dirección de la empresa o institución.',
					'last'    =>true
				),
			),
			
			'state_sede' => array(
				'state_sedeRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione un estado.',
					'last'    =>true
				),
			),
			
			'city_sede' => array(
				'city_sedeRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de Delegación / Municipio.',
					'last'    =>true
				),
			),
			
			'subdivision_sede' => array(
				'subdivision_sedeRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese la Población / Colonia.',
					'last'    =>true
				),
			),
			
			'zip_sede' => array(
				'zip_sedeRule-1' => array(
					'rule' => array('postal', null, 'us'),
					'allowEmpty' => false,
					'message' => 'Ingrese un código postal válido.',      
					'last'    =>true,
				),
			),
			
			'company_description' => array(
				'company_descriptionRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese una descripción.',      
					'last'    =>true,
				),
			),
			
		
		);
	}
?>