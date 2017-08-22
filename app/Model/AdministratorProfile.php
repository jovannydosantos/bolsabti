<?php 

class AdministratorProfile extends AppModel{

	var $name = 'AdministratorProfile';
	
	public function checkStartDates(){
		if(($this->data[$this->alias]['start_date_expiration'] <> null) and ($this->data[$this->alias]['start_date_expiration'] <> '')):
			return $this->data[$this->alias]['start_date_expiration'] <= $this->data[$this->alias]['end_date_expiration']; 
		else:
			return true;
		endif;
	}
	
	public function checkEndDates(){
		if(($this->data[$this->alias]['end_date_expiration'] <> null) and ($this->data[$this->alias]['end_date_expiration'] <> '')):
			return $this->data[$this->alias]['end_date_expiration'] >= $this->data[$this->alias]['start_date_expiration']; 
		else:
			return true;
		endif;
	}
	
	public function validateStartDate(){
		if($this->data[$this->alias]['start_date_expiration'] <> '0000-00-00'):
			$fechaActual = date('Y-m-d');
			$fechaExpira = $this->data[$this->alias]['start_date_expiration'];
			$fechaExpira = strtotime ( '+1 day' , strtotime ( $fechaExpira ) );
			$fechaExpira = date ( 'Y-m-j' , $fechaExpira );	
			return $fechaActual <= $fechaExpira;
		else:
			return true;
		endif;
	}
	
	public function validateEndDate(){
		if($this->data[$this->alias]['end_date_expiration'] <> '0000-00-00'):
		$fechaActual = date('Y-m-d');
			$fechaExpira = $this->data[$this->alias]['end_date_expiration'];
			$fechaExpira = strtotime ( '+1 day' , strtotime ( $fechaExpira ) );
			$fechaExpira = date ( 'Y-m-j' , $fechaExpira );	
			return $fechaActual <= $fechaExpira;
		else:
			return true;
		endif;
	}
	
	var $validate = array (

		'institution' => array(
			'institutionRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'La escuela o faculad es requerido.',          
				'last'    => true
			),
		),
		
		'academic_level_id' => array(
			'academic_level_idRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El nivel académico es requerido.',          
				'last'    => true
			),
		),
		
		'contact_name' => array(
			'-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El nombre de contacto no puede estar vacio.',          
				'last'    => true
			),
			'contact_nameRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàè]+$/i',
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),	
		),
		
		'contact_last_name' => array(
			'contact_last_nameRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El primer apellido del contacto no puede estar vacio.',          
				'last'    => true
			),
			'contact_last_nameRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàè]+$/i',
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),	
		),
		
		'contact_second_last_name' => array(
			'contact_second_last_nameRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El segundo apellido del contacto no puede estar vacio.',          
				'last'    => true
			),
			'contact_second_last_nameRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàè]+$/i',
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),	
		),
		
		'contact_position' => array(
			'contact_positionRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El cargo del contacto no puede estar vacio.',          
				'last'    => true
			),
		),
		
		'long_distance_cod' => array(
			'long_distance_codRule-1' => array(
					'rule'    => 'numeric',
					'required'=> false,
					'allowEmpty' => true,
					'message' => 'Sólo números.',
					'last'    =>true
				),
		),
		
		'telephone' => array(
			'telephoneRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'El teléfono del contacto no puede estar vacio.',          
				'last'    => true
			),
			'telephoneRule-2' => array(
					'rule'    => 'numeric',
					'required'=> false,
					'message' => 'Sólo números.',
					'last'    =>true
				),
		),
		
		'phone_extension' => array(
			'phone_extensionRule-1' => array(
					'rule'    => 'numeric',
					'required'=> false,
					'allowEmpty' => true,
					'message' => 'Sólo números.',
					'last'    =>true
				),
		),
		
		'long_distance_cod_cell_phone' => array(
			'long_distance_cod_cell_phoneRule-1' => array(
					'rule'    => 'numeric',
					'required'=> false,
					'allowEmpty' => true,
					'message' => 'Sólo números.',
					'last'    =>true
				),
		),
		
		'cell_phone' => array(
			'cell_phoneRule-1' => array(
					'rule'    => 'numeric',
					'required'=> false,
					'allowEmpty' => true,
					'message' => 'Sólo números.',
					'last'    =>true
				),
		),
		
		'access' => array(
			'acessRule-1' => array(
				'rule'    => 'notEmpty',
				'required'=> true,
				'message' => 'Seleccione los accesos del administrador.',          
				'last'    => true
			),
		),
		
		'start_date_expiration' => array(
			'start_date_expirationRule-1' => array(
				'rule' => array ('checkStartDates'),
				'required'=> false,
				'allowEmpty' => true,
				'message' => 'La fecha de inicio no debe ser mayor a la fecha final.',          
				'last'    => true
			),
			'start_date_expirationRule-2' => array(
				'rule' => array ('validateStartDate'),
				'required'=> false,
				'allowEmpty' => true,
				'message' => 'La fecha no debe ser menor a la actual.',          
				'last'    => true
			),
		),
		
		'end_date_expiration' => array(
			'end_date_expirationRule-1' => array(
				'rule' => array ('checkEndDates'),
				'required'=> false,
				'allowEmpty' => true,
				'message' => 'La fecha de termino no debe ser menor a la fecha inicial.',          
				'last'    => true
			),
			'end_date_expirationRule-2' => array(
				'rule' => array ('validateEndDate'),
				'required'=> false,
				'allowEmpty' => true,
				'message' => 'La fecha no debe ser menor a la actual.',          
				'last'    => true
			),
		),
		
	);
	
}
?>