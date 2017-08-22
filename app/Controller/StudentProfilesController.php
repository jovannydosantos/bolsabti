<?php
	class StudentProfilesController extends AppController{
	
		public $helpers = array('Html', 'Form');
		var $name = 'StudentProfiles';
		public $components = array('Session');
		public $paginate = array(
				'limit' => 2,
				'order' => array('StudentProfiles.id' => 'asc')
		);
		
		public function index(){
				$this->set('StudentProfiles',$this->paginate());	
		}
		
	}
?>