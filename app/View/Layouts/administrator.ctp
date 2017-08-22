<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<?php 
			echo $this->Html->charset(); 
		?>
		
        <title>
		<?php 
			echo 'SISBUT UNAM';
		?>
		</title>
		
        <?php
		echo $this->Html->meta(array(
			'name' => 'viewport', 
			'content' => 'width=device-width, initial-scale=0', 
			'http-equiv' => "X-UA-Compatible"
		));

		echo $this->Html->meta ( 'favicon.ico', '/img/SISBUTicon.png', array (
			'type' => 'icon' 
		) );

		echo $this->Html->css(array(
			'https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css',
			'bootstrap-select.min.css',
			'bootstrap.min',
			'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
			'wow-animate',
			'unam-style',
			'morris-0.4.3.min',
			'custom',
			'jquery.alerts',
			'http://fonts.googleapis.com/css?family=Open+Sans',
			
			));
		
		echo $this->Html->script(array(		
			'vendor/modernizr-2.6.2-respond-1.1.0.min',
			'vendor/jquery-1.11.1.min',
			'jquery.min',
			'jquery-ui-1.8.23.custom.min',	
			'jquery.alerts',
			'vendor/wow-animate',			
			'vendor/bootstrap.min',
			'jquery.metisMenu',
			'morris/raphael-2.1.0.min',
			'userMain',
			'morris/morris',
			'custom',
			'bootstrap-select.min',
			'https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js',
			'https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js',
			'jquery-migrate-1.0.0'
		));
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');		
		?>
		
		<script>
			function editFolder(id){
				jPrompt('Ingrese el nuevo nombre de la carpeta:', '', 'Renombrar carpeta', function(r){
					if( r ){
							document.getElementById("CompanyFolderName").value = r;
							document.getElementById("nameId"+id).value = r;
							document.getElementById("formCompanyEditFolderId"+id).submit();
					} 
				});
			}
			
			function deleteFolder(id){
				jConfirm('¿Realmente desea eliminar esta carpeta, las ofertas guardadas en esta carpeta tambien serán eliminadas?', 'Mensaje', function(r){
				if( r ) document.getElementById("formCompanydeleteFolderId"+id).submit();
				});
				return false;
			}
			
			function confirmaEjecucionSeguimiento(id){
				jConfirm('Está apunto de ejecutar "Seguimiento a procesos de R&S y contrataciones" el cual realiza un análisis de las entrevistas programadas con anterioridad enviando una notificación y correo electrónico a las empresas o alumnos (Si aplica) con opciones de respuestas para definir el termino de la entrevista, este proceso está programado para realizarse sólo una vez cada cierto periodo, una vez terminado esta opción desaparecerá y se activará nuevamente al lapso de un tiempo establecido, si está deacuerdo en ejecutar la acción presione "Aceptar" de lo contrario presione "Cancelar".', 'Mensaje', function(r){
					if( r ){
						$('#loading').show();
						window.location.assign("http://bolsa.trabajo.unam.mx/unam/Administrators/reclutamientoSeleccion");
					}
				});
				return false;
			}
			
			function confirmaEjecucionDesactivaCV(){
				jConfirm('Está apunto de ejecutar un proceso de revisión a universitarios que no poseen actividad en su cuenta por al menos 5 meses enviandoles un correo incitandolos a actualizar su perfil','Mensaje', function(r){
					if( r ){
						$('#loading').show();
						window.location.assign("http://bolsa.trabajo.unam.mx/unam/Administrators/studentStatus");
					}
				});
				return false;
			}
			
			$(window).load(function() {
				$( ".modal-dialog" ).draggable();
				<?php 
					$permiso = explode(",", $administrator['AdministratorProfile']['access']);
					foreach($permiso as $conPermiso):
				?>
					$('#menuId'+<?php echo $conPermiso; ?>).show();
				<?php 
					endforeach;	
				?>
			});
			
			function avisoAdmin(param){
				jAlert('Sin permisos para modificar al administrador principal', 'Mensaje');
				return false;
			}
			
			function cvIncompleto(){
				jAlert('El universitario no cuenta con un currículum completo para ser enviado, se considera cv completo ingresando información en: Datos Personales, Formación Académica, Objetivo Profesional, Competencias Profesionales y Expectativas Laborales.', 'Mensaje');
				return false;
			}
			
			function ofertaIncompleta(){
				jAlert('La oferta no está completa por consecuente no podrá activarse hasta que se complete su edición.', 'Mensaje');
				return false;
			}
			
			function ofertaExpirada(){
				jAlert('La oferta ha expirado para poder activarla debe de actualizar la fecha de vigencia.', 'Mensaje');
				return false;
			}
		</script>
    </head>
	
    <body class="unresponsive" style="overflow: auto;">
 	
	<div id="loading" class="modal">
		<p style="font-size: 20px;"><img src="<?php echo $this->webroot; ?>/img/procesando.gif"  style="height: 35px; width: 35px; margin-left: 5px; margin-top: 5px; " /> Ejecutando...</p>
	</div>
		
	<!--Encabezado de la página-->
	<div class="header">
		<div class="row">
			<center>
			<div <div style="width:1280px;">
				<?php echo $this->Html->image('student/headerPage.png',
										array(
											'alt' => 'Registro primera vez imagen', 
											'style'=> 'align-self: center; image-rendering: auto; width: 100%;',
											'class' => 'class="img-responsive center-block"',
											'url' => array(
													'controller'=>'Administrators',
													'action'=>'administrator',),
				)); ?>
			</div>
			</center>
		</div>
	</div>
	
	<!--Contenedor de página-->
	<div class="content" style="margin-top: -1px;" >
			
			<center>
				<div class="row">
					<div style="width:1280px;">
						<div class="col-md-12">
							<div class="row" style= " position:relative; margin: 0 auto; left: 0; right: 0; min-width: 580px; max-width: 1280px; margin-top:-20px;" >	
								<div class="col-md-1 col-md-offset-9 logout" >
									<?php echo $this->Html->image('student/logout.png',
																					array(
																						'alt' => 'Logout', 
																						'class' => 'estatica',
																						'url' => array(
																								'controller'=>'Administrators',
																								'action'=>'logout'
																								),
									)); ?>
								</div>

								<div class="col-md-1 col-md-offset-10 logout "  style="height: 0px; margin-top:-40px;" >
									<a onclick="showVideo('<?php echo $this->webroot; ?>files/videos/video.mp4')" data-toggle="modal"  href="#" ><img src="/unam/img/home/video.png" alt="VideoTutorial.png" class="estatica2"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</center>

			<center>
				<div class="row">
					<table style="width:1280px;">
						<tr>
							<td style="width:260px;"  valign="top">
								<div style=" padding-left: 0px; padding-right: 0px; text-align: left">
									<nav class="navbar-default navbar-side" role="navigation" style=" position: relative;">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="sidebar-collapse">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>
				
									<div class="sidebar-collapse">
										<ul class="nav" id="main-menu" style="padding-bottom: 15px;">
											<li class="text-center" style="background-color: rgb(66, 106, 210); padding-top: 30px; border-bottom-width: 0px; margin-bottom: 0px; padding-bottom: 30px;">
												<div class="grises">
													<p>Bienvenido(a),</p>
													<center>
													<p style="padding-top: 35; width: 230px; line-height: 15px;">
														<?php 
															if (isset($administrator)):
																if(isset($administrator['AdministratorProfile']['institution'])):
																	echo $this->Html->link($EscuelasFacultades[$administrator['AdministratorProfile']['institution']], 
																						array(
																							'controller'=>'Administrators',
																							'action'=>'editPhoto',$this->Session->read('Auth.User.id')),
																						array(
																							'escape' => false,
																							'style' => 'font-size: 11px; font-weight: bold; line-height: 20px;'
																							)	
																						); 
																endif;
															endif;
														?>
													</p>
													<p style="padding-top: 0; width:220px line-height: 15px;">	
														<?php 
															if (isset($administrator)):
																if(isset($administrator['AdministratorProfile']['contact_name'])):
																	echo $this->Html->link($administrator['AdministratorProfile']['contact_name'].' '.$administrator['AdministratorProfile']['contact_last_name'].' '.$administrator['AdministratorProfile']['contact_second_last_name'],  
																							array(
																								'controller'=>'Administrators',
																								'action'=>'editPhoto',$this->Session->read('Auth.User.id')),
																							array(
																								'escape' => false,
																								'style' => 'font-size: 12px;'
																								)
																							);
																endif;
															endif;
														?>
													</p>
													
													</center>
													<?php
														if (isset($administrator)):
															if(isset($administrator['Administrator']['filename'])):
																if($administrator['Administrator']['filename'] <> ''):
																	echo $this->Html->image('uploads/administrator/filename/'.$administrator['Administrator']['filename'],
																				array(
																					'alt' => 'Profile Photo',
																					'width' => '110px',
																					'height' => '110px',
																					'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 10px;',
																					'url' => array(
																						'controller'=>'Administrators',
																						'action'=>'editPhoto', $this->Session->read('Auth.User.id'))
																				));
																else:
																	echo $this->Html->image('company/avatar.png',
																				array(
																					'alt' => 'Profile Photo',
																					'width' => '110px',
																					'height' => '110px',
																					'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 10px;',
																					'url' => array(
																						'controller'=>'Administrators',
																						'action'=>'editPhoto', $this->Session->read('Auth.User.id'))
																				));
																endif;
															else:
																	echo $this->Html->image('company/avatar.png',
																				array(
																					'alt' => 'Profile Photo',
																					'width' => '110px',
																					'height' => '110px',
																					'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 10px;',
																					'url' => array(
																						'controller'=>'Administrators',
																						'action'=>'editPhoto', $this->Session->read('Auth.User.id'))
																				));
															endif;
														else:
																	echo $this->Html->image('company/avatar.png',
																				array(
																					'alt' => 'Profile Photo',
																					'width' => '110px',
																					'height' => '110px',
																					'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 10px;',
																					'url' => array(
																						'controller'=>'Administrators',
																						'action'=>'editPhoto', $this->Session->read('Auth.User.id'))
																				));
														endif;
													?>
												</div>
											</li>
											<li id="menuId1" style="display: none">
												<?php 
												$index = 0;
												(!empty($this->params['action']) && (($this->params['action']=='addAdministrator') || ($this->params['action']=='searchAdministrator') || ($this->params['action']=='editAdministratorProfile') || ($this->params['action']=='editPasswordAdministrator') || ($this->params['action']=='banner'))) ? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'], 
																	array(
																		'controller'=>'Administrators',
																		'action' => 'addAdministrator'), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<!--li id="menuId2" style="display: none">
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='')))? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'], 
																	array(
																		'controller'=>'Administrators',
																		'action' => ''), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;',
																		'escape' => false
																		)
												);?>
											</li-->
											<li id="menuId3" style="display: none">
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='searchStudent') || ($this->params['action']=='viewStudentPostullation') || ($this->params['action']=='specificSearchStudent') || ($this->params['action']=='specificSearchStudentResults')))? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'], 
																	array(
																		'controller'=>'Administrators','nuevaBusqueda',
																		'action' => 'searchStudent'), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<li id="menuId4" style="display: none">
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='searchCompany') || ($this->params['action']=='specificSearchCompany') || ($this->params['action']=='companyOfferOption') || ($this->params['action']=='companyHistory') || (($this->params['action']=='searchStudentOffer') AND ($this->Session->read('volver')=='companyHistory')) || ($this->params['action']=='resultsSpecificSearchCompany')))? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'], 
																	array(
																		'controller'=>'Administrators',
																		'action' => 'searchCompany','nuevaBusqueda'), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<li id="menuId5" style="display: none">
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='searchOffer') || ($this->params['action']=='specificSearchOffer') || (($this->params['action']=='searchStudentOffer') AND ($this->Session->read('volver')=='searchOffer')) || ($this->params['action']=='specificSearchOfferResults'))) ? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'], 
																	array(
																		'controller'=>'Administrators',
																		'action' => 'searchOffer','nuevaBusqueda'),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;', )
												);?>
											</li>
											<li id="menuId6" style="display: none">
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='sendMail'))) ? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'], 
																	array(
																		'controller'=>'Administrators',
																		'action' => 'sendMail','nuevaBusqueda'),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<li id="menuId7" style="display: none">
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='informe') || ($this->params['action']=='reporte') || ($this->params['action']=='consultas')))? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'], 
																	array(
																		'controller'=>'Administrators',
																		'action' => 'informe'),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px' )
												);?>
											</li>
											<!--li id="menuId8" style="display: none">
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='notification'))) ? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($accesos[$index++]['AdministratorAccess']['description'].'<span class="badge" style="margin-left: 29px;">'.$notificaciones.'</span>', 
																	array(
																		'controller'=>'Administrators',
																		'action' => 'notification'),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px',
																		'escape' => false)
												);?>
											</li-->
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Sistema Universitario de Bolsa de Trabajo', 
																		'http://www.dgoserver.unam.mx/portaldgose/bolsa-trabajo/htmls/bolsa-directorio.html',
																	array(
																		'escape' => false,
																		'target' => '_blank',
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;margin: 9px 1px 0px 12px;width: 236px;',)	
												);?>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Oferta Académica Licenciatura', 
																		'http://www.oferta.unam.mx',
																	array(
																		'escape' => false,
																		'target' => '_blank',
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px')	
												);?>
											</li>
											<?php 
												$hoy = date('Y-m-d');
												if((($fechaReclutamiento['RecruitmentDate']['fecha1_seguimiento'] <= $hoy) AND ($fechaReclutamiento['RecruitmentDate']['status_ejecucion_fecha1']==0) OR (( ($fechaReclutamiento['RecruitmentDate']['fecha1_seguimiento'] < $hoy) AND ($fechaReclutamiento['RecruitmentDate']['fecha2_seguimiento'] <= $hoy) AND ($fechaReclutamiento['RecruitmentDate']['status_ejecucion_fecha2']==0)))) AND ($this->Session->read('Auth.User.role') === 'administrator')):
											?>
											<li id="menuId11">
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Ejecutar seguimiento a procesos de R&S y contrataciones', 
																	array(
																		//'controller'=>'Administrators',
																		//'action' => 'reclutamientoSeleccion'
																		),
																	array(
																		'onclick' => 'return confirmaEjecucionSeguimiento();',
																		'title' => 'Seguimiento a procesos de R&S y contrataciones',
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<?php 
												endif;
											?>
											<?php 
												$hoy = date('Y-m-d');
												if((($fechaStudentEstatus['StudentStatus']['fecha1_seguimiento'] <= $hoy) AND ($fechaStudentEstatus['StudentStatus']['status_ejecucion_fecha1']==0) OR 
												(( ($fechaStudentEstatus['StudentStatus']['fecha1_seguimiento'] < $hoy) AND ($fechaStudentEstatus['StudentStatus']['fecha2_seguimiento'] <= $hoy) AND ($fechaStudentEstatus['StudentStatus']['status_ejecucion_fecha2']==0)))) AND ($this->Session->read('Auth.User.role') === 'administrator')):
											?>
											<li id="menuId12">
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Ejecutar proceso de revisión a universitarios sin actividad', 
																	array(
																		//'controller'=>'Administrators',
																		//'action' => 'reclutamientoSeleccion'
																		),
																	array(
																		'onclick' => 'return confirmaEjecucionDesactivaCV();',
																		'title' => 'Ejecutar proceso de revisión a universitarios sin actividad',
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<?php 
												endif;
											?>
										</ul>   
										
										<!-- Bloques informativos D0D2D3 -->
										<ul class="nav" id="BloqueInformativoId" style="background-color:#d0d2d3; padding-bottom: 15px; display: none;">
											<div class="col-md-12" style="background-color:#A4A4A4; min-height: 45px;">
												<p  id="informeSeleccionadoId" style="font-weight: bold; font-size: 15px; color: #000; margin-top: 10px; "> </p>
											</div>
											<div class="col-md-12">
												<p style="font-weight: bold; font-size: 15px; color: #000; margin-top: 5px; margin-bottom: 0px;">Descripción:</p>
												<p id="descripcionInformeId" style="font-size: 15px; color: #000; margin-bottom: 0px; line-height: 18px;"> </p>
											</div>
										</ul>


										
									</div>
									</nav>  
								</div>	
							</td>
	
							<td style="" valign="top">
							<div style="padding-left: 0px; padding-right: 0px; text-align: left">
							
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='administrator'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;" >Bienvenido</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='addAdministrator') || ($this->params['action']=='searchAdministrator') || ($this->params['action']=='editAdministratorProfile') || ($this->params['action']=='editPasswordAdministrator') || ($this->params['action']=='banner'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;" >Administrador ABC</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='editPhoto'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;" >Logo de administrador</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='searchStudent') || ($this->params['action']=='specificSearchStudent')  || ($this->params['action']=='specificSearchStudentResults') )):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;" >Universitarios</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='viewStudentPostullation'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;" >Postulaciones</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='searchCompany') || ($this->params['action']=='specificSearchCompany') || ($this->params['action']=='resultsSpecificSearchCompany'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;" >Empresas / Instituciones</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='companyOfferOption'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;"> Lineamientos de publicación</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='companyHistory'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;">Historial</a>
								<?php 
									endif; 
								?>
								
								<?php 
									$opcionElegida = $this->Session->read('optionSearchStudentOffer');
									if($opcionElegida == 1):
										$texto = 'Entrevistas telefónicas';
									else:
										if($opcionElegida == 2):
											$texto = 'Entrevistas presenciales';
										else:
											$texto = 'Contrataciones';
										endif;
									endif;
								
								
									if(!empty($this->params['action']) && (($this->params['action']=='searchStudentOffer'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;"><?php echo $texto; ?></a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='searchOffer') OR $this->params['action']=='specificSearchOffer') OR ($this->params['action']=='specificSearchOfferResults')):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;">Ofertas</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='sendMail'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;">Correos masivos</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='informe'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;">Informes</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='reporte'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;">Reportes</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='consultas'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;">Frecuencias</a>
								<?php 
									endif; 
								?> 
								
								<?php 
									if(!empty($this->params['action']) && ( ($this->params['action']=='notification'))):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px; font-size: 16px;">Notificaciones</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='addAdministrator') || ($this->params['action']=='searchAdministrator') || ($this->params['action']=='editAdministratorProfile')|| ($this->params['action']=='editPasswordAdministrator') || ($this->params['action']=='banner'))):
								?>
									<div class="panel panel-default" style=" background-color: transparent; box-shadow: none; min-width: 448px; margin-bottom: 2px; font-weight: bold;">
										<div class="panel-body" style="padding: 0;">
											<div class="container" style="padding-left: 0; padding-right: 0; width: 100%; " >
												<ul class="nav nav-tabs" style="background-color: #93b2ff; text-align: center; max-width:1020px; width: 1020px; padding-top: 50px; height: 100px; ">
													<li style="width: 240px; margin-top: -20px; margin-left: 150px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='addAdministrator') || ($this->params['action']=='editAdministratorProfile') || ($this->params['action']=='editPasswordAdministrator')) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Usuarios del Sistema',	
																	array(
																		'controller'=>'Administrators',
																		'action' => 'addAdministrator'
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)); 
															?>
													</li>
													<li style="width: 240px; margin-top: -20px; margin-left: 213px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='banner'))) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Banners', 
																array(
																	'controller'=>'Administrators',
																	'action' => 'banner'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)
															); ?>
													</li>
												</ul>	
											</div>
										</div>
									</div>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='searchStudent') || ($this->params['action']=='specificSearchStudent')  || ($this->params['action']=='specificSearchStudentResults'))):
								?>
									<div class="panel panel-default" style=" background-color: transparent; box-shadow: none; min-width: 448px; margin-bottom: 15px; font-weight: bold;">
										<div class="panel-body" style="padding: 0;">
											<div class="container" style="padding-left: 0; padding-right: 0; width: 100%; " >
												<ul class="nav nav-tabs" style="background-color: #93b2ff; text-align: center; max-width:1020px; width: 1020px; padding-top: 50px; height: 100px; ">
													<li style="width: 240px; margin-top: -20px; margin-left: 150px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='searchStudent') ) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Consulta rápida',	
																	array(
																		'controller'=>'Administrators',
																		'action' => 'searchStudent','nuevaBusqueda'
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)); 
															?>
													</li>
													<li style="width: 240px; margin-top: -20px; margin-left: 213px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='specificSearchStudent') || ($this->params['action']=='specificSearchStudentResults'))) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Búsqueda de candidatos', 
																array(
																	'controller'=>'Administrators',
																	'action' => 'specificSearchStudent'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)
															); ?>
													</li>
												</ul>	
											</div>
										</div>
									</div>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='searchCompany') || ($this->params['action']=='specificSearchCompany') )):
								?>
									<div class="panel panel-default" style=" background-color: transparent; box-shadow: none; min-width: 448px; margin-bottom: 15px; font-weight: bold;">
										<div class="panel-body" style="padding: 0;">
											<div class="container" style="padding-left: 0; padding-right: 0; width: 100%; " >
												<ul class="nav nav-tabs" style="background-color: #93b2ff; text-align: center; max-width:1020px; width: 1020px; padding-top: 50px; height: 100px; ">
													<li style="width: 240px; margin-top: -20px; margin-left: 150px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='searchCompany') ) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Consulta rápida',	
																	array(
																		'controller'=>'Administrators',
																		'action' => 'searchCompany','nuevaBusqueda'
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)); 
															?>
													</li>
													<li style="width: 240px; margin-top: -20px; margin-left: 213px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='specificSearchCompany'))) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Búsqueda específica', 
																array(
																	'controller'=>'Administrators',
																	'action' => 'specificSearchCompany','nuevaBusqueda'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)
															); ?>
													</li>
												</ul>	
											</div>
										</div>
									</div>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='searchOffer') || ($this->params['action']=='specificSearchOffer') || ($this->params['action']=='specificSearchOfferResults') )):
								?>
									<div class="panel panel-default" style=" background-color: transparent; box-shadow: none; min-width: 448px; margin-bottom: 15px; font-weight: bold;">
										<div class="panel-body" style="padding: 0;">
											<div class="container" style="padding-left: 0; padding-right: 0; width: 100%; " >
												<ul class="nav nav-tabs" style="background-color: #93b2ff; text-align: center; max-width:1020px; width: 1020px; padding-top: 50px; height: 100px; ">
													<li style="width: 240px; margin-top: -20px; margin-left: 150px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='searchOffer') ) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Consulta rápida',	
																	array(
																		'controller'=>'Administrators',
																		'action' => 'searchOffer','nuevaBusqueda'
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)); 
															?>
													</li>
													<li style="width: 240px; margin-top: -20px; margin-left: 213px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='specificSearchOffer') || ($this->params['action']=='specificSearchOfferResults'))) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Búsqueda específica', 
																array(
																	'controller'=>'Administrators',
																	'action' => 'specificSearchOffer','nuevaBusqueda'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)
															); ?>
													</li>
												</ul>	
											</div>
										</div>
									</div>
								<?php 
									endif; 
								?>

								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='informe') || ($this->params['action']=='reporte') || ($this->params['action']=='consultas'))):
								?>
									<div class="panel panel-default" style=" background-color: transparent; box-shadow: none; min-width: 448px; margin-bottom: 2px; font-weight: bold;">
										<div class="panel-body" style="padding: 0;">
											<div class="container" style="padding-left: 0; padding-right: 0; width: 100%; " >
												<ul class="nav nav-tabs" style="background-color: #93b2ff; text-align: center; max-width:1020px; width: 1020px; padding-top: 50px; height: 100px; ">
													<li style="width: 240px; margin-top: -20px; margin-left: 50px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='informe')) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Informes',	
																	array(
																		'controller'=>'Administrators',
																		'action' => 'informe'
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)); 
															?>
													</li>
													<li style="width: 240px; margin-top: -20px; margin-left: 50px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='reporte'))) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Reportes', 
																array(
																	'controller'=>'Administrators',
																	'action' => 'reporte'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)
															); ?>
													</li>
													<li style="width: 240px; margin-top: -20px; margin-left: 50px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='consultas'))) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Frecuencias', 
																array(
																	'controller'=>'Administrators',
																	'action' => 'consultas'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)
															); ?>
													</li>
												</ul>	
											</div>
										</div>
									</div>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='notification'))):
								?>
									<div class="panel panel-default" style=" background-color: transparent; box-shadow: none; min-width: 448px; margin-bottom: 2px; font-weight: bold;">
										<div class="panel-body" style="padding: 0;">
											<div class="container" style="padding-left: 0; padding-right: 0; width: 100%; " >
												<ul class="nav nav-tabs" style="background-color: #93b2ff; text-align: center; max-width:1020px; width: 1020px; padding-top: 50px; height: 100px; ">
													<li style="width: 240px; margin-top: -20px; margin-left: 150px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='notification')) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Empresas',	
																	array(
																		'controller'=>'Administrators',
																		'action' => 'notification'
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)); 
															?>
													</li>
													<li style="width: 240px; margin-top: -20px; margin-left: 213px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']==''))) ? 'menu-profile active' : 'menu-profile' ?> "	>
															<?php echo $this->Html->link(
																'Ofertas', 
																array(
																	'controller'=>'Administrators',
																	'action' => 'notificationOffer'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' =>'height: 50px; padding-top: 14px;',
																	'escape' => false,
																)
															); ?>
													</li>
												</ul>	
											</div>
										</div>
									</div>
							
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='addAdministrator') || ($this->params['action']=='searchAdministrator') || ($this->params['action']=='editAdministratorProfile')|| ($this->params['action']=='editPasswordAdministrator'))):
								?>
								<div class="header" id="top" style="margin-bottom: 20px;">
									<nav class="navbar navbar-inverse arriba" role="navigation" style="background-color: #93B2FF !important; font-weight: bold; margin-bottom: 2px; ">
										<div class="container cien"  >
											<div class="navbar-header" style="width: 100%;">
												<button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
												<div id="main-nav" class="collapse navbar-collapse" style="margin-top: 5px;" >
													<ul class="nav navbar-nav navbar-right" style="margin-left: 25px;">
													<?php if(!empty($this->params['action']) && ($this->params['action']=='editAdministratorProfile')): ?>
														<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='editAdministratorProfile')  )? 'active border-li' : 'border-li' ?> "	>
														<?php 
															echo $this->Html->link(
																				'Finalizar Edición &nbsp;&nbsp; <i class="glyphicon glyphicon-user"></i>', 
																						array(
																							'controller'=>'Administrators',
																							'action'=>'searchAdministrator' ),
																						array(
																							'class' => 'corriculumMenu',
																							'escape' => false,
																							'style' => 'background-color: #9C0000; border-radius: 10px;',
																						)
																			); 
														?>
														</li>
													<?php else: 
															if(!empty($this->params['action']) && ($this->params['action']=='editPasswordAdministrator')): 
													?>
														<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='editPasswordAdministrator')  )? 'active border-li' : 'border-li' ?> "	>
														<?php 
															echo $this->Html->link(
																				'Finalizar Edición &nbsp;&nbsp; <i class="glyphicon glyphicon-lock"></i>', 
																						array(
																							'controller'=>'Administrators',
																							'action'=>'editAdministratorProfile',$administratorEditingId['Administrator']['id'] ),
																						array(
																							'class' => 'corriculumMenu',
																							'escape' => false,
																							'style' => 'background-color: #9C0000; border-radius: 10px;'
																						)
																			); 
														?>
														</li>
													<?php else: ?>
														<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='addAdministrator')  )? 'active border-li' : 'border-li' ?> "	>
														<?php 
															echo $this->Html->link(
																				'Alta', 
																						array(
																							'controller'=>'Administrators',
																							'action'=>'addAdministrator' ),
																						array(
																						'class' => 'corriculumMenu',
																						)
																			); 
														?>
														</li>
													<?php endif;
														endif;
													?>
													<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='searchAdministrator') )  )? 'active border-li' : 'border-li' ?> ">
													<?php 
														echo $this->Html->link(
																		'Consulta', 
																				array(
																					'controller'=>'Administrators',
																					'action'=>'searchAdministrator','nuevaBusqueda'),
																				array(
																				'class' => 'corriculumMenu',
																				)	
																		); 
													?></li>
														  
													</ul>
												</div>
											</div>
										</div>
									</nav>
								</div>
								
							<?php 
								endif; 
							?>
						

							<?php 
								if(!empty($this->params['action']) && (($this->params['action']=='searchCandidate') || (($this->params['action']=='viewCvOnline')))):
							?>
								<div class="header" id="top">
									<nav class="navbar navbar-inverse arriba" role="navigation" style="background-color: #93B2FF !important; ">
										<div class="container cien"  >
											<div class="navbar-header" style="width: 100%;">
												<button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
												<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0; padding-left: 15px; width: 100%; height: 30px; padding-top: 5px;" >Buscar candidatos</a>
												<div id="main-nav" class="collapse navbar-collapse" style="margin-top: 35px;" >
													<ul class="nav navbar-nav navbar-right" style="margin-left: 25px;">
													<li style="margin:5px 129px 10px"  class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='searchCandidate') || ($this->params['action']=='viewCvOnline') )? 'active border-li' : 'border-li' ?> "	>
													<?php echo $this->Html->link(
														'Búsqueda rápida', 
														array(
															'controller'=>'Companies',
															'action'=>'searchCandidate',  'nuevaBusqueda'),
														array(
														'class' => 'corriculumMenu',
														)
													); 
													?></li>
													<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='specificSearch') || ($this->params['action']=='specificSearchResults') )  )? 'active border-li' : 'border-li' ?> ">
													<?php 
													echo $this->Html->link(
														'Búsquea específica', 
														array(
															'controller'=>'Companies',
															'action'=>'searchCandidate', 'nuevaBusqueda'),
														array(
														'class' => 'corriculumMenu',
														)	
													); 
													?></li>
														  
													</ul>
												</div>
											</div>
										</div>
									</nav>
								</div>
							
							<?php 
								endif; 
							?>
							
							
							
							
							
							<?php if(!empty($this->params['action']) && (($this->params['action']=='changePassword'))): ?>
								<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;" >Modificar contraseña</a>
							<?php endif; ?>
							
							<?php if(!empty($this->params['action']) && ($this->params['action']=='offerAdmin')): ?>
								<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px; margin-bottom: 50px;" >Administrar Ofertas</a>
							<?php endif; ?>
							
							<?php if(!empty($this->params['action']) && ($this->params['action']=='viewCandidateOffer')): ?>
								<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px; margin-bottom: 50px;" >Ver candidatos dentro de oferta</a>
							<?php endif; ?>
							
							<?php if(!empty($this->params['action']) && (($this->params['action']=='disableCompanyRegister'))):?>
								<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;" >Eliminar registro</a>
							<?php endif;?>
							
							<?php if(!empty($this->params['action']) && (($this->params['action']=='CompanyContact'))): ?>
								<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;" >Actualizar datos de registro</a>
							<?php endif; ?>

							<?php if(!empty($this->params['action']) && (($this->params['action']=='companyViewedStudent'))): ?>
								<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px; margin-bottom: 40px;" >Candidatos más vistos por las empresas</a>
							<?php endif; ?>
							
							<div style="margin-left: 20px;">
								<?php echo $this->fetch('content'); ?> 
							</div>
							
							</div> 
							
							</td>
						</tr>
					</table>
				</div>
			</center>
	</div>	
	
	<!--Pie de página-->
	<div class="footer" id="footer" style="width: 1280px; margin-top: 30px;"  >
		<center>
			<div class="col-md-12">
				<div class="col-md-5">
				<?php 
					if(!empty($this->params['action']) && (($this->params['action']=='addAdministrator') )):
				?>
					<p style="text-align: left;"><span style="color:red;">*</span>Campo obligatorio</p>
				<?php else: ?>
					<p></p>
				<?php endif; ?>
				</div>
				<!-- <div class="col-md-2">
					<?php 
						if(!empty($this->params['action']) && (($this->params['action']<>'administrator') )):
					?>
						<p><a href="#" style="color:#7fa4ff; text-decoration: underline; top: 2%;">Aviso de Privacidad</a></p>
					<?php endif; ?>
				</div> -->
				<?php 
					if(!empty($this->params['action']) && ($this->params['action']=='disableCompanyRegister') ): 
				?>	
					<div class="col-md-5">
						<p style="float: right;"><a href="#" style="color:#7fa4ff; text-decoration: underline; top: 2%;">Contacto administrador SISBUT UNAM</a></p>
					</div>
				<?php endif; ?>
			</div>
				
			<div class="col-md-12">
				<hr style="border-color: red; color: red; border-width: 4px 0 0;  margin-top: 0px;" size=1>
			</div>
				
			<div class="col-md-12">
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<p><hr style="border-color: #002377; color: #002377; width: 100%;  border-width: 5px 0 0;x 0px;" size="1"> </p>
			</div>
				<div class="col-md-12">
		<p style="color:#7fa4ff; font-size: 0.96em; line-height:18px;">Hecho en México, todos los derechos reservados 2016. Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica. De otra forma requiere permiso previo por escrito de la institución. Última actualización 15 de Septiembre del 2016. Créditos.<br /><br />
		Sitio web administrado por:<br />Dirección General de Orientación y Atención Educativa. dgose@unam.mx</p>
		</div>
		</center>
		
		</div>
		
	<!--Contenedor de video tutorial-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="auto" height="auto" onclick="stop();" style="overflow: hidden;">
						<div class="modal-dialog">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stop();"><span aria-hidden="true">&times;</span></button>
									 <h4 class="modal-title" id="myModalLabel"><img src="<?php echo $this->webroot; ?>/img/student/logo.png" style="margin-right: 15px; image-rendering: initial; width: 35px;"> Video Tutorial</h4>
								</div>
								<div class="modal-body" >
									<iframe id="iframeVideo" src=""  width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default btnBlue" data-dismiss="modal" onclick="stop();">Cerrar</button>
								</div>
							</div>
						</div>
					</div> 
	
	<!--Formulario de selección de carpeas-->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
				<div class="modal-dialog"  style="width: 500px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Seleccione en qué carpeta desea guardar la oferta</h4>
								</div>
								<div class="modal-body" style="height: 200px;">
									<?php 
									echo $this->Form->create('Company', array(
													'class' => 'form-horizontal', 
													'role' => 'form',
													'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-6">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
													),
													'onsubmit' =>'return validaFormSaveStudent();',
													'action' => 'companySavedStudent',
									)); ?>		
									<fieldset style="margin-top: 50px;">
									<?php 	echo $this->Form->input('CompanySavedStudent.company_folder_id', array(
													'type'=>'select',
													'before' => '<div class="col-md-12 ">',
													'label' => array(
														'class' => 'col-md-5 control-label',
														'text' => 'Carpetas disponibles',),
													'options' => $foldersList,'default'=>'0', 'empty' => 'Selecciona una carpeta'
									));?>
									<?php 	echo $this->Form->input('CompanySavedStudent.student_id', array(
													'type'=>'hidden',
													'label' => '',
									));?>
									
									</fieldset>
								</div>
								<div class="modal-footer">
									<?php 
										echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',array(
													'type' => 'submit', 
														'div' => 'form-group',
														'escape' => false,
													'class' => 'btn btnBlue btn-default col-md-offset-5'
										));
										echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>
		

  </body>
</html>