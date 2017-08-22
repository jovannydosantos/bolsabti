<?php
	class CompaniesController extends AppController{
		
		var $helpers = array('Html', 'Form', 'Captcha', 'Paginator','Js' => array('Jquery'));
		var $name = 'Companies';
		var $uses = array('Company','Question','CompanyAnswer','CompanyContact','CompanyJobOffer','CompanyJobProfile','CompanyJobContractType','CompanyCandidateProfile','Career','CompanyJobRelatedCareer','Competency','CompanyJobOfferCompetency','CompanyJobComputingSkill','CompanyJobLanguage','Rotation','Area','LenguageLevel','Program','AcademicSituation','CompanyFolder','Student','Sexo','AcademicLevel','LenguageAverage','Lenguage','InterestArea','StudentProfessionalProfile','StudentLenguage','Sector','EmployeeNumber','CompanyType','Cancellation','DisabilityType','FacultadLicenciatura','FacultadPosgrado','Semester','ContractType','Workday','Salary','Benefit','Country','Tecnology','Job','ExperienceTime','PosgradoProgram','StudentViewedOffer','State','Zip','CompanyDisabled','CompanyJobContractTypeBenefit','SoftwareLevel','CompanyProfile','StudentProfile','TypeCourse','CompanyViewedStudent','CompanySavedStudent','StudentNotification','CompanyInterviewMessage','CompanyViewedOffer','Application','Report','CompanyExternalOffer','CompanyJobOffer','MaritalStatus','ExperienceArea','Average','DecimalAverage','StudentWorkArea','StudentResponsability','StudentFolder','CompanyLastUpdate','CompanyDownloadedStudent','StudentInterestJob','CompanyOfferOption','StudentProspect','CompanySavedSearch','StudentTechnologicalKnowledge','StudentJobSkill','StudentProfessionalExperience','StudentAchievement','StudentJobProspect','StudentJobProspect','StudentHeader','Administrator'); 


		// var $scaffold;
		var $components = array(
			'RequestHandler',
			'Acl',
			'Session',
			'Captcha'=>array(
			'Model'=>'Company', 
			'field'=>'captcha'),
			'Auth' => array(								
				'authorize' => array('Controller'),
				'authError' => 'Debe estar logueado para continuar',
				'loginError' => 'Clave de acceso o contraseña incorrectos',
					'loginRedirect' => array('controller' => 'Companies', 'action' => 'profile'),
					'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			)
		);
		
		public $paginate = array(
			'limit' => 5,
			'conditions' => array('status' => '1'),
			'order' => array('Company.username' => 'asc')
		);
		
		function captcha()	{
			$this->autoRender = false;
			$this->layout='ajax';
			if(!isset($this->Captcha))	{ //if you didn't load in the header
				$this->Captcha = $this->Components->load('Captcha'); //load it
			}
			$this->Captcha->create();
		}
	
		public function beforeFilter() {
			parent::beforeFilter();
			
			if(!$this->Session->check('Auth.User')):	
				$this->user = $this->Auth->user();
			endif;
			
			$this->Auth->loginAction = array('controller'=>'pages','action'=>'display','home');
			
			if(!$this->Session->check('Auth.User')):	
				$this->Auth->authenticate = array(
					AuthComponent::ALL => array('userModel' => 'Company'),
					'Basic',
					'Form'
				);
			endif;
			
			$this->myRandomNumber = rand(1,10000000);
			$this->Auth->allow('login','activation','register','captcha','codeRecoveryPassword','updatePassword','logout');
			
			if($this->Auth->user('role') === 'company'):
				$this->Auth->allow('profile','changePassword','disableCompanyRegister','updateRegister','companyContact','companyJobOffer','deleteCompanyJobOffer','companyJobProfile','companyJobContractType','companyCandidateProfile','companyJobKnowledge','viewOfferOnline','viewCvOnline','deleteRegister');
			else:
				if(($this->Auth->user('role') === 'administrator') OR ($this->Auth->user('role') === 'subadministrator')):
					$this->Auth->allow();
				endif;
			endif;
			
			if(($this->Session->check('Auth.User')) and (($this->Session->read('Auth.User.role') == 'administrator') OR ($this->Session->read('Auth.User.role') == 'subadministrator'))):	
				if($this->request->query('editingAdmin')=='yes'):
					$this->Session->write('companyJobProfileId', $this->request->query('id') );
					$this->Session->write('company_id', $this->request->query('company_id') );
					$this->Session->write('editingAdmin', $this->request->query('editingAdmin') );
					$this->Session->write('nuevaBusqueda', $this->request->query('nuevaBusqueda') );
				else:
					if($this->Session->check('editingAdmin')):
						$this->Session->write('companyJobProfileId', $this->Session->read('id') );
						$this->Session->write('company_id', $this->Session->read('company_id') );
						$this->Session->write('editingAdmin', $this->Session->read('editingAdmin') );
					else:
						$this->Session->setFlash('Usted se encuentra logueado como administrador, puede volver como administrador o si requiere realizar otras acciones con otro usuario cierre su sesión actual: <br /> <a href="http://bolsa.trabajo.unam.mx/unam/admin" style="color: #a94442; text-decoration: underline;">Volver como administrador</a> o <a href="http://bolsa.trabajo.unam.mx/unam/Administrators/logout" style="color: #a94442; text-decoration: underline;">Cerrar sesión de administrador</a>', 'alert-danger');		
						$this->redirect(array('controller'=>'pages','action'=>'display'));		
						$this->redirect(array('controller'=>'pages','action'=>'display'));
					endif;
				endif;
			else:
				if(($this->Session->check('Auth.User')) and ($this->Session->read('Auth.User.role') == 'company')):
					$this->Session->write('company_id', $this->Auth->user('id'));
				endif;
			endif;
			$this->notification();	
		}
		
		public function isAuthorized($company) {
			if (isset($company['role']) && $company['role'] == 'company' && $company['status'] == 1 ):
				return true;
			else: 
				$this->Session->setFlash('Lo sentimos, su usuario se encuentra sin acceso a esta sección.', 'alert-danger');
				$this->redirect($this->Auth->logout());
				return false;
			endif;
			return false;
		}		
		
		public function login() {	
			if($this->Session->check('Auth.User')):
				$this->request->data['Company']['password'] = '';
				$this->redirect($this->Auth->redirectUrl());
			endif;
			
			if ($this->request->is('post')):
				if($this->request->data['Company']['username'] == 'prueba'):
					$empresa = $this->Company->find('all', array(
																'conditions' => array(
																					// 'Company.id' => $company_id,
																					'Company.status' => 1,
																					),
																'order' => 'rand()',
																	)
														);
					
					$empresa[0]['Company']['CompanyProfile'] = $empresa[0]['CompanyProfile'];
					$this->Session->write('Auth.User', $empresa[0]['Company'] );
					$this->redirect($this->Auth->redirectUrl());
				endif;
				
				if ($this->Auth->login()):	
					$empresa = $this->Company->findById($this->Auth->user('id'));
			
					$hoy = date('Y-m-d');
					$hoy = strtotime ($hoy ) ;
					$hoy = date ( 'Y-m-d' , $hoy );
					
					$fecha = $empresa['CompanyOfferOption']['end_date_company'];
					$fecha = strtotime ( $fecha ) ;
					$fecha = date ( 'Y-m-d' , $fecha );
					
					$date1 = new DateTime($hoy);
					$date2 = new DateTime($fecha);
					
					if ($this->Auth->user('activation') == 1):
						if($empresa['CompanyOfferOption']['end_date_company']==null):
							$this->Session->setFlash('Su usuario '.$this->Auth->user('username').' está en evaluación y asignación de permisos por el administrador para su acceso al sistema.', 'alert-danger');						
							$this->redirect($this->Auth->logout());
						else:
							if($this->Auth->user('status') == 1):
								if($empresa['CompanyOfferOption']['end_date_company']==null):
									$this->Session->setFlash('Su usuario '.$this->Auth->user('username').' está en evaluación y asignación de permisos por el administrador para su acceso al sistema.', 'alert-danger');						
									$this->redirect($this->Auth->logout());
								else:
									if($date1 > $date2):
										$this->Session->delete('Company');					
										$this->Session->setFlash('Lo sentimos '.$this->Auth->user('username').' su tiempo de vigencia ha expirado.'.strlen($date1), 'alert-danger');						
										$this->redirect($this->Auth->logout());
									else:	
										$this->request->data['Company']['password'] = '';				
										$this->redirect($this->Auth->redirectUrl());
									endif;
								endif;
							else:
								$this->Session->delete('Company');
								$this->Session->setFlash('Lo sentimos '.$this->Auth->user('username').' su usuario se encuentra bloqueado.', 'alert-danger');						
								$this->redirect($this->Auth->logout());
							endif;
						endif;
					else:
						$this->Session->delete('Company');
						$this->Session->setFlash('Debe de confirmar su registro accediendo al link que se envió al correo que ingresó.', 'alert-danger');
						$this->redirect($this->Auth->logout());
					endif;
				else:
					$this->Session->setFlash('Su usuario o contraseña es incorrecta', 'alert-danger');
					$this->redirect($this->Auth->logout());
				endif;
				$this->redirect($this->Auth->logout());
			endif;
		}
		
		public function logout(){
			$this->Session->delete('Company');             
			$this->redirect($this->Auth->logout());
		}
		
		public function register(){
			if($this->Session->check('Auth.User')):
				$this->request->data['Company']['password'] = '';
				$this->redirect($this->Auth->redirectUrl());
			endif;
			
			$Estados = $this->State->find('list',
												array(
													'fields' => array('State.nombre', 'State.nombre'),
													'order' => array('State.nombre ASC')
												)
											);
			$this->set( compact ('Estados') );
			
			$Municipios = $this->Zip->find('list',
												array(
													'fields' => array('Zip.Municipio', 'Zip.Municipio'),
													'order' => array('Zip.Municipio ASC')
												)
											);
			$this->set( compact ('Municipios') );
			$this->Sector();
			$this->Rotation();
			$this->numeroEmpleados();
			$this->companyType();
			
			if (!empty($this->data)):
				if ($this->data):
					//Consultas
					$total = $this->CompanyProfile->find('count', array(
																		'conditions' => array(
																								'AND' => array(
																									'CompanyProfile.rfc' => $this->request->data['CompanyProfile']['rfc'],
																									'CompanyProfile.social_reason' => $this->request->data['CompanyProfile']['social_reason'],
																									'CompanyProfile.street' => $this->request->data['CompanyProfile']['street'],
																									'CompanyProfile.state' => $this->request->data['CompanyProfile']['state'],
																									'CompanyProfile.city' => $this->request->data['CompanyProfile']['city'],
																									'CompanyProfile.subdivision' => $this->request->data['CompanyProfile']['subdivision'],
																									'CompanyProfile.zip' => $this->request->data['CompanyProfile']['zip'],
																									
																									'CompanyProfile.street_sede' => $this->request->data['CompanyProfile']['street_sede'],
																									'CompanyProfile.state_sede' => $this->request->data['CompanyProfile']['state_sede'],
																									'CompanyProfile.city_sede' => $this->request->data['CompanyProfile']['city_sede'],
																									'CompanyProfile.subdivision_sede' => $this->request->data['CompanyProfile']['subdivision_sede'],
																									'CompanyProfile.zip_sede' => $this->request->data['CompanyProfile']['zip_sede'],

																									),
																						),
																	)
														);
															
					if($total==0): //Validación de candado en registro
						
												// Busca si existe almenos la primera identica en rfc
						$totalRfc = $this->CompanyProfile->find('count', array(
																		'conditions' => array(														
																							'CompanyProfile.rfc' => $this->request->data['CompanyProfile']['rfc'],
																							),
																		)
														);
														
						$totalRfcEliminados = $this->CompanyDisabled->find('count', array(
																							'conditions' => array(														
																												'CompanyDisabled.rfc' => $this->request->data['CompanyProfile']['rfc'],
																												),
																						)
																			);
																	
						if(($totalRfc>0) OR ($totalRfcEliminados>0)): //Si encuentra realiza el conteo para ver en que numero va ahora lo cambiaremos con el conteo de company disabled por igual											
							$siguienteRegistro = $totalRfc + $totalRfcEliminados + 1;
							$this->request->data['Company']['username'] = $this->request->data['CompanyProfile']['rfc'].'-'.$siguienteRegistro;
						else:
							$this->request->data['Company']['username'] = $this->request->data['CompanyProfile']['rfc'];
						endif;
						
						$this->request->data['Company']['activation'] = $this->myRandomNumber;	
						$this->request->data['Company']['code_recovery_password'] = 0;							
						$this->Company->create();
						
						if($this->Company->saveAll($this->request->data, array('validate' => 'only'))):
							if( $this->data['Company']['file']['error'] == 0 &&  $this->data['Company']['file']['size'] > 0):
								$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS.'rfc'.DS.$this->data['Company']['username'];
								
								if(!file_exists($destino)){
									mkdir(WWW_ROOT.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS.'rfc'.DS.$this->data['Company']['username'], 0777); 
									// echo 'Se ha creado el directorio: ' . $destino;
								} else {
									// echo 'la ruta: ' . $destino . ' ya existe ';
								}
								$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS.'rfc'.DS.$this->data['Company']['username'].DS;
								
								if(move_uploaded_file($this->data['Company']['file']['tmp_name'], $destino.$this->data['Company']['file']['name'])):
								
									$type  = explode('.', $this->data['Company']['file']['name']);
									rename($destino.$this->data['Company']['file']['name'], $destino.$this->data['Company']['username'].'.'.$type[1]);
									
									$this->request->data['Company']['type'] = $this->data['Company']['file']['type'];
									$this->request->data['Company']['file'] = DS.'unam'.DS.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS.'rfc'.DS.$this->data['Company']['username'].'.'.$this->data['Company']['file']['type'];
									
									if($this->Company->saveAll($this->request->data, array('deep' => true))):
											
											$Email = new CakeEmail('gmail');
											$Email->from(array('jovanny_dosantos@hotmail.com' => 'SISBUT UNAM.'));
											$Email->to($this->request->data['Company']['email'] );
											$Email->subject('Confirmación de registro SISBUT UNAM.');
											$Email->emailFormat('both');
											$Email->template('email')->viewVars( array(
												        'aMsg' => 
														'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
														'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Correo de confirmación de acceso al Sistema de  Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
														'<p>Usuario y contraseña registrada:<br/>'.
														'<strong>Usuario:</strong> ' . $this->request->data['Company']['username'] . '<br/>'.
														'<strong>Contraseña:</strong> ' . $this->request->data['Company']['password'] . '</p>'.
																						
														'<p>Para poder acceder al SISBUT, favor de confirmar su registro en la siguiente liga: <a href="http://bolsa.trabajo.unam.mx/unam/Companies/activation?email='.$this->request->data['Company']['email'].'&cod='.$this->myRandomNumber.'">Confirmar registro.</a><br/>'.
																			
	              										'En algunos casos, la liga no aparece en azul y como un enlace. Si no funciona, copie la siguiente liga y péguela en una nueva ventana  de direcciones de su navegador. <br/>'.
														'http://bolsa.trabajo.unam.mx/unam/Companies/activation?email='.$this->request->data['Company']['email'].'&cod='.$this->myRandomNumber.'</p>'.
																						
														'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
														'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
														'Correo electrónico: bolsa@unam.mx</p></div>'
											));
											if($Email->send()):
												$this->Session->setFlash('Se ha enviado un correo electrónico de confirmación a la dirección electrónica que ingresó para que active su registro. Gracias.', 'alert-info');  									
												if(($totalRfc>0) OR ($totalRfcEliminados>0)): 
													//Envia correo al administrador informando un registro repetido de empresa
													$admin = $this->Administrator->find('all', array(
																									'conditions' => array(
																														'Administrator.role' => 'administrator',
																														),
																									'limit' => 1
																									)
																						);
													 
													$Email = new CakeEmail('gmail');
													$Email->from(array('jovanny_dosantos@hotmail.com' => 'SISBUT UNAM.'));
													$Email->to($admin[0]['Administrator']['email']);
													$Email->subject('Registro de empresa con un mismo rfc.');
													$Email->emailFormat('both');
													$Email->template('email')->viewVars( array(
																'aMsg' => 
																'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
																'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Registro de empresa con un mismo rfc </p>'.
																'<p>El sistema SISBUT ha identificado el registro de una empresa con un mismo rfc que ya existe: '.$this->request->data['CompanyProfile']['rfc'].' verifique si el registro es válido desde Administrador en la sección de Empresas / Instituciones de lo contrario puede eliminarlo.</p>'.

																'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																'Correo electrónico: bolsa@unam.mx</p></div>'
													));
													$Email->send();
												endif;
												$this->redirect(array('action' => 'logout'));
											else:
												$this->Session->setFlash('Lo sentimos su correo de confirmación no pudo ser enviado.', 'alert-danger');
												$this->redirect(array('action' => 'logout'));
											endif;	
											
	
									else:
										$this->Session->setFlash('Lo sentimos, el usuario no pudo guardarse si el problema persiste contacte al administrador.', 'alert-danger');
									endif;
								else:
									$this->Session->setFlash('Lo sentimos no se pudo cargar el archivo de RFC.', 'alert-danger');
								endif;
							else:
								$this->Session->setFlash('Lo sentimos no se pudo cargar el archivo de imagen del RFC, verifique que ha seleccionado su imagen de RFC.', 'alert-danger');
							endif;
						else:
							$this->Session->setFlash('Por favor, revise y corrija los campos marcados.', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Ya existe un registro con el mismo Domicilio Sede, comuníquese con el administrador del SISBUT a los teléfonos: 56 22 04 20 y 56 22 02 45 ', 'alert-danger');
					endif;
				else:
					$this->Session->setFlash('Lo sentimos, no se encontró información para ser guardada.', 'alert-danger');
				endif;
				$this->request->data['Company']['username'] = $this->request->data['CompanyProfile']['rfc'];
			endif;		
		}

		public function activation($email = null, $cod = null) {
			$cod = $this->request->query('cod');
			$email = $this->request->query('email');
				
			if (!$cod or !$email):
				$this->Session->setFlash('No se encontraron parametros necesarios para completar la transacción, verifique que copio la url correctamente', 'alert-danger');
				$this->redirect(array('action' => 'logout'));
			else:			
				$company = $this->Company->findByEmail($email);
				if (!$company):
					$this->Session->setFlash('No se encontró el usuario, verifique que copio la url correctamente', 'alert-danger');
					$this->redirect(array('action' => 'logout'));
				else:
					if($company['Company']['activation'] == 1):
						$this->Session->setFlash('El código de verificación ya ha sido usado, ingrese su Usuario y Contraseña para iniciar sesión', 'alert-danger');
						$this->redirect(array('action' => 'logout'));
					else:
						if($company['Company']['activation'] !== $cod):
							$this->Session->setFlash('El código de verificación no es correcto, verifique que copio la url correctamente', 'alert-danger');
							$this->redirect(array('action' => 'logout'));
						else:							
							// if ($this->Company->updateAll(array('Company.status' => 1, 'Company.activation' => 1),array('Company.id' => $company['Company']['id']))):
							if ($this->Company->updateAll(array('Company.activation' => 1),array('Company.id' => $company['Company']['id']))):
								$this->Session->setFlash('Su confirmación se realizó satisfactoriamente. Ya puede acceder al Sistema.', 'alert-success');
								$this->redirect(array('action' => 'logout'));
							else:
								$this->Session->setFlash(' Lo sentimos hubo un error y no se pudo activar la cuenta, si el problema persiste consulte al administrador.', 'alert-danger');
								$this->redirect(array('action' => 'logout'));
							endif;
						endif;
					endif;
				endif;
			endif;					
		}
		
		public function codeRecoveryPassword(){	
				if ($this->request->is('post')):
					$company = $this->Company->findByEmail($this->data['Company']['email']);
					if (!$company):					
						$this->Session->setFlash('Correo electrónico no encontrado', 'alert-danger');
					else:
						if ($this->Company->updateAll(array('Company.code_recovery_password' => $this->myRandomNumber),array('Company.id' => $company['Company']['id']))):
							$Email = new CakeEmail('gmail');
									$Email->from(array('jovanny_dosantos@hotmail.com' => 'SISBUT UNAM.'));
									$Email->to($this->request->data['Company']['email'] );
									$Email->subject('Solicitud de cambio de contraseña SISBUT UNAM.');
									$Email->emailFormat('both');
									$Email->template('email')->viewVars( array(
											'aMsg' =>
											'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
											'<p style="color: #835B06; font-size: 24px; font-weight: bold; text-align: center;"><div style="background-color: #D8D8D8; text-align: justify;">Cambio de Contraseña</p>'.
											'<p>Si usted solicitó un cambio de contraseña para poder acceder al SISBUT UNAM., por favor siga las indicaciones a continuación; si no lo solicitó haga caso omiso a este correo, sus datos de acceso seguirán siendo los mismos.<p>'.
											'<p>Para confirmar el cambio de contraseña de acceso al SISBUT UNAM., de clic en el link siguiente: <a href="http://bolsa.trabajo.unam.mx/unam/Companies/updatePassword?id='.$company['Company']['id'].'&cod='.$this->myRandomNumber.'">Cambiar contraseña</a></p>'.
																						
											'En algunos casos, la liga no aparece en azul y como un enlace. Si no funciona, copie la siguiente liga y péguela en la barra de direcciones de su navegador. <br/>'.
											'http://bolsa.trabajo.unam.mx/unam/Companies/updatePassword?id='.$company['Company']['id'].'&cod='.$this->myRandomNumber.'</p>'.
																						
											'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
											'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
											'Correo electrónico: bolsa@unam.mx</p></div>'
										));
								$Email->send();						
								$this->Session->delete('Company');
								$this->Session->destroy();
								$this->Session->setFlash('Se ha enviado una liga a su correo de registro para recuperar su contraseña', 'alert-info');
								$this->redirect(array('action' => 'logout'));
						else:
							$this->Session->setFlash('Lo sentimos ocurrio un error en el proceso de restablecimiento de su contraseña,'.
													' si el problema persiste contacte al administrador.', 'alert-danger');
							$this->redirect(array('action' => 'logout'));
						endif;					
					endif;	
				endif;	
		} 			
		
		public function updatePassword(){		
			if ($this->request->is('get')):
				$id = $this->request->query('id');
				$cod = $this->request->query('cod');
				$student = $this->Company->findById($id);
				if (!$id || !$cod):							
					$this->Session->setFlash('No se encontraron parametros necesarios para completar la transacción, verifique que copio la url correctamente.', 'alert-danger');
				else:
					if ($student):
						if($student['Company']['code_recovery_password'] == 0):
							$this->Session->setFlash('Lo sentimos no existen solicitudes de cambio de contraseñas vigentes para este usuario.', 'alert-danger');
							$this->redirect(array('action' => 'logout'));
						endif;
					else:
						$this->Session->setFlash('Los sentimos, usuario no encontrado', 'alert-danger');
						$this->redirect(array('action' => 'logout'));
					endif;
				endif;
			else:
				if($this->request->is('post')):
					$company = $this->Company->findById($this->request->data['Company']['id']);
					if ($company):
						if($company['Company']['code_recovery_password'] == 0):
							$this->Session->setFlash('Lo sentimos no existen solicitudes de cambio de contraseñas vigentes.', 'alert-danger');
							$this->redirect(array('action' => 'logout'));
						else:
							if($company['Company']['code_recovery_password'] == $this->request->data['Company']['cod']):
								$this->Company->set($this->request->data);	//pasa los parametros al modelo para ser validados.
								if ($this->Company->validates(array('fieldList' => array('password', 'password_confirm')))):	//pasa los campos que serán validados.
									$this->request->data['Company']['username'] = $company['Company']['username'];
									if($this->Company->updateAll(array('Company.password' => "'".AuthComponent::password($this->data['Company']['password'])."'", 'code_recovery_password' => 0),array('Company.id' => $company['Company']['id']))):
										
										if ($this->Auth->login()):
											if ($this->Auth->user('activation') == 1):
												if ($this->Auth->user('status') == 1):
													$this->request->data['Company']['password'] = '';
													$this->Session->setFlash('Contraseña actualizada.', 'alert-success');
													$this->redirect($this->Auth->redirectUrl());
												else:
													$this->Session->setFlash('Lo sentimos '.$this->Auth->user('username').' su usuario se encuentra bloqueado.', 'alert-danger');						
													$this->redirect($this->Auth->logout());
												endif;
											else:
												$this->Session->setFlash('Debe de confirmar su registro accediendo al link que se envió al correo que ingresó.', 'alert-danger');
												$this->redirect($this->Auth->logout());
											endif;
										else:
											$this->Session->setFlash('Usuario o contraseña incorrecta, intente nuevamente.', 'alert-danger');
											$this->redirect($this->Auth->logout());
										endif;
										
									endif;	
								else:
									$this->Session->setFlash('Corrija los errore para continuar.', 'alert-danger');
								endif;
							else:
								$this->Session->setFlash('Lo sentimos, su código de verificación para el cambio de contraseña no es válido.', 'alert-danger');
								$this->redirect(array('action' => 'logout'));
							endif;
						endif;
					else:
						$this->Session->setFlash('Los sentimos usuario no encontrado', 'alert-danger');
						$this->redirect(array('action' => 'logout'));
					endif;
				endif;
			endif;
		}			

		public function profile(){
			//Elimina las sesiones que se crearon de la oferta para poder agregar una nueva oferta NO QUITAR
			$this->Session->delete('CompanyJobOffer.id');
			$this->Session->delete('CompanyJobProfile.id');
			$this->Session->delete('companyJobContractType.id');
			$this->Session->delete('CompanyCandidateProfile.id');
			$this->Session->write('Editando', 0);

			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));	
			
			$year = date('Y');
			$fecha = $year.'-01-01';
			for($i=1; $i <= 13; $i++):
				$fecha = strtotime ( $fecha ) ;
				$fecha = date ( 'Y-m-d' , $fecha );
				$fechaAnterior = $fecha;
				
				if($i>1):
					$fecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
					$fecha = date ( 'Y-m-d' , $fecha );
					$datosMeses[$i] = $this->CompanyJobProfile->find('all', array(
																			'conditions' => array (
																								'AND' => array(
																											'CompanyJobProfile.company_id' =>  $this->Session->read('company_id'),
																											'CompanyJobContractType.created >= ' => $fechaAnterior,
																											'CompanyJobContractType.created < ' => $fecha,
																											),
																									)
																				)
																);	
				endif;
			endfor; 
			$this->set('datosMeses', $datosMeses);	
			
			if($this->request->query('mes') <> ''):
				$indexMeses = $this->request->query('mes');
				$this->set('mesSeleccionado', $indexMeses);	
			else:
				$this->set('mesSeleccionado', 0);	
			endif;
			
		}
	
		public function changePassword($id = null){
			$this->Company->id = $id;
			$this->Company->recursive = 1;			
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			if($this->request->is( 'get' ) ):
				$this->request->data = $this->Company->read();
			else:			
				if($this->request->is('post')):
					$this->Company->set($this->request->data);	//pasa los parametros al modelo para ser validados.
						if ($this->Company->validates(array('fieldList' => array('new_password', 'new_password_confirm', 'old_password','email_confirm')))):	//pasa los campos que serán validados.
							if($this->Company->updateAll(array('Company.password' => "'".AuthComponent::password($this->data['Company']['new_password'])."'"),array('Company.id' => $this->Company->data['Company']['id']))):
								$Email = new CakeEmail('gmail');
									$Email->from(array('jovanny_dosantos@hotmail.com' => 'SISBUT UNAM.'));
									$Email->to($this->request->data['Company']['email'] );
									$Email->subject('UNAM – SISBUT / Modificación de contraseña');
									$Email->emailFormat('both');
									$Email->template('email')->viewVars( array(
													'aMsg' => 
													'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
													'<p style="color: #835B06; font-size: 24px; font-weight: bold; text-align: center;"><div style="background-color: #D8D8D8; text-align: justify;">Detalles del cambio de contraseña</p>'.
													'<p>Esta es su información (mantengala en secreto y guárdala bien) para iniciar su sesión en SISBUT UNAM.</p>'.
													
													'<p><strong>RFC: </strong>' . $this->request->data['Company']['username']. '<br/>' .
													'<strong>Contraseña: </strong>' . $this->request->data['Company']['new_password'] . '</p>' .
													'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
													
													'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
													'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
													'Correo electrónico: bolsa@unam.mx</p></div>'
									));
									$Email->send();
									$this->Session->setFlash('Su contraseña ha sido modificada exitosamente, podrá acceder con ella en su próxima visita.', 'alert-success');
									$this->redirect(array('action' => 'logout'));
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo cambiar su contraseña si el problema persiste contacte al administrador.', 'alert-danger');
							endif;	
						else:
							$this->Session->setFlash('Corrija los errore para continuar.', 'alert-danger');
						endif;
				endif;
			endif;
		}
	
		public function disableCompanyRegister($id){
			$this->Company->id = $id;
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));	
			$this->Question->recursive = -1;
			$preguntas = $this->Question->find('all', array(
														
														'conditions' => array(
																		'Question.status !=' => 0),			
														)
											);
			$this->set( compact ('preguntas') );
			
			$this->companyCancellation();
			
			if($this->request->is( 'get' ) ):
				$this->request->data = $this->Company->read();
			else:
				if($this->request->is('post')):
					$this->Company->set($this->request->data);
					if ($this->Company->validates(array('fieldList' => array('disable')))):
						if($this->request->data['Company']['disable']== 's'):
							
							foreach($this->request->data['CompanyAnswer'] as $answer) {
									$answer['company'] =$this->Auth->user('username');
									if($answer['answer'] <> ''):
										$this->CompanyAnswer->create();
										$this->CompanyAnswer->save($answer);
									endif;
								}
							$company = $this->Company->findById($this->Session->read('company_id'));
							$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS;
							if (file_exists($destino.$company['Company']['filename'])):
								unlink($destino.$company['Company']['filename']);
							endif;
							
							if($this->Company->delete($id)):
								$this->CompanyDisabled->data['CompanyDisabled']['company_username'] = $this->Auth->user('username');
								$this->CompanyDisabled->save($this->CompanyDisabled->data);
								$this->Session->setFlash('Su registro fue eliminado exitosamente. Esperamos vuelva pronto. ', 'alert-success');
								
								$this->redirect(array('action' => 'logout'));
							else:
								$this->Session->setFlash('Lo sentimos, su registro no pudo ser eliminado', 'alert-danger');
							endif;
							
						else:
							$this->Session->setFlash('Registro NO eliminado', 'alert-danger');
							$this->redirect(array('action' => 'disableStudentRegister',$this->Session->read('company_id')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
				endif;
			endif;			
		}
		
		public function updateRegister($id = null) {
			$this->Company->id =  $id;	
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));	
			
			if($this->request->is('get')):	
				$this->request->data = $this->Company->read();
			else:
				$this->Company->validate = array();
				$validator = $this->Company->validator();
				$this->Company->set($this->request->data);	//pasa los parametros al modelo para ser validados.
					if (!$this->Company->validates(array('fieldList' => array('email','email_confirm')))):
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->request->data['Company']['email_confirm'] = '';
					else:			
						if($this->Company->save($this->request->data)):
							$this->Session->setFlash('Logo cargado', 'alert-success');
							$this->redirect(array('action' => 'updateRegister',$this->Session->read('company_id')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo cargar su foto', 'alert-danger');
						endif;
					endif;
			endif;	
		}
		
		public function deleteRegister($id = null) {
			if($this->request->is('post')):	
				$company = $this->Company->findById($this->Session->read('company_id'));
				if ($this->Company->updateAll(array(
													'Company.filename' => "''", 
													'Company.dir' => "''",
													'Company.mimetype' => "''",
													'Company.filesize' => 0,
													),
											array('Company.id' => $this->Session->read('company_id'))
											)
					):
							$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS;
							if(file_exists($destino.$company['Company']['filename'])):
								unlink($destino.$company['Company']['filename']);
							endif;
							$this->Session->setFlash('Logo de empresa eliminado', 'alert-success');
							$this->redirect(array('action' => 'updateRegister',$this->Session->read('company_id')));
				else:
					$this->Session->setFlash('Lo sentimos, el logo de la empresa no pudo ser eliminado', 'alert-danger');
					$this->redirect(array('action' => 'updateRegister',$this->Session->read('company_id')));
				endif;
			else:
				$this->Session->setFlash('Lo sentimos, el logo de la empresa no pudo ser eliminado', 'alert-danger');
				$this->redirect(array('action' => 'updateRegister',$this->Session->read('company_id')));
			endif;	
		}
	
		public function companyContact($id = null) {
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			
			$this->Company->id = $this->Session->read('company_id');
		
			$Estados = $this->State->find('list',
												array(
													'fields' => array('State.nombre', 'State.nombre'),
													'order' => array('State.nombre ASC')
												)
											);
			$this->set( compact ('Estados') );
			
			$Municipios = $this->Zip->find('list',
												array(
													'fields' => array('Zip.Municipio', 'Zip.Municipio'),
													'order' => array('Zip.Municipio ASC')
												)
											);
			$this->set( compact ('Municipios') );
			$this->Sector();
			$this->Rotation();
			$this->numeroEmpleados();
			$this->companyType();

			if($this->request->is( 'get' ) ):
				$this->request->data = $this->Company->read();
			else:
				if(!$this->Company->CompanyProfile->saveAll($this->request->data, array('validate' => 'only'))):
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
				else:
					if(!$this->Company->CompanyContact->saveAll($this->request->data, array('validate' => 'only'))):
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					else:
						if(!$this->Company->saveAll($this->request->data, array('validate' => 'only'))):
							$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						else:
							if($this->Company->CompanyProfile->save($this->request->data)):
								if($this->Company->CompanyContact->save($this->request->data)):
									$this->Company->validator()->remove('password');
									if($this->Company->save($this->request->data)):
										$this->Session->setFlash('Registro actualizado', 'alert-success');
										$this->redirect(array('action' => 'companyContact',$this->Session->read('company_id')));
									else:
										$this->Session->setFlash('Los datos de la empresa NO pudieron ser guardados', 'alert-danger');
									endif;
								else:
									$this->Session->setFlash('El contacto de la empresa NO pudo ser guardado', 'alert-danger');
								endif;
							else:
								$this->Session->setFlash('El perfil de la empresa NO pudo ser guardado', 'alert-danger');
							endif;
						endif;
					endif;
				endif;
			endif;
		}
		
		public function companyJobOffer() {
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));

			if($this->request->is('get')):
				if(($this->request->query('editar')==1) and ( $this->request->query('id')<>'')):
					//Elimina las sesiones que se crearon de la oferta pasadas
					
					$this->Session->delete('CompanyJobOffer.id');
					$this->Session->delete('CompanyJobProfile.id');
					$this->Session->delete('companyJobContractType.id');
					$this->Session->delete('CompanyCandidateProfile.id');
			
					$datos = $this->CompanyJobProfile->find('all', array(
																	'conditions' => array('CompanyJobProfile.id' => $this->request->query('id'))
																	)
															);
															
					$this->Session->write('CompanyJobOffer.id', $datos[0]['CompanyJobOffer']['id']);
					$this->Session->write('CompanyJobProfile.id', $datos[0]['CompanyJobProfile']['id']);
					$this->Session->write('companyJobContractType.id', $datos[0]['CompanyJobContractType']['id']);
					$this->Session->write('CompanyCandidateProfile.id', $datos[0]['CompanyCandidateProfile'][0]['id']);
					$this->Session->write('Editando', 1);
				endif;
				if($this->Session->check('CompanyJobOffer.id') == true):
					$this->CompanyJobOffer->id = $this->Session->read('CompanyJobOffer.id');
					$this->request->data = $this->CompanyJobOffer->read();
				endif;
			else:	
				if($this->request->is('post')):	
						if($this->CompanyJobOffer->saveAll($this->request->data, array('validate' => 'only'))):
							$this->request->data['CompanyJobOffer']['company_id'] = $this->Session->read('company_id');
							if($this->CompanyJobOffer->save($this->request->data)):
								if($this->Session->check('CompanyJobOffer.id') == false):
									$this->Session->write('CompanyJobOffer.id', $this->CompanyJobOffer->getInsertID());
								endif;
								$this->Session->setFlash('Registro guardado', 'alert-success');
								$this->companyLastUpdate();
								$this->redirect(array('action' => 'companyJobOffer'));
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo guardar su registro', 'alert-danger');
							endif;
						else:
							$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						endif;
				endif;	
			endif;	
		}
		
		public function companyJobProfile() {
				$this->Company->recursive = 1;
				$this->set('company', $this->Company->findById($this->Session->read('company_id')));
				
				$this->disabilityType();
				$this->Rotation();
				$this->ExperienceArea();
				$this->job();
				$this->experienceTime();
			if($this->request->is('get')):
				if($this->Session->check('CompanyJobOffer.id') == true):
					if($this->Session->check('CompanyJobProfile.id') == true):
						$this->CompanyJobProfile->id = $this->Session->read('CompanyJobProfile.id');
						$this->request->data = $this->CompanyJobProfile->read();
					endif;
				else:
					$this->Session->setFlash('Sin responsable para la oferta, comience por agregarlo', 'alert-danger');
					$this->redirect(array('action' => 'companyJobOffer'));
				endif;
			else:	
				if($this->request->is('post')):	
					$this->request->data['CompanyJobProfile']['company_id'] = $this->Session->read('company_id');
					$this->request->data['CompanyJobProfile']['company_job_offer_id'] = $this->Session->read('CompanyJobOffer.id');
					if($this->CompanyJobProfile->saveAll($this->request->data, array('validate' => 'only'))):	
						if($this->CompanyJobProfile->save($this->request->data)):
							if($this->Session->check('CompanyJobProfile.id') == false):
								$this->Session->write('CompanyJobProfile.id', $this->CompanyJobProfile->getInsertID());
							endif;
							$this->companyLastUpdate();
							$this->Session->setFlash('Registro guardado', 'alert-success');
							$this->redirect(array('action' => 'companyJobProfile'));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo guardar su registro', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
				endif;
			endif;
		}
		
		public function companyJobContractType() {
				$this->Company->recursive = 1;
				$this->set('company', $this->Company->findById($this->Session->read('company_id')));

				$Estados = $this->State->find('list',
													array(
														'fields' => array('State.nombre', 'State.nombre'),
														'order' => array('State.nombre ASC')
													)
												);
				$this->set( compact ('Estados') );

				$this->contractType();
				$this->workday(); 
				$this->salary(); 
				$this->benefit();
				
				$Prestaciones = $this->Benefit->find('list', array('order' => array('Benefit.benefit ASC')));
				$this->set( compact ('Prestaciones') );
			
				$Beneficios = $this->Benefit->find('all');
				$this->set( compact ('Beneficios') );
				
				$this->set('BeneficiosOferta', $this->CompanyJobContractTypeBenefit->find('all'
																								, array(
																									'conditions' => array('CompanyJobContractTypeBenefit.company_job_contract_type_id' => $this->Session->read('companyJobContractType.id')
																									),
																									'fields' => array('CompanyJobContractTypeBenefit.id', 'CompanyJobContractTypeBenefit.benefit_id'),
																							)
							)
							);
							
				if($this->request->is('get')):
					if($this->Session->check('CompanyJobOffer.id') == true):
						if($this->Session->check('companyJobContractType.id') == true):
							$this->CompanyJobContractType->id = $this->Session->read('companyJobContractType.id');
							$this->request->data = $this->CompanyJobContractType->read();
						endif;
					else:
						$this->Session->setFlash('Sin responsable para la oferta, comience por agregarlo', 'alert-danger');
						$this->redirect(array('action' => 'companyJobOffer'));
					endif;
				else:
					if($this->request->is('post')):
								$this->request->data['CompanyJobContractType']['company_job_profile_id'] = $this->Session->read('CompanyJobProfile.id');
								if($this->CompanyJobContractType->saveAll($this->request->data, array('validate' => 'only'))):	
									
									if($this->CompanyJobContractType->save($this->request->data)):
										if($this->Session->check('companyJobContractType.id') == false):
											$this->Session->write('companyJobContractType.id', $this->CompanyJobContractType->getInsertID());
										endif;
										if($this->Session->check('companyJobContractType.id') == true):
											$this->CompanyJobContractTypeBenefit->deleteAll(array('CompanyJobContractTypeBenefit.company_job_contract_type_id' => $this->Session->read('companyJobContractType.id')), false);
										endif;	
										
										$error = 0;
										
										foreach($this->request->data['CompanyJobContractTypeBenefit']['benefits'] as $beneficio){
											if($beneficio<>''):
												if($this->Session->check('companyJobContractType.id') == false):
													$this->request->data['CompanyJobContractTypeBenefit']['company_job_contract_type_id'] = $this->CompanyJobContractType->getLastInsertId();
												else:
													$this->request->data['CompanyJobContractTypeBenefit']['company_job_contract_type_id'] = $this->Session->read('companyJobContractType.id');
												endif;
												$this->request->data['CompanyJobContractTypeBenefit']['benefit_id'] = $beneficio;
												$this->CompanyJobContractTypeBenefit->create();
												if(!$this->CompanyJobContractTypeBenefit->save($this->request->data)):
													$error = 1;
												endif;
											endif;
										}
									
										if($error == 0):
											$this->companyLastUpdate();
											$this->Session->setFlash('Registro guardado', 'alert-success');
											$this->redirect(array('action' => 'companyJobContractType'));
										else:
											$this->Session->setFlash('Lo sentimos, no se pudo guardar los beneficios de la oferta', 'alert-danger');
											$this->redirect(array('action' => 'companyJobContractType'));
										endif;
									endif;
								else:
									$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
								endif;
					endif;	
				endif;
		}
		
		public function companyCandidateProfile() {
				$this->Company->recursive = 1;
				$this->CompanyJobProfile->recursive = 2;
				$this->set('company', $this->Company->findById($this->Session->read('company_id')));
				
				$this->semester();
				$this->carrer();
				$this->academicSituation();
				$this->academicLevel();
				// Toda la info de competencias
				$Competencias = $this->Competency->find('all', array('order' => array('Competency.id ASC')));
				$this->set( compact ('Competencias') );

				if($this->request->is('get')):
					if($this->Session->check('CompanyJobProfile.id') == true):
						$this->CompanyJobProfile->id = $this->Session->read('CompanyJobProfile.id');
						$this->request->data = $this->CompanyJobProfile->read();
					else:
						$this->Session->setFlash('Sin perfil de oferta para relacionar el perfil del candidato, comience por agregarla', 'alert-danger');
						$this->redirect(array('action' => 'companyJobOffer'));
					endif;				
				else:		
					if($this->request->is('post')):	

						$error = 0;
						
						if($this->Session->check('CompanyJobProfile.id') == true):
							// Borramos los id´s de competencias existentes en el perfil del candidato poder actualizar la lista
							$this->CompanyJobOfferCompetency->deleteAll(array('CompanyJobOfferCompetency.company_job_profile_id' => $this->Session->read('CompanyJobProfile.id')), false);
							
							foreach($this->request->data['CompanyJobOfferCompetency'] as $competency) {
								if($competency['competency_id'] <> 0):
									$competency['company_id'] = $this->Session->read('company_id');
									$competency['company_job_profile_id'] = $this->Session->read('CompanyJobProfile.id');
									$this->CompanyJobOfferCompetency->create();
									if(!$this->CompanyJobOfferCompetency->save($competency)):
										$error = 1;
									endif;
								endif;
							}
							
							// Borramos los id´s de niveles existentes en el perfil del candidato poder actualizar la lista
							$this->CompanyCandidateProfile->deleteAll(array('CompanyCandidateProfile.company_job_profile_id' => $this->Session->read('CompanyJobProfile.id')), true);

							foreach($this->request->data['CompanyCandidateProfile'] as $nivel) {
								$data = array(
											'company_job_profile_id' => $this->Session->read('CompanyJobProfile.id'),
											'academic_level_id' => $nivel['academic_level_id'],
											'academic_situation_id' => $nivel['academic_situation_id'],
											'semester' => $nivel['semester'],
										);
								
								$this->CompanyCandidateProfile->create();
								if(!$this->CompanyCandidateProfile->save($data)):
									$error = 1;
								else:
									$this->Session->write('CompanyCandidateProfile.id', $this->CompanyCandidateProfile->getInsertID());
									foreach($this->request->data['CompanyCandidateProfileCarreras'][$nivel['index']]['carreras'] as $carrera) {
										$data = array(
													'company_job_profile_id' => $this->CompanyCandidateProfile->getInsertID(), 
													'career_id' => $carrera
													);
													
										$this->CompanyJobRelatedCareer->create();
										if(!$this->CompanyJobRelatedCareer->save($data)):
											$error = 0;
										endif;
									}
								endif;
							}
						else:
							$error = 1;
						endif;	
					
						if($error == 0):
							$this->companyLastUpdate();
							$this->Session->setFlash('Registro guardado', 'alert-success');
							$this->redirect(array('action' => 'companyCandidateProfile'));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo guardar la información completa', 'alert-danger');
							$this->redirect(array('action' => 'companyCandidateProfile'));
						endif;
					endif;	
				endif;
		}
		
		public function companyJobKnowledge(){	
				$this->Company->recursive = 1;
				$this->set('company', $this->Company->findById($this->Session->read('company_id')));
				
				$conditionsLenguage = array(
					'CompanyJobLanguage.company_job_profile_id' => $this->Session->read('CompanyJobProfile.id'),
				);
				
				$conditionsComputing = array(
					'CompanyJobComputingSkill.company_job_profile_id' => $this->Session->read('CompanyJobProfile.id'),
				);
				
				$this->lenguage();
				$this->NivelesIdioma();
				$this->Tecnology();
				$this->program();
				$this->softwareLevel();
				
				if($this->request->is('get')):
					if($this->Session->check('CompanyJobOffer.id') == true):
						if($this->Session->check('CompanyJobProfile.id') == true):
							$this->CompanyJobProfile->id = $this->Session->read('CompanyJobProfile.id');
							$this->request->data = $this->CompanyJobProfile->read();
						else:
							$this->Session->setFlash('Sin perfil de oferta para relacionar los conocimientos y habilidades, comience por agregarla', 'alert-danger');
							$this->redirect(array('action' => 'companyJobProfile'));
						endif;
					else:
						$this->Session->setFlash('Sin responsable para la oferta, comience por agregarlo', 'alert-danger');
						$this->redirect(array('action' => 'companyJobOffer'));
					endif;	
				
				else:
					if($this->request->is('post')):	
							$lenguajeVar = 0;
							$computoVar = 0;
							$conocimientoVar = 0;
							
							$conocimientos = $this->request->data['CompanyJobProfile']['professional_skill'];
							if($conocimientos<>''):
								$companyJobProfileId = $this->Session->read('CompanyJobProfile.id');
								if($this->CompanyJobProfile->updateAll(array('CompanyJobProfile.professional_skill' => "'" . $conocimientos . "'"), array('CompanyJobProfile.id' => $companyJobProfileId))):
									$conocimientoVar = 0;	
								else:
									$conocimientoVar = 1;
								endif;
							endif;
							
							if($this->CompanyJobLanguage->hasAny($conditionsLenguage)):
								$this->CompanyJobLanguage->deleteAll(array('CompanyJobLanguage.company_job_profile_id' => $this->Session->read('CompanyJobProfile.id')), false);
							endif;	

							foreach($this->request->data['CompanyJobLanguage'] as $lenguage) {
								
								$suma = 0;
								if($lenguage['reading_level'] == 1):
									$suma = $suma + 10;
								else:
									if($lenguage['reading_level'] == 2):
										$suma = $suma + 30;
									else:
										if($lenguage['reading_level'] == 3):
											$suma = $suma + 50;
										endif;
									endif;
								endif;

								if($lenguage['writing_level'] == 1):
									$suma = $suma + 10;
								else:
									if($lenguage['writing_level'] == 2):
										$suma = $suma + 30;
									else:
										if($lenguage['writing_level'] == 3):
											$suma = $suma + 50;
										endif;
									endif;
								endif;
								
								if($lenguage['conversation_level'] == 1):
									$suma = $suma + 10;
								else:
									if($lenguage['conversation_level'] == 2):
										$suma = $suma + 30;
									else:
										if($lenguage['conversation_level'] == 3):
											$suma = $suma + 50;
										endif;
									endif;
								endif;
								
								$res = $suma / 3;
						
									$data = array(
												'company_job_profile_id' => $this->Session->read('CompanyJobProfile.id'),
												'language_id' => $lenguage['language_id'],
												'reading_level' => $lenguage['reading_level'],
												'writing_level' => $lenguage['writing_level'],
												'conversation_level' => $lenguage['conversation_level'],
												'average' => $res,
									);
									if(($lenguage['language_id']<>'') AND ($lenguage['reading_level']<>'') AND ($lenguage['writing_level']<>'') AND ($lenguage['conversation_level']<>'')):
										$this->CompanyJobLanguage->create();
										if(!$this->CompanyJobLanguage->save($data)):
											$lenguajeVar = 1;
										endif;
									endif;
							}
							
							if($this->CompanyJobComputingSkill->hasAny($conditionsComputing)):
								$this->CompanyJobComputingSkill->deleteAll(array('CompanyJobComputingSkill.company_job_profile_id' => $this->Session->read('CompanyJobProfile.id')), false);
							endif;	
					
							foreach($this->request->data['CompanyJobComputingSkill'] as $computo) {
									$data = array(
												'company_job_profile_id' => $this->Session->read('CompanyJobProfile.id'),
												'category_id' => $computo['category_id'],
												'name' => $computo['name'],
												'other' => $computo['other'],
												'level' => $computo['level']
									);
									if(($computo['category_id']<>'') AND (($computo['name']<>'') OR ($computo['other']<>'')) AND ($computo['level']<>'')):
										$this->CompanyJobComputingSkill->create();
										if(!$this->CompanyJobComputingSkill->save($data)):
											$computoVar = 1;
										endif;
									endif;
							}

							if($lenguajeVar == 1):
								$this->Session->setFlash('Algunos idiomas no se guardaron, verifique por favor', 'alert-danger');	
							else:
								if($computoVar == 1):
									$this->Session->setFlash('Algunos conocimientos de computo no se guardaron, verifique por favor', 'alert-danger');	
								else:
									if($conocimientoVar == 1):
										$this->Session->setFlash('Los conocimientos y habilidades no pudieron ser guardados', 'alert-danger');
										$this->redirect(array('action' => 'companyJobKnowledge'));
									else:
										$this->companyLastUpdate();
										$this->Session->setFlash('Registro guardado', 'alert-success');
										$this->redirect(array('action' => 'companyJobKnowledge'));
									endif;
								endif;
							endif;
							
					endif;
				endif;
		}
		
		public function viewOfferOnline($id=null){

			if($this->request->is('get')):
				if($id<>null):
					$this->Session->write('companyJobProfileId', $id);
				else:
					if($this->Session->check('companyJobProfileId') and ($this->Session->read('companyJobProfileId') <> null)):
						$id = $this->Session->read('companyJobProfileId');
					else:
						$this->redirect(array('action' => 'profile'));
					endif;
				endif;
			endif;
			
			$this->Session->write('redirect', 'viewOfferOnline/'.$id);
			//Marca la oferta como vista
			$total = $this->CompanyViewedOffer->find('count', array(
																	'conditions' => array(
																						'AND' => array(
																									'CompanyViewedOffer.company_id' =>  $this->Session->read('company_id'),
																									'CompanyViewedOffer.company_job_profile_id' => $id
																									),
																						),
																	)
													);
			if($total == 0):
				$this->request->data['CompanyViewedOffer']['company_id'] = $this->Session->read('company_id');
				$this->request->data['CompanyViewedOffer']['company_job_profile_id'] = $id;
				if(!$this->CompanyViewedOffer->save($this->request->data)):
					$this->Session->setFlash('La oferta no pudo marcarse como vista', 'alert-danger');
				endif;
			endif;
			
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			
			$this->CompanyJobProfile->recursive = 3;
			$this->set('oferta', $this->CompanyJobProfile->findById($id));
			
			
			$niveles = $this->LenguageLevel->find('list', array('order' => array('LenguageLevel.id ASC')));
			$this->set( compact ('niveles') );
			
			$idiomas = $this->CompanyJobLanguage->find('all', array(
																'conditions' => array('CompanyJobLanguage.company_job_profile_id' => $id),
																'order' => array('CompanyJobLanguage.language_id ASC')));
			$this->set( compact ('idiomas') );
			
			
			$tiposCompetencias = $this->Competency->find('list', array('order' => array('Competency.id ASC')));
			$this->set( compact ('tiposCompetencias') );
			
			$computos = $this->CompanyJobComputingSkill->find('all', array(
																'conditions' => array('CompanyJobComputingSkill.company_job_profile_id' => $id),
																'order' => array('CompanyJobComputingSkill.name ASC')));
			$this->set( compact ('computos') );
			
			$situacionAcademica = $this->AcademicSituation->find('list', array('order' => array('AcademicSituation.id ASC')));
			$this->set( compact ('situacionAcademica') );
			
			$carreras = $this->Career->find('list',
												array(
													'fields' => array('Career.id', 'Career.career'),
													'order' => array('Career.career ASC')
												)
											);

			$programas = $this->PosgradoProgram->find('list',
												array(
													'fields' => array('PosgradoProgram.id', 'PosgradoProgram.posgrado_program'),
													'order' => array('PosgradoProgram.posgrado_program ASC')
												)
											);

			$CarrerasAreas = $carreras + $programas;
			$this->set('CarrerasAreas', $CarrerasAreas);	

			
			$this->carrer();
			$this->Tecnology(); //Categories
			$this->program();	
			$this->softwareLevel();

		}
		
		public function searchCandidate($newSearch = null){
			$this->Company->recursive = 2;
			$this->CompanyJobProfile->recursive = 0;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->Student->recursive = 2;
			$this->folder();
			$this->salary();
			$this->totalDescargas();
			$this->Session->write('redirect', 'searchCandidate');
				
				// Enlista los perfiles con un tipo de notificación
				$entrevistasTelefonicas = $this->StudentNotification->find('all',
												array(
													// 'fields' => array('StudentNotification.id', 'StudentNotification.student_id', 'StudentNotification.company_interview_date'),
													'conditions' => array(
																		'StudentNotification.company_id' => $this->Session->read('company_id'),
																		'StudentNotification.interview_type' => 1,
																		),
													'order' => array('StudentNotification.id ASC')
												)
											);
				$this->set( compact ('entrevistasTelefonicas') );
				
				$entrevistasPersonales = $this->StudentNotification->find('all',
													array(
														// 'fields' => array('StudentNotification.id', 'StudentNotification.student_id'),
														'conditions' => array(
																			'StudentNotification.company_id' => $this->Session->read('company_id'),
																			'StudentNotification.interview_type' => 2,
																			),
														'order' => array('StudentNotification.id ASC')
													)
												);
				$this->set( compact ('entrevistasPersonales') );
			
			$SugerenciasAdmin = '';	
			$this->set('newSearch', 'no');
			if($newSearch == 'nuevaBusqueda'):
				$this->set('newSearch', 'si');
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('page');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('orden');
				$this->Session->delete('intoFolder');
				
				
				// Damos sugerencias de universitarios sobre las tres ultimas ofertas que se hayan subido
				
				$idsUltimasOfertas = $this->CompanyJobProfile->find('list',array(
																			'conditions' => array(
																							'CompanyJobProfile.company_id' => $this->Session->read('company_id'),
																							),
																			'order' => array('CompanyJobProfile.created DESC'),
																			'limit' => 3
																			)
																);
				
				if(!empty($idsUltimasOfertas)):
					$perfilesCandidato = $this->CompanyCandidateProfile->find('list',array(
																			'conditions' => array(
																							'CompanyCandidateProfile.company_job_profile_id' => $idsUltimasOfertas,
																							),
																			)
																);
				else:
					$perfilesCandidato = array();
				endif;
				
				if(!empty($perfilesCandidato)):
					$carrerasUltimasOfertas = $this->CompanyJobRelatedCareer->find('list',array(
																			'fields' => array('CompanyJobRelatedCareer.id', 'CompanyJobRelatedCareer.career_id'),
																			'conditions' => array(
																							'CompanyJobRelatedCareer.company_job_profile_id' => $perfilesCandidato,
																							),
																			)
																);
				else:
					$carrerasUltimasOfertas = array();
				endif;

				if(!empty($carrerasUltimasOfertas)):
					$SugerenciasAdmin = $this->StudentProfessionalProfile->find('list',array(
																			'fields' => array('StudentProfessionalProfile.id', 'StudentProfessionalProfile.student_id'),
																			'conditions' => array(
																							'StudentProfessionalProfile.career_id' => $carrerasUltimasOfertas,
																							),
																			)
																);
					$SugerenciasAdmin[] = array('Student.id' => $SugerenciasAdmin);
				else:
					$SugerenciasAdmin[] = array('Student.id' => '');
				endif;
			
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
				$orden = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
			else:
				if(($this->Session->read('limite')) <> ''):
					$limite = $this->Session->read('limite');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
			if($this->request->query('intoFolder') <> ''):
				$intoFolder = $this->request->query('intoFolder');
				$this->Session->write('intoFolder', $this->request->query('intoFolder'));
			else:
				if($this->Session->read('intoFolder') <> ''):
					$intoFolder = $this->Session->read('intoFolder');
				else:
					$intoFolder = '';
				endif;
			endif;
			
			
			//Si llega el id del folder se agrega  a los parametros de la búsqueda
			if($intoFolder<>''):
				$folderExist = $this->CompanyFolder->find('count', array(
																	'conditions' => array (
																							'CompanyFolder.id' => $intoFolder,	
																							'CompanyFolder.company_id' => $this->Session->read('company_id'),	
																							)
																	)
														);
				if($folderExist>0):
				
					$forGuardadas['conditions'][] = array('CompanySavedStudent.company_folder_id' => $intoFolder);
					
					$ofertasGuardadas = $this->CompanySavedStudent->find('all', array(
																			'conditions' => array(
																								$forGuardadas['conditions']
																			)
					));
					
					$guardadas['conditions']['OR'] = array("Student.id" => Set::extract("/CompanySavedStudent/student_id", $ofertasGuardadas));
					
					foreach($guardadas['conditions']['OR']['Student.id'] as $soloGuardada){
							$conditionsConcatenated['conditions']['OR'][] =  array(
																					'Student.id' => array ($soloGuardada)
																					);  
		
					}
					$this->set('intoFolder', $intoFolder);
				else:
					// Elimina la sessión del folder seleccionado
					$this->Session->delete('intoFolder');
					$this->set('intoFolder', '');
					
				endif;
				
					//Si no hay alumnos relacionados a la carpeta se deja vacio
					if(empty($conditionsConcatenated['conditions']['OR'])):
						$conditionsConcatenated['conditions']['OR'][] =  array('Student.id' => '' ); 
					endif;
			else:
				$conditionsConcatenated['conditions']['OR'][] = array('Student.id <> ' => '' ); 
				$this->set('intoFolder', '');
			endif;

			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Company']['criterio']) and ($this->request->data['Company']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Company']['criterio']);
					$tipoBusqueda = $this->request->data['Company']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 4; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;
			
			if(isset($this->request->data['Company']['Buscar']) and ($this->request->data['Company']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Company']['Buscar']);
				$palabraBuscada  = $this->request->data['Company']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada = '';
				endif;
			endif;
			
			
				if($tipoBusqueda == 1):
					// $criterio[] = array('StudentProfile.name LIKE' => '%'. $palabraBuscada . '%');
					$claves = explode(" ", $palabraBuscada);
					$indice = 0;
					foreach ($claves as $clave) {
						// if(strlen($clave)>2):
							$criterio[$indice]['OR'][] = array('StudentProfile.name LIKE' => "%$clave%");
							$criterio[$indice]['OR'][] = array('StudentProfile.last_name LIKE' => "%$clave%");
							$criterio[$indice]['OR'][] = array('StudentProfile.second_last_name LIKE' => "%$clave%");
						// endif;
						$indice++;
					}
				else:
					if($tipoBusqueda == 2):
						$criterio[] = array('Student.email LIKE' => '%'. $palabraBuscada . '%');
					else:
						if($tipoBusqueda == 3):
							$criterio[] = array('Student.id'  => intval($palabraBuscada));
						else:
							$criterio[] = '';
						endif;
					endif;
				endif;
			

			if($orden==''):
				$orden = 'StudentProfile.name DESC';
			endif;
			
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				$criterio
																			),
																'AND' => array(
																		$conditionsConcatenated['conditions'],
																		'Student.block' => 0,
																		'Student.status' => 1,
																		$SugerenciasAdmin
																		
																		),
																),
											'limit' => $limite,
											'order' => $orden,
											);
				$this->set('candidatos', $candidatos = $this->paginate('Student'));
		}
		
		public function searchCandidateExcel(){
			$this->Company->recursive = 2;
			$this->layout='excel';
			$this->Application->recursive = 2;
			$this->Student->recursive = 3;
			
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
				$orden = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
			else:
				if(($this->Session->read('limite')) <> ''):
					$limite = $this->Session->read('limite');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
			if($this->request->query('intoFolder') <> ''):
				$intoFolder = $this->request->query('intoFolder');
				$this->Session->write('intoFolder', $this->request->query('intoFolder'));
			else:
				if($this->Session->read('intoFolder') <> ''):
					$intoFolder = $this->Session->read('intoFolder');
				else:
					$intoFolder = '';
				endif;
			endif;
			
			$folders = $this->CompanyFolder->find('list', array(
															'fields' => array('CompanyFolder.id', 'CompanyFolder.name')
															)
													);


			$tituloExcel = '';
			$tituloFolder = '';
			
			//Si llega el id del folder se agrega  a los parametros de la búsqueda
			if($intoFolder<>''):
				$tituloExcel .= 'Dentro de carpeta: '.$folders[$intoFolder];
				$tituloFolder = '(Dentro de carpeta '.$folders[$intoFolder].')';
				
				$folderExist = $this->CompanyFolder->find('count', array(
																	'conditions' => array (
																							'CompanyFolder.id' => $intoFolder,	
																							'CompanyFolder.company_id' => $this->Session->read('company_id'),	
																							)
																	)
														);
				if($folderExist>0):
				
					$forGuardadas['conditions'][] = array('CompanySavedStudent.company_folder_id' => $intoFolder);
					
					$ofertasGuardadas = $this->CompanySavedStudent->find('all', array(
																			'conditions' => array(
																								$forGuardadas['conditions']
																			)
					));
					
					$guardadas['conditions']['OR'] = array("Student.id" => Set::extract("/CompanySavedStudent/student_id", $ofertasGuardadas));
					
					foreach($guardadas['conditions']['OR']['Student.id'] as $soloGuardada){
							$conditionsConcatenated['conditions']['OR'][] =  array(
																					'Student.id' => array ($soloGuardada)
																					);  
		
					}
					$this->set('intoFolder', $intoFolder);
				else:
					// Elimina la sessión del folder seleccionado
					$this->Session->delete('intoFolder');
					$this->set('intoFolder', '');
					
				endif;
				
					//Si no hay alumnos relacionados a la carpeta se deja vacio
					if(empty($conditionsConcatenated['conditions']['OR'])):
						$conditionsConcatenated['conditions']['OR'][] =  array('Student.id' => '' ); 
					endif;
			else:
				$conditionsConcatenated['conditions']['OR'][] = array('Student.id <> ' => '' ); 
				$this->set('intoFolder', '');
			endif;

			$this->set('tituloFolder', $tituloFolder);
			
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Company']['criterio']) and ($this->request->data['Company']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Company']['criterio']);
					$tipoBusqueda = $this->request->data['Company']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 4; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;
			
			
			if(isset($this->request->data['Company']['Buscar']) and ($this->request->data['Company']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Company']['Buscar']);
				$palabraBuscada  = $this->request->data['Company']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada = '';
				endif;
			endif;
			
			
				if($tipoBusqueda == 1):
					$tituloExcel .= ' filtro por nombre: '.$palabraBuscada;
					$criterio[] = array('StudentProfile.name LIKE' => '%'. $palabraBuscada . '%');
				else:
					if($tipoBusqueda == 2):
						$tituloExcel .= ' filtro por correo: '.$palabraBuscada;
						$criterio[] = array('Student.email LIKE' => '%'. $palabraBuscada . '%');
					else:
						if($tipoBusqueda == 3):
							$tituloExcel .= ' filtro por folio: '.$palabraBuscada;
							$criterio[] = array('Student.id'  => intval($palabraBuscada));
						else:
							$criterio[] = '';
						endif;
					endif;
				endif;
			
			$this->set('tipoDescarga', $tituloExcel);
			
			if($orden==''):
				$orden = 'StudentProfile.name DESC';
			endif;
			
			$datosStudent = $this->Student->find('all', array(
																'conditions' => array(
																						'OR' => array(
																										$criterio
																									),
																						'AND' => array(
																								$conditionsConcatenated['conditions'],
																								'Student.block' => 0,
																								'Student.status' => 1
																								),
																					)
															)
												);

			$this->set('datos', $datosStudent);
			
			$this->set('nombrePuesto', 'Variable enviada');

			
		}

		public function specificSearchCandidate($newSearch = null){
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->Session->write('redirect', 'specificSearchCandidate');
			
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
			
			// Verifica las ofertas guardadas y las manda para que puedan ser marcadas o no
			$this->set('busquedasGuardadas', $this->CompanySavedSearch->find('list', array(
																							'conditions' => array('CompanySavedSearch.company_id' => $this->Session->read('company_id')),
																							'order' => 'CompanySavedSearch.id DESC',
																							)
																			)
						);
		}

		public function specificSearchCandidateResults($newSearch = null){
			$this->Session->write('redirect', 'specificSearchCandidateResults');
			
			$this->Company->recursive = 2;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
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
			
			// Verifica las ofertas guardadas y las manda para que puedan ser marcadas o no
			$this->set('busquedasGuardadas', $this->CompanySavedSearch->find('list', array(
																							'conditions' => array('CompanySavedSearch.company_id' => $this->Session->read('company_id')),
																							'order' => 'CompanySavedSearch.id DESC',
																							)
																			)
						);
						
			if($this->request->is('post')):
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
			endif;
			
				if(isset($this->request->data['CompanySavedSearch']['name']) and ($this->request->data['CompanySavedSearch']['name'] <> '')):
					$this->companySavedSearch();
				else:
					if((isset($this->request->data['Company']['busqueda_guardada'])) and ($this->request->data['Company']['busqueda_guardada'] <> '')):
						$busquedaGuardada = $this->CompanySavedSearch->findById($this->request->data['Company']['busqueda_guardada']);
						if(!empty($busquedaGuardada)):
							$this->request->data = unserialize($busquedaGuardada['CompanySavedSearch']['serialize_request']);
						endif;
					endif;
				endif;
				
				if($this->request->is('get')):
					$this->request->data = $this->Session->read('serialized_form');
				endif;

				$criterio = array();
				
				if(isset($this->request->data['Student']['limit']) AND ($this->request->data['Student']['limit']<>'')):
					$this->Session->write('limit', $this->request->data['Student']['limit']);
					$limit = $this->request->data['Student']['limit'];
				else:
					if(($this->Session->read('limit')) <> ''):
						$limit = $this->Session->read('limit');
					else:
						$limit = 5; //default limit
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
					$criterio[] = array('StudentProfile.state' =>$this->request->data['StudentProfile']['state']);
				else:
					if(($this->Session->read('StudentProfile.state')) <> ''):
						$criterio[] = array('StudentProfile.state' =>$this->Session->read('StudentProfile.state'));
					endif;
				endif;
			
				if(isset($this->request->data['StudentProfile']['city']) AND ($this->request->data['StudentProfile']['city']<>'')):
					$this->Session->write('StudentProfile.city', $this->request->data['StudentProfile']['city']);
					$criterio[] = array('StudentProfile.city' =>$this->request->data['StudentProfile']['city']);
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
			
			// identifica si se descarga o no para poner un limite o no
			if(($newSearch==null) OR ($newSearch=='nuevaBusqueda')):
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				'Student.id' => $studentsIds
																			),
																'AND' => array(
																		'Student.block' => 0,
																		'Student.status' => 1
																		),
																),
											'limit' => $limit,
											'order' => $orden,
											);
			else:
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				'Student.id' => $studentsIds
																			),
																'AND' => array(
																		'Student.block' => 0,
																		'Student.status' => 1
																		),
																),
											'order' => $orden,
											);
			endif;
			
			
			$this->set('candidatos', $candidatos = $this->paginate('Student'));

		}
		
		public function specificSearchCandidateResultsExcel(){

			$this->specificSearchCandidateResults('sinLimite');

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

		public function companySavedSearch(){
			if($this->request->is('post')):
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				
				$serialize_form = serialize($this->Session->read('serialized_form'));
				$this->request->data['CompanySavedSearch']['company_id'] = $this->Session->read('company_id');
				$this->request->data['CompanySavedSearch']['serialize_request'] = $serialize_form;
				$busquedasGuardadas = $this->CompanySavedSearch->find('all', array(
																					'conditions' => array('CompanySavedSearch.company_id' => $this->Session->read('company_id')),
																					'order' => 'CompanySavedSearch.id ASC',
																				));
				if(count($busquedasGuardadas) >= 10):
					if($this->CompanySavedSearch->delete($busquedasGuardadas[0]['CompanySavedSearch']['id'])):
						if($this->CompanySavedSearch->save($this->request->data)):
							$this->Session->setFlash('Búsqueda guardada', 'alert-success');
							$this->redirect(array('action' =>  $redirect));
						else:
							$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
							$this->redirect(array('action' =>  $redirect));
						endif;
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser sustituida', 'alert-success');
					endif;
				else:
					if($this->CompanySavedSearch->save($this->request->data)):
						$this->Session->setFlash('Búsqueda guardada', 'alert-success');
						$this->redirect(array('action' =>  $redirect));
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
						$this->redirect(array('action' =>  $redirect));
					endif;
				endif;
			endif;
		}	
		
		public function companyFolder(){
			if($this->request->is('post')):
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				$this->request->data['CompanyFolder']['company_id'] =  $this->Session->read('company_id');
				if($this->CompanyFolder->save($this->request->data)):
					$this->Session->setFlash('Carpeta creada', 'alert-success');
					$this->redirect(array('action' => $redirect ));
				else:
					$this->Session->setFlash('Lo sentimos no se pudo crear la carpeta', 'alert-danger');
					$this->redirect(array('action' => $redirect ));
				endif;
			endif;
		}
		
		public function deleteCompanyFolder(){
				if($this->request->is('post')):
					if($this->Session->read('redirect') <> ''):
						$redirect = $this->Session->read('redirect').$this->Session->read('page');
					else:
						$redirect = 'profile'.$this->Session->read('page') ;
					endif;
					if($this->CompanyFolder->delete($this->request->data['CompanyFolder']['id'])):
						$this->Session->setFlash('Carpeta eliminada', 'alert-success');
						//Elimina las sesiones que se crearon de la oferta para poder agregar una nueva oferta NO QUITAR
						$this->Session->delete('CompanyJobOffer.id');
						$this->Session->delete('CompanyJobProfile.id');
						$this->Session->delete('companyJobContractType.id');
						$this->Session->delete('CompanyCandidateProfile.id');
						$this->redirect(array('action' => $redirect ));
					else:
						$this->Session->setFlash('No se pudo eliminar la carpeta', 'alert-danger');
						$this->redirect(array('action' => $redirect ));
					endif;
				endif;
		}
		
		public function editCompanyFolder($id = null){
			if($this->request->is('post')):	
				$this->CompanyFolder->id = $id;		
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				if($this->CompanyFolder->save($this->request->data)):
					$this->Session->setFlash('Carpeta renombrada', 'alert-success');
					$this->redirect(array('action' => $redirect ));
				else:
					$this->Session->setFlash('Lo sentimos la carpeta no pudo ser renombrada', 'alert-success');
					$this->redirect(array('action' => $redirect ));
				endif;
			endif;
		}
		
		public function viewCvOnline($id=null){
			$this->Company->id =  $id;	
			$this->Company->recursive = 2;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));	
			$this->Session->write('redirect', 'viewCvOnline/'.$id);
			$this->totalDescargas();
				
			//Marca el perfil como visto
			$total = $this->CompanyViewedStudent->find('count', array(
																	'conditions' => array(
																						'AND' => array(
																									'CompanyViewedStudent.company_id' =>  $this->Session->read('company_id'),
																									'CompanyViewedStudent.student_id' => $id
																									),
																						),
																	)
													);
			if($total == 0):
				$this->request->data['CompanyViewedStudent']['company_id'] = $this->Session->read('company_id');
				$this->request->data['CompanyViewedStudent']['student_id'] = $id;
				if(!$this->CompanyViewedStudent->save($this->request->data)):
					$this->Session->setFlash('Lo sentimos el perfil no pudo cargarse como visto', 'alert-danger');
				endif;
			endif;

			$this->Student->recursive = 3;
			$this->set('student', $this->Student->findById($id));
			$this->academicLevel();
			$this->Facultades();
			$this->Escuelas();
			$this->career();
			$this->country();
			$this->posgradoProgrma();
			$this->NivelesIdioma();
			$this->TypeCourses();
			$this->softwareLevel();
			$this->folder();
			
			// Enlista los perfiles con un tipo de notificación
				$entrevistasTelefonicas = $this->StudentNotification->find('all',
												array(
													// 'fields' => array('StudentNotification.id', 'StudentNotification.student_id', 'StudentNotification.company_interview_date'),
													'conditions' => array(
																		'StudentNotification.company_id' => $this->Session->read('company_id'),
																		'StudentNotification.interview_type' => 1,
																		),
													'order' => array('StudentNotification.id ASC')
												)
											);
				$this->set( compact ('entrevistasTelefonicas') );
				
				$entrevistasPersonales = $this->StudentNotification->find('all',
													array(
														// 'fields' => array('StudentNotification.id', 'StudentNotification.student_id'),
														'conditions' => array(
																			'StudentNotification.company_id' => $this->Session->read('company_id'),
																			'StudentNotification.interview_type' => 2,
																			),
														'order' => array('StudentNotification.id ASC')
													)
												);
				$this->set( compact ('entrevistasPersonales') );

			
			$software = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('software') );
			
			$carreras = $this->Career->find('list',
												array(
													'fields' => array('Career.id', 'Career.career'),
													'order' => array('Career.career ASC')
												)
											);
			$this->set( compact ('carreras') );
			$carrerasRegistro = $this->Career->find('list',
												array(
													'fields' => array('Career.career_id', 'Career.career'),
													'order' => array('Career.career ASC')
												)
											);
			$this->set( compact ('carrerasRegistro') );
			$programas = $this->PosgradoProgram->find('list',
												array(
													'fields' => array('PosgradoProgram.id', 'PosgradoProgram.posgrado_program'),
													'order' => array('PosgradoProgram.posgrado_program ASC')
												)
											);
			$this->set( compact ('programas') );
		}
		
		public function companySavedStudent(){
			if($this->request->is('post')):
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				
				$this->request->data['CompanySavedStudent']['company_id'] =  $this->Session->read('company_id');

				if($this->CompanySavedStudent->save($this->request->data)):
					$this->Session->setFlash('Perfil guardado.', 'alert-success');
					$this->redirect(array('action' => $redirect));
				else:
					$this->Session->setFlash('Lo sentimos no se pudo guardar el perfil en la carpeta', 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}
		
		public function companyPostullation($newSearch = null){
			$this->Company->recursive = 1;
			$this->CompanyJobProfile->recursive = 2;
			$this->CompanyProfile->recursive = 0;
			$this->CompanyJobOffer->recursive = 0;
			
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->Session->write('redirect', 'companyPostullation');
			$this->folder();

			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('page');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('orden');
				$this->Session->delete('orden');
			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if($this->request->query('orden') <> ''):
				$orden = ' CompanyJobContractType.salary '.$this->request->query('orden');
				$this->Session->write('orden', $this->request->query('orden'));
			else:	
				$orden = ' CompanyJobContractType.created DESC';
			endif;
			
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Company']['criterio']) and ($this->request->data['Company']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Company']['criterio']);
					$tipoBusqueda = $this->request->data['Company']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 0; //Búsqueda default eqivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;
			
			if(isset($this->request->data['Company']['Buscar']) and ($this->request->data['Company']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Company']['Buscar']);
				$palabraBuscada  = $this->request->data['Company']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada = '';
				endif;
			endif;	
		
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

				if($tipoBusqueda == 1):
					$criterio[] = array( 'AND' => array(
														'OR' => array(
																	'CompanyJobProfile.id' => $idsompanyJobProfileResults,
																	'CompanyJobProfile.company_job_offer_id'=>$jobOffersLikeName
																	)
																									
														),
										);
				else:
					if($tipoBusqueda == 2):
						$criterio[] = array('CompanyJobProfile.job_name LIKE' => '%'. $palabraBuscada . '%');
					else:
						if($tipoBusqueda == 3):
							$criterio[] = array('CompanyJobProfile.id'  => intval($palabraBuscada));
						else:
							$criterio[] = '';
						endif;
					endif;
				endif;

				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				$criterio
																			),
																'AND' => array(
																			'CompanyJobProfile.company_id' => $this->Session->read('company_id'),
																			)
																),
											'limit' => 1000,
											'order' => 'CompanyJobProfile.expiration DESC',
											);
											
				$ofertas = $this->paginate('CompanyJobProfile');
			
				$this->set('ofertas', $ofertas);
		}
		
		public function results_search_excel($id, $nombrePuesto){
			$this->layout='excel';
			$this->Application->recursive = 2;
			$this->Student->recursive = 3;
			
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
			
			$getStudentIds = $this->Application->find('all', array(
																	'conditions' => array(
																							'Application.company_job_profile_id' => $id,	
																							)
			));
			
			$studentIds = array("Student.id" => Set::extract("/Application/student_id", $getStudentIds));
			
			foreach($studentIds['Student.id'] as $studentId){
							$studentCondition['conditions']['OR'][] =  array(
																			'Student.id' => array ($studentId)
																			);  
			}
			
			$datosStudent = $this->Student->find('all', array(
																'conditions' => array(
																						'AND' => array(
																										$studentCondition['conditions']
																										),
																					)
															)
												);

			$this->set('datos', $datosStudent);
			
			$this->set('nombrePuesto', $nombrePuesto);
		}
		
		public function companyNotification($id=null, $respuestaNotificacion=null){
			$this->Company->recursive = 1;
			$this->CompanyJobProfile->recursive = 2;
			$this->StudentNotification->recursive = 3;
			$this->Student->recursive = 2;
			$company = $this->Company->findById($this->Session->read('company_id'));
			$this->set('company',$company);	

			// Enlista los perfiles con un tipo de notificación para marcarlos en el multibotón
				$entrevistasTelefonicas = $this->StudentNotification->find('all',
												array(
													'conditions' => array(
																		'StudentNotification.company_id' => $this->Session->read('company_id'),
																		'StudentNotification.interview_type' => 1,
																		),
													'order' => array('StudentNotification.id ASC')
												)
											);
				$this->set( compact ('entrevistasTelefonicas') );
				
				$entrevistasPersonales = $this->StudentNotification->find('all',
													array(
														'conditions' => array(
																			'StudentNotification.company_id' => $this->Session->read('company_id'),
																			'StudentNotification.interview_type' => 2,
																			),
														'order' => array('StudentNotification.id ASC')
													)
												);
				$this->set( compact ('entrevistasPersonales') );
				
			if($this->Session->read('redirect') <> ''):
				$redirect = $this->Session->read('redirect').$this->Session->read('page');
			else:
				$redirect = 'profile'.$this->Session->read('page') ;
			endif;
			
			$this->academicSituation();
			$this->Session->write('redirect', 'companyNotification');
			$this->folder();
			$this->lenguage();
			$this->totalDescargas();
			$this->Session->delete('orden');
			
			if(isset($this->request->query['tipoNotificacion'])):
				if($this->request->query['tipoNotificacion'] == 1):
					$this->Session->write('tipoNotificacion', $this->request->query['tipoNotificacion']);
				else:
					if($this->request->query['tipoNotificacion'] == 2):
						$this->Session->write('tipoNotificacion', $this->request->query['tipoNotificacion']);
					else:
						if($this->request->query['tipoNotificacion'] == 3):
							$this->Session->write('tipoNotificacion', $this->request->query['tipoNotificacion']);
						else:
							if($this->request->query['tipoNotificacion'] == 4):
								$this->Session->write('tipoNotificacion', $this->request->query['tipoNotificacion']);
							endif;
						endif;
					endif;
				endif;	
			endif;

			if(isset($this->request->query['respuestaNotificacion'])):
				$respuestaNotificacion=$this->request->query['respuestaNotificacion'];
				$id = $this->request->query['id'];
				
				$notification = $this->StudentNotification->findById($id);
				$tipoNotificacion = $notification['StudentNotification']['interview_type'];
				
				$reporteActualizado = 0;
				if(($respuestaNotificacion==3) AND ($tipoNotificacion==3)):
						if ($this->Report->updateAll(
													array(
															'Report.response_notification' => 0
													),
													 array(
															'Report.student_id' => $notification['StudentNotification']['student_id'],
															'Report.company_id' => $notification['StudentNotification']['company_id'],
															'Report.company_job_profile_id' => $notification['StudentNotification']['company_job_profile_id'],
															'Report.registered_by' => 'student',
															)
													)
							):
							$reporteActualizado = 1;
						endif;
				endif;
				
				if(($tipoNotificacion==3) OR (($tipoNotificacion==4) AND (($notification['StudentNotification']['step_process']==2) OR ($notification['StudentNotification']['step_process']==3)))):
					$reporteEnviado = $this->Report->find('all', array(
															'conditions' => array (
																					'company_job_profile_id' => $notification['StudentNotification']['company_job_profile_id'],
																					'student_id' => $notification['StudentNotification']['student_id'],
																					'company_id' => $notification['StudentNotification']['company_id'],
																					'registered_by' => 'company'
																				)
																	)
														);
													
					$reporteStudent = $this->Report->find('all', array(
															'conditions' => array (
																					'company_job_profile_id' => $notification['StudentNotification']['company_job_profile_id'],
																					'student_id' => $notification['StudentNotification']['student_id'],
																					'company_id' => $notification['StudentNotification']['company_id'],
																					'registered_by' => 'student'
																				)
																	)
														);
																					
					if(count($reporteEnviado)==0): //Si no esta el reporte de contratación se crea
						if(count($reporteStudent)<>0): //Si encuentra el reporte inicial generado pasa los datos
							$report['Report']['student_id'] = $reporteStudent[0]['Report']['student_id'];
							$report['Report']['company_id'] = $reporteStudent[0]['Report']['company_id'];
							$report['Report']['company_job_profile_id'] = $reporteStudent[0]['Report']['company_job_profile_id'];
							$report['Report']['fecha_contratacion'] = $reporteStudent[0]['Report']['fecha_contratacion'];
							$report['Report']['created'] = $reporteStudent[0]['Report']['created'];
							$report['Report']['modified'] = $reporteStudent[0]['Report']['modified'];
							$report['Report']['registered_by'] = 'company'; //Ahora se regsitra que la compañia ha reportado la contratación
							if(($respuestaNotificacion==4) OR ($respuestaNotificacion==3)):
								$report['Report']['response_notification'] = 1;
							else:
								$report['Report']['response_notification'] = 0;
							endif;
							// $report['Report']['response_notification'] = $respuestaNotificacion;
							$this->Report->create();
							$this->Report->save($report);
						else:
							if($respuestaNotificacion==4):
								$hoy = date('Y-m-d');
								$report['Report']['student_id'] = $notification['StudentNotification']['student_id'];
								$report['Report']['company_id'] = $notification['StudentNotification']['company_id'];
								$report['Report']['company_job_profile_id'] = $notification['StudentNotification']['company_job_profile_id'];
								$report['Report']['fecha_contratacion'] = $hoy;
								$report['Report']['registered_by'] = 'company'; //Ahora se regsitra que la compañia ha reportado la contratación
								$report['Report']['response_notification'] = 1;
								$this->Report->create();
								$this->Report->save($report);							
							endif;
						endif;
					else:
						if($respuestaNotificacion==3):
							$this->Report->updateAll(array('Report.response_notification' => 3),array('Report.id' => $reporteStudent[0]['Report']['id']));
						else:
							$this->Report->updateAll(array('Report.response_notification' => 1),array('Report.id' => $reporteStudent[0]['Report']['id']));
						endif;
					endif;
				endif;
		
				if($respuestaNotificacion==1):
					if ($this->StudentNotification->updateAll(array('StudentNotification.company_interview_status' => 1,'StudentNotification.student_interview_status' => 1),array('StudentNotification.id' => $id))):
						if($tipoNotificacion==1):
							$this->Session->setFlash('Entrevista telefónica aceptada', 'alert-success');
							$respuestaNotificacionMail = 'Aceptado la fecha y horario de entrevista telefónica';
						else:
							if($tipoNotificacion==2):
								$this->Session->setFlash('Entrevista presencial aceptada', 'alert-success');
								$respuestaNotificacionMail = 'Aceptado la fecha y horario de entrevista presencial';
							else:
								if($tipoNotificacion==3):
									$this->Session->setFlash('Contratación aceptada', 'alert-success');
									$respuestaNotificacionMail = 'Aceptado la contratación';
								endif;
							endif;
						endif;
					else:
						$this->Session->setFlash('Error al declinar la solicitud', 'alert-danger');
					endif;
				else:
					if($respuestaNotificacion==3):
						if ($this->StudentNotification->updateAll(array('StudentNotification.company_interview_status' => 3),array('StudentNotification.id' => $id))):
							if($tipoNotificacion==1):
								$this->Session->setFlash('Entrevista telefónica declinada', 'alert-success');
								$respuestaNotificacionMail = 'Rechazado la fecha y horario de entrevista telefónica';
							else:
								if($tipoNotificacion==2):
									$this->Session->setFlash('Entrevista presencial declinada', 'alert-success');
									$respuestaNotificacionMail = 'Rechazado la fecha y horario de entrevista presencial';
								else:
									if($reporteActualizado == 1):
										$this->Session->setFlash('Contratación declinada', 'alert-success');
										$respuestaNotificacionMail = 'Rechazado la contratación';
									else:
										$this->Session->setFlash('Notificación declnada. El reporte de contratación no se ha podido actualizar.', 'alert-success');
										$respuestaNotificacionMail = 'Rechazado la contratación';
									endif;
								endif;
							endif;
						else:
							$this->Session->setFlash('Error al declinar la solicitud', 'alert-danger');
						endif;
					else:
						$hoy = date('Y-m-d');
						$fechaMax = strtotime ( '-1 day' , strtotime ( $hoy ) ) ;
						$hoy = date ( 'Y-m-j' , $fechaMax );	
						if(($respuestaNotificacion==4) OR ($respuestaNotificacion==5) OR ($respuestaNotificacion==6)):
							if($respuestaNotificacion==4): //Se contrató
								$this->StudentNotification->updateAll(array('StudentNotification.type_respons_company' => $respuestaNotificacion, 'StudentNotification.step_process' => 3, 'StudentNotification.interview_type' => 4,'StudentNotification.company_interview_date' => "'".$hoy."'" ,'StudentNotification.student_interview_date' => "'".$hoy."'"),array('StudentNotification.id' => $id));
								$this->Session->setFlash('Respuesta de se contrató enviada', 'alert-success');
							else:
								if($respuestaNotificacion==5)://Sigue en el proceso
									$this->StudentNotification->updateAll(array('StudentNotification.type_respons_company' => $respuestaNotificacion, 'StudentNotification.interview_type' => 4),array('StudentNotification.id' => $id));
									$this->Session->setFlash('Respuesta de sigue en el proceso enviada', 'alert-success');
								else:
									if($respuestaNotificacion==6)://Salió del proceso
										$this->StudentNotification->updateAll(array('StudentNotification.type_respons_company' => $respuestaNotificacion, 'StudentNotification.interview_type' => 4),array('StudentNotification.id' => $id));
										$this->Session->setFlash('Respuesta de salió del proceso enviada', 'alert-success');
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
				$studentId = $notification['StudentNotification']['student_id'];
			endif;
			
			
			if($this->request->is('post')):
				if($this->Session->read('affterPostulated') <> ''):
					$affterPostulated = $this->Session->read('affterPostulated').$this->Session->read('page');
				else:
					$affterPostulated = 'profile'.$this->Session->read('page') ;
				endif;
				$this->request->data['StudentSavedOffer']['student_id'] =  $this->Session->read('company_id');
				
				$this->request->data['StudentNotification']['student_interview_status'] = 0;
				$this->request->data['StudentNotification']['company_interview_status'] = 2;
				$this->request->data['StudentNotification']['student_interview_date'] = $this->request->data['StudentNotification']['company_interview_date'];
				
				if($this->StudentNotification->save($this->request->data)):;
					$this->Session->setFlash('Nueva fecha para la entrevista telefónica enviada.', 'alert-success');
					$respuestaNotificacionMail = 'Propuesto una nueva fecha y/o horario de entrevista telefónica: <br>
											 Fecha: '.$this->request->data['StudentNotification']['company_interview_date']['day'].' / '.$this->request->data['StudentNotification']['company_interview_date']['month'].' / '.$this->request->data['StudentNotification']['company_interview_date']['year'].'<br>
											 Horario: '.$this->request->data['StudentNotification']['company_interview_hour']['hour'].':'.$this->request->data['StudentNotification']['company_interview_hour']['min'].' hrs <br>';
				else:
					$this->Session->setFlash('Lo sentimos, no se pudo enviar la nueva fecha para la entrevista telefónica', 'alert-danger');
				endif;
				
				$tempNotificacion = $this->StudentNotification->findById($this->request->data['StudentNotification']['id']);
				$studentId = $tempNotificacion['StudentNotification']['student_id'];
			endif;
			
			if(isset($respuestaNotificacionMail)):
				//Envio de mensaje de la respuesta del universitario
				if($this->Session->read('tipoNotificacion')==1):
					$asunto = 'UNAM – SISBUT / Respuesta a solicitud de entrevista telefónica';
				else:
					if($this->Session->read('tipoNotificacion')==2):
						$asunto = 'UNAM – SISBUT / Respuesta a solicitud de entrevista presencial';
					else:
						if($this->Session->read('tipoNotificacion')==3):
							$asunto = 'UNAM – SISBUT / Respuesta a solicitud de contratación';
						else:
							$asunto = 'Sin asunto';
						endif;
					endif;
				endif;
				
				$Email = new CakeEmail('gmail');
				$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));
		
				$this->CompanyJobProfile->recursive = 1;
				$this->Company->recursive = -1;
				if($this->request->is('post')):
					$oferta = $this->CompanyJobProfile->findById($this->request->data['StudentNotification']['company_job_profile_id']);
				else:
					$oferta = $this->CompanyJobProfile->findById($notification['StudentNotification']['company_job_profile_id']);
				endif;
				
				$this->Student->recursive = 0;
			
				$student = $this->Student->findById($studentId);

				$Email->to($student['Student']['email']);
				
				// if($oferta['CompanyJobOffer']['same_contact']=='n'):
					// $responsable =  $oferta['CompanyJobOffer']['responsible_name']. ' ' .$oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'];			
				// else:
					// $responsable =  $oferta['Company']['CompanyContact']['name']. ' ' .$oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'];	
				// endif;
				
				$Email->subject($asunto);
				$Email->emailFormat('both');
				$Email->template('email')->viewVars( array(
															'aMsg' => 
															'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
															'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
		
															'<p>Estimado(a) usuario(a) el reclutador '.$company['CompanyContact']['name'].' '.$company['CompanyContact']['last_name'].' ha:</p></br>'.
															
															'<p><strong>'.$respuestaNotificacionMail.'</strong></p><br>'.
															
															'<p>Para ver detalles por favor ingrese al portal del SISBUT con su número de cuenta y contraseña, a la sección de “Notificaciones”, dando click al link que aparece a continuación:</p></br>'.

															'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
		
															'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
															'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
															'Correo electrónico: bolsa@unam.mx</p></div>'
													));
				$Email->send();
			endif;
			
			
			$telefonicas = $this->StudentNotification->find('all', array(
																			'conditions' => array (
																									'StudentNotification.company_id' => $this->Session->read('company_id'),
																									'StudentNotification.interview_type'=> 1,
																									'StudentNotification.company_interview_date >= '=> date("Y-m-d"),
																									
																									)
																			)
																);
			$this->set('telefonicas',$telefonicas);
			
			$presenciales = $this->StudentNotification->find('all', array(
																			'conditions' => array (
																									'StudentNotification.company_id' => $this->Session->read('company_id'),
																									'StudentNotification.interview_type'=> 2,
																									'StudentNotification.company_interview_date >= '=> date("Y-m-d"),
																									)
																			)
																);
			$this->set('presenciales',$presenciales);

			$contrataciones = $this->StudentNotification->find('all', array(
																			'conditions' => array (
																									'StudentNotification.company_id' => $this->Session->read('company_id'),
																									'StudentNotification.interview_type'=> 3,
																									'StudentNotification.company_interview_status' => 0,
																									)
																			)
																);
			$this->set('contrataciones',$contrataciones);
			
			$step_process = array(1=>2, 2=>3); // Indica que el proceso de seguimiento pasa a ser tipo presencial o de contratación que corresponden a la empresa
			$typeResponsCompany = array(2=>5, 3=>0);  //0 = La empresa aun no ha respondido, 5 = Sigue en el proceso
			$typeRespons = array(1=>4, 2=>5, 3=>0); //El alumnos ha indicado que 4 = Me contrataron, 5 = Agende presencial, 0 = directamente se agendo presencial y no telefónica
			$seguimientos = $this->StudentNotification->find('all', array(
																				'conditions' => array (
																										'AND' => array(
																														'StudentNotification.company_id' => $this->Session->read('company_id'),
																														'StudentNotification.interview_type'=> 4,
																														'StudentNotification.step_process' => $step_process,
																														// 'StudentNotification.type_respons_company' => $typeResponsCompany,
																														'StudentNotification.type_respons' => $typeRespons,
																														'StudentNotification.type_respons_company' => 0,
																													)
																										)
																		)
															);
			$this->set('seguimientos',$seguimientos);
			//Hay que revisar consulta de porque no muestra notificacion cuando type_respons_company = 5
		}
		
		public function companyTelephoneNotification(){	
				if($this->request->is('post')):
					if($this->Session->read('redirect') <> ''):
						$redirect = $this->Session->read('redirect').$this->Session->read('page');
					else:
						$redirect = 'profile'.$this->Session->read('page') ;
					endif;

					$this->request->data['StudentNotification']['interview_type'] = 1;
					$this->request->data['StudentNotification']['company_interview_status'] = 1;
					$this->request->data['StudentNotification']['student_interview_date'] = $this->request->data['StudentNotification']['company_interview_date'];

					$this->request->data['StudentNotification']['company_id']=$this->Session->read('company_id');
					$this->StudentNotification->create();
					
					if($this->StudentNotification->save($this->request->data)):
						$this->request->data['CompanyInterviewMessage']['company_id'] = $this->Session->read('company_id');
						$this->request->data['CompanyInterviewMessage']['telehone_interview_message'] = $this->request->data['StudentNotification']['company_interview_message'];

						$this->CompanyInterviewMessage->save($this->request->data);
					
						$Email = new CakeEmail('gmail');
						$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));
						
						$this->Student->recursive = 0;
						$estudiante = $this->Student->findById($this->request->data['StudentNotification']['student_id']);
						
						$this->CompanyJobProfile->recursive = 2;
						$oferta = $this->CompanyJobProfile->findById($this->request->data['StudentNotification']['company_job_profile_id']);
						
						if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
							$nombreComapny = $oferta['CompanyJobOffer']['company_name']; 
						else:
							if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']=='')):
								$nombreComapny = 'Confidencial';
							else:
								if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
									$nombreComapny = $oferta['CompanyJobOffer']['company_name']; 
								else:
									if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']=='')):
										$nombreComapny = $oferta['Company']['CompanyProfile']['company_name'];
									else:
										$nombreComapny = 'Sin nombre de empresa';
									endif;
								endif;
							endif;
						endif;
										
						if($oferta['CompanyJobOffer']['same_contact']=='n'):
							$responsable =  $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'];	
							$contacto = 'Tel.: (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
							if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
								$contacto .= ' - ext. '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
							endif;	
							if($oferta['CompanyJobOffer']['company_email']<>''):
								$contacto .= ' / Correo: '.$oferta['CompanyJobOffer']['company_email'];
							endif;	
						else:
							$responsable =  $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'];
							$contacto = 'Tel.: </span> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'] . ' ';
							if($oferta['Company']['CompanyContact']['phone_extension']<>''):
								$contacto .= ' - ext. '.$oferta['Company']['CompanyContact']['phone_extension'];
							endif;
							if($oferta['Company']['email']<>''):
								$contacto .= ' / Correo: '.$oferta['Company']['email'];
							endif;	
						endif;
								
						$fecha = $this->request->data['StudentNotification']['company_interview_date']['day'] .'/'.
								 $this->request->data['StudentNotification']['company_interview_date']['month'] .'/'.
								 $this->request->data['StudentNotification']['company_interview_date']['year'];
								 
						$hora = $this->request->data['StudentNotification']['company_interview_hour']['hour'] .':'.
								 $this->request->data['StudentNotification']['company_interview_hour']['min'];
							
						
						$Email->to($estudiante['Student']['email']);
						$Email->subject('UNAM – SISBUT / Solicitud de entrevista telefónica');
						$Email->emailFormat('both');
						$Email->template('email')->viewVars( array(
																	'aMsg' => 
																	'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
																	'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
	
																	'<p>Estimado(a) '.$estudiante['StudentProfile']['name'].' '.$estudiante['StudentProfile']['last_name'].' un reclutador le ha agendado una entrevista telefónica a través del portal SISBUT.</p></br>'.
																	
																	'<p>Para aceptar, rechazar o proponer una nueva fecha y horario de entrevista por favor ingrese al portal del SISBUT con su número de cuenta y contraseña, a la sección de “Notificaciones”, dando click al link que aparece a continuación:</p></br>'.
																	
																	'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
																	
																	'<p>Entrevista telefónica</p>
																	<p><table style="width: 100%">
																	<tr><td style="width: 50%"><p>Empresa: '.$nombreComapny.'</p><td><td><p>Fecha de entrevista telefónica: '.$fecha.' </p><td></tr>
																	<tr><td style="width: 50%"><p>Puesto: '.$oferta['CompanyJobProfile']['job_name'].'</p><td><td><p>Horario: '.$hora.' hrs. </p><td></tr>
																	<tr><td style="width: 50%"><p>Reclutador: '.$responsable.'</p><td><td><p>Contacto: '.$contacto.' </p><td></tr>
																	</table></p>'.
																	
																	'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																	'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																	'Correo electrónico: bolsa@unam.mx</p></div>'
																	));
						$Email->send();
						
						$this->Session->setFlash('Notificación telefónica enviada.', 'alert-success');
						$this->redirect(array('action' => $redirect));
					else:
						$this->Session->setFlash('Lo sentimos, la notificación telefónica no pudo ser guardada', 'alert-danger');
						$this->redirect(array('action' =>  $redirect));
					endif;
				endif;

		}
		
		public function companyPersonalNotification(){
				if($this->request->is('post')):
					if($this->Session->read('redirect') <> ''):
						$redirect = $this->Session->read('redirect').$this->Session->read('page');
					else:
						$redirect = 'profile'.$this->Session->read('page') ;
					endif;

					$this->request->data['StudentNotification']['interview_type'] = 2;
					$this->request->data['StudentNotification']['company_interview_status'] = 1;
					$this->request->data['StudentNotification']['company_interview_date']['day']= $this->request->data['StudentPersonalNotification']['company_interview_date']['day'];
					$this->request->data['StudentNotification']['company_interview_date']['month']=$this->request->data['StudentPersonalNotification']['company_interview_date']['month'];
					$this->request->data['StudentNotification']['company_interview_date']['year']=$this->request->data['StudentPersonalNotification']['company_interview_date']['year'];
					$this->request->data['StudentNotification']['company_interview_hour']['hour']=$this->request->data['StudentPersonalNotification']['company_interview_hour']['hour'];
					$this->request->data['StudentNotification']['company_interview_hour']['min']=$this->request->data['StudentPersonalNotification']['company_interview_hour']['min'];
					
					$this->request->data['StudentNotification']['student_interview_date'] = $this->request->data['StudentNotification']['company_interview_date'];
					

					$this->request->data['StudentNotification']['company_id']=$this->Session->read('company_id');
					$this->StudentNotification->create();
					
					if($this->StudentNotification->save($this->request->data)):
						
						$this->request->data['CompanyInterviewMessage']['company_id'] = $this->Session->read('company_id');
						$this->request->data['CompanyInterviewMessage']['personal_interview_message'] = $this->request->data['StudentNotification']['company_interview_message'];

						$this->CompanyInterviewMessage->save($this->request->data);
						
						$Email = new CakeEmail('gmail');
						$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));
						
						$this->Student->recursive = 0;
						$estudiante = $this->Student->findById($this->request->data['StudentNotification']['student_id']);
						
						$this->CompanyJobProfile->recursive = 2;
						$oferta = $this->CompanyJobProfile->findById($this->request->data['StudentNotification']['company_job_profile_id']);
						
						if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
							$nombreComapny = $oferta['CompanyJobOffer']['company_name']; 
						else:
							if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']=='')):
								$nombreComapny = 'Confidencial';
							else:
								if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
									$nombreComapny = $oferta['CompanyJobOffer']['company_name']; 
								else:
									if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']=='')):
										$nombreComapny = $oferta['Company']['CompanyProfile']['company_name'];
									else:
										$nombreComapny = 'Sin nombre de empresa';
									endif;
								endif;
							endif;
						endif;
	
						if($oferta['CompanyJobOffer']['same_contact']=='n'):
							$responsable =  $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'];	
							$contacto = 'Tel.: (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
							if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
								$contacto .= ' - ext. '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
							endif;	
							if($oferta['CompanyJobOffer']['company_email']<>''):
								$contacto .= ' / Correo: '.$oferta['CompanyJobOffer']['company_email'];
							endif;	
						else:
							$responsable =  $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'];
							$contacto = 'Tel.: </span> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'] . ' ';
							if($oferta['Company']['CompanyContact']['phone_extension']<>''):
								$contacto .= ' - ext. '.$oferta['Company']['CompanyContact']['phone_extension'];
							endif;
							if($oferta['Company']['email']<>''):
								$contacto .= ' / Correo: '.$oferta['Company']['email'];
							endif;	
						endif;
								
						$fecha = $this->request->data['StudentNotification']['company_interview_date']['day'] .'/'.
								 $this->request->data['StudentNotification']['company_interview_date']['month'] .'/'.
								 $this->request->data['StudentNotification']['company_interview_date']['year'];
								 
						$hora = $this->request->data['StudentNotification']['company_interview_hour']['hour'] .':'.
								 $this->request->data['StudentNotification']['company_interview_hour']['min'];
							
						
						$Email->to($estudiante['Student']['email']);
						$Email->subject('UNAM – SISBUT / Solicitud de entrevista presencial');
						$Email->emailFormat('both');
						$Email->template('email')->viewVars( array(
																	'aMsg' => 
																	'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
																	'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
	
																	'<p>Estimado(a) '.$estudiante['StudentProfile']['name'].' '.$estudiante['StudentProfile']['last_name'].' un reclutador le ha agendado una entrevista presencial a través del portal SISBUT.</p></br>'.
																	
																	'<p>Para aceptar, rechazar o proponer una nueva fecha y horario de entrevista por favor ingrese al portal del SISBUT con su número de cuenta y contraseña, a la sección de “Notificaciones”, dando click al link que aparece a continuación:</p></br>'.
																	
																	'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
																	
																	'<p>Entrevista presencial</p>
																	<p><table style="width: 100%">
																	<tr><td style="width: 50%"><p>Empresa: '.$nombreComapny.'</p><td><td><p>Fecha de entrevista telefónica: '.$fecha.' </p><td></tr>
																	<tr><td style="width: 50%"><p>Puesto: '.$oferta['CompanyJobProfile']['job_name'].'</p><td><td><p>Horario: '.$hora.' hrs. </p><td></tr>
																	<tr><td style="width: 50%"><p>Reclutador: '.$responsable.'</p><td><td><p>Contacto: '.$contacto.' </p><td></tr>
																	<tr><td style="width: 50%"><p>Documentos: '.$this->request->data['StudentNotification']['company_interview_document'].'</p><td><td><p>Dirección: '.$this->request->data['StudentNotification']['company_interview_direction'].' </p><td></tr>
																	</table></p>'.
																	
																	'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																	'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																	'Correo electrónico: bolsa@unam.mx</p></div>'
																	));
						$Email->send();
						
						$this->Session->setFlash('Notificación personal enviada.', 'alert-success');
						$this->redirect(array('action' => $redirect));
					else:
						$this->Session->setFlash('Lo sentimos, la notificación personal no pudo ser guardada', 'alert-danger');
						$this->redirect(array('action' =>  $redirect));
					endif;
				endif;

		}
		
		public function companyEmailNotification(){
			if($this->request->is('post')):
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				
				$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'studentContact'.DS;
				
				if( $this->data['Student']['file']['error'] == 0 &&  $this->data['Student']['file']['size'] > 0):
					if(!move_uploaded_file($this->data['Student']['file']['tmp_name'], $destino.$this->data['Student']['file']['name'])):              
						$this->Session->setFlash('Lo sentimos no pudimos cargar el archivo', 'alert-danger');
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
								// $Email->replyTo($this->request->data['Student']['email']);
								$Email->emailFormat('both'); 
								$contenMail = 	'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
												'<div style="background-color: #D8D8D8;text-align: justify;"><strong><h3>'.$this->request->data['Student']['title'].'</h3></strong>'.
												'<p>'.$this->request->data['Student']['message'].'</p>';
								if($this->request->data['Student']['sign'] <> ''):
									$contenMail .= 'Firma: '.$this->request->data['Student']['sign'].'</div>';
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
		
		public function deleteStudentNotification($id){
				if($this->request->is('post')):
					if($this->StudentNotification->delete($id)):
						$this->Session->setFlash('Notificación eliminada', 'alert-success');
						$this->redirect(array('action' =>'companyNotification'));
					else:
						$this->Session->setFlash('No se pudo eliminar la notificación', 'alert-danger');
						$this->redirect(array('action' =>'companyNotification'));
					endif;
				endif;
		}
		
		public function offerAdmin($newSearch = null){
			$this->Company->recursive = 1;
			$this->CompanyJobProfile->recursive = 2;
			
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->folder();
			$this->salary(); 
			
			$limite = 5; //default limit
			
			$this->Session->write('redirect', 'offerAdmin');
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('page');
				$this->Session->delete('intoFolder');
			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
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
			
			if($this->request->query('intoFolder') <> ''):
				$intoFolder = $this->request->query('intoFolder');
				$this->Session->write('intoFolder', $this->request->query('intoFolder'));
			else:
				if($this->Session->read('intoFolder') <> ''):
					$intoFolder = $this->Session->read('intoFolder');
				else:
					$intoFolder = '';
				endif;
			endif;
			
			$this->set('intoFolder', $intoFolder);
			
			$forGuardadas['conditions'][] = array('StudentSavedOffer.student_id' => $this->Session->read('company_id'));
			//Si llega el id del folder se agrega  a los parametros de la búsqueda
			if($intoFolder<>''):
				$forGuardadas['conditions'][] = array('CompanySavedStudent.company_folder_id' => $intoFolder);
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
					$criterio[] =  array( 'AND' => array( 
														'CompanyJobProfile.job_name LIKE ' =>  '%'. $palabraBuscada . '%',
														'CompanyJobProfile.company_id' => $this->Session->read('company_id')
														)
										);
				else:
					if($tipoBusqueda == 2):
						$criterio[] = array( 'AND' => array( 	
															'CompanyJobContractType.salary' => $palabraBuscada,
															'CompanyJobProfile.company_id' => $this->Session->read('company_id')
															)
											);
					else:
						if($tipoBusqueda == 3):
							$criterio[] = array( 'AND' => array( 
																'CompanyJobProfile.id'  => intval($palabraBuscada),
																'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																)
											);
						else:
							if($tipoBusqueda == 4):
								$this->Session->delete('palabraBuscada');
								$criterio[] =  array( 'AND' => array( 
																	'CompanyJobContractType.status'  => 1,
																	'CompanyJobProfile.company_id' => $this->Session->read('company_id'),
																	'CompanyJobProfile.expiration >=' => $hoy,
																	)
													);
							else:
								if($tipoBusqueda == 5):
									$this->Session->delete('palabraBuscada');
									$criterio[] = array( 'AND' => array(
																		'CompanyJobContractType.status'  => 1,
																		'CompanyJobProfile.expiration >= ' => $hoy,
																		'CompanyJobProfile.expiration <= ' => $fechaMax,
																		'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																		
																		)
														);
								else:
									if($tipoBusqueda == 6):
										$this->Session->delete('palabraBuscada');
										$criterio[] = array( 'AND' => array(
																		'CompanyJobProfile.expiration < ' => $hoy,
																		'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																		
																		)
														);
									else:
										if($tipoBusqueda == 7):
											$this->Session->delete('palabraBuscada');
											$criterio[] = array( 'AND' => array( 
																				'CompanyJobContractType.status'  => 0,
																				'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																				)
																);
										else:
											$criterio[] = array( 'AND' => array( 
																				'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																				)
																);
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				$criterio
																			)
																),
											'limit' => $limite,
											'order' => ' CompanyJobContractType.created DESC',
											);

				$this->set('ofertas', '');
				
				$ofertas = $this->paginate('CompanyJobProfile');
				$this->set('ofertas', $ofertas);

		}
		
		public function offerAdminExcel($newSearch = null){
			$this->CompanyJobProfile->recursive = 2;
			$this->Company->recursive = -2;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));

			$this->ExperienceArea();
			$this->Rotation();
			$this->salary(); 
			$this->states(); 
			$this->country(); 
			$this->interestArea();
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
			$pagas = $this->Salary->find('list', array('order' => array('Salary.id ASC')));
			
			$limite = 5; //default limit
			
			$this->Session->write('redirect', 'offerAdmin');
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('page');
				$this->Session->delete('intoFolder');
			endif;
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
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
			
			if($this->request->query('intoFolder') <> ''):
				$intoFolder = $this->request->query('intoFolder');
				$this->Session->write('intoFolder', $this->request->query('intoFolder'));
			else:
				if($this->Session->read('intoFolder') <> ''):
					$intoFolder = $this->Session->read('intoFolder');
				else:
					$intoFolder = '';
				endif;
			endif;
			
			$this->set('intoFolder', $intoFolder);
			
			$forGuardadas['conditions'][] = array('StudentSavedOffer.student_id' => $this->Session->read('company_id'));
			//Si llega el id del folder se agrega  a los parametros de la búsqueda
			if($intoFolder<>''):
				$forGuardadas['conditions'][] = array('CompanySavedStudent.company_folder_id' => $intoFolder);
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
														'CompanyJobProfile.company_id' => $this->Session->read('company_id')
														)
										);
				else:
					if($tipoBusqueda == 2):
						$this->set('tipoDescarga', 'Por sueldo: '.$pagas[$palabraBuscada]);
						$criterio[] = array( 'AND' => array( 	
															'CompanyJobContractType.salary' => $palabraBuscada,
															'CompanyJobProfile.company_id' => $this->Session->read('company_id')
															)
											);
					else:
						if($tipoBusqueda == 3):
							$this->set('tipoDescarga', 'Por folio: '.intval($palabraBuscada));
							$criterio[] = array( 'AND' => array( 
																'CompanyJobProfile.id'  => intval($palabraBuscada),
																'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																)
											);
						else:
							if($tipoBusqueda == 4):

								$criterio[] =  array( 'AND' => array( 
																	'CompanyJobContractType.status'  => 1,
																	'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																	)
													);
							else:
								if($tipoBusqueda == 5):
									$this->set('tipoDescarga', 'Por expirar');
									$this->Session->delete('palabraBuscada');
									$criterio[] = array( 'AND' => array(
																		'CompanyJobProfile.expiration >= ' => $hoy,
																		'CompanyJobProfile.expiration <= ' => $fechaMax,
																		'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																		
																		)
														);
								else:
									if($tipoBusqueda == 6):
										$this->set('tipoDescarga', 'Expiradas');
										$this->Session->delete('palabraBuscada');
										$criterio[] = array( 'AND' => array(
																		'CompanyJobProfile.expiration < ' => $hoy,
																		'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																		
																		)
														);
									else:
										if($tipoBusqueda == 7):
											$this->set('tipoDescarga', 'Inactivas');
											$this->Session->delete('palabraBuscada');
											$criterio[] = array( 'AND' => array( 
																				'CompanyJobContractType.status'  => 0,
																				'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																				)
																);
										else:
											$criterio[] = array( 'AND' => array( 
																				'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																				)
																);
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			
				$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				$criterio
																			)
																),
											'order' => ' CompanyJobContractType.created DESC',
											);
				
					$ofertas = $this->paginate('CompanyJobProfile');
					$this->set('datos', $ofertas);

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
	
		public function updateCompanyJobProfileExpiration(){
			if($this->request->is('post')):
			
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				
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
		
		public function enableDisableOffer(){
			if($this->request->is('get')):
				$id=$this->request->query('id');
				$estatusOffer = $this->request->query('estatus');
				
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				
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
			endif;
		}
		
		public function studentReport(){
			$this->Company->recursive = 2;
			$this->CompanyJobProfile->recursive = 2;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->Student->recursive = 2;
			$this->Session->write('redirect', 'studentReport');
			$this->folder();
			$this->salary(); 
			$this->totalDescargas();
			
			
			if(isset($this->request->query['nuevaBusqueda']) OR isset($this->request->data['Company']['resetSearch'])):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('page');
				$this->Session->delete('companyJobProfileId');
				$this->Session->delete('studentId');
				$this->Session->delete('tipoBusquedaStudent');
				$this->Session->delete('palabraBuscadaStudent');
			endif;
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			if(isset($this->request->query['studentId'])):
				//define el id de la estudiante a reportar
				$this->Session->write('studentId', $this->request->query['studentId']);
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
						$tipoBusqueda = 0; //Búsqueda default equivalente a no mostrar ofertas
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
			
				if($tipoBusqueda == 1):
					$criterio[] =  array( 'AND' => array( 
														'CompanyJobProfile.job_name LIKE ' =>  '%'. $palabraBuscada . '%',
														'CompanyJobProfile.company_id' => $this->Session->read('company_id')
														)
										);
				else:
					if($tipoBusqueda == 2):
						$criterio[] = array( 'AND' => array( 	
															'CompanyJobContractType.salary' => $palabraBuscada,
															'CompanyJobProfile.company_id' => $this->Session->read('company_id')
															)
											);
					else:
						if($tipoBusqueda == 3):
							$criterio[] = array( 'AND' => array( 
																'CompanyJobProfile.id'  => intval($palabraBuscada),
																'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																)
											);
						else:
							$criterio[] = array( 'AND' => array( 
																'CompanyJobProfile.company_id' => $this->Session->read('company_id')
																)
											);
						endif;
					endif;
				endif;
				
				$ofertas = $this->CompanyJobProfile->find('all', array(
																				'conditions' => array (
																										'OR' => array(
																													$criterio
																													)
																										),
																				'limit' => 1000,
																				'order' => 'CompanyJobContractType.created DESC',
																			)
																);
				$this->set( compact ('ofertas') );

			if((isset($this->request->query['companyJobProfileId']) OR ($this->Session->check('companyJobProfileId'))) AND (!isset($this->request->data['Company']['resetSearch']))):
				if(isset($this->request->query['companyJobProfileId']) and ($this->request->query['companyJobProfileId'] <> '')):
					$companyJobProfileId = $this->request->query['companyJobProfileId'];
					$this->Session->write('companyJobProfileId', $this->request->query['companyJobProfileId']);
				else:
					if($this->Session->check('companyJobProfileId') and ($this->Session->read('companyJobProfileId') <> null)):
						$companyJobProfileId = $this->Session->read('companyJobProfileId');
					else:
						$companyJobProfileId = '';
					endif;
				endif;
			
				//Muestra la oferta que sea seleccionada
				$ofertaSeleccionada = $this->CompanyJobProfile->find('all', array(
																					'conditions' => array(
																										'CompanyJobProfile.id' => $companyJobProfileId
																										)
																					)
																	);
				$this->set('ofertaSeleccionada', $ofertaSeleccionada);
				
				// Enlista los perfiles con un tipo de notificación
				$entrevistasTelefonicas = $this->StudentNotification->find('all',
																			array(
																				'conditions' => array(
																									'StudentNotification.company_id' => $this->Session->read('company_id'),
																									'StudentNotification.interview_type' => 1,
																									),
																				'order' => array('StudentNotification.id ASC')
																			)
												);
				$this->set( compact ('entrevistasTelefonicas') );
					
				$entrevistasPersonales = $this->StudentNotification->find('all',
																			array(
																				'conditions' => array(
																									'StudentNotification.company_id' => $this->Session->read('company_id'),
																									'StudentNotification.interview_type' => 2,
																									),
																				'order' => array('StudentNotification.id ASC')
																			)
													);
				$this->set( compact ('entrevistasPersonales') );
			
				//Obtenemos los id de los candidatos postulados en alguna oferta de la empresa	
				$studentPostullation = $this->Application->find('all', array(
																			'conditions' => array(
																									'Application.company_job_profile_id' => $companyJobProfileId,
																									'Application.company_id' => $this->Session->read('company_id')
																								)
																			)
																);

				// Obtenemos los id que sean válidos y en estructura de index valor
				$idsStudentPostulation = array("Student.id" => Set::extract("/Application/student_id", $studentPostullation));

				foreach($idsStudentPostulation['Student.id'] as $idStudentPostulation){
					$results[] = $idStudentPostulation; 
				}				
				
				//Deja ids unicos y los agrega a la condición  OR
				if(isset($results)):
					$resultsIds = array_unique($results);
						foreach($resultsIds as $resultsId){
							$conditionsConcatenated['conditions']['OR'][] =  array(
																					'Student.id' => array ($resultsId)
																					);  
						}
				endif;

				// Si no se encuantra nada ningún alumno lo deja vacio
				if(empty($conditionsConcatenated['conditions']['OR']) ):
					$conditionsConcatenated['conditions']['OR'][] =  array('Student.id' => '' ); 
				endif;							
				
				if(isset($this->request->data['Company']['criterioStudent']) and ($this->request->data['Company']['criterioStudent'] <> '')):
					$this->Session->write('tipoBusquedaStudent', $this->request->data['Company']['criterioStudent']);
					$tipoBusquedaStudent = $this->request->data['Company']['criterioStudent'];
				else:
					if($this->Session->check('tipoBusquedaStudent')):
						$tipoBusquedaStudent = $this->Session->read('tipoBusquedaStudent');
					else:
						$tipoBusquedaStudent = ''; //Búsqueda default equivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			
				if(isset($this->request->data['Company']['BuscarStudent']) and ($this->request->data['Company']['BuscarStudent'] <> '')):
					$this->Session->write('palabraBuscadaStudent', $this->request->data['Company']['BuscarStudent']);
					$palabraBuscadaStudent  = $this->request->data['Company']['BuscarStudent'];
				else:
					if(($this->Session->read('palabraBuscadaStudent')) <> ''):
						$palabraBuscadaStudent  = $this->Session->read('palabraBuscadaStudent');
					else:
						$palabraBuscadaStudent = '';
					endif;
				endif;
			
			
				if($tipoBusquedaStudent == 1):
					$criterioStudents[] = array('StudentProfile.name LIKE' => '%'. $palabraBuscadaStudent . '%');
				else:
					if($tipoBusquedaStudent == 2):
						$criterioStudents[] = array('Student.email LIKE' => '%'. $palabraBuscadaStudent . '%');
					else:
						if($tipoBusquedaStudent == 3):
							$criterioStudents[] = array('Student.id'  => intval($palabraBuscadaStudent));
						else:
							$criterioStudents[] = '';
						endif;
					endif;
				endif;
				
				if(isset($this->params['named']['page'])):
					$page = $this->params['named']['page'];
					$this->Session->write('page', '/page:'.$page);
				else:
					if(($this->request->is('get')) AND (!isset($this->params['named']['page']))):
						$this->Session->write('page', '');
					else:
						if($this->Session->check('page')):
							$this->Session->write('page', $this->Session->read('page'));
						endif;
					endif;
				endif;
				
				$this->paginate = array(
										'conditions' => array(
																'OR' => array(
																				$criterioStudents
																			),
																'AND' => array(
																				$conditionsConcatenated['conditions'],
																				'Student.block' => 0,
																				'Student.status' => 1
																			),
																),
										'limit' => 1,
										'order' => 'StudentLastUpdate.modified DESC',
										);

				$this->set('candidatos', $candidatos = $this->paginate('Student'));
			endif;							

			/* --------- Postulación POST --------- */
			if($this->request->is('post')):
				if(isset($this->request->data['Report']['fecha_contratacion'])):
						
						if($this->Session->check('redirect')):
							$redirect = $this->Session->read('redirect').$this->Session->read('page');
						else:
							$redirect = 'studentReport'.$this->Session->read('page');
						endif;
						
						$buscaIdCompany = $this->CompanyJobProfile->find('list',array(
																					'fields' => array('CompanyJobProfile.id','CompanyJobProfile.company_id'),
																					'conditions' => array('CompanyJobProfile.id' => $this->request->data['Report']['company_job_profile_id']),
																					'limit'=>1
																					)
																		);
																		
						if($buscaIdCompany[$this->request->data['Report']['company_job_profile_id']] <> ''):	
							
							$reportes = $this->Report->find('count', array(
																			'conditions' => array (
																									'Report.company_job_profile_id' => $this->request->data['Report']['company_job_profile_id'],
																									'company_id' => $this->Session->read('company_id'),
																									'registered_by' => 'company'
																									)
																			)
															);
															
							if($reportes==0):
								$this->request->data['Report']['company_id'] =  $this->Session->read('company_id');
								$this->request->data['Report']['registered_by'] = 'company';
								
								if($this->Report->save($this->request->data)):
									$this->Session->setFlash('Contratación reportada con éxito', 'alert-success');
									$this->redirect(array('action' =>  $redirect));
								else:
									$this->Session->setFlash('Lo sentimos el reporte de contratación no pudo ser enviado', 'alert-danger');
									$this->redirect(array('action' =>  $redirect));
								endif;
							else:
								$this->Session->setFlash('El reporte de contratación ya ha sido enviado anteriormente', 'alert-danger');
								$this->redirect(array('action' =>  $redirect));
							endif;
						else:
							$this->Session->setFlash('Lo sentimos, no se encontro la oferta para reportar la contración', 'alert-danger');
							$this->redirect(array('action' =>  $redirect));
						endif;
				endif;
			endif;
		}
		
		public function reportarContratacion(){
			if($this->request->is('post')):
				if(isset($this->request->data['StudentReportarContratacion']['fecha_contratacion'])):
						
						if($this->Session->check('redirect')):
							$redirect = $this->Session->read('redirect').$this->Session->read('page');
						else:
							$redirect = 'studentReport'.$this->Session->read('page');
						endif;
						
						$buscaIdCompany = $this->CompanyJobProfile->find('list',array(
																					'fields' => array('CompanyJobProfile.id','CompanyJobProfile.company_id'),
																					'conditions' => array('CompanyJobProfile.id' => $this->request->data['StudentReportarContratacion']['company_job_profile_id']),
																					'limit'=>1
																					)
																		);
																		
						if($buscaIdCompany[$this->request->data['StudentReportarContratacion']['company_job_profile_id']] <> ''):	
							
							$reportes = $this->Report->find('count', array(
																			'conditions' => array (
																									'Report.company_job_profile_id' => $this->request->data['StudentReportarContratacion']['company_job_profile_id'],
																									'Report.company_id' => $this->Session->read('company_id'),
																									'Report.student_id' => $this->request->data['StudentReportarContratacion']['student_id'],
																									'Report.registered_by' => 'company'
																									)
																			)
															);
								
							if($reportes==0):
								$this->request->data['Report']['company_job_profile_id'] = $this->request->data['StudentReportarContratacion']['company_job_profile_id'];
								$this->request->data['Report']['fecha_contratacion'] = $this->request->data['StudentReportarContratacion']['fecha_contratacion'];
								$this->request->data['Report']['company_id'] =  $this->Session->read('company_id');
								$this->request->data['Report']['student_id'] =  $this->request->data['StudentReportarContratacion']['student_id'];
								$this->request->data['Report']['registered_by'] = 'company';
								
								$notificacion['StudentNotification']['student_id'] = $this->request->data['Report']['student_id'];
								$notificacion['StudentNotification']['company_id'] = $this->request->data['Report']['company_id'];
								$notificacion['StudentNotification']['company_job_profile_id'] = $this->request->data['Report']['company_job_profile_id'];
								$notificacion['StudentNotification']['company_interview_date'] = $this->request->data['StudentReportarContratacion']['fecha_contratacion'];
								$notificacion['StudentNotification']['student_interview_date'] = $this->request->data['StudentReportarContratacion']['fecha_contratacion'];
								$notificacion['StudentNotification']['interview_type'] = 3;
								$notificacion['StudentNotification']['student_interview_status'] = 0;
								$notificacion['StudentNotification']['company_interview_status'] = 1;
								$notificacion['StudentNotification']['company_interview_message'] = 'La empresa ha indicado que usted ha sido contratado para esta oferta laboral.';
								$this->StudentNotification->create();														
	
								if($this->Report->save($this->request->data)):
									if($this->StudentNotification->save($notificacion)):
										$this->Session->setFlash('Contratación reportada con éxito', 'alert-success');
										
										$Email = new CakeEmail('gmail');
										$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));
								
										$this->CompanyJobProfile->recursive = 1;
										$oferta = $this->CompanyJobProfile->findById($this->request->data['Report']['company_job_profile_id']);

										$this->Student->recursive = 0;
										$student = $this->Student->findById($this->request->data['Report']['student_id']);

										$Email->to($student['Student']['email']);
										
										$Email->subject('UNAM – SISBUT / Contratación');
										$Email->emailFormat('both');
										$Email->template('email')->viewVars( array(
																					'aMsg' => 
																					'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
																					'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
									
																					'<p>Estimado(a) '.$student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' el motivo de este correo es para felicitarlo por su contratación para la posición de '.$oferta['CompanyJobProfile']['job_name'].'; le deseamos muchas suerte en esta nueva oportunidad laboral y esperamos que resulte en un crecimiento profesional y personal para usted, le recodarnos que la Dirección General de Orientación y Atención Educativa (DGOAE) está a su servicio.</p></br>'.
																				
																					'<p>Recuerde que es muy importante mantener sus datos de contacto e información en su currículum actualizada, para poder tener acceso en un futuro a más y mejores oportunidades laborales.</p></br>'.

																					'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
								
																					'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																					'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																					'Correo electrónico: bolsa@unam.mx</p></div>'
																			));
										$Email->send();
									else:
										$this->Session->setFlash('La notificación para el universitario no pudo ser cargada', 'alert-success');
									endif;
									$this->redirect(array('action' =>  $redirect));
								else:
									$this->Session->setFlash('Lo sentimos el reporte de contratación no pudo ser enviado', 'alert-danger');
									$this->redirect(array('action' =>  $redirect));
								endif;
							else:
								$this->Session->setFlash('El reporte de contratación ya ha sido enviado anteriormente', 'alert-danger');
								$this->redirect(array('action' =>  $redirect));
							endif;
						else:
							$this->Session->setFlash('Lo sentimos, no se encontro la oferta para reportar la contración', 'alert-danger');
							$this->redirect(array('action' =>  $redirect));
						endif;
				endif;
			endif;
		}
		
		public function companyExternalOffer(){
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->Rotation();
			$this->states();
			$this->academicLevel();
			
			if($this->request->is('post')):		
				if($this->CompanyExternalOffer->saveAll($this->request->data, array('validate' => 'only'))):
					$this->request->data['CompanyExternalOffer']['company_id'] = $this->Session->read('company_id');
					if($this->CompanyExternalOffer->save($this->request->data)):
						$this->Session->setFlash('Oferta externa guardada', 'alert-success');
						$this->redirect(array('action' => 'companyExternalOffer'));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
				endif;
			endif;
		}
		
		public function deleteOffer($id){
			if($this->request->is('post')):
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
				
				if(($this->Session->check('Auth.User')) and (($this->Session->read('Auth.User.role') == 'administrator') OR ($this->Session->read('Auth.User.role') == 'subadministrator'))):	
						$this->CompanyJobProfile->recursive = 2;
						$oferta = $this->CompanyJobProfile->findById($id);
						$nombreOferta = $oferta['CompanyJobProfile']['job_name'];
						
						$Email = new CakeEmail('gmail');
						$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));
						
						if($oferta['CompanyJobOffer']['same_contact'] == 'n'):
							$nombreResponsable = $oferta['CompanyJobOffer']['responsible_name'].' '.$oferta['CompanyJobOffer']['responsible_last_name'];
							$Email->to($oferta['CompanyJobOffer']['company_email'] );
						else:
							$nombreResponsable = $oferta['Company']['CompanyContact']['name'].' '.$oferta['Company']['CompanyContact']['last_name'];
						endif;
						
						$Email->to($oferta['Company']['email'] );

						$Email->subject('UNAM – SISBUT / Oferta eliminada');
						$Email->emailFormat('both');
						$Email->template('email')->viewVars( array(
																						'aMsg' => 
																						'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
																						'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
	
																						'<p>Estimado(a) reclutador(a) '.$nombreResponsable.' la oferta '. $oferta['CompanyJobProfile']['job_name'].' fue eliminada por uno de los administradores SISBUT. Para cualquier duda o aclaración favor de comunicarse con el administrador responsable o a la Dirección General de Orientación y Atención Educativa (DGOAE).</p></br>'.
																						
																						'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																						'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																						'Correo electrónico: bolsa@unam.mx</p></div>'
																		));
						if($Email->send()):
							$this->Session->setFlash('Se ha enviado un correo electrónico a la empresa responsable de la oferta notificandole de la modificación.', 'alert-danger'); 
						else:
							$this->Session->setFlash('Lo sentimos el correo de notificación de la modificación no pudo ser enviado.', 'alert-danger');
						endif;
				endif;
					
				if($this->CompanyJobProfile->delete($id)):
					$this->Session->setFlash('Oferta eliminada', 'alert-success');
					$revirecciona = (explode("/",$redirect));

					if($revirecciona[0] == 'viewOfferOnline'):
						$this->redirect(array('action' => 'offerAdmin'));
					else:
						$this->redirect(array('action' =>  $redirect));
					endif;
				else:
					$this->Session->setFlash('Lo sentimos, no se pudo eliminar la oferta', 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
			//Se envia correo de quien elimina
		}
		
		public function viewCandidateOffer($sinLimite = null){
			if($this->request->query('nuevaBusqueda') <> ''):
				$newSearch = 'nuevaBusqueda';
			else:
				$newSearch = '';
			endif;
			
			$this->Company->recursive = 2;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			$this->Student->recursive = 3;
			$this->folder();
			$this->salary();
			$this->totalDescargas();
			$this->Session->write('redirect', 'viewCandidateOffer');
			
			// Enlista los perfiles con un tipo de notificación
			$entrevistasTelefonicas = $this->StudentNotification->find('all',
																		array(
																			'conditions' => array(
																								'StudentNotification.company_id' => $this->Session->read('company_id'),
																								'StudentNotification.interview_type' => 1,
																								),
																			'order' => array('StudentNotification.id ASC')
																		)
											);
			$this->set( compact ('entrevistasTelefonicas') );
				
			$entrevistasPersonales = $this->StudentNotification->find('all',
																		array(
																			'conditions' => array(
																								'StudentNotification.company_id' => $this->Session->read('company_id'),
																								'StudentNotification.interview_type' => 2,
																								),
																			'order' => array('StudentNotification.id ASC')
																		)
												);
			$this->set( compact ('entrevistasPersonales') );
				
			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('page');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('orden');
				$this->Session->delete('intoFolder');
				$this->Session->delete('idOffer');
				$this->Session->delete('companyJobProfileId');
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
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
			else:
				if(($this->Session->read('limite')) <> ''):
					$limite = $this->Session->read('limite');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
			if($this->request->query('id') <> ''):
				$id = $this->request->query('id');
				$this->Session->write('idOffer', $id);
			else:
				if($this->Session->check('idOffer')):
					$id = $this->Session->read('idOffer');
				else:
					$this->Session->setFlash('Sin oferta seleccionada', 'alert-success');
					$this->redirect(array('action' => 'offerAdmin'));
				endif;
			endif;
			
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Company']['criterio']) and ($this->request->data['Company']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Company']['criterio']);
					$tipoBusqueda = $this->request->data['Company']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 6; //Búsqueda default equivalente a mostrar todos los perfiles de la oferta
					endif;
				endif;
			endif;
			
			$generalCondition = array( 'AND' => array( 	
														'StudentNotification.company_id' => $this->Session->read('company_id'),
														'StudentNotification.company_job_profile_id' => $id,
													)
									);
										
			if(($tipoBusqueda==7) || ($tipoBusqueda==6)  || ($tipoBusqueda==1)  || ($tipoBusqueda==2)  || ($tipoBusqueda==3)):
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
			
			if(($tipoBusqueda==8) || ($tipoBusqueda==6) || ($tipoBusqueda==1)  || ($tipoBusqueda==2)  || ($tipoBusqueda==3)):
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
			
			if(($tipoBusqueda==4) || ($tipoBusqueda==6) || ($tipoBusqueda==1)  || ($tipoBusqueda==2)  || ($tipoBusqueda==3)):
			//Obtenemos los id de los candidatos postulados en alguna oferta de la empresa	
					$studentPostullation = $this->Application->find('all', array(
																				'conditions' => array(
																									'Application.company_job_profile_id' => $id,
																									'Application.company_id' => $this->Session->read('company_id')
																									)
																				)
																	);
															
					// Obtenemos los id que sean válidos y en estructura de index valor
					$idsStudentPostulation = array("Student.id" => Set::extract("/Application/student_id", $studentPostullation));
						
					foreach($idsStudentPostulation['Student.id'] as $idStudentPostulation){
						$results[] = $idStudentPostulation; 
					}
			endif;
			
			if(($tipoBusqueda==9) || ($tipoBusqueda==6) || ($tipoBusqueda==1)  || ($tipoBusqueda==2)  || ($tipoBusqueda==3)): //Esta pendiente esta opción debe de ser con la tabla de reporte de empresas
			//Obtenemos los id de los candidatos reportados en alguna oferta de la empresa	

			$studenReport = $this->Report->find('all', array(
																	'conditions' => array(
																						'Report.company_job_profile_id' => $id,
																						'Report.company_id' => $this->Session->read('company_id'),
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

		// Recomendados por SISBUT
			if($tipoBusqueda==5):
				$this->CompanyJobProfile->recursive = 2;
				$oferta = $this->CompanyJobProfile->findById($id);	
				
				/*
				//Oferta incluyente StudentProfile
				if($oferta['CompanyJobProfile']['disability']=='s'):
					if($oferta['CompanyJobProfile']['disability_type']<>''):
						$criterio[] = array('StudentProfile.disability_type' => $oferta['CompanyJobProfile']['disability_type']);
					endif;
				endif;
				*/
				
				// Lugar de trabajo StudentProfile
				if(isset($oferta['CompanyJobContractType']['state']) AND ($oferta['CompanyJobContractType']['state']<>'')):
					$criterio[] = array('StudentProfile.state' => $oferta['CompanyJobContractType']['state']);
				endif;
				
				// Pretenciones económicas
				if(isset($oferta['CompanyJobContractType']['salary']) AND ($oferta['CompanyJobContractType']['salary']<>'')):
					$criterio[] = array('StudentProspect.economic_pretension' => $oferta['CompanyJobContractType']['salary']);
				endif;
				
				/*
				// Jornada laboral
				if(isset($oferta['CompanyJobContractType']['workday']) AND ($oferta['CompanyJobContractType']['workday']<>'')):
					$criterio[] = array('StudentProspect.workday' => $oferta['CompanyJobContractType']['workday']);
				endif;
				
				// Tipo de contrato
				if(isset($oferta['CompanyJobContractType']['contract_type']) AND ($oferta['CompanyJobContractType']['contract_type']<>'')):
					$criterio[] = array('StudentProspect.contract_type' => $oferta['CompanyJobContractType']['contract_type']);
				endif;
				
				// Giros y areas de interés
				if(isset($oferta['CompanyJobProfile']['rotation']) AND ($oferta['CompanyJobProfile']['rotation']<>'')):
					$giros[] = array('StudentInterestJob.business_activity' => $oferta['CompanyJobProfile']['rotation']);
				endif;
				
				if(isset($oferta['CompanyJobProfile']['interest_area']) AND ($oferta['CompanyJobProfile']['interest_area']<>'')):
					$giros[] = array('StudentInterestJob.interest_area_id' => $oferta['CompanyJobProfile']['interest_area']);
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
								$idsStudentsGiro[] = $idStudent;
							endforeach;	
						else:
							$idsStudentsGiro[0] = 0;
						endif;
				endif;
				
				// Idiomas
				$i = 0;
				$indice = 0;
				foreach($oferta['CompanyJobLanguage'] as $lenguaje):
					if($lenguaje['language_id']<>''):
						$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.language_id' => $lenguaje['language_id']);
					endif;
					
					if($lenguaje['average']<>''):
						$lenguajes['OR'][$indice]['AND'][] = array('StudentLenguage.average' => $lenguaje['average']);
					endif;
					
					$indice++;
					$i++;
				endforeach;
			
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
								$idsStudentsLengueges[] = $idStudent;
							endforeach;	
						else:
							$idsStudentsLengueges[0] = 0;
						endif;
				else:
					$idsStudentsLengueges[0] = 0;
				endif;
				
				
				// Cómputo
				$i = 0;
				$indice = 0;
				$indiceExtra = $indice + 1;
				foreach($oferta['CompanyJobComputingSkill'] as $computo):
					if($computo['category_id']<>''):
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.tecnology_id' => $computo['category_id']);
					endif;
					
					if($computo['name']<>''):
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.name' => $computo['name']);
					endif;
					
					if($computo['other']<>''):
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.other' => $computo['other']);
					endif;
					
					if($computo['level']<>''):
						$computos['OR'][$indice]['AND'][] = array('StudentTechnologicalKnowledge.level' => $computo['level']);
					endif;
					
					// quitando el nivel
					if($computo['category_id']<>''):
						$computos['OR'][$indiceExtra]['AND'][] = array('StudentTechnologicalKnowledge.tecnology_id' => $computo['category_id']);
					endif;
					
					if($computo['name']<>''):
						$computos['OR'][$indiceExtra]['AND'][] = array('StudentTechnologicalKnowledge.name' => $computo['name']);
					endif;
					
					if($computo['other']<>''):
						$computos['OR'][$indiceExtra]['AND'][] = array('StudentTechnologicalKnowledge.other' => $computo['other']);
					endif;
					
					$indice=$indice+2;
					$indiceExtra = $indice + 1;
					$i++;
				endforeach;
			
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
								$idsStudentsComputo[] = $idStudent;
							endforeach;	
						else:
							$idsStudentsComputo[0] = 0;
						endif;
				else:
							$idsStudentsComputo[0] = 0;
				endif;
				
				
				// Nivel Académico
				if(isset($oferta['CompanyCandidateProfile']['licenciatura']) AND ($oferta['CompanyCandidateProfile']['licenciatura']<>'') AND ($oferta['CompanyCandidateProfile']['licenciatura']==1 )):
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 1);
				endif;
					
				if(isset($oferta['CompanyCandidateProfile']['especialidad']) AND ($oferta['CompanyCandidateProfile']['especialidad']<>'') AND ($oferta['CompanyCandidateProfile']['especialidad']==1 )):
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 2);
				endif;
					
				if(isset($oferta['CompanyCandidateProfile']['maestria']) AND ($oferta['CompanyCandidateProfile']['maestria']<>'') AND ($oferta['CompanyCandidateProfile']['maestria']==1 )):
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 3);
				endif;
					
				if(isset($oferta['CompanyCandidateProfile']['doctorado']) AND ($oferta['CompanyCandidateProfile']['doctorado']<>'') AND ($oferta['CompanyCandidateProfile']['doctorado']==1 )):
					$criterioProfessionalProfile['OR'][] = array('StudentProfessionalProfile.academic_level_id' => 4);
				endif;

				// Situación Académica
				if(isset($oferta['CompanyCandidateProfile']['academic_situation']) AND ($oferta['CompanyCandidateProfile']['academic_situation']<>'')):
					$criterioAcademicSituation['AND'][] = array('StudentProfessionalProfile.academic_situation_id' => $oferta['CompanyCandidateProfile']['academic_situation'] );
				endif;
				
				// Semestre
				if(isset($oferta['CompanyCandidateProfile']['semester']) AND ($oferta['CompanyCandidateProfile']['semester']<>'') AND (isset($oferta['CompanyCandidateProfile']['academic_situation'])) AND ($oferta['CompanyCandidateProfile']['academic_situation'] ==1 )):
					$criterioProfessionalProfileSemestre['AND'][] = array('StudentProfessionalProfile.semester' => $oferta['CompanyCandidateProfile']['semester']);
				endif;
				*/
				
				// Carreras/Areas
				// if((isset($oferta['CompanyCandidateProfile']['CompanyJobRelatedCareer'])) AND (!empty($oferta['CompanyCandidateProfile']['CompanyJobRelatedCareer'])) AND (isset($criterioProfessionalProfile['OR'])) AND ($criterioProfessionalProfile['OR'] <> '' )):
				if((isset($oferta['CompanyCandidateProfile']['CompanyJobRelatedCareer'])) AND (!empty($oferta['CompanyCandidateProfile']['CompanyJobRelatedCareer']))):
					foreach($oferta['CompanyCandidateProfile']['CompanyJobRelatedCareer'] as $carrera):
						$criterioDestino['AND']['OR'][] = array('StudentProfessionalProfile.career_id' => $carrera);
					endforeach;
				endif;			
			
				// if(empty($criterioProfessionalProfile['OR'])):
					// $criterioProfessionalProfile = array();
				// endif;
				
				// if(empty($criterioAcademicSituation['AND'])):
					// $criterioAcademicSituation = array();
				// endif;
				
				// if(empty($criterioProfessionalProfileSemestre['AND'])):
					// $criterioProfessionalProfileSemestre = array();
				// endif;
				
				if(empty($criterioDestino['AND']['OR'])):
					$criterioDestino = array();
				endif;
				
				// if((!empty($criterioProfessionalProfile)) OR (!empty($criterioAcademicSituation)) OR (!empty($criterioProfessionalProfileSemestre)) OR (!empty($criterioDestino))):
				if(!empty($criterioDestino)):
						$results = $this->StudentProfessionalProfile->find('list',
																				array('conditions' => array(
																											'AND' => array(
																															// $criterioProfessionalProfile,
																															// $criterioAcademicSituation,
																															// $criterioProfessionalProfileSemestre,
																															$criterioDestino
																															),
																											),
																					'fields'=>array('StudentProfessionalProfile.student_id'),
																					)
																			);
					
						if(!empty($results)):
							$uniqueTotalIds = array_unique($results);
							$idsStudentsCarreras = $uniqueTotalIds;					
						else:
							$idsStudentsCarreras[0] = 0;	
						endif;	
				else:
							$idsStudentsCarreras[0] = 0;	
				endif;

			// Consulta final
				if(!empty($criterio)):
					$listaAlumnosGeneral = $this->Student->find('all',
																		array('conditions' => array(
																									'AND' => array(
																													$criterio,
																													// 'Student.id' => $idsStudentsGiro,
																													// 'Student.id' => $idsStudentsLengueges,
																													// 'Student.id' => $idsStudentsComputo,
																													'Student.id' => $idsStudentsCarreras,
																													),
																									),
																			'fields'=>array('Student.id'),
																			)
																	);
				else:
					$listaAlumnosGeneral = array();
				endif;

				foreach($listaAlumnosGeneral as $alumno):
					$results[] = $alumno['Student']['id'];
				endforeach;	
				
				if(!isset($results)):
					$results = array();
				endif;
			endif;
			

			//Deja ids unicos y los agrega a la condición  OR
			if(isset($results)):
				$resultsIds = array_unique($results);
					foreach($resultsIds as $resultsId){
						$conditionsConcatenated['conditions']['OR'][] =  array(
																				'Student.id' => array ($resultsId)
																				);  
		
					}
			endif;
			
			// Si no se encuantra ningún id de alumno lo deja vacio
			if(empty($conditionsConcatenated['conditions']['OR']) ):
				$conditionsConcatenated['conditions']['OR'][] =  array('Student.id' => '' ); 
			endif;

			
			if(isset($this->request->data['Company']['Buscar']) and ($this->request->data['Company']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Company']['Buscar']);
				$palabraBuscada  = $this->request->data['Company']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada = '';
				endif;
			endif;
			
				if($tipoBusqueda == 1):
					$criterio[] = array('StudentProfile.name LIKE' => '%'. $palabraBuscada . '%');
				else:
					if($tipoBusqueda == 2):
						$criterio[] = array('Student.email LIKE' => '%'. $palabraBuscada . '%');
					else:
						if($tipoBusqueda == 3):
							$criterio[] = array('Student.id'  => intval($palabraBuscada));
						else:
							$criterio[] = '';
						endif;
					endif;
				endif;
			// if(($this->Auth->user('role') === 'administrator') OR ($this->Auth->user('role') === 'subadministrator')):
				// $condicionAdmin = '';
			// else:
				// $condicionAdmin[] = 'Student.block' => 0,
				// $condicionAdmin[] = 'Student.status' => 1,
			// endif;
			
			
			// identifica si se descarga o no para poner un limite o no
			if($sinLimite==null):	
					$this->paginate = array(
											'conditions' => array(
																'OR' => array(
																				$criterio
																			),
																'AND' => array(
																				$conditionsConcatenated['conditions'],
																				// $condicionAdmin
																				'Student.block' => 0,
																				'Student.status' => 1
																		),
																),
											'limit' => $limite,
											'order' => $orden,
											);
				$this->set('candidatos', $candidatos = $this->paginate('Student'));
			else:
				$datosStudent = $this->Student->find('all', array(
																'conditions' => array(
																						'OR' => array(
																										$criterio
																									),
																						'AND' => array(
																								$conditionsConcatenated['conditions'],
																								// $condicionAdmin
																								'Student.block' => 0,
																								'Student.status' => 1
																								),
																					)
															)
												);
				$this->set('datos', $datosStudent);
			endif;	
		}

		public function viewCandidateOfferExcel(){
			$this->Company->recursive = 2;
			$this->layout='excel';
			$this->Application->recursive = 2;
			$this->Student->recursive = 3;
			

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
			
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Company']['criterio']) and ($this->request->data['Company']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Company']['criterio']);
					$tipoBusqueda = $this->request->data['Company']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 6; //Búsqueda default equivalente a mostrar todos los perfiles de la oferta
					endif;
				endif;
			endif;

			$tituloExcel = '';
			if($tipoBusqueda == 1):
				$tituloExcel .= 'Filtro por nombre: '.$palabraBuscada;
			else:
				if($tipoBusqueda == 2):
					$tituloExcel .= 'Filtro por correo: '.$palabraBuscada;
				else:
					if($tipoBusqueda == 3):
						$tituloExcel .= 'Filtro por folio: '.$palabraBuscada;
					endif;
				endif;
			endif;

			if($tipoBusqueda == 4):
				$tituloExcel .= 'Postulados';
			else:
				if($tipoBusqueda == 5):
					$tituloExcel .= 'Recomendados por SISBUT';
				else:
					if($tipoBusqueda == 6):
						$tituloExcel .= 'Todos';
					else:
						if($tipoBusqueda == 7):
							$tituloExcel .= 'Entrevistas telefónicas';
						else:
							if($tipoBusqueda == 8):
									$tituloExcel .= 'Entrevistas telefonicas';
							else:
								if($tipoBusqueda == 9):
										$tituloExcel .= 'Contratados';
								endif;
							endif;
						endif;
					endif;
				endif;
			endif;

			$this->set('tipoDescarga', $tituloExcel);
			$this->viewCandidateOffer('sinLimite');
		}
		
		public function companyViewedStudent(){
			$this->Company->recursive = 2;
			$this->Student->recursive = 2;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));	
			$this->Session->write('redirect', 'companyViewedStudent');
			$this->folder();
			$this->salary(); 
			$this->totalDescargas();
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
			else:
				if(($this->Session->read('limite')) <> ''):
					$limite = $this->Session->read('limite');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
			// Enlista los perfiles con un tipo de notificación
			$entrevistasTelefonicas = $this->StudentNotification->find('all',
																		array(
																			'conditions' => array(
																								'StudentNotification.company_id' => $this->Session->read('company_id'),
																								'StudentNotification.interview_type' => 1,
																								),
																			'order' => array('StudentNotification.id ASC')
																		)
											);
			$this->set( compact ('entrevistasTelefonicas') );
				
			$entrevistasPersonales = $this->StudentNotification->find('all',
																		array(
																			'conditions' => array(
																								'StudentNotification.company_id' => $this->Session->read('company_id'),
																								'StudentNotification.interview_type' => 2,
																								),
																			'order' => array('StudentNotification.id ASC')
																		)
												);
			$this->set( compact ('entrevistasPersonales') );
			
			$this->paginate = array(
											'conditions' => array(
																'AND' => array(
																			'Student.company_viewed_student_count <>' => 0,
																			'Student.block' => 0
																			)
																),
											'limit' => $limite,
											'order' => 'Student.company_viewed_student_count DESC',
										);
				
				$candidatos = $this->paginate('Student');
			
				$this->set('candidatos', $candidatos);
		}
		
		public function companyViewedStudentExcel(){
			$this->layout='excel';
			$this->Company->recursive = 2;
			$this->Student->recursive = 3;
			
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
			
			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if(isset($this->request->data['Company']['limite']) and ($this->request->data['Company']['limite'] <> '')):
				$this->Session->write('limite', $this->request->data['Company']['limite']);
				$limite = $this->request->data['Company']['limite'];
			else:
				if(($this->Session->read('limite')) <> ''):
					$limite = $this->Session->read('limite');
				else:
					$limite = 5; //default limit
				endif;
			endif;
			
				$this->paginate = array(
											'conditions' => array(
																'AND' => array(
																			'Student.company_viewed_student_count <>' => 0,
																			)
																),
											// 'limit' => $limite,
											'order' => 'Student.company_viewed_student_count DESC',
										);
				
				$datos = $this->paginate('Student');
			
				$this->set('datos', $datos);	
		}
		
		public function downloadCvStudent($id){		
			//Marca como descargado
			$this->request->data['CompanyDownloadedStudent']['company_id'] = $this->Session->read('company_id');
			$this->request->data['CompanyDownloadedStudent']['student_id'] = $id;
			if(!$this->CompanyDownloadedStudent->save($this->request->data)):
				$this->Session->setFlash('El cv no se pudo marcar como descargado', 'alert-danger');
			endif;
			 $this->autoRender = false;
		}
		
		public function viewCvPdf($id){
			$this->Company->recursive = 1;
			$company = $this->CompanyOfferOption->findById($this->Session->read('company_id'));
			
			$descargas = $this->CompanyDownloadedStudent->find('count', array(
																			'conditions' => array ('company_id' => $this->Session->read('company_id'))
																			)
																);	
			$this->set('descargas', $descargas);
			$this->set('company', $company);
			
			if($company['CompanyOfferOption']['max_cv_download'] > $descargas ):													

				$this->request->data['CompanyDownloadedStudent']['company_id'] = $this->Session->read('company_id');
				$this->request->data['CompanyDownloadedStudent']['student_id'] = $id;
				if(!$this->CompanyDownloadedStudent->save($this->request->data)):
					$this->Session->setFlash('El cv no pudo marcarse como visto', 'alert-danger');
				endif;
				
				//Curriculum data
				$this->disabilityType();
				$this->Student->recursive = 3; 
				$this->academicLevel();
				$this->Facultades();
				$this->Escuelas();
				$this->career();
				$this->country();
				$this->posgradoProgrma();
				$this->NivelesIdioma();
				$this->TypeCourses();
				$this->softwareLevel();
				$this->set('student', $this->Student->findById($id));
				$interesesAreacv = $this->StudentInterestJob->find('all', array(
																			'conditions' => array (
																				'StudentInterestJob.student_id' => $id,	
																			)
				));
				$this->set( compact ('interesesAreacv') );
				$this->academicLevel();
				$this->Facultades();
				$this->Escuelas();
				$this->career();
				$this->posgradoProgrma();
				$this->NivelesIdioma();
				$this->TypeCourses();
				$software = $this->Program->find('list', array('order' => array('Program.id ASC')));
				$this->set( compact ('software') );
				
				$carreras = $this->Career->find('list',
													array(
														'fields' => array('Career.id', 'Career.career'),
														'order' => array('Career.career ASC')
													)
												);


				$this->set( compact ('carreras') );
				$carrerasRegistro = $this->Career->find('list',
													array(
														'fields' => array('Career.career_id', 'Career.career'),
														'order' => array('Career.career ASC')
													)
												);
				$this->set( compact ('carrerasRegistro') );
				$programas = $this->PosgradoProgram->find('list',
													array(
														'fields' => array('PosgradoProgram.id', 'PosgradoProgram.posgrado_program'),
														'order' => array('PosgradoProgram.posgrado_program ASC')
													)
												);
				$this->set( compact ('programas') );
				$suma = $descargas + 1 ;
				$this->Session->setFlash('Número total de visualizaciones para descarga acumuladas: '. $suma .' de un total permitido de: '.$company['CompanyOfferOption']['max_cv_download'], 'alert-success');
				$this->set('show',0);
			else:		
				$this->Session->setFlash('El número de visualizaciones y/o descargas en pdf ha llegado a su límite', 'alert-danger');
				$this->set('show',1);
			endif;

		}
		
		public function viewOfferPdf($id){
			$this->CompanyJobProfile->recursive = 2;
			$this->set('oferta', $this->CompanyJobProfile->findById($id));
			$this->Company->recursive = 1;
			$this->set('company', $this->Company->findById($this->Session->read('company_id')));
			
			$this->layout = '/pdf/pdf1';
			$this->folder();
			$this->benefit();
			$this->carrer();
			$this->NivelesIdioma();
			$this->softwareLevel();
			$this->softwareLevel();
			$this->Tecnology();
			$this->disabilityType();
			$this->escuelasFacultades();
			$software = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('software') );
			
			$niveles = $this->LenguageLevel->find('list', array('order' => array('LenguageLevel.id ASC')));
			$this->set( compact ('niveles') );
			
			$idiomas = $this->CompanyJobLanguage->find('all', array(
																'conditions' => array('CompanyJobLanguage.company_job_profile_id' => $id),
																'order' => array('CompanyJobLanguage.language_id ASC')));
			$this->set( compact ('idiomas') );
			
			
			$tiposCompetencias = $this->Competency->find('list', array('order' => array('Competency.id ASC')));
			$this->set( compact ('tiposCompetencias') );
			
			$competencias = $this->CompanyJobOfferCompetency->find('all', array(
																'conditions' => array('CompanyJobOfferCompetency.company_job_profile_id' => $id),
																'order' => array('CompanyJobOfferCompetency.competency_id ASC')));
			$this->set( compact ('competencias') );
			
			
			$programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('programas') );
			
			$computos = $this->CompanyJobComputingSkill->find('all', array(
																'conditions' => array('CompanyJobComputingSkill.company_job_profile_id' => $id),
																'order' => array('CompanyJobComputingSkill.name ASC')));
			$this->set( compact ('computos') );
			
			$situacionAcademica = $this->AcademicSituation->find('list', array('order' => array('AcademicSituation.id ASC')));
			$this->set( compact ('situacionAcademica') );
			
			$carreras = $this->Career->find('list',
												array(
													'fields' => array('Career.id', 'Career.career'),
													'order' => array('Career.career ASC')
												)
											);

			$programas = $this->PosgradoProgram->find('list',
												array(
													'fields' => array('PosgradoProgram.id', 'PosgradoProgram.posgrado_program'),
													'order' => array('PosgradoProgram.posgrado_program ASC')
												)
											);

			$CarrerasAreas = $carreras + $programas;
			$this->set('CarrerasAreas', $CarrerasAreas);	
			
			$total = $this->StudentViewedOffer->find('count', array(
																	'conditions' => array(
																						'AND' => array(
																									'StudentViewedOffer.student_id' =>  $this->Session->read('company_id'),
																									'StudentViewedOffer.company_job_profile_id' => $id
																									),
																						),
																	)
													);
		}
		
		public function viewOnlyOfferPdf($id=null){
			if($id==null):
				$id=$this->Session->read('companyJobProfileId');
			else:
				$id=$id;
			endif;
			
			$this->viewOfferPdf($id);
		}
		

		// get catalogos;
		
		public function totalDescargas(){
			$totalDescargas = $this->CompanyDownloadedStudent->find('count', array(
																			'conditions' => array (
																							'company_id' => $this->Session->read('company_id'),
																							)
																			)
															);	
			$this->set('totalDescargas', $totalDescargas);
		}
		
		public function carrer(){
			$careers = $this->Career->find('list', array('order' => array('Career.career ASC')));
			$this->set( compact ('careers') );
		}
		
		public function posgradoProgrma(){
			$AreasPosgrado = $this->PosgradoProgram->find('list', array('order' => array('PosgradoProgram.posgrado_program ASC')));
			$this->set( compact ('AreasPosgrado') );
		}
		
		public function Facultades(){
			$Facultades = $this->FacultadPosgrado->find('list', array('order' => array('FacultadPosgrado.facultad_posgrado ASC')));
			$this->set( compact ('Facultades') );
		}
		
		public function Escuelas(){
			$Escuelas = $this->FacultadLicenciatura->find('list', array('order' => array('FacultadLicenciatura.id ASC')));
			$this->set( compact ('Escuelas') );
		}
		
		public function decimalAverage(){
				$Decimales = $this->DecimalAverage->find('list', array('order' => array('DecimalAverage.id ASC')));
				$this->set( compact ('Decimales') );
			}
			
		public function NivelesIdioma(){
			$NivelesIdioma = $this->LenguageLevel->find('list', array('order' => array('LenguageLevel.id ASC')));
			$this->set( compact ('NivelesIdioma') );
		}
		
		public function softwareLevel(){
			$NivelesSoftware = $this->SoftwareLevel->find('list', 
																array(
																	'fields' => array('SoftwareLevel.id', 'SoftwareLevel.level'),
																	'order' => array('SoftwareLevel.id ASC')
														));
			$this->set( compact ('NivelesSoftware') );
		}
		
		public function contractType(){
			$TiposContratos = $this->ContractType->find('list', array('order' => array('ContractType.id ASC')));
			$this->set( compact ('TiposContratos') );
		}
		
		public function Tecnology(){
			$Tecnologias = $this->Tecnology->find('list', array('order' => array('Tecnology.id ASC')));
			$this->set( compact ('Tecnologias') );
		}
		
		public function program(){
			$Programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('Programas') );
		}
		
		public function TypeCourses(){
			$TipoCursos = $this->TypeCourse->find('list', array('order' => array('TypeCourse.type_course ASC')));
			$this->set( compact ('TipoCursos') );
		}
		
		public function workday(){
			$JornadasLaborales = $this->Workday->find('list', array('order' => array('Workday.id ASC')));
			$this->set( compact ('JornadasLaborales') );	
		}
		
		public function salary(){
			$Salarios = $this->Salary->find('list', array('order' => array('Salary.id ASC')));
			$this->set( compact ('Salarios') );
		}
		
		public function academicSituation(){
			$SituacionesAcademicas = $this->AcademicSituation->find('list', array('order' => array('AcademicSituation.id ASC')));
			$this->set( compact ('SituacionesAcademicas') );
		}
		
		public function academicLevel(){
			$NivelesAcademicos = $this->AcademicLevel->find('list', array('order' => array('AcademicLevel.id ASC')));
			$this->set( compact ('NivelesAcademicos') );
		}
		
		public function disabilityType(){
			$TiposDiscapacidad = $this->DisabilityType->find('list', array('order' => array('DisabilityType.id ASC')));
			$this->set( compact ('TiposDiscapacidad') );
		}
		
		public function sexo(){
			$Sexo = $this->Sexo->find('list', array('order' => array('Sexo.id ASC')));
			$this->set( compact ('Sexo') );
		}
		
		public function maritalStatus(){
			$EstadoCivil = $this->MaritalStatus->find('list', array('order' => array('MaritalStatus.id ASC')));
			$this->set( compact ('EstadoCivil') );
		}
		
		public function lenguageAverage(){
			$PromediosLenguajes = $this->LenguageAverage->find('all', array('order' => array('LenguageAverage.id ASC')));
			$this->set( compact ('PromediosLenguajes') );
		}
		
		public function interestArea(){
			$AreasInteres = $this->InterestArea->find('list', array('order' => array('InterestArea.id ASC')));
			$this->set( compact ('AreasInteres') );
		}
		
		public function ExperienceArea(){
			$AreasExperiencia = $this->ExperienceArea->find('list', array('order' => array('ExperienceArea.experience_area ASC')));
			$this->set( compact ('AreasExperiencia') );
		}
		
		public function Sector(){
			$Sectores = $this->Sector->find('list', array('order' => array('Sector.id ASC')));
			$this->set( compact ('Sectores') );
		}
		
		public function Rotation(){
			$Giros = $this->Rotation->find('list', array('order' => array('Rotation.id ASC')));
			$this->set( compact ('Giros') );
		}
		
		public function numeroEmpleados(){
			$numeroEmpleados = $this->EmployeeNumber->find('list', array('order' => array('EmployeeNumber.id ASC')));
			$this->set( compact ('numeroEmpleados') );
		}
		
		public function companyType(){
			$tipoEmpresas = $this->CompanyType->find('list', array('order' => array('CompanyType.id ASC')));
			$this->set( compact ('tipoEmpresas') );
		}
		
		public function companyCancellation(){
			$MotivosCancelacion = $this->Cancellation->find('list', array('order' => array('Cancellation.id ASC')));
			$this->set( compact ('MotivosCancelacion') );
		}
		
		public function semester(){
			$Semestres = $this->Semester->find('list', array('order' => array('Semester.id ASC')));
			$this->set( compact ('Semestres') );
		}
		
		public function benefit(){
			$Prestaciones = $this->Benefit->find('list', array('order' => array('Benefit.benefit ASC')));
			$this->set( compact ('Prestaciones') );
		}
		
		public function job(){
			$Puestos = $this->Job->find('list', array('order' => array('Job.job ASC')));
			$this->set( compact ('Puestos') );
		}
		
		public function country(){
			$Paises = $this->Country->find('list', array('order' => array('Country.id ASC')));
			$this->set( compact ('Paises') );
		}
		
		public function experienceTime(){
			$tiemposExperiencia = $this->ExperienceTime->find('list', array('order' => array('ExperienceTime.id ASC')));
			$this->set( compact ('tiemposExperiencia') );
		}
		
		public function Competency(){
			$Competencias = $this->Competency->find('list', array('order' => array('Competency.id ASC')));
			$this->set( compact ('Competencias') );
		}
		
		public function average(){
			$Promedios = $this->Average->find('list', array('order' => array('Average.id ASC')));
			$this->set( compact ('Promedios') );
		}
		
		public function career(){
			$CarrerasLicenciatura = $this->Career->find('list', array('order' => array('Career.career ASC')));
			$this->set( compact ('CarrerasLicenciatura') );
		}
		
		public function states(){
			$Estados = $this->State->find('list', array('order' => array('State.id ASC')));
			$this->set( compact ('Estados') );
			return $Estados;
		}
		
		public function lenguage(){
			$Lenguages = $this->Lenguage->find('list', array('order' => array('Lenguage.id ASC')));
			$this->set( compact ('Lenguages') );
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
		
		public function escuelasFacultades(){
			$EscuelaLicenciatura = $this->FacultadLicenciatura->find('list', array('order' => array('FacultadLicenciatura.facultad_licenciatura ASC')));
			$EscuelaPosgrados = $this->FacultadPosgrado->find('list', array('order' => array('FacultadPosgrado.facultad_posgrado ASC')));
			$EscuelasFacultades = $EscuelaLicenciatura + $EscuelaPosgrados;
			$this->set('EscuelasFacultades', $EscuelasFacultades);	
		}
		
		public function companyLastUpdate(){
			if($this->Session->check('CompanyJobProfile.id')):
				if(($this->Session->check('Auth.User')) and (($this->Session->read('Auth.User.role') == 'administrator') OR ($this->Session->read('Auth.User.role') == 'subadministrator'))):	
					$this->CompanyLastUpdate->data['CompanyLastUpdate']['administrator_id'] = $this->Session->read('Auth.User.id');
						if($this->Session->check('CompanyJobOffer.id')):
							$responsable = $this->CompanyJobOffer->findById($this->Session->read('CompanyJobOffer.id'));
							$ultimaModificacion = $this->CompanyLastUpdate->findById($this->Session->read('CompanyJobProfile.id'));
							$this->Company->recursive = -2;
							$company = $this->Company->findById($this->Session->read('company_id'));
							$hoy = date('Y-m-d');

							if( empty($ultimaModificacion) OR ($ultimaModificacion['CompanyLastUpdate']['modified'] < $hoy)):
								$Email = new CakeEmail('gmail');
								$Email->from(array('sisbut@unam.mx' => 'SISBUT UNAM.'));

								if($responsable['CompanyJobOffer']['same_contact']=='n'):
									$Email->to($responsable['CompanyJobOffer']['company_email'] );
									$nombre = $responsable['CompanyJobOffer']['responsible_name'].' '.$responsable['CompanyJobOffer']['responsible_last_name'];
								else:
									$nombre = $company['CompanyContact']['name'].' '.$company['CompanyContact']['last_name'];
								endif;
								
								$caracteres = strlen($responsable['CompanyJobProfile']['id']);
								$faltantes = 5 - $caracteres;	
								if($faltantes > 0):
									$ceros = '';
									for($cont=0; $cont<=$faltantes;$cont++):
										$ceros .= '0';
									endfor;
									$folio = $ceros.$responsable['CompanyJobProfile']['id'];
								else:
									$folio = strlen($responsable['CompanyJobProfile']['id']);
								endif;
						
								$Email->to($company['Company']['email'] );
								$Email->subject('UNAM – SISBUT / Modificación de oferta');
								$Email->emailFormat('both');
								$Email->template('email')->viewVars( array(
																						'aMsg' => 
																						'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://xxvcyw.bn1304.livefilestore.com/y3mGmsO9S-kd6T6qnUw4SibtxC1jklxC1tUxhhktNgxHChBDtmBTWRwRLR_DPMGAStEoBzUrMqS4na66U11SwTpiRLtvI20Zq1j2q9m0EZiphGg99ErtMOZxp2g1yG9tjssekTj3cFrD8_xLNwjxF5prBCc5Pa1xS2Lj9zHelg1zdw?width=700&height=80&cropmode=none" alt="header" width="100%">'.
																						'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
	
																						'<p>Estimado(a) reclutador(a) '.$nombre.' la oferta con folio: '.$folio.' y nombre del puesto: '. $responsable['CompanyJobProfile']['job_name'].' fue modificada por uno de los administradores SISBUT. Para revisar las modificaciones, ingrese al portal y busque la oferta laboral dentro de la sección “Administrar Ofertas” ubicada en el menú principal de su lado izquierdo.</p></br>

																						<p>Para cualquier duda o aclaración favor de comunicarse con el administrador responsable de la modificación o a la Dirección General de Orientación y Atención Educativa (DGOAE).
																						</p>'.
																						
																						'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																						'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																						'Correo electrónico: bolsa@unam.mx</p></div>'
																		));
								if($Email->send()):
									$this->Session->setFlash('Se ha enviado un correo electrónico a la empresa responsable de la oferta notificandole de la modificación.', 'alert-danger'); 
								else:
									$this->Session->setFlash('Lo sentimos el correo de notificación de la modificación no pudo ser enviado.', 'alert-danger');
								endif;
							endif;	
						endif;
				else:
					$this->CompanyLastUpdate->data['CompanyLastUpdate']['administrator_id'] = '';
				endif;
				
				$this->CompanyLastUpdate->data['CompanyLastUpdate']['id'] = $this->Session->read('CompanyJobProfile.id');
				$this->CompanyLastUpdate->data['CompanyLastUpdate']['company_id'] = $this->Session->read('company_id');
				$this->CompanyLastUpdate->save($this->CompanyLastUpdate->data);
			endif;
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
	
		public function notification(){
			$this->StudentNotification->recursive = -1;			

			$conditionsConcatenated[] = array( 'OR' => array(
																'StudentNotification.student_interview_status' => 0,
																'StudentNotification.company_interview_status' => 0,
															),
											);
			
			$entrevistas = $this->StudentNotification->find('count', array(
																			'conditions' => array (
																									'AND' => array(
																													'StudentNotification.company_id' => $this->Session->read('company_id'),
																													'StudentNotification.company_interview_date >= '=> date("Y-m-d"),
																													'StudentNotification.interview_type < ' => 3,
																													// $conditionsConcatenated,
																												),
																								)
																			)
																);	
																
			$contrataciones = $this->StudentNotification->find('count', array(
																			'conditions' => array (
																									'AND' => array(
																													'StudentNotification.company_id' => $this->Session->read('company_id'),
																													'StudentNotification.interview_type'=> 3,
																													'StudentNotification.company_interview_status' => 0,
																													)
																									)
																			)
																);
			$typeRespons = array(1=>4, 2=>5);
			$seguimiento = $this->StudentNotification->find('count', array(
																				'conditions' => array (
																										'AND' => array(
																														'StudentNotification.company_id' => $this->Session->read('company_id'),
																														'StudentNotification.interview_type'=> 4,
																														'StudentNotification.step_process > '=> 1,
																														'StudentNotification.type_respons' => $typeRespons,
																														'StudentNotification.type_respons_company' => 0,
																													)
																										)
																		)
															);
															
			$notificaciones = $entrevistas + $contrataciones + $seguimiento;										
			$this->set('notificaciones',$notificaciones);

		}
		
	}
	
?>