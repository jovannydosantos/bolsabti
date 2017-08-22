<?php
	class StudentsController extends AppController{
		var $helpers = array('Html', 'Form', 'Captcha','Paginator','Js' => array('Jquery'));
		var $name = 'Students';
		var $uses = array('StudentProfile','StudentProfessionalProfile','Student','Career','StudentJobProspect','StudentJobSkill','StudentLenguage','StudentTechnologicalKnowledge','StudentProfessionalExperience','StudentWorkArea','StudentResponsability','StudentAchievement','StudentAcademicProject','StudentAcademicProjectResponsability','StudentAcademicProjectAchievement','StudentProfessionalSkill','StudentProspect','StudentInterestJob','Question','StudentAnswer','CompanyJobProfile','CompanyJobRelatedCareer','CompanyCandidateProfile','Lenguage','CompanyJobLanguage','CompanyProfile','AcademicSituation','AcademicLevel','Sexo','Country','ContractType','Workday','Salary','DisabilityType','StudentSavedSearch','CompanyJobComputingSkill','StudentFolder','StudentSavedOffer','StudentViewedOffer','Rotation','LenguageLevel','Competency','CompanyJobOfferCompetency','Program','FacultadLicenciatura','FacultadPosgrado','PosgradoProgram','MaritalStatus','State','ScholarshipProgram','Average','DecimalAverage','Semester','TypeCourse','Tecnology','ExperienceArea','ExperienceSubarea','TypeProyect','Competency','Sector','Cancellation','Application','Programas','StudentHeader','StudentCancellation','Job','StudentDisabled','StudentLastUpdate','Report','StudentExternalOffer','StudentNotification','SimilarCareer','Zip','SoftwareLevel','Company','CompanyJobOffer','Banner','Benefit','CompanyJobContractType');
		
		var $components = array(
			'RequestHandler',
			// 'Acl',
			'Paginator',
			'Session',
			'Captcha'=>array(
			'Model'=>'Student', 
			'field'=>'captcha'),
			'Auth' => array(								
				'authorize' => array('Controller'),
				'authError' => 'Debes estar logueado para continuar',
				'loginError' => 'Clave de acceso o contraseña incorrectos',
					'loginRedirect' => array('controller' => 'Students', 'action' => 'profile'),
					'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			)
		);	
			
		public function beforeFilter(){

			parent::beforeFilter();
			
			if(!$this->Session->check('Auth.User')):	
				$this->user = $this->Auth->user();
			endif;
			
			$this->Auth->loginAction = array('controller'=>'pages','action'=>'display','home');

			if(!$this->Session->check('Auth.User')):	
				$this->Auth->authenticate = array(
					AuthComponent::ALL => array('userModel' => 'Student'),
					'Basic',
					'Form'
				);
			endif;
		
			$this->myRandomNumber = rand(1,10000000);
			$this->Auth->allow('login','logout','activation','register','codeRecoveryPassword','updatePassword','display');
			
			if ($this->Auth->user('role') == 'student'):
				$this->Auth->allow('usuario','updateRegister','professional_profile_menu','studentProfile','changePassword','studentProfessionalProfile','deleteStudentProfessionalProfile','viewStudentProfessionalProfile','editStudentProfessionalProfile','autoCompletado','getData','studentJobProspect','studentHeader','studentJobSkill','deleteStudentJobSkill','viewStudentJobSkill','editStudentJobSkill','studentLenguage','deleteStudentLenguage','viewStudentLenguage','editStudentInterestJob','editStudentLenguage','studentTechnologicalKnowledge','deleteStudentTechnologicalKnowledge','viewStudentTechnologicalKnowledge','editStudentTechnologicalKnowledge','studentProfessionalExperience','deleteStudentProfessionalExperience','viewStudentProfessionalExperience','editStudentProfessionalExperience','studentStudentWorkArea','deleteStudentWorkArea','editStudentWorkArea','studentStudentResponsability','deleteStudentResponsability','studentAchievement','deleteStudentAchievement','studentAcademicProject','deleteStudentAcademicProject','viewStudentAcademicProject','editStudentAcademicProject','studentAcademicProjectResponsability','deleteStudentAcademicProjectResponsability','studentAcademicProjectAchievement','deleteStudentAcademicProjectAchievement','studentProfessionalSkill','deleteStudentProfessionalSkill','studentProspect','studentInterestJob','deleteStudentInterestJob','studentContact','disableStudentRegister','searchOffer','specificSearch','specificSearchResults','studentSavedSearch','viewPdf','create_pdf','studentFolder','studentSavedOffer','deleteStudentFolder','block','offerAdmin','register','createPdf','deleteRegister','editStudentResponsability','editStudentAchievement','viewOfferPdf');
			else:
				if(($this->Auth->user('role') === 'administrator') OR ($this->Auth->user('role') === 'subadministrator')):
					$this->Auth->allow();
				endif;
			endif;
			
			if(($this->Session->check('Auth.User')) and (($this->Auth->user('role') === 'administrator') OR ($this->Auth->user('role') === 'subadministrator'))):	
				if($this->request->query('editingAdmin')=='yes'):
					$this->Session->write('student_id', $this->request->query('student_id') );
					$this->Session->write('editingAdmin', $this->request->query('editingAdmin') );
				else:
					if($this->Session->check('editingAdmin')):
						$this->Session->write('student_id', $this->Session->read('student_id') );
						$this->Session->write('editingAdmin', $this->Session->read('editingAdmin') );
					else:
						$this->Session->setFlash('No se encontraron sesiones de universitarios o empresas activas, puede volver como administrador o si requiere logueo como alumno o empresa cierre su sesión actual: <br /> <a href="http://bolsa.trabajo.unam.mx/unam/admin" style="color: #a94442; text-decoration: underline;">Volver como administrador</a> o <a href="http://bolsa.trabajo.unam.mx/unam/Administrators/logout" style="color: #a94442; text-decoration: underline;">Cerrar sesión de administrador</a>', 'alert-danger');		
						$this->redirect(array('controller'=>'pages','action'=>'display'));
					endif;
				endif;
			else:
				if(($this->Session->check('Auth.User')) and ($this->Session->read('Auth.User.role') == 'student')):
					$this->Session->write('student_id', $this->Auth->user('id'));
				endif;
			endif;
			
			$conditions = array('StudentProfessionalProfile.student_id' => $this->Session->read('student_id'));		
			$statusCV = $this->StudentProfessionalProfile->hasAny($conditions);
			$this->set('statusCV', $statusCV);
			$this->notification();
			$this->folder();
			$this->Student->recursive = -2;
			$this->set('student', $this->Student->findById($this->Session->read('student_id'),['fields'=>'Student.*,StudentProfile.*']));
		}
		
		public function isAuthorized($student){
			
			if (isset($student['role']) && $student['status'] == 1 && $student['role'] == 'student'):
				return true;
			else:
				$this->Session->setFlash('Lo sentimos, su usuario se encuentra sin acceso a esta sección.', 'alert-danger');
				$this->redirect($this->Auth->logout());
				return false;
			endif;
			return false;
		}
		
		public function peticion(){
			$posts = $this->requestAction(array('controller'=>'external','action' => 'ver',1));
			$resultado = count($posts);

			if($resultado === 1):
					echo $posts[0]['External']['name'];
					echo ' ' . $resultado;
			else:
					echo 'Usuario no existe ';
					echo $resultado;
			endif;		
		}		

		public function usuario(){ 
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
			$this->disabilityType();
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			$interesesAreacv = $this->StudentInterestJob->find('all', ['conditions' => ['StudentInterestJob.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('interesesAreacv') );
			$this->academicLevel();
			$this->Facultades();
			$this->Escuelas();
			$this->career();
			$this->posgradoProgrma();
			$this->NivelesIdioma();
			$this->TypeCourses();
			$software = $this->Program->find('list', ['order' => ['Program.id ASC']]);
			$this->set( compact ('software') );
			$carreras = $this->Career->find('list',['fields' => ['Career.id', 'Career.career'],'order' => ['Career.career ASC']]);
			$this->set( compact ('carreras') );
			$carrerasRegistro = $this->Career->find('list',['fields' => ['Career.career_id', 'Career.career'],'order' => ['Career.career ASC']]);
			$this->set( compact ('carrerasRegistro'));
			$programas = $this->PosgradoProgram->find('list',['fields' => ['PosgradoProgram.id', 'PosgradoProgram.posgrado_program'],'order' => ['PosgradoProgram.posgrado_program ASC']]);
			$this->set( compact ('programas') );
		}
		
		public function profile($newSearch = null){
			$this->Student->recursive = 0;
			$this->CompanyJobProfile->recursive = 2;
			
			$limite = 5;
			if(isset($this->request->data['Student']['limit'])):
				$this->Session->write('limit', $this->request->data['Student']['limit']);
				$limite = $this->request->data['Student']['limit'];
			else:
				if(($this->Session->read('limit')) <> ''):
					$limite = $this->Session->read('limit');
				endif;
			endif;

			$this->StudentProfessionalProfile->recursive = -1;
			$buscarNiveles = $this->StudentProfessionalProfile->find('all', ['conditions' => ['StudentProfessionalProfile.student_id' => $this->Session->read('student_id')]]);

			foreach($buscarNiveles as $carrera):
				if($carrera['StudentProfessionalProfile']['career_id']<>''):
					$carrerasSQL['OR'][] = ['CompanyJobRelatedCareer.career_id' => $carrera['StudentProfessionalProfile']['career_id']];
				endif;
			endforeach;
			
			if((isset($carrerasSQL)) AND (!empty($carrerasSQL))):
				$listaIdsRelatedCareer = $this->CompanyJobRelatedCareer->find('list',['conditions' => ['OR' => [$carrerasSQL]],'fields'=>['CompanyJobRelatedCareer.company_job_profile_id']]);
														
				foreach($listaIdsRelatedCareer as $idRelatedCareer):
					$carreras['OR'][] = ['CompanyCandidateProfile.id' => $idRelatedCareer];
				endforeach;	
			endif;

			if(isset($carreras)):
				$listaOfertasGeneral = $this->CompanyCandidateProfile->find('all',['conditions' => ['AND' => [$carreras]],'fields'=> ['CompanyCandidateProfile.company_job_profile_id']]);
			else:
				$listaOfertasGeneral = array();
			endif;
			
			foreach($listaOfertasGeneral as $listaOfertaGeneral):
				$idsListaOfertaGeneral[] = $listaOfertaGeneral['CompanyCandidateProfile']['company_job_profile_id'];
			endforeach;		
			 
			if(!isset($idsListaOfertaGeneral)):
				$idsListaOfertaGeneral = array();
			endif;

			$criterio['OR'][] = array('CompanyJobProfile.id' => $idsListaOfertaGeneral);
			
			if(empty($idsListaOfertaGeneral)):
				$criterio[] = '';
			endif;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			$hoy = date('Y-m-d');
			$this->paginate = ['conditions' => array(
															'OR' => array(
																		// $criterio
																		),
															'AND' => array(
																		// 'CompanyJobProfile.expiration >= ' => $hoy,
																		// 'CompanyJobContractType.status'  => 1,
																		// 'Company.status'  => 1
																		)
															),
										'limit' => $limite,
										'order' => 'CompanyJobContractType.created DESC',
										];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////										
			$ofertas = $this->paginate('CompanyJobProfile');
		
			$this->set('ofertas', $ofertas);
		}
		
		public function login(){
			if ($this->request->is('post')):
				if($this->request->data['Student']['username'] == 'prueba'):
					$student = $this->Student->find('all', ['conditions' => ['Student.status' => 1,'StudentProfile.sex <>' => ''],'limit' => 1,'order' => 'rand()']);
					$student[0]['Student']['StudentProfile'] = $student[0]['StudentProfile'];
					$this->Session->write('Auth.User', $student[0]['Student'] );
					$this->redirect($this->Auth->redirectUrl());
				endif;
				
				if ($this->Auth->login()):
					if ($this->Auth->user('activation') == 1):
						if ($this->Auth->user('status') == 1):
							$conditions = array(
								'StudentProfessionalProfile.student_id' => $this->Session->read('student_id')
							);		
							$res = $this->StudentProfessionalProfile->hasAny($conditions);
							if($res >= 1):
								$this->Auth->loginRedirect = array('controller' => 'Students', 'action' => 'profile');
							else:
								$this->Auth->loginRedirect = array('controller' => 'Students', 'action' => 'studentProfile');
							endif;	
							$this->request->data['Student']['password'] = '';
							$this->Session->delete('editingAdmin');
							$this->Session->delete('Editando');
							$this->redirect($this->Auth->Redirect());
						else:
							$this->Session->setFlash('Lo sentimos su usuario se encuentra bloqueado.', 'alert-danger');						
							$this->redirect($this->Auth->logout());
						endif;
					else:
						$this->Session->setFlash('Debe de confirmar su registro accediendo al link que se envió al correo que ingresó.', 'alert-danger');
						$this->redirect($this->Auth->logout());
					endif;
				else:
					$this->Session->setFlash('Su usuario o contraseña es incorrecta', 'alert-danger');
					$this->redirect($this->Auth->logout());
				endif;
			endif;
		}
		
		public function logout(){
			$this->Session->delete('Student');
			$this->Session->delete('escuelaSeleccionada');
           	$this->Session->delete('carreraSeleccionada');
			$this->Session->delete('terminosCondiciones'); 
			$this->Session->delete('student_id');
			$this->Session->delete('editingAdmin');
			$this->Session->delete('Editando');
			// $this->Session->destroy();			
			return $this->redirect($this->Auth->logout());
		}

		public function register(){
			if($this->request->is('post')):
				$this->Session->write('escuelaSeleccionada', $this->request->data['Student']['institution'] );
				$this->Session->write('carreraSeleccionada', $this->request->data['Student']['career'] );
				$this->Session->write('terminosCondiciones', $this->request->data['terminos']);
			endif;
			
			if($this->Session->check('Auth.User')):
				$this->request->data['Student']['password'] = '';
				$this->redirect($this->Auth->redirectUrl());
			endif;
			
			$AcademicLevels = $this->AcademicLevel->find('list', array('order' => array('AcademicLevel.id ASC')));
			$this->set( compact ('AcademicLevels') );
			
			$AcademicSituation = $this->AcademicSituation->find('list', array('order' => array('AcademicSituation.id ASC')));
			$this->set( compact ('AcademicSituation') );
			
			if ($this->request->is('post')):
				if (!empty($this->data)):
					error_reporting(E_ALL);
					ini_set("display_errors", 1);
					ini_set('soap.wsdl_cache_enabled', '0');
					ini_set('soap.wsdl_cache_ttl', '0');
					ini_set("default_socket_timeout", 5);
						 
					$key = SHA1('Los libros son las abejas que llevan el polen de una inteligencia a otra / James Russell Lowell');

					$getLevel = $this->request->data['Student']['academic_level_id'];
					
					if($getLevel==1):
						$nivel = 'L';
					else:
						if($getLevel==2):
							$nivel = 'E';
						else:
							if($getLevel==3):
								$nivel = 'M';
							else:
								if($getLevel==4):
									$nivel = 'D';
								else:
									$nivel = '';
								endif;
							endif;
						endif;
					endif;
					
					$args = array(
							'key' => $key,
							'cta' => $this->request->data['Student']['username'],
							'nvl' => $nivel,
							'plt' => $this->request->data['Student']['institution'],
							'crr' => $this->request->data['Student']['career']
					);
					
					// WSDL del web service
					$wsdl = 'https://www.dgae-siae.unam.mx/ws/soap/dgae_vign_alu_srv.php?wsdl';
					// Instancia de la clase
					$sclient = new SoapClient($wsdl, array('encoding'=>'ISO-8859-1','trace'=>1));
					// llamada al método del web service
					$registro = $sclient->return_vigencia($args);
					// vaciado del contenido de $registro
					
				
					if(isset($registro->vigencia)):
						if (  ($registro->vigencia <> 3) && (($registro->apellido1 <> '') && ($registro->apellido1 <> NULL) ) && (($registro->nombres <> '') && ($registro->nombres <> NULL) )  ):
							if ($this->data):
								$this->Student->StudentProfile->validate = array();
								$validator = $this->Student->StudentProfile->validator();
								$this->request->data['StudentProfile']['name'] = utf8_encode($registro->nombres);
								$this->request->data['StudentProfile']['last_name'] = utf8_encode($registro->apellido1);
								$this->request->data['StudentProfile']['second_last_name'] = utf8_encode($registro->apellido2);
								$this->request->data['StudentProfile']['date_of_birth'] = '0000-00-00';
								
								if($this->Student->saveAll($this->request->data, array('validate' => 'only'))):
										
										$this->request->data['Student']['activation'] = $this->myRandomNumber;	
										$this->request->data['Student']['code_recovery_password'] = 0;							
										$this->Student->create();
										
										if($this->Student->saveAssociated($this->request->data)):
													$Email = new CakeEmail('gmail');
													$Email->from(array('sisbut@unam.mx' => 'Bolsa bti.'));
													$Email->to($this->request->data['Student']['email'] );
													$Email->subject('Confirmación de registro Bolsa bti.');
													$Email->emailFormat('both');
													$Email->template('email')->viewVars( array(
																						'aMsg' => 
																						'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://ch3302files.storage.live.com/y4p0zc-aKdenRwNjteB3--a8ZKFbEHQ3HWnKQTN2l7nWGPAp-iM0Po85t1H9SEAVoUF52HRQ_2CyGXTWbqNQZ7VO1TlnvtdgVajgE30BwrozrsllLTb-gELTme85mkEwADPLEsZJO5x6gGmnogGweOHWKnuGYK5hYXtE7sn4u7Q7Zvs30yCnxY0tYYDuBAej6x2/header.jpg?psid=1&width=700&height=80" alt="header" width="100%">'.
																						'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Correo de confirmación de acceso al Sistema de la Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
	
																						'<p>Número de cuenta y contraseña registrada:<br/>'.
																						'<strong>Número de cuenta: </strong> ' . $this->request->data['Student']['username'] . '<br/>'.
																						'<strong>Password:</strong> ' . $this->request->data['Student']['password'] . '</p>'.
																						
																						'<p>Para poder acceder al SISBUT, favor de confirmar su registro en la siguiente liga: <a href="http://bolsa.trabajo.unam.mx/unam/Students/activation?email='.$this->request->data['Student']['email'].'&cod='.$this->myRandomNumber.'">Confirmar registro.</a><br/>'.
																						
																						'En algunos casos, la liga no aparece en azul y como un enlace. Si no funciona, copie la siguiente liga y péguela en una nueva ventana  de direcciones de su navegador. <br/>'.
																						'http://bolsa.trabajo.unam.mx/unam/Students/activation?email='.$this->request->data['Student']['email'].'&cod='.$this->myRandomNumber.'</p>'.
																						
																						'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																						'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																						'Correo electrónico: bolsa@unam.mx</p></div>'
													));
													$this->StudentLastUpdate->data['StudentLastUpdate']['id'] = $this->Student->getInsertID();
													$this->StudentLastUpdate->data['StudentLastUpdate']['student_username'] = $this->request->data['Student']['username'];
													$this->StudentLastUpdate->save($this->StudentLastUpdate->data);
													if($Email->send()):
														$this->Session->setFlash('Se ha enviado un correo electrónico de confirmación a la dirección electrónica que ingresó para que active su registro. Gracias.', 'alert-info'); 
													else:
														$this->Session->setFlash('Lo sentimos el correo para la confirmación de su registro no pudo ser enviado.', 'alert-danger');
													endif;
													
													$this->redirect(array('action' => 'logout'));
										else:
											$this->Session->setFlash('Lo sentimos, el usuario no pudo guardarse si el problema persiste contacte al administrador.', 'alert-danger');
										endif;
								else:
									$this->Session->setFlash('Porfavor, revise y corrija los campos marcados.', 'alert-danger');
								endif; 
							else:
								$this->Session->setFlash('Lo sentimos, no se encontró información para ser guardada.', 'alert-danger');
							endif;
						else:
							$this->Session->setFlash('Alumno NO autorizado por la base de datos UNAM.', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Usuario no registrado con los parámetros ingresados. Es importante que verifique la siguiente información: Número de cuenta, nivel máximo de estudios en la UNAM, su Escuela / Facultad y Carrera / Programa.', 'alert-danger');
						// debug($this->Student->invalidFields());
					endif;
				endif;
			endif;	
		} 
		
		public function codeRecoveryPassword(){	
				if ($this->request->is('post')):
					$student = $this->Student->findByEmail($this->data['Student']['email']);
					if (!$student):					
						$this->Session->setFlash('Correo electrónico no encontrado.', 'alert-danger');
					else:
						if ($this->Student->updateAll(array('Student.code_recovery_password' => $this->myRandomNumber),array('Student.id' => $student['Student']['id']))):
							$Email = new CakeEmail('gmail');
									$Email->from(array('sisbut@unam.mx' => 'Bolsa bti.'));
									$Email->to($this->request->data['Student']['email'] );
									$Email->subject('Solicitud de cambio de contraseña Bolsa bti.');
									$Email->emailFormat('both');
									$Email->template('email')->viewVars( array(
																				'aMsg' =>
																						'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://ch3302files.storage.live.com/y4p0zc-aKdenRwNjteB3--a8ZKFbEHQ3HWnKQTN2l7nWGPAp-iM0Po85t1H9SEAVoUF52HRQ_2CyGXTWbqNQZ7VO1TlnvtdgVajgE30BwrozrsllLTb-gELTme85mkEwADPLEsZJO5x6gGmnogGweOHWKnuGYK5hYXtE7sn4u7Q7Zvs30yCnxY0tYYDuBAej6x2/header.jpg?psid=1&width=700&height=80" alt="header" width="100%">'.
																						'<p style="color: #835B06; font-size: 24px; font-weight: bold; text-align: center;">Cambio de Contraseña</p>'.
																						'<p>Si usted solicitó un cambio de contraseña para poder acceder al Bolsa bti., por favor siga las indicaciones a continuación; si no lo solicitó haga caso omiso a este correo, sus datos de acceso seguirán siendo los mismos.<p>'.
																						'<p>Para confirmar el cambio de contraseña de acceso al Bolsa bti., de clic en el link siguiente: <a href="http://bolsa.trabajo.unam.mx/unam/students/updatePassword?id='.$student['Student']['id'].'&cod='.$this->myRandomNumber.'">Cambiar contraseña</a></p>'.
																						
																						'En algunos casos, la liga no aparece en azul y como un enlace. Si no funciona, copie la siguiente liga y péguela en la barra de direcciones de su navegador. <br/>'.
																						'http://bolsa.trabajo.unam.mx/unam/students/updatePassword?id='.$student['Student']['id'].'&cod='.$this->myRandomNumber.'</p>'.
																						
																						'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
																						'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
																						'Correo electrónico: bolsa@unam.mx</p></div>'
										));
									if($Email->send()):
										$this->Session->setFlash('Se ha enviado una liga a su correo de registro para recuperar su contraseña', 'alert-info');
									else:
										$this->Session->setFlash('Lo sentimos el correo con la solicitud del cambio de contraseña no pudo ser enviado.', 'alert-danger');
									endif;		
									
								$this->Session->delete('Student');
								$this->redirect(array('action' => 'logout'));
						else:
							$this->Session->setFlash('Lo sentimos ocurrio un error en el proceso de restablecimiento de contraseña,'.
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
				$student = $this->Student->findById($id);
				if (!$id || !$cod):							
					$this->Session->setFlash('No se encontraron parametros necesarios para completar la transacción, verifique que copio la url correctamente.', 'alert-danger');
				else:
					if ($student):
						if($student['Student']['code_recovery_password'] == 0):
							$this->Session->setFlash('Lo sentimos no existen solicitudes de cambio de contraseñas vigentes para este usuario.', 'alert-danger');
							$this->redirect(array('action' => 'logout'));
						endif;
					else:
						$this->Session->setFlash('Los sentimos, su usuario no ha sido encontrado', 'alert-danger');
						$this->redirect(array('action' => 'logout'));
					endif;
				endif;
			else:
				if($this->request->is('post')):
					$student = $this->Student->findById($this->request->data['Student']['id']);
					if ($student):
						if($student['Student']['code_recovery_password'] == 0):
							$this->Session->setFlash('Lo sentimos no existen solicitudes de cambio de contraseñas vigentes.', 'alert-danger');
							$this->redirect(array('action' => 'logout'));
						else:
							if($student['Student']['code_recovery_password'] == $this->request->data['Student']['cod']):
								$this->Student->set($this->request->data);	//pasa los parametros al modelo para ser validados.
								if ($this->Student->validates(array('fieldList' => array('password', 'password_confirm')))):	//pasa los campos que serán validados.
									$this->request->data['Student']['username'] = $student['Student']['username'];
									if($this->Student->updateAll(array('Student.password' => "'".AuthComponent::password($this->data['Student']['password'])."'", 'code_recovery_password' => 0),array('Student.id' => $student['Student']['id']))):
										
										if ($this->Auth->login()):
											if ($this->Auth->user('activation') == 1):
												if ($this->Auth->user('status') == 1):
													$this->request->data['Student']['password'] = '';
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
											$this->Session->setFlash('Usuario o contraseña incorrecta, intenta nuevamente.', 'alert-danger');
											$this->redirect($this->Auth->logout());
										endif;
										
									endif;	
								else:
									$this->Session->setFlash('Corrija los errores para continuar.', 'alert-danger');
								endif;
							else:
								$this->Session->setFlash('Lo sentimos, su código de verificación para el cambio de contraseña no es válido.', 'alert-danger');
								$this->redirect(array('action' => 'logout'));
							endif;
						endif;
					else:
						$this->Session->setFlash('Los entimos usuario no encontrado', 'alert-danger');
						$this->redirect(array('action' => 'logout'));
					endif;
				endif;
			endif;
		}			

		public function updateRegister() {
			$this->Student->id = $this->Session->read('student_id');	
			$this->Student->recursive = -2;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));	
			
			if($this->request->is('get')):	
				$this->request->data = $this->Student->read();
			else:
				$this->Student->validate = array();
				$validator = $this->Student->validator();			
				if($this->Student->save($this->request->data)):
					$this->Session->setFlash('Foto cargada', 'alert-success');
					$this->redirect(array('action' => 'updateRegister',$this->Session->read('student_id')));
				else:
					$this->Session->setFlash('Lo sentimos, no se pudo cargar su foto', 'alert-danger');
				endif;
			endif;	
		}
		
		public function deleteRegister($id = null) {
			if($this->request->is('post')):	
				$student = $this->Student->findById($this->Session->read('student_id'));
				if ($this->Student->updateAll(array(
													'Student.filename' => "''", 
													'Student.dir' => "''",
													'Student.mimetype' => "''",
													'Student.filesize' => 0,
													),
											array('Student.id' => $this->Session->read('student_id'))
											)
					):
							$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'student'.DS.'filename'.DS;
							unlink($destino.$student['Student']['filename']);
							$this->Session->setFlash('Foto eliminada', 'alert-success');
							$this->redirect(array('action' => 'updateRegister',$this->Session->read('student_id')));
				else:
					$this->Session->setFlash('Lo sentimos, la foto no pudo ser eliminada', 'alert-danger');
					$this->redirect(array('action' => 'updateRegister',$this->Session->read('student_id')));
				endif;
			else:
				$this->Session->setFlash('Lo sentimos, la foto no pudo ser eliminada', 'alert-danger');
				$this->redirect(array('action' => 'updateRegister',$this->Session->read('student_id')));
			endif;	
		}
		
		public function activation($email = null, $cod = null) {
			$cod = $this->request->query('cod');
			$email = $this->request->query('email');
				
			if (!$cod or !$email):
				$this->Session->setFlash('No se encontraron parametros necesarios para completar la transacción, verifique que copio la url correctamente!!!', 'alert-danger');
				$this->redirect(array('action' => 'logout'));
			else:			
				$student = $this->Student->findByEmail($email);
				if (!$student):
					$this->Session->setFlash('No se encontró el usuario, verifique que copio la url correctamente!!!', 'alert-danger');
					$this->redirect(array('action' => 'logout'));
				else:
					if($student['Student']['activation'] == 1):
						$this->Session->setFlash('El codigo de verificación ya ha sido usado, ingresa tu Usuario y Contraseña para iniciar sesión', 'alert-danger');
						$this->redirect(array('action' => 'logout'));
					else:
						if($student['Student']['activation'] !== $cod):
							$this->Session->setFlash('El codigo de verificación no es correcto, verifique que copio la url correctamente', 'alert-danger');
							$this->redirect(array('action' => 'logout'));
						else:							
							if ($this->Student->updateAll(array('Student.status' => 1, 'Student.activation' => 1),array('Student.id' => $student['Student']['id']))):
								$this->Session->setFlash('Su confirmación se realizó satisfactoriamente. Ya puede acceder al Sistema, para continuar con su registro.', 'alert-success');
								$this->redirect(array('action' => 'logout'));
							else:
								$this->Session->setFlash('Lo sentimos hubo un error y no se pudo activar al usuario, si el problema persiste consulte al administrador.', 'alert-danger');
								$this->redirect(array('action' => 'logout'));
							endif;
						endif;
					endif;
				endif;
			endif;					
		}
	
		public function professional_profile_menu(){
			$this->Student->recursive = 2;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
		}
		
		public function studentProfile() {	
			$this->Student->id = $this->Session->read('student_id');			
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
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
			
			$this->sexo();
			$this->country();
			$this->maritalStatus();
			$this->disabilityType();
			if($this->request->is('get')):	
				$this->request->data = $this->Student->read();
			else:
				if($this->request->is('post')):
					$this->StudentProfile->set($this->request->data);
					if($this->StudentProfile->save($this->request->data)):
						$this->studentLastUpdate();
						$this->Student->set($this->request->data);
						if ($this->Student->validates(array('fieldList' => array('email')))):
							if($this->Student->updateAll(array('Student.email' => "'".$this->request->data['Student']['email']."'"),array('Student.id' => $this->Session->read('student_id')))):
								$this->Session->setFlash('Registro guardado', 'alert-success');
								$this->redirect(array('action' => 'studentProfile',$this->Session->read('student_id')));
							else:
								$this->Session->setFlash('Lo sentimos, no pudimos actualizar tu registro', 'alert-danger');
								$this->redirect(array('action' => 'studentProfile',$this->Session->read('student_id')));
							endif;
						else:
							$this->Session->setFlash('Corrige los errores para continuar', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Corrige los errores para continuar', 'alert-danger');
					endif;
				endif;
			endif;	
		}
		
		public function changePassword(){
			$this->Student->id = $this->Session->read('student_id');
			$this->Student->recursive = 0;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			if($this->request->is( 'get' ) ):
				$this->request->data = $this->Student->read();
			else:			
				if($this->request->is('post')):
					$this->Student->set($this->request->data);	//pasa los parametros al modelo para ser validados.
						if ($this->Student->validates(array('fieldList' => array('new_password', 'new_password_confirm', 'old_password','email_confirm')))):	//pasa los campos que serán validados.
							if($this->Student->updateAll(array('Student.password' => "'".AuthComponent::password($this->data['Student']['new_password'])."'"),array('Student.id' => $this->Student->data['Student']['id']))):
								$Email = new CakeEmail('gmail');
									$Email->from(array('sisbut@unam.mx' => 'UNAM – SISBUT / Modificación de contraseña - usuario'));
									$Email->to($this->request->data['Student']['email'] );
									$Email->subject('Detalles del cambio de contraseña Bolsa bti.');
									$Email->emailFormat('both');
									$Email->template('email')->viewVars( array(
													'aMsg' => 
													'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://ch3302files.storage.live.com/y4p0zc-aKdenRwNjteB3--a8ZKFbEHQ3HWnKQTN2l7nWGPAp-iM0Po85t1H9SEAVoUF52HRQ_2CyGXTWbqNQZ7VO1TlnvtdgVajgE30BwrozrsllLTb-gELTme85mkEwADPLEsZJO5x6gGmnogGweOHWKnuGYK5hYXtE7sn4u7Q7Zvs30yCnxY0tYYDuBAej6x2/header.jpg?psid=1&width=700&height=80" alt="header" width="100%">'.
													'<p style="color: #835B06; font-size: 24px; font-weight: bold; text-align: center;">Detalles del cambio de contraseña</p>'.
													'<p>Esta es tu información (mantenla en secreto y guárdala bien) para iniciar tu sesión en Bolsa bti.</p>'.
													
													'<p><strong>Usuario: </strong>' . $this->request->data['Student']['username']. '<br/>' .
													'<strong>Contraseña: </strong><div style="background-color: #D8D8D8; width: 850px; text-align: justify;">' . $this->request->data['Student']['new_password'] . '</p>' .
													'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
													
													'<p><div style="background-color: #D8D8D8; width: 850px; text-align: justify;">Si necesita ayuda, favor de comunicarse a:<br/>'.
													'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
													'Correo electrónico: bolsa@unam.mx</p></div>'
									));
									if($Email->send()):
										$this->Session->setFlash('Su contraseña ha sido modificada exitosamente, podrá acceder con ella en su próxima visita.', 'alert-success');
									else:
										$this->Session->setFlash('El correo con los cambios de contraseña no pudo ser enviado.', 'alert-danger');
									endif;	
									
									$this->redirect(array('action' => 'logout'));
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo cambiar su contraseña si el problema persiste contacte al administrador.', 'alert-danger');
							endif;	
						else:
							$this->Session->setFlash('Corrija los errores para continuar.', 'alert-danger');
						endif;
				endif;
			endif;
		}

		public function studentProfessionalProfile($tipo = null){
			if(($this->Session->read('tipoProfessionalProfile')<>'') || ($tipo<>null)):
				$id = $this->Session->read('student_id');
				
				$this->Session->write('tipoProfessionalProfile', $tipo );
				$this->country();
				$this->scholarshipProgram();
				$this->average();
				$this->decimalAverage();
				$this->semester();
				$this->academicSituation();
				$this->Escuelas();
				$this->Facultades();
				$this->states();

				$this->paginate = ['conditions' => array('Student.id' => $id)];
				
				if($tipo == 1):
					$licenciaturas = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '1',
																									'StudentProfessionalProfile.student_id' =>$id]]);
					$this->set( compact ('licenciaturas') );
				endif;
				if($tipo == 2):
					$especialidades = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '2',
																									'StudentProfessionalProfile.student_id' =>$id]]);
					$this->set( compact ('especialidades') );
				endif;
				if($tipo == 3):
					$maestrias = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '3',
																									'StudentProfessionalProfile.student_id' =>$id]]);
					$this->set( compact ('maestrias') );
				endif;
				if($tipo == 4):
					$doctorados = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '4',
																									'StudentProfessionalProfile.student_id' =>$id]]);
					$this->set( compact ('doctorados') );	
				endif;
				
				$this->Student->id = $id;			
		
				if($this->request->is('post')):	
					
					$this->request->data['StudentProfessionalProfile']['entrance_year_degree']['day']= '01';
					$this->request->data['StudentProfessionalProfile']['entrance_year_degree']['month']= '01';

					if($this->request->data['StudentProfessionalProfile']['academic_situation_id'] == '1'):
						$this->request->data['StudentProfessionalProfile']['egress_year_degree']=null;
					else:
						$this->request->data['StudentProfessionalProfile']['egress_year_degree']['day']= '01';
						$this->request->data['StudentProfessionalProfile']['egress_year_degree']['month']= '01';
					endif;
					
					if($this->request->data['StudentProfessionalProfile']['student_mobility'] == 'n') :
						$this->request->data['StudentProfessionalProfile']['mobility_start_date']=null;
						$this->request->data['StudentProfessionalProfile']['mobility_end_date']=null;
					endif;
						
					if($this->request->data['StudentProfessionalProfile']['academic_level_id']==1):
						$this->request->data['StudentProfessionalProfile']['posgrado_program_id'] = $this->request->data['StudentProfessionalProfile']['career_id'];//equivalente
					else:
						$this->request->data['StudentProfessionalProfile']['career_id'] = $this->request->data['StudentProfessionalProfile']['posgrado_program_id'];
					endif;

					if($this->Student->StudentProfessionalProfile->saveAll($this->request->data, ['validate' => 'only'])):					
						$this->request->data['StudentProfessionalProfile']['student_id'] = $this->Session->read('student_id');
						if($this->Student->StudentProfessionalProfile->save($this->request->data)):
							$this->Session->setFlash('Registro guardado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(['action' => 'studentProfessionalProfile',$this->request->data['StudentProfessionalProfile']['academic_level_id']]);
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo guardar su registro', 'alert-danger');
							$this->redirect(['action' => 'studentProfessionalProfile',$this->request->data['StudentProfessionalProfile']['academic_level_id']]);
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
				endif;	
			else:
				$this->redirect(['action' => 'studentProfile']);
			endif;
		}
		
		public function deleteStudentProfessionalProfile($id){
			if($this->request->is('post')):
				if($this->StudentProfessionalProfile->delete($id)):
					$this->Session->setFlash('Registro eliminado', 'alert-success');
					$this->studentLastUpdate();
					$this->redirect(array('action' => 'studentProfessionalProfile',$this->Session->read('tipoProfessionalProfile') ));
				endif;
			endif;
		}
		
		public function editStudentProfessionalProfile($id = null){
			if(($this->Session->read('tipoProfessionalProfile')<>'') || ($tipo<>null)):
				$tipo = $this->Session->read('tipoProfessionalProfile');
				$this->country();
				$this->scholarshipProgram();
				$this->average();
				$this->decimalAverage();
				$this->semester();
				$this->academicSituation();
				$this->Escuelas();
				$this->Facultades();
				$this->states();
				
				$this->paginate = ['conditions' => array('Student.id' => $this->Session->read('student_id'))];
				
				if($tipo == 1):
					$licenciaturas = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '1',
																									'StudentProfessionalProfile.student_id' =>$this->Session->read('student_id')]]);
					$this->set( compact ('licenciaturas') );
				endif;
				if($tipo == 2):
					$especialidades = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '2',
																									'StudentProfessionalProfile.student_id' =>$this->Session->read('student_id')]]);
					$this->set( compact ('especialidades') );
				endif;
				if($tipo == 3):
					$maestrias = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '3',
																									'StudentProfessionalProfile.student_id' =>$this->Session->read('student_id')]]);
					$this->set( compact ('maestrias') );
				endif;
				if($tipo == 4):
					$doctorados = $this->StudentProfessionalProfile->find('all',['conditions' =>['StudentProfessionalProfile.academic_level_id' => '4',
																									'StudentProfessionalProfile.student_id' =>$this->Session->read('student_id')]]);
					$this->set( compact ('doctorados') );	
				endif;
				
				$this->StudentProfessionalProfile->id = $id;			
				if($this->request->is('get')):
					$this->StudentProfessionalProfile->id = $id;		
					$this->request->data = $this->StudentProfessionalProfile->read();
				else:		
					if($this->request->is('post')):	
						$this->request->data['StudentProfessionalProfile']['entrance_year_degree']['day']= '01';
						$this->request->data['StudentProfessionalProfile']['entrance_year_degree']['month']= '01';

						if($this->request->data['StudentProfessionalProfile']['academic_situation_id'] == '1'):
							$this->request->data['StudentProfessionalProfile']['egress_year_degree']=null;
						else:
							$this->request->data['StudentProfessionalProfile']['egress_year_degree']['day']= '01';
							$this->request->data['StudentProfessionalProfile']['egress_year_degree']['month']= '01';
						endif;
						
						if($this->request->data['StudentProfessionalProfile']['student_mobility'] == 'n') :
							$this->request->data['StudentProfessionalProfile']['mobility_start_date']=null;
							$this->request->data['StudentProfessionalProfile']['mobility_end_date']=null;
						endif;
							
						if($this->request->data['StudentProfessionalProfile']['academic_level_id']==1):
							$this->request->data['StudentProfessionalProfile']['posgrado_program_id'] = $this->request->data['StudentProfessionalProfile']['career_id'];//equivalente
						else:
							$this->request->data['StudentProfessionalProfile']['career_id'] = $this->request->data['StudentProfessionalProfile']['posgrado_program_id'];
						endif;
								
						if($this->Student->StudentProfessionalProfile->saveAll($this->request->data, array('validate' => 'only'))):					
							$this->request->data['StudentProfessionalProfile']['student_id'] = $this->Session->read('student_id');
							if($this->Student->StudentProfessionalProfile->save($this->request->data)):
								$this->Session->setFlash('Registro guardado', 'alert-success');
								$this->studentLastUpdate();
								$this->redirect(array('action' => 'editStudentProfessionalProfile',$this->request->data['StudentProfessionalProfile']['id']));
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo guardar su registro', 'alert-danger');
								$this->redirect(array('action' => 'editStudentProfessionalProfile',$this->request->data['StudentProfessionalProfile']['id']));
							endif;
						else:
							$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						endif;
					endif;	
				endif;
			else:
				$this->redirect(array('action' => 'studentProfile',$this->Session->read('student_id')));
			endif;
		}
		
		public function studentJobProspect(){
			$this->Student->id = $this->Session->read('student_id');	
			if($this->request->is('get')):	
				$this->request->data = $this->Student->read();
			else:
				if($this->request->is('post')):					
						$this->request->data['StudentJobProspect']['student_id'] = $this->Session->read('student_id');
						if($this->Student->StudentJobProspect->save($this->request->data)):
							$this->Session->setFlash('Registro guardado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'studentJobProspect',$this->Session->read('student_id')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
							$this->redirect(array('action' => 'studentJobProspect',$this->Session->read('student_id')));
						endif;
					endif;
			endif;
		}
		
		public function studentHeader(){
			if($this->request->is('get')):	
				$this->Student->recursive = 0; 
				$this->set('student', $this->Student->findById($this->Session->read('student_id')));
				$this->Student->id = $this->Session->read('student_id');
				$this->request->data = $this->Student->read();
			else:
				if($this->request->is('post')):
					$this->request->data['StudentHeader']['student_id'] = $this->Session->read('student_id');
					if($this->StudentHeader->save($this->request->data)):
						$this->Session->setFlash('Registro guardado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'studentHeader',$this->Session->read('student_id')));
					else:
						$this->Session->setFlash('Lo sentimos registro no guardado', 'alert-success');
						$this->redirect(array('action' => 'studentHeader',$this->Session->read('student_id')));
					endif;
				endif;
			endif;
		}
		
		public function studentJobSkill(){
			$this->TypeCourses();
			$this->lenguage();
			$this->NivelesIdioma();
			$this->Tecnology();
			$this->Programas();
			$this->softwareLevel();
			
			$conocimientos = $this->StudentJobSkill->find('all', ['conditions' => ['StudentJobSkill.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('conocimientos') );
			
			$idiomas = $this->StudentLenguage->find('all', ['conditions' => ['StudentLenguage.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('idiomas') );
			
			$tecnologias = $this->StudentTechnologicalKnowledge->find('all', ['conditions' => ['StudentTechnologicalKnowledge.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('tecnologias') );
			
			if($this->request->is('post')):	
				if(!empty($this->data['StudentJobSkill']['date']['year'])):
					$this->request->data['StudentJobSkill']['date']['day']= '01';
					$this->request->data['StudentJobSkill']['date']['month']= '01';
				endif;
				
				if($this->Student->StudentJobSkill->saveAll($this->request->data, ['validate' => 'only'])):
					$this->request->data['StudentJobSkill']['student_id'] = $this->Session->read('student_id');
					if($this->Student->StudentJobSkill->save($this->request->data)):
						$this->Session->setFlash('Registro agregado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'studentJobSkill'));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
				endif;
			endif;
		}
		
		public function deleteStudentJobSkill($id){
			if($this->request->is('post')):
				if($this->StudentJobSkill->delete($id)):
					$this->Session->setFlash('Registro eliminado', 'alert-success');
					$this->studentLastUpdate();
					$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
				endif;
			endif;
		}
	
		public function editStudentJobSkill($id = null){
			$this->TypeCourses();
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			
			$this->StudentJobSkill->id = $id;			
	
			if($this->request->is('get')):	
				$this->request->data = $this->StudentJobSkill->read();
			else:
				if($this->request->data['StudentJobSkill']['duration'] == ''):
					$this->request->data['StudentJobSkill']['duration'] = 0;
				endif;
					
				if(!empty($this->data['StudentJobSkill']['date']['year'])):
					$this->request->data['StudentJobSkill']['date']['day']= '01';
					$this->request->data['StudentJobSkill']['date']['month']= '01';
				endif;
				
				if($this->Student->StudentJobSkill->saveAll($this->request->data, array('validate' => 'only'))):
					$this->request->data['StudentJobSkill']['student_id'] = $this->Session->read('student_id');
					if($this->Student->StudentJobSkill->save($this->request->data)):
						$this->Session->setFlash('Registro actualizado', 'alert-success');
						$this->studentLastUpdate();
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
				endif;
			endif;
		}
		
		public function studentLenguage($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			
			if($this->request->is('post')):	
				
				$this->request->data['StudentLenguage']['certification_year'] = $this->data['StudentLenguage']['certification_year']['year'];
					if($this->Student->StudentLenguage->saveAll($this->request->data, array('validate' => 'only'))):					
						$this->request->data['StudentLenguage']['student_id'] = $this->Session->read('student_id');
						
						$suma = 0;
						if($this->request->data['StudentLenguage']['reading_level'] == 1):
							$suma = $suma + 10;
						else:
							if($this->request->data['StudentLenguage']['reading_level'] == 2):
								$suma = $suma + 30;
							else:
								if($this->request->data['StudentLenguage']['reading_level'] == 3):
									$suma = $suma + 50;
								endif;
							endif;
						endif;

						if($this->request->data['StudentLenguage']['writing_level'] == 1):
							$suma = $suma + 10;
						else:
							if($this->request->data['StudentLenguage']['writing_level'] == 2):
								$suma = $suma + 30;
							else:
								if($this->request->data['StudentLenguage']['writing_level'] == 3):
									$suma = $suma + 50;
								endif;
							endif;
						endif;
						
						if($this->request->data['StudentLenguage']['conversation_level'] == 1):
							$suma = $suma + 10;
						else:
							if($this->request->data['StudentLenguage']['conversation_level'] == 2):
								$suma = $suma + 30;
							else:
								if($this->request->data['StudentLenguage']['conversation_level'] == 3):
									$suma = $suma + 50;
								endif;
							endif;
						endif;
						
						$res = $suma / 3;
						
						$this->request->data['StudentLenguage']['average'] = $res; 
						if($this->Student->StudentLenguage->save($this->request->data)):
							$this->Session->setFlash('Registro agregado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
							$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
					endif;
			endif;
		}
		
		public function deleteStudentLenguage($id){
			if($this->request->is('get')):
				throw new MethodNotAllowedException();
			else:
				if($this->StudentLenguage->delete($id)):
					$this->Session->setFlash('Registro eliminado', 'alert-success');
					$this->studentLastUpdate();
					$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
				endif;
			endif;
		}
		
		public function editStudentLenguage($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			
			$this->lenguage();
			$this->NivelesIdioma();
			
			$this->StudentLenguage->id = $id;			
	
			if($this->request->is('get')):	
				$this->request->data = $this->StudentLenguage->read();
			else:
				if($this->request->data['StudentLenguage']['score'] == ''):
					$this->request->data['StudentLenguage']['score'] = 0;
				endif;
				
				$this->request->data['StudentLenguage']['certification_year'] = $this->data['StudentLenguage']['certification_year']['year'];
					if($this->Student->StudentLenguage->saveAll($this->request->data, array('validate' => 'only'))):					
						$this->request->data['StudentLenguage']['student_id'] = $this->Session->read('student_id');
						
						$suma = 0;
						if($this->request->data['StudentLenguage']['reading_level'] == 1):
							$suma = $suma + 10;
						else:
							if($this->request->data['StudentLenguage']['reading_level'] == 2):
								$suma = $suma + 30;
							else:
								if($this->request->data['StudentLenguage']['reading_level'] == 3):
									$suma = $suma + 50;
								endif;
							endif;
						endif;
						
						if($this->request->data['StudentLenguage']['writing_level'] == 1):
							$suma = $suma + 10;
						else:
							if($this->request->data['StudentLenguage']['writing_level'] == 2):
								$suma = $suma + 30;
							else:
								if($this->request->data['StudentLenguage']['writing_level'] == 3):
									$suma = $suma + 50;
								endif;
							endif;
						endif;
						
						if($this->request->data['StudentLenguage']['conversation_level'] == 1):
							$suma = $suma + 10;
						else:
							if($this->request->data['StudentLenguage']['conversation_level'] == 2):
								$suma = $suma + 30;
							else:
								if($this->request->data['StudentLenguage']['conversation_level'] == 3):
									$suma = $suma + 50;
								endif;
							endif;
						endif;
						
						$res = $suma / 3;
						
						$this->request->data['StudentLenguage']['average'] = $res; 
						if($this->Student->StudentLenguage->save($this->request->data)):
							$this->Session->setFlash('Registro actualizado', 'alert-success');
							$this->studentLastUpdate();
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
			endif;
		}
		
		public function studentTechnologicalKnowledge($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			
			if($this->request->is('post')):	
					if($this->request->data['StudentTechnologicalKnowledge']['level'] == ''):
						$this->request->data['StudentTechnologicalKnowledge']['level'] = 0;
					endif;
					
					if($this->Student->StudentTechnologicalKnowledge->saveAll($this->request->data, array('validate' => 'only'))):					
						$this->request->data['StudentTechnologicalKnowledge']['student_id'] = $this->Session->read('student_id');
						if($this->Student->StudentTechnologicalKnowledge->save($this->request->data)):
							$this->Session->setFlash('Registro agregado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
							$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
					endif;
			endif;
		}
		
		public function deleteStudentTechnologicalKnowledge($id){
			if($this->request->is('get')):
				throw new MethodNotAllowedException();
			else:
				if($this->StudentTechnologicalKnowledge->delete($id)):
					$this->Session->setFlash('Registro eliminado', 'alert-success');
					$this->studentLastUpdate();
					$this->redirect(array('action' => 'studentJobSkill',$this->Session->read('student_id')));
				endif;
			endif;
		}
		
		public function viewStudentTechnologicalKnowledge($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			$this->set('tecnologia', $this->StudentTechnologicalKnowledge->findById($id));
		}
		
		public function editStudentTechnologicalKnowledge($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			$this->lenguage();
			$this->NivelesIdioma();
			$this->Tecnology();
			$this->NivelesIdioma();
			$this->Programas();
			$this->softwareLevel();
			$this->StudentTechnologicalKnowledge->id = $id;	
			
	
			if($this->request->is('get')):	
				$this->request->data = $this->StudentTechnologicalKnowledge->read();
			else:
				if($this->request->data['StudentTechnologicalKnowledge']['level'] == ''):
						$this->request->data['StudentTechnologicalKnowledge']['level'] = 0;
					endif;
					
					if($this->Student->StudentTechnologicalKnowledge->saveAll($this->request->data, array('validate' => 'only'))):					
						$this->request->data['StudentTechnologicalKnowledge']['student_id'] = $this->Session->read('student_id');
						if($this->Student->StudentTechnologicalKnowledge->save($this->request->data)):
							$this->Session->setFlash('Registro actualizado', 'alert-success');
							$this->studentLastUpdate();
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
			endif;
		}
		
		public function studentProfessionalExperience(){
			$this->contractType();
			$this->country();
			$this->states();
			$this->Rotation();

			$this->StudentProfessionalExperience->recursive =  2;
			$experiencias = $this->StudentProfessionalExperience->find('all', ['conditions' => ['StudentProfessionalExperience.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('experiencias') );
			
    		if($this->request->is('post')):	
					$total = $this->StudentProfessionalExperience->find('count', ['conditions' => ['AND' => ['StudentProfessionalExperience.student_id' =>  $this->Session->read('student_id'),
																											'StudentProfessionalExperience.company_name' => $this->request->data['StudentProfessionalExperience']['company_name']]]]);
					if($total==0):
						if($this->StudentProfessionalExperience->StudentWorkArea->saveAll($this->request->data, array('validate' => 'only'))):
							$this->request->data['StudentProfessionalExperience']['student_id'] = $this->Session->read('student_id');
							if($this->StudentProfessionalExperience->StudentWorkArea->saveAssociated($this->request->data)):
								$this->studentLastUpdate();
								$this->Session->setFlash('Registro agregado', 'alert-success');
								$this->redirect(array('action' => 'studentProfessionalExperience',$this->Session->read('student_id')));
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
								$this->redirect(array('action' => 'studentProfessionalExperience',$this->Session->read('student_id')));
							endif;
						else:
							$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->StudentProfessionalExperience->invalidate('company_name', 'La empresa que capturó ya ha sido guardada, para agregar otro puesto dentro de la misma empresa, de clic en editar a un lado del nombre de la empresa.');
					endif;
			endif;
		}
		
		public function deleteStudentProfessionalExperience($id){
			if($this->request->is('post')):
				if($this->StudentProfessionalExperience->delete($id)):
					$this->Session->setFlash('Registro eliminado', 'alert-success');
					$this->studentLastUpdate();
					$this->redirect(array('action' => 'studentProfessionalExperience'));
				endif;
			endif;
		}
		
		public function editStudentProfessionalExperience($id = null){
			$this->contractType();
			$this->country();
			$this->states();
			$this->Rotation();
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			$this->job();

			if($this->request->is('get')):	
				$this->Session->write('affterDeleteRow', 'editStudentProfessionalExperience/'.$id);
				$this->Session->write('StudentProfessionalExperienceId', $id );
				$this->StudentProfessionalExperience->recursive =  2;
				$experiencias = $this->StudentProfessionalExperience->find('all', ['conditions' => ['StudentProfessionalExperience.id' => $this->Session->read('StudentProfessionalExperienceId')]]);
				$this->set( compact ('experiencias') );

				$totalPuestos = $this->StudentWorkArea->find('count', ['conditions' => ['StudentWorkArea.student_professional_experience_id' => $this->Session->read('StudentProfessionalExperienceId')]]);
				$this->set( compact ('totalPuestos') );
			
				$this->StudentProfessionalExperience->id = $this->Session->read('StudentProfessionalExperienceId');	
				$this->request->data = $this->StudentProfessionalExperience->read();
			else:
				$experiencias = $this->StudentProfessionalExperience->find('all', ['conditions' => ['StudentProfessionalExperience.id' => $this->Session->read('StudentProfessionalExperienceId')]]);
				$this->set( compact ('experiencias') );

				$totalPuestos = $this->StudentWorkArea->find('count', ['conditions' => ['StudentWorkArea.student_professional_experience_id' => $this->Session->read('StudentProfessionalExperienceId')]]);
				$this->set( compact ('totalPuestos') );
				$total = $this->StudentProfessionalExperience->find('count', ['conditions' => ['AND' => [
																										'StudentProfessionalExperience.student_id' =>  $this->Session->read('student_id'),
																										'StudentProfessionalExperience.company_name' => $this->request->data['StudentProfessionalExperience']['company_name'],
																										'StudentProfessionalExperience.id <> ' => $this->request->data['StudentProfessionalExperience']['id']
																									]]]);
															
				if($total==0):
					if($this->StudentProfessionalExperience->saveAll($this->request->data, array('validate' => 'only'))):
						$this->request->data['StudentProfessionalExperience']['student_id'] = $this->Session->read('student_id');
						if($this->StudentProfessionalExperience->save($this->request->data)):
							$this->Session->setFlash('Registro actualizado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'editStudentProfessionalExperience',$this->request->data['StudentProfessionalExperience']['id']));
						else:
							$this->Session->setFlash('Lo sentimos su registro no pudo ser actualizado', 'alert-danger');
							$this->redirect(array('action' => 'editStudentProfessionalExperience',$this->request->data['StudentProfessionalExperience']['id']));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar.', 'alert-danger');
					// $this->redirect(array('action' => 'editStudentProfessionalExperience',$this->request->data['StudentProfessionalExperience']['id']));
					$this->StudentProfessionalExperience->invalidate('company_name', 'La empresa que capturó ya ha sido guardada.',$this->request->data['StudentProfessionalExperience']['id']);
				endif;
			endif;
		}
		
		public function studentStudentWorkArea($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			
			if($this->request->is('post')):	
				if($this->StudentWorkArea->saveAll($this->request->data, array('validate' => 'only'))):
					if($this->StudentProfessionalExperience->StudentWorkArea->saveAssociated($this->request->data)):
						$this->Session->setFlash('Registro agregado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'editStudentProfessionalExperience',$this->request->data['StudentWorkArea']['student_professional_experience_id']));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
						$this->redirect(array('action' => 'editStudentProfessionalExperience',$this->request->data['StudentWorkArea']['student_professional_experience_id']));
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					$this->redirect(array('action' => 'editStudentProfessionalExperience',$this->request->data['StudentWorkArea']['student_professional_experience_id']));
				endif;
			endif;
		}
		
		public function deleteStudentWorkArea($id){
				if($this->request->is('get')):
					throw new MethodNotAllowedException();
				else:
					if($this->StudentWorkArea->delete($id)):
						$this->Session->setFlash('Registro eliminado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' =>$this->Session->read('affterDeleteRow')));
					endif;
				endif;
		}
		
		public function editStudentWorkArea($id=null){
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			$this->StudentWorkArea->id = $id;	
			$this->Session->write('editStudentWorkAreaId', $id );

			$this->StudentProfessionalExperience->recursive =  2;
			$puestos = $this->StudentWorkArea->find('all',['conditions' => ['StudentWorkArea.id' => $id]]);
			$this->set( compact ('puestos') );
			$this->job();
			
			if($this->request->is('get')):	
				$this->request->data = $this->StudentWorkArea->read();
			else:
				if($this->StudentWorkArea->save($this->request->data)):
					$this->Session->setFlash('Registro actualizado', 'alert-success');
					$this->studentLastUpdate();
					$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentWorkArea']['id']));
				else:
					$this->Session->setFlash('Lo sentimos el registro no pudo ser actualizado', 'alert-success');
				endif;
			endif;
		}	
		
		public function studentStudentResponsability($id = null){
			if($this->request->is('post')):	
					if($this->StudentResponsability->saveAll($this->request->data, array('validate' => 'only'))):					
						if($this->StudentResponsability->save($this->request->data)):
							$this->Session->setFlash('Registro agregado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentResponsability']['student_work_area_id']));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
							$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentResponsability']['student_work_area_id']));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentResponsability']['student_work_area_id']));
					endif;
			endif;
		}
		
		public function editStudentResponsability($id = null){
			$this->StudentResponsability->id = $id;			
			if($this->request->is('get')):	
				$this->request->data = $this->StudentResponsability->read();
			else:
				if($this->request->is('post')):		
					if($this->StudentResponsability->save($this->request->data)):
						$this->Session->setFlash('Registro actualizado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'editStudentResponsability',$this->request->data['StudentResponsability']['id']));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
						$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentResponsability']['student_work_area_id']));
					endif;
				endif;
			endif;
		}
		
		public function deleteStudentResponsability($id){
				if($this->request->is('get')):
					throw new MethodNotAllowedException();
				else:
					if($this->StudentResponsability->delete($id)):
						$this->Session->setFlash('Registro eliminado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'editStudentWorkArea',$this->Session->read('editStudentWorkAreaId')));
					endif;
				endif;
		}
		
		public function studentAchievement($id = null){		
			if($this->request->is('post')):	
					if($this->StudentAchievement->saveAll($this->request->data, array('validate' => 'only'))):					
						if($this->StudentAchievement->save($this->request->data)):
							$this->Session->setFlash('Registro agregado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentAchievement']['student_work_area_id']));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
							$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentAchievement']['student_work_area_id']));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentAchievement']['student_work_area_id']));
					endif;
			endif;
		}
		
		public function deleteStudentAchievement($id){
				if($this->request->is('get')):
					throw new MethodNotAllowedException();
				else:
					if($this->StudentAchievement->delete($id)):
						$this->Session->setFlash('Registro eliminado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'editStudentWorkArea',$this->Session->read('editStudentWorkAreaId')));
					endif;
				endif;
		}
		
		public function editStudentAchievement($id = null){
			$this->StudentAchievement->id = $id;			
			if($this->request->is('get')):	
				$this->request->data = $this->StudentAchievement->read();
			else:
				if($this->request->is('post')):					
					if($this->StudentAchievement->save($this->request->data)):
						$this->Session->setFlash('Registro actualizado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'editStudentAchievement',$this->request->data['StudentAchievement']['id']));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
						$this->redirect(array('action' => 'editStudentWorkArea',$this->request->data['StudentAchievement']['student_work_area_id']));
					endif;
				endif;
			endif;
		}
		
		public function studentAcademicProject(){
			$this->academicLevel(); 
			$this->country(); 
			$this->states();  
			$this->Rotation(); 
			$this->TypeProyect(); 
			$this->ExperienceArea();
			
			$proyectos = $this->StudentAcademicProject->find('all', ['conditions' => ['StudentAcademicProject.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('proyectos') );
			
			$experiencias = $this->StudentProfessionalExperience->find('count', ['conditions' => ['StudentProfessionalExperience.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('experiencias') );
			
			if($this->request->is('post')):	
				if($this->Student->StudentAcademicProject->saveAll($this->request->data, array('validate' => 'only'))):					
					$this->request->data['StudentAcademicProject']['student_id'] = $this->Session->read('student_id');
					if($this->Student->StudentAcademicProject->save($this->request->data)):
						$this->Session->setFlash('Registro agregado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'studentAcademicProject',$this->Session->read('student_id')));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
						$this->redirect(array('action' => 'studentAcademicProject',$this->Session->read('student_id')));
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
				endif;
			endif;
		}
		
		public function deleteStudentAcademicProject($id){
				if($this->request->is('get')):
					throw new MethodNotAllowedException();
				else:
					if($this->StudentAcademicProject->delete($id)):
						$this->Session->setFlash('Registro eliminado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'studentAcademicProject',$this->Session->read('student_id')));
					endif;
				endif;
		}
		
		public function viewStudentAcademicProject($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));

			$proyectos = $this->StudentAcademicProject->find('all', array(
																		'conditions' => array (
																			'StudentAcademicProject.id' => $id,	
																							)
			));
			$this->set( compact ('proyectos') );
		}
		
		public function editStudentAcademicProject($id=null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			$this->Session->write('editStudentAcademicProjectId', $id );
			$this->academicLevel(); 
			$this->country(); 
			$this->states();  
			$this->Rotation(); 
			$this->TypeProyect(); 
			$this->ExperienceArea();
			
			$proyectos = $this->StudentAcademicProject->find('all', array(
																		'conditions' => array (
																			'StudentAcademicProject.student_id' => $this->Session->read('student_id'),	
																							)
			));
			$this->set( compact ('proyectos') );
			
			$this->StudentAcademicProject->id = $id;			
	
			if($this->request->is('get')):	
				$this->request->data = $this->StudentAcademicProject->read();
			else:
				if($this->Student->StudentAcademicProject->saveAll($this->request->data, array('validate' => 'only'))):					
						$this->request->data['StudentAcademicProject']['student_id'] = $this->Session->read('student_id');
						if($this->Student->StudentAcademicProject->save($this->request->data)):
							// $this->StudentAcademicProjectResponsability->save($this->request->data)
							$this->Session->setFlash('Registro actualizado', 'alert-success');
							$this->studentLastUpdate();
							// $this->redirect(array('action' => 'studentAcademicProject',$this->Session->read('student_id')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo actualizado su registro', 'alert-danger');
							// $this->redirect(array('action' => 'studentAcademicProject',$this->Session->read('student_id')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
			endif;
		}
		
		public function studentAcademicProjectResponsability($id = null){
			if($this->request->is('post')):	
					if($this->StudentAcademicProjectResponsability->saveAll($this->request->data, array('validate' => 'only'))):					
						if($this->StudentAcademicProjectResponsability->save($this->request->data)):
							$this->Session->setFlash('Registro agregado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
							$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
					endif;
			endif;
		}
		
		public function deleteStudentAcademicProjectResponsability($id){
				if($this->request->is('get')):
					throw new MethodNotAllowedException();
				else:
					if($this->StudentAcademicProjectResponsability->delete($id)):
						$this->Session->setFlash('Registro eliminado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
					endif;
				endif;
		}
		
		public function studentAcademicProjectAchievement($id = null){
			if($this->request->is('post')):	
					if($this->StudentAcademicProjectAchievement->saveAll($this->request->data, array('validate' => 'only'))):					
						if($this->StudentAcademicProjectAchievement->save($this->request->data)):
							$this->Session->setFlash('Registro agregado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
							$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
					endif;
			endif;
		}
		
		public function deleteStudentAcademicProjectAchievement($id){
				if($this->request->is('get')):
					throw new MethodNotAllowedException();
				else:
					if($this->StudentAcademicProjectAchievement->delete($id)):
						$this->Session->setFlash('Registro eliminado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'editStudentAcademicProject',$this->Session->read('editStudentAcademicProjectId')));
					endif;
				endif;
		}
		
		public function studentProfessionalSkill($id = null){
			$Competencias = $this->Competency->find('all', array('order' => 'Competency.id DESC',));
			$this->set( compact ('Competencias') );
			
			$this->set('CompetenciasAlumno', $this->StudentProfessionalSkill->find('all', ['conditions' => ['StudentProfessionalSkill.student_id' => $this->Session->read('student_id')],
																					 'fields' => ['StudentProfessionalSkill.id', 'StudentProfessionalSkill.competency_id']]));
			
			if($this->request->is('get')):	
				$this->request->data = $this->StudentAcademicProject->read();
			else:
				if($this->request->is('post')):	
						if($this->Student->StudentProfessionalSkill->saveAll($this->request->data, array('validate' => 'only'))):					
							
							$this->StudentProfessionalSkill->deleteAll(array('StudentProfessionalSkill.student_id' => $this->Session->read('student_id')), false);
							$errror=0;
							foreach($this->request->data['StudentProfessionalSkill'] as $competency) {
								if($competency['competency_id'] <> 0):
									$competency['student_id'] = $this->Session->read('student_id');
									$this->StudentProfessionalSkill->create();
									if(!$this->StudentProfessionalSkill->save($competency)):
										$errror = 1;
									endif;
								endif;
							}
							
							if($errror == 1):
								$this->Session->setFlash('Lo sentimos, algunas competencias no pudieron cargarse', 'alert-danger');
								$this->redirect(array('action' => 'studentProfessionalSkill'));
							else:
								$this->Session->setFlash('Competencias agregadas', 'alert-success');
								$this->studentLastUpdate();
								$this->redirect(array('action' => 'studentProfessionalSkill'));
							endif;
						else:
							$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
							$this->redirect(array('action' => 'studentProfessionalSkill'));
						endif;
				endif;
			endif;
		}
		
		public function deleteStudentProfessionalSkill($id){
				if($this->request->is('get')):
					throw new MethodNotAllowedException();
				else:
					if($this->StudentProfessionalSkill->delete($id)):
						$this->Session->setFlash('Registro eliminado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'studentProfessionalSkill',$this->Session->read('student_id')));
					endif;
				endif;
		}
		
		public function studentProspect(){
			$this->Sector();
			$this->contractType();
			$this->workday();
			$this->salary();
			$this->Rotation();
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			
			$interesesArea = $this->StudentInterestJob->find('all',['conditions' => ['StudentInterestJob.student_id' => $this->Session->read('student_id')]]);
			$this->set( compact ('interesesArea') );
			
			if($this->request->is('get')):	
				$this->Student->id = $this->Session->read('student_id');		
				$this->request->data = $this->Student->read();
			else:
				$this->request->data['StudentProspect']['student_id'] = $this->Session->read('student_id');
				if($this->Student->StudentProspect->saveAll($this->request->data, array('validate' => 'only'))):
					$this->request->data['StudentProspect']['student_id'] = $this->Session->read('student_id');
					if($this->Student->StudentProspect->save($this->request->data)):
						$this->Session->setFlash('Registro guardado', 'alert-success');
						$this->studentLastUpdate();
						$this->redirect(array('action' => 'studentProspect',$this->Session->read('student_id')));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
						$this->redirect(array('action' => 'studentProspect',$this->Session->read('student_id')));
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					// debug($this->Student->invalidFields());
				endif;
			endif;	
		}
		
		public function studentInterestJob($id = null){
			if($this->request->is('post')):	
					$this->request->data['StudentInterestJob']['student_id'] = $this->Session->read('student_id');		
					if($this->Student->StudentInterestJob->saveAll($this->request->data, array('validate' => 'only'))):					
						if($this->StudentInterestJob->save($this->request->data)):
							$this->Session->setFlash('Registro agregado', 'alert-success');
							$this->studentLastUpdate();
							$this->redirect(array('action' => 'studentProspect',$this->Session->read('student_id')));
						else:
							$this->Session->setFlash('Lo sentimos, no se pudo agregar su registro', 'alert-danger');
							$this->redirect(array('action' => 'studentProspect',$this->Session->read('student_id')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						$this->redirect(array('action' => 'studentProspect',$this->Session->read('student_id')));
					endif;
			endif;
		}
		
		public function editStudentInterestJob($id = null){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
		
			$this->Rotation();
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			
			
			if($this->request->is('get')):	
				$this->StudentInterestJob->id = $id;		
				$this->request->data = $this->StudentInterestJob->read();
			else:
				if($this->request->is('post')):	
						$this->request->data['StudentInterestJob']['student_id'] = $this->Session->read('student_id');		
						if($this->Student->StudentInterestJob->saveAll($this->request->data, array('validate' => 'only'))):					
							if($this->StudentInterestJob->save($this->request->data)):
								$this->Session->setFlash('Registro actualizar', 'alert-success');
								$this->studentLastUpdate();
							else:
								$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
							endif;
						else:
							$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
						endif;
				endif;
			endif;
		}
		
		public function deleteStudentInterestJob($id){
			if($this->request->is('post')):
				if($this->StudentInterestJob->delete($id)):
					$this->Session->setFlash('Registro eliminado', 'alert-success');
					$this->studentLastUpdate();
					$this->redirect(array('action' => 'studentProspect',$this->Session->read('student_id')));
				else:
					$this->Session->setFlash('Lo sentimos, no se pudo eliminar su registro', 'alert-danger');
					$this->redirect(array('action' => 'studentProspect',$this->Session->read('student_id')));
				endif;
			endif;
		}
		
		public function studentContact(){
			$this->Student->recursive = -1;
			$student = $this->Student->findById($this->Session->read('student_id'));

			if($this->request->is('get')):
				$exists = is_file( WWW_ROOT.'files'.DS.'pdf'.DS.$student['Student']['username'].'.pdf' );
				$this->set('cvExiste', $exists );	
			else:
				$exists = is_file( WWW_ROOT.'files'.DS.'pdf'.DS.$student['Student']['username'].'.pdf' );
				$this->set('cvExiste', $exists );	
				if($this->request->is('post')):
					$this->Student->set($this->request->data);
					
					$correosTo = $this->request->data['Student']['emailTo'];
					$destinatariosTo = explode(";",$correosTo);
					foreach($destinatariosTo as $destinatarioTo) {
						if($destinatarioTo<>''):
							$listaCorreosTo[] = trim($destinatarioTo);
						endif;
					}
					
					if($this->request->data['Student']['CC'] <> ''):
						$correosCC = $this->request->data['Student']['CC'];
						$destinatariosCC = explode(";",$correosCC);
						foreach($destinatariosCC as $destinatarioCC) {
							if($destinatarioCC<>''):
								$listaCorreosCC[] = trim($destinatarioCC);
							endif;
						}
					endif;
					
					if($this->request->data['Student']['CCO'] <> ''):
						$correosCCO = $this->request->data['Student']['CCO'];
						$destinatariosCCO = explode(";",$correosCCO);
						foreach($destinatariosCCO as $destinatarioCCO) {
							if($destinatarioCCO<>''):
								$listaCorreosCCO[] = trim($destinatarioCCO);
							endif;
						}
					endif;	
							if ($this->Student->validates(array('fieldList' => array('title', 'CC','message')))):
								$Email = new CakeEmail('gmail');
								$Email->from(array($this->request->data['Student']['email'] => 'Bolsa bti'));
								
								$Email->to($listaCorreosTo);
							
								if($this->request->data['Student']['CC'] <> ''):
									$Email->cc($listaCorreosCC);
								endif;
								
								if($this->request->data['Student']['CCO'] <> ''):
									$Email->bcc($listaCorreosCCO );
								endif;
								
								$Email->subject('Envío de currículum Bolsa bti');
								$Email->replyTo($this->request->data['Student']['email']);
								$Email->emailFormat('html'); 
								$Email->attachments(WWW_ROOT.'files'.DS.'pdf'.DS.$student['Student']['username'].'.pdf');
								$contenMail = 	'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://ch3302files.storage.live.com/y4p0zc-aKdenRwNjteB3--a8ZKFbEHQ3HWnKQTN2l7nWGPAp-iM0Po85t1H9SEAVoUF52HRQ_2CyGXTWbqNQZ7VO1TlnvtdgVajgE30BwrozrsllLTb-gELTme85mkEwADPLEsZJO5x6gGmnogGweOHWKnuGYK5hYXtE7sn4u7Q7Zvs30yCnxY0tYYDuBAej6x2/header.jpg?psid=1&width=700&height=80" alt="header" width="100%">'.
												'<strong><h3>'.$this->request->data['Student']['title'].'</h3></strong><br>'.
												'<p>'.$this->request->data['Student']['message'].'</p><br><br>';
								if($this->request->data['Student']['sign'] <> ''):
									$contenMail .= 'Firma: '.$this->request->data['Student']['sign'].'<br><br></div>';
								endif;
								
								$contenMail .= '</div>';
								
								$Email->template('email')->viewVars( array(
																'aMsg' => $contenMail 
								));
								
								if($Email->send()):
									$this->Session->setFlash('Correo enviado.', 'alert-success');
									$this->redirect(array('action' => 'studentContact', $this->Session->read('student_id')));
								else:
									$this->Session->setFlash('Lo sentimos su correo no pudo ser enviado.', 'alert-danger');
									$this->redirect(array('action' => 'studentContact', $this->Session->read('student_id')));
								endif;
							else:
								$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
							endif;
				endif;
			endif;
		}
		
		public function disableStudentRegister(){
			$this->Question->recursive = -1;
			$preguntas = $this->Question->find('all', ['conditions' => ['Question.status !=' => 0]]);
			$this->set( compact ('preguntas') );
			$this->studentCancellation();
			
			if($this->request->is( 'get' ) ):
				$this->request->data = $this->Student->read();
			else:
				if($this->request->is('post')):
					$this->Student->set($this->request->data);
					if ($this->Student->validates(array('fieldList' => array('disable')))):
						if($this->request->data['Student']['disable']== 's'):
							
							foreach($this->request->data['StudentAnswer'] as $answer) {
								$answer['student'] = $this->Auth->user('username');
								if($answer['answer'] <> ''):
									$this->StudentAnswer->create();
									$this->StudentAnswer->save($answer);
								endif;
							 }
							 
							$student = $this->Student->findById($this->Session->read('student_id'));
							if($student['Student']['filename']<>''):
								$destino = WWW_ROOT.'img'.DS.'uploads'.DS.'student'.DS.'filename'.DS;
								unlink($destino.$student['Student']['filename']);
							endif;

							if($this->Student->delete($this->Session->read('student_id'))):
								$this->StudentDisabled->data['StudentDisabled']['student_username'] = $student['Student']['username'];
								$this->StudentDisabled->save($this->StudentDisabled->data);

								if($this->Session->read('redirectAdmin')):
									$this->Session->setFlash('El alumno fue eliminado correctamente.', 'alert-success');
									$this->redirect(array('controller'=>'Administrators', 'action' => $this->Session->read('redirectAdmin')));
								else:
									$this->Session->setFlash('Su registro fue eliminado exitosamente. Esperamos vuelva pronto. ', 'alert-success');
									$this->redirect(array('action' => 'logout'));
								endif;
								
							else:
								$this->Session->setFlash('Lo sentimos, su registro no pudo ser eliminado', 'alert-danger');
							endif;
								
						else:
							$this->Session->setFlash('Registro NO eliminado', 'alert-danger');
							$this->redirect(array('action' => 'disableStudentRegister',$this->Session->read('student_id')));
						endif;
					else:
						$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
					endif;
				endif;
			endif;			
		}		
		
		public function block($id){
			if($this->request->is('get')):
				$this->Student->id = $id;
				$this->Student->recursive = -1;
				$perfil = $this->Student->findById($this->Session->read('student_id'));
				if($perfil['Student']['block'] == 0):
					if($this->Student->updateAll(array('Student.block' => 1), array('Student.id' => $id))):
						$this->Session->setFlash('Su currículum no aparecerá en las búsquedas que realicen los reclutadores, pero usted podrá actualizar su currículum y seguir postulándose a ofertas laborales.', 'alert-danger');
						$this->redirect(array('action' => 'usuario'));
					else:
						$this->Session->setFlash('Lo sentimos, su registro no pudo ser desactivado', 'alert-danger');
						$this->redirect(array('action' => 'usuario'));
					endif;
				else:
					if($this->Student->updateAll(array('Student.block' => 0), array('Student.id' => $id))):
						$this->Session->setFlash('Su currículum nuevamente aparecerá en las búsquedas que realicen los reclutadores y que coincidan con su perfil profesional', 'alert-success');
						$this->redirect(array('action' => 'usuario'));
					else:
						$this->Session->setFlash('Lo sentimos, su registro no pudo ser activado', 'alert-danger');
						$this->redirect(array('action' => 'usuario'));
					endif;
				endif;
			else:
				$this->Session->setFlash('Método no permitido', 'alert-danger');
				$this->redirect(array('action' => 'usuario'));
			endif;
		}
		
		public function searchOffer($newSearch = null){
			$this->Student->recursive = 0;
			$this->CompanyJobProfile->recursive = 2;
			$this->CompanyProfile->recursive = 0;
			$this->CompanyJobOffer->recursive = 0;
			$this->Session->write('redirect', 'searchOffer');
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			$this->Session->write('affterPostulated', 'searchOffer');
			$this->Session->write('affterDeleteFolder', 'searchOffer');

			if($newSearch == 'nuevaBusqueda'):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('page');
				$this->Session->delete('tipoBusqueda');
				$this->Session->delete('orden');
			endif;
			
			if(isset($this->request->data['Student']['limit']) and ($this->request->data['Student']['limit'] <> '')):
				$this->Session->write('limit', $this->request->data['Student']['limit']);
				$limite = $this->request->data['Student']['limit'];
			else:
				if(($this->Session->read('limit')) <> ''):
					$limite = $this->Session->read('limit');
				else:
					$limite = 5; //default limit
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
				$orden = ' CompanyJobContractType.salary '.$this->request->query('orden');
				$this->Session->write('orden', $this->request->query('orden'));
			else:	
				$orden = ' CompanyJobContractType.created DESC';
			endif;
			
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Student']['criterio']) and ($this->request->data['Student']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Student']['criterio']);
					$tipoBusqueda = $this->request->data['Student']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 4; //Búsqueda default eqivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;
			
			if(isset($this->request->data['Student']['Buscar']) and ($this->request->data['Student']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Student']['Buscar']);
				$palabraBuscada  = $this->request->data['Student']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada = '';
				endif;
			endif;	
		
			if($tipoBusqueda == 1):
				//Obtiene las coincidencias de nombres del perfil de la compañía con la búsqueda
				$companyProfilesLikeName = $this->Company->find('list', ['conditions' => ['CompanyProfile.company_name LIKE' => '%'. $palabraBuscada . '%'],'recursive' => 2]);
				// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
				foreach($companyProfilesLikeName as $companyProfileLikeName):
					$idsCompaniesLikeName[] = $companyProfileLikeName;
				endforeach;	
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($idsCompaniesLikeName)):
					$idsCompaniesLikeName = '';
				endif;
				
				// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
				$companyJobOffersLikeName = $this->CompanyJobOffer->find('list', ['fields' => ['CompanyJobOffer.id'],
																				'conditions' => ['AND' => [
																											'CompanyJobOffer.company_id' => $idsCompaniesLikeName,
																											'CompanyJobOffer.confidential_job_offer' => 'n',
																											'CompanyJobOffer.company_name' => '',
																										]],
																				'recursive' => 2]);
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
				$companyJobOffersLikeName = $this->CompanyJobOffer->find('all', [
																	'fields' => ['CompanyJobOffer.id'],
																	'conditions' => ['AND' => [
																								'CompanyJobOffer.company_name LIKE' => '%'. $palabraBuscada . '%',
																								'CompanyJobOffer.confidential_job_offer' => 's',
																								'CompanyJobOffer.company_name <> ' => '']]]);
												
				foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
					$jobOffersLikeName[] = $companyJobOfferLikeName['CompanyJobOffer']['id'];
				endforeach;	
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($companyJobOffersLikeName)):	
						$jobOffersLikeName = '';
				endif;
				$criterio[] = ['AND' => ['OR' => ['CompanyJobProfile.id' => $idsompanyJobProfileResults,'CompanyJobProfile.company_job_offer_id'=>$jobOffersLikeName]]];
			else:
				if($tipoBusqueda == 2):
					$claves = explode(" ", $palabraBuscada);
					foreach ($claves as $clave){
						if(strlen($clave)>2):
							$criterio['OR'][] = array('CompanyJobProfile.job_name LIKE' => "%$clave%");
						endif;
					}
				else:
					if($tipoBusqueda == 3):
						$criterio[] = array('CompanyJobProfile.id'  => intval($palabraBuscada));
					else:
						$this->StudentProfessionalProfile->recursive = -1;
						$buscarNiveles = $this->StudentProfessionalProfile->find('all', ['conditions' => ['StudentProfessionalProfile.student_id' => $this->Session->read('student_id')]]);
																				
						foreach($buscarNiveles as $carrera):
							if($carrera['StudentProfessionalProfile']['career_id']<>''):
								$carrerasSQL['OR'][] = ['CompanyJobRelatedCareer.career_id' => $carrera['StudentProfessionalProfile']['career_id']];
							endif;
						endforeach;
						
						if((isset($carrerasSQL)) AND (!empty($carrerasSQL))):
							$listaIdsRelatedCareer = $this->CompanyJobRelatedCareer->find('list',['conditions' => ['OR' =>[$carrerasSQL]],
																								'fields' => ['CompanyJobRelatedCareer.company_job_profile_id']]);
																	
							foreach($listaIdsRelatedCareer as $idRelatedCareer):
								$criterio['OR'][] = array('CompanyCandidateProfile.id' => $idRelatedCareer);
							endforeach;	
							
							if(!isset($criterio)):
								$criterio[] = '';
							endif;
						endif;

						// Consulta General
						if(!empty($criterio)):
							$listaOfertasGeneral = $this->CompanyCandidateProfile->find('all',
																			['conditions' => ['AND' => [$criterio]],
																			'fields'=>array('CompanyCandidateProfile.company_job_profile_id')]);
						else:
							$listaOfertasGeneral = array();
						endif;
						
						foreach($listaOfertasGeneral as $listaOfertaGeneral):
							$idsListaOfertaGeneral[] = $listaOfertaGeneral['CompanyCandidateProfile']['company_job_profile_id'];
						endforeach;		
						 
						if(!isset($idsListaOfertaGeneral)):
							$idsListaOfertaGeneral = array();
						endif;
						
					endif;
				endif;
			endif;

			if(!isset($idsListaOfertaGeneral)):
				$criterio2[] =  $criterio;
			else:
				$criterio2[] = array('CompanyJobProfile.id' => $idsListaOfertaGeneral);
			endif;
			
			$this->paginate = ['conditions' => ['OR' => [$criterio2],
												'AND' =>[
																// 'CompanyJobProfile.expiration >= ' => date('Y-m-d'),
																// 'CompanyJobContractType.status'  => 1,
																// 'Company.status'  => 1
														]
													],
								'limit' => $limite,
								'order' => $orden];
										
			$ofertas = $this->paginate('CompanyJobProfile');
			$this->set('ofertas', $ofertas);
		}

		public function specificSearch($newSearch = null){
			$this->CompanyJobContractType->validate = array();
			$validator = $this->CompanyJobContractType->validator();
			
			$this->CompanyJobProfile->validate = array();
			$validator = $this->CompanyJobProfile->validator();
			
			$this->Session->write('affterPostulated', 'specificSearch/nuevaBusqueda');
			$this->Session->write('affterDeleteFolder', 'specificSearch/nuevaBusqueda');
			$this->Session->write('redirect', 'specificSearch');
			$this->set('busquedasGuardadas', $this->StudentSavedSearch->find('list', ['conditions' => ['StudentSavedSearch.student_id' => $this->Session->read('student_id')],'order' => 'StudentSavedSearch.id DESC']));
			
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
			$this->job();
			$this->Rotation();
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			$this->NivelesIdioma();
			$Estados = $this->State->find('list',['fields' => ['State.nombre', 'State.nombre'],'order' => ['State.nombre ASC']]);
			$this->set( compact ('Estados') );
			$this->softwareLevel();
		}
		
		public function specificSearchResults($newSearch = null){

			$this->CompanyJobContractType->validate = array();
			$validator = $this->CompanyJobContractType->validator();
			
			$this->CompanyJobProfile->validate = array();
			$validator = $this->CompanyJobProfile->validator();
			
			// $this->Student->recursive = 1;
			// $this->set('student', $this->Student->findById($this->Session->read('student_id')));
			// $this->CompanyJobProfile->recursive = 1;
			$this->Session->write('redirect', 'specificSearchResults');
			$this->Session->write('affterPostulated', 'specificSearchResults');
			$this->Session->write('affterDeleteFolder', 'specificSearchResults');
			
			// Verifica las ofertas guardadas y las manda para que puedan ser marcadas o no
			$this->set('busquedasGuardadas', $this->StudentSavedSearch->find('list', ['conditions' => ['StudentSavedSearch.student_id' => $this->Session->read('student_id')],'order' => 'StudentSavedSearch.id DESC']));
			$this->carrer();
			$this->posgradoProgrma();
			$this->lenguage();
			$this->contractType();
			$this->workday();
			$this->salary();
			$this->academicSituation();
			$this->academicLevel();
			$this->disabilityType();
			$this->job();
			$this->Rotation();
			$this->ExperienceArea();
			$this->ExperienceSubarea();
			$this->NivelesIdioma();
			$this->softwareLevel();
			$Estados = $this->State->find('list',['fields' => ['State.nombre', 'State.nombre'],'order' => ['State.nombre ASC']]);
			$this->set( compact ('Estados') );
			$criterio = array();
				
			if($this->request->is('post')):
				$this->Session->write('serialized_form', $this->request->data);
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('CompanyJobContractType');
				$this->Session->delete('CompanyJobProfile');
				$this->Session->delete('CompanyCandidateProfile');
				$this->Session->delete('CompanyJobLanguage');
				$this->Session->delete('CompanyJobComputingSkill');
				$this->Session->delete('CompanyJobRelatedCareer');
				$this->Session->delete('companyJobContractType');
			endif;
				
			if(isset($this->request->data['StudentSavedSearch']['name']) and ($this->request->data['StudentSavedSearch']['name'] <> '')):
				$this->studentSavedSearch();
			else:
				if((isset($this->request->data['Student']['busqueda_guardada'])) and ($this->request->data['Student']['busqueda_guardada'] <> '')):
					$busquedaGuardada = $this->StudentSavedSearch->findById($this->request->data['Student']['busqueda_guardada']);
					if(!empty($busquedaGuardada)):
						$this->request->data = unserialize($busquedaGuardada['StudentSavedSearch']['serialize_request']);
					endif;
				endif;
			endif;
				
			if($this->request->is('get')):
				$this->request->data = $this->Session->read('serialized_form');
			endif;

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
				$orden = $this->request->query('orden');
				$this->set('orden',$orden);
			else:
				$orden = 'CompanyJobProfile.created DESC'; //default order
			endif;
				
			//CompanyJobProfile// Palabra clave	
			if(isset($this->request->data['CompanyJobProfile']['job_name']) AND ($this->request->data['CompanyJobProfile']['job_name']<>'')):
				$this->Session->write('CompanyJobProfile.job_name', $this->request->data['CompanyJobProfile']['job_name']);
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
					$claves = explode(" ", $this->Session->read('CompanyJobProfile.job_name'));
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
				
			// CompanyJobProfile
			if(isset($this->request->data['CompanyJobProfileDynamicGiro'])):
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
			
			// CompanyCandidateProfile
			if(isset($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'])):
				$i = 0;
				$indice =0;
				foreach($this->request->data['CompanyCandidateProfileDynamicNivelAcademico'] as $nivelAcademico):
					$campo = '';
					if($nivelAcademico['academic_level']<>''):	
						if($nivelAcademico['academic_level']==1):
							$campo = 1;
						else:
							if($nivelAcademico['academic_level']==2):
								$campo = 2;
							else:
								if($nivelAcademico['academic_level']==3):
									$campo = 3;
								else:
									if($nivelAcademico['academic_level']==4):
										$campo = 4;
									endif;
								endif;
							endif;
						endif;
					endif;

					if($campo <> ''):
						if($nivelAcademico['academic_level']<>''):
							$this->Session->write('CompanyCandidateProfile.'.$i.'.academic_level_id', $campo);
							$niveles['OR'][$indice]['AND'][] = array('CompanyCandidateProfile.academic_level_id' => $campo);
						else:
							if($this->Session->read('CompanyCandidateProfile.'.$i.'.academic_level_id') <> ''):
								$niveles['OR'][$indice]['AND'][] = array('CompanyCandidateProfile.academic_level_id' => $this->Session->read('CompanyCandidateProfile.'.$i.'.academic_level_id'));
							endif;
						endif;
					endif;
					$i++;
					$indice++;
				endforeach;
			endif;

			if(isset($this->request->data['CompanyJobRelatedCareerDynamicCarrera'])):
				
				$i = 0;
				foreach($this->request->data['CompanyJobRelatedCareerDynamicCarrera'] as $carrera):
					if($carrera['career_id']<>''):
						$this->Session->write('CompanyJobRelatedCareer.'.$i.'.career_id', $carrera['career_id']);
						$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $carrera['career_id']);
					else:
						if(($this->Session->read('CompanyJobRelatedCareer.'.$i.'.career_id')) <> ''):
							$carrerasSQL['OR'][] = array('CompanyJobRelatedCareer.career_id' => $this->Session->read('CompanyJobRelatedCareer.'.$i.'.career_id'));
						endif;
					endif;
					$i++;
				endforeach;

				if((isset($carrerasSQL)) AND (!empty($carrerasSQL))):
					$listaIdsRelatedCareer = $this->CompanyJobRelatedCareer->find('list',
																['conditions' => ['OR' => [$carrerasSQL]],
																'fields'=>['CompanyJobRelatedCareer.company_job_profile_id'],
																'recursive' => 0]);
															
					foreach($listaIdsRelatedCareer as $idRelatedCareer):
						$idsListaRelatedCareer[] =  $idRelatedCareer;
					endforeach;	
				endif;

			endif;

			if(!isset($idsListaRelatedCareer)):
				$idsListaRelatedCareer[] = '';
			endif;

			if(isset($this->request->data['CompanyCandidateProfileDynamicSituacionAcademica'])):
				$i = 0;
				$indice = 0;
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
																				['conditions' => ['OR' => [$niveles]],
																				  'fields'=>array('CompanyCandidateProfile.company_job_profile_id'),
																				  'recursive' => -1]);
				else:
					$listaOfertasCompanyCandidateProfile = array();
				endif;
				
				foreach($listaOfertasCompanyCandidateProfile as $listaOfertasNivel):
					$idListaOfertasNiveles[] = $listaOfertasNivel['CompanyCandidateProfile']['company_job_profile_id'];
				endforeach;				
			endif;

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
					$listaOfertaslenguajes = $this->CompanyJobLanguage->find('all',['conditions' => ['OR' => [$idiomas]],'fields'=> ['CompanyJobLanguage.company_job_profile_id']]);
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

			//Cómputo
			if(isset($this->request->data['CompanyJobComputingSkill'])):
				// Nombre de conocimiento de computo buscando en catálogo y en la tabla CompanyJobComputingSkill
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
						$listaIdsProgramsName = $this->Program->find('list',['conditions' => ['OR' => [$programsName ]],'fields'=> ['Program.id']]);
																
						foreach($listaIdsProgramsName as $IdProgramName):
							$idsListaProgramName[] = $IdProgramName;
						endforeach;	
						
						if(!isset($idsListaProgramName)):
							$idsListaProgramName = array();
						endif;
						if(!empty($idsListaProgramName)):
							$computoSQL['OR'][$indice]['OR'][] = array('CompanyJobComputingSkill.name' => $idsListaProgramName);
						endif;
												
					endif;

					if((isset($computosName)) AND (!empty($computosName))):
						$listaIdsComputingSkillName = $this->CompanyJobComputingSkill->find('list', ['conditions' => ['OR' => [$computosName]],'fields'=>array('CompanyJobComputingSkill.id')]);
																
						foreach($listaIdsComputingSkillName as $IdComputingSkillName):
							$idsListaComputingSkillName[] = $IdComputingSkillName;
						endforeach;		
						if(!isset($idsListaComputingSkillName)):
							$idsListaComputingSkillName = array();
						endif;
						if(!empty($idsListaComputingSkillName)):
							$computoSQL['OR'][$indice]['OR'][] = array('CompanyJobComputingSkill.id' => $idsListaComputingSkillName);
						endif;
					endif;	

					if(isset($computo['level']) && ($computo['level']<>'')):
						$this->Session->write('CompanyJobComputingSkill.'.$i.'.level', $computo['level']);
						$computos['AND'][] = array('CompanyJobComputingSkill.level' => $computo['level']);
					else:
						if(($this->Session->read('CompanyJobComputingSkill.'.$i.'.level')) <> ''):
							$computos['AND'][] = array('CompanyJobComputingSkill.level' => $this->Session->read('CompanyJobComputingSkill.'.$i.'.level'));
						endif;
					endif;
					
					if((isset($computos)) AND (!empty($computos))):
						$listaOfertasComputos = $this->CompanyJobComputingSkill->find('list',['conditions' => ['AND' => [$computos]],'fields'=>['CompanyJobComputingSkill.id']]);
						
						foreach($listaOfertasComputos as $listaOfertaComputo):
							$idsListaComputingSkillLavel[] = $listaOfertaComputo;
						endforeach;		
						if(!isset($idsListaComputingSkillLavel)):
							$idsListaComputingSkillLavel = array();
						endif;
						if(!empty($idsListaComputingSkillLavel)):
							$computoSQL['OR'][$indice]['AND'][] = array('CompanyJobComputingSkill.id' => $idsListaComputingSkillLavel);
						endif;
					endif;

					// Se vacian los arreglos usados para guardar nuevas condiciones
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
					$ListaIdsComputo = $this->CompanyJobComputingSkill->find('all',['conditions' => ['OR' => [$computoSQL]],'fields'=>array('CompanyJobComputingSkill.company_job_profile_id')]);
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
				$listaOfertasGeneral = $this->CompanyJobProfile->find('all',['conditions' => ['AND' => [$criterio]],
																	'fields'=>array('CompanyJobProfile.id'),
																	'recursive' => 1]);
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
			
			$hoy = date('Y-m-d');
			$this->paginate = array('conditions' => ['AND' => [
															'CompanyJobProfile.id' => $totalOfferId,
															// 'CompanyJobProfile.expiration >= ' => $hoy,
															// 'CompanyJobContractType.status'  => 1,
															// 'Company.status'  => 1,
															// $idsListaRelatedCareer
													]],
									'order' => $orden,
									'limit' => $limit,
									'recursive' => 2
									);
								
			$ofertas = $this->paginate('CompanyJobProfile');
			$this->set('ofertas', $ofertas);	
		}

		public function viewOffer($id=null){
			$this->banner();
			$total = $this->StudentViewedOffer->find('count', array(
																	'conditions' => array(
																						'AND' => array(
																									'StudentViewedOffer.student_id' =>  $this->Session->read('student_id'),
																									'StudentViewedOffer.company_job_profile_id' => $id
																									),
																						),
																	)
													);
			if($total == 0):
				$this->request->data['StudentViewedOffer']['student_id'] = $this->Session->read('student_id');
				$this->request->data['StudentViewedOffer']['company_job_profile_id'] = $id;
				if(!$this->StudentViewedOffer->save($this->request->data)):
					$this->Session->setFlash('La oferta no pudo marcarse como vista', 'alert-danger');
				endif;
			endif;
			
			$this->Session->write('affterDeleteFolder', 'viewOffer/'.$id);
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			
			$this->Session->write('redirect', 'viewOffer/'.$id);
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
			
			//$this->Tecnology(); //Categories
			$Tecnologias = $this->Tecnology->find('list', array('order' => array('Tecnology.id ASC')));
			$this->set( compact ('Tecnologias') );
			$this->program();	
			$this->softwareLevel();
		}
		
		public function studentSavedSearch(){
			if($this->request->is('post')):
				$serialize_form = serialize($this->Session->read('serialized_form'));
				$this->request->data['StudentSavedSearch']['student_id'] = $this->Session->read('student_id');
				$this->request->data['StudentSavedSearch']['serialize_request'] = $serialize_form;
				$busquedasGuardadas = $this->StudentSavedSearch->find('all', ['conditions' => array('StudentSavedSearch.student_id' => $this->Session->read('student_id')),'order' => 'StudentSavedSearch.id ASC']);
				if(count($busquedasGuardadas) >= 10):
					if($this->StudentSavedSearch->delete($busquedasGuardadas[0]['StudentSavedSearch']['id'])):
						if($this->StudentSavedSearch->save($this->request->data)):
							$this->Session->setFlash('Búsqueda guardada', 'alert-success');
							$this->redirect(array('action' => 'specificSearchResults'));
						else:
							$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
							$this->redirect(array('action' => 'specificSearchResults'));
						endif;
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser sustituida', 'alert-success');
					endif;
				else:
					if($this->StudentSavedSearch->save($this->request->data)):
						$this->Session->setFlash('Búsqueda guardada', 'alert-success');
						$this->redirect(array('action' => 'specificSearchResults'));
					else:
						$this->Session->setFlash('Lo sentimos la búsqueda no pudo ser guardada', 'alert-danger');
						$this->redirect(array('action' => 'specificSearchResults'));
					endif;
				endif;
			endif;
		}	
		
		public function studentFolder(){
			if($this->request->is('post')):
				if($this->Session->read('redirect') <> ''):
					$redirect = $this->Session->read('redirect').$this->Session->read('page');
				else:
					$redirect = 'profile'.$this->Session->read('page') ;
				endif;
					
					
				$this->request->data['StudentFolder']['student_id'] = $this->Session->read('student_id');
				if($this->StudentFolder->save($this->request->data)):
					$this->Session->setFlash('Carpeta creada', 'alert-success');
					$this->redirect(array('action' =>  $redirect));
				else:
					$this->Session->setFlash('Lo sentimos no se pudo crear la carpeta', 'alert-danger');
					$this->redirect(array('action' =>  $redirect));
				endif;
			endif;
		}
		
		public function deleteStudentFolder(){
				if($this->request->is('post')):
					if($this->StudentFolder->delete($this->request->data['StudentFolder']['id'])):
						$this->Session->setFlash('Carpeta eliminada', 'alert-success');
						if($this->Session->read('affterDeleteFolder') <> ''):
							$this->redirect(array('action' =>$this->Session->read('affterDeleteFolder')));
						else:
							$this->redirect(array('action' =>$this->Session->read('affterDeleteFolder')));
						endif;
					else:
						$this->Session->setFlash('No se pudo eliminar la carpeta'.$this->request->data['StudentFolder']['vista'], 'alert-danger');
						if($this->Session->read('affterDeleteFolder') <> ''):
							$this->redirect(array('action' =>$this->Session->read('affterDeleteFolder')));
						else:
							$this->redirect(array('action' =>$this->Session->read('affterDeleteFolder')));
						endif;
					endif;
				endif;
		}
		
		public function editStudentFolder($id = null){
			$this->StudentFolder->id = $id;
			if($this->request->is('post')):	
				if($this->StudentFolder->save($this->request->data)):
					$this->Session->setFlash('Carpeta renombrada a '.$this->request->data['StudentFolder']['name'], 'alert-success');
					$this->redirect(array('action' => $this->request->data['StudentFolder']['vista']));
				else:
					$this->Session->setFlash('Lo sentimos la carpeta no pudo ser renombrada', 'alert-danger');
					$this->redirect(array('action' => $this->request->data['StudentFolder']['vista']));
				endif;
			endif;
		}
		
		public function studentSavedOffer(){
			if($this->request->is('post')):
				if($this->Session->read('affterPostulated') <> ''):
					$affterPostulated = $this->Session->read('affterPostulated').$this->Session->read('page');
				else:
					$affterPostulated = 'profile'.$this->Session->read('page') ;
				endif;
				$this->request->data['StudentSavedOffer']['student_id'] =  $this->Session->read('student_id');

				if($this->StudentSavedOffer->save($this->request->data)):
					$this->Session->setFlash('Oferta guardada.', 'alert-success');
					$this->redirect(array('action' => $affterPostulated));
				else:
					$this->Session->setFlash('Lo sentimos no se pudo cargar la oferta sin antes seleccionar una carpeta', 'alert-danger');
					$this->redirect(array('action' =>  $affterPostulated));
				endif;
			endif;
		}
		
		public function offerAdmin($newSearch = null, $newFolderSelected = null){
			$this->CompanyJobProfile->recursive = 2;
			$this->CompanyProfile->recursive = 0;
			$this->CompanyJobOffer->recursive = 0;
			$this->Session->write('redirect', 'offerAdmin');
			$limite = 5; //default limit
			
			//Verifica parametros que llegan ya sea por get o post para agregarlas a nuestras variables
			$this->Session->write('affterPostulated', 'offerAdmin');
			$this->Session->write('affterDeleteFolder', 'offerAdmin');
			
			if(($newSearch == 'nuevaBusqueda') || ($this->request->query('newFolderSelected') == 'yes')):
				$this->Session->delete('limit');
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('intoFolder');
				$this->Session->delete('page');
				$this->Session->delete('tipoBusqueda');
			endif;

			if(isset($this->params['named']['page'])):
				$page = $this->params['named']['page'];
				$this->Session->write('page', '/page:'.$page);
			else:
				$this->Session->write('page','');
				$page = '';
			endif;
			
			if($this->request->query('tipoBusqueda') <> ''):
				$tipoBusqueda = $this->request->query('tipoBusqueda');
				$this->Session->write('tipoBusqueda', $this->request->query('tipoBusqueda'));
			else:
				if(isset($this->request->data['Student']['criterio']) and ($this->request->data['Student']['criterio'] <> '')):
					$this->Session->write('tipoBusqueda', $this->request->data['Student']['criterio']);
					$tipoBusqueda = $this->request->data['Student']['criterio'];
				else:
					if(($this->Session->read('tipoBusqueda')) <> ''):
						$tipoBusqueda = $this->Session->read('tipoBusqueda');
					else:
						$tipoBusqueda = 4; //Búsqueda default eqivalente a mostrar todos las ofertas guardadas, postulados o ambos
					endif;
				endif;
			endif;

			if(isset($this->request->data['Student']['Buscar']) and ($this->request->data['Student']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Student']['Buscar']);
				$palabraBuscada  = $this->request->data['Student']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada  = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada = '';
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
			
			//parametro inicial del query
			$forGuardadas['conditions'][] = array('StudentSavedOffer.student_id' => $this->Session->read('student_id'));
			
			if($intoFolder<>''):
				$folderExist = $this->StudentFolder->find('count', ['conditions' => ['StudentFolder.id' => $intoFolder,	'StudentFolder.student_id' => $this->Session->read('student_id')]]);
				if($folderExist>0):
					$this->set('intoFolder', $intoFolder);
					//Si llega el id del folder se agrega  a los parametros de la búsqueda
					if($intoFolder<>''):
						$forGuardadas['conditions'][] = array('StudentSavedOffer.student_folder_id' => $intoFolder);
					endif;
				else:
					// Elimina la sessión del folder seleccionado
					$this->Session->delete('intoFolder');
					$this->set('intoFolder', '');
				endif;
			else:
				// $conditionsConcatenated['conditions']['OR'][] = array('Student.id <> ' => '' ); 
				$this->set('intoFolder', '');
			endif;
		
			//Si llega el id del folder se agrega  a los parametros de la búsqueda
			// if($intoFolder<>''):
			// 	$forGuardadas['conditions'][] = array('StudentSavedOffer.student_folder_id' => $intoFolder);
			// endif;
				
			//Get all saved offers
			$ofertasGuardadas = $this->StudentSavedOffer->find('all', ['conditions' => [$forGuardadas['conditions']]]);
			//Get all viwed offers
			$ofertasVistas = $this->StudentViewedOffer->find('all', ['conditions' => ['StudentViewedOffer.student_id' => $this->Session->read('student_id')]]);
			//Get all applied offers
			$ofertasAplicadas = $this->Application->find('all', ['conditions' => ['Application.student_id' => $this->Session->read('student_id')]]);
			//Get all offers ids in array for each one with a condition OR
			$guardadas['conditions']['OR'] = array("CompanyJobProfile.id" => Set::extract("/StudentSavedOffer/company_job_profile_id", $ofertasGuardadas));
			$vistas['conditions']['OR'] = array("CompanyJobProfile.id" => Set::extract("/StudentViewedOffer/company_job_profile_id", $ofertasVistas));
			$aplicadas['conditions']['OR'] = array("CompanyJobProfile.id" => Set::extract("/Application/company_job_profile_id", $ofertasAplicadas));
			//Obtiene todas las ofertas que sean vistas o guardadas 
			$todos = array_merge($guardadas['conditions']['OR']['CompanyJobProfile.id'], $vistas['conditions']['OR']['CompanyJobProfile.id']);
			//Elimina ofertas repetidas
			$unicos = array_unique($todos);
			//Obtiene sólo ofertas vistas y que esten guardadas
			$ofertasVistasGuardadas = array_intersect($guardadas['conditions']['OR']['CompanyJobProfile.id'], $vistas['conditions']['OR']['CompanyJobProfile.id'] );
			//Obtiene todas las ofertas que hayan sido aplicados o guardadas 
			$todos2 = array_merge($guardadas['conditions']['OR']['CompanyJobProfile.id'], $aplicadas['conditions']['OR']['CompanyJobProfile.id']);
			//Elimina ofertas repetidas
			$unicos2 = array_unique($todos2);
			//Obtiene sólo ofertas aplicadas y que esten guardadas
			$ofertasAplicadasGuardadas = array_intersect($guardadas['conditions']['OR']['CompanyJobProfile.id'], $aplicadas['conditions']['OR']['CompanyJobProfile.id'] );	
			

			//Genera las condiciones de búsqueda, ESTO ES PARA UN FOLDER SELECCIONADO LLEGANDO LOS PARAMETROS CON GET
			if($tipoBusqueda == 10):
				if(!empty($ofertasVistasGuardadas)):
					foreach($ofertasVistasGuardadas as $k => $ofertaVistaGuardada):
						$conditionsConcatenated['conditions']['OR'][] = ['CompanyJobProfile.id' => [$ofertaVistaGuardada]];
					endforeach;
				endif;
			else:
				if($tipoBusqueda == 20):
					foreach($guardadas['conditions']['OR']['CompanyJobProfile.id'] as $soloGuardada){
						if(!in_array($soloGuardada, $vistas['conditions']['OR']['CompanyJobProfile.id'])){
							$conditionsConcatenated['conditions']['OR'][] =  ['CompanyJobProfile.id' => [$soloGuardada]];  
						}
					}
				else:
					if($tipoBusqueda == 30):
						if(!empty($ofertasAplicadasGuardadas)):
							foreach($ofertasAplicadasGuardadas as $k => $ofertaAplicadaGuardada):
								$conditionsConcatenated['conditions']['OR'][] = ['CompanyJobProfile.id' => [$ofertaAplicadaGuardada]];
							endforeach;
						endif;
					endif;
				endif;
			endif;

			if($tipoBusqueda == 1):
				//Obtiene las coincidencias de nombres del perfil de la compañía con la búsqueda
				$companyProfilesLikeName = $this->Company->find('list', ['conditions' => ['CompanyProfile.company_name LIKE' => '%'. $palabraBuscada . '%'],'recursive' => 2]);
				// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
				foreach($companyProfilesLikeName as $companyProfileLikeName):
					$idsCompaniesLikeName[] = $companyProfileLikeName;
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($idsCompaniesLikeName)):
					$idsCompaniesLikeName = '';
				endif;
				
				// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
				$companyJobOffersLikeName = $this->CompanyJobOffer->find('list', ['fields' => ['CompanyJobOffer.id'],
																				'conditions' => ['AND' => ['CompanyJobOffer.company_id' => $idsCompaniesLikeName,
																											'CompanyJobOffer.confidential_job_offer' => 'n',
																											'CompanyJobOffer.company_name' => '']],
																				'recursive' => 2]);

				// Obtenemos en un array los id´s que de las jobOffer anteriores
				foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
					$idsCompaniesJobOffersLikeName[] = $companyJobOfferLikeName;
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($idsCompaniesJobOffersLikeName)):
					$idsCompaniesJobOffersLikeName = '';
				endif;
				
				// Obtenemos los id´s de las ofertas que cumplan con los id´s de los JobOffer de la consulta anterior
				$companyJobProfileResults = $this->CompanyJobProfile->find('list', ['fields' => ['CompanyJobProfile.id'],
																					'conditions' => ['AND' => ['CompanyJobProfile.company_job_offer_id' => $idsCompaniesJobOffersLikeName]],
																					'recursive' => 2]);
				
				// Obtenemos en un array los id´s que de las JobProfiles anteriores
				foreach($companyJobProfileResults as $companyJobProfileResult):
					$idsompanyJobProfileResults[] = $companyJobProfileResult;
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($idsompanyJobProfileResults)):
					$idsompanyJobProfileResults = '';
				endif;
				
				// Obtenemos los id´s de las vacantes que haya sido declarada como confidencial y que se le haya asignado un nombre para mostrar.
				$companyJobOffersLikeName = $this->CompanyJobOffer->find('all', ['fields' => ['CompanyJobOffer.id'],
																		'conditions' => ['AND' => ['CompanyJobOffer.company_name LIKE' => '%'. $palabraBuscada . '%',
																									'CompanyJobOffer.confidential_job_offer' => 's',
																									'CompanyJobOffer.company_name <> ' => '']]]);
												
				foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
					$jobOffersLikeName[] = $companyJobOfferLikeName['CompanyJobOffer']['id'];
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($companyJobOffersLikeName)):	
						$jobOffersLikeName = '';
				endif;

				$criterio[] = ['AND' =>['OR' => ['CompanyJobProfile.id' => $idsompanyJobProfileResults,'CompanyJobProfile.company_job_offer_id'=>$jobOffersLikeName]]];
			else:
				if($tipoBusqueda == 2):
					$criterio[] = ['CompanyJobProfile.job_name LIKE' => '%'. $palabraBuscada . '%'];
				else:
					if($tipoBusqueda == 3):
						$criterio[] = [' CompanyJobProfile.id ' => intval($palabraBuscada)];
					else:
						$criterio[] = '';
					endif;
				endif;
			endif;
			
			$hoy = date('Y-m-d');
			$orden = ' CompanyJobContractType.created DESC';
			
			if(($tipoBusqueda == 10) and ($this->request->is('get'))):
				if(!empty($ofertasVistasGuardadas)):
							$this->paginate = ['conditions' => ['AND' => [
																$conditionsConcatenated['conditions'],
																// 'CompanyJobProfile.expiration >= ' => $hoy,
																// 'CompanyJobContractType.status'  => 1,
																// 'Company.status'  => 1
																]],
												'limit' => $limite,
												'order' => $orden];
							$ofertas = $this->paginate('CompanyJobProfile');
							$this->set('ofertas', $ofertas);
				else:
					$this->set('ofertas', '');
				endif;
			else:
				if(($tipoBusqueda == 20) and ($this->request->is('get'))):
					if(!empty($conditionsConcatenated['conditions']['OR'])):
							$this->paginate = ['conditions' => ['AND' => [
																$conditionsConcatenated['conditions'],
																// 'CompanyJobProfile.expiration >= ' => $hoy,
																// 'CompanyJobContractType.status'  => 1,
																// 'Company.status'  => 1
																]],
												'limit' => $limite,
												'order' => $orden,
									];
							$ofertas = $this->paginate('CompanyJobProfile');
							$this->set('ofertas', $ofertas);
					else:
						$this->set('ofertas', '');
					endif;
				else:
					if(($tipoBusqueda == 30) and ($this->request->is('get'))):
						if(!empty($ofertasAplicadasGuardadas)):
								$this->paginate = ['conditions' => ['AND' => [
															$conditionsConcatenated['conditions'],
															// 'CompanyJobProfile.expiration >= ' => $hoy,
															// 'CompanyJobContractType.status'  => 1,
															// 'Company.status'  => 1
															]],
													'limit' => $limite,
													'order' => $orden];
								$ofertas = $this->paginate('CompanyJobProfile');
								$this->set('ofertas', $ofertas);
						else:
							$this->set('ofertas', '');
						endif;
					else:
							$this->paginate = ['conditions' => ['AND' => [
																		$guardadas['conditions']['OR'],
																		$criterio,
																		// 'CompanyJobProfile.expiration >= ' => $hoy,
																		// 'CompanyJobContractType.status'  => 1,
																		// 'Company.status'  => 1
																		]],
													'limit' => $limite,
													'order' => $orden];
							$ofertas = $this->paginate('CompanyJobProfile');
							$this->set('ofertas', $ofertas);
					endif;
				endif;
			endif;
		}
		
		public function report($id = null){

			$this->CompanyJobProfile->recursive = 2;
			$this->CompanyProfile->recursive = 0;
			$this->CompanyJobOffer->recursive = 0;

			$hoy = date('Y-m-d');
			if($id == 'nuevaBusqueda'):
				$this->Session->delete('palabraBuscada');
				$this->Session->delete('tipoBusqueda');
			endif;
			
			if(isset($this->request->data['Student']['criterio']) and ($this->request->data['Student']['criterio'] <> '')):
				$this->Session->write('tipoBusqueda', $this->request->data['Student']['criterio']);
				$tipoBusqueda = $this->request->data['Student']['criterio'];
			else:
				if(($this->Session->read('tipoBusqueda')) <> ''):
					$tipoBusqueda = $this->Session->read('tipoBusqueda');
				else:
					$tipoBusqueda = 4; //Búsqueda default eqivalente a mostrar todos las ofertas guardadas, postulados o ambos
				endif;
			endif;
			
			if(isset($this->request->data['Student']['Buscar']) and ($this->request->data['Student']['Buscar'] <> '')):
				$this->Session->write('palabraBuscada', $this->request->data['Student']['Buscar']);
				$palabraBuscada = $this->request->data['Student']['Buscar'];
			else:
				if(($this->Session->read('palabraBuscada')) <> ''):
					$palabraBuscada = $this->Session->read('palabraBuscada');
				else:
					$palabraBuscada= '';
				endif;
			endif;
			
			//Get all saved offers
			$ofertasGuardadas = $this->StudentSavedOffer->find('all', ['conditions' => ['StudentSavedOffer.student_id' => $this->Session->read('student_id')]]);
			//Get all applied offers
			$ofertasAplicadas = $this->Application->find('all',['conditions' => ['Application.student_id' => $this->Session->read('student_id')]]);
			//Get all offers ids in array for each one with a condition OR
			$guardadas['conditions']['OR'] = array("CompanyJobProfile.id" => Set::extract("/StudentSavedOffer/company_job_profile_id", $ofertasGuardadas));
			$aplicadas['conditions']['OR'] = array("CompanyJobProfile.id" => Set::extract("/Application/company_job_profile_id", $ofertasAplicadas));
			//Obtiene todas las ofertas que hayan sido aplicados o guardadas 
			$todosAplicadasOGuardadas = array_merge($guardadas['conditions']['OR']['CompanyJobProfile.id'], $aplicadas['conditions']['OR']['CompanyJobProfile.id']);
			//Elimina ofertas repetidas
			$ofertasAplicadasOGuardadas = array_unique($todosAplicadasOGuardadas);
			//Obtiene sólo ofertas aplicadas y que esten guardadas
			$ofertasAplicadasGuardadas = array_intersect($guardadas['conditions']['OR']['CompanyJobProfile.id'], $aplicadas['conditions']['OR']['CompanyJobProfile.id'] );	
			
			if($tipoBusqueda == 1):
				//Obtiene las coincidencias de nombres del perfil de la compañía con la búsqueda
				$companyProfilesLikeName = $this->Company->find('list', ['conditions' => ['CompanyProfile.company_name LIKE' => '%'. $palabraBuscada . '%'],'recursive' => 2]);
				// Obtenemos en un array los id´s que de las compañias que contengan un nombre relacional a la consulta
				foreach($companyProfilesLikeName as $companyProfileLikeName):
					$idsCompaniesLikeName[] = $companyProfileLikeName;
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($idsCompaniesLikeName)):
					$idsCompaniesLikeName = '';
				endif;
				
				// Obtenemos los id de JobOffer que cumplan con las condiciones de búsqueda y que esten dentro de del arreglo de id´s de arriba, estos pasan en automático a la vista ya que no son confidenciales las ofertas
				$companyJobOffersLikeName = $this->CompanyJobOffer->find('list', [  'fields' => ['CompanyJobOffer.id'],
																				    'conditions' => ['AND' => [
																											'CompanyJobOffer.company_id' => $idsCompaniesLikeName,
																											'CompanyJobOffer.confidential_job_offer' => 'n',
																											'CompanyJobOffer.company_name' => '']],
																					'recursive' => 2]);

				// Obtenemos en un array los id´s que de las jobOffer anteriores
				foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
					$idsCompaniesJobOffersLikeName[] = $companyJobOfferLikeName;
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($idsCompaniesJobOffersLikeName)):
					$idsCompaniesJobOffersLikeName = '';
				endif;
				
				// Obtenemos los id´s de las ofertas que cumplan con los id´s de los JobOffer de la consulta anterior
				$companyJobProfileResults = $this->CompanyJobProfile->find('list', ['fields' => ['CompanyJobProfile.id'],
																					'conditions' => ['AND' => ['CompanyJobProfile.company_job_offer_id' => $idsCompaniesJobOffersLikeName,
																												'Company.status'  => 1]],
																					'recursive' => 2]);
				
				// Obtenemos en un array los id´s que de las JobProfiles anteriores
				foreach($companyJobProfileResults as $companyJobProfileResult):
					$idsompanyJobProfileResults[] = $companyJobProfileResult;
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($idsompanyJobProfileResults)):
					$idsompanyJobProfileResults = '';
				endif;
				
				// Obtenemos los id´s de las vacantes que haya sido declarada como confidencial y que se le haya asignado un nombre para mostrar.
				$companyJobOffersLikeName = $this->CompanyJobOffer->find('all', ['fields' => ['CompanyJobOffer.id'],
																				'conditions' => ['AND' => ['CompanyJobOffer.company_name LIKE' => '%'. $palabraBuscada . '%',
																											'CompanyJobOffer.confidential_job_offer' => 's',
																											'CompanyJobOffer.company_name <> ' => '']]]);
												
				foreach($companyJobOffersLikeName as $companyJobOfferLikeName):
					$jobOffersLikeName[] = $companyJobOfferLikeName['CompanyJobOffer']['id'];
				endforeach;	
				
				// Verifica que la variable contenga al menos 1 valor si no lo deja en vacío
				if(empty($companyJobOffersLikeName)):	
						$jobOffersLikeName = '';
				endif;
			endif;	
			
			if(!empty($ofertasAplicadasOGuardadas)):
				foreach($ofertasAplicadasOGuardadas as $k => $ofertaAplicadaOGuardada):
					$conditionsConcatenated['conditions']['OR'][] = ['CompanyJobProfile.id' => [$ofertaAplicadaOGuardada]];
				endforeach;
			endif;
			
			if($tipoBusqueda == 1):
				$criterio[] = array( 'AND' => ['OR' => ['CompanyJobProfile.id' => $idsompanyJobProfileResults,'CompanyJobProfile.company_job_offer_id'=>$jobOffersLikeName]]);
			else:
				if($tipoBusqueda == 2):
					$criterio[] = array('CompanyJobProfile.job_name LIKE' => '%'. $palabraBuscada . '%');
				else:
					if($tipoBusqueda == 3):
						$criterio[] = array(' CompanyJobProfile.id '  => intval($palabraBuscada));
					else:
						$criterio[] = '';
					endif;
				endif;
			endif;
			
			if($tipoBusqueda <> 4):
				if(!empty($ofertasAplicadasOGuardadas)):
						$this->paginate = ['conditions' => ['AND' => [$conditionsConcatenated['conditions'], //<--Usa condicion OR
															$criterio,
															'Company.status'  => 1]],
										   'order' => ' CompanyJobContractType.created DESC'];
				endif;
			else:
				if($tipoBusqueda == 4):
					if(!empty($ofertasAplicadasOGuardadas)):
						$this->paginate = [ 'conditions' => ['OR' => [$conditionsConcatenated['conditions']],
																'AND' => [
																			// 'CompanyJobProfile.expiration >= ' => $hoy,
																			// 'CompanyJobContractType.status'  => 1,
																			// 'Company.status'  => 1
																		]],
											'order' => ' CompanyJobContractType.created DESC'];
					endif;
				endif;
			endif;

			//Imprime las ofertas relacionadas a la búsqueda
			if(!empty($ofertasAplicadasOGuardadas)):
				$ofertas = $this->paginate('CompanyJobProfile');
				$this->set('ofertas', $ofertas);
			else:
				$this->set('ofertas', '');
			endif;
				
			if($this->request->is('post')):
				if(isset($this->request->data['Report']['fecha_contratacion'])):
					$buscaIdCompany = $this->CompanyJobProfile->find('list',[ 	'fields' => ['CompanyJobProfile.id','CompanyJobProfile.company_id'],
																				'conditions' => ['CompanyJobProfile.id' => $this->request->data['Report']['company_job_profile_id']],
																				'limit'=>1]);
					if($buscaIdCompany[$this->request->data['Report']['company_job_profile_id']] <> ''):	
						$reportes = $this->Report->find('count', ['conditions' => ['Report.company_job_profile_id' => $this->request->data['Report']['company_job_profile_id'],
																					'student_id' => $this->Session->read('student_id'),
																					'registered_by' => 'student']]);
						if($reportes==0):
							$this->request->data['Report']['student_id'] =  $this->Session->read('student_id');
							$this->request->data['Report']['company_id'] =  $buscaIdCompany[$this->request->data['Report']['company_job_profile_id']];
							$this->request->data['Report']['registered_by'] = 'student';
							
							$notificacion['StudentNotification']['student_id'] = $this->request->data['Report']['student_id'];
							$notificacion['StudentNotification']['company_id'] = $this->request->data['Report']['company_id'];
							$notificacion['StudentNotification']['company_job_profile_id'] = $this->request->data['Report']['company_job_profile_id'];
							$notificacion['StudentNotification']['company_interview_date'] = $this->request->data['Report']['fecha_contratacion'];
							$notificacion['StudentNotification']['student_interview_date'] = $this->request->data['Report']['fecha_contratacion'];
							$notificacion['StudentNotification']['interview_type'] = 3;
							$notificacion['StudentNotification']['student_interview_status'] = 1;
							$notificacion['StudentNotification']['company_interview_status'] = 0;
							$caracteres = strlen($this->request->data['Report']['company_job_profile_id']);
								$faltantes = 5 - $caracteres;	
								if($faltantes > 0):
									$ceros = '';
									for($cont=0; $cont<=$faltantes;$cont++):
										$ceros .= '0';
									endfor;
									$folio = $ceros.$this->request->data['Report']['company_job_profile_id'];
								else:
									$folio = strlen($this->request->data['Report']['company_job_profile_id']);
								endif;
							$notificacion['StudentNotification']['student_interview_message'] = 'El universitario le ha indicado que fue contratado para la oferta con folio: '.$folio;
							$this->StudentNotification->create();		
							
							if($this->Report->save($this->request->data)):
								if($this->StudentNotification->save($notificacion)):
									$this->Session->setFlash('Contratación reportada con éxito', 'alert-success');
								else:
									$this->Session->setFlash('La notificación para el universitario no pudo ser cargada', 'alert-success');
								endif;
								$this->redirect(array('action' => 'report',$this->request->data['Report']['company_job_profile_id']));
							else:
								$this->Session->setFlash('Lo sentimos el reporte de contratación no pudo ser enviado', 'alert-danger');
								$this->redirect(array('action' => 'report',$this->request->data['Report']['company_job_profile_id']));
							endif;
						else:
							$this->Session->setFlash('El reporte de la oferta ya ha sido enviado anteriormente', 'alert-danger');
						endif;
					else:
						$this->Session->setFlash('Lo sentimos, no se encontro la empresa que postuló la oferta', 'alert-danger');
						$this->redirect(array('action' =>  $affterPostulated));
					endif;
				endif;	
			endif;
		}
		
		public function studentExternalOffer(){
			$this->Student->recursive = 1;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			$this->Rotation();
			$this->states();
			
			if($this->request->is('post')):		
				if($this->StudentExternalOffer->saveAll($this->request->data, array('validate' => 'only'))):
					$this->request->data['StudentExternalOffer']['student_id'] = $this->Session->read('student_id');
					if($this->Student->StudentExternalOffer->save($this->request->data)):
						$this->Session->setFlash('Registro guardado', 'alert-success');
						$this->redirect(array('action' => 'studentExternalOffer'));
					else:
						$this->Session->setFlash('Lo sentimos, no se pudo actualizar su registro', 'alert-danger');
					endif;
				else:
					$this->Session->setFlash('Corrija los elementos señalados para continuar', 'alert-danger');
				endif;
			endif;
		}
		
		public function studentNotification($id=null, $respuestaNotificacion=null){
			// $this->Student->recursive = -2;
			$this->CompanyJobProfile->recursive = 2;
			$this->StudentNotification->recursive = 3;
			$student = $this->Student->findById($this->Session->read('student_id'));
			$this->set('student', $student);
			
			$this->Session->write('affterPostulated', 'studentNotification');
			$this->Session->write('affterDeleteFolder', 'studentNotification');
			$this->academicSituation();
			$this->Session->write('redirect', 'studentNotification');
			$this->lenguage();

			// Almecena en session la entrevista o contratación
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
							else:
								$this->Session->delete('tipoNotificacion');
							endif;
						endif;
					endif;
				endif;	
			endif;
			
			// Responde la entrevista o contratación
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
															'Report.registered_by' => 'company',
															
															)
													)
							):
							$reporteActualizado = 1;
						endif;
				endif;

				if(($tipoNotificacion==3) OR (($tipoNotificacion==4) AND ($notification['StudentNotification']['step_process']==1))):
						
					$reporteEnviado = $this->Report->find('all', array(
															'conditions' => array (
																					'Report.company_job_profile_id' => $notification['StudentNotification']['company_job_profile_id'],
																					'Report.student_id' => $notification['StudentNotification']['student_id'],
																					'Report.company_id' => $notification['StudentNotification']['company_id'],
																					'Report.registered_by' => 'student'
																				)
																			)
													);
							
					$reporteCompany = $this->Report->find('all', array(
															'conditions' => array (
																					'Report.company_job_profile_id' => $notification['StudentNotification']['company_job_profile_id'],
																					'Report.student_id' => $notification['StudentNotification']['student_id'],
																					'Report.company_id' => $notification['StudentNotification']['company_id'],
																					'Report.registered_by' => 'company'
																									)
																			)
													);								
					if(count($reporteEnviado)==0):
						if(count($reporteCompany)<>0): //Si encuentra el reporte inicial generado por la empresa pasa los datos al universitario
							$report['Report']['student_id'] = $reporteCompany[0]['Report']['student_id'];
							$report['Report']['company_id'] = $reporteCompany[0]['Report']['company_id'];
							$report['Report']['company_job_profile_id'] = $reporteCompany[0]['Report']['company_job_profile_id'];
							$report['Report']['fecha_contratacion'] = $reporteCompany[0]['Report']['fecha_contratacion'];
							$report['Report']['created'] = $reporteCompany[0]['Report']['created'];
							$report['Report']['modified'] = $reporteCompany[0]['Report']['modified'];
							$report['Report']['registered_by'] = 'student'; //Ahora se regsitra que el universitario ha reportado la contratación
							if(($respuestaNotificacion==4) OR ($respuestaNotificacion==3)):
								$report['Report']['response_notification'] = 1;
							else:
								$report['Report']['response_notification'] = 0;
							endif;
							$report['Report']['response_notification'] = $respuestaNotificacion;
							$this->Report->create();
							$this->Report->save($report);
						else:
							if($respuestaNotificacion==4):
								$hoy = date('Y-m-d');
								$report['Report']['student_id'] = $notification['StudentNotification']['student_id'];
								$report['Report']['company_id'] = $notification['StudentNotification']['company_id'];
								$report['Report']['company_job_profile_id'] = $notification['StudentNotification']['company_job_profile_id'];
								$report['Report']['fecha_contratacion'] = $hoy;
								$report['Report']['registered_by'] = 'student'; //Ahora se regsitra que la compañia ha reportado la contratación
								$report['Report']['response_notification'] = 1;
								$this->Report->create();
								$this->Report->save($report);							
							endif;
						
						endif;
					else:
						if($respuestaNotificacion==3):
							$this->Report->updateAll(array('Report.response_notification' => 0),array('Report.id' => $reporteCompany[0]['Report']['id']));
						else:
							$this->Report->updateAll(array('Report.response_notification' => 1),array('Report.id' => $reporteCompany[0]['Report']['id']));
						endif;
					endif;
				endif;
				
				if($respuestaNotificacion==1):
					if ($this->StudentNotification->updateAll(array('StudentNotification.student_interview_status' => 1,'StudentNotification.company_interview_status' => 1),array('StudentNotification.id' => $id))):
						if($tipoNotificacion==1): //Telefonica
							$this->Session->setFlash('Entrevista telefónica aceptada', 'alert-success');
							$respuestaNotificacionMail = 'Aceptado la fecha y horario de entrevista telefónica';
						else:
							if($tipoNotificacion==2): //Presencial
								$this->Session->setFlash('Entrevista presencial aceptada', 'alert-success');
								$respuestaNotificacionMail = 'Aceptado la fecha y horario de entrevista presencial';
							else:
								$this->Session->setFlash('Contratación aceptada', 'alert-success'); //Contratación
								$respuestaNotificacionMail = 'Aceptado la contratación';
							endif;
						endif;
					else:
						$this->Session->setFlash('Error al responder la solicitud', 'alert-danger');
					endif;
				else:
					if($respuestaNotificacion==3):
						if ($this->StudentNotification->updateAll(array('StudentNotification.student_interview_status' => 3),array('StudentNotification.id' => $id))):
							if($tipoNotificacion==1):
								$this->Session->setFlash('Entrevista telefónica declinada', 'alert-success');
								$respuestaNotificacionMail = 'Rechazado la fecha y horario de entrevista telefónica';
							else:
								if($tipoNotificacion==2):
									$this->Session->setFlash('Entrevista presencial declinada', 'alert-success');
									$respuestaNotificacionMail = 'Rechazado la fecha y horario de entrevista presencial';
								else:
									if($reporteActualizado == 1):
										$respuestaNotificacionMail = 'Rechazado la contratación';
										$this->Session->setFlash('Contratación declinada', 'alert-success');
									else:
										$this->Session->setFlash('Notificación declinada. El reporte de contratación no se ha podido actualizar.', 'alert-danger');
										$respuestaNotificacionMail = 'Rechazado la contratación';
									endif;
								endif;
							endif;
						else:
							$this->Session->setFlash('Error al responder la solicitud', 'alert-danger');
						endif;
					else:
						$hoy = date('Y-m-d');
						$fechaMax = strtotime ( '-1 day' , strtotime ( $hoy ) ) ;
						$hoy = date ( 'Y-m-j' , $fechaMax );	
						if(($respuestaNotificacion==4) OR ($respuestaNotificacion==5) OR ($respuestaNotificacion==6) OR ($respuestaNotificacion==7)):
							if($respuestaNotificacion==4): //Me contrataron
								$this->StudentNotification->updateAll(array('StudentNotification.type_respons' => $respuestaNotificacion, 'StudentNotification.interview_type' => 4, 'StudentNotification.step_process' => 3),array('StudentNotification.id' => $id));
								$this->Session->setFlash('Respuesta de me contrataron enviada', 'alert-success');
							else:
								if($respuestaNotificacion==5)://Agendé entrevista presencial
									$this->StudentNotification->updateAll(array('StudentNotification.type_respons' => $respuestaNotificacion, 'StudentNotification.interview_type' => 4, 'StudentNotification.step_process' => 2,'StudentNotification.company_interview_date' => "'".$hoy."'" ,'StudentNotification.student_interview_date' => "'".$hoy."'"  ),array('StudentNotification.id' => $id));
									$this->Session->setFlash('Respuesta de agendé entrevista presencial enviada', 'alert-success');
								else:
									if($respuestaNotificacion==6)://Sigo en el proceso
										$this->StudentNotification->updateAll(array('StudentNotification.type_respons' => $respuestaNotificacion, 'StudentNotification.interview_type' => 4),array('StudentNotification.id' => $id));
										$this->Session->setFlash('Respuesta de sigo en el proceso enviada', 'alert-success');
									else: //Sali del proceso
										if($respuestaNotificacion==7):
											$this->StudentNotification->updateAll(array('StudentNotification.type_respons' => $respuestaNotificacion),array('StudentNotification.id' => $id));
											$this->Session->setFlash('Respuesta de salí del proceso enviada', 'alert-success');
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			endif;
			
			// Ajenda la entrevista o contratación
			if($this->request->is('post')):
				if($this->Session->read('affterPostulated') <> ''):
					$affterPostulated = $this->Session->read('affterPostulated').$this->Session->read('page');
				else:
					$affterPostulated = 'profile'.$this->Session->read('page') ;
				endif;
				
				$this->request->data['StudentNotification']['student_interview_status'] = 2;
				$this->request->data['StudentNotification']['company_interview_status'] = 0;
				$this->request->data['StudentNotification']['company_interview_date'] = $this->request->data['StudentNotification']['student_interview_date'];
				
				if($this->StudentNotification->save($this->request->data)):
					$this->Session->setFlash('Nueva fecha de entrevista enviada', 'alert-success');
					$respuestaNotificacionMail = 'Propuesto una nueva fecha y/o horario de entrevista telefónica: <br>
											 Fecha: '.$this->request->data['StudentNotification']['company_interview_date']['day'].' / '.$this->request->data['StudentNotification']['company_interview_date']['month'].' / '.$this->request->data['StudentNotification']['company_interview_date']['year'].'<br>
											 Horario: '.$this->request->data['StudentNotification']['student_interview_date']['hour'].':'.$this->request->data['StudentNotification']['student_interview_date']['min'].' hrs <br>';
				else:
					$this->Session->setFlash('Lo sentimos, no se pudo guardar la nueva fecha para la entrevista telefónica', 'alert-danger');
				endif;
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
				$Email->from(array('sisbut@unam.mx' => 'Bolsa bti.'));
		
				$this->CompanyJobProfile->recursive = 2;
				if($this->request->is('post')):
					$oferta = $this->CompanyJobProfile->findById($this->request->data['StudentNotification']['company_job_profile_id']);
				else:
					$oferta = $this->CompanyJobProfile->findById($notification['StudentNotification']['company_job_profile_id']);
				endif;

				if($oferta['CompanyJobOffer']['same_contact']=='n'):
					$responsable =  $oferta['CompanyJobOffer']['responsible_name']. ' ' .$oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'];	
					$Email->to($oferta['CompanyJobOffer']['company_email']);		
				else:
					$responsable =  $oferta['Company']['CompanyContact']['name']. ' ' .$oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'];
					$Email->to($oferta['Company']['email']);		
				endif;

				$Email->subject($asunto);
				$Email->emailFormat('both');
				$Email->template('email')->viewVars( array(
															'aMsg' => 
															'<div style="background-color: #F4F4F4; padding: 25px;"><img src="https://ch3302files.storage.live.com/y4p0zc-aKdenRwNjteB3--a8ZKFbEHQ3HWnKQTN2l7nWGPAp-iM0Po85t1H9SEAVoUF52HRQ_2CyGXTWbqNQZ7VO1TlnvtdgVajgE30BwrozrsllLTb-gELTme85mkEwADPLEsZJO5x6gGmnogGweOHWKnuGYK5hYXtE7sn4u7Q7Zvs30yCnxY0tYYDuBAej6x2/header.jpg?psid=1&width=700&height=80" alt="header" width="100%">'.
															'<p style="color: #835B06; font-size: 24px; font-weight: bold;">Sistema de Bolsa Universitaria de Trabajo (SISBUT) UNAM </p>'.
		
															'<p>Estimado(a) reclutador(a) '.$responsable.' el candidato '.$student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' ha:</p></br>'.
															
															'<p><strong>'.$respuestaNotificacionMail.'</strong></p><br>'.
															
															'<p>Para aceptar, rechazar o proponer una nueva fecha y horario de entrevista por favor ingrese al portal del SISBUT con su número de cuenta y contraseña, a la sección de “Notificaciones”, dando click al link que aparece a continuación:</p></br>'.

															'<p><a href="http://bolsa.trabajo.unam.mx/unam">Iniciar Sesión</a></p>'.
		
															'<p>Si necesita ayuda, favor de comunicarse a:<br/>'.
															'Teléfonos:  56 22 04 20 / 56 22 04 21<br/>'.
															'Correo electrónico: bolsa@unam.mx</p></div>'
													));
				$Email->send();
			endif;

			$conditionsConcatenated[] = ['OR' => ['StudentNotification.student_interview_status <> ' => 1,'StudentNotification.company_interview_status <> ' => 1]];	

			$telefonicas = $this->StudentNotification->find('all', ['conditions' => ['AND' => ['StudentNotification.student_id' => $this->Session->read('student_id'),
																								'StudentNotification.interview_type'=> 1,
																								'StudentNotification.company_interview_date >= '=> date("Y-m-d"),
																								// $conditionsConcatenated
																								]]]);
			$this->set('telefonicas',$telefonicas);
			
			$presenciales = $this->StudentNotification->find('all', ['conditions' => ['AND' => ['StudentNotification.student_id' => $this->Session->read('student_id'),
																								'StudentNotification.interview_type'=> 2,
																								'StudentNotification.company_interview_date >= '=> date("Y-m-d"),
																								// $conditionsConcatenated
																								]]]);
			$this->set('presenciales',$presenciales);
			
			$contrataciones = $this->StudentNotification->find('all', ['conditions' => ['AND' => ['StudentNotification.student_id' => $this->Session->read('student_id'),
																								'StudentNotification.interview_type'=> 3,
																								'StudentNotification.student_interview_status' => 0,
																								]]]);
			$this->set('contrataciones',$contrataciones);	
			
			$typeRespons = array(1=>0, 2=>6);
			$seguimientos = $this->StudentNotification->find('all', ['conditions' => ['AND' => ['StudentNotification.student_id' => $this->Session->read('student_id'),
																								'StudentNotification.interview_type'=> 4,
																								'StudentNotification.total_mail_send >' => 0,
																								'StudentNotification.type_respons' => 0,
																								// 'StudentNotification.type_respons' => $typeRespons,
																								]]]);
			$this->set('seguimientos',$seguimientos);	
		}
		 
		public function viewCvOnline(){
			$this->Student->recursive = 3;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			$this->academicLevel();
			$this->Facultades();
			$this->Escuelas();
			$this->career();
			$this->country();
			$this->posgradoProgrma();
			$this->NivelesIdioma();
			$this->TypeCourses();
			$this->softwareLevel();
			$software = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('software') );
			
			$carreras = $this->Career->find('list',['fields' => ['Career.id', 'Career.career'],'order' => ['Career.career ASC']]);
			$this->set( compact ('carreras') );
			
			$carrerasRegistro = $this->Career->find('list',['fields' => ['Career.career_id', 'Career.career'],'order' => ['Career.career ASC']]);
			$this->set( compact ('carrerasRegistro') );
			
			$programas = $this->PosgradoProgram->find('list',['fields' => ['PosgradoProgram.id', 'PosgradoProgram.posgrado_program'],'order' => ['PosgradoProgram.posgrado_program ASC']]);
			$this->set( compact ('programas') );
		}
		
		public function postullation($id=null){
			if($this->Session->read('affterPostulated') <> ''):
				$affterPostulated = $this->Session->read('affterPostulated').$this->Session->read('page');
			else:
				$affterPostulated = 'profile'.$this->Session->read('page') ;
			endif;
			
			$buscaIdCompany = $this->CompanyJobProfile->find('list', ['fields' => ['CompanyJobProfile.id','CompanyJobProfile.company_id'],'conditions' => ['CompanyJobProfile.id' => $id],'limit'=>1]);
													
			$total = $this->Application->find('count', ['conditions' => ['AND' => ['Application.student_id' =>  $this->Session->read('student_id'),'Application.company_job_profile_id' => $id]]]);

			if($total == 0):
				if($buscaIdCompany[$id] <> ''):
					$this->request->data['Application']['student_id'] = $this->Session->read('student_id');
					$this->request->data['Application']['company_job_profile_id'] = $id;
					$this->request->data['Application']['company_id'] = $buscaIdCompany[$id];
					
					if($this->Application->save($this->request->data)):
						$this->Session->setFlash('Postulación exitosa', 'alert-success');
						$this->redirect(array('action' =>  $affterPostulated));
					else:
						$this->Session->setFlash('Lo sentimos, no pudimos postularlo a esta oferta', 'alert-danger');
						$this->redirect(array('action' =>  $affterPostulated));
					endif;
				else:
					$this->Session->setFlash('Lo sentimos, no se encontro la empresa que postuló la oferta', 'alert-danger');
					$this->redirect(array('action' =>  $affterPostulated));
				endif;
			endif;
		}
		
		public function viewPdf(){
			$this->layout = '/pdf/pdf';
			$this->Student->recursive = 3;
			$this->set('student', $this->Student->findById($this->Session->read('student_id')));
			$this->academicLevel();
			$this->Facultades();
			$this->Escuelas();
			$this->career();
			$this->posgradoProgrma();

			$interesesAreacv = $this->StudentInterestJob->find('all', array(
																		'conditions' => array (
																			'StudentInterestJob.student_id' => $this->Session->read('student_id'),	
																		)
			));
			$this->set( compact ('interesesAreacv') );
		}
		
		public function viewOfferPdf($id){
			$this->CompanyJobProfile->recursive = 2;
			$this->set('oferta', $this->CompanyJobProfile->findById($id));
			$this->Company->recursive = -2;
			// $this->set('company', $this->Company->findById($this->Session->read('company_id')));
			
			$this->layout = '/pdf/pdf1';
			$this->benefit();
			$this->carrer();
			$this->NivelesIdioma();
			$this->softwareLevel();
			$this->softwareLevel();
			$this->disabilityType();
			$this->escuelasFacultades();
			$Tecnologias = $this->Tecnology->find('list', array('order' => array('Tecnology.id ASC')));
			$this->set( compact ('Tecnologias') );
			
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
		
		public function viewOnlyOfferPdf($id){
			$this->viewOfferPdf($id);
		}
		// get catalogos lists;
		
		public function carrer(){
			$careers = $this->Career->find('list', array('order' => array('Career.career ASC')));
			$this->set( compact ('careers') );
		}
		
		public function lenguage(){
			$lenguages = $this->Lenguage->find('list', array('order' => array('Lenguage.id ASC')));
			$this->set( compact ('lenguages') );
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
		
		public function Tecnology(){
			$Tecnologies = $this->Tecnology->find('list', array('order' => array('Tecnology.id ASC')));
			$this->set( compact ('Tecnologies') );
		}
		
		public function contractType(){
			$TiposContratos = $this->ContractType->find('list', array('order' => array('ContractType.id ASC')));
			$this->set( compact ('TiposContratos') );
		}
		
		public function workday(){
			$JornadasLaborales = $this->Workday->find('list', array('order' => array('Workday.id ASC')));
			$this->set( compact ('JornadasLaborales') );	
		}
		
		public function sexo(){
			$Sexos = $this->Sexo->find('list', array('order' => array('Sexo.id ASC')));
			$this->set( compact ('Sexos') );
		}
		
		public function country(){
			$Paises = $this->Country->find('list', array('order' => array('Country.id ASC')));
			$this->set( compact ('Paises') );
		}
		
		public function maritalStatus(){
			$EstadoCivil = $this->MaritalStatus->find('list', array('order' => array('MaritalStatus.id ASC')));
			$this->set( compact ('EstadoCivil') );
		}
		
		public function states(){
			$Estados = $this->State->find('list', array('order' => array('State.id ASC')));
			$this->set( compact ('Estados') );
			return $Estados;
		}
		
		public function academicSituation(){
			$SituacionesAcademicas = $this->AcademicSituation->find('list', array('order' => array('AcademicSituation.id ASC')));
			$this->set( compact ('SituacionesAcademicas') );
		}
		
		public function academicLevel(){
			$NivelesAcademicos = $this->AcademicLevel->find('list', array('order' => array('AcademicLevel.id ASC')));
			$this->set( compact ('NivelesAcademicos') );
		}
		
		public function scholarshipProgram(){
			$ProgramasBeca = $this->ScholarshipProgram->find('list', array('order' => array('ScholarshipProgram.id ASC')));
			$this->set( compact ('ProgramasBeca') );
		}
		
		public function disabilityType(){
			$TiposDiscapacidad = $this->DisabilityType->find('list', array('order' => array('DisabilityType.id ASC')));
			$this->set( compact ('TiposDiscapacidad') );
		}
		
		public function average(){
			$Promedios = $this->Average->find('list', array('order' => array('Average.id ASC')));
			$this->set( compact ('Promedios') );
		}
		
		public function decimalAverage(){
			$Decimales = $this->DecimalAverage->find('list', array('order' => array('DecimalAverage.id ASC')));
			$this->set( compact ('Decimales') );
		}
		
		public function semester(){
			$Semestres = $this->Semester->find('list', array('order' => array('Semester.id ASC')));
			$this->set( compact ('Semestres') );
		}
		
		public function career(){
			$CarrerasLicenciatura = $this->Career->find('list', array('order' => array('Career.career ASC')));
			$this->set( compact ('CarrerasLicenciatura') );
		}
		
		public function TypeProyect(){
			$TiposProyectos = $this->TypeProyect->find('list', array('order' => array('TypeProyect.type_proyect ASC')));
			$this->set( compact ('TiposProyectos') );
		}
		
		public function program(){
			$Programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('Programas') );
		}
		
		public function posgradoProgrma(){
			$AreasPosgrado = $this->PosgradoProgram->find('list', array('order' => array('PosgradoProgram.posgrado_program ASC')));
			$this->set( compact ('AreasPosgrado') );
		}
		
		public function EscuelasFacultades(){
			$EscuelaLicenciatura = $this->FacultadLicenciatura->find('list', array('order' => array('FacultadLicenciatura.facultad_licenciatura ASC')));
			$EscuelaPosgrados = $this->FacultadPosgrado->find('list', array('order' => array('FacultadPosgrado.facultad_posgrado ASC')));
			$EscuelasFacultades = $EscuelaLicenciatura + $EscuelaPosgrados;
			$this->set('EscuelasFacultades', $EscuelasFacultades);	
		}
		
		public function Escuelas(){
			$Escuelas = $this->FacultadLicenciatura->find('list', array('order' => array('FacultadLicenciatura.facultad_licenciatura ASC')));
			$this->set( compact ('Escuelas') );
		}
		
		public function Facultades(){
			$Facultades = $this->FacultadPosgrado->find('list', array('order' => array('FacultadPosgrado.facultad_posgrado ASC')));
			$this->set( compact ('Facultades') );
		}
		
		public function Rotation(){
			$Giros = $this->Rotation->find('list', array('order' => array('Rotation.id ASC')));
			$this->set( compact ('Giros') );
		}
		
		public function TypeCourses(){
			$TipoCursos = $this->TypeCourse->find('list', array('order' => array('TypeCourse.type_course ASC')));
			$this->set( compact ('TipoCursos') );
		}
		
		public function ExperienceArea(){
			$AreasExperiencia = $this->ExperienceArea->find('list', array('order' => array('ExperienceArea.experience_area ASC')));
			$this->set( compact ('AreasExperiencia') );
		}
		
		public function ExperienceSubarea(){
			$SubareasExperiencia = $this->ExperienceSubarea->find('list', array('order' => array('ExperienceSubarea.experience_subarea ASC')));
			$this->set( compact ('SubareasExperiencia') );
		}
		
		public function salary(){
			$Salarios = $this->Salary->find('list', array('order' => array('Salary.id ASC')));
			$this->set( compact ('Salarios') );
		}
		
		public function Programas(){
			$Programas = $this->Program->find('list', array('order' => array('Program.id ASC')));
			$this->set( compact ('Programas') );
		}
		
		public function Competency(){
			$Competencias = $this->Competency->find('list', array('order' => array('Competency.id ASC')));
			$this->set( compact ('Competencias') );
		}
		
		public function Sector(){
			$Sectores = $this->Sector->find('list', array('order' => array('Sector.id ASC')));
			$this->set( compact ('Sectores') );
		}
		
		public function studentCancellation(){
			$MotivosCancelacion = $this->StudentCancellation->find('list', array('order' => array('StudentCancellation.id ASC')));
			$this->set( compact ('MotivosCancelacion') );
		}
		
		public function job(){
			$Puestos = $this->Job->find('list', array('order' => array('Job.job ASC')));
			$this->set( compact ('Puestos') );
		}
		
		public function similarCareer(){
			$CarrerasAfines = $this->SimilarCareer->find('list', 
																array(
																	'fields' => array('SimilarCareer.id', 'SimilarCareer.similar_career'),
																	'order' => array('SimilarCareer.similar_career ASC')
														));
			$this->set( compact ('CarrerasAfines') );
		}
		
		public function notification(){
			$this->StudentNotification->recursive = -1;			

			$conditionsConcatenated[] = array( 'OR' => array(
																'StudentNotification.student_interview_status <> ' => 1,
																'StudentNotification.company_interview_status <> ' => 1,
															),
											);

			$entrevistas = $this->StudentNotification->find('count', array(
																			'conditions' => array (
																									'AND' => array(
																													'StudentNotification.student_id' => $this->Session->read('student_id'),
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
																													'StudentNotification.student_id' => $this->Session->read('student_id'),
																													'StudentNotification.interview_type'=> 3,
																													'StudentNotification.student_interview_status' => 0,
																													)
																									)
																			)
																);
																
			$typeRespons = array(1=>0, 2=>6);
			$seguimiento = $this->StudentNotification->find('count', array(
																			'conditions' => array (
																									'AND' => array(
																													'StudentNotification.student_id' => $this->Session->read('student_id'),
																													'StudentNotification.interview_type'=> 4,
																													'StudentNotification.total_mail_send >' => 0,
																													'StudentNotification.type_respons' => 0,
																													// 'StudentNotification.type_respons' => $typeRespons,
																													)
																									)
																			)
																);	
			
			$notificaciones = $entrevistas + $contrataciones + $seguimiento;											
			$this->set('notificaciones',$notificaciones);
		}
		
		public function benefit(){
			$Prestaciones = $this->Benefit->find('list', array('order' => array('Benefit.benefit ASC')));
			$this->set( compact ('Prestaciones') );
		}
		
		public function studentLastUpdate(){
			$this->Student->recursive = -2;
			$student = $this->Student->findById($this->Session->read('student_id'));
			$this->StudentLastUpdate->data['StudentLastUpdate']['id'] = $this->Session->read('student_id');
			$this->StudentLastUpdate->data['StudentLastUpdate']['student_username'] = $student['Student']['username'];
			$this->StudentLastUpdate->save($this->StudentLastUpdate->data);
		}

		public function CarrerasProgramas(){
			$Carreras = $this->Career->find('all', array('order' => array('Career.id ASC')));
			$Programas = $this->PosgradoProgram->find('all', array('order' => array('PosgradoProgram.id ASC')));
			
			foreach($Carreras as $Carrera):
				$CarrerasProgramas[$Carrera['Career']['career_id'].'/'.$Carrera['Career']['type']] = $Carrera['Career']['career'];
			endforeach;
			
			foreach($Programas as $Programa):
				$CarrerasProgramas[$Programa['PosgradoProgram']['posgrado_program_id'].'/'.$Programa['PosgradoProgram']['type']] = $Programa['PosgradoProgram']['posgrado_program'];
			endforeach;
			asort($CarrerasProgramas);
			$this->set( compact ('CarrerasProgramas') );
		}
		
		public function folder(){
			$folders = $this->StudentFolder->find('all', array(
																'conditions' => array('StudentFolder.student_id' => $this->Session->read('student_id')),
																'order' => array('StudentFolder.name ASC')));
			$this->set( compact ('folders') );
			
			$foldersList = $this->StudentFolder->find('list', array(
																'conditions' => array('StudentFolder.student_id' => $this->Session->read('student_id')),
																'order' => array('StudentFolder.name ASC')));
			$this->set( compact ('foldersList') );
		}
		
		public function studentSavedOfferList(){
			$OfertasGuardadas = $this->StudentFolder->find('all', array(
																'conditions' => array('StudentFolder.id' => '4'),
																'order' => array('StudentFolder.id ASC')));
			$this->set( compact ('OfertasGuardadas') );
		}
			
		public function banner(){
			$imagenesBanner = $this->Banner->find('all', array(
																'order' => array('Banner.id ASC')
																)
												);
			$this->set( compact ('imagenesBanner') );
		}

	}
?>