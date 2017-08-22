<?php
	class StudentProfile extends AppModel{
		
		var $name = 'StudentProfile';
		
		public $belongsTo = array(
			// 'Student' => array(
				// 'className' => 'Student',
				// 'foreignKey' => 'student_id',
			// )
		);
		
		public function secondary_email_confirm(){
			return $this->data[$this->alias]['secondary_email'] === $this->data[$this->alias]['secondary_email_confirm'];
		}
	
		var $validate = array (
					
			'secondary_email' => array(
				'secondary_emailRule-2' =>array(
					'required'=> false,
					'allowEmpty' => true,
					'rule' => array('email', true),
					'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
					'last'    =>true
				),
				'secondary_emailRule-3' => array(
					'rule' => array('UniqueEmail'),// funcion de búsqueda de email en uso.
					'rule' => 'isUnique',
					'message' => 'El correo electrónico ya está en uso',
					'last'    => false,
				)
			),
			
			'secondary_email_confirm' => array(
				'secondary_email_confirmRule-2' =>array(
					'required'=> false,
					'allowEmpty' => true,
					'rule' => array('email', true),
					'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
					'last'    =>true
				),
				'secondary_email_confirmRule-3' => array(
					'rule' => array ('secondary_email_confirm'),
					'message' => 'Los correos electrónicos no coinciden.',
					'last'    => true
				)
			),
		
			'street' => array(
				'streetRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'El campo de calle y número no pueden estar vacio.',          
					'last'    => true
				),		
			),
			
			'subdivision' => array(
				'subdivisionRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'El campo de colonia no pueden estar vacio.',          
					'last'    => true
				),		
			),
			
			'city' => array(
				'cityRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'El campo de delegación no pueden estar vacio.',          
					'last'    => true
				),
			),
			
			'state' => array(
				'stateRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'El campo de estado no pueden estar vacio.',          
					'last'    => true
				),
			),
			
			'zip' => array(
				'zipRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'El campo de código postal no pueden estar vacio.',          
					'last'    => true
				),
				'zipRule-2' => array(
					'rule' => array('postal', null, 'us'),
					'message' => 'El campo de código postal no es válido.',          
					'last'    => true
				),
				'zipRule-3' => array(
					'rule'    => array('lengthBetween', 5, 5),
					'message' => 'El código postal es de 5 caracteres.'
				),
				'zipRule-4' => array(
					'rule' => 'numeric',
					'required' => true,
					'message' => 'El código postal consta de sólo números.'
				)
			),
			
			'lada_cell_phone' => array(
				'lada_cell_phoneRule-1' =>array(
					'rule'      => 'numeric',
					'required'=> false,
					'allowEmpty' => true,
					'message'   => 'Este campo sólo permite ingresar números, ej.555',
					'last'    =>true
				),				
			),
			
			'cell_phone' => array(
				'cell_phoneRule-2' =>array(
					'rule'      => 'numeric',
					'required'=> false,
					'allowEmpty' => true,
					'message'   => 'Este campo sólo permite ingresar números, ej.5584128907',
					'last'    =>true
				),				
			),
			
			'telephone_contact' => array(
				'telephone_contactRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'El campo de teléfono de contacto no puede estar vacio.',          
					'last'    => true
				),
				'telephone_contactRule-2' =>array(
					'rule'      => 'numeric',
					'message'   => 'Este campo sólo permite ingresar números, ej.55124397',
					'last'    =>true
				),				
			),
			
			'lada_telephone_contact' => array(
				'lada_telephone_contactRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'La lada no pueden estar vacio.',          
					'last'    => true
				),
				'lada_telephone_contactRule-2' =>array(
					'rule'      => 'numeric',
					'message'   => 'No se permiten letras para este campo.',
					'last'    =>true
				),				
			),
		
			'date_of_birth' => array(
				'date_of_birthRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no pueden estar vacio.',          
					'last'    => true
				),
				'date_of_birthRule-2' =>array(
					'rule'    => 'date',
					'message' => 'Ingrese una fecha válida para este campo.',
					'last'    =>true
				),	
	
			),
			
			'sex' => array(
				'sexRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione su sexo.',          
					'last'    => true
				),	
			),
			
			'marital_status' => array(
				'marital_statusRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione su estado civil.',          
					'last'    => true
				),	
			),
			
			'born_country' => array(
				'born_countryRule-1' => array(
					'rule'    => 'notEmpty',
					'message' => 'El campo de país de nacimiento no pueden estar vacio.',          
					'last'    => true
				),	
			),
			
		
		);
	}
?>