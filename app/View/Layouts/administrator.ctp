<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?= $this->Html->charset(); ?>

	<title>
		<?= 'Bolsa bti' ?>
	</title>

	<?= $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1', 'http-equiv' => "X-UA-Compatible"]); ?>

	<?= $this->Html->meta ( 'favicon.ico', '/img/SISBUTicon.png', ['type' => 'icon'] ); ?>
	<?= $this->Html->css(['bootstrap-select.min','bootstrap.min','fileinput.min','bootstrap-responsive.min','btiStyle','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css']) ?>
	<?= $this->Html->script(['jquery-3.1.1.min','bootstrap.min','fileinput.min','bootstrap-select.min','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js']) ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>	
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

	<script type="text/javascript">

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

		function caracteresCont(id, cont, max){	
			init_contadorTa(id,cont, max);
			updateContadorTa(id,cont, max);
		}
		
		function deleteRegister(idStudent, name){
			$.confirm({
			    title: 'Confirmación!',
			    icon: 'glyphicon glyphicon-warning-sign',
			    type: 'red',
			    content: '¿Realmente desea eliminar este registro de '+name+'?',
			    buttons: {
			        aceptar: function () {
			          $("#deleteStudentId"+idStudent).click();
			        },
			        cancelar: function () {
			            // $.alert('Opción cancelada!');
			        },
			    }
			});
		}

		function sendPaginado(){
		 	selectedIndex = document.getElementById("limit").selectedIndex;
		 	if(selectedIndex == 0){
				return false;
		 	} else {
				document.getElementById("sendPaginadoForm").submit();
		 	}
		}

		function saveEmailNotification(email){
			document.getElementById('StudentEmailTo').value = email;
			$('#myModalMail').modal('show');
		}

		function updatePassword(id,email,secondaryEmail){
			document.getElementById('AdministratorStudentId').value = id;
			var stringMails = email;
			if(secondaryEmail!=''){
				stringMails = stringMails+';'+secondaryEmail;
			}
			document.getElementById('AdministratorStudentEmail').value = stringMails;
			$('#myModalUpdatePassword').modal('show');
		}

		function updatePasswordCompany(id,email,secondaryEmail){
			document.getElementById('AdministratorCompanyId').value = id;
			var stringMails = email;
			if(secondaryEmail!=''){
				if(secondaryEmail!=null){
					stringMails = stringMails+';'+secondaryEmail;
				}
			}
			document.getElementById('AdministratorCompanyEmail').value = stringMails;
			$('#myModalUpdatePasswordCompany').modal('show');
		}

		function cambiarContenido(){
			var file = document.getElementById("StudentFile"); //El input de tipo
			file.addEventListener("change", function(){

				var archivo = document.getElementById('StudentFile').value;
				extensiones_permitidas = new Array(".jpg",".pdf");

				if (!archivo) {
					$.alert({
						    title: '!Aviso!',
						    theme: 'supervan',
						    content: 'No has seleccionado ningún archivo',
						});
					document.getElementById("StudentFile").focus();
					return false;
				}else{
					extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
					permitida = false;
					for (var i = 0; i < extensiones_permitidas.length; i++) {
						if (extensiones_permitidas[i] == extension) {
							permitida = true;
							break;
						}
					}

					if (!permitida) {
						$.alert({
						    title: '!Aviso!',
						    theme: 'supervan',
						    content: 'Comprueba la extensión de su archivo a subir. Sólo se pueden subir archivos con extensiones: ' + extensiones_permitidas.join(),
						});
						// document.getElementById('StudentFile').scrollIntoView();
						document.getElementById("StudentFile").focus();
						document.getElementById('StudentFile').value = ''; 
						$("#StudentFile").fileinput('refresh', {previewClass: 'bg-info'});
						return false;
					}else{
						return true;
					}
				}
				
			}, false);
		}

		function avisoAdmin(param){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sin permisos para modificar al administrador principal'});
			return false;
		}

		function avisoSameAdmin(){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'El mismo administrador no puede cambiar su estatus'});
			return false;
		}

		function SinCandidatos(){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sin candidatos a mostrar'});
			return false;
		}

		function cvIncompleto(){
			$.alert({ title: '!Aviso!', theme: 'supervan',content: 'El universitario no cuenta con un currículum completo para ser enviado, se considera cv completo ingresando información en: Datos Personales, Formación Académica, Objetivo Profesional, Competencias Profesionales y Expectativas Laborales.'});
			return false;
		}
		
		function ofertaIncompleta(){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'La oferta no está completa por consecuente no podrá activarse hasta que se complete su edición.'});
			return false;
		}
		
		function ofertaExpirada(){
			$.alert({ title: '!Aviso!',type: 'blue',content: 'La oferta ha expirado para poder activarla debe de actualizar la fecha de vigencia.'});
			return false;
		}

		function validateVigenciaForm(){
				
			var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			
			var fechaFinal = document.getElementById('CompanyJobProfileExpirationDay').value	+ "/" +
									document.getElementById('CompanyJobProfileExpirationMonth').value	+ "/" +
									document.getElementById('CompanyJobProfileExpirationYear').value	;
			
			var fechaCreacion = document.getElementById('CompanyJobProfileCreatedYear').value	+ "-" +
									document.getElementById('CompanyJobProfileCreatedMonth').value	+ "-" +
									document.getElementById('CompanyJobProfileCreatedDay').value;
									
			selectedIndexDay = document.getElementById("CompanyJobProfileExpirationDay").selectedIndex;
			selectedIndexMonth = document.getElementById("CompanyJobProfileExpirationMonth").selectedIndex;
			selectedIndexYear = document.getElementById("CompanyJobProfileExpirationYear").selectedIndex;
			
			responseValidateDate = validarFecha(fechaFinal);
			fechaMaxima = fechaMax(fechaFinal,fechaCreacion);
			
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){;
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la fecha completa para la vigencia.'});
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de vigencia no debe ser menor a la actual.'});
				return false;
			}else 
			if(responseValidateDate == false){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de vigencia es incorrecta.'});
				return false;
			}else
			if(fechaMaxima == false){
				<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de vigencia es de máximo 1 mes respecto a la fecha actual.'});
				<?php else: ?>
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de vigencia es de máximo 1 mes respecto a la fecha de creación de la oferta.'});
				<?php endif; ?>		
				return false;
			}else {
				return true;
			}
		}

		function validarFecha(fecha){
				 //Funcion validarFecha 
				 //valida fecha en formato aaaa-mm-dd
				 var fechaArr = fecha.split('/');
				 var aho = fechaArr[2];
				 var mes = fechaArr[1];
				 var dia = fechaArr[0];
				 
				 var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0

				 if(!plantilla || plantilla.getFullYear() == aho && plantilla.getMonth() == mes -1 && plantilla.getDate() == dia){
				 return true;
				 }else{
				 return false;
				 }
		}
		
		function fechaMax(fecha, fechaCreacion){
			<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1; //hoy es 0!
				var yyyy = hoy.getFullYear();
				hoy = yyyy+'-'+mm+'-'+dd;
				var fechaCreacion = hoy;
			<?php else: ?>
				var fechaCreacion = fechaCreacion;
			<?php endif; ?>
		
				var fechaArrCreacion = fechaCreacion.split('-');
				var aho2 = fechaArrCreacion[0];
				var mes2 = fechaArrCreacion[1];
				var dia2 = fechaArrCreacion[2];
				var fechaCreacionOferta = new Date(aho2,mes2,dia2);

				var fechaArr = fecha.split('/');
				var aho = fechaArr[2];
				var mes = fechaArr[1];
				var dia = fechaArr[0];
				var fechaPropuesta = new Date(aho, mes-1, dia); 

				if(fechaPropuesta > fechaCreacionOferta){
					return false;
				} else{
					return true;
				}
		}
		
		function validate_fechaMayorQue(fechaInicial,fechaFinal){
			valuesStart=fechaInicial.split("/");
            valuesEnd=fechaFinal.split("/");

            // Verificamos que la fecha no sea posterior a la actual

            var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
            var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);

            if(dateStart>dateEnd)
            {
                return 1;
            }
            return 0;
        }

        function saveVigencia(idJobProfile,fecha, fechaCreacion){
			
			var fechaArr = fecha.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileExpirationYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationDay option[value='"+dia+"']").prop('selected', true);
			
			var fechaArr = fechaCreacion.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileCreatedYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedDay option[value='"+dia+"']").prop('selected', true);
		
			document.getElementById('CompanyJobProfileId').value = idJobProfile;
			$('.selectpicker').selectpicker('refresh');
			$('#myModalVigencia').modal('show');
		}
		
		function validate_fechaMayorQue(fechaInicial,fechaFinal){
			valuesStart=fechaInicial.split("/");
            valuesEnd=fechaFinal.split("/");

            // Verificamos que la fecha no sea posterior a la actual

            var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
            var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);

            if(dateStart>dateEnd)
            {
                return 1;
            }
            return 0;
        }

		function confirmaEjecucionSeguimiento(id){
			$.confirm({
			    title: 'Confirmación!',
			    icon: 'glyphicon glyphicon-warning-sign',
			    theme: 'supervan',
			    content: 'Está apunto de ejecutar el proceso "Seguimiento a procesos de reclutamiento selección y contrataciones" el cual realizará un análisis de las entrevistas telefónicas y presenciales programadas con anterioridad, enviando una notificación y correo electrónico a las empresas o alumnos con opciones de respuestas para definir el término de dichas entrevistas sin concluir, este proceso está programado para realizarse una vez cada 2 meses, una vez terminado esta opción desaparecerá y se activará nuevamente al paso del tiempo establecido, si está de acuerdo en ejecutar la acción presione "Aceptar" de lo contrario presione "Cancelar".',
			    buttons: {
			        Aceptar: function () {
			           $('#loading').show();
						window.location.assign("http://localhost/bolsabti/Administrators/reclutamientoSeleccion");
			        },
			        Cancelar: function () {
			            // $.alert('Opción cancelada!');
			        },
			    }
			});
			return false;
		}
		
		function confirmaEjecucionDesactivaCV(){
			$.confirm({
			    title: 'Confirmación!',
			    icon: 'glyphicon glyphicon-warning-sign',
			    theme: 'supervan',
			    content: 'Está apunto de ejecutar un proceso de revisión a universitarios sin actividad en su cuenta por al menos 5 meses y los candidatos que aplican en este proceso se les hará llegar un correo electrónico incitandolos a actualizar su currículum para no ser bloqueados en el sistema después de 3 intentos y sin alguna actualización el registro será bloqueado, si está de acuerdo en ejecutar la acción presione "Aceptar" de lo contrario presione "Cancelar".',
			    buttons: {
			        Aceptar: function () {
			           $('#loading').show();
						window.location.assign("http://localhost/bolsabti/Administrators/studentStatus");
			        },
			        Cancelar: function () {
			            // $.alert('Opción cancelada!');
			        },
			    }
			});
			return false;
		}
		
		<?php 
			$permiso = explode(",", $administrator['AdministratorProfile']['access']);
			foreach($permiso as $conPermiso):
		?>
			$('#menuId'+<?php echo $conPermiso; ?>).show();
		<?php 
			endforeach;	
		?>
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
												['controller' => 'Administrators',
												'action' => 'addAdministrator'],
												['escape' => false,
												'style'=>'width: 65px;',
												'class'=>'navbar-brand']
											); ?>
	        </div>

	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	          <ul class="nav navbar-nav navbar-right">						
	            <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opciones <b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-user"></span> Mi Perfil', 
																	['controller'=>'Administrators',
																	'action' => 'editAdministratorProfile',$this->Session->read('Auth.User.id')], 
																	['escape' => false]);?>
					</li>
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-lock"></span> Modificar Contraseña', 
																	['controller'=>'Administrators',
																	'action' => 'editPasswordAdministrator',$this->Session->read('Auth.User.id')],
																	['escape' => false]);?>
					</li>
	                <li><?= $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión', 
																	['controller'=>'Administrators',
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

	<!--Menú lateral-->
    <div class="body-wrap"" style="background-color: #f8f8f8">
		<div class="col-md-2" style="padding-right: 0px; margin-bottom: 50px;">
			<div class="profile-sidebar">
				<div class="profile-userpic visible-lg visible-md">
					<?php
						$path = WWW_ROOT.'img'.DS.'uploads'.DS.'administrator'.DS.'filename'.DS;
						if (isset($administrator) and isset($administrator['Administrator']['filename']) and ($administrator['Administrator']['filename'] <> '' and file_exists($path.$administrator['Administrator']['filename']))):
							echo $this->Html->image('uploads/administrator/filename/'.$administrator['Administrator']['filename'],
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
				<div class="profile-usertitle" style="margin-bottom: 10px">
					<div class="profile-usertitle-name" style="font-size: 12px">
						<?php 
							if(isset($administrator['AdministratorProfile']['contact_name'])):
								echo $administrator['AdministratorProfile']['contact_name'].' '.$administrator['AdministratorProfile']['contact_last_name'].' '.$administrator['AdministratorProfile']['contact_second_last_name'];
							endif;
						?>
					</div>
				</div>
				<div class="profile-usermenu">
					<ul class="nav">
						<?php $index=0; ?>
 						
						<li id="menuId1" <?= (!empty($this->params['action']) && (($this->params['action']=='addAdministrator') || ($this->params['action']=='searchAdministrator') || ($this->params['action']=='editAdministratorProfile') || ($this->params['action']=='editPasswordAdministrator') || ($this->params['action']=='banner')) ) ? 'class="active" ' : ''; ?> >  
							<?= $this->Html->link('<i class="fa fa-users" aria-hidden="true"></i> Administradores', 
															['controller'=>'Administrators',
															'action' => 'addAdministrator'],
															['escape'=> false ]
							);?>
						</li>

						<li id="menuId3" <?= (!empty($this->params['action']) && (($this->params['action']=='searchStudent') || ($this->params['action']=='viewStudentPostullation') || ($this->params['action']=='specificSearchStudent') || ($this->params['action']=='specificSearchStudentResults')))? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="fa fa-graduation-cap" aria-hidden="true"></i> Universitarios', 
															['controller'=>'Administrators','nuevaBusqueda',
															'action'=>'searchStudent'],
															['escape'=>false]
							);?>
						</li>

						<li id="menuId4" <?= (!empty($this->params['action']) && (($this->params['action']=='searchCompany') || ($this->params['action']=='specificSearchCompany') || ($this->params['action']=='companyOfferOption') || ($this->params['action']=='companyHistory') || (($this->params['action']=='searchStudentOffer') AND ($this->Session->read('volver')=='companyHistory')) || ($this->params['action']=='resultsSpecificSearchCompany')) )? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="fa fa-building" aria-hidden="true"></i>Empresas/Instituciones', 
															['controller'=>'Administrators',
															'action' => 'searchCompany','nuevaBusqueda'], 
															['escape'=>false]
							);?>
						</li>

						<li id="menuId5" <?= (!empty($this->params['action']) && (($this->params['action']=='searchOffer') || ($this->params['action']=='specificSearchOffer') || (($this->params['action']=='searchStudentOffer') AND ($this->Session->read('volver')=='searchOffer')) || ($this->params['action']=='specificSearchOfferResults')) )? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="fa fa-briefcase" aria-hidden="true"></i>Ofertas', 
															['controller'=>'Administrators',
															'action' => 'searchOffer','nuevaBusqueda'], 
															['escape'=>false]
							);?>
						</li>

						<li id="menuId6" <?= (!empty($this->params['action']) && (($this->params['action']=='sendMail')) )? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="fa fa-envelope" aria-hidden="true"></i></i>Correos Masivos', 
															['controller'=>'Administrators',
															'action' => 'sendMail','nuevaBusqueda'], 
															['escape'=>false]
							);?>
						</li>

						<li id="menuId7" <?= (!empty($this->params['action']) && (($this->params['action']=='informe') || ($this->params['action']=='reporte') || ($this->params['action']=='consultas')) )? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="fa fa-file-text" aria-hidden="true"></i>Informes', 
															['controller'=>'Administrators',
															'action' => 'informe'], 
															['escape'=>false]
							);?>
						</li>

						<?php 
							$hoy = date('Y-m-d');
							if((($fechaReclutamiento['RecruitmentDate']['fecha1_seguimiento'] <= $hoy) AND ($fechaReclutamiento['RecruitmentDate']['status_ejecucion_fecha1']==0) OR (( ($fechaReclutamiento['RecruitmentDate']['fecha1_seguimiento'] < $hoy) AND ($fechaReclutamiento['RecruitmentDate']['fecha2_seguimiento'] <= $hoy) AND ($fechaReclutamiento['RecruitmentDate']['status_ejecucion_fecha2']==0)))) AND ($this->Session->read('Auth.User.role') === 'administrator')):
						?>
								<li id="menuId11" <?= (!empty($this->params['action']) && ($this->params['action']=='') )? 'class="active" ' : ''; ?> > 
									<?= $this->Html->link('<i class="fa fa-calendar" aria-hidden="true"></i>Seguimiento a procesos de R&S y contrataciones', 
																	['controller'=>'Administrators',
																	'action' => ''], 
																	['escape'=>false,'onclick' => 'return confirmaEjecucionSeguimiento();','title' => 'Seguimiento a procesos de R&S y contrataciones',]
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

						<li id="menuId12" <?= (!empty($this->params['action']) && ($this->params['action']=='') )? 'class="active" ' : ''; ?> > 
							<?= $this->Html->link('<i class="fa fa-low-vision" aria-hidden="true"></i>Ejecutar proceso de revisión a universitarios sin actividad', 
															['controller'=>'Administrators',
															'action' => ''], 
															['escape'=>false,'onclick' => 'return confirmaEjecucionDesactivaCV();','title' => 'Ejecutar proceso de revisión a universitarios sin actividad',]
							);?>
						</li>

						<?php 
							endif;
						?>
					</ul>

				</div>
			</div>
		</div>

		<div class="col-md-10">
            <div class="profile-content col-md-12" style="margin-bottom: 50px;">
				<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">

					<?php if(!empty($this->params['action']) && (($this->params['action']=='addAdministrator') || ($this->params['action']=='searchAdministrator') || ($this->params['action']=='editAdministratorProfile') || ($this->params['action']=='editPasswordAdministrator') || ($this->params['action']=='banner'))): ?>
						<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
						  <div class="container-fluid">
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						      <a class="navbar-brand" href="#">ADMINISTRADORES:</a>
						    </div>

						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
						      <ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='addAdministrator')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Agregar',['controller'=>'Administrators','action'=>'addAdministrator']); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='searchAdministrator')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Buscar', ['controller'=>'Administrators','action'=>'searchAdministrator','nuevaBusqueda']); ?>
								</li>
							  </ul>	
							</div>
						  </div>
				        </nav>
					<?php endif; ?>

					<?php 
						if(!empty($this->params['action']) && (($this->params['action']=='informe') || ($this->params['action']=='reporte') || ($this->params['action']=='consultas'))):
					?>
						<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
						  <div class="container-fluid">
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						      <a class="navbar-brand" href="#">OPCIONES:</a>
						    </div>

						    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
						      <ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='informe')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Informes',['controller'=>'Administrators','action'=>'informe']); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='reporte')) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('Reportes', ['controller'=>'Administrators','action'=>'reporte']); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='consultas')) ? 'menu-profile active' : 'menu-profile' ?> ">
									<?= $this->Html->link('Frecuencias', ['controller'=>'Administrators','action'=>'consultas']); ?>
								</li>
							  </ul>	
							</div>
						  </div>
				        </nav>
					<?php 
						endif; 
					?>
				
					<!-- Bloques informativos D0D2D3 -->
					<blockquote id="BloqueInformativoId" style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
				        <p id="informeSeleccionadoId" style="color: #000"></p>
				    </blockquote>

					<blockquote id="BloqueInformativoId" style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
				        <p id="descripcionInformeId" style="color: #588BAD"></p>
				    </blockquote>

					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
					<?php if(!empty($this->params['action']) && ($this->params['action']<>'consultas')): ?>
						<?= $this->element('paginacion'); ?>
					<?php endif; ?>

				</div>
            </div>
		</div>
	</div>
	
	<!--Pie de página-->
	<div class="col-md-12 whiteText" style="text-align: center; background-color: #1a75bb; margin-top: 15px;  position:fixed;left:0px;bottom:0px;height:30px;width:100%;z-index: 1000;">
		<p style="margin: 7px;">Hecho en México, todos los derechos reservados.</p>
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

	<!--Modal foto de perfil-->
	<div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
	    <div class="modal-dialog modal-md" role="document" style="max-width: 450px;">
	      <div class="modal-content">
	        <div class="modal-body" style="background-color: #d2d2d2">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
														['controller'=>'Administrators',
														'action'=>'editPhoto'],
														['class' => 'btn btn-success',
														'escape' => false]); ?>
				</div>
	        </div>
	      </div>
	    </div>
	</div>

	<!--Form para actualizar password -->
	<div class="modal fade" id="myModalUpdatePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
		<div class="modal-dialog" >
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel" style="color: white">Generar nueva contraseña</h4>
				</div>
				<div class="modal-body" class="col-md-12" style="color: white">

					<?= $this->Form->create('Administrator', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-1 control-label', 'text'=>''],
										'between' => '<div class="col-md-12">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'updateStudentPassword']); ?>

					<fieldset>
						<?= $this->Form->input('student_id',['type'=>'hidden']); ?>
						<label>Contraseña generada automaticamente:</label>
						<?= $this->Form->input('password',['type' => 'password','readonly' => 'readonly','value' => $this->Session->read('randomPass')]); ?>
						<label>Envio de notificación al correo</label>
						<?= $this->Form->input('student_email',['readonly' => 'readonly','value' => $this->Session->read('randomPass'),'label'=>['text'=>'','placeholder' => 'Envio de notificación al correo:']]); ?>
						<label>Correo alternativo:</label>
						<?= $this->Form->input('student_email_alternativo',['label'=>['text'=>''],'placeholder' => 'Correo alternativo']); ?>
						<p style="font-size: 12px;color: white">Si necesita agregar más de un correo alternativo estos deberan estar separados por un punto y coma ';'</p>
					</fieldset>
				</div>
				<div class="modal-footer">
					<div class="col-md-3 col-md-offset-4 text-center" style="margin-top: 15px;">
						<?= $this->Form->button('Modificar&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-lock"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
						<?= $this->Form->end(); ?>
					</div>	
				</div>
			</div>
		</div>
	</div>

	<!--Form para actualizar password COMPANY-->
	<div class="modal fade" id="myModalUpdatePasswordCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
		<div class="modal-dialog" >
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel" style="color: white">Generar nueva contraseña</h4>
				</div>
				<div class="modal-body" class="col-md-12" style="color: white">

					<?= $this->Form->create('Administrator', [
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => [
										'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'label' => ['class' => 'col-md-1 control-label', 'text'=>''],
										'between' => '<div class="col-md-12">',
										'after' => '</div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
									],
									'action' => 'updateCompanyPassword']); ?>

					<fieldset>
						<?= $this->Form->input('company_id',['type'=>'hidden']); ?>
						<label>Contraseña generada automaticamente:</label>
						<?= $this->Form->input('password',['type' => 'password','readonly' => 'readonly','value' => $this->Session->read('randomPass')]); ?>
						<label>Envio de notificación al correo</label>
						<?= $this->Form->input('company_email',['readonly' => 'readonly','value' => $this->Session->read('randomPass'),'label'=>['text'=>'','placeholder' => 'Envio de notificación al correo:']]); ?>
						<label>Correo alternativo:</label>
						<?= $this->Form->input('company_email_alternativo',['label'=>['text'=>''],'placeholder' => 'Correo alternativo']); ?>
						<p style="font-size: 12px;color: white">Si necesita agregar más de un correo alternativo estos deberan estar separados por un punto y coma ';'</p>
					</fieldset>
				</div>
				<div class="modal-footer">
					<div class="col-md-3 col-md-offset-4 text-center" style="margin-top: 15px;">
						<?= $this->Form->button('Modificar&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-lock"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
						<?= $this->Form->end(); ?>
					</div>	
				</div>
			</div>
		</div>
	</div>

	<!--Form para envio de correo -->
	<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
		<div class="modal-dialog"  style="width: 650px" id="draggable">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" style="color: #fff">Envio de correo electrónico </h4>
				</div>
				<div class="modal-body col-md-12">
					<?= $this->Form->create('Administrator', [
								'type' => 'file',
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
								'action' => 'sendEmailStudent',]); ?>
						<fieldset>
							
							<div class="col-md-12">
							<label style="color: #fff">Para:</label>
							<?= $this->Form->input('Student.emailTo', ['placeholder' => 'Correo','readonly' => 'readonly']); ?>
							</div>

							<div class="col-md-12">
							<label style="color: #fff">Título:</label>
							<?= $this->Form->input('Student.title', ['placeholder' => 'Título']); ?>
							</div>

							<div class="col-md-12">
							<label style="color: #fff">Adjuntar archivo .jpg ó .pdf</label>
							<?= $this->Form->input('Student.file', ['type' => 'file','placeholder' => 'Título','onchange' => 'cambiarContenido()','class' =>'file']); ?>
							</div>

							<?= $this->Form->input('Student.CC', ['type' => 'hidden']); ?>
							<?= $this->Form->input('Student.CCO', ['type' => 'hidden']); ?>
							
							<div class="col-md-12">
							<label style="color: #fff">Mensaje:</label>
							<?= $this->Form->input('Student.message', ['placeholder' => 'Mensaje','type'=>'textarea','class' => 'form-control responsabilidadesClass','style' => 'max-height: 280px;','maxlength' => '632', 'onkeypress'=> 'caracteresCont("StudentMessage", "contadorMensaje",632)']); ?>
							</div>

							<div class="col-md-12" style="float: right;">
								<div style="float: right;"><span id="contadorMensaje" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span></div>
							</div>

							<div class="col-md-6">
							<label style="color: #fff">Firma:</label>
							<?= $this->Form->input('Student.sign', ['placeholder' => 'Firma']); ?>
							</div>

						</fieldset>

				</div>
				<div class="modal-footer">
					<div class="col-md-12 text-center" style="margin-bottom: 15px">
						<?= $this->Form->button('Enviar &nbsp; <i class="glyphicon glyphicon-send"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style'=>'float: right']);?>
						<?= $this->Form->end(); ?>
					</div>	
				</div>
			</div>
		</div>
	</div>

	<!--Form para cambiar vigencia de la oferta-->
	<div class="modal fade" id="myModalVigencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
		<div class="modal-dialog"  style="width: 600px">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Seleccione la fecha de vigencia para la oferta</h4>
				</div>
				<div class="modal-body" >
					<?= $this->Form->create('Administrator', [
								'type' => 'file',
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
								'onsubmit' =>'return validateVigenciaForm();',
								'action' => 'updateCompanyJobProfileExpiration',]); ?>

					<fieldset>
						<?= $this->Form->input('CompanyJobProfile.id', ['type'=>'hidden']); ?>
							
						<label style="margin-top: 3px;">Vigencia de la oferta</label>
						<?= $this->Form->input('CompanyJobProfile.expiration', [
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'data-width'=> '180px',
													'dateFormat' => 'YMD',
													'separator' => '',
													'minYear' => date('Y') - 3,
													'maxYear' => date('Y') - 0]); ?>

						<div style="display: none;">
							<?= $this->Form->input('CompanyJobProfile.created', [
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'data-width'=> '160px',
													'dateFormat' => 'YMD',
													'separator' => '',
													'minYear' => date('Y') - 10,
													'maxYear' => date('Y') - 0]); ?>
						</div>

					</fieldset>
				</div>
				<div class="modal-footer">
					<div class="col-md-3 col-md-offset-4 text-center" style="margin-top: 15px;">
						<?= $this->Form->button('Modificar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
						<?= $this->Form->end(); ?>
					</div>	
				</div>
			</div>
		</div>
	</div>

	<?php
		echo $this->Form->postLink('Eliminar Logo',							
								['controller'=>'Administrators',
								'action'=>'deletePhoto',$this->Session->read('Auth.User.id')],
								['style' => 'display: none',
								'id' => 'deletePhotoId']
							); 	
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
				            $.alert('Opción cancelada!');
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