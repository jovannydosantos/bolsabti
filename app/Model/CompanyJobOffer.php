<?php
	class CompanyJobOffer extends AppModel{
		
		var $name = 'CompanyJobOffer';
		
		public $belongsTo = array(
			// 'Company' => array(
				// 'className' => 'Company',
				// 'foreignKey' => 'company_id',
				// 'dependent' => true, 	
			// ),
		);
		
		public $hasOne = array(
			'CompanyJobProfile' => array(
					'className'  => 'CompanyJobProfile',
					'foreignKey' => 'company_job_offer_id',
					'dependent' => true, 				
			),
		);
		
		var $validate = array (
			
			'same_contact' => array(
				'same_contactRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
			
			'responsible_name' => array(
				'responsible_nameeRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàèÁÉÍÓÚÑÜÀÈ]+$/i',
					'allowEmpty' => true,
					'required'=> false,
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),
			),
			
			'responsible_last_name' => array(
				'responsible_last_nameRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàèÁÉÍÓÚÑÜÀÈ]+$/i',
					'allowEmpty' => true,
					'required'=> false,
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),
			),
			
			'responsible_second_last_name' => array(
				'responsible_second_last_nameRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàèÁÉÍÓÚÑÜÀÈ]+$/i',
					'allowEmpty' => true,
					'required'=> false,
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),
			),
			
			'responsible_position' => array(
				'responsible_positionRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàèÁÉÍÓÚÑÜÀÈ.]+$/i',
					'allowEmpty' => true,
					'required'=> false,
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),
			),
			
			'responsible_long_distance_cod' => array(
				'responsible_long_distance_codRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Este campo sólo permite ingresar números, ej.55124397',
					'last'    =>true
				),
			),
			
			'responsible_telephone' => array(
				'responsible_telephoneRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Este campo sólo permite ingresar números, ej.55124397',
					'last'    =>true
				),
			),
			
			'responsible_phone_extension' => array(
				'responsible_phone_extensionRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Este campo sólo permite ingresar números, ej.5584128907.',
					'last'    =>true
				),
			),
			
			'responsible_long_distance_cod_cell_phone' => array(
				'responsible_long_distance_cod_cell_phoneRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Este campo sólo permite ingresar números, ej.5584128907.',
					'last'    =>true
				),
			),
			
			'responsible_cell_phone' => array(
				'responsible_cell_phoneRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Este campo sólo permite ingresar números, ej.5584128907.',
					'last'    =>true
				),
			),
			
			'company_email' => array(
				'company_emailRule-2' =>array(
					'rule' => array('email', true),
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
					'last'    =>true
				),
				// 'company_emailRule-3' => array(
					// 'rule' => 'isUnique',
					// 'allowEmpty' => true,
					// 'required'=> false,
					// 'message' => 'El correo electrónico ya está en uso',
					// 'last'    => false
				// )
		),
		
		'company_email_confirm' => array(
			'company_email_confirmRule-2' =>array(
				'rule' => array('email', true),
				'allowEmpty' => true,
				'required'=> false,
				'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				'last'    =>true
			),
		),
		
		'confidential_job_offer' => array(
				'cconfidential_job_offerRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
			
		// 'company_name' => array(
				// 'company_nameRule-1' => array(
					// 'rule'    => 'notEmpty',
					// 'required'=> true,
					// 'message' => 'Ingrese el nombre de la empresa o institución que aparecerá en la oferta.',
					// 'last'    =>true
				// ),
			// ),
		
		'show_details_responsible' => array(
				'show_details_responsibleRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de la lista.',
					'last'    =>true
				),
			),
			
		);
	}
?>