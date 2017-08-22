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
		
		<style>
		<?php 
			if($this->Session->check('editingAdmin')):
				if($this->Session->read('editingAdmin') == 'yes'):
		?>
		body {
			padding-top: 40px;
		}
		<?php 
				endif;
			endif;
		?>

		header {
			background: #829CE0;
			height: 40px;
			position: fixed;
			top: 0;
			transition: top 0.3s ease-in-out;
			width: 100%;
			z-index: 100;
		}

		.nav-up {
			top: -40px;
		}

	</style><script>
			function editFolder(id, folderName){
				jPrompt('Ingrese el nuevo nombre de la carpeta:', folderName, 'Renombrar carpeta', function(r){
					if( r ){
							document.getElementById("CompanyFolderName").value = r;
							document.getElementById("nameId"+id).value = r;
							document.getElementById("formCompanyEditFolderId"+id).submit();
					} 
				});
			}
			
			function deleteFolder(id, folderName){
				jConfirm('¿Realmente desea eliminar la carpeta '+folderName+', las ofertas guardadas en esta carpeta tambien serán eliminadas?', 'Mensaje', function(r){
				if( r ) document.getElementById("formCompanydeleteFolderId"+id).submit();
				});
				return false;
			}
			
			// Hide Header on on scroll down
			var didScroll;
			var lastScrollTop = 0;
			var delta = 5;
			var navbarHeight = $('header').outerHeight();

			$(window).scroll(function(event){
				didScroll = false;
			});

			setInterval(function() {
				if (didScroll) {
					hasScrolled();
					didScroll = false;
				}
			}, 250);

			function hasScrolled() {
				var st = $(this).scrollTop();
				
				// Make sure they scroll more than delta
				if(Math.abs(lastScrollTop - st) <= delta)
					return;
				
				// If they scrolled down and are past the navbar, add class .nav-up.
				// This is necessary so you never see what is "behind" the navbar.
				if (st > lastScrollTop && st > navbarHeight){
					// Scroll Down
					$('header').removeClass('nav-down').addClass('nav-up');
				} else {
					// Scroll Up
					if(st + $(window).height() < $(document).height()) {
						$('header').removeClass('nav-up').addClass('nav-down');
					}
				}
				lastScrollTop = st;
			}
			
		function cvIncompleto(){
			jAlert('El universitario no cuenta con un currículum completo para ser descargado.', 'Mensaje');
			return false;
		}
		
		function mensajeSinConfigurar(){
			jAlert('No puede visualizar y/o descargar el cv en formato pdf hasta que el administrador indique el número de descargas permitidas para su usuario.', 'Mensaje');
			return false;
		}
		
		function mensajeLimiteDescargas(){
			jAlert('Usted ha llegado al límite de visualizaciones y/o descargas en pdf permitidas por el administrador', 'Mensaje');
			return false;
		}
		
		function mensajeActivaDesactiva(){
			jAlert('Sin permisos para modificar el estatus de la oferta, sólo el administrador puede realizar esta acción', 'Mensaje');
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
			<p style="font-size: 20px; color: "><img src="<?php echo $this->webroot; ?>/img/procesando.gif"  style="height: 35px; width: 35px; margin-left: 5px; margin-top: 5px; " /> Cargando catálogos...</p>
		</div>
		
		<?php 
			if($this->Session->check('editingAdmin')):
				if($this->Session->read('editingAdmin') == 'yes'):
		?>
		<!--Barra administrador-->
		<header class="nav-down" >
			<div class="col-md-12" style="margin-top: 4px;">
				<?php 
					echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i>&nbsp; Volver como administrador', 
														array(
															'controller'=>'Administrators',
															'action'=>$this->Session->read('redirectAdmin'),
														),
														array(
															'class' => 'btn btn-default btnRed ',
															'style' => 'width: 250px; float: right;',
															'escape' => false,
														)	
					); 	
				?> 
			</div>
		</header>
		<?php 
				endif;
			endif;
		?>
		
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
													'controller'=>'Companies',
													'action'=>'profile',),
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
																								'controller'=>'Companies',
																								'action'=>'logout'
																								),
									)); ?>
								</div>

								<div class="col-md-1 col-md-offset-10 logout"  style="height: 0px; margin-top:-40px;" >
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
													<p style="padding-top: 35;">
														<?php 
															if (isset($company)):
																if(isset($company['CompanyProfile']['company_name'])):
																	echo $this->Html->link(
																		$company['CompanyProfile']['company_name'], 
																	array(
																		'controller'=>'Companies',
																		'action'=>'updateRegister', $this->Session->read('company_id')),
																	array(
																		'escape' => false)	
																	); 
																endif;
															endif;
														?>
													</p>
													<?php
														if (isset($company)):
															if(isset($company['Company']['filename'])):
																if($company['Company']['filename'] <> ''):
																	echo $this->Html->image('uploads/company/filename/'.$company['Company']['filename'],
																				array(
																					'alt' => 'Profile Photo',
																					'width' => '110px',
																					'height' => '110px',
																					'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 10px;',
																					'url' => array(
																						'controller'=>'Companies',
																						'action'=>'updateRegister', $this->Session->read('company_id'))
																				));
																else:
																	echo $this->Html->image('company/avatar.png',
																				array(
																					'alt' => 'Profile Photo',
																					'width' => '110px',
																					'height' => '110px',
																					'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 10px;',
																					'url' => array(
																						'controller'=>'Companies',
																						'action'=>'updateRegister', $this->Session->read('company_id'))
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
																						'controller'=>'Companies',
																						'action'=>'updateRegister', $this->Session->read('company_id'))
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
																						'controller'=>'Companies',
																						'action'=>'updateRegister', $this->Session->read('company_id'))
																				));
														endif;
													?>
												</div>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='profile') || ($this->params['action']=='Profile')) ) ? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Perfil', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'profile'), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<?php 
												if(!empty($company['CompanyLastUpdate'])):
													$fecha = $company['CompanyLastUpdate'][0]['modified'];
												else:
													$fecha = date('Y-m-j');
												endif;
												$nuevafecha = strtotime ( '+1 year' , strtotime ( $fecha ) ) ;
												$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
												
												$hoy = date('Y-m-j');
												
												if( $hoy < $nuevafecha ):
											?>
											<li>
												<?php 
												if($this->Session->read('Editando') == 1): 
													$registrarOfertaText = 'Editando oferta... &nbsp;&nbsp; <i class="glyphicon glyphicon-edit"></i>';
												else:
													$registrarOfertaText = 'Registrar Ofertas';
												endif;
												
												(!empty($this->params['action']) && (($this->params['action']=='companyJobOffer') || ($this->params['action']=='companyJobProfile') || ($this->params['action']=='CompanyJobProfile') || ($this->params['action']=='companyJobContractType') || ($this->params['action']=='CompanyJobContractType') || ($this->params['action']=='companyCandidateProfile') || ($this->params['action']=='CompanyCandidateProfile')  || ($this->params['action']=='companyJobKnowledge') || ($this->params['action']=='viewOfferOnline') || ($this->params['action']=='viewOfferPdf')) )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link($registrarOfertaText, 
																	array(
																		'controller'=>'Companies',
																		'action' => 'companyJobOffer'), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;',
																		'escape' => false
																		)
												);?>
											</li>
												<?php endif; ?>
											<li>
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='offerAdmin') || ($this->params['action']=='viewCandidateOffer') || ($this->params['action']=='companyViewedStudent') ))? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Administrar ofertas', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'offerAdmin','nuevaBusqueda'), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<?php 
												// $fecha = $company['CompanyLastUpdate'][0]['modified'];
												// $nuevafecha = strtotime ( '+1 year' , strtotime ( $fecha ) ) ;
												// $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
												
												// $hoy = date('Y-m-j');
												
												if( $hoy < $nuevafecha ):
											?>
											<li>
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='searchCandidate') || ($this->params['action']=='viewCvOnline') || ($this->params['action']=='specificSearchCandidate') || ($this->params['action']=='specificSearchCandidateResults')) )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Buscar Candidatos', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'searchCandidate', 'nuevaBusqueda'), 
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
												<?php endif; ?>
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='companyContact') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Actualizar Datos de Registro', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'companyContact', $this->Session->read('company_id')),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;', )
												);?>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='changePassword') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Modificar Contraseña', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'changePassword', $this->Session->read('company_id')),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='studentReport') || ($this->params['action']=='companyExternalOffer') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Reportar Contrataciones', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'studentReport',
																		'?' => array(
																					'nuevaBusqueda' => 'nuevaBusqueda',
																					),
																		),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px' )
												);?>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && (($this->params['action']=='companyNotification') || ($this->params['action']=='companyPostullation')) )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Notificaciones <span class="badge" style="margin-left: 29px;">'.$notificaciones.'</span>', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'companyPostullation','nuevaBusqueda'),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px',
																		'escape' => false)
												);?>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Lineaminetos UNAM para la Publicación de Ofertas', 
																		'http://www.oferta.unam.mx/',
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
												echo $this->Html->link('Oferta Académica UNAM', 
																		'http://www.oferta.unam.mx/',
																	array(
																		'escape' => false,
																		'target' => '_blank',
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px')	
												);?>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Directorio Sistema Universitario de Bolsa de Trabajo UNAM', 
																		'http://www.dgoserver.unam.mx/portaldgose/bolsa-trabajo/htmls/bolsa-directorio.html',
																	array(
																		'escape' => false,
																		'target' => '_blank',
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px;margin: 9px 1px 0px 12px')
												);?>
											</li>
											<li>
												<?php 
												(!empty($this->params['action']) && ($this->params['action']=='disableCompanyRegister') )? $clase = 'brown activo' : $clase = 'brown';	
												echo $this->Html->link('Eliminar Registro', 
																	array(
																		'controller'=>'Companies',
																		'action' => 'disableCompanyRegister', $this->Session->read('company_id')),
																	array(
																		'class' => $clase,
																		'style' => 'padding-right: 0px;padding-left: 10px;width: 236px; margin: 9px 1px 0px 12px;' )
												);?>
											</li>
											
										</ul>   
					
										<?php 
											if(!empty($this->params['action']) && (($this->params['action']=='offerAdmin') || ($this->params['action']=='searchCandidate') || ($this->params['action']=='viewCandidateOffer')|| ($this->params['action']=='companyViewedStudent'))):
										?>
	
										<ul class="nav" id="main-menu" style="background-color:#D0D2D3; padding-bottom: 15px;">
											<div class="text-center" style="background-color: #D0D2D3; padding-top: 15px; border-bottom-width: 0px; margin-bottom: 0px; padding-bottom: 0px;">
												<p style="text-align: center; font-weight: bold; font-size:15px; color:#000; ">Administrador de carpetas</p>
											</div>
											
											<div>
													<?php echo $this->Form->create('Company', array(
																	'class' => 'form-horizontal', 
																	'role' => 'form',
																	'inputDefaults' => array(
																			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																			'div' => array('class' => 'form-group'),
																			'class' => 'form-control',
																			'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="rigt" title="Guarde y nombre las ofertas de ofertas en carpetas para una mejor organización.Las carpetas creadas se ordenarán alfabéticamente." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 7%;margin-top: 7px;>',
																			'between' => ' <div class="col-md-6">',
																			'after' => '</div></div>',
																			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																	),
																	'action' => 'companyFolder',
													)); ?>					
												
													<?php 	echo $this->Form->input('CompanyFolder.name', array(
																	'label' => '',
																	'type' => 'hidden',
													));	?>
													
													<?php 
													echo $this->Form->input('Nueva carpeta', array(
																				'type' => 'submit',
																				'id' => 'prompt_button',
																				'label' => '',
																				'style' => 'width: 120%;',
																				'between' => ' <div class="col-md-9">',
																				'class' => 'btn btnBlue btn-default form-control',
																				'escape' => true,

																			)
													);?>
													<div class="btn-group" style="margin-left: 15px;">
													<?php 
													echo $this->Html->link('Candidatos más vistos por las empresas', 
																			array(
																				'controller' => 'Companies',
																				'action' => 'companyViewedStudent',
																				),
																			array(
																				'class' => 'btn btnBlue btn-default',
																				'style' => 'height: 50px;white-space: pre-line;text-align: left;width: 200px;',
																				'before' => '<div class="col-md-12 ">',
																			)
													);


													echo $this->Form->end(); 
													?>

													</div>
													<img data-toggle="tooltip" id="" data-placement="right" title="Listado de candidatos más consultados por las empresas." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 83%;margin-top: -70px;">
											</div>
								
											<?php 
												foreach($folders as $k => $folder):
											?>
											<div>
												<?php
												if(isset($intoFolder)):
													if($intoFolder == $folder['CompanyFolder']['id']):
														$colorCarpeta = 'student/folderAzul.png';
													else:
														$colorCarpeta = 'student/folder.png';
													endif;
												else:
													$colorCarpeta = 'student/folder.png';
												endif;

												echo $this->Html->image($colorCarpeta,
																						array(
																							'alt' => 'Profile Photo',
																							'width' => '45px',
																							'height' => '33px',
																							'style' => 'margin-left: 25px;margin-top: 15px;',
																							'url' => array(
																								'controller'=>'Companies',
																								'action'=>'searchCandidate',
																								'?' => array(
																											'intoFolder' => $folder['CompanyFolder']['id']
																								)
																						)));
												?>
												
												<?php 
													echo  '<span style="color: black;font-size: 15px;">'.$folder['CompanyFolder']['name'].'</span>';
												?>
												
												<div class="col-md-6 col-md-offset-4" style="margin-top: -20px;">  
													
													<?php echo $this->Form->create('Company', array(
																					'class' => 'form-horizontal', 
																					'role' => 'form',
																					'id' => 'formCompanyEditFolderId'.$folder['CompanyFolder']['id'],
																					'inputDefaults' => array(
																							'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																							'div' => array('class' => 'form-group'),
																							'class' => 'form-control',
																							'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
																							'between' => ' <div class="col-md-6">',
																							'after' => '</div></div>',
																							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																					),
																					'action' => 'editCompanyFolder',
																					
													)); ?>					
													
													<?php 	echo $this->Form->input('CompanyFolder.id', array(
																											'label' => '',
																											'value' => $folder['CompanyFolder']['id'],
																											'type' => 'hidden',
													));	?>
													<?php 	echo $this->Form->input('CompanyFolder.name', array(
																											'label' => '',
																											'id' => 'nameId'.$folder['CompanyFolder']['id'],
																											'type' => 'hidden',
													));	?>
													<?php 	echo $this->Form->input('CompanyFolderEdit.vista', array(
																											'label' => '',
																											'id' => 'Vista'.$folder['CompanyFolder']['id'],
																											'type' => 'hidden',
													));	?>
													
													<div class="blue col-xs-5 col-xs-offset-2">
														<?php 
														echo $this->Html->link('Renombrar',
																			'#',
																			array(
																				'class' => 'blue',
																				'onclick' =>'return editFolder('.$folder['CompanyFolder']['id'].',"'.$folder['CompanyFolder']['name'].'");',
																				'style' => 'margin-left:-53px;',
																				)
														);
														echo $this->Form->end(); 
														?>
													</div>
										
													<?php echo $this->Form->create('Company', array(
																					'class' => 'form-horizontal', 
																					'role' => 'form',
																					'id' => 'formCompanydeleteFolderId'.$folder['CompanyFolder']['id'],
																					'inputDefaults' => array(
																							'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																							'div' => array('class' => 'form-group'),
																							'class' => 'form-control',
																							'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
																							'between' => ' <div class="col-md-6">',
																							'after' => '</div></div>',
																							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																					),
																					'action' => 'deleteCompanyFolder',
																					
													)); ?>					
													
													<?php 	echo $this->Form->input('CompanyFolder.id', array(
																											'label' => '',
																											'value' => $folder['CompanyFolder']['id'],
																											'type' => 'hidden',
													));	?>
													<?php 	echo $this->Form->input('CompanyFolderDelete.vista', array(
																											'label' => '',
																											'id' => 'vistaDelete'.$folder['CompanyFolder']['id'],
																											'type' => 'hidden',
													));	?>
													
													<div class="red col-xs-4">
															<?php		
															echo $this->Html->link('Eliminar', 
																				'#',
																			array(
																				'class' => 'blue',
																				'onclick' =>'return deleteFolder('.$folder['CompanyFolder']['id'].',"'.$folder['CompanyFolder']['name'].'");',
																				'style' => 'margin-left:-10px;',
																				)
														);
														echo $this->Form->end(); 
														?>
													</div>
												</div>
											</div>
											<?php
												endforeach;
											?>
											
										</ul>    
					
										<?php endif; ?>
					
									</div>
									</nav>  
								</div>	
								<!--/div-->
							</td>
	
							<td style="" valign="top">
							<div style="padding-left: 0px; padding-right: 0px; text-align: left">
							
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='profile') || ($this->params['action']=='Profile') )):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px;" >Perfil</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='companyContact') )):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px;" >Actualizar datos de registro</a>
								<?php 
									endif; 
								?>
								
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='companyTelephoneNotification') )):
								?>
									<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px;" >Notificación telefónica</a>
								<?php 
									endif; 
								?>
								
								<?php 
									if(!empty($this->params['action']) && (($this->params['action']=='companyJobOffer') || ($this->params['action']=='companyJobProfile') || ($this->params['action']=='CompanyJobProfile') || ($this->params['action']=='companyJobContractType') || ($this->params['action']=='CompanyJobContractType') || ($this->params['action']=='companyCandidateProfile') || ($this->params['action']=='CompanyCandidateProfile') || ($this->params['action']=='companyJobKnowledge'))):
								?>

									<?php 
										if(!empty($this->params['action']) && (($this->params['action']=='companyJobOffer') || ($this->params['action']=='companyCandidateProfile') || ($this->params['action']=='CompanyCandidateProfile') || ($this->params['action']=='companyJobProfile') || ($this->params['action']=='CompanyJobProfile') || ($this->params['action']=='companyJobContractType') || ($this->params['action']=='CompanyJobContractType') || ($this->params['action']=='companyJobKnowledge'))):
									?>
										<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;" >Registrar Ofertas</a>
									<?php 
										endif; 
									?>
									
									<div class="panel panel-default" style=" background-color: transparent; box-shadow: none; min-width: 448px;">
										<div class="panel-body" style="padding: 0;">
											<div class="container" style="padding-left: 0; padding-right: 0; width: 100%; " >
												<ul class="nav nav-tabs" style="background-color: #93b2ff; text-align: center; max-width:1020px; width: 1020px;  padding-top: 50px;">
													<li style="width: 240px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='companyJobOffer')  )? 'menu-profile active' : 'menu-profile' ?> "	>
														<?php if(($this->Session->check('CompanyJobOffer.id') == true)): ?>
															<?php echo $this->Html->link(
																'Datos del responsable <br> de la oferta',	
																	array(
																		'controller'=>'Companies',
																		'action' => 'companyJobOffer'
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px;',
																	'escape' => false,
																)); 
															?>
														<?php else: ?>
															<?php echo $this->Html->link(
																'Datos del responsable <br> de la oferta',	
																	array(
																		'action'=>''
																		), 
																array(
																	'class' => 'corriculumMenu',
																	'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px; cursor:not-allowed',
																	'escape' => false,
																	'onclick' => 'return false',
																)); 
															?>
														<?php endif; ?>
													</li>
													<li style="width: 240px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='companyJobContractType') || ($this->params['action']=='CompanyJobContractType') || ($this->params['action']=='editStudentJobSkill') || ($this->params['action']=='viewStudentJobSkill') || ($this->params['action']=='editStudentLenguage') || ($this->params['action']=='viewStudentLenguage') || ($this->params['action']=='editStudentTechnologicalKnowledge') || ($this->params['action']=='viewStudentTechnologicalKnowledge'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
														<?php if($this->Session->check('companyJobContractType.id') == true): ?>
															<?php echo $this->Html->link(
																'Modalidad de Contratación', 
																array(
																	'controller'=>'Companies',
																	'action' => 'companyJobContractType'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'escape' => false,
																)
															); ?>
														<?php else: ?>
															<?php echo $this->Html->link(
																'Modalidad de Contratación', 
																array(
																	'action'=>''
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' => 'cursor:not-allowed',
																	'escape' => false,
																	'onclick' => 'return false',
																)
															); ?>
														<?php endif; ?>
															
													</li>
													<li style="width: 240px;" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='companyJobKnowledge')  )? 'menu-profile active' : 'menu-profile' ?> "	>
														<?php if($this->Session->check('CompanyCandidateProfile.id') == true): ?>
															<?php echo $this->Html->link(
																'Conocimientos y Habilidades <br> Profesionales',		
																array(
																	'controller'=>'Companies',
																	'action' => 'companyJobKnowledge'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px;',
																	'escape' => false,
																)
															); ?>
														<?php else: ?>
															<?php echo $this->Html->link(
																'Conocimientos y Habilidades <br> Profesionales',		
																array(
																	'action'=>''
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px; cursor:not-allowed',
																	'escape' => false,
																	'onclick' => 'return false',
																)
															); ?>
														<?php endif; ?>
													</li>
													<br/><br/><br/><br/>
													<li style="width: 240px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='companyJobProfile') || ($this->params['action']=='CompanyJobProfile') || ($this->params['action']=='editStudentProfessionalProfile') || ($this->params['action']=='viewStudentProfessionalProfile'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
														<?php if($this->Session->check('CompanyJobProfile.id') == true): ?>
															<?php echo $this->Html->link(
																'Perfil de la Oferta', 
																array(
																	'controller'=>'Companies',
																	'action' => 'companyJobProfile'
																	),
																array(
																	'class' => 'corriculumMenu',
																	'escape' => false,
																	'title' => 'Para avanzar pulse en continuar.'
																)
															);   ?>
														<?php else: ?>
															<?php echo $this->Html->link(
																'Perfil de la Oferta', 
																array(
																	'action'=>''
																	),
																array(
																	'class' => 'corriculumMenu',
																	'style' => 'cursor:not-allowed',
																	'escape' => false,
																	'onclick' => 'return false',
																	'title' => 'Para avanzar pulse en continuar.'
																)
															);   ?>
														<?php endif; ?>
													</li>
													<li style="width: 240px;" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='companyCandidateProfile') || ($this->params['action']=='CompanyCandidateProfile') || ($this->params['action']=='editStudentProfessionalExperience') || ($this->params['action']=='editStudentWorkArea') || ($this->params['action']=='viewStudentProfessionalExperience'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
													<?php if($this->Session->check('CompanyCandidateProfile.id') == true): ?>
														<?php echo $this->Html->link(
															'Perfil del Candidato', 
															array(
																'controller'=>'Companies',
																'action' => 'companyCandidateProfile'
																),
															array(
																'class' => 'corriculumMenu',
																'escape' => false,
																'title' => 'Para avanzar pulse en continuar.'
															)
														);  ?>
													<?php else: ?>
														<?php echo $this->Html->link(
															'Perfil del Candidato', 
															array(
																'action'=>''
																),
															array(
																'class' => 'corriculumMenu',
																'style' => 'cursor:not-allowed',
																'escape' => false,
																'onclick' => 'return false',
																'title' => 'Para avanzar pulse en continuar.'
															)
														);  ?>
													<?php endif; ?>
													</li>
													<?php if($this->Session->read('Editando') == 1): ?>
													<li style="width: 240px;" class="menu-profile"	>
														<?php 
															echo $this->Html->link('Finalizar Edición &nbsp;&nbsp; <i class="glyphicon glyphicon-remove-sign"></i>', 
																					array(
																						'controller'=>'Companies',
																						'action' => 'Profile'
																						),
																					array(
																						'class' => 'corriculumMenu myclass',
																						'escape' => false,
																						'style' => 'background-color: #9C0000; border-radius: 10px;',
																						
																					)
															);  
														?>
													</li>
													<?php endif; ?>
													<br/><br/><br/>
												</ul>	
											</div>
										</div>
									</div>
							
								<?php 
									endif; 
								?>
								
							<?php 
								if(!empty($this->params['action']) && (($this->params['action']=='viewOfferOnline') || ($this->params['action']=='viewOfferPdf'))):
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
												<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0; padding-left: 15px; width: 100%; height: 30px; padding-top: 5px;" >Registar ofertas</a>
												<div id="main-nav" class="collapse navbar-collapse" style="margin-top: 35px;" >
													<ul class="nav navbar-nav navbar-right" style="margin-left: 25px;">
													<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='viewOfferOnline')  )? 'active border-li' : 'border-li' ?> "	>
													<?php 
														if($this->Session->read('companyJobProfileId') <> ''):
															$vista = 'viewOfferOnline/'.$this->Session->read('companyJobProfileId');
														else:
															$vista = 'profile';
														endif;
														echo $this->Html->link(
																			'Vista en linea', 
																					array(
																						'controller'=>'Companies',
																						'action'=>$vista ),
																					array(
																					'class' => 'corriculumMenu',
																					)
																		); 
													?></li>
													<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='viewOfferPdf')   )? 'active border-li' : 'border-li' ?> ">
													<?php 
														if($this->Session->read('companyJobProfileId') <> ''):
															$vista = 'viewOfferPdf/'.$this->Session->read('companyJobProfileId');
														else:
															$vista = 'profile';
														endif;
													echo $this->Html->link(
																		'Vista previa impresión', 
																				array(
																					'controller'=>'Companies',
																					'action'=>$vista ),
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
								if(!empty($this->params['action']) && (($this->params['action']=='studentReport') || (($this->params['action']=='companyExternalOffer')))):
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
																	<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0; padding-left: 15px; width: 100%; height: 30px; padding-top: 5px;" >Reportar Contrataciones</a>
																	<div id="main-nav" class="collapse navbar-collapse" style="margin-top: 35px;" >
																		<ul class="nav navbar-nav navbar-right" style="margin-left: 25px;">
																		<li style="margin:5px 129px 10px"  class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='studentReport')  )? 'active border-li' : 'border-li' ?> "	>
																		<?php echo $this->Html->link('Ofertas Postuladas', 
																									array(
																										'controller'=>'Companies',
																										'action'=>'studentReport',
																										'?' => array(
																													'nuevaBusqueda' => 'nuevaBusqueda',
																													)
																										),
																									array(
																									'class' => 'corriculumMenu',
																									)
																		); 
																		?></li>
																		<li style="margin:5px 129px 10px"  class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='companyExternalOffer'))  )? 'active border-li' : 'border-li' ?> ">
																		<?php 
																		echo $this->Html->link('Ofertas externas', 
																									array(
																										'controller'=>'Companies',
																										'action'=>'companyExternalOffer'),
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
			if(!empty($this->params['action']) && (($this->params['action']=='searchCandidate') || (($this->params['action']=='viewCvOnline')) || (($this->params['action']=='specificSearchCandidate')) || (($this->params['action']=='specificSearchCandidateResults')))):
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
													<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='specificSearchCandidate')) || (($this->params['action']=='specificSearchCandidateResults')))? 'active border-li' : 'border-li' ?> ">
													<?php 
													echo $this->Html->link(
														'Búsqueda específica', 
														array(
															'controller'=>'Companies',
															'action'=>'specificSearchCandidate', 'nuevaBusqueda'),
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
								if(!empty($this->params['action']) && (($this->params['action']=='companyPostullation') || ($this->params['action']=='companyNotification'))):
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
												<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0; padding-left: 15px; width: 100%; height: 30px; padding-top: 5px;" >Notificaciones</a>
												<div id="main-nav" class="collapse navbar-collapse" style="margin-top: 35px;" >
													<ul class="nav navbar-nav navbar-right" style="margin-left: 25px;">
													<li style="margin:5px 129px 10px"  class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='companyPostullation') )? 'active border-li' : 'border-li' ?> "	>
													<?php echo $this->Html->link(
														'Postulaciones', 
														array(
															'controller'=>'Companies',
															'action'=>'companyPostullation','nuevaBusqueda'),
														array(
														'class' => 'corriculumMenu',
														)
													); 
													?></li>
													<li style="margin:5px 129px 10px" class="<?php echo (!empty($this->params['action']) && (($this->params['action']=='companyNotification') )  )? 'active border-li' : 'border-li' ?> ">
													<?php 
													echo $this->Html->link(
														'Entrevistas', 
														array(
															'controller'=>'Companies',
															'action'=>'companyNotification'),
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
							
							<?php if(!empty($this->params['action']) && (($this->params['action']=='updateRegister') )): ?>
								<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;" >Logo de la empresa</a>
							<?php endif; ?>
							
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
		<p style="color:#7fa4ff; font-size: 0.96em; line-height:18px; text-align: justify; ">
En ningún caso la UNAM, sus dependencias, sus directores y/o empleados, serán responsables por daños directos, perjuicios, o cualquier otro daño de algún tipo, que surja de alguna manera, relacionada con la imposibilidad de usar el portal, así como cualquier error de publicación de datos por parte de los Universitarios al ingresar su currículo y consultar ofertas de trabajo e información profesional. Igualmente por parte de empresas que busquen candidatos que se encuentren registrados en la base de datos del SISBUT, o al publicar datos erróneos de ofertas de empleo, por lo que la UNAM se deslinda de cualquier supuesto descrito anteriormente.
			</p>
			<div class="col-md-12">
				<div class="col-md-5">
				<?php 
					if(!empty($this->params['action']) && (($this->params['action']<>'profile') && ($this->params['action']<>'viewCvOnline') && ($this->params['action']<>'CompanyContact') && (($this->params['action']<>'disableCompanyRegister')) && ($this->params['action']<>'searchCandidate') && ($this->params['action']<>'viewOfferOnline') && ($this->params['action']<>'companyJobKnowledge') && ($this->params['action']<>'Profile') && ($this->params['action']<>'offerAdmin') && ($this->params['action']<>'companyNotification'))):
				?>
					<p style="text-align: left;"><span style="color:red;">*</span>Campo obligatorio</p>
				<?php else: ?>
					<p></p>
				<?php endif; ?>
				</div>
				<div class="col-md-2">
						<p><a href="#" data-toggle="modal" data-target="#myModalaviso" style="color:#7fa4ff; text-decoration: underline; top: 2%;">Aviso de Privacidad</a></p>
						<div class="col-md-12">
							<div id="myModalaviso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog" >
								<div class="modal-content backgroundUNAM" style="width: 890px; margin-left: -150px;">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel" style=" text-align: left;">Aviso de privacidad</h4>
									</div>
									<div class="modal-body" style="height: 600px;">		
								 <iframe src="http://docs.google.com/gview?url=http://bolsa.trabajo.unam.mx/unam/app/webroot/files/pdf/Aviso de privacidad SISBUT.pdf&embedded=true" width="100%" height="100%" frameborder="0" allowtransparency="true"></iframe>  
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btnBlue" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							  </div>
							</div>
						</div>
				</div>
				<?php 
						if(!empty($this->params['action']) && ($this->params['action']=='disableCompanyRegister') ): 
					?>	
					<div class="col-md-5">
						<p style="float: right;"><a href="#" style="color:#7fa4ff; text-decoration: underline; top: 2%;">Contacto administrador SISBUT UNAM</a></p>
					</div>
					<?php endif; ?>
							
					<div class="col-md-12">
						<hr style="border-color: red; color: red; border-width: 4px 0 0;  margin-top: 0px;" size=1>
					</div>
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
									<h4 class="modal-title" id="myModalLabel">Seleccione en qué carpeta desea guardar el candidato</h4>
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
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
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
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
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