<?php
	class CompanyOfferOption extends AppModel{

		var $name = 'CompanyOfferOption';
		
		public function validateDateOffer(){
			$fechaActual = date('Y-m-d');
			return $fechaActual <= $this->data[$this->alias]['end_date_company'] ;
		}
		
		var $validate = array (
			
			'end_date_company' => array(
				'end_date_companyRule-1' => array(
						'rule' => array ('validateDateOffer'),
							'message' => 'La fecha no debe ser menor a la actual.',
						'last'    => true
				),
			),
			

			'max_offer_publication' => array(
				'max_offer_publicationRule-1' => array(
					'rule'    => 'numeric',
					'required'=> true,
					'message' => 'Sólo números.',
					'last'    =>true
				),
			),
			
			'max_cv_download' => array(
				'max_cv_downloadRule-1' => array(
					'rule'    => 'numeric',
					'required'=> true,
					'message' => 'Sólo números.',
					'last'    =>true
				),
			),
		
		
		);
		
	} 
?>