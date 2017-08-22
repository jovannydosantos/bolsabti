<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?= $this->Html->charset(); ?>

	<title> <?= 'Bolsa bti' ?> </title>

	<?= $this->Html->meta(array(
		'name' => 'viewport', 
		'content' => 'width=device-width, initial-scale=1', 
		'http-equiv' => "X-UA-Compatible"
		)); ?>

	<?= $this->Html->meta ( 'favicon.ico', '/img/SISBUTicon.png', array (
		'type' => 'icon' 
		) ); ?>

	<?= $this->Html->css(['bootstrap-select.min','bootstrap.min','fileinput.min','bootstrap-responsive.min','btiStyle','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css','//cdn.datatables.net/1.10.15/css/jquery.dataTables.css']) ?>
	<?= $this->Html->script(['jquery-3.1.1.min','bootstrap.min','fileinput.min','bootstrap-select.min','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js','//cdn.datatables.net/1.10.15/js/jquery.dataTables.js']) ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>	

	<script>

		function caracteresCont(id, cont, max){	
			init_contadorTa(id,cont, max);
			updateContadorTa(id,cont, max);
		}

		function deletePhoto(){
			$.confirm({
			    title: 'Confirmación!',
			    icon: 'glyphicon glyphicon-warning-sign',
			    type: 'red',
			    content: '¿Realmente desea eliminar la foto de perfil?',
			    buttons: {
			        aceptar: function () {
			           $("#deletePhotoId").click();
			        },
			        cancelar: function () {
			            // $.alert('Opción cancelada!');
			        },
			    }
			});
		}

		function addNameFolder(){
			$.confirm({
				    title: 'Carpeta!',
				    theme: 'supervan',
				    content: '' +
				    '<form action="" class="formName">' +
				    '<div class="form-group">' +
				    '<label>Crear carpeta</label>' +
				    '<input type="text" placeholder="Nombre de carpeta" class="name form-control" required />' +
				    '</div>' +
				    '</form>',
				    buttons: {
				        formSubmit: {
				            text: 'Crear',
				            btnClass: 'btn-blue',
				            action: function () {
				                var name = this.$content.find('.name').val();
				                if(!name){
				                    $.alert('Ingresa un nombre de carpeta');
				                    return false;
				                }
				                // $.alert('Your name is ' + name);
				                document.getElementById("StudentFolderVista").value = vista();
								document.getElementById("StudentFolderName").value = name;
								document.getElementById("StudentStudentFolderForm").submit();
				            }
				        },
				        cancel: function () {
				            //close
				        },
				    },
				    onContentReady: function () {
				        // bind to events
				        var jc = this;
				        this.$content.find('form').on('submit', function (e) {
				            // if the user submits the form by pressing enter in the field.
				            e.preventDefault();
				            jc.$$formSubmit.trigger('click'); // reference the button and click it
				        });
				    }
				});
		}

		function editFolder(id, folderName){
			document.getElementById("Vista"+id).value = vista();

			$.confirm({
				    title: 'Carpeta!',
				    theme: 'supervan',
				    content: '' +
				    '<form action="" class="formName">' +
				    '<div class="form-group">' +
				    '<label>Renombrar carpeta</label>' +
				    '<input type="text" placeholder="Nombre de carpeta" class="name form-control" value="'+folderName+'" required />' +
				    '</div>' +
				    '</form>',
				    buttons: {
				        formSubmit: {
				            text: 'Renombrar',
				            btnClass: 'btn-blue',
				            action: function () {
				                var name = this.$content.find('.name').val();
				                if(!name){
				                    $.alert('Ingresa un nombre de carpeta');
				                    return false;
				                }
				                document.getElementById("nameId"+id).value = name;
				                document.getElementById("formStudentEditFolderId"+id).submit();
				                return false;
				            }
				        },
				        cancel: function () {
				            // $.alert('Opción cancelada!');
				        },
				    },
				    onContentReady: function () {
				        // bind to events
				        var jc = this;
				        this.$content.find('form').on('submit', function (e) {
				            // if the user submits the form by pressing enter in the field.
				            e.preventDefault();
				            jc.$$formSubmit.trigger('click'); // reference the button and click it
				        });
				    }
				});
		}

		function deleteFolder(id, folderName){
			$.confirm({
			    title: 'Confirmación!',
			    icon: 'glyphicon glyphicon-warning-sign',
			    type: 'red',
			    content: '¿Realmente desea eliminar esta carpeta "'+folderName+'"?',
			    buttons: {
			        aceptar: function () {
			            document.getElementById("vistaDelete"+id).value = vista();
						document.getElementById("formStudentdeleteFolderId"+id).submit();
			        },
			        cancelar: function () {
			            // $.alert('Opción cancelada!');
			        },
			    }
			});
		}

		function vista(){
			var mystr = window.location.href.toString().split(window.location.host)[1]
			var myarr = mystr.split("/");
			var vista = myarr[myarr.length-1];
			if(vista=='nuevaBusqueda'){
				vista=myarr[myarr.length-2];
			}
			return vista;
		}

		function saveOffer(CompanyJobProfileId, redirect){
			var mystr = window.location.href;
			var myarr = mystr.split("/");
			var vista = myarr[myarr.length-1];

			if(vista=='nuevaBusqueda'){
				vista=myarr[myarr.length-2]+ '/'+myarr[myarr.length-1];
			}else if (!isNaN(vista)){
				vista=myarr[myarr.length-2]+ '/'+myarr[myarr.length-1];
			} else{
				vista=myarr[myarr.length-1];
			}

			document.getElementById('StudentSavedOfferCompanyJobProfileId').value = CompanyJobProfileId;
			document.getElementById('StudentSavedOfferRedirect').value = vista;
			$('#myModal1').modal('show');
		}

		function nuevaFechaEntrevista(id, company_job_profile_id){
			document.getElementById('StudentNotificationId').value = id;
			document.getElementById('StudentNotificationCompanyJobProfileId').value = company_job_profile_id;
			$('#myModalnotification').modal('show');
			return false;
		}

		function validaFormSaveOffer(){
			var valor = document.getElementById("StudentSavedOfferStudentFolderId").value;
			if (valor ==''){
				jAlert('Seleccione la carpeta donde se guardará la oferta');
				document.getElementById("StudentSavedOfferStudentFolderId").focus;
				return false;
			} else {
				return true;
			}
		}

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

	</script>

</head>

<body style="background-color: #e8e8e8;">

	<div class="body-wrap">
	    <nav class="navbar navbar-inverse" role="navigation" >
	      <div class="container-fluid">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <?= $this->Html->link($this->Html->image('logo.png', array('alt' => 'Background-image', 'style'=>'width: 61px;height: 50px;position: absolute;top: 0px;left: 0px')),
												['controller' => 'Students',
												'action' => 'profile'],
												['escape' => false,
												'style'=>'width: 65px;',
												'class'=>'navbar-brand']
											); ?>
	        </div>

	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	          <ul class="nav navbar-nav navbar-right">
	           
				<li><?= $this->Html->link('<span class="glyphicon glyphicon-search"></span> Buscar Ofertas', 
																	['controller'=>'Students',
																	'action' => 'searchOffer', 'nuevaBusqueda'], 
																	['escape' => false]);?>
				</li>
				<li><?= $this->Html->link('<span class="glyphicon glyphicon-bell"></span> Notificaciones <span style="margin-left: 5px;">'.$notificaciones.'</span>', 
																	['controller'=>'Students',
																	'action' => 'studentNotification'], 
																	['escape' => false]);?>
				</li>
				<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Mi Currículum <b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-file"></span> Ver mi CV', 
																	['controller'=>'Students',
																	'action' => 'viewCvOnline'], 
																	['escape' => false]);?>
					</li>
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-edit"></span> Actualizar', 
																	['controller'=>'Students',
																	'action' => 'studentProfile'],
																	['escape' => false]);?>
					</li>
	                <li class="divider"></li>
	                <?php 
						if($student['Student']['block']==1):
							$mensajeStatus = 'Su currículum aparecerá en las búsquedas que realicen los reclutadores y que coincidan con su perfil profesional.';
						else:
							$mensajeStatus = 'Su currículum no aparecerá en las búsquedas que realicen los reclutadores, pero usted podrá actualizar su currículum y seguir postulándose a ofertas laborales.';
						endif;
					?>
					<li class="dropdown whiteText" data-toggle="tooltip" data-placement="bottom" title="<?php echo $mensajeStatus; ?>">
						<?php 
							if($student['Student']['block']==1):
								$block = 'Activar CV';
							else:
								$block = 'Desactivar CV';
							endif;
							
							echo $this->Html->link('<span class="glyphicon glyphicon-off"></span> '.$block, 
									['controller'=>'Students',
									'action'=>'block', $this->Session->read('student_id')],
									['escape' => false]); 
						?>
					</li>	  
	              </ul>
	            </li>							
	            <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opciones <b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-user"></span> Mi Perfil', 
																	['controller'=>'Students',
																	'action' => 'profile'], 
																	['escape' => false]);?>
					</li>
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-lock"></span> Modificar Contraseña', 
																	['controller'=>'Students',
																	'action' => 'changePassword'],
																	['escape' => false]);?>
					</li>
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-remove"></span> Eliminar Registro', 
																	['controller'=>'Students',
																	'action' => 'disableStudentRegister'],
																	['escape' => false]);?>
					</li>
	                <li class="divider"></li>
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión', 
																	['controller'=>'Students',
																		'action' => 'logout'], 
																	['escape' => false]);?>
					</li>
	              </ul>
	            </li>
	          </ul>
	        </div>
	      </div>
	    </nav>
	</div>

	<div id="loading" class="modal">			
		<div class="progress" style="border-radius: 0px;">
			<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				<strong style="font-size: 14px;">Cargando catálogos...</strong>
			</div>
		</div>
	</div>

	<?php 
		if(!isset($vista)):
			 $vista = '';
		endif;
	?>

	<?php 
		if($this->Session->check('editingAdmin')):
			if($this->Session->read('editingAdmin') == 'yes'):
	?>
				<header class="nav-down" >
					<div class="col-md-12" style="margin-top: 4px; ">
						<?= $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i>&nbsp; Volver como administrador', 
																['controller'=>'Administrators',
																'action'=>$this->Session->read('redirectAdmin')],
																['class' => 'btn btn-default btnRed ',
																'style' => 'width: 250px; float: right;',
																'escape' => false]	
						);?> 
					</div>
				</header>
	<?php 
			endif;
		endif;
	?>

	<!--Modal foto de perfil-->
	<div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
	    <div class="modal-dialog modal-md" role="document" style="max-width: 450px;">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	        </div>
	        <div class="modal-body">
        		<img src="" class="enlargeImageModalSource" style="width: 100%;">
	          	<div class="col-md-2 col-md-offset-3" style="margin-top: 30px">
					<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp; Eliminar','#',[
										'style' => 'cursor: pointer;',
										'class' => 'btn btn-danger',
										'id' => 'focusPhotoId',
										'onclick' => 'deletePhoto();',
										'escape' => false,
										]); ?>
				</div>
				<div class="col-md-2 col-md-offset-1" style="margin-top: 30px">
						 <?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp;Cambiar',
														['controller'=>'Students',
														'action'=>'updateRegister', $this->Session->read('student_id')],
														['class' => 'btn btn-success',
														'escape' => false]); ?>
				</div>
	        </div>
	      </div>
	    </div>
	</div>

	<!--Menú lateral-->
    <div class="body-wrap"" style="background-color: #f8f8f8">
		<div class="col-md-2" style="padding-right: 0px;">
			<div class="profile-sidebar">
				<div class="profile-userpic visible-lg visible-md">
					<?php
						$path = WWW_ROOT.'img'.DS.'uploads'.DS.'student'.DS.'filename'.DS;
						if (isset($student) and isset($student['Student']['filename']) and ($student['Student']['filename'] <> '' and file_exists($path.$student['Student']['filename']))):
							echo $this->Html->image('uploads/student/filename/'.$student['Student']['filename'],
														['alt' => 'Cargar Foto de Perfil',
														'width' => '70%',
														'class' => 'img-responsive',
														'height' => '70%',
														'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 5px;',
														'id'=>'fotoPerfil']);
						else:
							echo $this->Html->image('http://ofcoursesocial.com/wp-content/uploads/2017/06/7.png',
														['alt' => 'Cargar Foto de Perfil',
														'width' => '70%',
														'height' => '70%',
														'class' => 'img-responsive',
														'style' => 'box-shadow: 1px 7px 10px #000; border-radius: 5px;',
														'id'=>'fotoPerfil']);
						endif;
										
					?>
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php 
							if(isset($student['StudentProfile']['name'])):
								echo $student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' '.$student['StudentProfile']['second_last_name'];
							endif;
						?>
					</div>
				</div>
				<div class="profile-usermenu">
					<ul class="nav">

						<?php if($statusCV == true): ?>

						<li <?= (!empty($this->params['action']) && ($this->params['action']=='studentContact') )? 'class="active" ' : ''; ?> >  
							<?= $this->Html->link('<i class="glyphicon glyphicon-envelope"></i> Enviar mi Currículum', 
															['controller'=>'Students',
															'action' => 'studentContact', $this->Session->read('student_id')],
															['escape'=> false ]
							);?>
						</li>

						<li <?= (!empty($this->params['action']) && (($this->params['action']=='report')  || ($this->params['action']=='studentExternalOffer')))? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="glyphicon glyphicon-hand-right"></i> Reportar Contrataciones', 
															['controller'=>'Students',
																'action'=>'report',  'nuevaBusqueda'],
															['escape'=>false]
							);?>
						</li>

						<li <?= (!empty($this->params['action']) && ($this->params['action']=='offerAdmin') )? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i> Administrar Ofertas Guardadas', 
															['controller'=>'Students',
															'action' => 'offerAdmin','nuevaBusqueda'], 
															['escape'=>false]
							);?>
						</li>

						<li>
							<div class="col-md-12" style="background-color: #e8e8e8;">
								<p style="text-align: left;font-weight: bold;font-size: 14px;color: rgb(26, 117, 187);margin-top: 10px;">Administrador de ofertas</p>
							</div>
						</li>
						
						<li>
							<?= $this->Form->create('Student', ['class' => 'form-horizontal', 
																'role' => 'form',
																'inputDefaults' => [
																		'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
																		'div' => ['class' => 'form-group', 'style'=>'margin-bottom: 10px;margin-top: 10px;'],
																		'class' => 'form-control',
																		'label' => '',
																		'between' => ' <div class="col-md-12">',
																		'after' => '</div></div>',
																		'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline jAlert jAlert-warning margin-reduce']]
																],
																'onsubmit' =>'addNameFolder(); return false;',
																'action' => 'studentFolder',
									]); ?>					
									
									<?= $this->Form->input('StudentFolder.name',['type'=> 'hidden']); ?>
									<?= $this->Form->input('StudentFolder.vista',['type'=> 'hidden']); ?>
									<div>
										<?= $this->Form->button('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Nueva carpeta',[
																				'type' => 'submit',
																				'class' => 'btn btn-success btn-sm',
																				'style' => 'width: 100%',
																				'escape' => false]); ?>
									</div>
									<?= $this->Form->end(); ?>
						</li>
			
						<?php foreach($folders as $k => $folder):?>
							<li style="height: 50px;">
								<div class="col-md-12" style="padding-left: 0px;padding-right: 0px;margin-top: 15px;">
									<div class="col-md-8" style="padding-left: 5px;padding-right: 5px;">
									<?php
										if(isset($intoFolder)):
											if($intoFolder == $folder['StudentFolder']['id']):
												$colorCarpeta = '<span class="glyphicon glyphicon-folder-open"></span>&nbsp;';
											else:
												$colorCarpeta = '<span class="glyphicon glyphicon-folder-close"></span>&nbsp;';
											endif;
										else:
											$colorCarpeta = '<span class="glyphicon glyphicon-folder-close"></span>&nbsp;';
										endif;
									?>
									
									<?= $this->Html->link($colorCarpeta.'<span style="font-size: 15px;">'. $folder['StudentFolder']['name'].'</span>', [  
																		'controller'=>'students',
																		'action'=>'offerAdmin',
																		'?' => ['intoFolder' => $folder['StudentFolder']['id'],'newFolderSelected' => 'yes']		
																		],
																		['escape' => false
																]); ?>

									
									</div>
									<div class="col-md-2" style="padding-left: 5px;padding-right: 5px;">
										<?= $this->Form->create('Student', array(
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'id' => 'formStudentEditFolderId'.$folder['StudentFolder']['id'],
																		'inputDefaults' => [
																				'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
																				'div' => ['class' => 'form-group'],
																				'class' => 'form-control',
																				'label' => '',
																				'before' => '<div class="col-md-12">',
																				'between' => ' <div class="col-md-6">',
																				'after' => '</div></div>',
																				'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline margin-reduce']]
																		],
																		'action' => 'editStudentFolder',
																		
										)); ?>					
										
										<?= $this->Form->input('StudentFolder.id',['type'=> 'hidden','value' => $folder['StudentFolder']['id']]); ?>
										<?= $this->Form->input('StudentFolder.name',['type'=> 'hidden','id' => 'nameId'.$folder['StudentFolder']['id']]); ?>
										<?= $this->Form->input('StudentFolder.vista',['type'=> 'hidden','id' => 'Vista'.$folder['StudentFolder']['id']]); ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>&nbsp;','#',[ 
																		'onclick' =>"return editFolder(".$folder['StudentFolder']['id'].",'".$folder['StudentFolder']['name']."');",
																		'escape'=> false
																		]);?>
										<?= $this->Form->end(); ?>
									</div>
									<div class="col-md-2" style="padding-left: 5px;padding-right: 5px;">
										<?php echo $this->Form->create('Student', [
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'id' => 'formStudentdeleteFolderId'.$folder['StudentFolder']['id'],
																		'inputDefaults' => [
																				'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
																				'div' => ['class' => 'form-group'],
																				'class' => 'form-control',
																				'before' => '<div class="col-md-12">',
																				'between' => ' <div class="col-md-6">',
																				'after' => '</div></div>',
																				'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline margin-reduce']]
																		],
																		'action' => 'deleteStudentFolder',
																		
										]); ?>					
										<?= $this->Form->input('StudentFolder.id',['type'=> 'hidden','value' => $folder['StudentFolder']['id']]); ?>
										<?= $this->Form->input('StudentFolder.vista',['type'=> 'hidden','id' => 'vistaDelete'.$folder['StudentFolder']['id']]); ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-remove"></span>&nbsp;', '#',[
																'onclick' =>"return deleteFolder(".$folder['StudentFolder']['id'].",'".$folder['StudentFolder']['name']."');",
																'escape'=> false
																]);?>
										<?= $this->Form->end(); ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>

						<?php endif; ?>
						
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-10">
            <div class="profile-content col-md-12" style="margin-bottom: 50px;">

				<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">

					<?php if(!empty($this->params['action']) && (($this->params['action']=='report') || (($this->params['action']=='studentExternalOffer')))): ?>
						<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
						  <div class="container-fluid">
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						      <a class="navbar-brand" href="#">REPORTAR CONTRATACIONES:</a>
						    </div>

						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
						      <ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='report')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Ofertas a las que me Postulé',['controller'=>'Students','action'=>'report',  'nuevaBusqueda']); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentExternalOffer')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Ofertas externas', ['controller'=>'Students','action'=>'studentExternalOffer']); ?>
								</li>
							  </ul>	
							</div>
						  </div>
				        </nav>
					<?php endif; ?>
					
					<?php if(!empty($this->params['action']) && (($this->params['action']=='usuario') || ($this->params['action']=='viewCvOnline'))): ?>
						<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
						  <div class="container-fluid">
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						      <a class="navbar-brand" href="#">Ver mi currículum:</a>
						    </div>

						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
						      <ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='viewCvOnline')  )? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Vista en línea',['controller'=>'Students','action'=>'viewCvOnline']); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='usuario') || ($this->params['action']=='editStudentProfessionalProfile') || ($this->params['action']=='viewStudentProfessionalProfile'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Vista previa impresión', ['controller'=>'Students','action'=>'usuario']); ?>
								</li>
							  </ul>	
							</div>
						  </div>
				        </nav>
					<?php endif; ?>
					
					<?php if(!empty($this->params['action']) && (($this->params['action']=='searchOffer') || ($this->params['action']=='specificSearch') || ($this->params['action']=='specificSearchResults') )): ?>
						<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
						  <div class="container-fluid">
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						      <a class="navbar-brand" href="#">BÚSQUEDA DE OFERTAS:</a>
						    </div>

						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
						      <ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='searchOffer')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Búsqueda Rápida',['controller'=>'Students','action'=>'searchOffer',  'nuevaBusqueda']); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='specificSearch') OR ($this->params['action']=='specificSearchResults')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Búsqueda Específica', ['controller'=>'Students','action'=>'specificSearch', 'nuevaBusqueda']); ?>
								</li>
							  </ul>	
							</div>
						  </div>
				        </nav>
					<?php endif; ?>
					
					<?php if(!empty($this->params['action']) && ($this->params['action']=='studentNotification')): ?>
						<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
						  <div class="container-fluid">
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						      <a class="navbar-brand" href="#">NOTIFICACIONES:</a>
						    </div>

						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
						      <ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='studentNotification') && ($this->Session->read('tipoNotificacion')==1))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-earphone"></i>&nbsp; Entrevistas telefónicas <span style="margin-left: 5px;">'.count($telefonicas).'</span>',['controller'=>'Students','action'=>'studentNotification', '?' => ['tipoNotificacion' => 1]],['escape' => false]); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='studentNotification') && ($this->Session->read('tipoNotificacion')==2))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-user"></i>&nbsp; Entrevistas presenciales <span style="margin-left: 5px;">'.count($presenciales).'</span>', ['controller'=>'Students','action'=>'studentNotification', '?' => ['tipoNotificacion' => 2]],['escape' => false]); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='studentNotification')&& ($this->Session->read('tipoNotificacion')==3))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-hand-left"></i>&nbsp; Contrataciones <span style="margin-left: 5px;">'.count($contrataciones).'</span>', ['controller'=>'Students','action'=>'studentNotification', '?' => ['tipoNotificacion' => 3]],['escape' => false]); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='studentNotification')&& ($this->Session->read('tipoNotificacion')==4))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-list"></i>&nbsp; Seguimiento de entrevistas <span style="margin-left: 5px;">'.count($seguimientos).'</span>', ['controller'=>'Students','action'=>'studentNotification', '?' => ['tipoNotificacion' => 4]],['escape' => false]); ?>
								</li>
							  </ul>	
							</div>
						  </div>
				        </nav>
					<?php endif; ?>

					<?php if(!empty($this->params['action']) && (($this->params['action']=='professional_profile_menu') || ($this->params['action']=='studentProfile') || ($this->params['action']=='studentJobSkill') || ($this->params['action']=='editStudentJobSkill') || ($this->params['action']=='viewStudentJobSkill') || ($this->params['action']=='editStudentLenguage') || ($this->params['action']=='viewStudentLenguage') || ($this->params['action']=='editStudentTechnologicalKnowledge') || ($this->params['action']=='viewStudentTechnologicalKnowledge') || ($this->params['action']=='studentProfessionalSkill') || ($this->params['action']=='studentProfessionalProfile') || ($this->params['action']=='editStudentProfessionalProfile') || ($this->params['action']=='viewStudentProfessionalProfile') || ($this->params['action']=='studentProfessionalExperience') || ($this->params['action']=='StudentProfessionalExperience') || ($this->params['action']=='editStudentProfessionalExperience') || ($this->params['action']=='editStudentWorkArea') || ($this->params['action']=='editStudentAchievement') || ($this->params['action']=='editStudentResponsability') || ($this->params['action']=='studentJobProspect') || ($this->params['action']=='studentAcademicProject')  || ($this->params['action']=='editStudentAcademicProject') || ($this->params['action']=='viewStudentProfessionalExperience') || ($this->params['action']=='studentProspect') || ($this->params['action']=='editStudentInterestJob')|| ($this->params['action']=='studentHeader'))): ?>
								<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
								  <div class="container-fluid">
								    <div class="navbar-header">
								      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
								        <span class="sr-only">Toggle navigation</span>
								        <span class="icon-bar"></span>
								        <span class="icon-bar"></span>
								        <span class="icon-bar"></span>
								      </button>
								      <a class="navbar-brand" href="#">ACTUALIZAR CURRÍCULUM:</a>
								    </div>

								    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
								      <ul class="nav navbar-nav">
										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentProfile')  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Datos Personales',['controller'=>'Students','action'=>'studentProfile']); ?>
										</li>

										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='studentProfessionalProfile') || ($this->params['action']=='editStudentProfessionalProfile') || ($this->params['action']=='viewStudentProfessionalProfile'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Formación Académica', ['controller'=>'Students','action'=>'studentProfessionalProfile',1]); ?>
										</li>

										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentJobProspect')  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Objetivo Profesional', ['controller'=>'Students','action'=>'studentJobProspect']);?>
										</li>

										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentJobSkill') || ($this->params['action']=='editStudentJobSkill') || ($this->params['action']=='viewStudentJobSkill') || ($this->params['action']=='editStudentLenguage') || ($this->params['action']=='viewStudentLenguage') || ($this->params['action']=='editStudentTechnologicalKnowledge') || ($this->params['action']=='viewStudentTechnologicalKnowledge')  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Conocimientos y Habilidades Profesionales', ['controller'=>'Students','action'=>'studentJobSkill', $this->Session->read('student_id')]);?>
										</li>
										
										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentProfessionalSkill')  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Competencias Profesionales', ['controller'=>'Students','action'=>'studentProfessionalSkill', $this->Session->read('student_id')]); ?>
										</li>

										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='studentProfessionalExperience') || ($this->params['action']=='StudentProfessionalExperience') || ($this->params['action']=='editStudentProfessionalExperience') || ($this->params['action']=='editStudentWorkArea') || ($this->params['action']=='editStudentAchievement') || ($this->params['action']=='editStudentResponsability') || ($this->params['action']=='viewStudentProfessionalExperience'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Experiencia Profesional', ['controller'=>'Students','action'=>'studentProfessionalExperience']); ?>
										</li>
										
										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='studentProspect')|| ($this->params['action']=='editStudentInterestJob'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Expectativas Laborales', ['controller'=>'Students','action'=>'studentProspect']); ?>
										</li>

										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentAcademicProject')  || ($this->params['action']=='editStudentAcademicProject') )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Proyectos Extracurriculares',['controller'=>'Students','action'=>'studentAcademicProject']); ?>
										</li>
										
										<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentHeader')  )? 'menu-profile active' : 'menu-profile' ?> "	>
											<?= $this->Html->link('Encabezado Currículum', ['controller'=>'Students','action'=>'studentHeader']); ?>
										</li>
									  </ul>	
									</div>
								  </div>
						        </nav>
					<?php endif; ?>
					
					<?php if(!empty($this->params['action']) && (($this->params['action']=='studentProfessionalProfile') || ($this->params['action']=='editStudentProfessionalProfile'))): ?>
							<nav class="navbar navbar-default">
							  <div class="container-fluid">
							    <div class="navbar-header">
							      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
							        <span class="sr-only">Toggle navigation</span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							      </button>
							      <a class="navbar-brand" href="#">Niveles Académicos:</a>
							    </div>

							    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
							      <ul class="nav navbar-nav">
							      	
										<li class="<?php echo (!empty($this->params['action']) && ($this->Session->read('tipoProfessionalProfile')==1)  )? 'active border-li' : 'border-li' ?> "	>
										<?= $this->Html->link('Licenciatura', 
																	['controller'=>'Students',
																	'action'=>'studentProfessionalProfile',1]); ?>
										</li>
										<li class="<?php echo (!empty($this->params['action']) && ($this->Session->read('tipoProfessionalProfile')==2)  )? 'active border-li' : 'border-li' ?> "	>
										<?= $this->Html->link('Especialidad', 
																	['controller'=>'Students',
																	'action'=>'studentProfessionalProfile',2]); ?>
										</li>
										<li class="<?php echo (!empty($this->params['action']) && ($this->Session->read('tipoProfessionalProfile')==3)  )? 'active border-li' : 'border-li' ?> "	>
										<?= $this->Html->link('Maestría', 
																	['controller'=>'Students',
																	'action'=>'studentProfessionalProfile',3]); ?>
										</li>
										<li class="<?php echo (!empty($this->params['action']) && ($this->Session->read('tipoProfessionalProfile')==4)  )? 'active border-li' : 'border-li' ?> "	>
										<?= $this->Html->link('Doctorado', 
																	['controller'=>'Students',
																	'action'=>'studentProfessionalProfile',4]); ?>
										</li>

								  </ul>
								</div>
							  </div>
						    </nav>
					<?php endif; ?>
					
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?> 
					<?= $this->element('paginacion'); ?>
						
				</div>
            </div>
		</div>
	</div>

	<!--Pie de página-->
	<div class="col-md-12 whiteText" style="text-align: center; background-color: #1a75bb; margin-top: 15px;  position:fixed;left:0px;bottom:0px;height:30px;width:100%;z-index: 1000;">
		<p style="margin: 7px;">Hecho en México, todos los derechos reservados.</p>
	</div>
						
	<!--Modal Formulario de selección de carpeas-->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title whiteText" id="myModalLabel">Seleccione en que carpeta desea guardar la oferta.</h4>
				</div>
				<div class="modal-body">
					<?= $this->Form->create('Student', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => [
											'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
											'div' => ['class' => 'form-group'],
											'class' => 'form-control',
											'before' => '<div class="col-md-12 ">',
											'between' => ' <div class="col-md-6">',
											'after' => '</div></div>',
											'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline jAlert jAlert-warning margin-reduce']]
									],
									'onsubmit' =>'return validaFormSaveOffer();',
									'action' => 'studentSavedOffer',
					]); ?>		
					<fieldset>
					<?= $this->Form->input('StudentSavedOffer.student_folder_id',['label'=>['text'=>'Carpetas disponibles','class'=>'col-md-5 control-label whiteText'], 'options' => $foldersList, 'default'=>'0','id' => 'estado','empty' => 'Selecciona una carpeta','class'=>'form-control selectpicker show-tick show-menu-arrow','required'=>'required']); ?>
					<?= $this->Form->input('StudentSavedOffer.company_job_profile_id',['type' => 'hidden']); ?>
					<?= $this->Form->input('StudentSavedOffer.redirect',['type' => 'hidden']); ?>
					</fieldset>
				</div>
				<div class="modal-footer">
					<?= $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',['type' => 'submit', 'div' => 'form-group','escape' => false,'class' => 'btn btn-default']); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
		
	<!--Modal Form para sugerir nueva fecha de entrevista-->
	<div class="modal fade" id="myModalnotification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" style="color: white;">Seleccione la fecha de propuesta para la entrevista</h4>
				</div>
				<div class="modal-body">
					<?= $this->Form->create('Student', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
										'between' => '<div class="col-md-12">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'studentNotification']); ?>			
	
					<fieldset>
						<?php 	echo $this->Form->input('StudentNotification.id');?>
						<?php 	echo $this->Form->input('StudentNotification.company_job_profile_id', ['type'=>'hidden']);?>
						<label style="font-weight: normal;margin-top: 3px; color: white;">Mensaje para el entrevistador:</label>
						<?= $this->Form->input('StudentNotification.student_interview_message', ['placeholder' => 'Mensaje','type'=>'textarea','class'=>'form-control logrosClass','style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;','maxlength' => '316', 'onkeypress'=> 'caracteresCont("StudentNotificationStudentInterviewMessage", "contadorNotificacion",316)']); ?>
						
						<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
							<span id="contadorNotificacion" style="color: white;">0/316</span><span style="color: white;"> caracteres máx.</span>
						</div>
						
						<label style="font-weight: normal;margin-top: 3px; color: white;">Fecha:</label>
						<?= $this->Form->input('StudentNotification.student_interview_date', [
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'data-width'=> '160px',
											'dateFormat' => 'YMD',
											'separator' => '',
											'minYear' => date('Y') - -1,
											'maxYear' => date('Y') - 0]); ?>
						
						<label style="font-weight: normal;margin-top: 3px; color: white;">Hora:</label>		
						<?= $this->Form->input('StudentNotification.student_interview_date', [
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'type' => 'time',
											'timeFormat' => '24',
											'interval' => 15,
											'data-width'=> '160px']);?>	

						</fieldset>
				</div>
				<div class="modal-footer">
					<?= $this->Form->button('<i class="glyphicon glyphicon-calendar"></i>&nbsp; Reagendar',['type' => 'button', 'div' => 'form-group','escape' => false,'class' => 'btn btn-default','onClick' => 'validateNotificationForm();']); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>

	<!--Modal Aviso de privacidad-->
	<div id="aviso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" >
		<div class="modal-content" >
			<div class="modal-header fondoBti">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" style="color: #fff;">Aviso de privacidad</h4>
			</div>
			<div class="modal-body fondoBti" style=" height: 70vh;">
					<iframe src="http://localhost/bolsabti/files/pdf/avisoPrivacidad.pdf" width="100%" height="100%" frameborder="0" allowtransparency="true">Your browser does not support inline frames or is currently configured not to display inline frames.</iframe>
			</div>
			<div class="modal-footer fondoBti">
				<button type="button" class="btn btn-default btnBlue" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	  </div>
	</div>

	<!--Modal Reportar Contratación-->
	<div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title whiteText" id="myModalLabel">Indique la fecha de contratación.</h4>
				</div>
				<div class="modal-body">
					<?= $this->Form->create('Student', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
										'between' => '<div class="col-md-12">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'report']); ?>
					<fieldset>
						
						<?= $this->Form->input('Report.company_job_profile_id',['type'=>'hidden']); ?>
						
						<label>Fecha de contratación</label>
						<?= $this->Form->input('Report.fecha_contratacion', [
												'class' => 'selectpicker show-tick form-control show-menu-arrow',
												'data-width'=> '180px',
												'dateFormat' => 'YMD',
												'separator' => '',
												'minYear' => date('Y') - 10,
												'maxYear' => date('Y') - 0,
												'after' => '<div class="col-md-3 text-center" style="margin-top: 5px;" id="idAge"></div></div>',
												'onchange'=> 'ageCalculator()']); ?>
					</fieldset>

					<div class="modal-footer">
						<?= $this->Form->button('Reportar &nbsp; &nbsp; <i class="glyphicon glyphicon-ok-sign"></i>',['type' => 'submit', 'div' => 'form-group','escape' => false,'class' => 'btn btn-default']); ?>
						<?= $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar Foto',							
													['controller'=>'Students',
													'action'=>'deleteRegister',$this->Session->read('Auth.User.id')],
													['class' => 'btn btn-danger',
														'escape' => false,
														'style' => 'display: none',
														'id' => 'deletePhotoId']); 	
	?>
	<script type="text/javascript">
       // $('.alert').animate({opacity: 1.0}, 4000).fadeOut(3000,"swing");  
       $('[data-toggle="tooltip"]').tooltip(); 

       $(function() {
	    	$('#fotoPerfil').on('click', function() {
				$('.enlargeImageModalSource').attr('src', $(this).attr('src'));
				$('#enlargeImageModal').modal('show');
			});
		});

        function confirma(id){
		 	$.confirm({
				    title: 'Confirmación!',
				    icon: 'glyphicon glyphicon-warning-sign',
				    type: 'red',
				    content: '¿Realmente desea eliminar este registro?',
				    buttons: {
				        aceptar: function () {
							document.getElementById("eliminar"+id).click();
				        },
				        cancelar: function () {
				            // $.alert('Opción cancelada!');
				        },
				    }
				});
		}
	</script>

	<style type="text/css">
		.required label:after {
		  content:"*";
		  display: block;
		  position: absolute;
		  top: -7px;
		  left: 5px;
		  color:red;
		}
		#fotoPerfil {
   			 cursor: zoom-in;
		}
	</style>

</body>
</html>

	