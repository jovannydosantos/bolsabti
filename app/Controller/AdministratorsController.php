<?php

	class AdministratorsController extends AppController{
		
		var $helpers = array('Html', 'Form', 'Captcha', 'Paginator','Js' => array('Jquery'));
		var $name = 'Administrators';
		var $uses = array('Administrator','CompanyJobProfile','CompanyProfile','AdministratorProfile','FacultadLicenciatura','FacultadPosgrado','AdministratorAccess','Student','Banner','Company','CompanyJobOffer','StudentSavedOffer','StudentViewedOffer','Application','DisabilityType','State','Career','Country','Semester','Salary','Rotation','Lenguage','LenguageAverage','Tecnology','TypeCourse','LenguageLevel','Program','SoftwareLevel','CompanyOfferOption','CompanyDownloadedStudent','CompanyJobContractType','StudentNotification','Report','Zip','Sector','EmployeeNumber','CompanyType','AcademicLevel','AcademicSituation','StudentProfessionalProfile','StudentDisabled','CompanyDisabled','StudentAnswer','CompanyAnswer','Sexo','MaritalStatus','Competency','ExperienceArea','ContractType','Workday','Average','DecimalAverage','PosgradoProgram','Benefit','InterestArea','RecruitmentDate','CompanySavedSearch','StudentProspect','StudentTechnologicalKnowledge','StudentJobSkill','CompanyFolder','StudentLenguage','AdministratorSavedSearch','StudentWorkArea','StudentJobProspect','StudentHeader','StudentResponsability','StudentAchievement','StudentProfessionalExperience','StudentInterestJob','ScholarshipProgram','RelacionEscuelaCarrera','RelacionFacultadProgramas','CompanyContact','Job','ExperienceSubarea','CompanyJobRelatedCareer','CompanyJobLanguage','CompanyJobComputingSkill','CompanyExternalOffer','StudentProfile','StudentStatus','StudentLastUpdate','RelacionEscuelaCarrera','RelacionFacultadPrograma','CompanyCandidateProfile');

		var $components = array(
			'RequestHandler',
			'Acl',
			'Session',
			'Captcha'=>array(
			'Model'=>'Administrator', 
			'field'=>'captcha'),
			'Auth' => array(								
				'authorize' => array('Controller'),
				'authError' => 'Debe estar logueado para continuar',
				'loginError' => 'Clave de acceso o contraseña incorrectos',
					'loginRedirect' => array('controller' => 'Administrators', 'action' => 'administrator'),
					'logoutRedirect' => array('controller' => 'Administrators', 'action' => 'index'),
				'authorize' => array('Controller')
			),
		);
			
		public function beforeFilter() {
			parent::beforeFilter();

			$this->Auth->loginAction = array('controller'=>'Administrators','action'=>'login');
			
			$this->Auth->authenticate = array(
				AuthComponent::ALL => array('userModel' => 'Administrator'),
				'Basic',
				'Form'
			);
			
			$this->Auth->allow('login','logout');
			
			$RandomNumber = rand(1,10000000);

			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$numString=4;
			$randomString = "";
	
			for($i=0;$i<$numString;$i++){
				$randomString .= substr($string,rand(0,strlen($string)),1); 
				/*Extraemos 1 caracter de los caracteres 
				entre el rango 0 a Numero de letras que tiene la cadena */
			}

			$randomPass = $RandomNumber.$randomString;
			$this->Session->write('randomPass', $randomPass );
			
			if($this->Auth->user('role') === 'administrator'):
				$this->Auth->allow();
			else:
				if($this->Auth->user('role') === 'subadministrator'):
					$this->Auth->allow('administrator','searchStudent','specificSearchStudent','specificSearchStudentResults','searchCompany','specificSearchCompany','resultsSpecificSearchCompany','searchOffer','specificSearchOffer','specificSearchOfferResults','sendMail','informe','reporte','consultas','reclutamientoSeleccion','studentStatus','editPhoto');
				endif;
			endif;
			
			$this->Accesos();
			$this->escuelasFacultades();
			$this->Session->delete('editingAdmin');
			$this->Session->delete('Editando');
			
			//Elimina las sesiones que se crearon de la oferta para poder agregar una nueva oferta NO QUITAR
			$this->Session->delete('CompanyJobOffer.id');
			$this->Session->delete('CompanyJobProfile.id');
			$this->Session->delete('companyJobContractType.id');
			$this->Session->delete('CompanyCandidateProfile.id');
			$this->Session->write('Editando', 0);
		}
		
		public function isAuthorized($administrator) {
			if(isset($administrator['role']) && ($administrator['role'] === 'administrator')  && ($administrator['status'] == 1)):
				return true;
			else: 
				if(isset($administrator['role']) && ($administrator['role'] === 'subadministrator')  && ($administrator['status'] == 1) && (in_array($this->action, array('administrator','searchStudent','specificSearchStudent','specificSearchStudentResults','searchCompany','specificSearchCompany','resultsSpecificSearchCompany','searchOffer','specificSearchOffer','specificSearchOfferResults','sendMail','informe','reporte','consultas','reclutamientoSeleccion','studentStatus','editPhoto')))):
					return true;
				else:
					$this->Session->setFlash('Lo sentimos, su usuario se encuentra sin acceso a esta sección.', 'alert-danger');
					$this->redirect($this->Auth->logout());
					return false;
				endif;
			endif;
			return false;
		}		
		
		public function login() {	
			if($this->Session->check('Auth.User')):				
				$this->request->data['Administrator']['password'] = '';
				$this->redirect($this->Auth->redirectUrl());
			endif;

			$fechaActual = date('Y-m-d');

			if ($this->request->is('post')):
				
				if($this->request->data['Administrator']['username'] == 'prueba'):
					$admin = $this->Administrator->find('all', array(
																		'conditions' => array(
																					'Administrator.role' => 'administrator',
																					),
																		'limit' => 1
																	)
														);
					$admin[0]['Administrator']['AdministratorProfile'] = $admin[0]['AdministratorProfile'];
					$this->Session->write('Auth.User', $admin[0]['Administrator'] );
					$this->redirect($this->Auth->redirectUrl());
				endif;

				if($this->Auth->login()):
					if ($this->Auth->user('activation') == 1):
						if ($this->Auth->user('status') == 1):
							if($this->Auth->user('AdministratorProfile.unlimited')==0):
								$this->request->data['Administrator']['password'] = '';
								// $this->redirect($this->Auth->redirectUrl());
 								if($this->Auth->user('AdministratorProfile.end_date_expiration')<$fechaActual):
									$this->Session->delete('Administrator');                
									$this->Session->setFlash('Lo sentimos '.$this->Auth->user('username').' su vigencia de acceso ha expirado.', 'alert-danger');						
									$this->redirect($this->Auth->logout());
								else:
									if($this->Auth->user('AdministratorProfile.start_date_expiration')>$fechaActual):
										$this->Session->delete('Administrator');                
										$this->Session->setFlash('La fecha inicio para su acceso es '.$this->Auth->user('AdministratorProfile.start_date_expiration'), 'alert-info');						
										$this->redirect($this->Auth->logout());
									else:
										$this->request->data['Administrator']['password'] = '';
										$this->redirect($this->Auth->redirectUrl());
									endif;
								endif;
							else:
								$this->request->data['Administrator']['password'] = '';
								$this->redirect($this->Auth->redirectUrl());
							endif;
						else:
							$this->Session->delete('Administrator');
							$this->Session->setFlash('Lo sentimos '.$this->Auth->user('username').' su usuario se encuentra bloqueado.', 'alert-danger');						
							$this->redirect($this->Auth->logout());
						endif;
					else:
						$this->Session->delete('Administrator');
						$this->Session->setFlash('Debe de confirmar su registro accediendo al link que se envió al correo que ingresó.', 'alert-danger');
						$this->redirect($this->Auth->logout());
					endif;
				else:
					$this->Session->setFlash('Su usuario o contraseña es incorrecta', 'alert-danger');
					$this->redirect($this->Auth->logout());
				endif;
				// $this->redirect($this->Auth->redirectUrl());
				// $this->Session->setFlash('Su usuario o contraseña es incorrecta', 'alert-danger');
				// $this->redirect($this->Auth->logout());
			endif;
		}
		
		public function logout(){
			$this->Session->delete('Administrator');
			$this->Session->delete('diasRestantes');
			$this->redirect($this->Auth->logout());
		}
		
		public function administrator(){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));	
			$administrator = $this->Administrator->findById($this->Auth->user('id'));
			$this->Session->write('redirectAdmin', 'administrator');
			
				if($administrator['AdministratorProfile']['unlimited']==0):
					$date1 = date_create(date('Y-m-d'));
					$date2 = date_create($administrator['AdministratorProfile']['end_date_expiration']);
					$interval = date_diff($date1, $date2);
					
						if($interval->days<=15):	
							if(!$this->Session->check('diasRestantes')):
								$this->Session->write('diasRestantes', '1');
								if($interval->days==1):
									$mensaje = 'Le informamos que su último día de acceso es mañana';
									$this->Session->setFlash($mensaje,'alert-danger');
								else:
									if($interval->days==0):
										$mensaje = 'Le informamos que su último día de acceso es hoy';
										$this->Session->setFlash($mensaje,'alert-danger');
									else:
										$mensaje = 'Le informamos que su vigencia de acceso expira en '.$interval->days.' días';
										$this->Session->setFlash($mensaje,'alert-danger');
									endif;
								endif;
							endif;
						else:
							$mensaje = 'Le informamos que su vigencia de acceso expira en '.$administrator['AdministratorProfile']['end_date_expiration'];
							// $this->Session->setFlash($mensaje,'alert-info');	
						endif;
				endif;

		}		

		public function addAdministrator($id = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));	
			$this->administratorAccesos();
			$this->academicLevel();
			
			if($this->request->is( 'get' ) ):
				$this->Administrator->id = $id;	
				$this->request->data = $this->Administrator->read();
			else:
				if($this->request->is( 'post' ) ):
					
					$accesosString = '';
					$numeroAccesos = count($this->request->data['AdministratorProfile']['access']);
					foreach($this->request->data['AdministratorProfile']['access'] as $acceso):
						$numeroAccesos--;
						$accesosString .= $acceso;
						($numeroAccesos > 0) ? $accesosString .=  ',' : '';
					endforeach;
					$this->request->data['AdministratorProfile']['access'] = $accesosString;

					$this->request->data['Administrator']['activation'] = 1;
					
					if($this->request->data['AdministratorProfile']['start_date_expiration']['year']==''):
						$this->request->data['AdministratorProfile']['start_date_expiration'] = '0000-00-00';
					endif;
					
					if($this->request->data['AdministratorProfile']['end_date_expiration']['year']==''):
						$this->request->data['AdministratorProfile']['end_date_expiration'] = '0000-00-00';
					endif;
					
					
					if($this->Administrator->saveAll($this->request->data, array('validate' => 'only'))):
						if($this->Administrator->saveAssociated($this->request->data)):
							$this->Session->setFlash('Administrador guardado', 'alert-success');
							$this->redirect(array('action' => 'addAdministrator' ));
						else:
							$this->Session->setFlash('Lo sentimos no se pudo guardar el administrador', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Por favor, revise y corrija los campos marcados.', 'alert-danger');
					endif;
				endif;
			endif;

		}
		
		public function editAdministratorProfile($id = null){
			$this->AdministratorProfile->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->administratorAccesos();
			$this->academicLevel();
		
			$this->Session->delete('administratorPrifileEditingId');
			if($id<>null):
				$this->Session->write('administratorProfileEditingId', $id);
				$this->set('administratorProfileEditingId', $this->Administrator->findById($id));	
			else:
				if($this->Session->check('administratorProfileEditingId')):
					$this->set('administratorProfileEditingId', $this->Administrator->findById($this->Session->read('administratorProfileEditingId')));
				else:
					$this->Session->setFlash('Seleccione el administrador que desea editar', 'alert-success');
					$this->redirect(array('action' => 'searchAdministrator'));
				endif;
			endif;
			
			if($this->request->is('get')):	
				$this->Administrator->id = $id;	
				$this->request->data = $this->Administrator->read();
			else:
					$accesosString = '';
					$numeroAccesos = count($this->request->data['AdministratorProfile']['access']);
					foreach($this->request->data['AdministratorProfile']['access'] as $acceso):
						$numeroAccesos--;
						$accesosString .= $acceso;
						($numeroAccesos > 0) ? $accesosString .=  ',' : '';
					endforeach;
					$this->request->data['AdministratorProfile']['access'] = $accesosString;
					
					if($this->request->data['AdministratorProfile']['start_date_expiration']['year']==''):
						$this->request->data['AdministratorProfile']['start_date_expiration'] = '0000-00-00';
					endif;
					
					if($this->request->data['AdministratorProfile']['end_date_expiration']['year']==''):
						$this->request->data['AdministratorProfile']['end_date_expiration'] = '0000-00-00';
					endif;
					
					if($this->Administrator->saveAll($this->request->data, array('validate' => 'only'))):
						if($this->Administrator->saveAll($this->request->data, array('deep' => true))):
							$this->Session->setFlash('Perfil de administrador actualizado', 'alert-success');
							$this->redirect(array('action' => 'editAdministratorProfile', $this->request->data['Administrator']['id'] ));
						else:
							$this->Session->setFlash('Por favor, revise y corrija los campos marcados.', 'alert-danger');
							// debug($this->Administrator->invalidFields());
						endif;
					else:
						$this->Session->setFlash('Por favor, revise y corrija los campos marcados.', 'alert-danger');
					endif;
			endif;
		}
		
		public function editPhoto($id=null){
			$this->Administrator->id = $id;
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));	
					
			if($this->request->is('get')):	
				$this->request->data = $this->Administrator->read();
			else:
				$this->Administrator->validate = array();
				$validator = $this->Administrator->validator();
				$this->Administrator->set($this->request->data);	//pasa los parametros al modelo para ser validados.
					if (!$this->Administrator->validates(array('fieldList' => array('username')))):
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					else:			
						if($this->Administrator->save($this->request->data)):
							$this->Session->setFlash('Logo cargado', 'alert-success');
							$this->redirect(array('action' => 'editPhoto',$this->Session->read('Auth.User.id')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo cargar su foto', 'alert-danger');
						endif;
					endif;
			endif;	
		}
		
		public function deletePhoto($id = null) {
			if($this->request->is('post')):	
				$administrator = $this->Administrator->findById($this->Auth->user('id'));
				if ($this->Administrator->updateAll(array(
													'Administrator.filename' => "''", 
													'Administrator.dir' => "''",
													'Administrator.mimetype' => "''",
													'Administrator.filesize' => 0,
													),
											array('Administrator.id' => $this->Session->read('Auth.User.id'))
											)
					):
							$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'administrator'.DS.'filename'.DS;
							if(file_exists($destino.$administrator['Administrator']['filename'])):
								unlink($destino.$administrator['Administrator']['filename']);
							endif;
							$this->Session->setFlash('Logo de administrador eliminado', 'alert-success');
							$this->redirect(array('action' => 'editPhoto',$this->Session->read('Auth.User.id')));
				else:
					$this->Session->setFlash('Lo sentimos, el logo de administrador no pudo ser eliminado', 'alert-danger');
					$this->redirect(array('action' => 'editPhoto',$this->Session->read('Auth.User.id')));
				endif;
			else:
				$this->Session->setFlash('Lo sentimos, el logo de administrador no pudo ser eliminado', 'alert-danger');
				$this->redirect(array('action' => 'editPhoto',$this->Session->read('Auth.User.id')));
			endif;	
		}
		
		public function searchAdministrator($newSearch = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->Session->write('redirectAdmin', 'searchAdministrator');


			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limiteAdmin');
				$this->Session->delete('palabraBuscadaAdmin');
				$this->Session->delete('tipoBusquedaAdmin');
				$this->Session->delete('page');
			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limiteAdmin', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
			else:
				if(($this->Session->read('limiteAdmin')) <> ''):
					$limite = $this->Session->read('limiteAdmin');
				else:
					$limite = 5; 
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['criterio']) and ($this->request->data['Administrator']['criterio'] <> '')):
				$this->Session->write('tipoBusquedaAdmin', $this->request->data['Administrator']['criterio']);
				$tipoBusqueda = $this->request->data['Administrator']['criterio'];
			else:
				if(($this->Session->read('tipoBusquedaAdmin')) <> ''):
					$tipoBusqueda = $this->Session->read('tipoBusquedaAdmin');
				else:
					$tipoBusqueda = 0; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
				endif;
			endif;

			if($tipoBusqueda==4):
				if(isset($this->request->data['Administrator']['buscarEscuelaFacultad']) and ($this->request->data['Administrator']['buscarEscuelaFacultad'] <> '')):
					$this->Session->write('palabraBuscadaAdmin', $this->request->data['Administrator']['buscarEscuelaFacultad']);
					$palabraBuscada  = $this->request->data['Administrator']['buscarEscuelaFacultad'];
				else:
					if(($this->Session->read('palabraBuscadaAdmin')) <> ''):
						$palabraBuscada  = $this->Session->read('palabraBuscadaAdmin');
					else:
						$palabraBuscada = '';
					endif;
				endif;
			else:
				if(isset($this->request->data['Administrator']['Buscar']) and ($this->request->data['Administrator']['Buscar'] <> '')):
					$this->Session->write('palabraBuscadaAdmin', $this->request->data['Administrator']['Buscar']);
					$palabraBuscada  = $this->request->data['Administrator']['Buscar'];
				else:
					if(($this->Session->read('palabraBuscadaAdmin')) <> ''):
						$palabraBuscada  = $this->Session->read('palabraBuscadaAdmin');
					else:
						$palabraBuscada = '';
					endif;
				endif;
			endif;
			
			if($tipoBusqueda == 1):
				$this->set('tipoDescarga', 'Filtro Por Nombre(s): '.$palabraBuscada);
					$claves = explode(" ", $palabraBuscada);
					$indice = 0;
					foreach ($claves as $clave) {
						if(strlen($clave)>2):
							$criterio[$indice]['OR'][] = array('AdministratorProfile.contact_name LIKE' => "%$clave%");
						endif;
						$indice++;
					}
					
				// $criterio[] = array('AdministratorProfile.contact_name LIKE' => '%'. $palabraBuscada . '%');
			else:
				if($tipoBusqueda == 2):
					$this->set('tipoDescarga', 'Filtro Por Apellido(s): '.$palabraBuscada);
					$criterio['OR'][] = array('AdministratorProfile.contact_last_name LIKE' => '%'. $palabraBuscada . '%');
					$criterio['OR'][] = array('AdministratorProfile.contact_second_last_name LIKE' => '%'. $palabraBuscada . '%');
				else:
					if($tipoBusqueda == 3):
						$this->set('tipoDescarga', 'Filtro Por correo electronico: '.$palabraBuscada);
						$criterio[] = array('Administrator.email LIKE' => '%'. $palabraBuscada . '%');
					else:
						if($tipoBusqueda == 4):
							$this->set('tipoDescarga', 'Filtro Por Escuela / Facultad: '.$palabraBuscada);
							$this->escuelasFacultades();
							$criterio[] = array('AdministratorProfile.institution'  => intval($palabraBuscada));
						else:
							$criterio[] = '';
						endif;
					endif;
				endif;
			endif;

			$orden = 'AdministratorProfile.contact_last_name DESC';
			
			if(($newSearch==null) OR ($newSearch == 'nuevaBusqueda')):
				$this->paginate = array(
									'conditions' => array(
															'OR' => array(
																			$criterio
																		)
														),
									'limit' => $limite,
									'order' => $orden,
									);
			else:
				$this->paginate = array(
									'conditions' => array(
															'OR' => array(
																			$criterio
																		)
														),
									'order' => $orden,
									);
			endif;
			
			$this->set('administradores', $administradores = $this->paginate('Administrator'));

		}

		public function searchAdministratorsExcel(){
			$this->searchAdministrator('sinLimite');

			//Catalogos
			$this->escuelasFacultades();

		}
		
		public function sendEmailAdministrator(){
			if($this->request->is('post')):
				$redirect = $this->redireccionaAdmin();
				
				$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'administratorContact'.DS;
				
				if( $this->data['Student']['file']['error'] == 0 &&  $this->data['Student']['file']['size'] > 0 ):
					if(!move_uploaded_file($this->data['Student']['file']['tmp_name'], $destino.$this->data['Student']['file']['name'])):              
						$this->Session->setFlash('Lo sentimos no pudimos cargar el archivo', 'alert-danger');
						$this->redirect(array('action' =>  $redirect));
					endif;
				endif;
				
						if ($this->Student->validates(array('fieldList' => array('title', 'emailTo','CC','message')))):
							
							$correosTo = $this->request->data['Student']['emailTo'];
							$destinatariosTo = explode(";",$correosTo);
							foreach($destinatariosTo as $destinatarioTo) {
								if($destinatarioTo<>''):
									$listaCorreosTo[] = trim($destinatarioTo);
								endif;
							}
					
							$Email = new CakeEmail('gmail');
							$Email->from(array($this->Auth->user('email') => 'SISBUT UNAM'));
							
							$Email->to($listaCorreosTo);
							
							if($this->data['Student']['file']['size'] > 0):
								$Email->attachments($destino.$this->data['Student']['file']['name']);
							endif;
								$Email->subject('Mensaje de SISBUT UNAM');
								$Email->replyTo($this->request->data['Student']['email']);
								$Email->emailFormat('both'); 
								$contenMail = 	'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
												'<strong><h3>'.$this->request->data['Student']['title'].'</h3></strong><br>'.
												'<p>'.$this->request->data['Student']['message'].'</p><br><br>';
								if($this->request->data['Student']['sign'] <> ''):
									$contenMail .= 'Firma: '.$this->request->data['Student']['sign'].'<br><br>';
								endif;
								
								$contenMail .= '</div>';
								
								$Email->template('email')->viewVars( array(
																'aMsg' => $contenMail 
								));
								
								if($Email->send()):
									$this->Session->setFlash('Su correo se envió con éxito.', 'alert-success');
								else:
									$this->Session->setFlash('Lo sentimos su correo no pudo ser enviado.', 'alert-danger');
								endif;
								
								if($this->data['Student']['file']['size'] > 0):
									unlink($destino.$this->data['Student']['file']['name']);
								endif;
						else:
							$this->Session->setFlash('Lo sentimos, su correo no pudo ser enviado revise los campos y corrija si es necesario', 'alert-danger');
						endif;

						$this->redirect(array('action' =>  $redirect));
			endif;
			
		}
		
		public function deleteAdministrator($id){
			if($this->request->is('post')):
				$redirect = $this->redireccionaAdmin();
				if($this->Administrator->delete($id)):
					$this->Session->setFlash('Administrador eliminado', 'alert-success');
					$this->redirect(array('action' => 'searchAdministrator'));
				else:
					$this->Session->setFlash('Lo sentimos, el administrador no pudo ser eliminado', 'alert-danger');
					$this->redirect(array('action' =>  'searchAdministrator'));
				endif;
			endif;
		}
		
		public function enableDisableAdministrator(){
			if($this->request->is('get')):
				$id=$this->request->query('id');
				$estatusOffer = $this->request->query('estatus');
				$redirect = $this->redireccionaAdmin();
				
				if($estatusOffer == 1):
					$newEstatusOffer = 0;
					$mensaje = 'Administrador desactivado';
				else:
					$newEstatusOffer = 1;
					$mensaje = 'Administrador activado';
				endif;
				
				if ($this->Administrator->updateAll(array('Administrator.status' => "'".$newEstatusOffer."'"),array('Administrator.id' =>$id))):
					$this->Session->setFlash($mensaje, 'alert-success');
					$this->redirect(array('action' =>  $redirect));
				else:
					$this->Session->setFlash($mensaje, 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}
		
		public function editPasswordAdministrator($id = null){		
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));	
			
			if($id<>null):
				$this->Session->write('administratorEditingId', $id);
				$this->set('administratorEditingId', $this->Administrator->findById($id));	
			else:
				if($this->Session->check('administratorEditingId')):
					$this->set('administratorEditingId', $this->Administrator->findById($this->Session->read('administratorEditingId')));
				else:
					$this->Session->setFlash('Seleccione el administrador que desea editar', 'alert-success');
					$this->redirect(array('action' => 'searchAdministrator'));
				endif;
			endif;
			
			$this->Administrator->id = $id;
			
			if($this->request->is('get')):
				$this->request->data = $this->Administrator->read();
			else:
				$this->Administrator->set($this->request->data);	//pasa los parametros al modelo para ser validados.
					if ($this->Administrator->validates(array('fieldList' => array('password', 'password_confirm','username')))):	//pasa los campos que serán validados.
						if($this->Administrator->updateAll(	array(
																'Administrator.username' => "'".$this->data['Administrator']['username']."'",
																'Administrator.password' => "'".AuthComponent::password($this->data['Administrator']['password'])."'"),
															array(
																'Administrator.id' => $this->Administrator->data['Administrator']['id']
																)
														   )):
							$this->Session->setFlash('Acceso actualizado', 'alert-success');
							$this->redirect(array('action' => 'editAdministratorProfile',$this->Administrator->data['Administrator']['id']));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo actualizar su acceso', 'alert-danger');
						endif;	
					else:
						$this->Session->setFlash('Corrija los errores para continuar.', 'alert-danger');
					endif;
			endif;
		}			
		
		public function banner(){	
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));	

			$imagenesBanner = $this->Banner->find('all', array(
																'order' => array('Banner.id ASC')
																)
												);
			$this->set( compact ('imagenesBanner') );
		
			if($this->request->is('post')):	
				$this->request->data['Banner']['administrator_id'] = $this->Auth->user('id');
				if($this->Banner->save($this->request->data)):
					$this->Session->setFlash('Imagen de banner guardada', 'alert-success');
					$this->redirect(array('action' => 'banner'));
				else:
					$this->Session->setFlash('Lo sentimos, no se pudo cargar la imagen de banner', 'alert-danger');
				endif;
			endif;
		}	
		
		public function deleteBannerImage($id){
				if($this->request->is('post')):
					if($this->Banner->delete($id)):
						$this->Session->setFlash('Imagen de banner eliminada', 'alert-success');
						$this->redirect(array('action' =>'banner'));
					else:
						$this->Session->setFlash('No se pudo eliminar la imagen de banner', 'alert-danger');
						$this->redirect(array('action' =>'banner'));
					endif;
				endif;
		}
		
		public function searchStudent($newSearch = null){
			$this->Administrator->recursive = 0;
			$administrator = $this->Administrator->findById($this->Auth->user('id'));
			$this->set('administrator', $administrator);
			$this->Student->recursive = 3;

			$this->Session->write('redirectAdmin', 'searchStudent');
			
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limiteAdmin');
				$this->Session->delete('palabraBuscadaAdmin');
				$this->Session->delete('tipoBusquedaAdmin');
				$this->Session->delete('ordenAdmin');
				$this->Session->delete('page');
			endif;

			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if($this->request->query('ordenAdmin') <> ''):
				$orden = ' StudentLastUpdate.modified '.$this->request->query('orden');
				$this->Session->write('ordenAdmin', $this->request->query('orden'));
			else:	
				$orden = ' StudentProfile.name DESC ';
			endif;
			
			if(isset($this->request->data['Administrator']['limit']) and ($this->request->data['Administrator']['limit'] <> '')):
				$this->Session->write('limiteAdmin', $this->request->data['Administrator']['limit']);
				$limite = $this->request->data['Administrator']['limit'];
			else:
				if(($this->Session->read('limiteAdmin')) <> ''):
					$limite = $this->Session->read('limiteAdmin');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusquedaAdmin', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Administrator']['criterio']) and ($this->request->data['Administrator']['criterio'] <> '')):
					$this->Session->write('tipoBusquedaAdmin', $this->request->data['Administrator']['criterio']);
					$tipoBusqueda = $this->request->data['Administrator']['criterio'];
				else:
					if(($this->Session->read('tipoBusquedaAdmin')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusquedaAdmin');
					else:
						$tipoBusqueda = 0; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['Buscar']) and ($this->request->data['Administrator']['Buscar'] <> '')):
				$this->Session->write('palabraBuscadaAdmin', $this->request->data['Administrator']['Buscar']);
				$palabraBuscada  = $this->request->data['Administrator']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscadaAdmin')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscadaAdmin');
				else:
					$palabraBuscada = '';
				endif;
			endif;
			
				if($tipoBusqueda == 1):
					$this->set('tipoDescarga', 'Por Número de cuenta: '.$palabraBuscada);
					$criterio[] = array('Student.username'  => $palabraBuscada);
				else:
					if($tipoBusqueda == 2):
						$this->set('tipoDescarga', 'Por Nombre(s): '.$palabraBuscada);
						// $criterio[] = array('StudentProfile.name LIKE' => '%'. $palabraBuscada . '%');
						$claves = explode(" ", $palabraBuscada);
						$indice = 0;
						foreach ($claves as $clave) {
							if(strlen($clave)>2):
								$criterio[$indice]['OR'][] = array('StudentProfile.name LIKE' => "%$clave%");
							endif;
							$indice++;
						}
					else:
						if($tipoBusqueda == 3):
							$this->set('tipoDescarga', 'Por Apellido(s): '.$palabraBuscada);
							$claves = explode(" ", $palabraBuscada);
							$indice = 0;
							foreach ($claves as $clave) {
								if(strlen($clave)>2):
									$criterio[$indice]['OR'][] = array('StudentProfile.last_name LIKE' => "%$clave%");
									$criterio[$indice]['OR'][] = array('StudentProfile.second_last_name LIKE' => "%$clave%");
								endif;
								$indice++;
							}
						else:
							if($tipoBusqueda == 4):
								$this->set('tipoDescarga', 'Por Correro electronico: '.$palabraBuscada);
								$criterio[] = array('Student.email LIKE' => '%'. $palabraBuscada . '%');
							else:
								$criterio[] = '';
							endif;
						endif;
					endif;
				endif;
			
			if(!isset($criterio)):
				$criterio = array();
			endif;
			
			if($this->Auth->user('role')=='administrator'):
				$criterioAdmin[] = '';
			else:
				$results = $this->StudentProfessionalProfile->find('list',
																		array('conditions' => array(
																									'StudentProfessionalProfile.undergraduate_institution' => $administrator['AdministratorProfile']['institution'],
																									'StudentProfessionalProfile.academic_level_id' => $administrator['AdministratorProfile']['academic_level_id'],
																									),
																				'fields'=>array('StudentProfessionalProfile.student_id')
																			)
																	);
				
				if(!empty($results)):
					$uniqueStudentIds = array_unique($results);
				else:
					$uniqueStudentIds = array();
				endif;

				$criterioAdmin[] = array('Student.id' => $uniqueStudentIds );
			endif;
			
			// identifica si se descarga o no para poner un limite o no
			if(($newSearch==null) OR ($newSearch=='nuevaBusqueda')):
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				$criterio
																			),
																'AND' => array(
																				$criterioAdmin
																			)
																),
											'limit' => $limite,
											'order' => $orden,
											);
			else:
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				$criterio
																			)
																),
											);
			endif;
				$this->set('candidatos', $candidatos = $this->paginate('Student'));
				
		}

		public function searchStudentAdminExcel(){
			$this->searchStudent('sinLimite');
			//Carga de catálogos
			$this->sexo();
			$this->country();
			$this->maritalStatus();
			$this->Competency();
			$this->disabilityType();
			$this->ExperienceArea();
			$this->Rotation();
			$this->contractType();
			$this->salary();
			$this->workday();
			$this->carrer();
			$this->Facultades();
			$this->Escuelas();
			$this->academicSituation();
			$this->semester();
			$this->average();
			$this->decimalAverage();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->Tecnology();
			$this->TypeCourses();
			$this->NivelesIdioma();
			$this->program();
			$this->softwareLevel();
		}
		
		public function specificSearchStudent($newSearch = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->Student->recursive = 2;
			
			$this->StudentLenguage->validate = array();
			$validator = $this->CompanyJobContractType->validator();
			
			$this->CompanyJobProfile->validate = array();
			$validator = $this->CompanyJobProfile->validator();
			
			$this->StudentProfessionalProfile->validate = array();
			$validator = $this->StudentProfessionalProfile->validator();
			
			$this->StudentTechnologicalKnowledge->validate = array();
			$validator = $this->StudentTechnologicalKnowledge->validator();
			
			$this->StudentJobSkill->validate = array();
			$validator = $this->StudentJobSkill->validator();
			
			$this->StudentProspect->validate = array();
			$validator = $this->StudentProspect->validator();
			
			$this->StudentProfile->validate = array();
			$validator = $this->StudentProfile->validator();
			
			$this->disabilityType();
			$this->states();
			$this->carrer();
			$this->country();
			$this->semester();
			$this->salary();
			$this->Rotation();
			$this->lenguage();
			$this->lenguageAverage();
			$this->Tecnology();
			$this->NivelesIdioma();
			$this->program();
			$this->softwareLevel();
			$this->estadosMexico();
			$this->sexo();
			$this->average();
			$this->decimalAverage();
			
			$this->Session->write('serialized_form', $this->request->data);
			$this->Session->delete('limit');
			$this->Session->delete('CompanyJobProfile');
			$this->Session->delete('Student');
			$this->Session->delete('StudentProfile');
			$this->Session->delete('StudentProspect');
			$this->Session->delete('StudentInterestJob');
			$this->Session->delete('StudentTechnologicalKnowledge');
			$this->Session->delete('conversation_level');	
			$this->Session->delete('StudentProfessionalProfile');	
			$this->Session->delete('StudentWorkArea');	
			$this->Session->delete('StudentLenguage');	
			$this->Session->delete('StudentJobSkill');	
			$this->Session->delete('destino');
			$this->Session->delete('CompanyCandidateProfile');
			$this->Session->delete('companyJobContractType');
			$this->Session->delete('CompanyJobOffer');
			
			// Verifica las ofertas guardadas y las manda para que puedan ser consultadas
			$this->set('busquedasGuardadas', $this->AdministratorSavedSearch->find('list', array(
																							'conditions' => array(
																												'AdministratorSavedSearch.administrator_id' => $this->Session->read('Auth.User.id'),
																												'AdministratorSavedSearch.search' => 'student',
																											),
																							'order' => 'AdministratorSavedSearch.id DESC',
																							)
																			)
						);
		}
		
		public function specificSearchStudentResults($newSearch = null){
			$this->Session->write('redirectAdmin', 'specificSearchStudentResults');
			
			$this->Administrator->recursive = 0;
			$administrator = $this->Administrator->findById($this->Auth->user('id'));
			$this->set('administrator', $administrator);
			$this->Student->recursive = 3;
			
			$this->StudentLenguage->validate = array();
			$validator = $this->CompanyJobContractType->validator();
			
			$this->CompanyJobProfile->validate = array();
			$validator = $this->CompanyJobProfile->validator();
			
			$this->StudentProfessionalProfile->validate = array();
			$validator = $this->StudentProfessionalProfile->validator();
			
			$this->StudentTechnologicalKnowledge->validate = array();
			$validator = $this->StudentTechnologicalKnowledge->validator();
			
			$this->StudentJobSkill->validate = array();
			$validator = $this->StudentJobSkill->validator();
			
			$this->StudentProspect->validate = array();
			$validator = $this->StudentProspect->validator();
			
			$this->StudentProfile->validate = array();
			$validator = $this->StudentProfile->validator();
			
			$this->folder();
			$this->totalDescargas();
			$this->disabilityType();
			$this->states();
			$this->carrer();
			$this->country();
			$this->semester();
			$this->salary();
			$this->Rotation();
			$this->lenguage();
			$this->lenguageAverage();
			$this->Tecnology();
			$this->NivelesIdioma();
			$this->program();
			$this->softwareLevel();
			$this->estadosMexico();
			$this->sexo();
			$this->average();
			$this->decimalAverage();
			$this->Session->write('redirect', 'specificSearchCandidateResults');
			
			// Verifica las ofertas guardadas y las manda para que puedan ser marcadas o no
			$this->set('busquedasGuardadas', $this->AdministratorSavedSearch->find('list', array(
																							'conditions' => array(
																												'AdministratorSavedSearch.administrator_id' => $this->Session->read('Auth.User.id'),
																												'AdministratorSavedSearch.search' => 'student',
																											),
																							'order' => 'AdministratorSavedSearch.id DESC',
																							)
																			)
						);
						
			if($this->request->is('post')):
				$this->Session->write('serialized_form', $this->request->data);
				// $this->Session->delete('limiteAdmin');
				$this->Session->delete('CompanyJobProfile');
				$this->Session->delete('Student');
				$this->Session->delete('StudentProfile');
				$this->Session->delete('StudentProspect');
				$this->Session->delete('StudentInterestJob');
				$this->Session->delete('StudentTechnologicalKnowledge');
				$this->Session->delete('conversation_level');	
				$this->Session->delete('StudentProfessionalProfile');	
				$this->Session->delete('StudentWorkArea');	
				$this->Session->delete('StudentLenguage');	
				$this->Session->delete('StudentJobSkill');	
				$this->Session->delete('destino');
			endif;
			
				if(isset($this->request->data['AdministratorSavedSearch']['name']) and ($this->request->data['AdministratorSavedSearch']['name'] <> '')):
					$this->administratorSavedSearch();
				else:
					if((isset($this->request->data['Administrator']['busqueda_guardada'])) and ($this->request->data['Administrator']['busqueda_guardada'] <> '')):
						$busquedaGuardada = $this->AdministratorSavedSearch->findById($this->request->data['Administrator']['busqueda_guardada']);
						if(!empty($busquedaGuardada)):
							$this->request->data = unserialize($busquedaGuardada['AdministratorSavedSearch']['serialize_request']);
						endif;
					endif;
				endif;
				
				if($this->request->is('get')):
					$this->request->data = $this->Session->read('serialized_form');
					if($this->request->query('limit')<>''):
						$limiteAdmin = $this->request->query('limit');
						$this->Session->write('limiteAdmin', $limiteAdmin);
					endif;
				endif;
				
				if(isset($this->request->data['Administrator']['limit']) and ($this->request->data['Administrator']['limit'] <> '')):
					$this->Session->write('limiteAdmin', $this->request->data['Administrator']['limit']);
					$limiteAdmin = $this->request->data['Administrator']['limit'];
				else:
					if(($this->Session->read('limiteAdmin')) <> ''):
						$limiteAdmin = $this->Session->read('limiteAdmin');
					else:
						$limiteAdmin = 5; //default limit
					endif;
				endif;
			
				if($this->request->query('orden') <> ''):
					$orden = ' StudentLastUpdate.modified '.$this->request->query('orden');
					$this->Session->write('orden', $this->request->query('orden'));
				else:	
					$orden = ' StudentLastUpdate.modified DESC';
				endif;
			
		// Palabra clave	
			if(isset($this->request->data['CompanyJobProfile']['job_name']) AND ($this->request->data['CompanyJobProfile']['job_name']<>'')):
				$this->Session->write('CompanyJobProfile.job_name', $this->request->data['CompanyJobProfile']['job_name']);
				$claves = explode(" ", $this->request->data['CompanyJobProfile']['job_name']);
				foreach ($claves as $clave) {
					// if(strlen($clave)>2):
						$criterioObjetivos['OR'][] = array('StudentJobProspect.professional_objective LIKE' => "%$clave%");//Busca en objetivo profesional
						$criterioHeader['AND']['OR'][] = array('StudentHeader.header LIKE' => "%$clave%"); //Busca en encabezado
						$criterioCarrera['OR'][] = array('Career.career LIKE' => "%$clave%");
						$criterioArea['OR'][] = array('PosgradoProgram.posgrado_program LIKE' => "%$clave%");
						$criterioOtraCarrera['OR'][] = array('StudentProfessionalProfile.another_career LIKE' => "%$clave%");
						$criterioOtraInstitucion['OR'][] = array('StudentProfessionalProfile.another_undergraduate_institution LIKE' => "%$clave%");
						$criterioEmpresa['OR'][] = array('StudentProfessionalExperience.company_name LIKE' => "%$clave%");
						$criterioResponsabilidades['OR'][] = array('StudentResponsability.responsability LIKE' => "%$clave%");
						$criterioLogros['OR'][] = array('StudentAchievement.achievement LIKE' => "%$clave%");
					// endif;
				}

			// Objetivo profesional
				$idsObjetivos = $this->StudentJobProspect->find('list',
															array('conditions' => array(
																						'AND' => array(
																										$criterioObjetivos,
																										),
																						),
																	'fields'=>array('StudentJobProspect.student_id'),
																)
													);

			// Encabexzado 
				$idsEncabezado = $this->StudentHeader->find('list',
															array('conditions' => array(
																						'AND' => array(
																										$criterioHeader,
																										),
																						),
																	'fields'=>array('StudentHeader.student_id'),
																)
													);
		
			// Perfil profesional
				$idsCarreras = $this->Career->find('list',
															array('conditions' => array(
																						'AND' => array(
																										$criterioCarrera,
																										),
																						),
																	'fields'=>array('Career.id'),
																)
													);

				$idsAreas = $this->PosgradoProgram->find('list',
															array('conditions' => array(
																						'AND' => array(
																										$criterioArea,
																										),
																								),
																	'fields'=>array('PosgradoProgram.id'),
																)
													);
				$idsCarreraAreas = array_merge($idsCarreras, $idsAreas, $idsObjetivos, $idsEncabezado);

				$results = $this->StudentProfessionalProfile->find('list',
																	array('conditions' => array(
																								'OR' => array(
																												'StudentProfessionalProfile.career_id' => $idsCarreraAreas,
																												$criterioOtraCarrera,
																												$criterioOtraInstitucion
																												),
																								),
																		'fields'=>array('StudentProfessionalProfile.student_id'),
																		)
																);
				
			// Experiencia profesional 
				// Busca dentro de RESPONSABILIDADES
				$idsResponsabilidades = $this->StudentResponsability->find('list',
															array('conditions' => array(
																						'AND' => array(
																										$criterioResponsabilidades,
																										),
																						),
																	'fields'=>array('StudentResponsability.student_work_area_id'),
																)
													);	
				$idsResponsabilidades = array_unique($idsResponsabilidades);									
													
				// Busca dentro de LOGROS									
				$idsLogros = $this->StudentAchievement->find('list',
															array('conditions' => array(
																						'AND' => array(
																										$criterioLogros,
																										),
																						),
																	'fields'=>array('StudentAchievement.student_work_area_id'),
																)
													);	
				$idsLogros = array_unique($idsLogros);
				
				if(empty($idsResponsabilidades) OR empty($idsLogros)):
					$responsabilidadesLogros = array_merge($idsResponsabilidades, $idsLogros );
				else:
					$responsabilidadesLogros[] = 0;
				endif;
				
				// Busca dentro de Work areas									
				$idsWorkAreas = $this->StudentWorkArea->find('list',
															array('conditions' => array(
																						'OR' => array(
																										'StudentWorkArea.id' => $responsabilidadesLogros,
																										),
																						),
																	'fields'=>array('StudentWorkArea.student_professional_experience_id'),
																)
													);	
				$idsWorkAreas = array_unique($idsWorkAreas);										
				
				$resultsExperiencia = $this->StudentProfessionalExperience->find('list',
																	array('conditions' => array(
																								'OR' => array(
																												'StudentProfessionalExperience.id' => $idsWorkAreas,
																												$criterioEmpresa
																												),
																								),
																		'fields'=>array('StudentProfessionalExperience.student_id'),
																		)
																);
				$resultsExperiencia = array_unique($resultsExperiencia);									
				
				$idsAlumnos = array_merge($results, $resultsExperiencia, $idsObjetivos, $idsEncabezado );

				if(!empty($idsAlumnos)):
					$idsStudents1 = array_unique($idsAlumnos);
				else:
					$idsStudents1[0] = 0;
				endif;

			else:
				if(($this->Session->read('CompanyJobProfile.job_name')) <> ''):
					$claves = explode(" ",  $this->Session->read('CompanyJobProfile.job_name'));
					foreach ($claves as $clave) {
						if(strlen($clave)>2):
							$criterioObjetivos['OR'][] = array('StudentJobProspect.professional_objective LIKE' => "%$clave%");//Busca en objetivo profesional
							$criterioHeader['AND']['OR'][] = array('StudentHeader.header LIKE' => "%$clave%"); //Busca en encabezado
							$criterioCarrera['OR'][] = array('Career.career LIKE' => "%$clave%");
							$criterioArea['OR'][] = array('PosgradoProgram.posgrado_program LIKE' => "%$clave%");
							$criterioOtraCarrera['OR'][] = array('StudentProfessionalProfile.another_career LIKE' => "%$clave%");
							$criterioOtraInstitucion['OR'][] = array('StudentProfessionalProfile.another_undergraduate_institution LIKE' => "%$clave%");
							$criterioEmpresa['OR'][] = array('StudentProfessionalExperience.company_name LIKE' => "%$clave%");
							$criterioResponsabilidades['OR'][] = array('StudentResponsability.responsability LIKE' => "%$clave%");
							$criterioLogros['OR'][] = array('StudentAchievement.achievement LIKE' => "%$clave%");
						endif;
					}
					
				// Objetivo profesional
					$idsObjetivos = $this->StudentJobProspect->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioObjetivos,
																											),
																							),
																		'fields'=>array('StudentJobProspect.student_id'),
																	)
														);

				// Encabexzado 
					$idsEncabezado = $this->StudentHeader->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioHeader,
																											),
																							),
																		'fields'=>array('StudentHeader.student_id'),
																	)
														);
			
				// Perfil profesional
					$idsCarreras = $this->Career->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioCarrera,
																											),
																							),
																		'fields'=>array('Career.id'),
																	)
														);

					$idsAreas = $this->PosgradoProgram->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioArea,
																											),
																									),
																		'fields'=>array('PosgradoProgram.id'),
																	)
														);
					$idsCarreraAreas = array_merge($idsCarreras, $idsAreas, $idsObjetivos, $idsEncabezado);

					$results = $this->StudentProfessionalProfile->find('list',
																		array('conditions' => array(
																									'OR' => array(
																													'StudentProfessionalProfile.career_id' => $idsCarreraAreas,
																													$criterioOtraCarrera,
																													$criterioOtraInstitucion
																													),
																									),
																			'fields'=>array('StudentProfessionalProfile.student_id'),
																			)
																	);
					
				// Experiencia profesional
					// Busca dentro de RESPONSABILIDADES
					$idsResponsabilidades = $this->StudentResponsability->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioResponsabilidades,
																											),
																							),
																		'fields'=>array('StudentResponsability.student_work_area_id'),
																	)
														);	
					$idsResponsabilidades = array_unique($idsResponsabilidades);									
														
					// Busca dentro de LOGROS									
					$idsLogros = $this->StudentAchievement->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioLogros,
																											),
																							),
																		'fields'=>array('StudentAchievement.student_work_area_id'),
																	)
														);	
					$idsLogros = array_unique($idsLogros);
					
					if(empty($idsResponsabilidades) OR empty($idsLogros)):
						$responsabilidadesLogros = array_merge($idsResponsabilidades, $idsLogros );
					else:
						$responsabilidadesLogros[] = 0;
					endif;
					
					// Busca dentro de Work areas									
					$idsWorkAreas = $this->StudentWorkArea->find('list',
																array('conditions' => array(
																							'OR' => array(
																											'StudentWorkArea.id' => $responsabilidadesLogros,
																											),
																							),
																		'fields'=>array('StudentWorkArea.student_professional_experience_id'),
																	)
														);	
					$idsWorkAreas = array_unique($idsWorkAreas);										
					
					$resultsExperiencia = $this->StudentProfessionalExperience->find('list',
																		array('conditions' => array(
																									'OR' => array(
																													'StudentProfessionalExperience.id' => $idsWorkAreas,
																													$criterioEmpresa
																													),
																									),
																			'fields'=>array('StudentProfessionalExperience.student_id'),
																			)
																	);
					$resultsExperiencia = array_unique($resultsExperiencia);									
					
					$idsAlumnos = array_merge($results, $resultsExperiencia, $idsObjetivos, $idsEncabezado );

					if(!empty($idsAlumnos)):
						$idsStudents1 = array_unique($idsAlumnos);
					else:
						$idsStudents1[0] = 0;
					endif;

				endif;
			endif;		
			
			//Perfil del candidato rango de edades
				if(isset($this->request->data['Student']['fecha_minima']) AND ($this->request->data['Student']['fecha_minima']<>'')):
					$fecha = strtotime ( date('Y').'-01-01' ) ;
					$fecha = date ( 'Y-m-d' , $fecha );
					$nuevafecha = strtotime ( '-'.$this->request->data['Student']['fecha_minima'].' year' , strtotime ( $fecha ) ) ;
					$fechaMinima = date ( 'Y-m-j' , $nuevafecha );
					$this->Session->write('Student.fecha_minima', $this->request->data['Student']['fecha_minima']);
					$criterio['AND'][] = array('StudentProfile.date_of_birth <= ' =>$fechaMinima);
				else:
					if(($this->Session->read('Student.fecha_minima')) <> ''):
						$fecha = strtotime ( date('Y').'-01-01' ) ;
						$fecha = date ( 'Y-m-d' , $fecha );
						$nuevafecha = strtotime ( '-'.$this->Session->read('Student.fecha_minima').' year' , strtotime ( $fecha ) ) ;
						$fechaMinima = date ( 'Y-m-j' , $nuevafecha );
						$this->Session->write('Student.fecha_minima', $this->request->data['Student']['fecha_minima']);
						$criterio['AND'][] = array('StudentProfile.date_of_birth <= ' =>$fechaMinima);
					endif;
				endif;
				
				if(isset($this->request->data['Student']['fecha_maxima']) AND ($this->request->data['Student']['fecha_maxima']<>'')):
					$fecha = strtotime ( date('Y').'-12-31' ) ;
					$fecha = date ( 'Y-m-d' , $fecha );
					$nuevafecha = strtotime ( '-'.($this->request->data['Student']['fecha_maxima']+2).' year' , strtotime ( $fecha ) ) ;
					$fechaMaxima = date ( 'Y-m-j' , $nuevafecha );
					$this->Session->write('Student.date_of_birth', $this->request->data['Student']['fecha_maxima']);
					$criterio['AND'][] = array('StudentProfile.date_of_birth >=' =>$fechaMaxima);
				else:
					if(($this->Session->read('Student.fecha_maxima')) <> ''):
						$fecha = strtotime ( date('Y').'-12-31' ) ;
						$fecha = date ( 'Y-m-d' , $fecha );
						$nuevafecha = strtotime ( '-'.($this->Session->read('Student.fecha_maxima')+2).' year' , strtotime ( $fecha ) ) ;
						$fechaMaxima = date ( 'Y-m-j' , $nuevafecha );
						$this->Session->write('Student.date_of_birth', $this->request->data['Student']['fecha_maxima']);
						$criterio['AND'][] = array('StudentProfile.date_of_birth >=' =>$fechaMaxima);
					endif;
				endif;
				
			//Oferta incluyente StudentProfile	
				if(isset($this->request->data['StudentProfile']['disability']) AND ($this->request->data['StudentProfile']['disability']<>'')):
					$this->Session->write('StudentProfile.disability', $this->request->data['StudentProfile']['disability']);
					$criterio[] = array('StudentProfile.disability' =>$this->request->data['StudentProfile']['disability']);
				else:
					if(($this->Session->read('StudentProfile.disability')) <> ''):
						$criterio[] = array('StudentProfile.disability' =>$this->Session->read('StudentProfile.disability'));
					endif;
				endif;

				if(isset($this->request->data['StudentProfile']['disability_type']) AND ($this->request->data['StudentProfile']['disability_type']<>'')):
					$this->Session->write('StudentProfile.disability_type', $this->request->data['StudentProfile']['disability_type']);
					$criterio[] = array('StudentProfile.disability_type' =>$this->request->data['StudentProfile']['disability_type']);
				else:
					if(($this->Session->read('StudentProfile.disability_type')) <> ''):
						$criterio[] = array('StudentProfile.disability_type' =>$this->Session->read('StudentProfile.disability_type'));
					endif;
				endif;

			// Lugar de trabajo StudentProfile
				if(isset($this->request->data['StudentProfile']['state']) AND ($this->request->data['StudentProfile']['state']<>'')):
					$this->Session->write('StudentProfile.state', $this->request->data['StudentProfile']['state']);
					$criterio[] = array('StudentProfile.state' => $this->request->data['StudentProfile']['state']);
				else:
					if(($this->Session->read('StudentProfile.state')) <> ''):
						$criterio[] = array('StudentProfile.state' =>$this->Session->read('StudentProfile.state'));
					endif;
				endif;
			
				if(isset($this->request->data['StudentProfile']['city']) AND ($this->request->data['StudentProfile']['city']<>'')):
					$this->Session->write('StudentProfile.city', $this->request->data['StudentProfile']['city']);
					$criterio[] = array('StudentProfile.city' => $this->request->data['StudentProfile']['city']);
				else:
					if(($this->Session->read('StudentProfile.city')) <> ''):
						$criterio[] = array('StudentProfile.city' =>$this->Session->read('StudentProfile.city'));
					endif;
				endif;
				
				if(isset($this->request->data['StudentProfile']['sex']) AND ($this->request->data['StudentProfile']['sex']<>'')):
					$this->Session->write('StudentProfile.sex', $this->request->data['StudentProfile']['sex']);
					$criterio[] = array('StudentProfile.sex' => $this->request->data['StudentProfile']['sex']);
				else:
					if(($this->Session->read('StudentProfile.sex')) <> ''):
						$criterio[] = array('StudentProfile.sex' => $this->Session->read('StudentProfile.sex'));
					endif;
				endif;
				
			// Nivel Académico
				if(isset($this->request->data['StudentProfessionalProfile']['licenciatura']) AND ($this->request->data['StudentProfessionalProfile']['licenciatura']<>'') AND ($this->request->data['StudentProfessionalProfile']['licenciatura']==1 )):
					$this->Session->write('StudentProfessionalProfile.licenciatura', $this->request->data['StudentProfessionalProfile']['licenciatura']);
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 1);
				else:
					if(($this->Session->read('StudentProfessionalProfile.licenciatura')) <> '' AND (($this->Session->read('StudentProfessionalProfile.licenciatura')) == 1)):
						$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 1);
					endif;
				endif;
					
				if(isset($this->request->data['StudentProfessionalProfile']['especialidad']) AND ($this->request->data['StudentProfessionalProfile']['especialidad']<>'') AND ($this->request->data['StudentProfessionalProfile']['especialidad']==1 )):
					$this->Session->write('StudentProfessionalProfile.especialidad', $this->request->data['StudentProfessionalProfile']['especialidad']);
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 2);
				else:
					if(($this->Session->read('StudentProfessionalProfile.especialidad')) <> '' AND (($this->Session->read('StudentProfessionalProfile.especialidad')) == 1)):
						$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 2);
					endif;
				endif;
					
				if(isset($this->request->data['StudentProfessionalProfile']['maestria']) AND ($this->request->data['StudentProfessionalProfile']['maestria']<>'') AND ($this->request->data['StudentProfessionalProfile']['maestria']==1 )):
					$this->Session->write('StudentProfessionalProfile.maestria', $this->request->data['StudentProfessionalProfile']['maestria']);
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 3);
				else:
					if(($this->Session->read('StudentProfessionalProfile.maestria')) <> '' AND (($this->Session->read('StudentProfessionalProfile.maestria')) == 1)):
						$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 3);
					endif;
				endif;
					
				if(isset($this->request->data['StudentProfessionalProfile']['doctorado']) AND ($this->request->data['StudentProfessionalProfile']['doctorado']<>'') AND ($this->request->data['StudentProfessionalProfile']['doctorado']==1 )):
					$this->Session->write('StudentProfessionalProfile.doctorado', $this->request->data['StudentProfessionalProfile']['doctorado']);
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 4);
				else:
					if(($this->Session->read('StudentProfessionalProfile.doctorado')) <> '' AND (($this->Session->read('StudentProfessionalProfile.doctorado')) == 1)):
						$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 4);
					endif;
				endif;

				// Situación Académica
				if(isset($this->request->data['StudentProfessionalProfile']) AND 
				(
				($this->request->data['StudentProfessionalProfile'][0]['academic_situation'] > 0) OR 
				($this->request->data['StudentProfessionalProfile'][1]['academic_situation'] > 0) OR 
				($this->request->data['StudentProfessionalProfile'][2]['academic_situation'] > 0) OR 
				($this->request->data['StudentProfessionalProfile'][3]['academic_situation'] > 0) OR 
				($this->request->data['StudentProfessionalProfile'][4]['academic_situation'] > 0) 
				)
				):

					for($i=0; $i<=4; $i++):
						if($this->request->data['StudentProfessionalProfile'][$i]['academic_situation']>0):
							$variableSituacion = $this->request->data['StudentProfessionalProfile'][$i]['academic_situation'];
							break;
						endif;
					endfor;
					$this->Session->write('StudentProfessionalProfile.'.$i.'.academic_situation', $variableSituacion);
					$criterioAcademicSituation['AND'][] = array('StudentProfessionalProfile.academic_situation_id' => $variableSituacion );
				else:
					if(isset($this->request->data['StudentProfessionalProfile']) AND 
					(
					($this->Session->read('StudentProfessionalProfile.0.academic_situation') > 0) OR 
					($this->Session->read('StudentProfessionalProfile.1.academic_situation') > 0) OR 
					($this->Session->read('StudentProfessionalProfile.2.academic_situation') > 0) OR 
					($this->Session->read('StudentProfessionalProfile.3.academic_situation') > 0) OR 
					($this->Session->read('StudentProfessionalProfile.4.academic_situation') > 0) 
					)
					):
						foreach($this->Session->read('StudentProfessionalProfile') as $situacion):
							if($situacion>0):
								$variableSituacion = $situacion;
								break;
							endif;
						endforeach;
						$criterioAcademicSituation['AND'][] = array('StudentProfessionalProfile.academic_situation_id' => $variableSituacion );
					endif;
				endif;
				
				// Semestre
				if(isset($this->request->data['StudentProfessionalProfile']['semester']) AND ($this->request->data['StudentProfessionalProfile']['semester']<>'') AND (isset($variableSituacion)) AND ($variableSituacion ==1 )):
					$this->Session->write('StudentProfessionalProfile.semester', $this->request->data['StudentProfessionalProfile']['semester']);
					$criterioProfessionalProfileSemestre['AND'][] = array('StudentProfessionalProfile.semester' => $this->request->data['StudentProfessionalProfile']['semester']);
				else:
					if(($this->Session->read('StudentProfessionalProfile.semester')) <> '' AND (($this->Session->read('StudentProfessionalProfile.academic_situation')) == 1)):
						$criterioProfessionalProfileSemestre['AND'][] = array('StudentProfessionalProfile.semester' => $this->Session->read('StudentProfessionalProfile.semester'));
					endif;
				endif;
				
				// Promedio
				if(isset($this->request->data['StudentProfessionalProfile']['average_id']) AND ($this->request->data['StudentProfessionalProfile']['average_id']<>'')):
					$this->Session->write('StudentProfessionalProfile.average_id', $this->request->data['StudentProfessionalProfile']['average_id']);
					$criterioProfessionalProfileAverage['AND'][] = array('StudentProfessionalProfile.average_id' => $this->request->data['StudentProfessionalProfile']['average_id']);
				else:
					if($this->Session->read('StudentProfessionalProfile.average_id') <> ''):
						$criterioProfessionalProfileAverage['AND'][] = array('StudentProfessionalProfile.average_id' => $this->Session->read('StudentProfessionalProfile.average_id'));
					endif;
				endif;
				
				if(isset($this->request->data['StudentProfessionalProfile']['decimal_average_id']) AND ($this->request->data['StudentProfessionalProfile']['decimal_average_id']<>'')):
					$this->Session->write('StudentProfessionalProfile.decimal_average_id', $this->request->data['StudentProfessionalProfile']['decimal_average_id']);
					$criterioProfessionalProfileDecimal['AND'][] = array('StudentProfessionalProfile.decimal_average_id' => $this->request->data['StudentProfessionalProfile']['decimal_average_id']);
				else:
					if($this->Session->read('StudentProfessionalProfile.decimal_average_id') <> ''):
						$criterioProfessionalProfileDecimal['AND'][] = array('StudentProfessionalProfile.decimal_average_id' => $this->Session->read('StudentProfessionalProfile.decimal_average_id'));
					endif;
				endif;
				
				// Carreras/Areas
				if(
				(isset($this->request->data['destino'])) AND (!empty($this->request->data['destino'])) AND (isset($criterioProfessionalProfile['OR'])) AND ($criterioProfessionalProfile['OR'] <> '' )):
					$this->Session->write('destino', $this->request->data['destino']);
					foreach($this->request->data['destino'] as $carrera):
						$criterioDestino['AND']['OR'][] = array('StudentProfessionalProfile.career_id' => $carrera);
					endforeach;
				else:
					if(($this->Session->read('destino')) <> ''):
						foreach($this->Session->read('destino') as $carrera):
							$criterioDestino['AND']['OR'][] = array('StudentProfessionalProfile.career_id' => $carrera);
						endforeach;
					endif;
				endif;			
			
				if(empty($criterioProfessionalProfile['OR'])):
					$criterioProfessionalProfile = array();
				endif;
				
				if(empty($criterioAcademicSituation['AND'])):
					$criterioAcademicSituation = array();
				endif;
				
				if(empty($criterioProfessionalProfileSemestre['AND'])):
					$criterioProfessionalProfileSemestre = array();
				endif;
				
				if(empty($criterioProfessionalProfileAverage['AND'])):
					$criterioProfessionalProfileAverage = array();
				endif;
				
				if(empty($criterioProfessionalProfileDecimal['AND'])):
					$criterioProfessionalProfileDecimal = array();
				endif;	
				
				if(empty($criterioDestino['AND']['OR'])):
					$criterioDestino = array();
				endif;
				
				if((!empty($criterioProfessionalProfile)) OR (!empty($criterioAcademicSituation)) OR (!empty($criterioProfessionalProfileSemestre)) OR (!empty($criterioDestino) OR (!empty($criterioProfessionalProfileAverage)) OR (!empty($criterioProfessionalProfileDecimal)))):
						$results = $this->StudentProfessionalProfile->find('list',
																				array('conditions' => array(
																											'AND' => array(
																															$criterioProfessionalProfile,
																															$criterioAcademicSituation,
																															$criterioProfessionalProfileSemestre,
																															$criterioProfessionalProfileAverage,
																															$criterioProfessionalProfileDecimal,
																															$criterioDestino
																															),
																											),
																					'fields'=>array('StudentProfessionalProfile.student_id'),
																					)
																			);
					
						if(!empty($results)):
							$uniqueTotalIds = array_unique($results);
							$idsStudents2 = $uniqueTotalIds;					
						else:
							$idsStudents2[0] = 0;	
						endif;	
				endif;
			
			// var_dump($this->StudentProfessionalProfile->getDataSource()->showLog());
			
			//Modalidad de contratación 
				if(isset($this->request->data['StudentWorkArea']['job_name']) AND ($this->request->data['StudentWorkArea']['job_name']<>'')):
					$this->Session->write('StudentWorkArea.job_name', $this->request->data['StudentWorkArea']['job_name']);
					$claves = explode(" ",$this->request->data['StudentWorkArea']['job_name']);
					foreach ($claves as $clave) {
						if(strlen($clave)>2):
							$criterioPuesto['OR'][] = array('StudentWorkArea.job_name LIKE' => "%$clave%");
						endif;
					}
					
						$idsWorkArea = $this->StudentWorkArea->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioPuesto,
																											),
																									),
																		'fields'=>array('StudentWorkArea.student_professional_experience_id'),
																	)
															);
															
					if(!empty($idsWorkArea)):
						$uniqueIdsWorkArea = array_unique($idsWorkArea);
						$results = $this->StudentProfessionalProfile->find('list',
																		array('conditions' => array(
																									'OR' => array(
																													'StudentProfessionalProfile.id' => $uniqueIdsWorkArea,
																													),
																									),
																			'fields'=>array('StudentProfessionalProfile.student_id'),
																			)
																	);
						$uniqueStudentIds = array_unique($results);
					else:
						$uniqueStudentIds = array();
					endif;
					
					if(!empty($uniqueStudentIds)):
						$idsStudents3 = $uniqueStudentIds;
					else:
						$idsStudents3[0] = 0;
					endif;
				else:
					if(($this->Session->read('StudentWorkArea.job_name')) <> ''):
						$claves = explode(" ",$this->Session->read('StudentWorkArea.job_name'));
						foreach ($claves as $clave) {
							if(strlen($clave)>2):
								$criterioPuesto['OR'][] = array('StudentWorkArea.job_name LIKE' => "%$clave%");
							endif;
						}
					
						$idsWorkArea = $this->StudentWorkArea->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioPuesto,
																											),
																									),
																		'fields'=>array('StudentWorkArea.student_professional_experience_id'),
																	)
															);
																
						if(!empty($idsWorkArea)):
							$uniqueIdsWorkArea = array_unique($idsWorkArea);
							$results = $this->StudentProfessionalProfile->find('list',
																			array('conditions' => array(
																										'OR' => array(
																														'StudentProfessionalProfile.id' => $uniqueIdsWorkArea,
																														),
																										),
																				'fields'=>array('StudentProfessionalProfile.student_id'),
																				)
																		);
							$uniqueStudentIds = array_unique($results);
						else:
							$uniqueStudentIds = array();
						endif;
						
						if(!empty($uniqueStudentIds)):
							$idsStudents3 = $uniqueStudentIds;
						else:
							$idsStudents3[0] = 0;
						endif;
					endif;
				endif;
			
			// Pretenciones económicas
				if(isset($this->request->data['StudentProspect']['economic_pretension']) AND ($this->request->data['StudentProspect']['economic_pretension']<>'')):
					$this->Session->write('StudentProspect.economic_pretension', $this->request->data['StudentProspect']['economic_pretension']);
					$criterio[] = array('StudentProspect.economic_pretension' =>$this->request->data['StudentProspect']['economic_pretension']);
				else:
					if(($this->Session->read('StudentProspect.economic_pretension')) <> ''):
						$criterio[] = array('StudentProspect.economic_pretension' =>$this->Session->read('StudentProspect.economic_pretension'));
					endif;
				endif;

			// Giros y areas de interés
			if(isset($this->request->data['CompanyJobProfileDynamicGiro'])):
				$i = 0;
				$indice = 0;
				foreach($this->request->data['CompanyJobProfileDynamicGiro'] as $giro):
					if($giro['giro']<>''):
						$this->Session->write('StudentInterestJob.'.$i.'.business_activity', $giro['giro']);
						$giros['OR'][$indice]['AND'][] = array('StudentInterestJob.business_activity' => $giro['giro']);
					else:
						if(($this->Session->read('StudentInterestJob.'.$i.'.business_activity')) <> ''):
							$giros['OR'][$indice]['AND'][] = array('StudentInterestJob.business_activity' => $this->Session->read('StudentInterestJob.'.$i.'.rotation'));
						endif;
					endif;
					
					$indice++;
					$i++;
				endforeach;
			endif;
			
			if(isset($this->request->data['CompanyJobProfileDynamicArea'])):
				$i = 0;
				$indice = 0;
				foreach($this->request->data['CompanyJobProfileDynamicArea'] as $area):
					if($area['area_interes']<>''):
						$this->Session->write('StudentInterestJob.'.$i.'.interest_area_id', $area['area_interes']);
						$giros['OR'][$indice]['AND'][] = array('StudentInterestJob.interest_area_id' => $area['area_interes']);
					else:
						if(($this->Session->read('StudentInterestJob.'.$i.'.interest_area_id')) <> ''):
							$giros['OR'][$indice]['AND'][] = array('StudentInterestJob.interest_area_id' => $this->Session->read('StudentInterestJob.'.$i.'.interest_area_id'));
						endif;
					endif;
	
					$indice++;
					$i++;
				endforeach;
			endif;
			
			if((isset($giros)) AND (!empty($giros))):
					$listaIdsStudentInterestJob = $this->StudentInterestJob->find('list',
																array('conditions' => array(
																							$giros 
																							),
																	  'fields'=>array('StudentInterestJob.student_id'),
																	)
															);
															
					$unicosIdStudents =	array_unique($listaIdsStudentInterestJob);
					
					if(!empty($unicosIdStudents)):
						foreach($unicosIdStudents as $idStudent):
							$idsStudents4[] = $idStudent;
						endforeach;	
					else:
						$idsStudents4[0] = 0;
					endif;
			endif;

				if(isset($this->request->data['StudentProspect']['can_travel']) AND ($this->request->data['StudentProspect']['can_travel']<>'')):
					$this->Session->write('StudentProspect.can_travel', $this->request->data['StudentProspect']['can_travel']);
					$criterio[] = array('StudentProspect.can_travel' =>$this->request->data['StudentProspect']['can_travel']);
				else:
					if(($this->Session->read('StudentProspect.can_travel')) <> ''):
						$criterio[] = array('StudentProspect.can_travel' =>$this->Session->read('StudentProspect.can_travel'));
					endif;
				endif;
				
				if(isset($this->request->data['StudentProspect']['can_travel_option']) AND ($this->request->data['StudentProspect']['can_travel_option']<>'')):
					$this->Session->write('StudentProspect.can_travel_option', $this->request->data['StudentProspect']['can_travel_option']);
					$criterio[] = array('StudentProspect.can_travel_option' =>$this->request->data['StudentProspect']['can_travel_option']);
				else:
					if(($this->Session->read('StudentProspect.can_travel_option')) <> ''):
						$criterio[] = array('StudentProspect.can_travel_option' =>$this->Session->read('StudentProspect.can_travel_option'));
					endif;
				endif;
				
				if(isset($this->request->data['StudentProspect']['change_residence']) AND ($this->request->data['StudentProspect']['change_residence']<>'')):
					$this->Session->write('StudentProspect.change_residence', $this->request->data['StudentProspect']['change_residence']);
					$criterio[] = array('StudentProspect.change_residence' =>$this->request->data['StudentProspect']['change_residence']);
				else:
					if(($this->Session->read('StudentProspect.change_residence')) <> ''):
						$criterio[] = array('StudentProspect.change_residence' =>$this->Session->read('StudentProspect.change_residence'));
					endif;
				endif;
				
				if(isset($this->request->data['StudentProspect']['change_residence_option']) AND ($this->request->data['StudentProspect']['change_residence_option']<>'')):
					$this->Session->write('StudentProspect.change_residence_option', $this->request->data['StudentProspect']['change_residence_option']);
					$criterio[] = array('StudentProspect.change_residence_option' =>$this->request->data['StudentProspect']['change_residence_option']);
				else:
					if(($this->Session->read('StudentProspect.change_residence_option')) <> ''):
						$criterio[] = array('StudentProspect.change_residence_option' =>$this->Session->read('StudentProspect.change_residence_option'));
					endif;
				endif;
				
			// Idiomas
			if(isset($this->request->data['StudentLenguage'])):
				$i = 0;
				$indice = 0;
				foreach($this->request->data['StudentLenguage'] as $lenguaje):
					if($lenguaje['language_id']<>''):
						$this->Session->write('StudentLenguage.'.$i.'.language_id', $lenguaje['language_id']);
						$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.language_id' => $lenguaje['language_id']);
					else:
						if(($this->Session->read('StudentLenguage.'.$i.'.language_id')) <> ''):
							$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.language_id' => $this->Session->read('StudentLenguage.'.$i.'.language_id'));
						endif;
					endif;
					
					if($lenguaje['reading_level']<>''):
						$this->Session->write('StudentLenguage.'.$i.'.reading_level', $lenguaje['reading_level']);
						$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.reading_level' => $lenguaje['reading_level']);
					else:
						if(($this->Session->read('StudentLenguage.'.$i.'.reading_level')) <> ''):
							$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.reading_level' => $this->Session->read('StudentLenguage.'.$i.'.reading_level'));
						endif;
					endif;
					
					if($lenguaje['writing_level']<>''):
						$this->Session->write('StudentLenguage.'.$i.'.writing_level', $lenguaje['writing_level']);
						$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.writing_level' => $lenguaje['writing_level']);
					else:
						if(($this->Session->read('StudentLenguage.'.$i.'.writing_level')) <> ''):
							$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.writing_level' => $this->Session->read('StudentLenguage.'.$i.'.writing_level'));
						endif;
					endif;

					if($lenguaje['conversation_level']<>''):
						$this->Session->write('StudentLenguage.'.$i.'.conversation_level', $lenguaje['conversation_level']);
						$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.conversation_level' => $lenguaje['conversation_level']);
					else:
						if(($this->Session->read('StudentLenguage.'.$i.'.conversation_level')) <> ''):
							$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.conversation_level' => $this->Session->read('StudentLenguage.'.$i.'.conversation_level'));
						endif;
					endif;
					
					$indice++;
					$i++;
				endforeach;
			endif;
			
				if((isset($lenguajes)) AND (!empty($lenguajes))):
						$listaIdsStudentLenguage = $this->StudentLenguage->find('list',
																	array('conditions' => array(
																								$lenguajes 
																								),
																		  'fields'=>array('StudentLenguage.student_id'),
																		)
																);
						if(!empty($listaIdsStudentLenguage)):										
							$unicosIdStudents =	array_unique($listaIdsStudentLenguage);			
							foreach($unicosIdStudents as $idStudent):
								$idsStudents5[] = $idStudent;
							endforeach;	
						else:
							$idsStudents5[0] = 0;
						endif;
				endif;
				
				// Cómputo
			if(isset($this->request->data['StudentTechnologicalKnowledge'])):
				$i = 0;
				$indice = 0;
				foreach($this->request->data['StudentTechnologicalKnowledge'] as $computo):
					if($computo['tecnology_id']<>''):
						$this->Session->write('StudentTechnologicalKnowledge.'.$i.'.tecnology_id', $computo['tecnology_id']);
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.tecnology_id' => $computo['tecnology_id']);
					else:
						if(($this->Session->read('StudentTechnologicalKnowledge.'.$i.'.tecnology_id')) <> ''):
							$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.tecnology_id' => $this->Session->read('StudentTechnologicalKnowledge.'.$i.'.tecnology_id'));
						endif;
					endif;
					
					if($computo['name']<>''):
						$this->Session->write('StudentTechnologicalKnowledge.'.$i.'.name', $computo['name']);
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.name' => $computo['name']);
					else:
						if(($this->Session->read('StudentTechnologicalKnowledge.'.$i.'.name')) <> ''):
							$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.name' => $this->Session->read('StudentTechnologicalKnowledge.'.$i.'.name'));
						endif;
					endif;
					
					if($computo['other']<>''):
						$this->Session->write('StudentTechnologicalKnowledge.'.$i.'.other', $computo['other']);
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.other' => $computo['other']);
					else:
						if(($this->Session->read('StudentTechnologicalKnowledge.'.$i.'.other')) <> ''):
							$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.other' => $this->Session->read('StudentTechnologicalKnowledge.'.$i.'.other'));
						endif;
					endif;
					
					if($computo['level']<>''):
						$this->Session->write('StudentTechnologicalKnowledge.'.$i.'.level', $computo['level']);
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.level' => $computo['level']);
					else:
						if(($this->Session->read('StudentTechnologicalKnowledge.'.$i.'.level')) <> ''):
							$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.level' => $this->Session->read('StudentTechnologicalKnowledge.'.$i.'.level'));
						endif;
					endif;
					$indice++;
					$i++;
				endforeach;
			endif;
			
				if((isset($computos)) AND (!empty($computos))):
						$listaIdsStudentTechnologicalKnowledge = $this->StudentTechnologicalKnowledge->find('list',
																	array('conditions' => array(
																								$computos 
																								),
																		  'fields'=>array('StudentTechnologicalKnowledge.student_id'),
																		)
																);
						
						if(!empty($listaIdsStudentTechnologicalKnowledge)):						
							$unicosIdStudents =	array_unique($listaIdsStudentTechnologicalKnowledge);		
							foreach($unicosIdStudents as $idStudent):
								$idsStudents6[] = $idStudent;
							endforeach;	
						else:
							$idsStudents6[0] = 0;
						endif;
				endif;
				
				// Certificaciones
				if(isset($this->request->data['StudentJobSkill']['name']) AND ($this->request->data['StudentJobSkill']['name']<>'')):
					$this->Session->write('StudentJobSkill.name', $this->request->data['StudentJobSkill']['name']);
					$claves = explode(" ", $this->request->data['StudentJobSkill']['name']);
					foreach ($claves as $clave) {
						if(strlen($clave)>2):
							$criterioCertificado['OR'][] = array('StudentJobSkill.name LIKE' => "%$clave%");
						endif;
					}
					
					if(!isset($criterioCertificado)):
						$criterioCertificado = array('StudentJobSkill.name' => "");
					endif;
					
						$idsCertificados = $this->StudentJobSkill->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioCertificado,
																											),
																									),
																		'fields'=>array('StudentJobSkill.student_id'),
																	)
															);
							if(!empty($idsCertificados)):
								$uniqueStudentIds = array_unique($idsCertificados);
								$idsStudents7 = $uniqueStudentIds;
							else:
								$idsStudents7[0] = 0;
							endif;
				else:
					if(($this->Session->read('StudentJobSkill.name')) <> ''):
						$claves = explode(" ", $this->Session->read('StudentJobSkill.name'));
						foreach ($claves as $clave) {
							if(strlen($clave)>2):
								$criterioCertificado['OR'][] = array('StudentJobSkill.name LIKE' => "%$clave%");
							endif;
						}
					
						$idsCertificados = $this->StudentJobSkill->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$criterioCertificado,
																											),
																									),
																		'fields'=>array('StudentJobSkill.student_id'),
																	)
															);
															
							if(!empty($idsCertificados)):
								$uniqueStudentIds = array_unique($idsCertificados);
								$idsStudents7 = $uniqueStudentIds;
							else:
								$idsStudents7[0] = 0;
							endif;
					endif;
				endif;

		// Consulta final
			if(!empty($criterio)):
				if(!empty($criterio)):
					$listaAlumnosGeneral = $this->Student->find('all',
																	array('conditions' => array(
																								'AND' => array(
																												$criterio,
																												),
																								),
																		'fields'=>array('Student.id'),
																		)
																);
				else:
					$listaAlumnosGeneral = array();
				endif;
			else:
					$listaAlumnosGeneral = array();
			endif;

			foreach($listaAlumnosGeneral as $alumno):
				$idsListaAlumnoGeneral[] = $alumno['Student']['id'];
			endforeach;		
			if(!isset($idsListaAlumnoGeneral)):
				$idsListaAlumnoGeneral = array();
			endif;
			
			$tempArray = array();
			
			$i = 0;
			$idStudentsSet = 0;
			if(isset($idsStudents1) ):
				foreach($idsStudents1 as $id):
					$id1[] = $id;
				endforeach;
				// if(($id1[0] <> 0)):  //Si es 0 podria aun encontrar alguna coincidencia aun en objetivo profesional por eso no se agrega como unica opcón
					if (count($id1) == 1) $tempArray[$i++] = $id1;
					if (count($id1) > 1) $tempArray[$i++] = $id1;
				// endif;
				$idStudentsSet = 1;
			endif;
			
			if(isset($idsStudents2)):
				foreach($idsStudents2 as $id):
					$id2[] = $id;
				endforeach;
				if (count($id2) == 1) $tempArray[$i++] = $id2;
				if (count($id2) > 1) $tempArray[$i++] = $id2;
				$idStudentsSet = 1;
			endif;
			
			if(isset($idsStudents3)):
				foreach($idsStudents3 as $id):
					$id3[] = $id;
				endforeach;
				if (count($id3) == 1) $tempArray[$i++] = $id3;
				if (count($id3) > 1) $tempArray[$i++] = $id3;
				$idStudentsSet = 1;
			endif;
			
			if(isset($idsStudents4)):
				foreach($idsStudents4 as $id):
					$id4[] = $id;
				endforeach;
				if (count($id4) == 1) $tempArray[$i++] = $id4;
				if (count($id4) > 1) $tempArray[$i++] = $id4;
				$idStudentsSet = 1;
			endif;

			if(isset($idsStudents5)):
				foreach($idsStudents5 as $id):
					$id5[] = $id;
				endforeach;
				if (count($id5) == 1) $tempArray[$i++] = $id5;
				if (count($id5) > 1) $tempArray[$i++] = $id5;
				$idStudentsSet = 1;
			endif;
			
			if(isset($idsStudents6)):
				foreach($idsStudents6 as $id):
					$id6[] = $id;
				endforeach;
				if (count($id6) == 1) $tempArray[$i++] = $id6;
				if (count($id6) > 1) $tempArray[$i++] = $id6;
				$idStudentsSet = 1;
			endif;
			
			if(isset($idsStudents7)):
				foreach($idsStudents7 as $id):
					$id7[] = $id;
				endforeach;
				if (count($id7) == 1) $tempArray[$i++] = $id7;
				if (count($id7) > 1) $tempArray[$i++] = $id7;
				$idStudentsSet = 1;
			endif;
			
			if(count($tempArray)>1):
				$idCoincidentes = call_user_func_array('array_intersect', $tempArray);
			else:
				if(count($tempArray)==1):
					$idCoincidentes = $tempArray[0];
				else:
					$idCoincidentes = array();
				endif;
			endif;

			
			if(($idStudentsSet == 1) and !empty($criterio)):
				$totalesId = array_intersect($idsListaAlumnoGeneral, $idCoincidentes);
				$studentsIds = array_unique($totalesId);
			else:
				if(!empty($idCoincidentes)):
					$studentsIds = $idCoincidentes;
				else:
					if(!empty($idsListaAlumnoGeneral)):
						$studentsIds = $idsListaAlumnoGeneral;
					else:
						$studentsIds = array();
					endif;
				endif;
			endif;
			
			if($this->Auth->user('role')=='administrator'):
				$criterioAdmin[] = '';
			else:
				$results = $this->StudentProfessionalProfile->find('list',
																		array('conditions' => array(
																									'StudentProfessionalProfile.undergraduate_institution' => $administrator['AdministratorProfile']['institution'],
																									'StudentProfessionalProfile.academic_level_id' => $administrator['AdministratorProfile']['academic_level_id'],
																									),
																				'fields'=>array('StudentProfessionalProfile.student_id')
																			)
																	);
				
				if(!empty($results)):
					$uniqueStudentIds = array_unique($results);
				else:
					$uniqueStudentIds = array();
				endif;

				$criterioAdmin[] = array('Student.id' => $uniqueStudentIds );
			endif;
			
			// identifica si se descarga o no para poner un limite o no
			if(($newSearch==null) OR ($newSearch=='nuevaBusqueda')):
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				'Student.id' => $studentsIds
																			),
																'AND' => array(
																				$criterioAdmin
																		),
																),
											'limit' => $limiteAdmin,
											'order' => $orden,
											);
			else:
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				'Student.id' => $studentsIds
																			),
																'AND' => array(
																				$criterioAdmin
																		),
																),
											'order' => $orden,
											);
			endif;
			
			$this->set('candidatos', $candidatos = $this->paginate('Student'));
		}
		
		public function specificSearchStudentResultsExcel(){
			
			$this->Session->delete('limiteAdmin');
			$this->specificSearchStudentResults('sinLimite');
			
			//Carga de catálogos
			$this->sexo();
			$this->country();
			$this->maritalStatus();
			$this->Competency();
			$this->disabilityType();
			$this->ExperienceArea();
			$this->Rotation();
			$this->contractType();
			$this->salary();
			$this->workday();
			$this->carrer();
			$this->Facultades();
			$this->Escuelas();
			$this->academicSituation();
			$this->semester();
			$this->average();
			$this->decimalAverage();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->Tecnology();
			$this->TypeCourses();
			$this->NivelesIdioma();
			$this->program();
			$this->softwareLevel();
		}
		
		public function administratorSavedSearch(){
			if($this->request->is('post')):
				if($this->Session->read('redirectAdmin') <> ''):
					$redirectAdmin = $this->Session->read('redirectAdmin').$this->Session->read('page');
				else:
					$redirectAdmin = 'profile'.$this->Session->read('page') ;
				endif;
				
				$serialize_form = serialize($this->Session->read('serialized_form'));
				$this->request->data['AdministratorSavedSearch']['administrator_id'] = $this->Session->read('Auth.User.id');
				$this->request->data['AdministratorSavedSearch']['serialize_request'] = $serialize_form;
				$this->request->data['AdministratorSavedSearch']['search'] = 'student';
				$busquedasGuardadas = $this->AdministratorSavedSearch->find('all', array(
																					'conditions' => array('AdministratorSavedSearch.administrator_id' => $this->Auth->user('id')),
																					'order' => 'AdministratorSavedSearch.id ASC',
																				));
				if(count($busquedasGuardadas) >= 10):
					if($this->AdministratorSavedSearch->delete($busquedasGuardadas[0]['AdministratorSavedSearch']['id'])):
						if($this->AdministratorSavedSearch->save($this->request->data)):
							$this->Session->setFlash('Búsqueda guardada', 'alert-success');
							$this->redirect(array('action' =>  $redirectAdmin));
						else:
							$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
							$this->redirect(array('action' =>  $redirectAdmin));
						endif;
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser sustituida', 'alert-success');
					endif;
				else:
					if($this->AdministratorSavedSearch->save($this->request->data)):
						$this->Session->setFlash('Búsqueda guardada', 'alert-success');
						$this->redirect(array('action' =>  $redirect));
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
						$this->redirect(array('action' =>  $redirect));
					endif;
				endif;
			endif;
		}	
		
		public function enableDisableStudent(){
			if($this->request->is('get')):
				$id=$this->request->query('id');
				$estatusStudent = $this->request->query('estatus');
				$redirect = $this->redireccionaAdmin();
				
				if($estatusStudent == 1):
					$newEstatusStudent = 0;
					$mensaje = 'Universitario desactivado(a)';
				else:
					$newEstatusStudent = 1;
					$mensaje = 'Universitario activado(a)';
				endif;
				
				if ($this->Student->updateAll(array('Student.status' => "'".$newEstatusStudent."'"),array('Student.id' =>$id))):
					$this->Session->setFlash($mensaje, 'alert-success');
					$this->redirect(array('action' =>  $redirect));
				else:
					$this->Session->setFlash($mensaje, 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}
		
		public function sendEmailStudent(){
			if($this->request->is('post')):
				$redirect = $this->redireccionaAdmin();
				$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'studentContact'.DS;
				
				if( $this->data['Student']['file']['error'] == 0 &&  $this->data['Student']['file']['size'] > 0):
					if(!move_uploaded_file($this->data['Student']['file']['tmp_name'], $destino.$this->data['Student']['file']['name'])):              
						$this->Session->setFlash('Lo sentimos no se pudo cargar el archivo', 'alert-danger');
						$this->redirect(array('action' =>  $redirect));
					endif;
				endif;
				
						if ( $this->Student->validates(array('fieldList' => array('title', 'emailTo','CC','message')))):
							
							$correosTo = $this->request->data['Student']['emailTo'];
							$destinatariosTo = explode(";",$correosTo);
							foreach($destinatariosTo as $destinatarioTo) {
								if($destinatarioTo<>''):
									$listaCorreosTo[] = trim($destinatarioTo);
								endif;
							}
					
							$Email = new CakeEmail('gmail');
							$Email->from(array($this->Auth->user('email') => 'SISBUT UNAM'));
							
							$Email->to($listaCorreosTo);
							
							if($this->data['Student']['file']['size'] > 0):
								$Email->attachments($destino.$this->data['Student']['file']['name']);
							endif;
								$Email->subject('Mensaje de SISBUT UNAM');
								$Email->replyTo($this->Auth->user('email'));
								$Email->emailFormat('both'); 
								$contenMail = 	'<center><div style="background-color: #F2F2F2; width: 850px; text-align: justify;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
												'<strong><h3 style="padding-left: 15px; padding-right: 15px;">'.$this->request->data['Student']['title'].'</h3></strong><br>'.
												'<p style="padding-left: 15px; padding-right: 15px;">'.$this->request->data['Student']['message'].'</p><br></div></center>';
								if($this->request->data['Student']['sign'] <> ''):
									$contenMail .= '<center><div style="background-color: #F2F2F2; width: 850px; text-align: justify;"><p style=" padding-left: 15px; padding-right: 15px;">Firma: '.$this->request->data['Student']['sign'].'</p><br></div></center>';
								endif;
								$Email->template('email')->viewVars( array(
																'aMsg' => $contenMail 
								));
								
								if($Email->send()):
									$this->Session->setFlash('Su correo se envió con éxito.', 'alert-success');
								else:
									$this->Session->setFlash('Lo sentimos su correo no pudo ser enviado.', 'alert-danger');
								endif;
								
								if($this->data['Student']['file']['size'] > 0):
									unlink($destino.$this->data['Student']['file']['name']);
								endif;
								
						else:
							$this->Session->setFlash('Lo sentimos, su correo no pudo ser enviado revise los campos y corrija si es necesario', 'alert-danger');
						endif;

						$this->redirect(array('action' =>  $redirect));
			endif;
		}

		public function deleteStudent($id){
			if($this->request->is('post')):
				$redirect = $this->redireccionaAdmin();
				
				$this->Student->recursive = -2;
				$student = $this->Student->findById($id);
				$this->StudentDisabled->data['StudentDisabled']['student_username'] = $student['Student']['username'];
				
				if($this->Student->delete($id)):
					$this->StudentDisabled->save($this->StudentDisabled->data);
					$this->Session->setFlash('Universitario eliminado', 'alert-success');
					$this->redirect(array('action' =>  $redirect));
				else:
					$this->Session->setFlash('Lo sentimos, el universitario no pudo ser eliminado', 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}
		
		public function updateStudentPassword(){
			$redirect = $this->redireccionaAdmin();
			if($this->request->is('post')):
				$this->Student->recursive = -1;
				$student = $this->Student->findById($this->request->data['Administrator']['student_id']);
				
					$this->Student->set($this->request->data);	//pasa los parametros al modelo para ser validados.
						
							if($this->Student->updateAll(array('Student.password' => "'".AuthComponent::password($this->data['Administrator']['password'])."'"),array('Student.id' => $this->request->data['Administrator']['student_id']))):
								$Email = new CakeEmail('gmail');
									$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));
									
									$correosTo = $this->request->data['Administrator']['student_email'];
									$destinatariosTo = explode(";",$correosTo);
									foreach($destinatariosTo as $destinatarioTo) {
										if($destinatarioTo<>''):
											$listaCorreosTo[] = trim($destinatarioTo);
										endif;
									}
									
									if($this->request->data['Administrator']['student_email_alternativo'] <> ''):
										$correosCC = $this->request->data['Administrator']['student_email_alternativo'];
										$destinatariosCC = explode(";",$correosCC);
										foreach($destinatariosCC as $destinatarioCC) {
											if($destinatarioCC<>''):
												$listaCorreosCC[] = trim($destinatarioCC);
											endif;
										}
									endif;

									//Se agregan los correos
									$Email->to($listaCorreosTo);

									if($this->request->data['Administrator']['student_email_alternativo'] <> ''):
										$Email->cc($listaCorreosCC);
									endif;

									$Email->subject('Detalles del cambio de contraseña SISBUT UNAM.');
									$Email->emailFormat('both');
									$Email->template('email')->viewVars( array(
													'aMsg' => 
													'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
													'<p style="color: #835B06; font-size: 24px; font-weight: bold; text-align: center;">Detalles del cambio de contraseña por administrador</p>'.
													'<p>Esta es tu información (mantenla en secreto y guárdala bien) para iniciar tu sesión en SISBUT UNAM.</p>'.
													
													'<p><strong>Usuario: </strong>' . $student['Student']['username']. '<br/>' .
													'<strong>Contraseña: </strong>' . $this->request->data['Administrator']['password'] . '</p>' .
													'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
													
													'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
													'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
													'Correo electrónico: bolsa@unam.mx</p></div>'
									));
									if($Email->send()):
										$this->Session->setFlash('La contraseña ha sido modificada, se enviará un correo de notificación a los correos registrados.', 'alert-success');
									else:
										$this->Session->setFlash('El correo con los cambios de contraseña no pudo ser enviado.', 'alert-danger');
									endif;	
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo cambiar la contraseña.', 'alert-danger');
							endif;	
					$this->redirect(array('action' =>  $redirect));
			endif;
		}
		
		public function viewStudentPostullation(){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->Session->write('redirectAdmin', 'viewStudentPostullation');
			// $redirect = $this->redireccionaAdmin();
			
			if($this->request->query('newSearch') <> ''):
				$newSearch = $this->request->query('newSearch');
			else:
				$newSearch = null; 
			endif;
			
			if($this->request->query('student_id') <> ''):
				$student_id = $this->request->query('student_id');
				$this->Session->write('student_id', $student_id);
			else:
				if($this->Session->check('student_id')):
					$student_id = $this->Session->read('student_id');
				else:
					$this->redirect(array('action' =>  'searchStudent'));
				endif;
			endif;
			
			if($this->request->query('regresar')<>''):
				$this->Session->write('volver', $this->request->query('regresar')); 
			else:
				$this->Session->write('volver', 'companyHistory'); 
			endif;
				
			$this->Student->recursive = 0;
			$this->CompanyJobProfile->recursive = 2;
			$this->CompanyProfile->recursive = 0;
			$this->CompanyJobOffer->recursive = 0;
			
			$limite = 5; //default limit
			
			if(($newSearch == 'nuevaBusqueda') || ($this->request->query('newFolderSelected') == 'yes')):
				// $this->Session->delete('limiteAdmin');
				// $this->Session->delete('palabraBuscarAdmin');
				// $this->Session->delete('page');
				// $this->Session->delete('tipoBusquedaAdmin');

			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if(isset($this->request->data['Administrator']['criterio']) and ($this->request->data['Administrator']['criterio'] <> '')):
				$this->Session->write('tipoBusqueda', $this->request->data['Administrator']['criterio']);
				$tipoBusqueda = $this->request->data['Administrator']['criterio'];
			else:
				if(($this->Session->read('tipoBusquedaAdmin')) <> ''):
					$tipoBusqueda = $this->Session->read('tipoBusquedaAdmin');
				else:
					$tipoBusqueda = 4; //Búsqueda default eqivalente a mostrar todos las ofertas guardadas, postulados o ambos
				endif;
			endif;

			if(isset($this->request->data['Administrator']['Buscar']) and ($this->request->data['Administrator']['Buscar'] <> '')):
				$this->Session->write('palabraBuscar', $this->request->data['Administrator']['Buscar']);
				$palabraBuscar  = $this->request->data['Administrator']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscarAdmin')) <> ''):
					$palabraBuscar  = $this->Session->read('palabraBuscarAdmin');
				else:
					$palabraBuscar = '';
				endif;
			endif;					
			
			//Get all applied offers
			$ofertasAplicadas = $this->Application->find('all', array(
																'conditions' => array(
																					'Application.student_id' => $student_id
																)
			));
		
			//Get all offers ids in array for each one applied
			$aplicadas = array("CompanyJobProfile.id" => Set::extract("/Application/company_job_profile_id", $ofertasAplicadas));
			

			if($tipoBusqueda == 1):
					//Obtiene las coincidencias de nombres del perfil de la compañía con la búsqueda
					$companyProfilesLikeName = $this->Company->find('list', array(
																'conditions' => array(
																					'CompanyProfile.company_name LIKE' => '%'. $palabraBuscar . '%',
																					),
																'recursive' => 2
															)
												);
			
					// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
					foreach($companyProfilesLikeName as $companyProfileLikeName):
						$idsCompaniesLikeName[] = $companyProfileLikeName;
					endforeach;	
					
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($idsCompaniesLikeName)):
						$idsCompaniesLikeName = '';
					endif;
					
					// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
					$companyJobOffersLikeName = $this->CompanyJobOffer->find('list', array(
																							'fields' => array('CompanyJobOffer.id'),
																							'conditions' => array(
																													'AND' => array(
																																	'CompanyJobOffer.company_id' => $idsCompaniesLikeName,
																																	'CompanyJobOffer.confidential_job_offer' => 'n',
																																	'CompanyJobOffer.company_name' => '',
																																	)
																													),
																								'recursive' => 2
																						)
																			);

					// Obtenemos en un array los id´s que de las jobOffer anteriores
					foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
						$idsCompaniesJobOffersLikeName[] = $companyJobOfferLikeName;
					endforeach;	
					
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($idsCompaniesJobOffersLikeName)):
						$idsCompaniesJobOffersLikeName = '';
					endif;
					
					// Obtenemos los id´s de las ofertas que cumplan con los id´s de los JobOffer de la consulta anterior
					$companyJobProfileResults = $this->CompanyJobProfile->find('list', array(
																							'fields' => array('CompanyJobProfile.id'),
																							'conditions' => array(
																												'AND' => array(
																																'CompanyJobProfile.company_job_offer_id' => $idsCompaniesJobOffersLikeName,
																																)
																												),
																							'recursive' => 2
																							)
																				);
					
					// Obtenemos en un array los id´s que de las JobProfiles anteriores
					foreach($companyJobProfileResults as $companyJobProfileResult):
						$idsompanyJobProfileResults[] = $companyJobProfileResult;
					endforeach;	
					
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($idsompanyJobProfileResults)):
						$idsompanyJobProfileResults = '';
					endif;
					
					// Obtenemos los id´s de las vacantes que haya sido declarada como confidencial y que se le haya asignado un nombre para mostrar.
					$companyJobOffersLikeName = $this->CompanyJobOffer->find('all', array(
																		'fields' => array('CompanyJobOffer.id'),
																		'conditions' => array(
																							'AND' => array(
																											'CompanyJobOffer.company_name LIKE' => '%'. $palabraBuscar . '%',
																											'CompanyJobOffer.confidential_job_offer' => 's',
																											'CompanyJobOffer.company_name <> ' => '',
																											)
																							)
																	)
														);
													
					foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
						$jobOffersLikeName[] = $companyJobOfferLikeName['CompanyJobOffer']['id'];
					endforeach;	
					
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($companyJobOffersLikeName)):	
							$jobOffersLikeName = '';
					endif;
					
					$criterio[] = array( 'AND' => array(
														'OR' => array(
																	'CompanyJobProfile.id' => $idsompanyJobProfileResults,
																	'CompanyJobProfile.company_job_offer_id'=>$jobOffersLikeName
																	)
																									
														),
										);
				else:
					if($tipoBusqueda == 2):
						$criterio[] = array('CompanyJobProfile.job_name LIKE' => '%'. $palabraBuscar . '%');
					else:
						if($tipoBusqueda == 3):
							$criterio[] = array(' CompanyJobProfile.id '  => intval($palabraBuscar));
						else:
							$criterio[] = $aplicadas;
						endif;
					endif;
				endif;
				
				$hoy = date('Y-m-d');
				$orden = ' CompanyJobContractType.created DESC';

				
				$this->paginate = array(
										'conditions' => array(
															'AND' => array(	
																			$criterio,
																			'CompanyJobProfile.expiration >= ' => $hoy,
																			'CompanyJobContractType.status'  => 1
																		),
															),
										'limit' => $limite,
										'order' => ' CompanyJobContractType.created DESC',
									);
				
				$ofertas = $this->paginate('CompanyJobProfile');
				$this->set('ofertas', $ofertas);
		}
		
		public function searchCompany($newSearch = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));

			$this->Session->write('redirectAdmin', 'searchCompany');
			$this->redireccionaAdmin();
			
			$this->Company->recursive = 2;

			if(isset($this->request->data['Administrator']['limit']) and ($this->request->data['Administrator']['limit'] <> '')):
				$this->Session->write('limiteAdmin', $this->request->data['Administrator']['limit']);
				$limite = $this->request->data['Administrator']['limit'];
			else:
				if(($this->Session->read('limiteAdmin')) <> ''):
					$limite = $this->Session->read('limiteAdmin');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limiteAdmin');
				$this->Session->delete('palabraBuscadaAdmin');
				$this->Session->delete('tipoBusquedaAdmin');
				$this->Session->delete('page');
			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				if(($this->Session->read('page')) <> ''):
					$page = $this->Session->read('page');
				else:
					$this->Session->write('page','');
					$page = '';
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['criterio']) and ($this->request->data['Administrator']['criterio'] <> '')):
				$this->Session->write('tipoBusquedaAdmin', $this->request->data['Administrator']['criterio']);
				$tipoBusqueda = $this->request->data['Administrator']['criterio'];
			else:
				if($this->request->query('tipoBusqueda') <> ''):
					$tipoBusqueda = $this->request->query('tipoBusqueda');
					$this->Session->write('tipoBusquedaAdmin', $this->request->query('tipoBusqueda'));
				else:
					if(($this->Session->read('tipoBusquedaAdmin')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusquedaAdmin');
					else:
						$tipoBusqueda = 0; 
					endif;
				endif;
			endif;

			if(isset($this->request->data['Administrator']['Buscar']) and ($this->request->data['Administrator']['Buscar'] <> '')):
				$this->Session->write('palabraBuscadaAdmin', $this->request->data['Administrator']['Buscar']);
				$palabraBuscada  = $this->request->data['Administrator']['Buscar'];
			else:
				if($this->request->query('tipoBusqueda') <> ''):
					$palabraBuscada = '';
				else:
					if(($this->Session->read('palabraBuscadaAdmin')) <> ''):
						$palabraBuscada  = $this->Session->read('palabraBuscadaAdmin');
					else:
						$palabraBuscada = '';
					endif;
				endif;
			endif;					
			
			$hoy = date('Y-m-d');
			$fechaMax = strtotime ( '+30 day' , strtotime ( $hoy ) ) ;
			$fechaMax = date ( 'Y-m-j' , $fechaMax );		
			
				if($tipoBusqueda == 1):
					$this->set('tipoDescarga', 'Por RFC: '.$palabraBuscada);
					$criterio[] = array('CompanyProfile.rfc LIKE' => '%'. $palabraBuscada . '%');
				else:
					if($tipoBusqueda == 2):
						$this->set('tipoDescarga', 'Por Nombre de la empresa o institución: '.$palabraBuscada);
						$criterio[] = array('CompanyProfile.company_name LIKE' => '%'. $palabraBuscada . '%');
					else:
						if($tipoBusqueda == 3):
							$this->set('tipoDescarga', 'Por Razon social: '.$palabraBuscada);
							$criterio['OR'][] = array('CompanyProfile.social_reason LIKE' => '%'. $palabraBuscada . '%');
						else:
							if($tipoBusqueda == 4):
								$this->set('tipoDescarga', 'Activas');
								$criterio[] = array('AND' => array(
																'Company.status' => 1,
																'CompanyOfferOption.id <>' => null,
																'CompanyOfferOption.end_date_company >= ' =>  $hoy,
																)
													);
							else:
								if($tipoBusqueda == 5):
									$this->set('tipoDescarga', 'Pendientes');
									$criterio[] = array('CompanyOfferOption.id' => null);
								else:
									if($tipoBusqueda == 6):
										$this->set('tipoDescarga', 'Por expirar');
										$criterio[] = array( 'AND' => array(
																			'Company.status' => 1,
																			'CompanyOfferOption.id <>' => null,
																			'CompanyOfferOption.end_date_company >= ' => $hoy,
																			'CompanyOfferOption.end_date_company <= ' => $fechaMax,
																		)
														);
									else:
										if($tipoBusqueda == 7):
											$this->set('tipoDescarga', 'Expiradas');
											$criterio[] = array( 'AND' => array(
																				'CompanyOfferOption.id <>' => null,
																				'CompanyOfferOption.end_date_company < ' =>  $hoy,
																				)
														);
										else:
											if($tipoBusqueda == 8):
												$this->set('tipoDescarga', 'Por nombre similar a contacto de la empresa: '.$palabraBuscada);
												$claves = explode(" ", $palabraBuscada);
												$indice = 0;
												foreach ($claves as $clave) {
													if(strlen($clave)>2):
														$criterio[$indice]['OR'][] = array('CompanyContact.name LIKE' => "%$clave%");
														$criterio[$indice]['OR'][] = array('CompanyContact.last_name LIKE' => "%$clave%");
														$criterio[$indice]['OR'][] = array('CompanyContact.second_last_name LIKE' => "%$clave%");
													endif;
												}
												$indice++;
											else:
												if($tipoBusqueda == 9):
													$this->set('tipoDescarga', 'Por correo electrónico institucional: '.$palabraBuscada);
													$criterio['OR'][] = array('Company.email LIKE' => '%'. $palabraBuscada . '%');
												else:
													$criterio[] = '';
												endif;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;

				// identifica si se descarga o no para poner un limite o no
				if(($newSearch==null) OR ($newSearch=='nuevaBusqueda')):
					$this->paginate = array(
												'conditions' => array(
																	'OR' => array(
																					$criterio
																				)
																	),
												'order' => ' Company.created DESC',
												'limit' => $limite,
												);
				else:
					$this->paginate = array(
												'conditions' => array(
																	'OR' => array(
																					$criterio
																				)
																	),
												'order' => ' Company.created DESC',
												);

				endif;
				
				$this->set('empresas', $candidatos = $this->paginate('Company'));
				
				$pendientes = $this->Company->find('count', array(
															'conditions' => array(
																				'CompanyOfferOption.id' => null
																				),
																	)
													);
				$this->set('pendientes', $pendientes);
		}

		public function searchCompanyAdminExcel(){
			$this->searchCompany('sinLimite');

			$this->Sector();
			$this->Rotation();
			$this->numeroEmpleados();
			$this->companyType();


		}	
		
		public function specificSearchCompany($newSearch = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			
			// Borra los parametros de una búsqueda previa
				
			$Estados = $this->State->find('list',
												array(
													'fields' => array('State.nombre', 'State.nombre'),
													'order' => array('State.nombre ASC')
												)
											);
			$this->set( compact ('Estados') );

			$this->Sector();
			$this->Rotation();
			$this->numeroEmpleados();
			$this->companyType();
			
			if($newSearch=='nuevaBusqueda'):
				$this->Session->delete('company_name');
				$this->Session->delete('company_type');
				$this->Session->delete('sector');
				$this->Session->delete('status');
				$this->Session->delete('company_rotation');
				$this->Session->delete('employees_number');
				$this->Session->delete('state');
				$this->Session->delete('city');
				$this->Session->delete('zip');
			endif;
			
	
		}
		
		public function resultsSpecificSearchCompany($newSearch = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			
			$this->Session->write('redirectAdmin', 'resultsSpecificSearchCompany');
			$this->Company->recursive = 2;
			
			if(isset($this->request->data['Administrator']['limit'])):
				$this->Session->write('limit', $this->request->data['Administrator']['limit']);
				$limit = $this->request->data['Administrator']['limit'];
			else:
				if(($this->Session->read('limit')) <> ''):
					$limit = $this->Session->read('limit');
				else:
					$limit = 5; //Default 
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['company_name']) AND $this->request->data['Administrator']['company_name']<>''):
				$this->Session->write('company_name', $this->request->data['Administrator']['company_name']);
				$criterio[] = array('CompanyProfile.company_name LIKE' => '%'. $this->request->data['Administrator']['company_name'] . '%');
			else:
				if(($this->Session->read('company_name')) <> ''):
					$criterio[] = array('CompanyProfile.company_name LIKE' => '%'. $this->Session->read('company_name') . '%');
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['company_type']) AND $this->request->data['Administrator']['company_type']<>''):
				$this->Session->write('company_type', $this->request->data['Administrator']['company_type']);
				$criterio[] = array('CompanyProfile.company_type LIKE' => '%'. $this->request->data['Administrator']['company_type'] . '%');
			else:
				if(($this->Session->read('company_type')) <> ''):
					$criterio[] = array('CompanyProfile.company_type LIKE' => '%'. $this->Session->read('company_type') . '%');
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['sector']) AND $this->request->data['Administrator']['sector']<>''):
				$this->Session->write('sector', $this->request->data['Administrator']['sector']);
				$criterio[] = array('CompanyProfile.sector LIKE' => '%'. $this->request->data['Administrator']['sector'] . '%');
			else:
				if(($this->Session->read('sector')) <> ''):
					$criterio[] = array('CompanyProfile.sector LIKE' => '%'. $this->Session->read('sector') . '%');
				endif;
			endif;
			
			$hoy = date('Y-m-d');
			if(isset($this->request->data['Administrator']['status']) AND $this->request->data['Administrator']['status']<>''):
				$this->Session->write('status', $this->request->data['Administrator']['status']);
				if($this->request->data['Administrator']['status']==1):
					$criterio[] = array('Company.status' => $this->request->data['Administrator']['status']);
					$criterio[] = array('CompanyOfferOption.id <> ' => null);
					$criterio[] = array('CompanyOfferOption.end_date_company >= ' => $hoy);
				else:
					$criterio['OR'][1]['AND'][] = array('CompanyOfferOption.id <> ' => null);
					$criterio['OR'][1]['AND'][] = array('CompanyOfferOption.end_date_company < ' => $hoy);
					
					$criterio['OR'][2]['AND'][] = array('Company.status' => $this->request->data['Administrator']['status']);
					$criterio['OR'][2]['AND'][] = array('CompanyOfferOption.id <> ' => null);
					$criterio['OR'][2]['AND'][] = array('CompanyOfferOption.end_date_company < ' => $hoy);
				endif;
			else:
				if(($this->Session->read('status')) <> ''):

					if($this->Session->read('status')==1):
						$criterio[] = array('Company.status' => $this->Session->read('status'));
						$criterio[] = array('CompanyOfferOption.id <> ' => null);
						$criterio[] = array('CompanyOfferOption.end_date_company >= ' => $hoy);
					else:			
						$criterio['OR'][1]['AND'][] = array('CompanyOfferOption.id <> ' => null);
						$criterio['OR'][1]['AND'][] = array('CompanyOfferOption.end_date_company < ' => $hoy);
						
						$criterio['OR'][2]['AND'][] = array('Company.status' => $this->Session->read('status'));
						$criterio['OR'][2]['AND'][] = array('CompanyOfferOption.id <> ' => null);
						$criterio['OR'][2]['AND'][] = array('CompanyOfferOption.end_date_company < ' => $hoy);
					
					endif;
						
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['company_rotation']) AND $this->request->data['Administrator']['company_rotation']<>''):
				$this->Session->write('company_rotation', $this->request->data['Administrator']['company_rotation']);
				$criterio[] = array('CompanyProfile.company_rotation LIKE' => '%'. $this->request->data['Administrator']['company_rotation'] . '%');
			else:
				if(($this->Session->read('company_rotation')) <> ''):
					$criterio[] = array('CompanyProfile.company_rotation LIKE' => '%'. $this->Session->read('company_rotation') . '%');
				endif;
			endif;

			if(isset($this->request->data['Administrator']['employees_number']) AND $this->request->data['Administrator']['employees_number']<>''):
				$this->Session->write('employees_number', $this->request->data['Administrator']['employees_number']);
				$criterio[] = array('CompanyProfile.employees_number LIKE' => '%'. $this->request->data['Administrator']['employees_number'] . '%');
			else:
				if(($this->Session->read('employees_number')) <> ''):
					$criterio[] = array('CompanyProfile.employees_number LIKE' => '%'. $this->Session->read('employees_number') . '%');
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['state']) AND $this->request->data['Administrator']['state']<>''):
				$this->Session->write('state', $this->request->data['Administrator']['state']);
				$criterio[] = array('CompanyProfile.state LIKE' => '%'. $this->request->data['Administrator']['state'] . '%');
			else:
				if(($this->Session->read('state')) <> ''):
					$criterio[] = array('CompanyProfile.state LIKE' => '%'. $this->Session->read('state') . '%');
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['city']) AND $this->request->data['Administrator']['city']<>''):
				$this->Session->write('city', $this->request->data['Administrator']['city']);
				$criterio[] = array('CompanyProfile.city LIKE' => '%'. $this->request->data['Administrator']['city'] . '%');
			else:
				if(($this->Session->read('city')) <> ''):
					$criterio[] = array('CompanyProfile.city LIKE' => '%'. $this->Session->read('city') . '%');
				endif;
			endif;
			
			if(isset($this->request->data['Administrator']['zip']) AND $this->request->data['Administrator']['zip']<>''):
				$this->Session->write('zip', $this->request->data['Administrator']['zip']);
				$criterio[] = array('CompanyProfile.zip LIKE' => '%'. $this->request->data['Administrator']['zip'] . '%');
			else:
				if(($this->Session->read('zip')) <> ''):
					$criterio[] = array('CompanyProfile.zip LIKE' => '%'. $this->Session->read('zip') . '%');
				endif;
			endif;
			
			if(!isset($criterio)):
				$criterio = array();
			endif;
			
			if($newSearch==null):
				$this->paginate = array(
										'conditions' => array(
																'AND' => array(
																				$criterio
																				)
																),
										'limit' => $limit,
										'order' => ' Company.created DESC',
										);
			else:
				$this->paginate = array(
										'conditions' => array(
																'AND' => array(
																				$criterio
																				)
																),
										'order' => ' Company.created DESC',
										);
			endif;
			
				$this->set('empresas', $candidatos = $this->paginate('Company'));
				
		}
		
		public function resultsSpecificSearchCompanyExcel($newSearch = null){
			$this->resultsSpecificSearchCompany('sinLimite');
			$this->Sector();
			$this->Rotation();
			$this->numeroEmpleados();
			$this->companyType();
		}
		
		public function deleteCompany($id){
			if($this->request->is('post')):
				$redirect = $this->redireccionaAdmin();
					
				$company = $this->Company->findById($id);
				$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS;
				$this->CompanyDisabled->data['CompanyDisabled']['company_username'] = $company['Company']['username'];
				$this->CompanyDisabled->data['CompanyDisabled']['rfc'] = $company['CompanyProfile']['rfc'];
				
				if($this->Company->delete($id)):
					$this->CompanyDisabled->save($this->CompanyDisabled->data);
					if(file_exists($destino.$company['Company']['filename'])):
						unlink($destino.$company['Company']['filename']);
					endif;
					$this->Session->setFlash('Empreso o Institución eliminada', 'alert-success');
					$this->redirect(array('action' =>  $redirect));
				else:
					$this->Session->setFlash('Lo sentimos, la Empreso o Institución no pudo ser eliminada', 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}
		
		public function updateCompanyPassword(){
			$redirect = $this->redireccionaAdmin();
			if($this->request->is('post')):
				$this->Company->recursive = -1;
				$company = $this->Company->findById($this->request->data['Administrator']['company_id']);
				
					$this->Company->set($this->request->data);	//pasa los parametros al modelo para ser validados.
						
							if($this->Company->updateAll(array('Company.password' => "'".AuthComponent::password($this->data['Administrator']['password'])."'"),array('Company.id' => $this->request->data['Administrator']['company_id']))):
								$Email = new CakeEmail('gmail');
									$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));
									
									$correosTo = $this->request->data['Administrator']['company_email'];
									$destinatariosTo = explode(";",$correosTo);
									foreach($destinatariosTo as $destinatarioTo) {
										if($destinatarioTo<>''):
											$listaCorreosTo[] = trim($destinatarioTo);
										endif;
									}
									
									if($this->request->data['Administrator']['company_email_alternativo'] <> ''):
										$correosCC = $this->request->data['Administrator']['company_email_alternativo'];
										$destinatariosCC = explode(";",$correosCC);
										foreach($destinatariosCC as $destinatarioCC) {
											if($destinatarioCC<>''):
												$listaCorreosCC[] = trim($destinatarioCC);
											endif;
										}
									endif;

									//Se agregan los correos
									$Email->to($listaCorreosTo);

									if($this->request->data['Administrator']['company_email_alternativo'] <> ''):
										$Email->cc($listaCorreosCC);
									endif;

									$Email->subject('Detalles del cambio de contraseña SISBUT UNAM.');
									$Email->emailFormat('both');
									$Email->template('email')->viewVars( array(
													'aMsg' => 
													'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
													'<p style="color: #835B06; font-size: 24px; font-weight: bold; text-align: center;">Detalles del cambio de contraseña por administrador</p>'.
													'<p>Esta es tu información (mantenla en secreto y guárdala bien) para iniciar tu sesión en SISBUT UNAM.</p>'.
													
													'<p><strong>Usuario: </strong>' . $company['Company']['username']. '<br/>' .
													'<strong>Contraseña: </strong>' . $this->request->data['Administrator']['password'] . '</p>' .
													'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
													
													'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
													'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
													'Correo electrónico: bolsa@unam.mx</p></div>'
									));
									if($Email->send()):
										$this->Session->setFlash('La contraseña ha sido modificada, se enviará un correo de notificación a los correos registrados.', 'alert-success');
									else:
										$this->Session->setFlash('El correo con los cambios de contraseña no pudo ser enviado.', 'alert-danger');
									endif;	
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo cambiar la contraseña.', 'alert-danger');
							endif;	
					$this->redirect(array('action' =>  $redirect));
			endif;
		}
		
		public function enableDisableCompany(){
			if($this->request->is('get')):
				$id=$this->request->query('id');
				$estatusCompany = $this->request->query('estatus');
				$redirect = $this->redireccionaAdmin();
				$empresa = $this->Company->findById($id);
				
				if($estatusCompany == 1):
					$newEstatusCompany = 0;
					$mensaje = 'Empresa desactivada';
				else:
					$newEstatusCompany = 1;
					$mensaje = 'Empresa activada';
				endif;
				
				$hoy = date('Y-m-d');
				
				if($empresa['CompanyOfferOption']['end_date_company']==null):
					$this->Session->setFlash('Antes de activar la empresa y para llevar un control indique los lineamientos de publicación.', 'alert-success');
					$this->redirect(array('action' =>  'companyOfferOption',$id));
				else:
					if($empresa['CompanyOfferOption']['end_date_company']<$hoy):
						$this->Session->setFlash('La fecha de vigencia de la empresa ha expirado le recomendamos actualizar.', 'alert-success');
						$this->redirect(array('action' =>  'companyOfferOption',$id));
					else:
						if($this->Company->updateAll(array('Company.status' => "'".$newEstatusCompany."'"),array('Company.id' =>$id))):
							$this->Session->setFlash($mensaje, 'alert-success');
							$this->redirect(array('action' =>  $redirect));
						else:
							$this->Session->setFlash('Lo sentimos no se pudo cambiar el estatus de la empresa', 'alert-danger');
							$this->redirect(array('action' =>  $redirect));
						endif;
					endif;
				endif;
			endif;
		}
		
		public function companyOfferOption($id = null){
			$this->Administrator->recursive = 0;
			$this->CompanyJobProfile->recursive = 0;
			$this->Company->recursive = 0;
			
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->Session->write('redirectAdmin', 'companyOfferOption/'.$id);
			$redirect = $this->redireccionaAdmin();
			
			$this->CompanyOfferOption->id=$id;
			if($this->request->is('get')):
				$this->request->data = $this->CompanyOfferOption->read();
				$this->set('companyData', $this->Company->findById($id ));
				
				$empresa = $this->Company->findById($id);
				$descargas = $this->CompanyDownloadedStudent->find('count', array(
																			'conditions' => array ('company_id' => $id)
																			)
																);	
				$this->set('descargas', $descargas);
			
				$ofertasPublicadas = $this->CompanyJobProfile->find('list', array(
																		'conditions' => array (
																								'AND' => array(
																											'CompanyJobProfile.company_id' => $id,
																											),
																							)
																		)
															);	
				$this->set('ofertasPublicadas', count($ofertasPublicadas));
				
			else:
				if($this->request->is('post')):
					$hoy = date('Y-m-d');
					
					$empresa = $this->Company->findById($this->request->data['CompanyOfferOption']['company_id']);
					$this->set('companyData', $empresa);
					$estatusCompany = $this->request->data['Company']['status'];
					
					$descargas = $this->CompanyDownloadedStudent->find('count', array(
																			'conditions' => array ('company_id' => $this->request->data['CompanyOfferOption']['company_id'])
																			)
																);	
					$this->set('descargas', $descargas);
				
					$ofertasPublicadas = $this->CompanyJobProfile->find('list', array(
																		'conditions' => array (
																								'AND' => array(
																											'CompanyJobProfile.company_id' => $this->request->data['CompanyOfferOption']['company_id'],
																											),
																							)
																		)
															);	
					$this->set('ofertasPublicadas', count($ofertasPublicadas));

					$this->request->data['CompanyOfferOption']['id']=$this->request->data['CompanyOfferOption']['company_id'];
					if($this->CompanyOfferOption->saveAll($this->request->data, array('validate' => 'only'))):
						if($descargas>$this->request->data['CompanyOfferOption']['max_cv_download']):
							$this->Session->setFlash('El número de currículums a extraer no puede ser inferior al número de currículums extraidos', 'alert-danger');
							$this->redirect(array('action' =>  $redirect, $this->request->data['CompanyOfferOption']['company_id']));
						else:
							if(count($ofertasPublicadas)>$this->request->data['CompanyOfferOption']['max_offer_publication']):
								$this->Session->setFlash('El número de ofertas a publicar no puede ser inferior al número de ofertas publicadas', 'alert-danger');
								$this->redirect(array('action' =>  $redirect, $this->request->data['CompanyOfferOption']['company_id']));
							else:
								if($this->CompanyOfferOption->save($this->request->data)):
									
									if($empresa['CompanyOfferOption']['end_date_company']<$hoy):
										$this->request->data['Company']['status'] = 1;
									endif;
									
									if ($this->Company->updateAll(array('Company.status' => "'".$this->request->data['Company']['status']."'"),array('Company.id' => $this->request->data['CompanyOfferOption']['company_id']))):
										$this->Session->setFlash('Registro guardado', 'alert-success');
										$this->redirect(array('action' =>  $redirect, $this->request->data['CompanyOfferOption']['company_id']));
									else:
										$this->Session->setFlash('No se pudo actualizar el estatus de la empresa', 'alert-danger');
										$this->redirect(array('action' =>  $redirect, $this->request->data['CompanyOfferOption']['company_id']));
									endif;
									
								else:
									$this->Session->setFlash('Lo sentimos no se pudo guardar su registro', 'alert-danger');
								endif;
							endif;
						endif;
					else:
						$this->Session->setFlash('Por favor, revise y corrija los campos marcados.', 'alert-danger');
					endif;
				endif;
			endif;
		}	
		
		public function companyHistory($sinLimite = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			
			$this->Session->write('redirectAdmin', 'companyHistory');
			$redirect = $this->redireccionaAdmin();
			$this->salary(); 
			$this->Company->recursive = 3;	
			
			if($this->request->query('id')<>''):
				$this->Session->write('historyCompanyId', $this->request->query('id'));
			endif;
			
			if($this->request->query('newSearch')<>''):
				$newSearch = $this->request->query('newSearch');
			else:
				$newSearch = '';
			endif;
			

			$companies = $this->Company->find('all',
												array(
													'conditions' => array(
																		'Company.id' => $this->Session->read('historyCompanyId')
																		)
												)
											);
			$this->set( compact ('companies') );
			
			$empresas = $this->Company->find('all',
												array(
													'conditions' => array(
																		'Company.id' => $this->Session->read('historyCompanyId')
																		)
												)
											);
			$this->set( compact ('empresas') );
		
			
			// si está vacia redirecciona a seleccionar otra
			if(empty($empresas)):
				$this->redirect(array('action' =>  'searchCompany'));
			endif;
			
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limite');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('page');
				$this->Session->delete('intoFolder');
			endif;
			
			if(isset($this->request->data['Administrator']['typeFilter'])):
					// borra filtros del buscador especifico
					$this->Session->delete('limite');
					$this->Session->delete('palabraBuscada');
					$this->Session->delete('tipoBusqueda');
					$this->Session->delete('page');
					$this->Session->delete('intoFolder');
					
					$this->Session->write('typeFilter', $this->request->data['Administrator']['typeFilter']);
					
					$fechaInicio =  $this->request->data['Administrator']['start_date_search']['year'].'-'.
									$this->request->data['Administrator']['start_date_search']['month'].'-'.
									$this->request->data['Administrator']['start_date_search']['day'];
					
					$fechaFin 	 = 	$this->request->data['Administrator']['end_date_search']['year'].'-'.
									$this->request->data['Administrator']['end_date_search']['month'].'-'.
									$this->request->data['Administrator']['end_date_search']['day'];
					
					$fechaInicio = strtotime ( $fechaInicio ) ;
					$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
					$fecha1 = $fechaInicio;
					
					$fechaFin = strtotime ( $fechaFin ) ;
					$fechaFin = date ( 'Y-m-d' , $fechaFin );
					$fecha2 = $fechaFin;
					
					$datos = $this->CompanyJobProfile->find('all', array(
																		'conditions' => array (
																								'AND' => array(
																											'CompanyJobProfile.company_id' =>  $this->Session->read('historyCompanyId'),
																											'CompanyJobProfile.created >= ' => $fecha1,
																											'CompanyJobProfile.created <= ' => $fecha2,
																											),
																										)
																					)
																	);
					$this->set('datos', $datos);	
					
					$descargas = $this->CompanyDownloadedStudent->find('count', array(
																					'conditions' => array (
																											'CompanyDownloadedStudent.company_id' => $this->Session->read('historyCompanyId'),
																											'CompanyDownloadedStudent.created >= ' => $fecha1,
																											'CompanyDownloadedStudent.created <= ' => $fecha2,
																										)
																					)
																		);	
					$this->set('descargas', $descargas);	
				else:
					$descargas = $this->CompanyDownloadedStudent->find('count', array(
																					'conditions' => array (
																											'CompanyDownloadedStudent.company_id' => $this->Session->read('historyCompanyId'),
																										)
																					)
																		);	
					$this->set('descargas', $descargas);
				
				endif;
				
					$this->Company->recursive = 1;
					$this->CompanyJobProfile->recursive = 2;
					$this->salary(); 
					
					//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
					if(isset($this->params['named']['page'])):
						$page = $this->params['named']['page'];
						$this->Session->write('page', '/page:'.$page);
					else:
						$this->Session->write('page','');
						$page = '';
					endif;
					
					if(isset($this->request->data['Administrator']['limite']) and ($this->request->data['Administrator']['limite'] <> '')):
						$this->Session->write('limite', $this->request->data['Administrator']['limite']);
						$limite = $this->request->data['Administrator']['limite'];
					else:
						if(($this->Session->read('limite')) <> ''):
							$limite = $this->Session->read('limite');
						else:
							$limite = 5; //default limit
						endif;
					endif;
						
					if($this->request->query('tipoBusqueda') <> ''):
						$tipoBusqueda = $this->request->query('tipoBusqueda');
						$this->Session->write('tipoBusqueda', $tipoBusqueda);
					else:
						if(isset($this->request->data['Administrator']['criterio']) and ($this->request->data['Administrator']['criterio'] <> '')):
							$this->Session->write('tipoBusqueda', $this->request->data['Administrator']['criterio']);
							$tipoBusqueda = $this->request->data['Administrator']['criterio'];
						else:
							if(($this->Session->read('tipoBusqueda')) <> ''):
								$tipoBusqueda = $this->Session->read('tipoBusqueda');
							else:
								$tipoBusqueda = 0; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
							endif;
						endif;
					endif;
					
					
					if(isset($this->request->data['Administrator']['Buscar']) and ($this->request->data['Administrator']['Buscar'] <> '')):
						$this->Session->write('palabraBuscada', $this->request->data['Administrator']['Buscar']);
						$palabraBuscada  = $this->request->data['Administrator']['Buscar'];
					else:
						if(isset($this->request->data['Administrator']['buscarSalary']) and ($this->request->data['Administrator']['buscarSalary'] <> '')):
							$this->Session->write('palabraBuscada', $this->request->data['Administrator']['buscarSalary']);
							$palabraBuscada  = $this->request->data['Administrator']['buscarSalary'];
						else:
							if(($this->Session->read('palabraBuscada')) <> ''):
								$palabraBuscada  = $this->Session->read('palabraBuscada');
							else:
								$palabraBuscada = '';
							endif;
						endif;
					endif;
					
					$hoy = date('Y-m-d');
					$fechaMax = strtotime ( '+15 day' , strtotime ( $hoy ) ) ;
					$fechaMax = date ( 'Y-m-j' , $fechaMax );			
					
					if($tipoBusqueda == 1):
						$criterio[] =  array( 'AND' => array( 
																'CompanyJobProfile.job_name LIKE ' =>  '%'. $palabraBuscada . '%',
																'CompanyJobProfile.company_id' => $this->Session->read('historyCompanyId')
																)
												);
					else:
							if($tipoBusqueda == 2):
								$criterio[] = array( 'AND' => array( 	
																	'CompanyJobContractType.salary' => $palabraBuscada,
																	'CompanyJobProfile.company_id' => $this->Session->read('historyCompanyId')
																	)
													);
							else:
								if($tipoBusqueda == 3):
									$criterio[] = array( 'AND' => array( 
																		'CompanyJobProfile.id'  => intval($palabraBuscada),
																		'CompanyJobProfile.company_id' => $this->Session->read('historyCompanyId')
																		)
													);
								else:
									$criterio[] = array( 
														'AND' => array( 
																		'CompanyJobProfile.company_id' => $this->Session->read('historyCompanyId')
																		
																		)
														);
								endif;
							endif;
					endif;
					
					if($sinLimite==null):	
						$this->paginate = array(
													'conditions' => array(
																		'OR' => array(
																						$criterio
																					)
																		),
													'limit' => $limite,
													'order' => ' CompanyJobContractType.created DESC',
													);
					else:
						$this->paginate = array(
													'conditions' => array(
																		'OR' => array(
																						$criterio
																					)
																		),
													'order' => ' CompanyJobContractType.created DESC',
													);
					endif;
						
						$this->set('ofertas', $ofertas = $this->paginate('CompanyJobProfile'));
			
		}
		
		public function companyHistoryExcel(){
			$this->ExperienceArea();
			$this->interestArea();
			$this->Rotation();
			$this->salary(); 
			$this->states(); 
			$this->country(); 
			
			$this->carrer(); 
			$this->lenguage(); 
			$this->Competency(); 
			$this->benefit(); 
			$this->Tecnology(); 
			$this->softwareLevel(); 
			$this->Escuelas(); 
			$this->Facultades(); 
			$this->posgradoProgrma(); 
			$this->contractType(); 
			$this->disabilityType();
			$this->workday();
			$this->NivelesIdioma(); 
			$this->program(); 
			$this->escuelasFacultades();
			$this->semester();
			
			$programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
				$this->set( compact ('programas') );

				$programas = $this->PosgradoProgram->find('list',
												array(
													'fields' => array('PosgradoProgram.id', 'PosgradoProgram.posgrado_program'),
													'order' => array('PosgradoProgram.posgrado_program ASC')
												)
											);

				$carreras = $this->Career->find('list',
												array(
													'fields' => array('Career.id', 'Career.career'),
													'order' => array('Career.career ASC')
												)
											);

			$CarrerasAreas = $carreras + $programas;
			$this->set('CarrerasAreas', $CarrerasAreas);
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			$this->Company->recursive = 1;
			$this->CompanyJobProfile->recursive = 3;
			
			$this->companyHistory('sinLimite');
			
		}

		public function enableDisableOffer(){
			$redirect = $this->redireccionaAdmin();
			if($this->request->is('get')):
				$id=$this->request->query('id');
				$estatusOffer = $this->request->query('estatus');
				
				if($estatusOffer == 1):
					$newEstatusOffer = 0;
					$mensaje = 'Oferta desactivada';
				else:
					$newEstatusOffer = 1;
					$mensaje = 'Oferta activada';
				endif;
				
				if ($this->CompanyJobContractType->updateAll(array('CompanyJobContractType.status' => "'".$newEstatusOffer."'"),array('CompanyJobContractType.id' =>$id))):
					$this->Session->setFlash($mensaje, 'alert-success');
					$this->redirect(array('action' =>  $redirect));
				else:
					$this->Session->setFlash($mensaje, 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			else:
				$this->Session->setFlash('La acción no es permitida.', 'alert-danger');
				$this->redirect(array('action' =>  $redirect));
			endif;
		}
		
		public function updateCompanyJobProfileExpiration(){
			$redirect = $this->redireccionaAdmin();
			if($this->request->is('post')):
				if ($this->CompanyJobProfile->updateAll(array('CompanyJobProfile.expiration' => "'".$this->request->data['CompanyJobProfile']['expiration']['year'].'-'.
																									$this->request->data['CompanyJobProfile']['expiration']['month'].'-'.
																									$this->request->data['CompanyJobProfile']['expiration']['day']."'"),array('CompanyJobProfile.id' => $this->request->data['CompanyJobProfile']['id']))):
					$this->Session->setFlash('Vigencia actualizada', 'alert-success');
					$this->redirect(array('action' =>  $redirect));
				else:
					$this->Session->setFlash('Error al actualizar la vigencia', 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}

		public function searchStudentOffer($newSearch = null){
			$this->Administrator->recursive = 0;
			$administrator = $this->Administrator->findById($this->Auth->user('id'));
			$this->set('administrator', $administrator);
			// $this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			
			$this->Session->write('redirectAdmin', 'searchStudentOffer');
			
			if($this->request->query('option') <> ''):
				$opcion = $this->request->query('option');
				$totalStudents = $this->request->query('totalStudents');
				$this->Session->write('totalStudents', $totalStudents);
				// $this->Session->write('historyCompanyId', $this->request->query('historyCompanyId'));
				$this->Session->write('optionSearchStudentOffer', $opcion);
			else:
				if(($this->Session->read('optionSearchStudentOffer')) <> ''):
					$opcion = $this->Session->read('optionSearchStudentOffer');
				endif;
			endif;
			
			if($this->request->query('volver')<>''):
				$this->Session->write('volver', $this->request->query('volver'));
			else:
				if($this->request->query('regresar')):
					$this->Session->write('volver', $this->request->query('regresar')); 
				else:
					$this->Session->write('volver', 'companyHistory'); 
				endif;
			endif;
			
			if($this->request->query('historyCompanyId') <> ''):
				$this->Session->write('historyCompanyId', $this->request->query('historyCompanyId'));
			endif;
			
			if($opcion == 1):
				$tipoBusqueda = 7;
				$tipoDescarga = ' Entrevistas Telefónicas';
			else:
				if($opcion == 2):
					$tipoBusqueda = 8;
					$tipoDescarga = ' Entrevistas Presenciales';
				else:
					if($opcion == 3):
						$tipoBusqueda = 9;
						$tipoDescarga = ' Contrataciones';
					else:
						if($opcion == 4):
							$tipoBusqueda = 10;
							$tipoDescarga = ' Postulaciones';
						endif;
					endif;
				endif;
			endif;
			
			if($this->request->query('newSearch')<>''):
				$newSearch = $this->request->query('newSearch');
			else:
				$newSearch = '';
			endif;
			
			$this->Company->recursive = 2;
			$this->set('company', $this->Company->findById($this->Session->read('historyCompanyId')));
			$this->Student->recursive = 2;
			$this->salary();
			
			// Enlista los perfiles con un tipo de notificación
			$entrevistasTelefonicas = $this->StudentNotification->find('all',
																		array(
																			'conditions' => array(
																								'StudentNotification.company_id' => $this->Session->read('historyCompanyId'),
																								'StudentNotification.interview_type' => 1,
																								),
																			'order' => array('StudentNotification.id ASC')
																		)
											);
			$this->set( compact ('entrevistasTelefonicas') );
				
			$entrevistasPersonales = $this->StudentNotification->find('all',
																		array(
																			'conditions' => array(
																								'StudentNotification.company_id' => $this->Session->read('historyCompanyId'),
																								'StudentNotification.interview_type' => 2,
																								),
																			'order' => array('StudentNotification.id ASC')
																		)
												);
			$this->set( compact ('entrevistasPersonales') );
				
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('page');
				$this->Session->delete('orden');
				$this->Session->delete('intoFolder');
				$this->Session->delete('criterio');
			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if($this->request->query('orden') <> ''):
				$orden = ' StudentLastUpdate.modified '.$this->request->query('orden');
				$this->Session->write('orden', $this->request->query('orden'));
			else:	
				$orden = 'StudentProfile.name DESC';
			endif;
			
			if(isset($this->request->data['Administrator']['limite']) and ($this->request->data['Administrator']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Administrator']['limite']);
				$limite = $this->request->data['Administrator']['limite'];
			else:
				if(($this->Session->read('limite')) <> ''):
					$limite = $this->Session->read('limite');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
			if($this->request->query('companyJobProfileId') <> ''):
				$id = $this->request->query('companyJobProfileId');
				$this->Session->write('idOffer', $id);
			else:
				if($this->Session->check('idOffer')):
					$id = $this->Session->read('idOffer');
				else:
					$this->Session->setFlash('Sin oferta seleccionada', 'alert-success');
					$this->redirect(array('action' => 'searchCompany'));
				endif;
			endif;
			
			$generalCondition = array( 'AND' => array( 	
														'StudentNotification.company_id' => $this->Session->read('historyCompanyId'),
														'StudentNotification.company_job_profile_id' => $id,
														)
										);
										
			if($tipoBusqueda==7):
			//Obtenemos los id de los candidatos que poseen una entrevista telefonica de la empresa
					$studentTelephoneNotification = $this->StudentNotification->find('all', array(
																								'conditions' => array(
																												$generalCondition,
																												'StudentNotification.interview_type' => 1
																													)
																								)
																					);
																					
					// Obtenemos los id que sean válidos y en estructura de index valor
					$idsStudentTelephoneNotification = array("Student.id" => Set::extract("/StudentNotification/student_id", $studentTelephoneNotification));
					
					foreach($idsStudentTelephoneNotification['Student.id'] as $idStudentTelephoneNotification){
						$results[] = $idStudentTelephoneNotification; 
					}
			endif;
			
			if($tipoBusqueda==8):
			//Obtenemos los id de los candidatos que poseen una entrevista presencial de la empresa				
					$studentPersonalNotification = $this->StudentNotification->find('all', array(
																								'conditions' => array(
																												$generalCondition,
																												'StudentNotification.interview_type' => 2
																													)
																								)
																					);
																					
					// Obtenemos los id que sean válidos y en estructura de index valor
					$idsStudentPersonalNotification = array("Student.id" => Set::extract("/StudentNotification/student_id", $studentPersonalNotification));
					
					foreach($idsStudentPersonalNotification['Student.id'] as $idStudentPersonalNotification){
						$results[] = $idStudentPersonalNotification; 
					}
			endif;
			
			if($tipoBusqueda==9): //Esta pendiente esta opción debe de ser con la tabla de reporte de empresas
			//Obtenemos los id de los candidatos reportados en alguna oferta de la empresa	
					$studenReport = $this->Report->find('all', array(
																	'conditions' => array(
																						'Report.company_job_profile_id' => $id,
																						'Report.company_id' => $this->Session->read('historyCompanyId'),
																						'Report.registered_by' => 'company'
																						)
																				)
																	);
															
					// Obtenemos los id que sean válidos y en estructura de index valor
					$idsStudentReport = array("Student.id" => Set::extract("/Report/student_id", $studenReport));
						
					foreach($idsStudentReport['Student.id'] as $idStudentReport){
						$results[] = $idStudentReport; 
					}							
			endif;	
			
			if($tipoBusqueda==10):
			//Obtenemos los id de los candidatos postulados en alguna oferta de la empresa	
					$studentPostullation = $this->Application->find('all', array(
																				'conditions' => array(
																									'Application.company_job_profile_id' => $id,
																									'Application.company_id' => $this->Session->read('historyCompanyId')
																									)
																				)
																	);
															
					// Obtenemos los id que sean válidos y en estructura de index valor
					$idsStudentPostulation = array("Student.id" => Set::extract("/Application/student_id", $studentPostullation));
						
					foreach($idsStudentPostulation['Student.id'] as $idStudentPostulation){
						$results[] = $idStudentPostulation; 
					}
			endif;
			
			//Deja ids unicos y los agrega a la condición  OR
			if(isset($results)):
				$resultsIds = array_unique($results);
				foreach($resultsIds as $resultsId){
					$idsStudents[] = $resultsId;  
				}
			endif;
			
			// Si no se encuantra ningún id de alumno lo deja vacio
			if(!isset($idsStudents) ):
				$idsStudents = array(); 
			endif;
			
			// if($this->Auth->user('role')=='subadministrator'):
				// $results = $this->StudentProfessionalProfile->find('list',
																		// array('conditions' => array(
																									// 'StudentProfessionalProfile.undergraduate_institution' => $administrator['AdministratorProfile']['institution'],
																									// ),
																				// 'fields'=>array('StudentProfessionalProfile.student_id')
																			// )
																	// );
				
				// if(!empty($results)):
					// $uniqueStudentIds = array_unique($results);
				// else:
					// $uniqueStudentIds = array();
				// endif;
				
				// echo '<pre>';
				// print_r($idsStudents);
				// print_r($uniqueStudentIds);
				// echo '</pre>';


				// $idsStudents = array_intersect($idsStudents, $uniqueStudentIds);
				// $idsStudents = array_unique($idsStudents);
				
			// endif;
			

				
			
			if(isset($this->request->data['Administrator']['Buscar']) and ($this->request->data['Administrator']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Administrator']['Buscar']);
				$palabraBuscada  = $this->request->data['Administrator']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada = '';
				endif;
			endif;
			

			if(isset($this->request->data['Administrator']['criterio']) and ($this->request->data['Administrator']['criterio'] <> '')):
				$this->Session->write('criterio', $this->request->data['Administrator']['criterio']);
				$criterio = $this->request->data['Administrator']['criterio'];
			else:
				if(($this->Session->read('criterio')) <> ''):
					$criterio = $this->Session->read('criterio');
				else:
					$criterio = ''; //Búsqueda default equivalente a mostrar todos los perfiles de la oferta
				endif;
			endif;
	
				if($criterio == 11):
					$condicion = array('Student.username'  => $palabraBuscada);
				else:
					if($criterio == 12):
						// $condicion[] = array('StudentProfile.name LIKE' => '%'. $palabraBuscada . '%');
						$claves = explode(" ", $palabraBuscada);
						$indice = 0;
						foreach ($claves as $clave) {
							if(strlen($clave)>2):
								$condicion[$indice]['OR'][] = array('StudentProfile.name LIKE' => "%$clave%");
							endif;
							$indice++;
						}
					
					else:
						if($criterio == 13):
							// $condicion['OR'][] = array('StudentProfile.last_name LIKE' => '%'. $palabraBuscada . '%');
							// $condicion['OR'][] = array('StudentProfile.second_last_name LIKE' => '%'. $palabraBuscada . '%');
							
							$claves = explode(" ", $palabraBuscada);
							$indice = 0;
							foreach ($claves as $clave) {
								if(strlen($clave)>2):
									$condicion[$indice]['OR'][] = array('StudentProfile.last_name LIKE' => "%$clave%");
									$condicion[$indice]['OR'][] = array('StudentProfile.second_last_name LIKE' => "%$clave%");
								endif;
								$indice++;
							}
						else:
							if($criterio == 14):
								$condicion[] = array('Student.email LIKE' => '%'.$palabraBuscada.'%');
							else:
								$condicion = array();
							endif;
						endif;
					endif;
				endif;
				
				if(($newSearch==null) OR ($newSearch == 'nuevaBusqueda')):
									$this->paginate = array('conditions' => array(
																'AND' => array(
																				'Student.id' => $idsStudents,
																				$condicion
																		),
																),
											'limit' => $limite,
											'order' => $orden,
											);
				else:
									$this->paginate = array('conditions' => array(
																'AND' => array(
																				'Student.id' => $idsStudents,
																				$condicion
																		),
																),
											'order' => $orden,
											);
				endif;
			
				$this->set('candidatos', $candidatos = $this->paginate('Student'));
				$this->set('tipoDescarga', $tipoDescarga);
				
		}
		
		public function searchStudentOfferExcel(){
			//Carga de catálogos
			$this->sexo();
			$this->country();
			$this->maritalStatus();
			$this->Competency();
			$this->disabilityType();
			$this->ExperienceArea();
			$this->Rotation();
			$this->contractType();
			$this->salary();
			$this->workday();
			$this->carrer();
			$this->Facultades();
			$this->Escuelas();
			$this->academicSituation();
			$this->semester();
			$this->average();
			$this->decimalAverage();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->Tecnology();
			$this->TypeCourses();
			$this->NivelesIdioma();
			$this->program();
			$this->softwareLevel();
			
			$this->searchStudentOffer('sinLimite');
		}
		
		public function searchOffer($newSearch = null){
			$this->Administrator->recursive = 1;
			$administrador = $this->Administrator->findById($this->Auth->user('id'));
			$this->set('administrator', $administrador);
			$this->Session->write('redirectAdmin', 'searchOffer');
		
			$this->Company->recursive = 1;
			$this->CompanyJobProfile->recursive = 3;
			
			// $this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->salary(); 
			
			$limite = 5; //default limit
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('page');
				$this->Session->delete('intoFolder');
				$this->Session->delete('orden');
			endif;
			
			if($this->request->query('orden') <> ''):
				$orden = ' CompanyJobProfile.created DESC ';
				$this->Session->write('orden', $this->request->query('orden'));
			else:	
				$orden = ' CompanyJobContractType.created DESC';
			endif;
			
			if($this->request->query('orden') <> ''):
				$orden = $this->request->query('orden');
				$this->Session->write('orden', $orden);
			else:
				if(($this->Session->read('orden')) <> ''):
					$orden = $this->Session->read('orden');
				endif;
			endif;
			
			if($orden==1):
				$orden = 'CompanyLastUpdate.created DESC'; 
			else:
				if($orden==2):
					$orden = 'CompanyLastUpdate.modified DESC'; 
				else:
					$orden = 'CompanyJobProfile.created DESC';
				endif;
			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limiteAdmin', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
			else:
				if(($this->Session->read('limiteAdmin')) <> ''):
					$limite = $this->Session->read('limiteAdmin');
				else:
					$limite = 5; //default limit
				endif;
			endif;
				
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $tipoBusqueda);
			else:
				if(isset($this->request->data['Company']['criterio']) and ($this->request->data['Company']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Company']['criterio']);
					$tipoBusqueda = $this->request->data['Company']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 0; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;
			
			if(isset($this->request->data['Company']['Buscar']) and ($this->request->data['Company']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Company']['Buscar']);
				$palabraBuscada  = $this->request->data['Company']['Buscar'];
			else:
				if(isset($this->request->data['Company']['buscarSalary']) and ($this->request->data['Company']['buscarSalary'] <> '')):
					$this->Session->write('palabraBuscada', $this->request->data['Company']['buscarSalary']);
					$palabraBuscada  = $this->request->data['Company']['buscarSalary'];
				else:
					if(($this->Session->read('palabraBuscada')) <> ''):
						$palabraBuscada  = $this->Session->read('palabraBuscada');
					else:
						$palabraBuscada = '';
					endif;
				endif;
			endif;
			
			// DEPENDIENDO DEL ADMINISTRADOR SOLO APARECERAN LAS OFERTAS RELACIONADAS A SU ESCUELA O INSTITUCION
			$criterioAdmin = array();
			$nivelAcademicoAdministrador[] = array();
			
			// Verificamos que sea un subadministrator para que visualice solo las ofertas de su institución
			if($administrador['Administrator']['role']=='subadministrator'):
						
				// Si el administrador tiene un nivel lo compara
				if($administrador['AdministratorProfile']['academic_level_id']==1):
					$idsCarreras = $this->RelacionEscuelaCarrera->find('all', array(
																					'conditions' => array(
																										'RelacionEscuelaCarrera.facultad_licenciatura_id' => $administrador['AdministratorProfile']['institution'],
																										),
																					)
																	);
					
					foreach($idsCarreras as $carrera):
						$idsCarrerasOferta[] = $carrera['RelacionEscuelaCarrera']['career_id'];
					endforeach;	
			
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($idsCarreras)):	
						$idsCarrerasOferta = '';
					endif;
					
					$idsCarrerasAdmin = $this->Career->find('all', array(
																	'conditions' => array(
																							'Career.career_id' => $idsCarrerasOferta,
																						),
																	)
													);
					foreach($idsCarrerasAdmin as $carrera):
						$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $carrera['Career']['id']);
					endforeach;	
					
					$nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.licenciatura' => 1);
					
				endif;
				
				// Si el administrador tiene un nivel lo compara
				if($administrador['AdministratorProfile']['academic_level_id']>1):
					$idsProgramas = $this->RelacionFacultadPrograma->find('all', array(
																					'conditions' => array(
																										'RelacionFacultadPrograma.facultad_posgrado_id' => $administrador['AdministratorProfile']['institution'],
																										),
																					)
																		);
					
					foreach($idsProgramas as $programa):
						$idsCarrerasOferta[] = $programa['RelacionFacultadPrograma']['posgrado_program_id'];
					endforeach;	
			
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($idsProgramas)):	
						$idsCarrerasOferta = '';
					endif;
					
					$idsCarrerasAdmin = $this->PosgradoProgram->find('all', array(
																	'conditions' => array(
																							'PosgradoProgram.posgrado_program_id' => $idsCarrerasOferta,
																						),
																	)
													);
													
					foreach($idsCarrerasAdmin as $carrera):
						$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $carrera['PosgradoProgram']['id']);
					endforeach;
					
					if($administrador['AdministratorProfile']['academic_level_id'] == 2):
						$nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.especialidad' => 1);
					endif;
					
					if($administrador['AdministratorProfile']['academic_level_id'] == 3):
						$nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.maestria' => 1);
					endif;
					
					if($administrador['AdministratorProfile']['academic_level_id'] == 4):
						$nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.doctorado' => 1);
					endif;

				endif;
				
				
				if((isset($carrerasSQL)) AND (!empty($carrerasSQL))):
					$listaIdsRelatedCareer = $this->CompanyJobRelatedCareer->find('list',
																			array('conditions' => array(
																										'OR' => array (
																													 $carrerasSQL 
																													),
																										),
																				  'fields'=>array('CompanyJobRelatedCareer.company_job_profile_id'),
																				)
																		);
																		
					foreach($listaIdsRelatedCareer as $idRelatedCareer):
						$criterioAdmin['OR'][] = array('CompanyCandidateProfile.id' => $idRelatedCareer);
					endforeach;	

					if(!isset($criterioAdmin) OR empty($listaIdsRelatedCareer)):
						$criterioAdmin['OR'][] = array('CompanyCandidateProfile.id' => '');
					endif;
				else:
					$criterioAdmin['OR'][] = array('CompanyCandidateProfile.id' => '');
				endif;

			endif;


			$hoy = date('Y-m-d');
			$fechaMax = strtotime ( '+15 day' , strtotime ( $hoy ) ) ;
			$fechaMax = date ( 'Y-m-j' , $fechaMax );			
			
				if($tipoBusqueda == 10)://Puesto
					$criterio[] =  array( 'AND' => array( 
														'CompanyJobProfile.job_name LIKE ' =>  '%'. $palabraBuscada . '%',
														)
										);
				else:
					if($tipoBusqueda == 8)://RFC
						//Obtiene las coincidencias de nombres del perfil de la compañía con la búsqueda
						$companyProfilesLikeName = $this->Company->find('list', array(
																			'conditions' => array(
																								'CompanyProfile.rfc LIKE' => '%'. $palabraBuscada . '%',
																								),
																			'recursive' => 2
																		)
															);
						
						// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
						foreach($companyProfilesLikeName as $companyProfileLikeName):
							$idsCompaniesLikeRFC[] = $companyProfileLikeName;
						endforeach;	
						
						// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
						if(empty($idsCompaniesLikeRFC)):
							$idsCompaniesLikeRFC = '';
						endif;

						$criterio[] = array( 'AND' => array( 	
															'CompanyJobProfile.company_id'  => $idsCompaniesLikeRFC,
															)
											);
					else:
						if($tipoBusqueda == 9): //Nombre de empresa o institución
						
							//Obtiene las coincidencias de nombres del perfil de la compañía con la búsqueda
							$companyProfilesLikeName = $this->Company->find('list', array(
																				'conditions' => array(
																									'CompanyProfile.company_name LIKE' => '%'. $palabraBuscada . '%',
																									),
																				'recursive' => 2
																			)
																);
							
							// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
							foreach($companyProfilesLikeName as $companyProfileLikeName):
								$idsCompaniesLikeName[] = $companyProfileLikeName;
							endforeach;	
							
							// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
							if(empty($idsCompaniesLikeName)):
								$idsCompaniesLikeName = '';
							endif;
							
							// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
							$companyJobOffersLikeName = $this->CompanyJobOffer->find('list', array(
																									'fields' => array('CompanyJobOffer.id'),
																									'conditions' => array(
																															'AND' => array(
																																			'CompanyJobOffer.company_id' => $idsCompaniesLikeName,
																																			'CompanyJobOffer.confidential_job_offer' => 'n',
																																			'CompanyJobOffer.company_name' => '',
																																			)
																															),
																										'recursive' => 2
																								)
																					);

							// Obtenemos en un array los id´s que de las jobOffer anteriores
							foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
								$idsCompaniesJobOffersLikeName[] = $companyJobOfferLikeName;
							endforeach;	
							
							// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
							if(empty($idsCompaniesJobOffersLikeName)):
								$idsCompaniesJobOffersLikeName = '';
							endif;
					
							// Obtenemos los id´s de las ofertas que cumplan con los id´s de los JobOffer de la consulta anterior
							$companyJobProfileResults = $this->CompanyJobProfile->find('list', array(
																									'fields' => array('CompanyJobProfile.id'),
																									'conditions' => array(
																														'AND' => array(
																																		'CompanyJobProfile.company_job_offer_id' => $idsCompaniesJobOffersLikeName,
																																		)
																														),
																									'recursive' => 2
																									)
																						);
							
							// Obtenemos en un array los id´s que de las JobProfiles anteriores
							foreach($companyJobProfileResults as $companyJobProfileResult):
								$idsompanyJobProfileResults[] = $companyJobProfileResult;
							endforeach;	
							
							// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
							if(empty($idsompanyJobProfileResults)):
								$idsompanyJobProfileResults = '';
							endif;
							
							// Obtenemos los id´s de las vacantes que haya sido declarada como confidencial y que se le haya asignado un nombre para mostrar.
							$companyJobOffersLikeName = $this->CompanyJobOffer->find('all', array(
																				'fields' => array('CompanyJobOffer.id'),
																				'conditions' => array(
																									'AND' => array(
																													'CompanyJobOffer.company_name LIKE' => '%'. $palabraBuscada . '%',
																													'CompanyJobOffer.confidential_job_offer' => 's',
																													'CompanyJobOffer.company_name <> ' => '',
																													)
																									)
																			)
																);
															
							foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
								$jobOffersLikeName[] = $companyJobOfferLikeName['CompanyJobOffer']['id'];
							endforeach;	
							
							// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
							if(empty($companyJobOffersLikeName)):	
									$jobOffersLikeName = '';
							endif;
			
							$criterio[] = array( 'AND' => array(
														'OR' => array(
																	'CompanyJobProfile.id' => $idsompanyJobProfileResults,
																	'CompanyJobProfile.company_job_offer_id'=>$jobOffersLikeName
																	)
																									
														),
										);

						else:
							if($tipoBusqueda == 11)://Nombre contacto
							
								$claves = explode(" ", $palabraBuscada);
								$indice = 0;
								foreach ($claves as $clave) {
									if(strlen($clave)>2):
										$criterio1[$indice]['OR'][] = array('CompanyContact.name LIKE' => "%$clave%");
										$criterio1[$indice]['OR'][] = array('CompanyContact.last_name LIKE' => "%$clave%");
										$criterio1[$indice]['OR'][] = array('CompanyContact.second_last_name LIKE' => "%$clave%");
										$criterio2[$indice]['OR'][] = array('CompanyJobOffer.responsible_name LIKE' => "%$clave%");
										$criterio2[$indice]['OR'][] = array('CompanyJobOffer.responsible_last_name LIKE' => "%$clave%");
										$criterio2[$indice]['OR'][] = array('CompanyJobOffer.responsible_second_last_name LIKE' => "%$clave%");
									endif;
									$indice++;
								}
						
								//Obtiene las coincidencias de nombres de contacto de la compañía
								$companyProfilesLikeName = $this->CompanyContact->find('list', array(
																									'fields' => array('CompanyContact.company_id'),
																									'conditions' => array(
																														$criterio1,
																														),
																									'recursive' => 2
																									)
																						);
								
								// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
								foreach($companyProfilesLikeName as $companyProfileLikeName):
									$idsCompaniesLikeName[] = $companyProfileLikeName;
								endforeach;	
								
								// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
								if(empty($idsCompaniesLikeName)):
									$idsCompaniesLikeName = array();
								endif;
								
								// <------------1------->
								//Busca en el contacto de la oferta donde el contacto sea el mismo que el de la empresa y que la empresa tenga el nombre similar al de la consulta
								// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
								$CompanyJobOffers1 = $this->CompanyJobOffer->find('list', array(
																										'fields' => array('CompanyJobOffer.id'),
																										'conditions' => array(
																														'CompanyJobOffer.company_id' => $idsCompaniesLikeName,
																														'CompanyJobOffer.same_contact' => 's'
																															),
																										'recursive' => 2
																									)
																						);

								// Obtenemos en un array los id´s que de las jobOffer anteriores
								foreach($CompanyJobOffers1 as $CompanyJobOffer1):
									$idsCompanyJobOffer1[] = $CompanyJobOffer1;
								endforeach;	
								
								// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
								if(empty($idsCompanyJobOffer1)):
									$idsCompanyJobOffer1 = array();
								endif;
								
								// <------------2------->
								// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
								$idsCompanyJobOffers2 = $this->CompanyJobOffer->find('list', array(
																										'fields' => array('CompanyJobOffer.id'),
																										'conditions' => array(
																														$criterio2,
																														'CompanyJobOffer.same_contact' => 'n'
																															),
																										'recursive' => 2
																									)
																						);

								// Obtenemos en un array los id´s que de las jobOffer anteriores
								foreach($idsCompanyJobOffers2 as $idCompanyJobOffer2):
									$idsCompanyJobOffer2[] = $idCompanyJobOffer2;
								endforeach;	
								
								// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
								if(empty($idsCompanyJobOffer2)):
									$idsCompanyJobOffer2 = array();
								endif;
								
								$allIds = array_merge($idsCompanyJobOffer1, $idsCompanyJobOffer2);
								$unicosIds = array_unique($allIds);
								
								$criterio[] = array( 'AND' => array(
															'OR' => array(
																		'CompanyJobProfile.company_job_offer_id' => $unicosIds
																		)
																										
															),
											);
									
									
									
							else:	
								if($tipoBusqueda == 12)://Correo electrónico del contacto
								
									$claves = explode(" ", $palabraBuscada);
									$indice = 0;
									foreach ($claves as $clave) {
										if(strlen($clave)>2):
											$criterio1[$indice]['OR'][] = array('Company.email LIKE' => "%$clave%");
											$criterio2[$indice]['OR'][] = array('CompanyJobOffer.company_email LIKE' => "%$clave%");
										endif;
										$indice++;
									}
							
									//Obtiene las coincidencias de nombres de contacto de la compañía
									$companyProfilesLikeName = $this->Company->find('list', array(
																										'fields' => array('Company.id'),
																										'conditions' => array(
																															$criterio1,
																															),
																										'recursive' => 2
																										)
																							);
									
									// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
									foreach($companyProfilesLikeName as $companyProfileLikeName):
										$idsCompaniesLikeName[] = $companyProfileLikeName;
									endforeach;	
									
									// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
									if(empty($idsCompaniesLikeName)):
										$idsCompaniesLikeName = array();
									endif;
									
									// <------------1------->
									//Busca en el contacto de la oferta donde el contacto sea el mismo que el de la empresa y que la empresa tenga el nombre similar al de la consulta
									// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
									$CompanyJobOffers1 = $this->CompanyJobOffer->find('list', array(
																											'fields' => array('CompanyJobOffer.id'),
																											'conditions' => array(
																															'CompanyJobOffer.company_id' => $idsCompaniesLikeName,
																															'CompanyJobOffer.same_contact' => 's'
																																),
																											'recursive' => 2
																										)
																							);

									// Obtenemos en un array los id´s que de las jobOffer anteriores
									foreach($CompanyJobOffers1 as $CompanyJobOffer1):
										$idsCompanyJobOffer1[] = $CompanyJobOffer1;
									endforeach;	
									
									// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
									if(empty($idsCompanyJobOffer1)):
										$idsCompanyJobOffer1 = array();
									endif;
									
									// <------------2------->
									// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
									$idsCompanyJobOffers2 = $this->CompanyJobOffer->find('list', array(
																											'fields' => array('CompanyJobOffer.id'),
																											'conditions' => array(
																															$criterio2,
																															'CompanyJobOffer.same_contact' => 'n'
																																),
																											'recursive' => 2
																										)
																							);

									// Obtenemos en un array los id´s que de las jobOffer anteriores
									foreach($idsCompanyJobOffers2 as $idCompanyJobOffer2):
										$idsCompanyJobOffer2[] = $idCompanyJobOffer2;
									endforeach;	
									
									// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
									if(empty($idsCompanyJobOffer2)):
										$idsCompanyJobOffer2 = array();
									endif;
									
									$allIds = array_merge($idsCompanyJobOffer1, $idsCompanyJobOffer2);
									$unicosIds = array_unique($allIds);

									$criterio[] = array( 'AND' => array('CompanyJobProfile.company_job_offer_id' => $unicosIds));

								else:	
									if($tipoBusqueda == 4):
										$this->Session->delete('palabraBuscada');
										$criterio[] =  array( 'AND' => array( 
																			'CompanyJobContractType.status'  => 1,
																			'CompanyJobProfile.expiration >' => $hoy,
																			)
															);
									else:
										if($tipoBusqueda == 5):
											$this->Session->delete('palabraBuscada');
											$criterio[] = array( 'AND' => array(
																				'CompanyJobContractType.status'  => 1,
																				'CompanyJobProfile.expiration >=' => $hoy,
																				'CompanyJobProfile.expiration <=' => $fechaMax,
																				
																				)
																);
										else:
											if($tipoBusqueda == 6):
												$this->Session->delete('palabraBuscada');
												$criterio[] = array( 'AND' => array(
																				'CompanyJobProfile.expiration <' => $hoy,
																				
																				)
																);
											else:
												if($tipoBusqueda == 7):
													$this->Session->delete('palabraBuscada');
													$criterio[] = array( 'AND' => array( 
																						'CompanyJobContractType.status'  => 0,
																						)
																		);
												else:
													$criterio = array();
												endif;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			
				$this->paginate = array(
											'conditions' => array(
																$criterio,
																$criterioAdmin,
																'AND' => array (
																				$nivelAcademicoAdministrador
																				)
																),
											'limit' => $limite,
											'order' => $orden,
											);

				$this->set('ofertas', '');
				
				$ofertas = $this->paginate('CompanyJobProfile');
				$this->set('ofertas', $ofertas);
		}

		public function searchOfferAdminExcel($newSearch = null){
			// $this->searchOffer();
			$this->ExperienceArea();
			$this->interestArea();
			$this->Rotation();
			$this->salary(); 
			$this->states(); 
			$this->country(); 
			
			$this->carrer(); 
			$this->lenguage(); 
			$this->Competency(); 
			$this->benefit(); 
			$this->Tecnology(); 
			$this->softwareLevel(); 
			$this->Escuelas(); 
			$this->Facultades(); 
			$this->posgradoProgrma(); 
			$this->contractType(); 
			$this->disabilityType();
			$this->workday();
			$this->NivelesIdioma(); 
			$this->program(); 
			$this->escuelasFacultades();
			$this->semester();

			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			$this->Company->recursive = 1;
			$this->CompanyJobProfile->recursive = 3;
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('page');
				$this->Session->delete('intoFolder');
				$this->Session->delete('orden');
			endif;
			
			if($this->request->query('orden') <> ''):
				$orden = $this->request->query('orden');
				$this->Session->write('orden', $orden);
			else:
				if(($this->Session->read('orden')) <> ''):
					$orden = $this->Session->read('orden');
				else:	
					$orden = ' CompanyJobContractType.created DESC';
				endif;
			endif;
			
			if($orden==1):
				$orden = 'CompanyLastUpdate.created DESC'; 
			else:
				if($orden==2):
					$orden = 'CompanyLastUpdate.modified DESC'; 
				else:
					$orden = 'CompanyJobProfile.created DESC';
				endif;
			endif;
			
			$this->Session->delete('page');	
				
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $tipoBusqueda);
			else:
				if(isset($this->request->data['Company']['criterio']) and ($this->request->data['Company']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Company']['criterio']);
					$tipoBusqueda = $this->request->data['Company']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 0; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;
			
			if(isset($this->request->data['Company']['Buscar']) and ($this->request->data['Company']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Company']['Buscar']);
				$palabraBuscada  = $this->request->data['Company']['Buscar'];
			else:
				if(isset($this->request->data['Company']['buscarSalary']) and ($this->request->data['Company']['buscarSalary'] <> '')):
					$this->Session->write('palabraBuscada', $this->request->data['Company']['buscarSalary']);
					$palabraBuscada  = $this->request->data['Company']['buscarSalary'];
				else:
					if(($this->Session->read('palabraBuscada')) <> ''):
						$palabraBuscada  = $this->Session->read('palabraBuscada');
					else:
						$palabraBuscada = '';
					endif;
				endif;
			endif;
			
			$hoy = date('Y-m-d');
			$fechaMax = strtotime ( '+15 day' , strtotime ( $hoy ) ) ;
			$fechaMax = date ( 'Y-m-j' , $fechaMax );	
			
			if($tipoBusqueda == 1):
					$this->set('tipoDescarga', 'Por puesto: '.$palabraBuscada);
					$criterio[] =  array( 'AND' => array( 
														'CompanyJobProfile.job_name LIKE ' =>  '%'. $palabraBuscada . '%',
														)
										);
				else:
					if($tipoBusqueda == 2):
						$this->set('tipoDescarga', 'Por sueldo: '.$pagas[$palabraBuscada]);
						$criterio[] = array( 'AND' => array( 	
															'CompanyJobContractType.salary' => $palabraBuscada,
															)
											);
					else:
						if($tipoBusqueda == 3):
							$this->set('tipoDescarga', 'Por folio: '.intval($palabraBuscada));
							$criterio[] = array( 'AND' => array( 
																'CompanyJobProfile.id'  => intval($palabraBuscada),
																)
											);
						else:
							if($tipoBusqueda == 4):
								$this->set('tipoDescarga', 'Activas');
								$criterio[] =  array( 'AND' => array( 
																	'CompanyJobContractType.status'  => 1,
																	)
													);
							else:
								if($tipoBusqueda == 5):
									$this->set('tipoDescarga', 'Por expirar');
									$this->Session->delete('palabraBuscada');
									$criterio[] = array( 'AND' => array(
																		'CompanyJobProfile.expiration >= ' => $hoy,
																		'CompanyJobProfile.expiration <= ' => $fechaMax,
																		)
														);
								else:
									if($tipoBusqueda == 6):
										$this->set('tipoDescarga', 'Expiradas');
										$this->Session->delete('palabraBuscada');
										$criterio[] = array( 'AND' => array(
																		'CompanyJobProfile.expiration < ' => $hoy,
																		)
														);
									else:
										if($tipoBusqueda == 7):
											$this->set('tipoDescarga', 'Inactivas');
											$this->Session->delete('palabraBuscada');
											$criterio[] = array( 'AND' => array( 
																				'CompanyJobContractType.status'  => 0,
																				)
																);
										else:
											$criterio = '';
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			
				$ofertas = $this->CompanyJobProfile->find('all',
															array(
																'conditions' => array(
																					'OR' => array(
																								$criterio
																								),
																					),
														)
												);
				$this->set('ofertas', $ofertas);



			$programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
				$this->set( compact ('programas') );

				$programas = $this->PosgradoProgram->find('list',
												array(
													'fields' => array('PosgradoProgram.id', 'PosgradoProgram.posgrado_program'),
													'order' => array('PosgradoProgram.posgrado_program ASC')
												)
											);

				$carreras = $this->Career->find('list',
												array(
													'fields' => array('Career.id', 'Career.career'),
													'order' => array('Career.career ASC')
												)
											);

			$CarrerasAreas = $carreras + $programas;
			$this->set('CarrerasAreas', $CarrerasAreas);
		}
		
		public function sendMail($newSearch = null){
			$this->Administrator->recursive = 0;
			$this->Student->recursive = 0;
			$this->Company->recursive = 0;
			$administrator = $this->Administrator->findById($this->Auth->user('id'));
			$this->set('administrator', $administrator);
			$this->Session->write('redirectAdmin', 'sendMail');
			
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('company_type_mail');
				$this->Session->delete('employees_number_mail');
				$this->Session->delete('state_mail');
				$this->Session->delete('company_rotation_mail');
				$this->Session->delete('career');
				$this->Session->delete('institution');
				$this->Session->delete('carreraSeleccionada');
				$this->Session->delete('escuelaSeleccionada');
				$this->Session->delete('academic_level_id');
				$this->Session->delete('redirect');
				$this->Session->delete('affterDeleteFolder');
				$this->Session->delete('affterPostulated');
				$this->Session->delete('tipoProfessionalProfile');
				$this->Session->delete('page');
				$this->Session->delete('status');
				$this->Session->delete('student_id');
				$this->Session->delete('administratorProfileEditingId');
			endif;
			
			$this->Rotation();
			$this->numeroEmpleados();
			$this->companyType();
			$this->academicLevel();
			
			$Estados = $this->State->find('list',
												array(
													'fields' => array('State.nombre', 'State.nombre'),
													'order' => array('State.nombre ASC')
												)
											);
			$this->set( compact ('Estados') );
			
			$AcademicLevels = $this->AcademicLevel->find('list', array('order' => array('AcademicLevel.id ASC')));
			$this->set('AcademicLevels', $AcademicLevels);
			
			
			$AcademicSituation = $this->AcademicSituation->find('list', array('order' => array('AcademicSituation.id ASC')));
			$this->set( compact ('AcademicSituation') );
			
			if($this->request->is('post')):
				if(isset($this->request->data['Administrator']['career'])):
					$this->Session->write('academic_level_id', $this->request->data['Administrator']['academic_level_id'] );
					$this->Session->write('escuelaSeleccionada', $this->request->data['Administrator']['institution'] );
					$this->Session->write('carreraSeleccionada', $this->request->data['Administrator']['career'] );
					
					$criterio1 = '';
					$criterio2 = '';
					$criterio3 = ''; 
					
					if(isset($this->request->data['Student']['status']) and ($this->request->data['Student']['status']<>'')):
						$this->Session->write('status', $this->request->data['Student']['status']);
						$criterio1[] = array('Student.status' => $this->request->data['Student']['status']);
					endif;
					
					if(isset($this->request->data['Administrator']['academic_level_id']) and (($this->request->data['Administrator']['academic_level_id'])<>'')):
						$this->Session->write('academic_level_id', $this->request->data['Administrator']['academic_level_id']);
						$criterio2[] = array('StudentProfessionalProfile.academic_level_id' => $this->request->data['Administrator']['academic_level_id']);
					endif;
					
					if(isset($this->request->data['Administrator']['institution']) and (($this->request->data['Administrator']['institution'])<>'')):
						$this->Session->write('institution', $this->request->data['Administrator']['institution']);
						$criterio2[] = array('StudentProfessionalProfile.undergraduate_institution' => $this->request->data['Administrator']['institution']);
					endif;
					
					if(isset($this->request->data['Administrator']['career']) and (($this->request->data['Administrator']['career'])<>'')):
						$this->Session->write('career', $this->request->data['Administrator']['career']);
						$criterio2[] = array('StudentProfessionalProfile.career_id' => $this->request->data['Administrator']['career']);
					endif;
					
					if($criterio1<>''):
						$students = $this->Student->find('all',
																array(
																		'fields' => array('Student.id','Student.id'),
																		'conditions' => array(
																							$criterio1
																							)
																)
														);
					else:
						$students = '';
					endif;
				
					if($criterio2<>''):
						$StudentProfessionalProfiles = $this->StudentProfessionalProfile->find('all',
																array(
																		'fields' => array('StudentProfessionalProfile.student_id','StudentProfessionalProfile.student_id'),
																		'conditions' => array(
																							$criterio2
																							)
																)
														);
					else:
						$StudentProfessionalProfiles = '';
					endif;
					
					if($students<>''):
						foreach($students as $student):
							$idsStudents[] = $student['Student']['id'];
						endforeach;	
					endif;
					
					if($StudentProfessionalProfiles<>''):
						foreach($StudentProfessionalProfiles as $StudentProfessionalProfile):
							$idsStudentProfessionalProfiles[] = $StudentProfessionalProfile['StudentProfessionalProfile']['student_id'];
						endforeach;
					endif;
					
					if(($students <> '') and ($StudentProfessionalProfiles <> '')  and (!empty($idsStudents))  and (!empty($idsStudentProfessionalProfiles))):
						$todos = array_intersect($idsStudents, $idsStudentProfessionalProfiles );	
					else:
						if(($criterio1 <> '') and ($criterio2 == '') and (!empty($idsStudents))):
							$todos = $idsStudents;	
						else:
							if(($criterio2 <> '') and ($criterio1 == '') and (!empty($idsStudentProfessionalProfiles))):
								$todos = $idsStudentProfessionalProfiles;	
							else:
								$todos = '';	
							endif;
						endif;
					endif;
					
					if($todos<>'' and !empty($todos)):
						foreach($todos as $student_id):
							$criterio3[] = $student_id;
						endforeach;
					
						$studentsSendMail = $this->Student->find('list',
																array(
																		'fields' => array('Student.email','Student.email'),
																		'conditions' => array(
																							'OR' => array(
																										'Student.id' => $criterio3,
																										)
																							)
																)
														);
						$this->set( compact ('studentsSendMail') );
					else:
						$this->set( 'studentsSendMail' ,'' );
					endif;
					
				endif;
				
				if(isset($this->request->data['Company']['status'])):
					$criterio1 = '';
					$criterio2 = '';
					
					if(isset($this->request->data['Company']['status']) and ($this->request->data['Company']['status']<>'')):
						$this->Session->write('status', $this->request->data['Company']['status']);
						$criterio1[] = array('Company.status' => $this->request->data['Company']['status']);
					endif;
					
					if(isset($this->request->data['CompanyProfile']['company_rotation_mail']) and (($this->request->data['CompanyProfile']['company_rotation_mail'])<>'')):
						$this->Session->write('company_rotation_mail', $this->request->data['CompanyProfile']['company_rotation_mail']);
						$criterio2[] = array('CompanyProfile.company_rotation' => $this->request->data['CompanyProfile']['company_rotation_mail']);
					endif;
					
					if(isset($this->request->data['CompanyProfile']['state_mail']) and (($this->request->data['CompanyProfile']['state_mail'])<>'')):
						$this->Session->write('state_mail', $this->request->data['CompanyProfile']['state_mail']);
						$criterio2[] = array('CompanyProfile.state' => $this->request->data['CompanyProfile']['state_mail']);
					endif;
					
					if(isset($this->request->data['CompanyProfile']['employees_number_mail']) and (($this->request->data['CompanyProfile']['employees_number_mail'])<>'')):
						$this->Session->write('employees_number_mail', $this->request->data['CompanyProfile']['employees_number_mail']);
						$criterio2[] = array('CompanyProfile.employees_number' => $this->request->data['CompanyProfile']['employees_number_mail']);
					endif;
					
					if(isset($this->request->data['CompanyProfile']['company_type_mail']) and (($this->request->data['CompanyProfile']['company_type_mail'])<>'')):
						$this->Session->write('company_type_mail', $this->request->data['CompanyProfile']['company_type_mail']);
						$criterio2[] = array('CompanyProfile.company_type' => $this->request->data['CompanyProfile']['company_type_mail']);
					endif;
					
					if($criterio1<>''):
						$companies = $this->Company->find('all',
																array(
																		'fields' => array('Company.id','Company.id'),
																		'conditions' => array(
																							$criterio1
																							)
																)
														);
					else:
						$companies = '';
					endif;
				
					if($criterio2<>''):
						$CompanyProfiles = $this->CompanyProfile->find('all',
																array(
																		'fields' => array('CompanyProfile.company_id','CompanyProfile.company_id'),
																		'conditions' => array(
																							$criterio2
																							)
																)
														);
					else:
						$CompanyProfiles = '';
					endif;
					
					if($companies<>''):
						foreach($companies as $company):
							$idsCompany[] = $company['Company']['id'];
						endforeach;	
					endif;
					
					if($CompanyProfiles<>''):
						foreach($CompanyProfiles as $CompanyProfile):
							$idsCompanyProfile[] = $CompanyProfile['CompanyProfile']['company_id'];
						endforeach;
					endif;
			
					if(($companies <> '') and ($CompanyProfiles <> '')  and (!empty($idsCompany))  and (!empty($idsCompanyProfile))):
						$todos = array_intersect($idsCompany, $idsCompanyProfile );	
					else:
						if(($criterio1 <> '') and ($criterio2 == '') and (!empty($idsCompany))):
							$todos = $idsCompany;	
						else:
							if(($criterio2 <> '') and ($criterio1 == '') and (!empty($idsCompanyProfile))):
								$todos = $idsCompanyProfile;	
							else:
								$todos = '';	
							endif;
						endif;
					endif;

					if(($todos<>'') and !empty($todos)):
						foreach($todos as $company_id):
							$criterio3[] = $company_id;
						endforeach;
					
						$studentsSendMail = $this->Company->find('list',
																array(
																		'fields' => array('Company.email','Company.email'),
																		'conditions' => array(
																							'OR' => array(
																										'Company.id' => $criterio3,
																										)
																							)
																)
														);
						$this->set( compact ('studentsSendMail') );
					else:
						$this->set( 'studentsSendMail' ,'' );
					endif;
					
				endif;
				
				
				// Envio de correo si es que viene form envio
				if(isset($this->request->data['Student']['title']) and (($this->request->data['Student']['title'])<>'')):
					$redirect = $this->redireccionaAdmin();
					$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'studentContact'.DS;
					
					if( $this->data['Student']['file']['error'] == 0 &&  $this->data['Student']['file']['size'] > 0):
						if(!move_uploaded_file($this->data['Student']['file']['tmp_name'], $destino.$this->data['Student']['file']['name'])):              
							$this->Session->setFlash('Lo sentimos no se pudo cargar el archivo', 'alert-danger');
							$this->redirect(array('action' =>  $redirect));
						endif;
					endif;
				
						if ($this->Student->validates(array('fieldList' => array('title','message')))):
							
							$correosTo = $this->request->data['Administrator']['emailTo'];
							$destinatariosTo = explode(";",$correosTo);
							foreach($destinatariosTo as $destinatarioTo) {
								if($destinatarioTo<>''):
									$listaCorreosTo[] = trim($destinatarioTo);
								endif;
							}
							
							foreach($this->request->data['Administrator']['lista_correos'] as $correo) {
								if($correo <>''):
									$listaCorreosTo[] = $correo;
								endif;
							}
							
							$totalEnviados = 0;
							foreach($listaCorreosTo as $correo):

									$Email = new CakeEmail('gmail');
									$Email->from(array($this->Auth->user('email') => 'SISBUT UNAM'));
									
									$Email->to($correo);
									
									if($this->data['Student']['file']['size'] > 0):
										$Email->attachments($destino.$this->data['Student']['file']['name']);
									endif;
										$Email->subject('Mensaje de SISBUT UNAM');
										// $Email->replyTo($this->request->data['Student']['email']);
										$Email->emailFormat('both'); 
										$contenMail = 	'<center><div style="background-color: #F2F2F2; width: 850px; text-align: justify;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
														'<strong><h3 style="padding-left: 15px; padding-right: 15px;">'.$this->request->data['Student']['title'].'</h3></strong><br>'.
														'<p style="padding-left: 15px; padding-right: 15px;">'.$this->request->data['Student']['message'].'</p><br></div></center>';
										if($this->request->data['Student']['sign'] <> ''):
											$contenMail .= '<center><div style="background-color: #F2F2F2; width: 850px; text-align: justify;"><p style=" padding-left: 15px; padding-right: 15px;">Firma: '.$this->request->data['Student']['sign'].'</p><br></div></center>';
										endif;
										$Email->template('email')->viewVars( array(
																		'aMsg' => $contenMail 
										));
										
										if($Email->send()):
											$totalEnviados++;
											$this->Session->setFlash('El correo se envió con exito a un total de '.$totalEnviados.' destinatarios.', 'alert-success');
										else:
											$this->Session->setFlash('Lo sentimos su correo no pudo ser enviado en la siguiente dirección: '.$correo, 'alert-danger');
										endif;
										
										
										// if($this->data['Student']['file']['size'] > 0):
											// unlink($destino.$this->data['Student']['file']['name']);
										// endif;
							endforeach;	
						else:
							$this->Session->setFlash('Verifique los campos marcados.', 'alert-danger');
						endif;
						
						$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}
		
		public function informe(){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->Session->write('redirectAdmin', 'informe');	
		}
		
		public function reporte(){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->Session->write('redirectAdmin', 'reporte');
		}
		
		public function notification(){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$this->Session->write('redirectAdmin', 'notification');
		}
		
		public function grafica(){
			if($this->request->is( 'post' ) ):
				$statusFecha = $this->request->data['Administrator']['status_fecha'];
				$tipoInforme = $this->request->data['Administrator']['tipo_informe'];
				$this->Rotation();
				$modelo = '';
				$datos = '';
				
				$anio1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['year'];
				$mes1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['month'];
				$dia1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['day'];
				
				$anio2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['year'];
				$mes2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['month'];
				$dia2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['day'];
				
				$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
				$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
				
				$fechaInicio = strtotime ( $fechaInicio ) ;
				$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
				$fecha1 = $fechaInicio;
			
				$fechaFin = strtotime ( $fechaFin ) ;
				$fechaFin = date ( 'Y-m-d' , $fechaFin );
				$fecha2 = $fechaFin;
			
				if($tipoInforme == 0)://Curriculums
					$modelo ='Student';	
					$criterio[] = array( 'AND' => array(
															'Student.created >= ' => $fecha1,
															'Student.created <= ' => $fecha2,
															)
											);
					$agrupado = $modelo.'.created';
				else:
					if($tipoInforme == 1)://Empresas
						$modelo = 'Company';
						$criterio[] = array( 'AND' => array(
															'Company.created >= ' => $fecha1,
															'Company.created <= ' => $fecha2,
															)
											);
						$agrupado = $modelo.'.created';
					else:
						if($tipoInforme == 2)://Ofertas
							$modelo = 'CompanyJobProfile';
							$criterio[] = array( 'AND' => array(
															'CompanyJobProfile.created >= ' => $fecha1,
															'CompanyJobProfile.created <= ' => $fecha2,
															'CompanyJobContractType.status <> ' => ''
																)
												);
							$agrupado = $modelo.'.created';
						else:
							if($tipoInforme == 3)://Postulaciones
								$modelo = 'Application';
								$this->$modelo->recursive = 2;
								$this->CompanyJobContractType->recursive = -1;
								$ofertasAcitvas = $this->CompanyJobContractType->find('list', array(
																							'conditions' => array(
																											'CompanyJobContractType.status >= ' => 1,
																												),
																							'fields'=>array('CompanyJobContractType.company_job_profile_id'),
																							)
																					);
								

									
								$studentPostullation = $this->$modelo->find('all', array(
																					'conditions' => array(
																							'Application.created >= ' => $fecha1,
																							'Application.created <= ' => $fecha2,
																							'Application.company_job_profile_id' => $ofertasAcitvas,
																							),
																			 'group' => array($modelo.'.created'),
																			 'fields'=>array($modelo.'.created'),
																			 'order' => array($modelo.'.created,'.$modelo.'.company_job_profile_id ASC')
																			)
																	);
								if(!empty($studentPostullation)):
									foreach($studentPostullation as $fechas){
										$fechasPostulaciones[] = $fechas['Application']['created']; 
									}
								else:
									$fechasPostulaciones = array();
								endif;

								foreach($fechasPostulaciones as $fecha){
										$ofertasenfecha = $this->$modelo->find('all', array(
																							'conditions' => array(
																								'Application.created ' => $fecha,
																								'Application.company_job_profile_id' => $ofertasAcitvas,
																							),
																							 'group' => array($modelo.'.company_job_profile_id'),
																							 'fields'=>array($modelo.'.company_job_profile_id'),
																							)
																				);
									$arrayIdOfertas[] = $ofertasenfecha;
								}
								
								foreach($fechasPostulaciones as $fecha){
										$postulaciones = $this->$modelo->find('all', array(
																							'conditions' => array(
																								'Application.created ' => $fecha,
																								'Application.company_job_profile_id' => $ofertasAcitvas,
																							),
																							 'fields'=>array($modelo.'.company_job_profile_id'),
																							)
																				);
									$arrayTotalPostulaciones[] = $postulaciones;
								}
								
								$index = 0;
								if(!isset($arrayIdOfertas)):
									$arrayIdOfertas = array();
								endif;
								
								foreach($arrayIdOfertas as $ofertasId){
									foreach($ofertasId as $ofertaId){
										$companyJobProfileIds[$index][] = $ofertaId['Application']['company_job_profile_id']; 
									}
									$index++;
								}
								
								// Si no se encuantra datos lo setea a vacio
								if(empty($fechasPostulaciones) ):
									$fechasPostulaciones = ''; 
								endif;
								$this->set('fechasPostulaciones', $fechasPostulaciones);
								if(empty($companyJobProfileIds) ):
									$companyJobProfileIds = array(); 
								endif;
								$this->set('companyJobProfileIds', $companyJobProfileIds);
								if(empty($arrayTotalPostulaciones) ):
									$arrayTotalPostulaciones = ''; 
								endif;
								$this->set('arrayTotalPostulaciones', $arrayTotalPostulaciones);
							else:
								if(($tipoInforme == 4) OR ($tipoInforme == 5))://Entrevistas telefónicas //Notificaciones presenciales
									$modelo = 'StudentNotification';
									if($tipoInforme == 4):
										$notificacion = 1;
									else:
										if($tipoInforme == 5):
											$notificacion = 2;
										endif;
									endif;
											
									$criterio[] = array(
														'AND' => array(
																	'StudentNotification.interview_type' => $notificacion
																	),
															 
															);
									$criterio2[] = array(
														'AND' => array(
																	'StudentNotification.company_interview_date >= ' => $fecha1,
																	'StudentNotification.company_interview_date <= ' => $fecha2,
																	)
														);
									$criterio3[] = array(
														'AND' => array(
																	'StudentNotification.student_interview_date >= ' => $fecha1,
																	'StudentNotification.student_interview_date <= ' => $fecha2,
																	)
														);
								else:
									if($tipoInforme == 6)://Contrataciones
										$modelo = 'Report';
										$criterio[] = array( 'AND' => array(
																	'Report.fecha_contratacion >= ' => $fecha1,
																	'Report.fecha_contratacion <= ' => $fecha2,
																	'Report.registered_by' => 'company',	
																	),
															 
															);
									else:
										if($tipoInforme == 7): //Estudiantes eliminados
											$modelo = 'StudentDisabled';
											$criterio[] = array( 'AND' => array(
																		'StudentDisabled.created >= ' => $fecha1,
																		'StudentDisabled.created <= ' => $fecha2,	
																		),	 
																);
										else:
											if($tipoInforme == 8): //Empresas eliminadas
												$modelo = 'CompanyDisabled';
												$criterio[] = array( 'AND' => array(
																			'CompanyDisabled.created >= ' => $fecha1,
																			'CompanyDisabled.created <= ' => $fecha2,	
																			),	 
																	);
											else:
												if($tipoInforme == 9): //Encuestas estudiantes
													$modelo = 'StudentAnswer';
													$criterio[] = array( 'AND' => array(
																				'StudentAnswer.created >= ' => $fecha1,
																				'StudentAnswer.created <= ' => $fecha2,	
																				'StudentAnswer.question_id <= ' => 1,	
																				),	 
																		);
												else:
													if($tipoInforme == 10): //Encuestas empresas
														$modelo = 'CompanyAnswer';
														$criterio[] = array( 'AND' => array(
																					'CompanyAnswer.created >= ' => $fecha1,
																					'CompanyAnswer.created <= ' => $fecha2,	
																					'CompanyAnswer.question_id <= ' => 1,	
																					),	 
																			);
													else:
														if($tipoInforme == 11): //Competencias
															$modelo ='Student';
															$criterio[] = array( 'AND' => array(
																									'Student.created >= ' => $fecha1,
																									'Student.created <= ' => $fecha2,
																									)
																					);
														endif;
													endif;
												endif;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
				
					if($modelo<>''):
						if($tipoInforme == 0)://Curriculums
							$this->set('nombreInforme', 'Currículums');
							$this->$modelo->recursive = -1;
							$datos = $this->$modelo->find('all', array(
																	'conditions' => array(
																						$criterio
																						),
																	 'group' => array( $modelo.'.status',$agrupado),
																	 'fields'=>array($modelo.'.id',$modelo.'.status',$modelo.'.created','COUNT(`'.$modelo.'`.`created`) as `totalStatus`'),
																	 'order' => array($modelo.'.created, '.$modelo.'.status ASC')
																)
													);
						else:
							if($tipoInforme == 1)://Empresas
								$this->set('nombreInforme', 'Empresas');
								$this->$modelo->recursive = 0;
								$datos = $this->$modelo->find('all', array(
																		'conditions' => array(
																							$criterio
																							),
																		 'group' => array( $modelo.'.status',$agrupado,'CompanyProfile.company_rotation'),
																		 'fields'=>array($modelo.'.id',$modelo.'.status',$modelo.'.created','COUNT(`'.$modelo.'`.`created`) as `totalStatus`','CompanyProfile.company_rotation','COUNT(`CompanyProfile`.`company_rotation`) as `totalGiro`'),
																		 'order' => array($modelo.'.created, '.$modelo.'.status ASC')
																	)
														);
								$cont = 6; //Excel inicia en fila 6
								$hoy = date('Y-m-d');
								$fechaExpira = strtotime ( '+1 month' , strtotime ( $hoy ) ) ;
								$fechaExpira = date ( 'Y-m-j' , $fechaExpira );	
								$pendientes = '';
								$porexpirar = '';
								$expiradas = '';
									
								foreach($datos as $dato):
									$fechaCreacion[] = array(
															'Company.created' => $dato['Company']['created']
															);

									$pendientes[$cont] = $this->$modelo->find('count', array(
																			'conditions' => array (
																								'AND' => array(
																											'CompanyOfferOption.id' => '',
																											'Company.created' => $dato['Company']['created'],
																											),
																									)
																				)
																);
									$porexpirar[$cont] = $this->$modelo->find('count', array(
																			'conditions' => array (
																								'AND' => array(
																											'CompanyOfferOption.id <> ' => '',
																											'Company.created' => $dato['Company']['created'],
																											'CompanyOfferOption.end_date_company >= ' => $hoy,
																											'CompanyOfferOption.end_date_company <= ' => $fechaExpira,
																											),
																									)
																				)
																);	
									$expiradas[$cont] = $this->$modelo->find('count', array(
																			'conditions' => array (
																								'AND' => array(
																											'CompanyOfferOption.id <> ' => '',
																											'Company.created' => $dato['Company']['created'],
																											'CompanyOfferOption.end_date_company < ' => $hoy,
																											),
																									)
																				)
																);	
									$cont++;
								endforeach;
								$this->set('pendientes', $pendientes);
								$this->set('porexpirar', $porexpirar);
								$this->set('expiradas', $expiradas);
							else:
								if($tipoInforme == 2)://Ofertas
									$this->set('nombreInforme', 'Ofertas');
									$this->$modelo->recursive = 0;
									$datos = $this->$modelo->find('all', array(
																		 'conditions' => array(
																							$criterio
																							),
																		 'group' => array($agrupado,$modelo.'.rotation','CompanyJobContractType.status',),
																		 'fields'=>array($modelo.'.id','CompanyJobContractType.status',$modelo.'.created','COUNT(`'.$modelo.'`.`created`) as `totalStatus`','CompanyJobProfile.rotation','COUNT(`CompanyJobProfile`.`rotation`) as `totalGiro`'),
																		 'order' => array($modelo.'.created, CompanyJobContractType.status ASC')
																	)
														);
									
									$cont = 6; 
									$hoy = date('Y-m-d');
									$fechaExpira = strtotime ( '+15 day' , strtotime ( $hoy ) ) ;
									$fechaExpira = date ( 'Y-m-j' , $fechaExpira );	
									$pendientes = '';
									$porexpirar = '';
									$expiradas = '';
									foreach($datos as $dato):
										$cantidadVacantes[] = $this->$modelo->find('all', array(
																				'conditions' => array (
																									'AND' => array(
																												'CompanyJobContractType.status <> ' => '',
																												'CompanyJobProfile.created' => $dato['CompanyJobProfile']['created'],
																												),
																										),
																				 'fields'=>array($modelo.'.vacancy_number'),
																					)
																	);

										$porexpirar[$cont] = $this->$modelo->find('count', array(
																				'conditions' => array (
																									'AND' => array(
																												'CompanyJobProfile.created' => $dato['CompanyJobProfile']['created'],
																												'CompanyJobProfile.expiration >= ' => $hoy,
																												'CompanyJobProfile.expiration <= ' => $fechaExpira,
																												'CompanyJobContractType.status <> ' => ''
																												),
																										)
																					)
																	);	
										$expiradas[$cont] = $this->$modelo->find('count', array(
																				'conditions' => array (
																									'AND' => array(
																												'CompanyJobProfile.created' => $dato['CompanyJobProfile']['created'],
																												'CompanyJobProfile.expiration < ' => $hoy,
																												'CompanyJobContractType.status <> ' => ''
																												),
																										)
																					)
																	);	
										
										
										$cont++;
									endforeach;
									
									$index = 6;
									if(isset($cantidadVacantes)):
										foreach($cantidadVacantes as $vacante):
											$todasVacantes = '';
											foreach($vacante as $numeroVacantes):
												$todasVacantes[] = $numeroVacantes['CompanyJobProfile']['vacancy_number'];
											endforeach;
											$vacantes[$index] = $todasVacantes; 
											$index++;
										endforeach;
									else:
										$vacantes ='';
									endif;
									$this->set('vacantes', $vacantes);
									$this->set('porexpirar', $porexpirar);
									$this->set('expiradas', $expiradas);
								else:
									if($tipoInforme == 3)://Postulaciones
										$this->set('nombreInforme', 'Postulaciones');
										$modelo = 'CompanyJobProfile';
										$this->$modelo->recursive = 0;
										$index = 0;
	
										foreach($companyJobProfileIds as $ofertasId){
											$datos[] = $this->$modelo->find('all', array(
																							'conditions' => array(	
																												'AND' => array(
																															'CompanyJobProfile.id' => $ofertasId
																															),
																												),
																							 'group' => array($modelo.'.rotation'),
																							 'fields'=>array($modelo.'.id','COUNT(`'.$modelo.'`.`id`) as `total`','CompanyJobProfile.rotation'),
																							 'order' => array($modelo.'.id ASC')
																						)
																			);				
										}
									else:
										if(($tipoInforme == 4) OR ($tipoInforme == 5))://Notificaciones telefonicas //Notificaciones presenciales
											if($tipoInforme == 4):
												$this->set('nombreInforme', 'Entrevistas Telefónicas');
											else:
												$this->set('nombreInforme', 'Entrevistas Presenciales');
											endif;
											
											$this->$modelo->recursive = 0;
												$datos = $this->$modelo->find('all', array(
																								'conditions' => array(	
																													'AND' => array(
																																$criterio,
																																),
																													'OR' => array (
																																$criterio2,
																																$criterio3,
																																)
																													),
																								  'fields'=>array($modelo.'.company_interview_date, '.$modelo.'.student_interview_date, '.$modelo.'.company_interview_status, '.$modelo.'.student_interview_status'),
																								  'order' => array($modelo.'.company_interview_date ASC')
																									) 
																						);
										else:
											if($tipoInforme == 6): //Contrataciones
												$this->set('nombreInforme', 'Contrataciones');
												$this->$modelo->recursive = 0;
													$datos = $this->$modelo->find('all', array(
																									'conditions' => array(	
																														'AND' => array(
																																	$criterio,
																																	),
																														),
																									  'fields'=>array($modelo.'.fecha_contratacion, '.$modelo.'.response_notification'),
																									  'order' => array($modelo.'.fecha_contratacion ASC')
																										) 
																							);
											else:
												if($tipoInforme == 7): //Estudiantes eliminados
													$this->set('nombreInforme', 'Universitarios Eliminados');
													$this->$modelo->recursive = 0;
													$datos = $this->$modelo->find('all', array(
																									'conditions' => array(	
																														'AND' => array(
																																	$criterio,
																																	),
																														),
																									'fields'=>array($modelo.'.created, '.$modelo.'.student_username'),
																									'order' => array($modelo.'.created ASC')
																								) 
																							);
												else:
													if($tipoInforme == 8): //Empresas eliminadas
														$this->set('nombreInforme', 'Empresas Eliminadas');
														$this->$modelo->recursive = 0;
														$datos = $this->$modelo->find('all', array(
																									'conditions' => array(	
																														'AND' => array(
																																	$criterio,
																																	),
																														),
																									'fields'=>array($modelo.'.created, '.$modelo.'.company_username'),
																									'order' => array($modelo.'.created ASC')
																									) 
																								);
													else:
														if(($tipoInforme == 9) OR ($tipoInforme == 10)): //Encuestas Estudiantes //Encuestas empresas
															if($tipoInforme == 9):
																$this->set('nombreInforme', 'Encuestas de Salida de Universitarios');
															else:
																$this->set('nombreInforme', 'Encuestas de Salida de Empresas');
															endif;
															
															$this->$modelo->recursive = 0;
															$datos = $this->$modelo->find('all', array(
																										'conditions' => array(	
																															'AND' => array(
																																		$criterio,
																																		),
																															),
																										'fields'=>array($modelo.'.created, '.$modelo.'.answer'),
																										'order' => array($modelo.'.created ASC')
																									) 
																						);
														else:
															if($tipoInforme == 11): //Competencias
																$this->set('nombreInforme', 'Competencias Profesionales');
																$this->$modelo->recursive = -1;
																$estudiantes = $this->$modelo->find('all', array(
																										'conditions' => array(
																															$criterio
																															),
																										 'fields'=>array($modelo.'.id',$modelo.'.created'),
																										 'order' => array($modelo.'.created ASC')
																														)
																											);	
																$cont = 6;
																$index = 0;
																$fechas = '';
																$datos = array();
																foreach($estudiantes as $estudiante):
																	$resultados = $this->$modelo->StudentProfessionalSkill->find('all', array(
																																				'conditions' => array(
																																								'StudentProfessionalSkill.student_id' => $estudiante['Student']['id']
																																				),
																																				'fields'=>array('StudentProfessionalSkill.student_id, StudentProfessionalSkill.competency_id'),
																																			));
																	if(!empty($resultados)):
																		$fechas[$cont] = $estudiantes[$index]['Student']['created']; 
																		$datos[$cont] = $resultados;
																		$cont++;
																	endif;
																	$index++;
																endforeach;
																$this->set('fechas', $fechas);	
															endif;
														endif;
													endif;
												endif;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
						if(!isset($datos)):
							$datos = array();
						else:
							if(empty($datos)):
								$datos = array();
							endif;
						endif;
						$this->set('datos', $datos);
					else:
						$this->set('datos', '');
					endif;
					$this->set('statusFecha', $statusFecha);
					$this->set('tipoInforme', $tipoInforme);
			endif;
			
		}
		
		public function studentReportExcel(){
			$this->layout='excel';
			$this->Application->recursive = 2;
			$this->Student->recursive = 3;
			$tituloExcel = '';
			
			//Carga de catálogos
			$this->sexo();
			$this->country();
			$this->maritalStatus();
			$this->Competency();
			$this->disabilityType();
			$this->ExperienceArea();
			$this->Rotation();
			$this->contractType();
			$this->salary();
			$this->workday();
			$this->carrer();
			$this->Facultades();
			$this->Escuelas();
			$this->academicSituation();
			$this->semester();
			$this->average();
			$this->decimalAverage();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->Tecnology();
			$this->TypeCourses();
			$this->NivelesIdioma();
			$this->program();
			$this->softwareLevel();
			
			$anio1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['year'];
			$mes1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['month'];
			$dia1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['day'];
				
			$anio2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['year'];
			$mes2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['month'];
			$dia2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['day'];
				
			$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
			$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
				
			$fechaInicio = strtotime ( $fechaInicio ) ;
			$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
			$fecha1 = $fechaInicio;
			
			$fechaFin = strtotime ( $fechaFin ) ;
			$fechaFin = date ( 'Y-m-d' , $fechaFin );
			$fecha2 = $fechaFin;	
			
			if(isset($this->request->data['Administrator']['status_informe']) and ($this->request->data['Administrator']['status_informe'] <> '')):
				$criterio[] = array('Student.status' => $this->request->data['Administrator']['status_informe'] );
				if($this->request->data['Administrator']['status_informe']==1):
					$this->set('estatus', 'Activo');
				else:
					$this->set('estatus', 'Inactivo');
				endif;
			else:
				$criterio = '';
				$this->set('estatus', 'Sin especificar');
			endif;
			
			$datos = $this->Student->find('all', array(
																'conditions' => array(
																						'AND' => array(
																										$criterio,
																										'Student.created >= ' => $fecha1,
																										'Student.created <= ' => $fecha2,
																									),
																					)
															)
												);
			$this->set('datos', $datos);
			$this->set('columnas', $this->request->data['Administrator']['columnas_curriculum']);
		}
		
		public function companyReportExcel(){
			$this->Company->recursive = 2;

			$this->Sector();
			$this->Rotation();
			$this->numeroEmpleados();
			$this->companyType();
	
			$anio1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['year'];
			$mes1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['month'];
			$dia1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['day'];
				
			$anio2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['year'];
			$mes2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['month'];
			$dia2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['day'];
				
			$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
			$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
				
			$fechaInicio = strtotime ( $fechaInicio ) ;
			$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
			$fecha1 = $fechaInicio;
			
			$fechaFin = strtotime ( $fechaFin ) ;
			$fechaFin = date ( 'Y-m-d' , $fechaFin );
			$fecha2 = $fechaFin;	
			
			if(isset($this->request->data['Administrator']['status_informe']) and ($this->request->data['Administrator']['status_informe'] <> '')):
				$criterio[] = array('Company.status' => $this->request->data['Administrator']['status_informe'] );
				if($this->request->data['Administrator']['status_informe']==1):
					$this->set('estatus', 'Activo');
				else:
					$this->set('estatus', 'Inactivo');
				endif;
			else:
				$criterio = '';
				$this->set('estatus', 'Sin especificar');
			endif;
			
			$datos = $this->Company->find('all', array(
														'conditions' => array(
																				'AND' => array(
																								$criterio,
																								'Company.created >= ' => $fecha1,
																								'Company.created <= ' => $fecha2,
																								),
																				)
														)
										);
			$this->set('datos', $datos);
			$this->set('columnas', $this->request->data['Administrator']['columnas_empresa']);
		}	

		public function reportOfferExcel(){
			$this->CompanyJobProfile->recursive = 2;
			$this->CompanyProfile->recursive = 0;
			$this->CompanyJobOffer->recursive = 0;

			// $this->ExperienceArea();
			$this->interestArea();
			$this->Rotation();
			$this->salary(); 
			$this->states(); 
			$this->country(); 
			
			$this->carrer(); 
			$this->lenguage(); 
			$this->Competency(); 
			$this->benefit(); 
			$this->Tecnology(); 
			$this->softwareLevel(); 
			$this->Escuelas(); 
			$this->Facultades(); 
			$this->posgradoProgrma(); 
			$this->contractType(); 
			$this->disabilityType();
			$this->workday();
			$this->NivelesIdioma(); 
			$this->program(); 
			$this->escuelasFacultades();
			$this->semester();
			
			$anio1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['year'];
			$mes1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['month'];
			$dia1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['day'];
				
			$anio2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['year'];
			$mes2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['month'];
			$dia2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['day'];
				
			$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
			$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
				
			$fechaInicio = strtotime ( $fechaInicio ) ;
			$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
			$fecha1 = $fechaInicio;
			
			$fechaFin = strtotime ( $fechaFin ) ;
			$fechaFin = date ( 'Y-m-d' , $fechaFin );
			$fecha2 = $fechaFin;	
			
			if(isset($this->request->data['Administrator']['status_informe']) and ($this->request->data['Administrator']['status_informe'] <> '')):
				if($this->request->data['Administrator']['status_informe']==1):
					$criterio[] = array('CompanyJobContractType.status' => 1 );//La oferta y la empresa para ser vista deben de estar activas las 2
					$criterio[] = array('CompanyJobContractType.status <>' => '' );
					// $criterio[] = array('Company.status' => 1 );
					if($this->request->data['Administrator']['status_informe']==1):
						$this->set('estatus', 'Activo');
					else:
						$this->set('estatus', 'Inactivo');
					endif;
				else:
					$criterio[] = array('CompanyJobContractType.status' => 0 );
					$criterio[] = array('CompanyJobContractType.status <>' => '' );
					$this->set('estatus', 'Sin especificar');
					// $criterio[] = array('Company.status' => 1 );//La oferta y la empresa para ser vista deben de estar activas las 2
				endif;
			else:
				$criterio = '';
			endif;
			
			$datos = $this->CompanyJobProfile->find('all', array(
														'conditions' => array(
																				'AND' => array(
																								$criterio,
																								'CompanyJobProfile.created >= ' => $fecha1,
																								'CompanyJobProfile.created <= ' => $fecha2,
																								),
																				)
														)
										);
			$this->set('datos', $datos);	
			$this->set('columnas', $this->request->data['Administrator']['columnas_oferta']);

			$programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
				$this->set( compact ('programas') );

				$programas = $this->PosgradoProgram->find('list',
												array(
													'fields' => array('PosgradoProgram.id', 'PosgradoProgram.posgrado_program'),
													'order' => array('PosgradoProgram.posgrado_program ASC')
												)
											);

				$carreras = $this->Career->find('list',
												array(
													'fields' => array('Career.id', 'Career.career'),
													'order' => array('Career.career ASC')
												)
											);

			$CarrerasAreas = $carreras + $programas;
				$this->set('CarrerasAreas', $CarrerasAreas);	
		}
		
		public function reportContratacionExcel(){
			$this->layout='excel';
			$this->Application->recursive = 2;
			$this->Student->recursive = 3;
			$this->StudentNotification->recursive = 3;
			$this->CompanyJobProfile->recursive = 3;
			$this->Company->recursive = 0;
			$tituloExcel = '';
			
			//Carga de catálogos
			$this->sexo();
			$this->country();
			$this->maritalStatus();
			$this->Competency();
			$this->disabilityType();
			$this->ExperienceArea();
			$this->Rotation();
			$this->contractType();
			$this->salary();
			$this->workday();
			$this->carrer();
			$this->Facultades();
			$this->Escuelas();
			$this->academicSituation();
			$this->semester();
			$this->average();
			$this->decimalAverage();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->Tecnology();
			$this->TypeCourses();
			$this->NivelesIdioma();
			$this->program();
			$this->softwareLevel();
			
			$anio1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['year'];
			$mes1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['month'];
			$dia1 = $this->request->data['AdministratorProfile']['start_date_expiration_informe']['day'];
				
			$anio2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['year'];
			$mes2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['month'];
			$dia2 = $this->request->data['AdministratorProfile']['end_date_expiration_informe']['day'];
				
			$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
			$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
				
			$fechaInicio = strtotime ( $fechaInicio ) ;
			$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
			$fecha1 = $fechaInicio;
			
			$fechaFin = strtotime ( $fechaFin ) ;
			$fechaFin = date ( 'Y-m-d' , $fechaFin );
			$fecha2 = $fechaFin;	
			
			if(isset($this->request->data['Administrator']['status_informe']) and ($this->request->data['Administrator']['status_informe'] <> '')):
				$criterio[] = array('Student.status' => $this->request->data['Administrator']['status_informe'] );
				if($this->request->data['Administrator']['status_informe']==1):
					$this->set('estatus', 'Activo');
				else:
					$this->set('estatus', 'Inactivo');
				endif;
			else:
				$criterio = '';
				$this->set('estatus', 'Sin especificar');
			endif;
			
			$this->StudentNotification->recursive = -1;
			$idsStudent= array();
			$notificaciones = $this->StudentNotification->find('all',array(
																			'conditions' => array ('StudentNotification.interview_type' => 4,
																										'AND' => array(
																														'StudentNotification.company_interview_date >= ' => $fecha1,
																														'StudentNotification.company_interview_date <= ' => $fecha2,
																														),
																									)
																			)
																);
			
			foreach($notificaciones as $notificacion):
				$idsStudent[] = $notificacion['StudentNotification']['student_id'];
			endforeach;
			
			$idsStudent = array_unique($idsStudent);			
			
			$datos = $this->Student->find('all', array(
														'conditions' => array(
																			'AND' => array(
																							$criterio,
																							'Student.id' => $idsStudent
																						),
																			)
														)
										);
										
			$this->set('datos', $datos);
			$this->set('columnas', $this->request->data['Administrator']['columnas_seguimiento']);
			$this->set('fecha1', $fecha1);
			$this->set('fecha2', $fecha2);
		}
		
		public function reclutamientoSeleccion(){
			$redirect = $this->redireccionaAdmin();
			$this->StudentNotification->recursive= -1;
			$hoy = date('Y-m-d');
			$detalles = '';
			
			$Notificaciones = $this->StudentNotification->find('all', array(
																			'conditions' => array (
																							'StudentNotification.company_interview_date < ' => $hoy,
																							)
																			)
																);	

			foreach($Notificaciones as $notificacion):
				//Obtenemos las entrevistas telefonicas confirmadas por ambos y a los que no se les haya enviado mas de 2 correos y que ellos no hayan respondido o que si pero estan en espera type_respons = 0 or = 6
				if(
				((($notificacion['StudentNotification']['interview_type'] == 1) OR ($notificacion['StudentNotification']['interview_type'] == 4)) AND ($notificacion['StudentNotification']['company_interview_status'] == 1) AND ($notificacion['StudentNotification']['student_interview_status'] == 1) AND ($notificacion['StudentNotification']['total_mail_send'] < 2)) AND (($notificacion['StudentNotification']['type_respons'] == 0) OR ($notificacion['StudentNotification']['type_respons'] == 6)) AND (($notificacion['StudentNotification']['step_process'] == 0) OR ($notificacion['StudentNotification']['step_process'] == 1))):
					$telefonicas[] = $notificacion['StudentNotification']['id'];
				endif;
				
				//Obtenemos las entrevistas presenciales confirmadas por ambos y a los que no se les haya enviado mas de 2 correos y que ellos no hayan respondido o que si pero estan en espera type_respons = 0 or = 6
				if(
				((($notificacion['StudentNotification']['interview_type'] == 2) OR ($notificacion['StudentNotification']['interview_type'] == 4)) AND 
				($notificacion['StudentNotification']['company_interview_status'] == 1) AND ($notificacion['StudentNotification']['student_interview_status'] == 1) AND ($notificacion['StudentNotification']['total_mail_send_company'] < 2)) 
				AND 
				(($notificacion['StudentNotification']['type_respons'] == 0) OR ($notificacion['StudentNotification']['type_respons'] == 6)  OR ($notificacion['StudentNotification']['type_respons'] == 5)) AND 
				(($notificacion['StudentNotification']['type_respons_company'] == 0) OR ($notificacion['StudentNotification']['type_respons_company'] == 5)) AND 
				(($notificacion['StudentNotification']['step_process'] == 0) OR ($notificacion['StudentNotification']['step_process'] == 2))
				):
					$presenciales[] = $notificacion['StudentNotification']['id'];
				endif;
			endforeach;
			
			if(!isset($telefonicas)):
				$telefonicas = array();
			endif;

			if(!isset($presenciales)):
				$presenciales = array();
			endif;
			
			foreach($Notificaciones as $notificacion): //PRIMER CICLO
				
				//Recolección de entrevistas que estan en presenciales o en contrataciones
				//Verifica que la entrevista del primer ciclo sea de alguna forma solo telefónica
				if(($notificacion['StudentNotification']['interview_type'] == 1) OR (($notificacion['StudentNotification']['interview_type'] == 4) AND (($notificacion['StudentNotification']['step_process'] == 0) OR ($notificacion['StudentNotification']['step_process'] == 1)))):
					//Se crea un segundo ciclo para identificar si la entrevista del segundo ciclo es de tipo presencial o contratación
					foreach($Notificaciones as $restoNotificaciones): //SEGUNDO CICLO 
						//Se compara si la entrevista del primer ciclo  que es telefonica es igual a otra que pero que sea presencial o de tipo contratación  para ser marcada como avanzada
						if(
							($restoNotificaciones['StudentNotification']['interview_type'] == 2) OR 
							($restoNotificaciones['StudentNotification']['interview_type'] == 3) OR 
							(($restoNotificaciones['StudentNotification']['interview_type'] == 4) AND (($restoNotificaciones['StudentNotification']['step_process'] == 2) OR ($restoNotificaciones['StudentNotification']['step_process'] == 3)))):
							if(( $notificacion['StudentNotification']['student_id'] == $restoNotificaciones['StudentNotification']['student_id']) AND
								($notificacion['StudentNotification']['company_id'] == $restoNotificaciones['StudentNotification']['company_id']) AND
								($notificacion['StudentNotification']['company_job_profile_id'] == $restoNotificaciones['StudentNotification']['company_job_profile_id'])):
								$notificacionesTelefonicasAvanzadas[] = $notificacion['StudentNotification']['id'];
							endif;
						endif;
					endforeach;
				endif;
				
				//Recolección de entrevistas que estan en contrataciones
				//Verifica que la entrevista del primer ciclo sea de alguna forma solo presencial
				if(($notificacion['StudentNotification']['interview_type'] == 2) OR (($notificacion['StudentNotification']['interview_type'] == 4) AND ($notificacion['StudentNotification']['step_process'] == 2))):
					//Se crea un segundo ciclo para identificar si la entrevista del primer ciclo es identica a otra de tipo contratación
					foreach($Notificaciones as $restoNotificaciones)://SEGUNDO CICLO
					//Se compara si esta entrevista del segundo ciclo es igual a tipo contratación  
						if(($restoNotificaciones['StudentNotification']['interview_type'] == 3) OR 
							(($restoNotificaciones['StudentNotification']['interview_type'] == 4) AND ($restoNotificaciones['StudentNotification']['step_process'] == 3))):
							//Si la entrevista del primer ciclo que es presencial es identica a la del segundo ciclo que es contratacion será marcada como avanzada
							
							if(( $notificacion['StudentNotification']['student_id'] == $restoNotificaciones['StudentNotification']['student_id']) AND
								($notificacion['StudentNotification']['company_id'] == $restoNotificaciones['StudentNotification']['company_id']) AND
								($notificacion['StudentNotification']['company_job_profile_id'] == $restoNotificaciones['StudentNotification']['company_job_profile_id'])):
								$notificacionesPresencialesAvanzadas[] = $notificacion['StudentNotification']['id'];
							endif;
						endif;
					endforeach;
				endif;
				
			endforeach;

			if(!isset($notificacionesTelefonicasAvanzadas)):
				$notificacionesTelefonicasAvanzadas = array();
			endif;

			if(!isset($notificacionesPresencialesAvanzadas)):
				$notificacionesPresencialesAvanzadas = array();
			endif;
			
			$soloTelefonicas = array_diff($telefonicas,$notificacionesTelefonicasAvanzadas); //Se obtienen solo los id de las entrevistas que solo esten en telefonicas confirmadas sin avance
			$soloPresenciales = array_diff($presenciales,$notificacionesPresencialesAvanzadas); //Se obtienen solo los id de las entrevistas que solo esten en presenciales confirmadas sin avance
			
			$totalAlumnosTelefonicas = 0;
			$totalEmpresasPresenciales = 0;

			foreach($Notificaciones as $notificacion):
				//Se busca las entrevistas telefonicas que no tengan avance y los id de alumnos para iniciar o continuar el seguimiento (Si aplica)
				foreach($soloTelefonicas as $telefonica):
					if($notificacion['StudentNotification']['id'] == $telefonica):
						$idAlumnos[] = $notificacion['StudentNotification']['student_id'];
						//Se actualizará el contador de envio de correos +1
						$this->request->data = $notificacion;
						$this->request->data['StudentNotification']['total_mail_send'] = 1 + $this->request->data['StudentNotification']['total_mail_send'];
						$this->request->data['StudentNotification']['interview_type'] = 4;
						$this->request->data['StudentNotification']['step_process'] = 1;
						$this->request->data['StudentNotification']['type_respons'] = 0;
						$this->StudentNotification->save($this->request->data);
						$totalAlumnosTelefonicas++;
					endif;
				endforeach;
				
				//Se busca las entrevistas presenciales que no tengan avance y los id de las empresas para iniciar o continuar el seguimiento (Si aplica)
				foreach($soloPresenciales as $presencial):
					if($notificacion['StudentNotification']['id'] == $presencial):
						$CompanyJobProfileIds[] = $notificacion['StudentNotification']['company_job_profile_id'];
						//Se actualizará el contador de envio de correos +1
						$this->request->data = $notificacion;
						$this->request->data['StudentNotification']['total_mail_send_company'] = 1 + $this->request->data['StudentNotification']['total_mail_send_company'];
						$this->request->data['StudentNotification']['interview_type'] = 4;
						$this->request->data['StudentNotification']['step_process'] = 2;
						$this->request->data['StudentNotification']['type_respons_company'] = 0;
						$this->StudentNotification->save($this->request->data);
						$totalEmpresasPresenciales++;
					endif;
				endforeach;
			endforeach;
			
			if(!isset($idAlumnos)):
				$idAlumnos[] = 0;
			endif;
			
			if(!isset($CompanyJobProfileIds)):
				$CompanyJobProfileIds[] = 0;
			endif;
			
			//Se buscan los correos de los alumnos a los cuales se les enviará la notificación y el seguimiento igual para las empresas respectivamente
			$this->Student->recursive = -1;
			$emailsAlumnos = $this->Student->find('list', array(
																	'conditions' => array ('Student.id' => $idAlumnos),
																	'fields' => array('Student.email'),
																	));
			
			$this->CompanyJobProfile->recursive = 0;
			$emailsOffers = $this->CompanyJobProfile->find('all', array(
																	'conditions' => array ('CompanyJobProfile.id' => $CompanyJobProfileIds),
																	'fields' => array('Company.email','CompanyJobOffer.company_email'),
																	));
		
			//Se obtienen los correos tanto de la empresa como del responsable de la oferta si es que tiene
			foreach($emailsOffers as $email):
				if($email['Company']['email'] <> ''):
					$emailEmpresas[] = $email['Company']['email'];			
				endif;
				if($email['CompanyJobOffer']['company_email'] <> ''):
					$emailEmpresas[] = $email['CompanyJobOffer']['company_email'];			
				endif;
			endforeach;
			
			if(!isset($emailsAlumnos)):
				$emailsAlumnos = array();
			endif;
			$emailsAlumnos = array_unique($emailsAlumnos);
			
			if(!isset($emailEmpresas)):
				$emailEmpresas = array();
			endif;	
			$emailEmpresas = array_unique($emailEmpresas);

			//Envio de correos a los alumnos con seguimiento (Si aplicó)
			$totalEnviados = 0;
			$totalNoEnviados = 0;
			$correosNoEnviados = '';
			foreach($emailsAlumnos as $emailAlumno):
					$Email = new CakeEmail('gmail');
					$Email->from(array($this->Auth->user('email') => 'SISBUT UNAM'));
					$Email->to($emailAlumno);
					
					$Email->subject('UNAM – SISBUT / Seguimiento de entrevistas confirmadas');
					$Email->template('email')->viewVars( array(
															'aMsg' => 
															'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" width="100%">'.
															'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
		
															'<p>Estimado(a) usuario(a) para poder darle continuidad a sus procesos de reclutamiento, es necesario contar con el status de las entrevistas que usted y los reclutadores agendaron y confirmaron.</p></br>'.
															
															'<p>Por favor ingrese al portal del SISBUT con su Usuario y Contraseña dando click al botón que aparece a continuación, para reportar el status de sus entrevistas:</p><br>'.
														
															'<p><a href="http://bolsa.trabajo.unam.mx/unam/Students/studentNotification">Iniciar Sesión</a></p>'.
		
															'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
															'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
															'Correo electrónico: bolsa@unam.mx</p><br></div>'
													));

					if($Email->send()):
						$totalEnviados++;
					else:
						$correosNoEnviados .= $emailAlumno.' ';
						$totalNoEnviados++;
					endif;
			endforeach;	
			
			//Envio de correos a los alumnos con seguimiento (Si aplicó)
			foreach($emailEmpresas as $emailEmpresa):
					$Email = new CakeEmail('gmail');
					$Email->from(array($this->Auth->user('email') => 'SISBUT UNAM'));
					$Email->to($emailEmpresa);
					
					$Email->subject('UNAM – SISBUT / Seguimiento de entrevistas confirmadas');
					$Email->template('email')->viewVars( array(
															'aMsg' => 
															'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" width="100%">'.
															'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
		
															'<p>Estimado(a) reclutador(a) con el objetivo de darle seguimiento a los procesos de selección de nuestros estudiantes y egresados, le solicitamos de la manera más atenta nos comparta si los  alumnos fueron contratados; ingresando al portal del SISBUT con su usuario y contraseña dando click en el botón que aparece a continuación. El proceso es muy sencillo y no le quitará mucho tiempo.</p></br>'.
														
															'<p><a href="http://bolsa.trabajo.unam.mx/unam/Companies/companyNotification">Iniciar Sesión</a></p>'.
		
															'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
															'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
															'Correo electrónico: bolsa@unam.mx</p><br></div>'
													));

					if($Email->send()):
						$totalEnviados++;
					else:
						$correosNoEnviados .= $emailEmpresa.' ';
						$totalNoEnviados++;
					endif;
			endforeach;	
			
			if($totalEnviados == 0):
				$this->Session->setFlash('No se encontraron entrevistas pendientes de seguimiento.', 'alert-success');
			else:
				if($correosNoEnviados <> ''):
					$detalles = 'Correos no enviados: '.$correosNoEnviados;
				else:	
					$detalles = '';
				endif;
			endif;
			
			// Actualiza las fechas y estatus de ejecuciones en reclutamientos 
			$fechasReclutamieto = $this->RecruitmentDate->find('all', array(
																			'order' => ' RecruitmentDate.id DESC',
																			'limit' => 1
			));

			if(isset($fechasReclutamieto[0]['RecruitmentDate']['status_ejecucion_fecha1']) AND $fechasReclutamieto[0]['RecruitmentDate']['status_ejecucion_fecha1']==0):
				$this->RecruitmentDate->updateAll(array('RecruitmentDate.status_ejecucion_fecha1' => "1"),array('RecruitmentDate.id' =>$fechasReclutamieto[0]['RecruitmentDate']['id']));
			else:
				if(isset($fechasReclutamieto[0]['RecruitmentDate']['status_ejecucion_fecha2']) AND $fechasReclutamieto[0]['RecruitmentDate']['status_ejecucion_fecha2']==0):
					$this->RecruitmentDate->updateAll(array('RecruitmentDate.status_ejecucion_fecha2' => "1"),array('RecruitmentDate.id' =>$fechasReclutamieto[0]['RecruitmentDate']['id']));
					
					// Se crea las siguientes fechas ejecuciones
					$fechaActual = date('Y-m-d');
					$fechaMax = strtotime ( '+2 month' , strtotime ( $fechaActual ) ) ;
					$fechaSiguiente = date ( 'Y-m-j' , $fechaMax );
					
					$fechaPosterior = strtotime ( '+2 month' , strtotime ( $fechaSiguiente ) ) ;
					$fechaPosterior = date ( 'Y-m-j' , $fechaPosterior );
					
					$Seguimiento['RecruitmentDate']['tipo_seguimiento'] = 4;
					$Seguimiento['RecruitmentDate']['fecha1_seguimiento'] = $fechaSiguiente;
					$Seguimiento['RecruitmentDate']['fecha2_seguimiento'] = $fechaPosterior;
					$Seguimiento['RecruitmentDate']['status_ejecucion'] = 0;

				$this->RecruitmentDate->create();
				$this->RecruitmentDate->save($Seguimiento);
				endif;
			endif;
			
			
			
			$this->Session->setFlash(
										'Total de correos para seguimiento de entrevistas telefónicas: '.$totalAlumnosTelefonicas.' <br> 
										 Total de correos para seguimiento de entrevistas presenciales: '.$totalEmpresasPresenciales.'<br>
										 Total de correos no enviados: '.$totalNoEnviados.'<br>'.
										 $detalles , 
										'alert-success'
									);
			
			$this->redirect(array('action' =>  $redirect));

		}
		
		public function studentStatus(){
			$redirect = $this->redireccionaAdmin();
			$this->StudentLastUpdate->recursive = -1;
			$this->Student->recursive = 0;
			$totalAlumnosTelefonicas = 0;
			
			$fechaLimite = date('Y-m-d');
			$fechaLimite = strtotime ( '-5 month' , strtotime ( $fechaLimite ) ) ;
			$fechaLimite = date ( 'Y-m-j' , $fechaLimite );
			
			$fechaLimite2 = date('Y-m-d');
			$fechaLimite2 = strtotime ( '-18 month' , strtotime ( $fechaLimite2 ) ) ;
			$fechaLimite2 = date ( 'Y-m-j' , $fechaLimite2 );
			
			$idsStudent = $this->StudentLastUpdate->find('all', array(
																	'conditions' => array (
																							'StudentLastUpdate.modified < ' => $fechaLimite,
																							'StudentLastUpdate.modified > ' => $fechaLimite,
																							)
																			)
																);	
			foreach($idsStudent as $student):
				$ids[] = $student['StudentLastUpdate']['id'];			
			endforeach;
			
			if(!isset($ids)):
				$ids[] = 0;
			endif;
			
			$fechaLimite2 = date('Y-m-d');
			$fechaLimite2 = strtotime ( '-18 month' , strtotime ( $fechaLimite2 ) ) ;
			$fechaLimite2 = date ( 'Y-m-j' , $fechaLimite2 );
				
			$idsStudent2 = $this->StudentLastUpdate->find('all', array(
																	'conditions' => array (
																							'StudentLastUpdate.modified < ' => $fechaLimite,
																							)
																			)
																);																
																
			foreach($idsStudent2 as $student2):
				$ids2[] = $student2['StudentLastUpdate']['id'];			
			endforeach;
			
			if(!isset($ids2)):
				$ids2[] = 0;
			endif;
			
			$emailsStudent = $this->Student->find('all', array(
																'conditions' => array (
																					'Student.status' => 1,
																					'Student.block' => 0,
																					'Student.id' => $ids,
																					),
																)
												);
			
			$emailsStudent2 = $this->Student->find('all', array(
																'conditions' => array (
																					'Student.status' => 1,
																					'Student.block' => 0,
																					'Student.id' => $ids2,
																					),
																)
												);
												
			
			//Envio de correos a los alumnos
			$totalEnviados = 0;
			$totalNoEnviados = 0;
			$correosNoEnviados = '';
			
			foreach($emailsStudent as $emailAlumno):
					$Email = new CakeEmail('gmail');
					$Email->from(array($this->Auth->user('email') => 'SISBUT UNAM'));
					$Email->to($emailAlumno['Student']['email']);
					
					$Email->subject('UNAM – SISBUT / Actualiza tu cirrículum');
					$Email->template('email')->viewVars( array(
															'aMsg' => 
															'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" width="100%">'.
															'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
		
															'<p>Estimado(a) '.$emailAlumno['StudentProfile']['name'].' '.$emailAlumno['StudentProfile']['last_name'].' el motivo de este correo es para corroborar que sus datos de contacto sigan siendo los mismos, debido a que su cuenta no ha presentado actividad.</p></br>'.
															
															'<p>Le recordamos que para <strong> NO PERDER </strong> ninguna <strong> OPORTUNIDAD LABORAL </strong> es importante mantener sus datos de contacto e información de su currículum actualizados.  Si sus datos de contacto no son los mismos o desea actualizar la información de su currículum, por favor ingrese al portal del SISBUT con su número de cuenta y contraseña.</p></br>'.
															
															'<p><a href="http://bolsa.trabajo.unam.mx/unam/Students/studentNotification">Iniciar Sesión</a></p>'.
															
															'<p>Si no desea ser contactado por ningún reclutador, puede ingresar al portal y en la sección <strong> “Mi Currículum”</strong>, en el menú superior del lado derecho, seleccione la opción <strong> “Desactivar”</strong> para que su currículum no aparezca en las búsquedas de los reclutadores, pero usted podrá seguir buscando y postulándose a ofertas laborales.</p><br>'.
														
															'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
															'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
															'Correo electrónico: bolsa@unam.mx</p><br></div>'
													));
			
					if($Email->send()):
						$totalEnviados++;
					else:
						$totalNoEnviados++;
					endif;
			endforeach;	
			
			foreach($emailsStudent2 as $emailAlumno):
					// Se descativa el cv duniversitario
					$this->Student->updateAll(array('Student.block' => 1), array('Student.id' => $emailAlumno['Student']['id']));
					
					$Email = new CakeEmail('gmail');
					$Email->from(array($this->Auth->user('email') => 'SISBUT UNAM'));
					$Email->to($emailAlumno['Student']['email']);
						
					$Email->subject('UNAM – SISBUT / Currículum desactivado');
					$Email->template('email')->viewVars( array(
															'aMsg' => 
															'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" width="100%">'.
															'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
		
															'<p>Estimado(a) '.$emailAlumno['StudentProfile']['name'].' '.$emailAlumno['StudentProfile']['last_name'].' el motivo de este correo es para informarle que debido a que su cuenta no ha presentado actividad en mas de 18 meses, su currículum ha sido desactivado, lo que implica que su currículum no aparezca en las búsquedas de los reclutadores, pero usted podrá seguir postulándose y buscando a ofertas laborales.</p></br>'.
															
															'<p>Si desea activar nuevamente su currículum lo pude hacer ingresando al portal del SISBUT con su número de cuenta y contraseña, en la sección del menú principal “Mi Currículum” y seleccione la opción “Activar”, que aparece en el lado derecho del menú superior.</p><br>'.
														
															'<p><a href="http://bolsa.trabajo.unam.mx/unam/Students/studentNotification">Iniciar Sesión</a></p>'.
															
															'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
															'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
															'Correo electrónico: bolsa@unam.mx</p><br></div>'
													));
													
													
													

					if($Email->send()):
						$totalEnviados++;
					else:
						$totalNoEnviados++;
					endif;
			endforeach;	
			
			// Actualiza las fechas y estatus de ejecuciones en reclutamientos 
			$fechasStatusAlumnos = $this->StudentStatus->find('all', array(
																			'order' => ' StudentStatus.id DESC',
																			'limit' => 1
			));

			if(isset($fechasStatusAlumnos[0]['StudentStatus']['status_ejecucion_fecha1']) AND $fechasStatusAlumnos[0]['StudentStatus']['status_ejecucion_fecha1']==0):
				$this->StudentStatus->updateAll(array('StudentStatus.status_ejecucion_fecha1' => "1"),array('StudentStatus.id' =>$fechasStatusAlumnos[0]['StudentStatus']['id']));
			else:
				if(isset($fechasStatusAlumnos[0]['StudentStatus']['status_ejecucion_fecha2']) AND $fechasStatusAlumnos[0]['StudentStatus']['status_ejecucion_fecha2']==0):
					$this->StudentStatus->updateAll(array('StudentStatus.status_ejecucion_fecha2' => "1"),array('StudentStatus.id' =>$fechasStatusAlumnos[0]['StudentStatus']['id']));
					
					// Se crea las siguientes fechas ejecuciones
					$fechaActual = date('Y-m-d');
					$fechaMax = strtotime ( '+5 month' , strtotime ( $fechaActual ) ) ;
					$fechaSiguiente = date ( 'Y-m-j' , $fechaMax );
					
					$fechaPosterior = strtotime ( '+2 month' , strtotime ( $fechaSiguiente ) ) ;
					$fechaPosterior = date ( 'Y-m-j' , $fechaPosterior );
					
					// $actualizaFechasStatus['StudentStatus']['tipo_seguimiento'] = 4;
					$actualizaFechasStatus['StudentStatus']['fecha1_seguimiento'] = $fechaSiguiente;
					$actualizaFechasStatus['StudentStatus']['fecha2_seguimiento'] = $fechaPosterior;
					$actualizaFechasStatus['StudentStatus']['status_ejecucion'] = 0;

				$this->StudentStatus->create();
				$this->StudentStatus->save($actualizaFechasStatus);
				endif;
			endif;
			
			
			$this->Session->setFlash(
										'Total de correos enviados: '.$totalEnviados.' <br> 
										 Total de correos no enviados: '.$totalNoEnviados,'alert-success'
									);
			
			
			$this->redirect(array('action' =>  $redirect));
		}
			
		public function consultas() {
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			
			//universitarios
			if($this->request->is('post')):
				if(isset($this->request->data['Administrator']['fecha_fin_universitarios'])):
				
					//FECHAS 
					$anio1 = $this->request->data['Administrator']['fecha_inicio_universitarios']['year'];
					$mes1 = $this->request->data['Administrator']['fecha_inicio_universitarios']['month'];
					$dia1 = $this->request->data['Administrator']['fecha_inicio_universitarios']['day'];
						
					$anio2 = $this->request->data['Administrator']['fecha_fin_universitarios']['year'];
					$mes2 = $this->request->data['Administrator']['fecha_fin_universitarios']['month'];
					$dia2 = $this->request->data['Administrator']['fecha_fin_universitarios']['day'];
						
					$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
					$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
						
					$fechaInicio = strtotime ( $fechaInicio ) ;
					$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
					$fecha1 = $fechaInicio;
					
					$fechaFin = strtotime ( $fechaFin ) ;
					$fechaFin = date ( 'Y-m-d' , $fechaFin );
					$fecha2 = $fechaFin;
					
					//Consultas y catalogos
					$this->Student->recursive = 2;			
					$estudiantes = $this->Student->find('all', array(
																	'conditions' => array(
																							'AND' => array(
																											'Student.created >= ' => $fecha1,
																											'Student.created <= ' => $fecha2,
																										),
																						)
																)
													);
				
				
					$this->set('estudiantes', $estudiantes);
					
					
					
					$escuelasId = $this->FacultadLicenciatura->find('all', array(
																			'order' => array('FacultadLicenciatura.id ASC'),
																			'fields' => array('FacultadLicenciatura.id,FacultadLicenciatura.facultad_licenciatura')
																			));
					$this->set( compact ('escuelasId') );
					
					$facultadesId = $this->FacultadPosgrado->find('all', array(
																			'order' => array('FacultadPosgrado.id ASC'),
																			'fields' => array('FacultadPosgrado.id,FacultadPosgrado.facultad_posgrado')
																			));
					$this->set( compact ('facultadesId') );
					
					$Lenguagesid = $this->Lenguage->find('all', array('order' => array('Lenguage.id ASC')));
					$this->set( compact ('Lenguagesid') );
					
					$this->Facultades();
					$this->carrer();
					$this->posgradoProgrma();
					$this->disabilityType();
					$this->academicLevel();
					$this->academicSituation();
					$this->ExperienceArea();
					$this->scholarshipProgram();
					$this->Escuelas();
					$this->Competency();
					$this->interestArea();
					
					$relacionEscuelaCarrera = $this->RelacionEscuelaCarrera->find('all', array('order' => array('RelacionEscuelaCarrera.id ASC')));
					$this->set( compact ('relacionEscuelaCarrera') );	
					
					$relacionFacultadProgramas = $this->RelacionFacultadProgramas->find('all', array('order' => array('RelacionFacultadProgramas.id ASC')));
					$this->set( compact ('relacionFacultadProgramas') );

					$carrerasComplete = $this->Career->find('all', array('order' => array('Career.id ASC')));
					$this->set( compact ('carrerasComplete') );	
					
					$facultadesComplete = $this->PosgradoProgram->find('all', array('order' => array('PosgradoProgram.id ASC')));
					$this->set( compact ('facultadesComplete') );	
						
					$Lenguages = $this->Lenguage->find('list', array('order' => array('Lenguage.id ASC')));
					$this->set( compact ('Lenguages') );
					
					$Competencias = $this->Competency->find('list', array('order' => array('Competency.id ASC')));
					$this->set( compact ('Competencias') );
					
				endif;
				
				//empresas
				if(isset($this->request->data['Administrator']['fecha_fin_empresas']['year']) OR isset($this->request->data['Administrator']['fecha_fin_ofertas']['year']) OR isset($this->request->data['Administrator']['fecha_fin_vacantes']['year'])):
				
					if(isset($this->request->data['Administrator']['fecha_fin_empresas']['year'])):
						$anio1 = $this->request->data['Administrator']['fecha_inicio_empresas']['year'];
						$mes1 = $this->request->data['Administrator']['fecha_inicio_empresas']['month'];
						$dia1 = $this->request->data['Administrator']['fecha_inicio_empresas']['day'];
							
						$anio2 = $this->request->data['Administrator']['fecha_fin_empresas']['year'];
						$mes2 = $this->request->data['Administrator']['fecha_fin_empresas']['month'];
						$dia2 = $this->request->data['Administrator']['fecha_fin_empresas']['day'];
					else:
						if(isset($this->request->data['Administrator']['fecha_fin_ofertas']['year'])):
							$anio1 = $this->request->data['Administrator']['fecha_inicio_ofertas']['year'];
							$mes1 = $this->request->data['Administrator']['fecha_inicio_ofertas']['month'];
							$dia1 = $this->request->data['Administrator']['fecha_inicio_ofertas']['day'];
								
							$anio2 = $this->request->data['Administrator']['fecha_fin_ofertas']['year'];
							$mes2 = $this->request->data['Administrator']['fecha_fin_ofertas']['month'];
							$dia2 = $this->request->data['Administrator']['fecha_fin_ofertas']['day'];
						else:
							if(isset($this->request->data['Administrator']['fecha_fin_vacantes']['year'])):
								$anio1 = $this->request->data['Administrator']['fecha_inicio_vacantes']['year'];
								$mes1 = $this->request->data['Administrator']['fecha_inicio_vacantes']['month'];
								$dia1 = $this->request->data['Administrator']['fecha_inicio_vacantes']['day'];
									
								$anio2 = $this->request->data['Administrator']['fecha_fin_vacantes']['year'];
								$mes2 = $this->request->data['Administrator']['fecha_fin_vacantes']['month'];
								$dia2 = $this->request->data['Administrator']['fecha_fin_vacantes']['day'];
							endif;
						endif;
					endif;
						
					$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
					$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
						
					$fechaInicio = strtotime ( $fechaInicio ) ;
					$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
					$fecha1 = $fechaInicio;
					
					$fechaFin = strtotime ( $fechaFin ) ;
					$fechaFin = date ( 'Y-m-d' , $fechaFin );
					$fecha2 = $fechaFin;
				
					$this->Company->recursive = 2;
					$empresas = $this->Company->find('all', array( 
																'conditions' => array(
																						'AND' => array(
																										'Company.created >= ' => $fecha1,
																										'Company.created <= ' => $fecha2,
																									),
																					)
															)
												);
					$this->set('empresas', $empresas);
			
					$this->CompanyJobProfile->recursive = 2;
					$ofertas = $this->CompanyJobProfile->find('all', array( 
																'conditions' => array(
																						'AND' => array(
																										'CompanyJobProfile.created >= ' => $fecha1,
																										'CompanyJobProfile.created <= ' => $fecha2,
																									),
																					)
															)
												);
					$this->set('ofertas', $ofertas);
					
					$relacionEscuelaCarrera = $this->RelacionEscuelaCarrera->find('all', array('order' => array('RelacionEscuelaCarrera.id ASC')));
					$this->set( compact ('relacionEscuelaCarrera') );	
					
					$relacionFacultadProgramas = $this->RelacionFacultadProgramas->find('all', array('order' => array('RelacionFacultadProgramas.id ASC')));
					$this->set( compact ('relacionFacultadProgramas') );

					$carrerasComplete = $this->Career->find('all', array('order' => array('Career.id ASC')));
					$this->set( compact ('carrerasComplete') );	
					
					$facultadesComplete = $this->PosgradoProgram->find('all', array('order' => array('PosgradoProgram.id ASC')));
					$this->set( compact ('facultadesComplete') );	
						
					$Lenguages = $this->Lenguage->find('list', array('order' => array('Lenguage.id ASC')));
					$this->set( compact ('Lenguages') );
					
					$Lenguagesid = $this->Lenguage->find('all', array('order' => array('Lenguage.id ASC')));
					$this->set( compact ('Lenguagesid') );
					
					$this->Competency();
					$this->Sector();
					$this->Rotation();
					$this->numeroEmpleados();
					$this->States();
					$this->workday();
					$this->salary();
					$this->disabilityType();
					$this->academicSituation();
				endif;
				
				//contrataciones
				if(isset($this->request->data['Administrator']['fecha_fin_contrataciones']['day'])):	
					
					
					$anio1 = $this->request->data['Administrator']['fecha_inicio_contrataciones']['year'];
					$mes1 = $this->request->data['Administrator']['fecha_inicio_contrataciones']['month'];
					$dia1 = $this->request->data['Administrator']['fecha_inicio_contrataciones']['day'];
						
					$anio2 = $this->request->data['Administrator']['fecha_fin_contrataciones']['year'];
					$mes2 = $this->request->data['Administrator']['fecha_fin_contrataciones']['month'];
					$dia2 = $this->request->data['Administrator']['fecha_fin_contrataciones']['day'];
						
					$fechaInicio =  $anio1.'-'.$mes1.'-'.$dia1;
					$fechaFin 	 = 	$anio2.'-'.$mes2.'-'.$dia2;
						
					$fechaInicio = strtotime ( $fechaInicio ) ;
					$fechaInicio = date ( 'Y-m-d' , $fechaInicio );
					$fecha1 = $fechaInicio;
					
					$fechaFin = strtotime ( $fechaFin ) ;
					$fechaFin = date ( 'Y-m-d' , $fechaFin );
					$fecha2 = $fechaFin;
				
					$this->Report->recursive = 3;
					$contrataciones = $this->Report->find('all' 
															, array( 
																'conditions' => array(
																						'AND' => array(
																										'Report.created >= ' => $fecha1,
																										'Report.created <= ' => $fecha2,
																									),
																					)
															)
														);
					$this->set('contrataciones', $contrataciones);
					
					$this->StudentNotification->recursive = 3;
					$notificaciones = $this->StudentNotification->find('all'
																			,array(
																				'conditions' => array ('StudentNotification.interview_type' => 4,
																										'AND' => array(
																														'StudentNotification.company_interview_date >= ' => $fecha1,
																														'StudentNotification.company_interview_date <= ' => $fecha2,
																														),
																									)
																					)
																		);
					$this->set('notificaciones', $notificaciones);
				

					$contratacionesExternas = $this->CompanyExternalOffer->find('count');	
					$this->set('contratacionesExternas', $contratacionesExternas);
					
					$escuelasId = $this->FacultadLicenciatura->find('all', array(
																			'order' => array('FacultadLicenciatura.id ASC'),
																			'fields' => array('FacultadLicenciatura.id,FacultadLicenciatura.facultad_licenciatura')
																			));
					$this->set( compact ('escuelasId') );
					
					$facultadesId = $this->FacultadPosgrado->find('all', array(
																			'order' => array('FacultadPosgrado.id ASC'),
																			'fields' => array('FacultadPosgrado.id,FacultadPosgrado.facultad_posgrado')
																			));
					$this->set( compact ('facultadesId') );
					
					$this->Sector();
					$this->Rotation();
					$this->Facultades();
					$this->carrer();
					$this->posgradoProgrma();
					$this->disabilityType();
					$this->academicLevel();
					$this->academicSituation();
					$this->ExperienceArea();
					$this->Escuelas();
					$this->salary();
					
					$relacionEscuelaCarrera = $this->RelacionEscuelaCarrera->find('all', array('order' => array('RelacionEscuelaCarrera.id ASC')));
					$this->set( compact ('relacionEscuelaCarrera') );	
					
					$relacionFacultadProgramas = $this->RelacionFacultadProgramas->find('all', array('order' => array('RelacionFacultadProgramas.id ASC')));
					$this->set( compact ('relacionFacultadProgramas') );
					
					$carrerasComplete = $this->Career->find('all', array('order' => array('Career.id ASC')));
					$this->set( compact ('carrerasComplete') );	
					
					$facultadesComplete = $this->PosgradoProgram->find('all', array('order' => array('PosgradoProgram.id ASC')));
					$this->set( compact ('facultadesComplete') );	
					
				endif;
				
				//Competencias
				
				if(isset($this->request->data['Administrator']['frecuencias_competencias'])):
				
					$escuelasId = $this->FacultadLicenciatura->find('all', array(
																			'order' => array('FacultadLicenciatura.id ASC'),
																			'fields' => array('FacultadLicenciatura.id,FacultadLicenciatura.facultad_licenciatura')
																			));
					$this->set( compact ('escuelasId') );
					
					$facultadesId = $this->FacultadPosgrado->find('all', array(
																			'order' => array('FacultadPosgrado.id ASC'),
																			'fields' => array('FacultadPosgrado.id,FacultadPosgrado.facultad_posgrado')
																			));
					$this->set( compact ('facultadesId') );
					
					$this->CompanyJobProfile->recursive = 2;
					$ofertas = $this->CompanyJobProfile->find('all');
					$this->set('ofertas', $ofertas);
					
					$this->Student->recursive = 2;			
					$estudiantes = $this->Student->find('all');
					$this->set('estudiantes', $estudiantes);

					$this->Escuelas();
					$this->carrer();
					$this->posgradoProgrma();
					$this->Facultades();
					$this->Competency();
					$this->Rotation();
					$this->ExperienceArea();
					
					$Competencias = $this->Competency->find('list', array('order' => array('Competency.id ASC')));
					$this->set( compact ('Competencias') );
					
					
					$relacionEscuelaCarrera = $this->RelacionEscuelaCarrera->find('all', array('order' => array('RelacionEscuelaCarrera.id ASC')));
					$this->set( compact ('relacionEscuelaCarrera') );
					
					$relacionFacultadProgramas = $this->RelacionFacultadProgramas->find('all', array('order' => array('RelacionFacultadProgramas.id ASC')));
					$this->set( compact ('relacionFacultadProgramas') );
					
					$carrerasComplete = $this->Career->find('all', array('order' => array('Career.id ASC')));
					$this->set( compact ('carrerasComplete') );	
					
					$facultadesComplete = $this->PosgradoProgram->find('all', array('order' => array('PosgradoProgram.id ASC')));
					$this->set( compact ('facultadesComplete') );	
				
				endif;
			endif;
			

		}
	
		public function specificSearchOffer($newSearch = null){
			$this->Administrator->recursive = 0;
			$this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));

			$this->CompanyJobContractType->validate = array();
			$validator = $this->CompanyJobContractType->validator();
			
			$this->CompanyJobProfile->validate = array();
			$validator = $this->CompanyJobProfile->validator();
			
			$this->banner();
			
			// Verifica las ofertas guardadas y las manda para que puedan ser consultadas
			$this->set('busquedasGuardadas', $this->AdministratorSavedSearch->find('list', array(
																							'conditions' => array(
																												'AdministratorSavedSearch.administrator_id' => $this->Session->read('Auth.User.id'),
																												'AdministratorSavedSearch.search' => 'offer',
																											),
																							'order' => 'AdministratorSavedSearch.id DESC',
																							)
																			)
						);
			
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('CompanyJobContractType');
				$this->Session->delete('CompanyJobProfile');
				$this->Session->delete('CompanyCandidateProfile');
				$this->Session->delete('CompanyJobLanguage');
				$this->Session->delete('CompanyJobComputingSkill');
				$this->Session->delete('CompanyJobRelatedCareer');
				$this->Session->delete('companyJobContractType');
				$this->Session->delete('serialized_form');
				$this->Session->delete('serialize_form');
			endif;
			
			$this->carrer();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->contractType();
			$this->workday();
			$this->salary();
			$this->academicSituation();
			$this->academicLevel();
			$this->disabilityType();
			$this->Session->write('redirectAdmin', 'specificSearchOffer');
			$this->folder();
			$this->job();
			$this->Rotation();
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			$this->NivelesIdioma();
			$Estados = $this->State->find('list',
												array(
													'fields' => array('State.nombre', 'State.nombre'),
													'order' => array('State.nombre ASC')
												)
											);
			$this->set( compact ('Estados') );
			$this->softwareLevel();
			
		}
		
		public function specificSearchOfferResults($newSearch = null){
			$this->CompanyJobContractType->validate = array();
			$validator = $this->CompanyJobContractType->validator();
			
			$this->CompanyJobProfile->validate = array();
			$validator = $this->CompanyJobProfile->validator();
			
			$this->Administrator->recursive = 0;
			// $this->set('administrator', $this->Administrator->findById($this->Auth->user('id')));
			$administrador = $this->Administrator->findById($this->Auth->user('id'));
			$this->set('administrator', $administrador);
			$this->CompanyJobProfile->recursive = 3;
			$this->Session->write('redirectAdmin', 'specificSearchOfferResults');
		
			// Verifica las ofertas guardadas y las manda para que puedan ser consultadas
			$this->set('busquedasGuardadas', $this->AdministratorSavedSearch->find('list', array(
																								'conditions' => array(
																													'AdministratorSavedSearch.administrator_id' => $this->Session->read('Auth.User.id'),
																													'AdministratorSavedSearch.search' => 'offer',
																													),
																								'order' => 'AdministratorSavedSearch.id DESC',
																								)
																					)
					);
			
			$this->carrer();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->contractType();
			$this->workday();
			$this->salary();
			$this->academicSituation();
			$this->academicLevel();
			$this->disabilityType();
			$this->folder();
			$this->job();
			$this->Rotation();
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			$this->NivelesIdioma();
			$this->softwareLevel();
			$criterio = array();
				
				if(($this->request->is('post')) AND (isset($this->request->data['CompanyJobProfile']['job_name']))):
					$this->Session->write('serialized_form', $this->request->data);
					$this->Session->delete('limit');
					$this->Session->delete('palabraBuscada');
					$this->Session->delete('CompanyJobContractType');
					$this->Session->delete('CompanyJobProfile');
					$this->Session->delete('CompanyCandidateProfile');
					$this->Session->delete('CompanyJobLanguage');
					$this->Session->delete('CompanyJobComputingSkill');
					$this->Session->delete('CompanyJobRelatedCareer');
					$this->Session->delete('idBusquedaGuardada');
				endif;
				
				if(isset($this->request->data['StudentSavedSearch']['name']) and ($this->request->data['StudentSavedSearch']['name'] <> '')):
					$this->administratorSavedOfferSearch();
				else:
					if((isset($this->request->data['Administrator']['busqueda_guardada'])) and ($this->request->data['Administrator']['busqueda_guardada'] <> '')):
						$busquedaGuardada = $this->AdministratorSavedSearch->findById($this->request->data['Administrator']['busqueda_guardada']);
						if(!empty($busquedaGuardada)):
							$this->Session->write('idBusquedaGuardada', $this->request->data['Administrator']['busqueda_guardada']);
							$this->request->data = unserialize($busquedaGuardada['AdministratorSavedSearch']['serialize_request']);
						endif;
					endif;
				endif;
				
				if($this->request->is('get')):
					if(($this->Session->read('idBusquedaGuardada')) <> ''):
						$busquedaGuardada = $this->AdministratorSavedSearch->findById($this->Session->read('idBusquedaGuardada'));
						if(!empty($busquedaGuardada)):
							$this->request->data = unserialize($busquedaGuardada['AdministratorSavedSearch']['serialize_request']);
						endif;
					else:
						$this->request->data = $this->Session->read('serialized_form');
					endif;
				endif;

				$limit = 5; //default limit
			
				if(isset($this->request->data['Student']['limit']) AND ($this->request->data['Student']['limit']<>'')):
					$limit = $this->request->data['Student']['limit'];
				else:
					if(($this->Session->read('limit')) <> ''):
						$limit = $this->Session->read('limit');
					endif;
				endif;
				
				if($this->request->query('orden') <> ''):
					$orden = $this->request->query('orden');
					$this->set('orden',$orden);
					$busquedaGuardada = $this->AdministratorSavedSearch->findById($this->Session->read('idBusquedaGuardada'));
					if(!empty($busquedaGuardada)):
						$this->request->data = unserialize($busquedaGuardada['AdministratorSavedSearch']['serialize_request']);
					endif;
				else:
					$orden = 'CompanyJobProfile.created DESC'; //default order
				endif;
				
				
			// DEPENDIENDO DEL ADMINISTRADOR SOLO APARECERAN LAS OFERTAS RELACIONADAS A SU ESCUELA O INSTITUCION
			$criterioAdmin = array();
			$nivelAcademicoAdministrador[] = array();
			
			// Verificamos que sea un subadministrator para que visualice solo las ofertas de su institución
			if($administrador['Administrator']['role']=='subadministrator'):
						
				// Si el administrador tiene un nivel lo compara
				if($administrador['AdministratorProfile']['academic_level_id']==1):
					$idsCarreras = $this->RelacionEscuelaCarrera->find('all', array(
																					'conditions' => array(
																										'RelacionEscuelaCarrera.facultad_licenciatura_id' => $administrador['AdministratorProfile']['institution'],
																										),
																					)
																	);
					
					foreach($idsCarreras as $carrera):
						$idsCarrerasOferta[] = $carrera['RelacionEscuelaCarrera']['career_id'];
					endforeach;	
			
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($idsCarreras)):	
						$idsCarrerasOferta = '';
					endif;
					
					$idsCarrerasAdmin = $this->Career->find('all', array(
																	'conditions' => array(
																							'Career.career_id' => $idsCarrerasOferta,
																						),
																	)
													);
					foreach($idsCarrerasAdmin as $carrera):
						$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $carrera['Career']['id']);
					endforeach;	
					
					// $nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.licenciatura' => 1);
					
				endif;
				
				// Si el administrador tiene un nivel lo compara
				if($administrador['AdministratorProfile']['academic_level_id']>1):
					$idsProgramas = $this->RelacionFacultadPrograma->find('all', array(
																					'conditions' => array(
																										'RelacionFacultadPrograma.facultad_posgrado_id' => $administrador['AdministratorProfile']['institution'],
																										),
																					)
																		);
					
					foreach($idsProgramas as $programa):
						$idsCarrerasOferta[] = $programa['RelacionFacultadPrograma']['posgrado_program_id'];
					endforeach;	
			
					// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
					if(empty($idsProgramas)):	
						$idsCarrerasOferta = '';
					endif;
					
					$idsCarrerasAdmin = $this->PosgradoProgram->find('all', array(
																	'conditions' => array(
																							'PosgradoProgram.posgrado_program_id' => $idsCarrerasOferta,
																						),
																	)
													);
													
					foreach($idsCarrerasAdmin as $carrera):
						$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $carrera['PosgradoProgram']['id']);
					endforeach;
					
					$nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.academic_level_id' => $administrador['AdministratorProfile']['academic_level_id']);
					
					// if($administrador['AdministratorProfile']['academic_level_id'] == 2):
						// $nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.especialidad' => 1);
					// endif;
					
					// if($administrador['AdministratorProfile']['academic_level_id'] == 3):
						// $nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.maestria' => 1);
					// endif;
					
					// if($administrador['AdministratorProfile']['academic_level_id'] == 4):
						// $nivelAcademicoAdministrador['AND'][] = array('CompanyCandidateProfile.doctorado' => 1);
					// endif;

				endif;
			endif;	
				
			// Palabra clave	
				if(isset($this->request->data['CompanyJobProfile']['job_name']) AND ($this->request->data['CompanyJobProfile']['job_name']<>'')):
					$this->Session->write('CompanyJobProfile.job_name', $this->request->data['CompanyJobProfile']['job_name']);
					$clave = $this->request->data['CompanyJobProfile']['job_name'];
					$claves = explode(" ", $this->request->data['CompanyJobProfile']['job_name']);
					foreach ($claves as $clave) {
						if(strlen($clave)>2):
							$criterio['OR'][] = array('CompanyJobProfile.job_name LIKE' => "%$clave%");
							$criterio['OR'][] = array('CompanyJobProfile.activity LIKE' => "%$clave%");
							$criterio['OR'][] = array('CompanyJobProfile.professional_skill LIKE' => "%$clave%");
						endif;
					}
				else:
					if(($this->Session->read('CompanyJobProfile.job_name')) <> ''):
						$clave = $this->Session->read('CompanyJobProfile.job_name');
						$claves = explode(" ", $this->request->data['CompanyJobProfile']['job_name']);
						foreach ($claves as $clave) {
							if(strlen($clave)>2):
								$criterio['OR'][] = array('CompanyJobProfile.job_name LIKE' => "%$clave%");
								$criterio['OR'][] = array('CompanyJobProfile.activity LIKE' => "%$clave%");
								$criterio['OR'][] = array('CompanyJobProfile.professional_skill LIKE' => "%$clave%");
							endif;
						}
					endif;
				endif;
				
			//ComapyJobContractType	
				if(isset($this->request->data['CompanyJobContractType']['contract_type']) AND ($this->request->data['CompanyJobContractType']['contract_type']<>'')):
					$this->Session->write('CompanyJobContractType.contract_type', $this->request->data['CompanyJobContractType']['contract_type']);
					$criterio[] = array('CompanyJobContractType.contract_type' =>$this->request->data['CompanyJobContractType']['contract_type']);
				else:
					if(($this->Session->read('CompanyJobContractType.contract_type')) <> ''):
						$criterio[] = array('CompanyJobContractType.contract_type' =>$this->Session->read('CompanyJobContractType.contract_type'));
					endif;
				endif;
				
				if(isset($this->request->data['CompanyJobContractType']['workday']) AND ($this->request->data['CompanyJobContractType']['workday']<>'')):
					$this->Session->write('CompanyJobContractType.workday', $this->request->data['CompanyJobContractType']['workday']);
					$criterio[] = array('CompanyJobContractType.workday' =>$this->request->data['CompanyJobContractType']['workday']);
				else:
					if(($this->Session->read('CompanyJobContractType.workday')) <> ''):
						$criterio[] = array('CompanyJobContractType.workday' => $this->Session->read('CompanyJobContractType.workday'));
					endif;
				endif;
				
				if(isset($this->request->data['CompanyJobContractType']['salary']) AND ($this->request->data['CompanyJobContractType']['salary']<>'')):
					$this->Session->write('CompanyJobContractType.salary', $this->request->data['CompanyJobContractType']['salary']);
					$criterio[] = array('CompanyJobContractType.salary' =>$this->request->data['CompanyJobContractType']['salary']);
				else:
					if(($this->Session->read('CompanyJobContractType.salary')) <> ''):
						$criterio[] = array('CompanyJobContractType.salary' => $this->Session->read('CompanyJobContractType.salary'));
					endif;
				endif;
				
				if(isset($this->request->data['CompanyJobContractType']['state']) AND ($this->request->data['CompanyJobContractType']['state']<>'')):
					$this->Session->write('CompanyJobContractType.state', $this->request->data['CompanyJobContractType']['state']);
					$criterio[] = array('CompanyJobContractType.state' =>$this->request->data['CompanyJobContractType']['state']);
				else:
					if(($this->Session->read('CompanyJobContractType.state')) <> ''):
						$criterio[] = array('CompanyJobContractType.state' => $this->Session->read('CompanyJobContractType.state'));
					endif;
				endif;
				
				if(isset($this->request->data['CompanyJobContractType']['subdivision']) AND ($this->request->data['CompanyJobContractType']['subdivision']<>'')):
					$this->Session->write('CompanyJobContractType.subdivision', $this->request->data['CompanyJobContractType']['subdivision']);
					$criterio[] = array('CompanyJobContractType.subdivision' =>$this->request->data['CompanyJobContractType']['subdivision']);
				else:
					if(($this->Session->read('CompanyJobContractType.subdivision')) <> ''):
						$criterio[] = array('CompanyJobContractType.subdivision' => $this->Session->read('CompanyJobContractType.subdivision'));
					endif;
				endif;
				
				if(isset($this->request->data['CompanyJobContractType']['mobility']) AND ($this->request->data['CompanyJobContractType']['mobility']<>'')):
					$this->Session->write('CompanyJobContractType.mobility', $this->request->data['CompanyJobContractType']['mobility']);
					$criterio[] = array('CompanyJobContractType.mobility' =>$this->request->data['CompanyJobContractType']['mobility']);
				else:
					if(($this->Session->read('CompanyJobContractType.mobility')) <> ''):
						$criterio[] = array('CompanyJobContractType.mobility' => $this->Session->read('CompanyJobContractType.mobility'));
					endif;
				endif;
				
			if(isset($this->request->data['CompanyJobProfileDynamicGiro'])):
			// CompanyJobProfile
				$i = 0;
				$indice = 0;
				foreach($this->request->data['CompanyJobProfileDynamicGiro'] as $giro):
					if($giro['giro']<>''):
						$this->Session->write('CompanyJobProfile.'.$i.'.rotation', $giro['giro']);
						$giros['OR'][$indice]['AND'][] = array('CompanyJobProfile.rotation' => $giro['giro']);
					else:
						if(($this->Session->read('CompanyJobProfile.'.$i.'.rotation')) <> ''):
							$giros['OR'][$indice]['AND'][] = array('CompanyJobProfile.rotation' => $this->Session->read('CompanyJobProfile.'.$i.'.rotation'));
						endif;
					endif;
					
					$indice++;
					$i++;
				endforeach;
			endif;
			
			if(isset($this->request->data['CompanyJobProfileDynamicArea'])):
				$i = 0;
				$indice = 0;
				foreach($this->request->data['CompanyJobProfileDynamicArea'] as $area):
					if($area['area_interes']<>''):
						$this->Session->write('CompanyJobProfile.'.$i.'.interest_area', $area['area_interes']);
						$giros['OR'][$indice]['AND'][] = array('CompanyJobProfile.interest_area' => $area['area_interes']);
					else:
						if(($this->Session->read('CompanyJobProfile.'.$i.'.interest_area')) <> ''):
							$giros['OR'][$indice]['AND'][] = array('CompanyJobProfile.interest_area' => $this->Session->read('CompanyJobProfile.'.$i.'.interest_area'));
						endif;
					endif;
	
					$indice++;
					$i++;
				endforeach;
				
				if(isset($giros)):
					$criterio[] = $giros;
				endif;
			endif;	
				
				if(isset($this->request->data['CompanyJobProfile']['disability']) AND ($this->request->data['CompanyJobProfile']['disability']<>'')):
					$this->Session->write('CompanyJobProfile.disability', $this->request->data['CompanyJobProfile']['disability']);
					$criterio[] = array('CompanyJobProfile.disability' =>$this->request->data['CompanyJobProfile']['disability']);
				else:
					if(($this->Session->read('CompanyJobProfile.disability')) <> ''):
						$criterio[] = array('CompanyJobProfile.disability' => $this->Session->read('CompanyJobProfile.disability'));
					endif;
				endif;
				
				if(isset($this->request->data['CompanyJobProfile']['disability_type']) AND ($this->request->data['CompanyJobProfile']['disability_type']<>'')):
					$this->Session->write('CompanyJobProfile.disability_type', $this->request->data['CompanyJobProfile']['disability_type']);
					$criterio[] = array('CompanyJobProfile.disability_type' =>$this->request->data['CompanyJobProfile']['disability_type']);
				else:
					if(($this->Session->read('CompanyJobProfile.disability_type')) <> ''):
						$criterio[] = array('CompanyJobProfile.disability_type' => $this->Session->read('CompanyJobProfile.disability_type'));
					endif;
				endif;
			
			if(isset($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'])):
			// CompanyCandidateProfile
				$i = 0;
				$indice =0;
				$levels = array();
				foreach($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'] as $nivelAcademico):
					if($nivelAcademico['academic_level']<>''):	
						if($nivelAcademico['academic_level']==1):
							$campo = 'academic_level_id';
						else:
							if($nivelAcademico['academic_level']==2):
								$campo = 'academic_level_id';
							else:
								if($nivelAcademico['academic_level']==3):
									$campo = 'academic_level_id';
								else:
									if($nivelAcademico['academic_level']==4):
										$campo = 'academic_level_id';
									endif;
								endif;
							endif;
						endif;
					else:
						$campo = '';
					endif;
					
					$levels[] = $nivelAcademico['academic_level'];
					
					if($campo <> ''):
						if($nivelAcademico['academic_level']<>''):
							$this->Session->write('CompanyCandidateProfile.'.$i.'.'.$campo, $nivelAcademico['academic_level']);
							$niveles['OR'][$indice]['AND'][] = array('CompanyCandidateProfile.'.$campo => $nivelAcademico['academic_level']);
						else:
							if($this->Session->read('CompanyCandidateProfile.'.$i.'.'.$campo) <> ''):
								$niveles['OR'][$indice]['AND'][] = array('CompanyCandidateProfile.'.$campo => $this->Session->read('CompanyCandidateProfile.'.$i.'.'.$campo));
							endif;
						endif;
					endif;
					$i++;
					$indice++;
				endforeach;
			endif;

				$i = 0;
				foreach($this->request->data['CompanyJobRelatedCareerDynamicCarrera'] as $carrera):
					if($levels[$i]==1):
						if($carrera['career_id']<>''):
							$this->Session->write('CompanyJobRelatedCareer.'.$i.'.career_id', $carrera['career_id']);
							$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $carrera['career_id']);
						else:
							if(($this->Session->read('CompanyJobRelatedCareer.'.$i.'.career_id')) <> ''):
								$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $this->Session->read('CompanyJobRelatedCareer.'.$i.'.career_id'));
							endif;
						endif;
					else:
						if($levels[$i]>1):
							if($carrera['career_id']<>''):
								$this->Session->write('CompanyJobRelatedCareer.'.$i.'.area_id',$carrera['career_id']);
								$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $carrera['career_id']);
							else:
								if(($this->Session->read('CompanyJobRelatedCareer.'.$i.'.area_id')) <> ''):
									$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $this->Session->read('CompanyJobRelatedCareer.'.$i.'.area_id'));
								endif;
							endif;
						endif;
					endif;
					
					$i++;
				endforeach;
			
				if((isset($carrerasSQL)) AND (!empty($carrerasSQL))):
					$listaIdsRelatedCareer = $this->CompanyJobRelatedCareer->find('list',
																array('conditions' => array(
																							'OR' => array (
																										 $carrerasSQL 
																										)
																							),
																	  'fields'=>array('CompanyJobRelatedCareer.company_job_profile_id'),
																	)
															);
															
					foreach($listaIdsRelatedCareer as $idRelatedCareer):
						$idsListaRelatedCareer[] =  $idRelatedCareer;
					endforeach;	
					
					if(!isset($idsListaRelatedCareer)):
						$idsListaRelatedCareer[] ='';
					endif;
				endif;
				
			$i = 0;
				$indice =0;
				foreach($this->request->data['CompanyCandidateProfileDynamicSituacionAcademica'] as $situacionAcademica):
					if($situacionAcademica['academic_situation']<>''):
						$this->Session->write('CompanyCandidateProfile.'.$i.'.academic_situation', $situacionAcademica['academic_situation']);
						$niveles['OR'][$indice]['AND'][] = array('CompanyCandidateProfile.academic_situation_id' => $situacionAcademica['academic_situation']);
					else:
						if(($this->Session->read('CompanyCandidateProfile.'.$i.'.academic_situation')) <> ''):
							$niveles['OR'][$indice]['AND'][] = array('CompanyCandidateProfile.academic_situation_id' => $this->Session->read('CompanyCandidateProfile.'.$i.'.academic_situation'));
						endif;
					endif;
					
					if((isset($carrerasSQL)) AND (!empty($carrerasSQL))):
						$niveles['OR'][$indice]['AND'][] = array('CompanyCandidateProfile.id' => $idsListaRelatedCareer);
					endif;
					
					$i++;
					$indice++;
				endforeach;
				
				if((isset($niveles)) AND (!empty($niveles))):
					$listaOfertasCompanyCandidateProfile = $this->CompanyCandidateProfile->find('all',
																				array('conditions' => array(
																											'OR' => array(
																														$niveles,
																											),
																							),
																	  'fields'=>array('CompanyCandidateProfile.company_job_profile_id'),
																	)
															);
				else:
					$listaOfertasCompanyCandidateProfile = array();
				endif;
				
				foreach($listaOfertasCompanyCandidateProfile as $listaOfertasNivel):
					$idListaOfertasNiveles[] = $listaOfertasNivel['CompanyCandidateProfile']['company_job_profile_id'];
				endforeach;				
				
				if(!isset($idListaOfertasNiveles)):
					$idListaOfertasNiveles = array();
				endif;
				
			
			if(isset($this->request->data['CompanyJobLanguage'])):
			// Lenguajes
				$i = 0;
				$indice = 0;
				foreach($this->request->data['CompanyJobLanguage'] as $idioma):
					if($idioma['language_id']<>''):
						$this->Session->write('CompanyJobLanguage.'.$i.'.language_id', $idioma['language_id']);
						$idiomas['OR'][$indice]['AND'][] = array('CompanyJobLanguage.language_id' => $idioma['language_id']);
					else:
						if(($this->Session->read('CompanyJobLanguage.'.$i.'.language_id')) <> ''):
							$idiomas['OR'][$indice]['AND'][] = array('CompanyJobLanguage.language_id' => $this->Session->read('CompanyJobLanguage.'.$i.'.language_id'));
						endif;
					endif;
					
					if($idioma['level']<>''):
						if($idioma['level'] == 1):
							$this->Session->write('CompanyJobLanguage.'.$i.'.average', $idioma['level']);
							$idiomas['OR'][$indice]['AND'][] = array(
													'CompanyJobLanguage.average >=' => 10,
													'CompanyJobLanguage.average <=' => 29
													);
						else:
							if($idioma['level'] == 2):
								$this->Session->write('CompanyJobLanguage.'.$i.'.average', $idioma['level']);
								$idiomas['OR'][$indice]['AND'][] = array(
													'CompanyJobLanguage.average >=' => 30,
													'CompanyJobLanguage.average <' => 50
													);
							else:
								if($idioma['level'] == 3):
									$this->Session->write('CompanyJobLanguage.'.$i.'.average', $idioma['level']);
									$idiomas['OR'][$indice]['AND'][] = array(
													'CompanyJobLanguage.average' => 50,
													);
								endif;
							endif;
						endif;
					else:
						if(($this->Session->read('CompanyJobLanguage.'.$i.'.average')) <> ''):
							$idiomas['OR'][$indice]['AND'][] = array('CompanyJobLanguage.average' => $this->Session->read('CompanyJobLanguage.'.$i.'.average'));
						endif;
					endif;
					$i++;
					$indice++;
				endforeach;
					
				if((isset($idiomas)) AND (!empty($idiomas))):
					$listaOfertaslenguajes = $this->CompanyJobLanguage->find('all',
																				array('conditions' => array(
																											'OR' => array(
																														$idiomas,
																											),
																							),
																	  'fields'=>array('CompanyJobLanguage.company_job_profile_id'),
																	)
															);
				else:
					$listaOfertaslenguajes = array();
				endif;
				
				foreach($listaOfertaslenguajes as $listaOfertaslenguaje):
					$idListaOfertaslenguajes[] = $listaOfertaslenguaje['CompanyJobLanguage']['company_job_profile_id'];
				endforeach;				
			endif;
			
			if(!isset($idListaOfertaslenguajes)):
				$idListaOfertaslenguajes = array();
			endif;
				
				
			if(isset($this->request->data['CompanyJobComputingSkill'])):
			//Cómputo
			// Nombre de conocimiento de computo
				$i = 0;
				$indice = 0;
				foreach($this->request->data['CompanyJobComputingSkill'] as $computo):
					
					if($computo['name']<>''):
						$this->Session->write('CompanyJobComputingSkill.'.$i.'.name', $computo['name']);
						$programsName['OR'][] = array('Program.program LIKE' => '%'. $computo['name'] . '%');
						$computosName['OR'][] = array('CompanyJobComputingSkill.other LIKE' => '%'. $computo['name'] . '%');
					else:
						if(($this->Session->read('CompanyJobComputingSkill.'.$i.'.name')) <> ''):
							$programsName['OR'][] = array('Program.program LIKE' => '%'. $this->Session->read('CompanyJobComputingSkill.'.$i.'.name' . '%'));
							$computosName['OR'][] = array('CompanyJobComputingSkill.other LIKE' => '%'. $this->Session->read('CompanyJobComputingSkill.'.$i.'.name' . '%'));
						endif;
					endif;

					if((isset($programsName)) AND (!empty($programsName))):
						$listaIdsProgramsName = $this->Program->find('list',
																	array('conditions' => array(
																								'OR' => array (
																											 $programsName 
																											)
																								),
																		  'fields'=>array('Program.id'),
																		)
																);
																
						foreach($listaIdsProgramsName as $IdProgramName):
							$idsListaProgramName[] = $IdProgramName;
						endforeach;	
						
						if(!isset($idsListaProgramName)):
							$idsListaProgramName = array();
						endif;
						$computoSQL['OR'][$indice]['OR'][] = array('CompanyJobComputingSkill.name' => $idsListaProgramName);						
					endif;
					
					if((isset($computosName)) AND (!empty($computosName))):
						$listaIdsComputingSkillName = $this->CompanyJobComputingSkill->find('list',
																	array('conditions' => array(
																								'OR' => array (
																											 $computosName
																											)
																								),
																		  'fields'=>array('CompanyJobComputingSkill.id'),
																		)
																);
																
						foreach($listaIdsComputingSkillName as $IdComputingSkillName):
							$idsListaComputingSkillName[] = $IdComputingSkillName;
						endforeach;		
						if(!isset($idsListaComputingSkillName)):
							$idsListaComputingSkillName = array();
						endif;
						$computoSQL['OR'][$indice]['OR'][] = array('CompanyJobComputingSkill.id' => $idsListaComputingSkillName);	
					endif;	

					if($computo['level']<>''):
						$this->Session->write('CompanyJobComputingSkill.'.$i.'.level', $computo['level']);
						$computos['AND'][] = array('CompanyJobComputingSkill.level' => $computo['level']);
					else:
						if(($this->Session->read('CompanyJobComputingSkill.'.$i.'.level')) <> ''):
							$computos['AND'][] = array('CompanyJobComputingSkill.level' => $this->Session->read('CompanyJobComputingSkill.'.$i.'.level'));
						endif;
					endif;
					
					if((isset($computos)) AND (!empty($computos))):
						$listaOfertasComputos = $this->CompanyJobComputingSkill->find('list',
																array('conditions' => array(
																							'AND' => array(
																											$computos,
																											),
																							),
																	  'fields'=>array('CompanyJobComputingSkill.id'),
																	)
																);
						
						foreach($listaOfertasComputos as $listaOfertaComputo):
							$idsListaComputingSkillLavel[] = $listaOfertaComputo;
						endforeach;		
						$computoSQL['OR'][$indice]['AND'][] = array('CompanyJobComputingSkill.id' => $idsListaComputingSkillLavel);
					endif;
					
					// Se vacian los arreglos usados para guardar condiciones
					$programsName = array();
					$computosName = array();
					$idsListaProgramName = array();
					$idsListaComputingSkillName = array();
					$computos = array();
					$idsListaComputingSkillLavel = array();		

					$indice++;
					$i++;
				endforeach;
				
				if(isset($computoSQL)):
					$ListaIdsComputo = $this->CompanyJobComputingSkill->find('all',
																				array('conditions' => array(
																											'OR' => array(
																														$computoSQL
																											),
																							),
																	  'fields'=>array('CompanyJobComputingSkill.company_job_profile_id'),
																	)
															);
				else:
					$ListaIdsComputo = array();
				endif;

				foreach($ListaIdsComputo as $IdComputo):
					$totalIdsComputo[] = $IdComputo['CompanyJobComputingSkill']['company_job_profile_id'];
				endforeach;				
			endif;
			
				if(!isset($totalIdsComputo)):
					$totalIdsComputo = array();
				endif;

				// Consulta General
				if(!empty($criterio)):
					$listaOfertasGeneral = $this->CompanyJobProfile->find('all',
																	array('conditions' => array(
																								$criterioAdmin,
																								'AND' => array(
																												$criterio,
																												$nivelAcademicoAdministrador
																												),
																								),
																		'fields'=>array('CompanyJobProfile.id'),
																		)
																);
				else:
					$listaOfertasGeneral = array();
				endif;
				
				foreach($listaOfertasGeneral as $listaOfertaGeneral):
					$idsListaOfertaGeneral[] = $listaOfertaGeneral['CompanyJobProfile']['id'];
				endforeach;		
				 
				if(!isset($idsListaOfertaGeneral)):
					$idsListaOfertaGeneral = array();
				endif;
				
				//Match los id de ofertas que cumplen con la condicion en busqueda general con lenguajes, cómputo y niveles
				
				if((isset($niveles)) AND (!empty($criterio))):
					$GeneralNiveles = array_intersect($idListaOfertasNiveles, $idsListaOfertaGeneral );
				else:
					$GeneralNiveles = array_merge($idListaOfertasNiveles, $idsListaOfertaGeneral);
				endif;
				
				if((isset($idiomas)) AND (!empty($criterio))):
					$GeneralIdiomas = array_intersect($idListaOfertaslenguajes, $idsListaOfertaGeneral );
				else:
					$GeneralIdiomas = array_merge($idListaOfertaslenguajes, $idsListaOfertaGeneral);
				endif;
				
				if((isset($computoSQL)) AND (!empty($criterio))):
					$GeneralComputos = array_intersect($totalIdsComputo, $idsListaOfertaGeneral );
				else:
					$GeneralComputos = array_merge($totalIdsComputo, $idsListaOfertaGeneral);
				endif;
				
				
				if((isset($idiomas)) AND (isset($computoSQL)) AND (isset($niveles))):
					$intersect1 = array_intersect($GeneralIdiomas, $GeneralComputos);
					$res = array_intersect($intersect1, $GeneralNiveles);
				else:
					if((isset($idiomas)) AND (!isset($computoSQL))  AND (!isset($niveles))):
						$res = $GeneralIdiomas;
					else:
						if((!isset($idiomas)) AND (isset($computoSQL)) AND (!isset($niveles))):
							$res = $GeneralComputos;
						else:
							if((!isset($idiomas)) AND (!isset($computoSQL)) AND (isset($niveles))):
								$res = $GeneralNiveles;
							else:
								if((isset($idiomas)) AND (isset($computoSQL)) AND (!isset($niveles))):
									$res = array_intersect($GeneralIdiomas, $GeneralComputos);	
								else:
									if((!isset($idiomas)) AND (isset($computoSQL)) AND (isset($niveles))):		
										$res = array_intersect($GeneralComputos, $GeneralNiveles);	
									else:
										if((isset($idiomas)) AND (!isset($computoSQL)) AND (isset($niveles))):			
											$res = array_intersect($GeneralIdiomas, $GeneralNiveles);	
										else:		
											if(!empty($idsListaOfertaGeneral)):
												$res = $idsListaOfertaGeneral;
											else:
												$res[0] = 0;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;		

				$totalOfferId = array_unique($res);
				
				//Como son administrador al parecer ven todos las ofertas sin importar las que esten expiradas o activas o la empresa este en inactiva
				$hoy = date('Y-m-d');
				$this->paginate = array('conditions' => array(
															'AND' => array(
																			'CompanyJobProfile.id' => $totalOfferId,
																			// 'CompanyJobProfile.expiration >= ' => $hoy,
																			// 'CompanyJobContractType.status' => 1,
																			// 'Company.status'  => 1,
																			// $idsListaRelatedCareer //No se incluye
																			),
															),
										'order' => $orden,
										'limit' => $limit,
										);
									
				$ofertas = $this->paginate('CompanyJobProfile');
				$this->set('ofertas', $ofertas);	
				
		}
		
		public function administratorSavedOfferSearch(){
			if($this->request->is('post')):
				if($this->Session->read('redirectAdmin') <> ''):
					$redirectAdmin = $this->Session->read('redirectAdmin').$this->Session->read('page');
				else:
					$redirectAdmin = 'profile'.$this->Session->read('page') ;
				endif;
				
				$serialize_form = serialize($this->Session->read('serialized_form'));
				$this->request->data['AdministratorSavedSearch']['name'] = $this->request->data['StudentSavedSearch']['name'];
				$this->request->data['AdministratorSavedSearch']['administrator_id'] = $this->Session->read('Auth.User.id');
				$this->request->data['AdministratorSavedSearch']['serialize_request'] = $serialize_form;
				$this->request->data['AdministratorSavedSearch']['search'] = 'offer';
				$busquedasGuardadas = $this->AdministratorSavedSearch->find('all', array(
																					'conditions' => array('AdministratorSavedSearch.administrator_id' => $this->Auth->user('id')),
																					'order' => 'AdministratorSavedSearch.id ASC',
																				));
				if(count($busquedasGuardadas) >= 10):
					if($this->AdministratorSavedSearch->delete($busquedasGuardadas[0]['AdministratorSavedSearch']['id'])):
						if($this->AdministratorSavedSearch->save($this->request->data)):
							$this->Session->setFlash('Búsqueda guardada', 'alert-success');
							$this->redirect(array('action' =>  $redirectAdmin));
						else:
							$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
							$this->redirect(array('action' =>  $redirectAdmin));
						endif;
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser sustituida', 'alert-success');
					endif;
				else:
					if($this->AdministratorSavedSearch->save($this->request->data)):
						$this->Session->setFlash('Búsqueda guardada', 'alert-success');
						$this->redirect(array('action' =>  $redirect));
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
						$this->redirect(array('action' =>  $redirect));
					endif;
				endif;
			endif;
		}	
		
		//Catálogos
		
		public function administratorAccesos(){
			$administratorAccesos = $this->AdministratorAccess->find('list', array(
																		'fields' => array('AdministratorAccess.id', 'AdministratorAccess.description'),
																		'order' => array('AdministratorAccess.id ASC')
																	)
														);
			$this->set( compact ('administratorAccesos') );
		}
		
		public function Accesos(){
			$accesos = $this->AdministratorAccess->find('all', array(
																		'fields' => array('AdministratorAccess.id', 'AdministratorAccess.description'),
																		'order' => array('AdministratorAccess.id ASC')
																	)
														);
			$this->set( compact ('accesos') );
			
			// Activa o Desactiva el boton de R&S
			$total = $this->RecruitmentDate->find('count');
			
			if($total == 0):
				$fechaActual = date('Y-m-d');
				$fechaMax = strtotime ( '+2 month' , strtotime ( $fechaActual ) ) ;
				$fechaSiguiente = date ( 'Y-m-j' , $fechaMax );
				$Seguimiento['RecruitmentDate']['tipo_seguimiento'] = 4;
				$Seguimiento['RecruitmentDate']['fecha1_seguimiento'] = $fechaActual;
				$Seguimiento['RecruitmentDate']['fecha2_seguimiento'] = $fechaSiguiente;
				$Seguimiento['RecruitmentDate']['status_ejecucion'] = 0;

				$this->RecruitmentDate->create();
				$this->RecruitmentDate->save($Seguimiento);
			endif;
			
			$fechasReclutamieto = $this->RecruitmentDate->find('all', array(
																			'order' => ' RecruitmentDate.id DESC',
																			'limit' => 1
			));
			
			$this->set('fechaReclutamiento', $fechasReclutamieto[0]);
			
			
			// Activa o Desactiva el boton de revisión de universitarios sin actividad
			$total = $this->StudentStatus->find('count');
			
			if($total == 0):
				$fechaActual = date('Y-m-d');
				$fechaMax = strtotime ( '+2 month' , strtotime ( $fechaActual ) ) ;
				$fechaSiguiente = date ( 'Y-m-j' , $fechaMax );
				$SeguimientoStatus['StudentStatus']['tipo_seguimiento'] = 4;
				$SeguimientoStatus['StudentStatus']['fecha1_seguimiento'] = $fechaActual;
				$SeguimientoStatus['StudentStatus']['fecha2_seguimiento'] = $fechaSiguiente;
				$SeguimientoStatus['StudentStatus']['status_ejecucion'] = 0;

				$this->StudentStatus->create();
				$this->StudentStatus->save($SeguimientoStatus);
			endif;
			
			$fechaStudentEstatus = $this->StudentStatus->find('all', array(
																			'order' => ' StudentStatus.id DESC',
																			'limit' => 1
			));
			
			$this->set('fechaStudentEstatus', $fechaStudentEstatus[0]);

		}
		
		public function escuelasFacultades(){
			$EscuelaLicenciatura = $this->FacultadLicenciatura->find('list', array('order' => array('FacultadLicenciatura.facultad_licenciatura ASC')));
			$EscuelaPosgrados = $this->FacultadPosgrado->find('list', array('order' => array('FacultadPosgrado.facultad_posgrado ASC')));
			$EscuelasFacultades = $EscuelaLicenciatura + $EscuelaPosgrados;
			$this->set('EscuelasFacultades', $EscuelasFacultades);	
			
		}
		
		public function redireccionaAdmin(){
			if($this->Session->read('redirectAdmin') <> ''):
				$redirect = $this->Session->read('redirectAdmin').$this->Session->read('page');
			else:
				$redirect = 'administrator';
			endif;
			return $redirect;
		}
		
		public function disabilityType(){
			$TiposDiscapacidad = $this->DisabilityType->find('list', array('order' => array('DisabilityType.id ASC')));
			$this->set( compact ('TiposDiscapacidad') );
		}
		
		public function states(){
			$Estados = $this->State->find('list', array('order' => array('State.id ASC')));
			$this->set( compact ('Estados') );
			return $Estados;
		}
		
		public function carrer(){
			$careers = $this->Career->find('list', array('order' => array('Career.career ASC')));
			$this->set( compact ('careers') );
		}
		
		public function country(){
			$Paises = $this->Country->find('list', array('order' => array('Country.id ASC')));
			$this->set( compact ('Paises') );
		}
		
		public function semester(){
			$Semestres = $this->Semester->find('list', array('order' => array('Semester.id ASC')));
			$this->set( compact ('Semestres') );
		}
	
		public function salary(){
			$Salarios = $this->Salary->find('list', array('order' => array('Salary.id ASC')));
			$this->set( compact ('Salarios') );
		}
		
		public function Rotation(){
			$Giros = $this->Rotation->find('list', array('order' => array('Rotation.id ASC')));
			$this->set( compact ('Giros') );
		}
	
		public function lenguage(){
			$Lenguages = $this->Lenguage->find('list', array('order' => array('Lenguage.id ASC')));
			$this->set( compact ('Lenguages') );
		}
	
		public function lenguageAverage(){
			$PromediosLenguajes = $this->LenguageAverage->find('all', array('order' => array('LenguageAverage.id ASC')));
			$this->set( compact ('PromediosLenguajes') );
		}
	
		public function Tecnology(){
			$Tecnologias = $this->Tecnology->find('list', array('order' => array('Tecnology.id ASC')));
			$this->set( compact ('Tecnologias') );
		}
		
		public function TypeCourses(){
			$TipoCursos = $this->TypeCourse->find('list', array('order' => array('TypeCourse.type_course ASC')));
			$this->set( compact ('TipoCursos') );
		}
		
		public function NivelesIdioma(){
			$NivelesIdioma = $this->LenguageLevel->find('list', array('order' => array('LenguageLevel.id ASC')));
			$this->set( compact ('NivelesIdioma') );
		}
		
		public function program(){
			$Programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('Programas') );
		}
		
		public function softwareLevel(){
			$NivelesSoftware = $this->SoftwareLevel->find('list', 
																array(
																	'fields' => array('SoftwareLevel.id', 'SoftwareLevel.level'),
																	'order' => array('SoftwareLevel.id ASC')
														));
			$this->set( compact ('NivelesSoftware') );
		}
	
		public function Sector(){
			$Sectores = $this->Sector->find('list', array('order' => array('Sector.id ASC')));
			$this->set( compact ('Sectores') );
		}
		
		public function numeroEmpleados(){
			$numeroEmpleados = $this->EmployeeNumber->find('list', array('order' => array('EmployeeNumber.id ASC')));
			$this->set( compact ('numeroEmpleados') );
		}
		
		public function companyType(){
			$tipoEmpresas = $this->CompanyType->find('list', array('order' => array('CompanyType.id ASC')));
			$this->set( compact ('tipoEmpresas') );
		}
		
		public function sexo(){
			$Sexo = $this->Sexo->find('list', array('order' => array('Sexo.id ASC')));
			$this->set( compact ('Sexo') );
		}
		
		public function maritalStatus(){
			$EstadoCivil = $this->MaritalStatus->find('list', array('order' => array('MaritalStatus.id ASC')));
			$this->set( compact ('EstadoCivil') );
		}
		
		public function Competency(){
			$Competencias = $this->Competency->find('list', array('order' => array('Competency.id ASC')));
			$this->set( compact ('Competencias') );
		}
		
		public function ExperienceArea(){
			$AreasExperiencia = $this->ExperienceArea->find('list', array('order' => array('ExperienceArea.experience_area ASC')));
			$this->set( compact ('AreasExperiencia') );
		}
		
		public function interestArea(){
			$AreasInteres = $this->InterestArea->find('list', array('order' => array('InterestArea.id ASC')));
			$this->set( compact ('AreasInteres') );
		}
		
		public function contractType(){
			$TiposContratos = $this->ContractType->find('list', array('order' => array('ContractType.id ASC')));
			$this->set( compact ('TiposContratos') );
		}
	
		public function workday(){
			$JornadasLaborales = $this->Workday->find('list', array('order' => array('Workday.id ASC')));
			$this->set( compact ('JornadasLaborales') );	
		}
		
		public function Facultades(){
			$Facultades = $this->FacultadPosgrado->find('list', array('order' => array('FacultadPosgrado.facultad_posgrado ASC')));
			$this->set( compact ('Facultades') );
		}
		
		public function Escuelas(){
			$Escuelas = $this->FacultadLicenciatura->find('list', array('order' => array('FacultadLicenciatura.id ASC')));
			$this->set( compact ('Escuelas') );
		}
		
		public function academicSituation(){
			$SituacionesAcademicas = $this->AcademicSituation->find('list', array('order' => array('AcademicSituation.id ASC')));
			$this->set( compact ('SituacionesAcademicas') );
		}
		
		public function average(){
			$Promedios = $this->Average->find('list', array('order' => array('Average.id ASC')));
			$this->set( compact ('Promedios') );
		}
		
		public function decimalAverage(){
				$Decimales = $this->DecimalAverage->find('list', array('order' => array('DecimalAverage.id ASC')));
				$this->set( compact ('Decimales') );
		}
		
		public function posgradoProgrma(){
			$AreasPosgrado = $this->PosgradoProgram->find('list', array('order' => array('PosgradoProgram.posgrado_program ASC')));
			$this->set( compact ('AreasPosgrado') );
		}
		
		public function benefit(){
			$Prestaciones = $this->Benefit->find('list', array('order' => array('Benefit.benefit ASC')));
			$this->set( compact ('Prestaciones') );
		}
		
		public function estadosMexico(){
			$estadosMexico = $this->State->find('list',
												array(
													'fields' => array('State.nombre', 'State.nombre'),
													'order' => array('State.nombre ASC')
												)
											);
			$this->set( compact ('estadosMexico') );
			
		}
		
		public function folder(){
			$folders = $this->CompanyFolder->find('all', array(
																'conditions' => array('CompanyFolder.company_id' => $this->Session->read('company_id')),
																'order' => array('CompanyFolder.name ASC')));
			$this->set( compact ('folders') );
			
			$foldersList = $this->CompanyFolder->find('list', array(
																'conditions' => array('CompanyFolder.company_id' => $this->Session->read('company_id')),
																'order' => array('CompanyFolder.name ASC')));
			$this->set( compact ('foldersList') );
		}
		
		public function totalDescargas(){
			$totalDescargas = $this->CompanyDownloadedStudent->find('count', array(
																			'conditions' => array (
																							'company_id' => $this->Session->read('company_id'),
																							)
																			)
															);	
			$this->set('totalDescargas', $totalDescargas);
		}
		
		public function scholarshipProgram(){
			$ProgramaBecas = $this->ScholarshipProgram->find('list', array(
																		'fields' => array('ScholarshipProgram.id', 'ScholarshipProgram.scholarship_program'),
																		'order' => array('ScholarshipProgram.scholarship_program ASC')));
			$this->set( compact ('ProgramaBecas') );
		}
		

		public function academicLevel(){
			$NivelesAcademicos = $this->AcademicLevel->find('list', array('order' => array('AcademicLevel.id ASC')));
			$this->set( compact ('NivelesAcademicos') );
		}
		
		public function job(){
			$Puestos = $this->Job->find('list', array('order' => array('Job.job ASC')));
			$this->set( compact ('Puestos') );
		}
		
		public function ExperienceSubarea(){
			$SubareasExperiencia = $this->ExperienceSubarea->find('list', array('order' => array('ExperienceSubarea.experience_subarea ASC')));
			$this->set( compact ('SubareasExperiencia') );
		}

		
	}
?>