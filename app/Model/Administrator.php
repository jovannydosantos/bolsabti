<?php 

class Administrator extends AppModel{

	var $name = 'Administrator';
	
	public $actsAs = array(
		'MeioUpload' => array('filename'),
	);
	
	public $hasOne = array(
		'AdministratorProfile' => array(
			'className'  => 'AdministratorProfile',
			'foreignKey' => 'administrator_id',
			'dependent' => true, 	
		),
	);
	
	public function password_confirm() {
		return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm'];
	}
	
	public function email_confirm(){
		return $this->data[$this->alias]['email'] === $this->data[$this->alias]['email_confirm'];
	}
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		// fallback to our parent
		return parent::beforeSave($options);
		return true;
	}
	
	public function password_verifies() {
		// getting password via field method by assuming you're setting $this->User->id from your controller
		return AuthComponent::password($this->data[$this->alias]['old_password']) === $this->data[$this->alias]['password'];
	}
	
	
	var $validate = array (
		
		'username' => array(
			'usernameRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El nombre de usuario no puede estar vacio.',          
				'last'    => true
			),
			'usernameRule-2' => array(
				'rule' => 'isUnique',
				'message' => 'El nombre de usuario ya existe',
				'last'    => false
			),
		),
		
		'password' => array(
			'passwordRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'La contraseña no puede estar vacia.',
				'last'    => true
			),
			'passwordRule-3' => array(
				'rule'    => array('lengthBetween', 6, 12),
				'message' => 'La contraseña debe tener una longitud de 6 a 12 caracteres alfanuméricos.',
				'last'    => true
			),
			'passwordRule-2' => array(
				'rule'    => '/(?=^.{6,}$)(?=.*\d)(?=.*[A-Za-z]).*$/',
				'message' => 'La contraseña debe contener letras y números.',
				'last'    => true
			)
		),
		
		'password_confirm' => array(
			'password_confirmRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'La contraseña no puede estar vacia.',
				'last'    => true
			),
			'password_confirmRule-2' => array(
				'rule' => array ('password_confirm'),
				'message' => 'Las contraseñas ingresadas no coincidieron.',
				'last'    => true
			)
		),
		
		'email' => array(
			'emailRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El correo electrónico institucional no puede estar vacio.',          
				'last'    => true
			),
			'emailRule-2' =>array(
				'rule' => array('email', true),
				'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				'last'    =>true
			),
			'emailRule-3' => array(
				'rule' => 'isUnique',
				'message' => 'El correo electrónico ya está en uso',
				'last'    => false
			),
		),
		
		'email_confirm' => array(
			'email_confirmRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'La confirmación del correo institucional no puede estar vacio.',          
				'last'    => true
			),
			'email_confirmRule-2' =>array(
				'rule' => array('email', true),
				'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				'last'    =>true
			),
			'email_confirmRule-3' => array(
				'rule' => array ('email_confirm'),
				'message' => 'Su dirección de correo electrónico no coincide con el correo institucional, favor de escribirlo otra vez.',
				'last'    => true
			)
		),
		
	);
	
}
?>