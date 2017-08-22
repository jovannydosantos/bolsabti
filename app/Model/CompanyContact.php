<?php
	class CompanyContact extends AppModel{
		
		var $name = 'CompanyContact';
		
		public $belongsTo = array(
			'Company' => array(
				'className' => 'Company',
				'foreignKey' => 'company_id',
			)
		);
		
		var $validate = array (
			'name' => array(
				'nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el nombre del contacto.',
					'last'    =>true
				),
				'nameRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàèÁÉÍÓÚÑÜÀÈ]+$/i',
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),	
			),
			
			'last_name' => array(
				'last_nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el apellido paterno del contacto.',
					'last'    =>true
				),
				'last_nameRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàèÁÉÍÓÚÑÜÀÈ]+$/i',
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),
			),
			
			'job_title' => array(
				'job_titleRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el cargo del contacto.',
					'last'    =>true
				),
				'job_titleRule-2' =>array(
					'rule'      => '/^[A-ZñÑa-z áéíóúñüàèÁÉÍÓÚÑÜÀÈ]+$/i',
					'message'   => 'No se permiten números para este campo.',
					'last'    =>true
				),
			),
			
			'schedule_atention' => array(
				'second_last_nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Ingrese el horario de atención del contacto.',
					'last'    =>true
				),
			),
			
			'long_distance_cod' => array(
				'long_distance_codRule-1' => array(
					'rule'    => 'numeric',
					'required'=> false,
					'message' => 'Sólo números.',
					'last'    =>true
				),
			),
			
			'telephone_number' => array(
				'telephone_numberRule-1' => array(
					'rule'    => 'numeric',
					'required'=> false,
					'message' => 'Sólo números.',
					'last'    =>true
				),
			),
			
			'phone_extension' => array(
				'phone_extensionRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Sólo números.',
					'last'    =>true
				),
			),
			
			'long_distance_cod_cell_phone' => array(
				'long_distance_cod_cell_phoneRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Sólo números.',
					'last'    =>true
				),
			),
			
			'cell_phone' => array(
				'cell_phoneRule-1' => array(
					'rule'    => 'numeric',
					'allowEmpty' => true,
					'required'=> false,
					'message' => 'Sólo números.',
					'last'    =>true
				),
			),
		
		);
	}
?>