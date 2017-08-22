<?php 

class Student extends AppModel{

	var $name = 'Student';
	
	public $hasOne = array(
		'StudentProfile' => array(
			'className'  => 'StudentProfile',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentJobProspect' => array(
			'className'  => 'StudentJobProspect',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentProspect' => array(
			'className'  => 'StudentProspect',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentHeader' => array(
			'className'  => 'StudentHeader',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentLastUpdate' => array(
			'className'  => 'StudentLastUpdate',
			'foreignKey' => 'id',
			'dependent' => true, 	
		),
	);
	
	public $hasMany = array(
		'StudentJobSkill' => array(
			'className'  => 'StudentJobSkill',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentLenguage' => array(
			'className'  => 'StudentLenguage',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentTechnologicalKnowledge' => array(
			'className'  => 'StudentTechnologicalKnowledge',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentProfessionalExperience' => array(
			'className'  => 'StudentProfessionalExperience',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentAcademicProject' => array(
			'className'  => 'StudentAcademicProject',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentProfessionalSkill' => array(
			'className'  => 'StudentProfessionalSkill',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'StudentFolder' => array(
			'className'  => 'StudentFolder',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'StudentProfessionalProfile' => array(
			'className'  => 'StudentProfessionalProfile',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
		),
		'StudentInterestJob' => array(
			'className'  => 'StudentInterestJob',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'StudentViewedOffer' => array(
			'className'  => 'StudentViewedOffer',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'StudentSavedOffer' => array(
			'className'  => 'StudentSavedOffer',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'StudentSavedSearch' => array(
			'className'  => 'StudentSavedSearch',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'StudentExternalOffer' => array(
			'className'  => 'StudentExternalOffer',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'StudentNotification' => array(
			'className'  => 'StudentNotification',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'Application' => array(
			'className'  => 'Application',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'CompanyViewedStudent' => array(
			'className'  => 'CompanyViewedStudent',
			'foreignKey' => 'student_id',
			'dependent' => true, 		
			),
		'CompanySavedStudent' => array(
			'className'  => 'CompanySavedStudent',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
		'Report' => array(
			'className'  => 'Report',
			'foreignKey' => 'student_id',
			'dependent' => true, 	
			),
	);
	
	public $hasAndBelongsToMany = array(
			'CompanyFolder' => array(
				'className' => 'CompanyFolder',
				'joinTable' => 'company_saved_offers',
				'foreignKey' => 'student_id',
				'associationForeignKey' => 'company_folder_id'
			)
		);
		
	public $belongsTo = array(
			'AcademicSituation' => array(
				'className' => 'AcademicSituation',
				'foreignKey' => 'academic_situation_id',
			),
			'AcademicLevel' => array(
				'className' => 'AcademicLevel',
				'foreignKey' => 'academic_level_id',
			),
			'Career' => array(
				'className' => 'Career',
				'foreignKey' => 'career',
			),
	);
	
	public function password_confirm() {
		return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm'];
	}
	
	public function password_confirm2() {
		return $this->data[$this->alias]['new_password'] === $this->data[$this->alias]['new_password_confirm'];
	}
	
	public function email_confirm(){
		return $this->data[$this->alias]['email'] === $this->data[$this->alias]['email_confirm'];
	}
	
	function UniqueEmail() {
		return ($this->find('count', array(
								'conditions' => array(
									'Student.email' => $this->data['Student']['email'],
									'Student.id !=' => $this->data['Student']['id'],
									))) == 0);
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

	public $actsAs = array(
		'MeioUpload' => array('filename'),
	);
	
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
				'message' => 'El número de cuenta ya existe.',
				'last'    => true
			),
			'usernameRule-3' => array(
				'rule'    => array('minLength', 9),
				'required'=> true,
				'message' => 'El número de cuenta UNAM debe tener mínimo 9 caracteres antepón los ceros (0) necesarios para completar los dígitos',
				'last'    => true
			),       
			'usernameRule-4' => array(
					'rule'    => array('lengthBetween', 5, 15),
					'message' => 'El nombre de usuario debe contener entre 5 y 15 caracteres.',
					'last'    => true
				)
		),
		
		'academic_level_id' => array(
				'education_levelRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione el nivel máximo de estudios.',          
					'last'    => true
				)
		),
		
		'institution' => array(
				'institutionRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de escuela o facultad.',          
					'last'    => true
				)
		),
		
		'career' => array(
				'careerRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción de carrera / área.',          
					'last'    => true
				)
		),
		
		'academic_situation_id' => array(
				'academic_situationRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Seleccione una opción en situación académica.',          
					'last'    => true
				)
		),
		
		'email' => array(
			'emailRule-1' => array(
				'rule'    => 'notEmpty',
				// 'required'=> true,
				'message' => 'El correo electrónico no puede estar vacio.',
				'last'    =>true
			),
			'emailRule-2' =>array(
				'rule' => array('email', true),
				'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				'last'    =>true
			),
			'emailRule-3' => array(
				// 'rule' => array('UniqueEmail'),// funcion de búsqueda de email en uso.
				'rule' => 'isUnique',
				'message' => 'El correo electrónico ya está en uso',
				// 'on' => 'create',
				'last'    => false,
			)
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
				'message' => 'Su dirección de correo electrónico no coincide con el correo de registro, favor de escribirlo otra vez.',
				'last'    => true
			)
		),
		
		'password' => array(
			'passwordRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'La contraseña no puede estar vacia.',
				'last'    => true
			),
			'passwordRule-3' => array(
				'rule'    => array('lengthBetween', 7, 12),
				'message' => 'La contraseña debe tener una longitud de 7 a 12 caracteres alfanuméricos.',
				'last'    => true
			),
			'passwordRule-2' => array(
				'rule'    => '/(?=^.{7,}$)(?=.*\d)(?=.*[A-Za-z]).*$/',
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
		
		// 'disable' => array(
			// 'disableRule-1' => array(
				// 'rule'    => 'notEmpty',
				// 'message' => 'Seleccione una opcion para continuar',
				// 'last'    => true
			// ),
		// ),
		
		'new_password' => array(
			'new_passwordRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'La contraseña no puede estar vacia.',
				'last'    => true
			),
			'new_passwordRule-2' => array(
				'rule'    => array('lengthBetween', 7, 12),
				'message' => 'La contraseña debe tener una longitud de 7 a 12 caracteres alfanuméricos.',
				'last'    => true
			),
			'new_passwordRule-3' => array(
				'rule'    => '/(?=^.{7,}$)(?=.*\d)(?=.*[A-Za-z]).*$/',
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
		
		'emailTo' => array(
			'emailToRule-1' => array(
				'rule'    => 'notEmpty',
				// 'required'=> true,
				'message' => 'El correo electrónico no puede estar vacio.',
				'last'    =>true
			),
			// 'emailToRule-2' =>array(
				// 'rule' => array('email', true),
				// 'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				// 'last'    =>true
			// ),
		),
		
		// 'CC' => array(
			// 'CCRule-1' =>array(
				// 'rule' => array('email', true),
				// 'required'=> false,
				// 'allowEmpty' => true,
				// 'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				// 'last'    =>true
			// ),
		// ),
		
		// 'CCO' => array(
			// 'CCORule-1' => array(
				// 'rule' => array('email', true),
				// 'required'=> false,
				// 'allowEmpty' => true,
				// 'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
				// 'last'    =>true
			// ),
		// ),
		
		'title' => array(
			'titleRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'Ingrese el título del mensaje.',
				'last'    => true
			),
		),
		
		// 'file' => array(
			// 'fileRule-1' => array(
				// 'rule'    => 'notEmpty',
				// 'message' => 'Seleccione su curriculum',
				// 'allowEmpty' => false,
			// ),
		// ),
		
		'message' => array(
			'messageRule-1' => array(
				'rule'    => 'notEmpty',
				'message' => 'Ingrese su mensaje',
				'allowEmpty' => false,
			),
		),
	
	);

}
?>