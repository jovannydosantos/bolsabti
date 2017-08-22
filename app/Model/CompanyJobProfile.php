<?php
	class CompanyJobProfile extends AppModel{
		
		var $name = 'CompanyJobProfile';
		
		public $hasOne = array(
			'CompanyJobContractType' => array(
				'className'  => 'CompanyJobContractType',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'CompanyLastUpdate' => array(
				'className'  => 'CompanyLastUpdate',
				'foreignKey' => 'id',
				'dependent' => true, 	
			),
			
		);
		
		public $hasMany = array(
			'CompanyCandidateProfile' => array(
				'className'  => 'CompanyCandidateProfile',
				'foreignKey' => 'company_job_profile_id',
				'order' => array('CompanyCandidateProfile.academic_level_id' => 'ASC'),
				'dependent' => true, 	
			),
			'CompanyJobLanguage' => array(
				'className'  => 'CompanyJobLanguage',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'CompanyJobOfferCompetency' => array(
				'className'  => 'CompanyJobOfferCompetency',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'CompanyJobComputingSkill' => array(
				'className'  => 'CompanyJobComputingSkill',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'StudentViewedOffer' => array(
				'className'  => 'StudentViewedOffer',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'StudentSavedOffer' => array(
				'className'  => 'StudentSavedOffer',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'Application' => array(
				'className'  => 'Application',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'Report' => array(
				'className'  => 'Report',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'StudentNotification' => array(
				'className'  => 'StudentNotification',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
			'CompanyViewedOffer' => array(
				'className'  => 'CompanyViewedOffer',
				'foreignKey' => 'company_job_profile_id',
				'dependent' => true, 	
			),
		);
		
		public $belongsTo = array(
			'Company' => array(
				'className' => 'Company',
				'foreignKey' => 'company_id',
			),
			'CompanyJobOffer' => array(
				'className' => 'CompanyJobOffer',
				'foreignKey' => 'company_job_offer_id',
			),
			'Rotation' => array(
				'className'  => 'Rotation',
				'foreignKey' => 'rotation',	
			),
			'ExperienceArea' => array(
				'className'  => 'ExperienceArea',
				'foreignKey' => 'interest_area',	
			),
			'ExperienceTime' => array(
				'className'  => 'ExperienceTime',
				'foreignKey' => 'experience_area',
			),
			'ExperienceSubarea' => array(
				'className'  => 'ExperienceSubarea',
				'foreignKey' => 'experience_subarea',	
			),
			'DisabilityType' => array(
				'className'  => 'DisabilityType',
				'foreignKey' => 'disability_type',	
			),
		);
		
		public $hasAndBelongsToMany = array(
			'StudentFolder' => array(
				'className' => 'StudentFolder',
				'joinTable' => 'student_saved_offers',
				'foreignKey' => 'company_job_profile_id',
				'associationForeignKey' => 'student_folder_id'
			)
		);
		
		public function validateDateOffer(){
			$fechaActual = date('Y-m-d');
			return $fechaActual <= $this->data[$this->alias]['expiration'] ;
		}
	
		var $validate = array (
		
			'job_name' => array(
				'job_nameRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'equivalent_job' => array(
				'equivalent_jobRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'vacancy_number' => array(
				'vacancy_numberRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
				'vacancy_numberRule-2' => array(
					'rule'    => 'numeric',
					'message' => 'Sólo puede ingresar números para este campo.',
					'last'    =>true
				),
			),
			
			'rotation' => array(
				'rotationRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'interest_area' => array(
				'interest_areaRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			
			'activity' => array(
				'activityRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
			),
			
			'expiration' => array(
				'expirationRule-1' => array(
					'rule'    => 'notEmpty',
					'required'=> true,
					'message' => 'Este campo no puede estar vacio.',          
					'last'    => true
				),
				'expirationRule-2' => array(
					'rule' => array ('validateDateOffer'),
					'message' => 'La fecha de vigencia no debe ser menor a la actual.',
					'last'    => true
				),
			),

		);
	}
?>