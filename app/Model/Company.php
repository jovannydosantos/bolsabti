<?php 

class Company extends AppModel{

	var $name = 'Company';
	
	public $hasOne = array(
		'CompanyProfile' => array(
			'className'  => 'CompanyProfile',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
		),
		'CompanyContact' => array(
			'className'  => 'CompanyContact',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
		),
		'CompanyInterviewMessage' => array(
			'className'  => 'CompanyInterviewMessage',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
		),
		'CompanyOfferOption' => array(
			'className'  => 'CompanyOfferOption',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
		),
	);
	
	public $hasMany = array(
		'CompanyJobOffer' => array(
			'className'  => 'CompanyJobOffer',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
			),
		'CompanyJobProfile' => array(
			'className'  => 'CompanyJobProfile',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
			),
		'CompanyViewedStudent' => array(
			'className'  => 'CompanyViewedStudent',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
			),
		'CompanySavedStudent' => array(
			'className'  => 'CompanySavedStudent',
			'foreignKey' => 'company_id',
			'dependent' => true,
			),
		'CompanyViewedOffer' => array(
			'className'  => 'CompanyViewedOffer',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
			),
		'CompanyLastUpdate' => array(
			'className'  => 'CompanyLastUpdate',
			'order' => 'CompanyLastUpdate.modified DESC',
			'limit' => 1,
			'foreignKey' => 'company_id',
			'dependent' => true, 	
			),
		'CompanyDownloadedStudent' => array(
			'className'  => 'CompanyDownloadedStudent',
			'foreignKey' => 'company_id',
			'dependent' => true, 	
			),
	);		
	
	public function password_confirm() {
		return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm'];
	}
	
	public function password_confirm2() {
		return $this->data[$this->alias]['new_password'] === $this->data[$this->alias]['new_password_confirm'];
	}
	
	public function password_verifies() {
		// getting password via field method by assuming you're setting $this->User->id from your controller
		return AuthComponent::password($this->data[$this->alias]['old_password']) === $this->data[$this->alias]['password'];
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

	public $actsAs = array(
		'MeioUpload' => array('filename'),
	);

	var $validate = array (
		
		'email' => array(
			'emailRule-1' => array(
				'rule'    => 'notEmpty',
				// 'required'=> true,
				'message' => 'El correo electrónico no puede estar vacio.',
				'last'    =>true
			),
			'emailRule-3' => array(
				'rule' => 'isUnique',
				'message' => 'El correo electrónico ya está en uso',
				'last'    => false
			),
			'emailRule-2' =>array(
				'rule' => array('email', true),
				'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				'last'    =>true
			),
			
		),
		
		'email_confirm' => array(
			'email_confirmRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'La confirmación de correo no puede estar vacio.',          
				'last'    => true
			),
			'email_confirmRule-2' =>array(
				'rule' => array('email', true),
				'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				'last'    =>true
			),
			'email_confirmRule-3' => array(
				'rule' => array ('email_confirm'),
				'message' => 'Su dirección de correo electrónico no es válida o no coincide, favor de escribirla nuevamente.',
				'last'    => true
			)
		),
		
		'username' => array(
			'usernameRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El nombre de usuario no puede estar vacio.',          
				'last'    => true
			),
		),

		'password' => array(
			'passwordRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'La contraseña no puede estar vacia.',
				'last'    => true
			),
			'passwordRule-3' => array(
				'rule'    => array('lengthBetween', 6, 10),
				'message' => 'La contraseña debe tener una longitud de 6 a 10 caracteres alfanuméricos.',
				'last'    => true
			),
			'passwordRule-2' => array(
				'rule'    => '/(?=^.{6,}$)(?=.*\d)(?=.*[A-Za-z]).*$/',
				'message' => 'La contraseña debe contener letras y números.',
				'last'    => true
			)

		),
		
		'password_confirm' => array(
			'password_confirm-1' => array(
				'rule' => array ('password_confirm'),
				'message' => 'Las contraseñas ingresadas no coinciden.',
				'last'    => true
			)
		),
		
		'new_password' => array(
			'new_passwordRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'La contraseña no puede estar vacia.',
				'last'    => true
			),
			'new_passwordRule-2' => array(
				'rule'    => array('lengthBetween', 6, 10),
				'message' => 'La contraseña debe tener una longitud de 6 a 10 caracteres alfanuméricos.',
				'last'    => true
			),
			'new_passwordRule-3' => array(
				'rule'    => '/(?=^.{6,}$)(?=.*\d)(?=.*[A-Za-z]).*$/',
				'message' => 'La contraseña debe contener letras y números.',
				'last'    => true
			)

		),
		
		'new_password_confirm' => array(
			'new_password_confirmRule-1' => array(
				'rule' => array ('password_confirm2'),
				'message' => 'Su contraseña no coincide, favor de escribirla otra vez.',
				'last'    => true
			)
		),
		
		'old_password' => array(
			'old_passwordRule-1' => array(
				'rule' => 'password_verifies',
				'message' => 'La contraseña actual es incorrecta'
			)
		),
		
		'disable' => array(
			'disableRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'Seleccione una opción para continuar',
				'last'    => true
			),
		),
	);
}
?>