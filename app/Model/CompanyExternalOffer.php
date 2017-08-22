<?php 

	class CompanyExternalOffer extends AppModel{

		var $name = 'CompanyExternalOffer';
	
	
		var $validate = array (
		
			'fecha_contratacion' => array(
					'fecha_contratacionRule-1' => array(
						'rule'    => 'notEmpty',
						'required'=> true,
						'message' => 'Ingrese la fecha de contratación.',          
						'last'    => true
					)
			),
			
			
			'job_name' => array(
					'job_nameRule-1' => array(
						'rule'    => 'notEmpty',
						'required'=> true,
						'message' => 'Ingrese el nombre de la oferta / puesto.',          
						'last'    => true
					)
			),
			
			'salary' => array(
					'salaryRule-1' => array(
						'rule'    => array('money', 'left'),
						'required'=> true,
						'message' => 'Ingrese el salario.',          
						'last'    => true
					)

			),
			
			'state' => array(
					'status_offerRule-1' => array(
						'rule'    => 'notEmpty',
						'required'=> true,
						'message' => 'Seleccione el estado de la oferta',          
						'last'    => true
					)
			),
			
			'rotation' => array(
					'company_rotationRule-1' => array(
						'rule'    => 'notEmpty',
						'required'=> true,
						'message' => 'Seleccione el giro.',          
						'last'    => true
					)
			),
			
			'experience_required' => array(
					'experience_requiredRule-1' => array(
						'rule'    => 'notEmpty',
						'required'=> true,
						'message' => 'Seleccione si la experiencia profesional es requerida.',          
						'last'    => true
					)
			),
			
			'responsible_email' => array(
				'responsible_emailRule-2' =>array(
					'rule' => array('email', true),
					'required'=> false,
					'allowEmpty' => true,
					'message' => 'Por favor ingrese una dirección de correo electrónico válida.',
					'last'    =>true
				),
			),
			
		
		);

	}
?>