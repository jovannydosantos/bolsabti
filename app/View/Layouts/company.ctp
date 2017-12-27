<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?= $this->Html->charset(); ?>

	<title> 
	<?= 'Bolsa bti' ?> </title>

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
	     $(function() {
	    	$('#fotoPerfil').on('click', function() {
				$('.enlargeImageModalSource').attr('src', $(this).attr('src'));
				$('#enlargeImageModal').modal('show');
			});
		});
		function caracteresCont(id, cont, max){	
				init_contadorTa(id,cont, max);
				updateContadorTa(id,cont, max);
			}
		function deleteOffer(param){
		$.confirm({
			title: 'Confirmación!',
			icon: 'glyphicon glyphicon-warning-sign',
			type: 'red',
			content: '¿Realmente desea eliminar la oferta',
			buttons: {
				aceptar: function () {
				   $("#deleteOfferId"+param).click();
				},
				cancelar: function () {
					// $.alert('Opción cancelada!');
				},
			}
		});
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
				    theme: 'light',
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
								document.getElementById("CompanyFolderName").value = name;
								document.getElementById("CompanyCompanyFolderForm").submit();
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
		function init_contadorTa(idtextarea, idcontador,max){
		$("#"+idtextarea).keyup(function()
				{
					updateContadorTa(idtextarea, idcontador,max);
				});
		
		$("#"+idtextarea).change(function()
		{
				updateContadorTa(idtextarea, idcontador,max);
		});
		
	}
	function updateContadorTa(idtextarea, idcontador,max){
		var contador = $("#"+idcontador);
		var ta =     $("#"+idtextarea);
		contador.html("0/"+max);
		
		contador.html(ta.val().length+"/"+max);
		if(parseInt(ta.val().length)>max)
		{
			ta.val(ta.val().substring(0,max-1));
			contador.html(max+"/"+max);
		}

	}
		function editFolder(id, folderName){
			document.getElementById("Vista"+id).value = vista();
			
			$.confirm({
				    title: 'Carpeta!',
				    theme: 'Dark',
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
				                document.getElementById("formCompanyEditFolderId"+id).submit();
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
						document.getElementById("formCompanydeleteFolderId"+id).submit();
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
		function saveOffer(StudentId, redirect){
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
			document.getElementById('CompanySavedStudentStudentId').value = StudentId;
		//	document.getElementById('StudentSavedOfferRedirect').value = vista;
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
		$('#myModalVigencia').modal('show');
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
		function mensajeLimiteDescargas(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'El número de visualizaciones y/o descargas en pdf ha llegado a su límite',
		});	
	}
		function ofertaInactiva(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'Oferta Inactiva',
		});	
	}
		function ofertaActiva(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'Oferta Activa',
		});	
	}
		function mensajeSinConfigurar(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'No puede visualizar y/o descargar el cv en formato pdf hasta que el administrador indique el número de descargas permitidas para su usuario.',
		});	
	}
		function cvIncompleto(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'El universitario no cuenta con un currículum completo para ser descargado.',
		});	
	}		
		function mensajeActivaDesactiva(){
			jAlert('Sin permisos para modificar el estatus de la oferta, sólo el administrador puede realizar esta acción', 'Mensaje');
			return false;
		}		
		function ofertaIncompleta(){
			$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'La oferta no está completa por consecuente no podrá activarse hasta que se complete su edición.',
		});	
		}			
		function ofertaExpirada(){
		$.alert({
			title:'AVISO',
			type: 'blue',
			content : 'La oferta ha expirado para poder activarla debe de actualizar la fecha de vigencia.',
		});	
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
													['controller' => 'Companies',
													'action' => 'profile'],
													['escape' => false,
													'style'=>'width: 65px;',
													'class'=>'navbar-brand']
												); ?>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">	
						<?php 
							if($this->Session->check('editingAdmin')):
								if($this->Session->read('editingAdmin') == 'yes'):
						?>           
						<li><?= $this->Html->link('<span class="glyphicon glyphicon-arrow-left"></span> Volver como administrador', 
																			['controller'=>'Administrators',
																			'action' =>$this->Session->read('redirectAdmin')],
																			['escape' => false,
																			'style' => 'background-color: #b81616;',]);?>
						</li>
						<?php 
								endif;
							endif;
						?>
						<li><?= $this->Html->link('<span class="glyphicon glyphicon-search"></span> Buscar Candidatos', 
																			['controller'=>'Companies',
																			'action' => 'searchCandidate', 'nuevaBusqueda'], 
																			['escape' => false]);?>
						</li>
						<li><?= $this->Html->link('<span class="glyphicon glyphicon-bell"></span> Notificaciones <span style="margin-left: 5px;">'.$notificaciones.'</span>', 
																			['controller'=>'Companies',
																			'action' => 'companyPostullation','nuevaBusqueda'], 
																			['escape' => false]);?>
						</li>
						<li><?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span> Actualizar Datos de Registro', 
																			['controller'=>'Companies',
																			'action' => 'companyContact', $this->Session->read('company_id')], 
																			['escape' => false]);?>
																			
																			
																			
						</li>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opciones <b class="caret"></b></a>
						  <ul class="dropdown-menu">
							<li><?= $this->Html->link('<span class="glyphicon glyphicon-user"></span> Mi Perfil', 
																			['controller'=>'Companies',
																			'action' => 'profile'], 
																			['escape' => false]);?>
							</li>
							<li><?= $this->Html->link('<span class="glyphicon glyphicon-lock"></span> Modificar Contraseña', 
																			['controller'=>'Companies',
																			'action' => 'changePassword', $this->Session->read('company_id')],
																			['escape' => false]);?>
							</li>
							<li><?= $this->Html->link('<span class="glyphicon glyphicon-remove"></span> Eliminar Registro', 
																			['controller'=>'Companies',
																			 'action' => 'disableCompanyRegister', $this->Session->read('company_id')],
																			['escape' => false]);?>
							</li>
							<li class="divider"></li>
							<li><?= $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión', 
																			['controller'=>'Companies',
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
																['controller'=>'Companies',
																'action'=>'updateRegister', $this->Session->read('company_id')],
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
						$path = WWW_ROOT.'img'.DS.'uploads'.DS.'company'.DS.'filename'.DS;
						if (isset($company) and isset($company['Company']['filename']) and ($company['Company']['filename'] <> '' and file_exists($path.$company['Company']['filename']))):
							echo $this->Html->image('uploads/company/filename/'.$company['Company']['filename'],
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
								if(isset($company['CompanyProfile']['company_name'])):
									echo $company['CompanyProfile']['company_name'];
								endif;
							?>
						</div>
				</div>
				<div class="profile-usermenu">
					<ul class="nav">
						<li <?= (!empty($this->params['action']) && (($this->params['action']=='companyJobOffer') || ($this->params['action']=='companyJobProfile') || ($this->params['action']=='CompanyJobProfile') || ($this->params['action']=='companyJobContractType') || ($this->params['action']=='CompanyJobContractType') || ($this->params['action']=='companyCandidateProfile') || ($this->params['action']=='CompanyCandidateProfile')  || ($this->params['action']=='companyJobKnowledge')) )? 'class="active" ' : ''; ?> >  
										<?= $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Registar Ofertas', 
															['controller'=>'Companies',
															'action' => 'companyJobOffer'],
															['escape'=> false ]
										);?>
						</li>
						<li <?= (!empty($this->params['action']) && (($this->params['action']=='offerAdmin') || ($this->params['action']=='viewOfferOnline')   || ($this->params['action']=='viewOfferPdf')||  ($this->params['action']=='viewCandidateOffer')))? 'class="active" ' : ''; ?> >  
										<?= $this->Html->link('<i class="glyphicon glyphicon-folder-open"></i> Administrar Ofertas', 
															['controller'=>'Companies',
															'action' => 'offerAdmin','nuevaBusqueda'],
															['escape'=> false ]
										);?>
						</li>
						<li <?= (!empty($this->params['action']) && ($this->params['action']=='studentReport') || ($this->params['action']=='companyExternalOffer') )? 'class="active" ' : ''; ?> >  
										<?= $this->Html->link('<i class="glyphicon glyphicon-hand-right"></i> Reportar Contrataciones', 
															['controller'=>'Companies',
															'action' => 'studentReport',
															'?' => array(
															'nuevaBusqueda' => 'nuevaBusqueda',
															),],
															['escape'=> false ]
										);?>
						</li>
						<li <?= (!empty($this->params['action']) && ($this->params['action']=='companyViewedStudent') )? 'class="active" ' : ''; ?> >  
						 
										<?= $this->Html->link('<i class="glyphicon glyphicon-star"></i>Candidatos más vistos por las empresas', 
															['controller'=>'Companies',
															'action' => 'companyViewedStudent'],
															['escape'=> false ]
										);?>
						</li>
						<li>
							<?= $this->Form->create('Company', ['class' => 'form-horizontal', 
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
																'action' => 'companyFolder',
									]); ?>					
									
									<?= $this->Form->input('CompanyFolder.name',['type'=> 'hidden']); ?>
									
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
													if($intoFolder == $folder['CompanyFolder']['id']):
														$colorCarpeta = '<span class="glyphicon glyphicon-folder-open"></span>&nbsp;';
													else:
														$colorCarpeta = '<span class="glyphicon glyphicon-folder-close"></span>&nbsp;';
													endif;
												else:
													$colorCarpeta = '<span class="glyphicon glyphicon-folder-close"></span>&nbsp;';
												endif;
											?>
											<?= $this->Html->link($colorCarpeta.'<span style="font-size: 15px;">'. $folder['CompanyFolder']['name'].'</span>', [  
																				'controller'=>'Companies',
																				'action'=>'searchCandidate',
																				'?' => ['intoFolder' => $folder['CompanyFolder']['id'],'newFolderSelected' => 'yes']		
																				],
																				['escape' => false
																				]);
											?>	
								</div>
								<div class="col-md-2" style="padding-left: 5px;padding-right: 5px;">  
											<?= $this->Form->create('Company', array(
																'class' => 'form-horizontal', 
																'role' => 'form',
																'id' => 'formCompanyEditFolderId'.$folder['CompanyFolder']['id'],
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
																'action' => 'editCompanyFolder',					
											)); ?>					
											<?= $this->Form->input('CompanyFolder.id',['type'=> 'hidden','value' => $folder['CompanyFolder']['id']]); ?>
											<?= $this->Form->input('CompanyFolder.name',['type'=> 'hidden','id' => 'nameId'.$folder['CompanyFolder']['id']]); ?>
											<?= $this->Form->input('CompanyFolderEdit.vista',['type'=> 'hidden','id' => 'Vista'.$folder['CompanyFolder']['id']]); ?>
											<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>&nbsp;','#',[ 
																'onclick' =>"return editFolder(".$folder['CompanyFolder']['id'].",'".$folder['CompanyFolder']['name']."');",
																'escape'=> false
																]);?>
											<?= $this->Form->end(); ?>
								</div>
								<div class="col-md-2" style="padding-left: 5px;padding-right: 5px;">
									<?php echo $this->Form->create('Company', [
																	'class' => 'form-horizontal', 
																	'role' => 'form',
																	'id' => 'formCompanydeleteFolderId'.$folder['CompanyFolder']['id'],
																	'inputDefaults' => [
																	'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
																	'div' => ['class' => 'form-group'],
																	'class' => 'form-control',
																	'before' => '<div class="col-md-12">',
																	'between' => ' <div class="col-md-6">',
																	'after' => '</div></div>',
																	'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline margin-reduce']]
																	],
																	'action' => 'deleteCompanyFolder',
																	
									]); ?>					
									<?= $this->Form->input('CompanyFolder.id',['type'=> 'hidden','value' => $folder['CompanyFolder']['id']]); ?>
									<?= $this->Form->input('CompanyFolder.vista',['type'=> 'hidden','id' => 'vistaDelete'.$folder['CompanyFolder']['id']]); ?>
									<?= $this->Html->link('<span class="glyphicon glyphicon-remove"></span>&nbsp;', '#',[
															'onclick' =>"return deleteFolder(".$folder['CompanyFolder']['id'].",'".$folder['CompanyFolder']['name']."');",
															'escape'=> false
															]);?>
									<?= $this->Form->end(); ?>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
			</div>
		</div>
	</div>
	
	<div class="col-md-10">
		<div class="profile-content col-md-12" style="margin-bottom: 50px;">
			<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">						
				<?php if(!empty($this->params['action']) && (($this->params['action']=='companyTelephoneNotification') )): 	?>
					<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px;  margin-bottom: 30px;" >Notificación telefónica</a>
				<?php endif; 	?>
				
				<!--registro de ofertas-->
				<?php if(!empty($this->params['action']) && (($this->params['action']=='companyJobOffer') || ($this->params['action']=='companyJobProfile') || ($this->params['action']=='CompanyJobProfile') || ($this->params['action']=='companyJobContractType') || ($this->params['action']=='CompanyJobContractType') || ($this->params['action']=='companyCandidateProfile') || ($this->params['action']=='CompanyCandidateProfile') || ($this->params['action']=='companyJobKnowledge'))):	?>
				<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Registrar Ofertas:</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
							<ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='companyJobOffer')  )? 'menu-profile active' : 'menu-profile' ?> "	>
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
									<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='companyJobProfile') || ($this->params['action']=='CompanyJobProfile') || ($this->params['action']=='editStudentProfessionalProfile') || ($this->params['action']=='viewStudentProfessionalProfile'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
								<?php if($this->Session->check('CompanyJobOffer.id') == true): ?>
									<?php echo $this->Html->link(
										'Perfil de la Oferta',		
										array(
											'controller'=>'Companies',
											'action' => 'companyJobProfile'
											),
										array(
											'class' => 'corriculumMenu',
											'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px;',
											'escape' => false,
										)
									); ?>
								<?php else: ?>
									<?php echo $this->Html->link(
										'Perfil de la Oferta',		
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
						
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='companyJobContractType') || ($this->params['action']=='CompanyJobContractType') || ($this->params['action']=='editStudentJobSkill') || ($this->params['action']=='viewStudentJobSkill') || ($this->params['action']=='editStudentLenguage') || ($this->params['action']=='viewStudentLenguage') || ($this->params['action']=='editStudentTechnologicalKnowledge') || ($this->params['action']=='viewStudentTechnologicalKnowledge'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
								<?php if($this->Session->check('CompanyJobOffer.id') == true): ?>
									<?php echo $this->Html->link(
										'Modalidad de contratación',		
										array(
											'controller'=>'Companies',
											'action' => 'companyJobContractType'
											),
										array(
											'class' => 'corriculumMenu',
											'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px;',
											'escape' => false,
										)
									); ?>
								<?php else: ?>
									<?php echo $this->Html->link(
										'Modalidad de contratación',		
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
							<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='companyCandidateProfile') || ($this->params['action']=='CompanyCandidateProfile') || ($this->params['action']=='editStudentProfessionalExperience') || ($this->params['action']=='editStudentWorkArea') || ($this->params['action']=='viewStudentProfessionalExperience'))  )? 'menu-profile active' : 'menu-profile' ?> "	>
							<?php if($this->Session->check('companyJobContractType.id') == true): ?>
								<?php echo $this->Html->link(
									'Perfil del Candidato', 
									array(
										'controller'=>'Companies',
										'action' => 'companyCandidateProfile'
										),
									array(
										'class' => 'corriculumMenu',
										'escape' => false,
										'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px;',
										'title' => ''
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
											'style' => 'text-align: center; padding-bottom: 5px; padding-top: 5px; cursor:not-allowed',
											'escape' => false,
											'onclick' => 'return false',
										)
								);  ?>
							<?php endif; ?>
							</li>
							<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='companyJobKnowledge')  )? 'menu-profile active' : 'menu-profile' ?> "	>
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
							
								<?php if($this->Session->read('Editando') == 1): ?>
							<li class="whiteTextMenu"	>
								<?php 
									echo $this->Html->link('Finalizar Edición &nbsp;&nbsp; <i class="glyphicon glyphicon-remove-sign"></i>', 
															array(
																'controller'=>'Companies',
																'action' => 'Profile'
																),
															array(
																'class' => 'corriculumMenu myclass',
																'escape' => false,
																
																'style' => 'background-color: #bfbfbf; border-radius: 10px; text-align: center; padding-bottom: 5px; padding-top: 5px;',
																
															)
									);  
								?>
							</li>
							<?php endif; ?>
							
							</ul>	
						</div>
					</div>
				</nav>
				<?php endif; ?>			

				<!--ver ofertas-->
				<?php 
					if(!empty($this->params['action']) && (($this->params['action']=='viewOfferOnline') || ($this->params['action']=='viewOfferPdf'))):
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
							<a class="navbar-brand" href="#">Ver oferta:</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
							<ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='viewOfferOnline')  )? 'active border-li' : 'border-li' ?> "	>
									<?php 
										if($this->Session->read('companyJobProfileId') <> ''):
											$vista = 'viewOfferOnline/'.$this->Session->read('companyJobProfileId');
										else:
											$vista = 'profile';
										endif; ?>
									<?= $this->Html->link('Vista en linea',['controller'=>'Companies','action'=>$vista]); ?>
								</li>
								<li class="whiteTextMenu <?php  echo (!empty($this->params['action']) && (($this->params['action']=='viewOfferPdf'))  )? 'active border-li' : 'border-li' ?> ">
									<?php 
										if($this->Session->read('companyJobProfileId') <> ''):
											$vista = 'viewOfferPdf/'.$this->Session->read('companyJobProfileId');
										else:
											$vista = 'profile';
										endif;?>
									<?= $this->Html->link('Vista previa impresión', ['controller'=>'Companies','action'=>$vista]); ?>
								</li>
							</ul>	
						</div>
					</div>
				</nav>					
				<?php 
					endif; 
				?>
	
				<!-- reportar contrataciones-->
				<?php 
					if(!empty($this->params['action']) && (($this->params['action']=='studentReport') || (($this->params['action']=='companyExternalOffer')))):
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
							<a class="navbar-brand" href="#">REPORTAR CONTRATACIONES:</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
							<ul class="nav navbar-nav">
							<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='studentReport')  )? 'active border-li' : 'border-li' ?> "	>
								<?= $this->Html->link('Ofertas Postuladas',['controller'=>'Companies','action' => 'studentReport',
																			'?' => array(
																			'nuevaBusqueda' => 'nuevaBusqueda',
																			),],
																			['class' => 'corriculumMenu']
																			);?>
							</li>
							<li class="whiteTextMenu <?php  echo (!empty($this->params['action']) && (($this->params['action']=='companyExternalOffer'))  )? 'active border-li' : 'border-li' ?> ">
							<?= $this->Html->link('Ofertas Externas', ['controller'=>'Companies','action'=>'companyExternalOffer', 'nuevaBusqueda']); ?>
							</li>
							</ul>	
						</div>
					</div>
				</nav>					
				<?php 
					endif; 
				?>
				
				<!-- Notificaciones -->
				<?php 
					if(!empty($this->params['action']) && (($this->params['action']=='companyPostullation') || ($this->params['action']=='companyNotification'))):
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
							<a class="navbar-brand" href="#">Notificaciones:</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
							<ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='companyPostullation') )? 'active border-li' : 'border-li' ?> "	>
									<?= $this->Html->link('Postulaciones',['controller'=>'Companies','action'=>'companyPostullation',  'nuevaBusqueda']); ?>
								</li>			
								
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='companyNotification') && ($this->Session->read('tipoNotificacion')==1))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-earphone"></i>&nbsp; Entrevistas telefónicas <span style="margin-left: 5px;">'.count($telefonicas).'</span>',['controller'=>'Companies','action'=>'companyNotification', '?' => ['tipoNotificacion' => 1]],['escape' => false]); ?>
								</li>
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='companyNotification') && ($this->Session->read('tipoNotificacion')==2))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-user"></i>&nbsp; Entrevistas presenciales <span style="margin-left: 5px;">'.count($presenciales).'</span>', ['controller'=>'Companies','action'=>'companyNotification', '?' => ['tipoNotificacion' => 2]],['escape' => false]); ?>
								</li>
									<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='companyNotification')&& ($this->Session->read('tipoNotificacion')==3))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-hand-left"></i>&nbsp; Contrataciones <span style="margin-left: 5px;">'.count($contrataciones).'</span>', ['controller'=>'Companies','action'=>'companyNotification', '?' => ['tipoNotificacion' => 3]],['escape' => false]); ?>
								</li>

								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='companyNotification')&& ($this->Session->read('tipoNotificacion')==4))) ? 'menu-profile active' : 'menu-profile' ?> "	>
									<?= $this->Html->link('<i class="glyphicon glyphicon-list"></i>&nbsp; Seguimiento de entrevistas <span style="margin-left: 5px;">'.count($seguimientos).'</span>', ['controller'=>'Companies','action'=>'companyNotification', '?' => ['tipoNotificacion' => 4]],['escape' => false]); ?>
								</li>
							</ul>	
						</div>
					</div>
				</nav>					
				<?php 
					endif; 
				?>
				
				<?php 
					if(!empty($this->params['action']) && (($this->params['action']=='searchCandidate') || (($this->params['action']=='viewCvOnline')) || (($this->params['action']=='specificSearchCandidate')) || (($this->params['action']=='specificSearchCandidateResults')))):
				?>
				<div class="header" id="top">		
					<nav class="navbar navbar-default navbar-static-top" style="margin-top: 5px;margin-bottom: 10px;z-index: 1;">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">BUSCAR CANDIDATOS:</a>
							</div>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
								<ul class="nav navbar-nav">
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && ($this->params['action']=='searchCandidate') || ($this->params['action']=='viewCvOnline') )? 'active border-li' : 'border-li' ?> "	>
									<?= $this->Html->link('Búsqueda Rápida',['controller'=>'Companies','action'=>'searchCandidate',  'nuevaBusqueda']); ?>
								</li>
								<li class="whiteTextMenu <?php echo (!empty($this->params['action']) && (($this->params['action']=='specificSearchCandidate')) || (($this->params['action']=='specificSearchCandidateResults')))? 'active border-li' : 'border-li' ?> "	>
									<?= $this->Html->link('Búsqueda Específica', ['controller'=>'Companies','action'=>'specificSearchCandidate', 'nuevaBusqueda']); ?>
								</li>
								</ul>	
							</div>
						</div>
					</nav>				
				</div>							
				<?php 
					endif; 
				?>
																	
				<?php if(!empty($this->params['action']) && ($this->params['action']=='viewCandidateOffer')): ?>
				<!--	<a class="navbar-brand" href="#" style=" background: #829ce0 none repeat scroll 0 0; --><!--margin-left: 0;  width: 1020px; height: 30px; padding-top: 5px; margin-bottom: 50px;" >Ver   
				<!--candidatos dentro de oferta</a> -->
				<?php endif; ?>
				<div style="margin-left: 20px;">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?> 
				</div>
		</div>
	</div>
	
	<!--Pie de página-->
	<div class="col-md-12 whiteText" style="text-align: center; background-color: #1a75bb; margin-top: 15px;  position:fixed;left:0px;bottom:0px;height:30px;width:100%;z-index: 1000;">
		<p style="margin: 7px;">Hecho en México, todos los derechos reservados.</p>
	</div>
						
	<!--Formulario de selección de carpetas-->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title whiteText" id="myModalLabel">Seleccione en que carpeta desea guardar la oferta.</h4>
				</div>
				<div class="modal-body">
							
					<?= $this->Form->create('Company', [
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
								'onsubmit' =>'return validaFormSaveStudent();',
								'action' => 'companySavedStudent',
					]); ?>				
					<fieldset>				
					<?= $this->Form->input('CompanySavedStudent.company_folder_id',['label'=>['text'=>'Carpetas disponibles','class'=>'col-md-5 control-label whiteText'], 'options' => $foldersList, 'default'=>'0','id' => 'estado','empty' => 'Selecciona una carpeta','class'=>'form-control selectpicker show-tick show-menu-arrow','required'=>'required']); ?>
					<?= $this->Form->input('CompanySavedStudent.student_id',['type' => 'hidden']); ?>								
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
					<h4 class="modal-title" id="myModalLabel" style="color: white;">Seleccione la fecha de prpijoijopuesta para la entrevista</h4>
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
	
	<!--Form para Agendar entrevista telefónica-->
	<div class="modal fade" id="myModalnotificationTelefonica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title whiteText" id="myModalLabel">Seleccione el día y la hora para la entrevista telefónica</h4>
				</div>
				<div class="modal-body">
					<?php 
						echo $this->Form->create('Company', array(
													'class' => 'form-horizontal', 
													'id' => 'FormTelephoneNotification',
													'role' => 'form',
													'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																							'div' => array('class' => 'form-group'),
																							'class' => 'form-control',
																							'before' => '<div class="col-md-12 ">',
																							'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
																							'after' => '</div></div>',
																							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
													),
															'action' => 'companyTelephoneNotification',
																		'onsubmit' =>'return validateTelephoneNotificationForm();'
						)); 
					?>
					<fieldset>
						<?php 	echo $this->Form->input('StudentNotification.student_id', array(
																						'type'=>'hidden',
																						'id'=>'StudentTelephoneNotificationId'
						)); ?>
						<?php 	echo $this->Form->input('CompanyInterviewMessage.id', array(
																					'type'=>'hidden',
																					'value'=>$company['CompanyInterviewMessage']['id'],
						)); ?>
						
					
						<?php 	echo $this->Form->input('StudentNotification.company_interview_message', array(
																			'id' => 'StudentTelephoneNotificationMessage',
																			'before' => '<div class="col-md-12 ">',
																			'style' => 'resize: vertical; min-height: 75px;  max-height: 280px; height: 75px;',
																			'maxlength' => '632',
																			'type' => 'textarea',
																			'value'=>$company['CompanyInterviewMessage']['telehone_interview_message'],
																			// 'id' => 'taComentario',
																			'label' => array(
																			'class' => 'col-md-0 control-label',
																			'text' => ''),
																			'placeholder' => 'Mensaje ',
						));	?>	
				

						
					<div class="col-md-12" style="float: right;">
						<div style="float: right;"><span id="contadorTaComentario" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span></div>
					</div>
					
					

						<center>	
							<h4 class="modal-title whiteText" id="myModalLabel">Fecha:</h4>						
							<?php echo $this->Form->input('StudentNotification.company_interview_date', array(				
							'id' => 'StudentTelephoneNotificationDate',
							'type' => 'date',
							'class' => 'selectpicker show-tick form-control show-menu-arrow',
							'data-width'=> '150px',
							'label' => array(
							'class' => 'col-sm-0 col-md-0 control-label',
							'text' => '',),
							'dateFormat' => 'YMD',
							'separator' => '',
							'minYear' => date('Y') - -2,
							'maxYear' => date('Y') - 0,	

							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
							)); ?>
							
							<h4 class="modal-title whiteText" id="myModalLabel">Hora:</h4>
							<?php echo $this->Form->input('StudentNotification.company_interview_hour', array(				
							'id' => 'StudentTelephoneNotificationHour',
							'type' => 'time',
							'timeFormat' => '24',
							'interval' => 15,
							'class' => 'selectpicker show-tick form-control show-menu-arrow',
							'data-width'=> '150px',
							'label' => array(
							'class' => 'col-sm-0 col-md-0 control-label',
							'text' => '',),

							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
							)); ?>

							<select  id="StudentAcademicSituationId" class="selectpicker show-tick form-control show-menu-arrow" required="required" name="data[StudentNotification][company_job_profile_id]" >
								<option value="">Seleccione el puesto interesado en el perfil</option>
								<?php 
									foreach($company['CompanyJobProfile'] as $k => $companyJobProfileId):

										$caracteres = strlen($companyJobProfileId['id']);
										$faltantes = 5 - $caracteres;	
										if($faltantes > 0):
											$ceros = '';
											for($cont=0; $cont<=$faltantes;$cont++):
												$ceros .= '0';
											endfor;
											$folio = $ceros.$companyJobProfileId['id'];
										else:
											$folio = strlen($companyJobProfileId['id']);
										endif;
										
										if(!empty($companyJobProfileId['CompanyJobContractType']) and ($companyJobProfileId['CompanyJobContractType']['salary']<>'')):
											$salario = $Salarios[$companyJobProfileId['CompanyJobContractType']['salary']];
										else:
											$salario = '';
										endif
								?>
								<option value=<?php echo $companyJobProfileId['id']; ?> > <?php echo $folio.' '.$companyJobProfileId['job_name'].' '.$salario; ?></option>
								<?php 
									endforeach;
								?>
							</select>
						</center>
					</fieldset>
				<div class="modal-footer">
					<?= $this->Form->button('<i class="glyphicon glyphicon-earphone"></i>&nbsp; Enviar',['type' => 'submit', 'div' => 'form-group','escape' => false,'class' => 'btn btn-default']); ?>
					<?= $this->Form->end(); ?>
				</div>
				
				</div>
				</div>
			</div>
		</div>
	</div>
	
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

	<!--Form para agendar entrevista personal-->
	<div class="modal fade" id="myModalnotificationPersonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content fondoBti">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title whiteText" id="myModalLabel">Indique los datos para la entrevista personal.</h4>
			</div>
			<div class="modal-body">
				<?php 
					echo $this->Form->create('Company', array(
												'class' => 'form-horizontal', 
												'id' => 'FormPersonalNotification',
												'role' => 'form',
												'inputDefaults' => array(
														'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
														'div' => array('class' => 'form-group'),
														'class' => 'form-control',
														'before' => '<div class="col-md-12 ">',
														'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
														'after' => '</div></div>',
														'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
				),
														'action' => 'companyPersonalNotification',
																	'onsubmit' =>'return validatePersonalNotificationForm();'
					)); 
				?>

				<fieldset>
					<?php 	echo $this->Form->input('StudentNotification.student_id', array(
								'id'=>'StudentPersonalNotificationId',
								'type'=>'hidden', 
								'class'=>'StudentNotificationStudentId'
					)); ?>												
					<?php 	echo $this->Form->input('CompanyInterviewMessage.id', array(
								'type'=>'hidden',
								'value'=>$company['CompanyInterviewMessage']['id'],
					)); ?>
					<?php 	echo $this->Form->input('StudentNotification.company_interview_message', array(
								'id' => 'StudentPersonalNotificationMessage',
								'before' => '<div class="col-md-12 ">',
								'style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;',
								'maxlength' => '316',
								'type' => 'textarea',
								'value'=>$company['CompanyInterviewMessage']['personal_interview_message'],
								// 'id' => 'taComentario',
								'label' => array(
								'class' => 'col-md-0 control-label',
								'text' => ''),
								'placeholder' => 'Mensaje ',
					));	?>																										
				<center>
					<h4 class="modal-title whiteText" id="myModalLabel">Fecha:</h4>						
					<?php echo $this->Form->input('StudentPersonalNotification.company_interview_date', array(				
						'id' => 'StudentPersonalNotificationDate',
						'type' => 'date',
						'class' => 'selectpicker show-tick form-control show-menu-arrow',
						'data-width'=> '150px',
						'label' => array(
						'class' => 'col-sm-0 col-md-0 control-label',
						'text' => '',),
						'dateFormat' => 'YMD',
						'separator' => '',
						'minYear' => date('Y') - -2,
						'maxYear' => date('Y') - 0,	

						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
						)); ?>
					<h4 class="modal-title whiteText" id="myModalLabel">Hora:</h4>
					<?php echo $this->Form->input('StudentPersonalNotification.company_interview_hour', array(				

						'type' => 'time',
						'timeFormat' => '24',
						'interval' => 15,
						'class' => 'selectpicker show-tick form-control show-menu-arrow',
						'data-width'=> '150px',
						'label' => array(
						'class' => 'col-sm-0 col-md-0 control-label',
						'text' => '',),

						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
					)); ?>
					<?php 	echo $this->Form->input('StudentNotification.company_interview_direction', array(
							'before' => '<div class="col-md-12 ">',
							'between' => ' <div class="col-md-11" style="margin-top: 20px; padding-right: 0px;">',
							'label' => array(
										'class' => 'col-md-0 control-label',
										'text' => ''),
							'placeholder' => 'Dirección ',
					));	?>
					<?php 	echo $this->Form->input('StudentNotification.company_contact_name', array(
							'before' => '<div class="col-md-12 ">',
							'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
							'label' => array(
							'class' => 'col-md-0 control-label',
							'text' => ''),
							'placeholder' => 'Nombre del entrevistador ',
					));	?>
					<?php 	echo $this->Form->input('StudentNotification.company_contact', array(
							'before' => '<div class="col-md-12 ">',
							'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
							'label' => array(
							'class' => 'col-md-0 control-label',
							'text' => ''),
							'placeholder' => 'Contacto entrevistador',
					));	?>
					<?php 	echo $this->Form->input('StudentNotification.company_interview_document', array(
							'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
							'label' => array(
							'class' => 'col-md-0 control-label',
							'text' => ''),
							'placeholder' => 'Documentos',
					));	?>
					<select  id="StudentAcademicSituationId" class="selectpicker show-tick form-control show-menu-arrow"" required="required" name="data[StudentNotification][company_job_profile_id]" >
						<option value="">Seleccione el puesto interesado en el perfil</option>
						<?php 
							foreach($company['CompanyJobProfile'] as $k => $companyJobProfileId):

								$caracteres = strlen($companyJobProfileId['id']);
								$faltantes = 5 - $caracteres;	
								if($faltantes > 0):
									$ceros = '';
									for($cont=0; $cont<=$faltantes;$cont++):
										$ceros .= '0';
									endfor;
									$folio = $ceros.$companyJobProfileId['id'];
								else:
									$folio = strlen($companyJobProfileId['id']);
								endif;
								
								if(!empty($companyJobProfileId['CompanyJobContractType']) and ($companyJobProfileId['CompanyJobContractType']['salary']<>'')):
									$salario = $Salarios[$companyJobProfileId['CompanyJobContractType']['salary']];
								else:
									$salario = '';
								endif
						?>
						<option value=<?php echo $companyJobProfileId['id']; ?> > <?php echo $folio.' '.$companyJobProfileId['job_name'].' '.$salario; ?></option>
						<?php 
							endforeach;
						?>	
					</select>
				</center>
				</fieldset>
				<div class="modal-footer">
					<?= $this->Form->button('<i class="glyphicon glyphicon-user"></i>&nbsp; Enviar',['type' => 'submit', 'div' => 'form-group','escape' => false,'class' => 'btn btn-default']); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>


		<!-- modal vigencia -->
	<div class="modal fade" id="myModalVigencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title whiteText" id="myModalLabel">Seleccione la fecha de vigencia para la oferta</h4>
				</div>
				<div class="modal-body" >
	
					<?= $this->Form->create('Company', [
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
						<center>
							<?= $this->Form->input('CompanyJobProfile.expiration', [
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'data-width'=> '160px',
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
				
					</center>
					</fieldset>
				</div>
				<div class="modal-footer">
						<?= $this->Form->button('<i class="glyphicon glyphicon-calendar"></i>&nbsp; Enviar',['type' => 'submit', 'div' => 'form-group','escape' => false,'class' => 'btn btn-default']); ?>
						<?= $this->Form->end(); ?>
					</div>
			</div>
		</div>
	</div>

	<!--Reportar contratación-->
	<div class="modal fade" id="myModalReportarContratacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title whiteText" id="myModalLabel">Reportar contratación.</h4>
				</div>
				<div class="modal-body">
					<?php 
					echo $this->Form->create('Company', array(
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
																'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																								'div' => array('class' => 'form-group'),
																								'class' => 'form-control',
																								'before' => '<div class="col-md-12 ">',
																								'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
																								'after' => '</div></div>',
																								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
														),
														'onsubmit' =>'return validarReportarContratacionForm();',
														'action' => 'reportarContratacion',
					)); 
					?>
					<fieldset>
					   <center>
						<?php 	echo $this->Form->input('StudentReportarContratacion.student_id', array('type'=>'hidden')); ?>

						<h4 class="modal-title whiteText" id="myModalLabel">Fecha.</h4>
						<?php echo $this->Form->input('StudentReportarContratacion.fecha_contratacion', array(				
							'type' => 'date',
							'class' => 'selectpicker show-tick form-control show-menu-arrow',
							'data-width'=> '150px',
							'label' => array(
							'class' => 'col-sm-0 col-md-0 control-label',
							'text' => '',),
							'dateFormat' => 'YMD',
							'separator' => '',
							'minYear' => date('Y') - -2,
							'maxYear' => date('Y') - 0,	

							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
						)); ?>
							<select  id="StudentAcademicSituationId" class="selectpicker show-tick form-control show-menu-arrow" required="required" name="data[StudentReportarContratacion][company_job_profile_id]" >
								<option value="">Seleccione el puesto que cubrió el candidato</option>
									<?php 
										foreach($company['CompanyJobProfile'] as $k => $companyJobProfileId):

											$caracteres = strlen($companyJobProfileId['id']);
											$faltantes = 5 - $caracteres;	
											if($faltantes > 0):
												$ceros = '';
												for($cont=0; $cont<=$faltantes;$cont++):
													$ceros .= '0';
												endfor;
												$folio = $ceros.$companyJobProfileId['id'];
											else:
												$folio = strlen($companyJobProfileId['id']);
											endif;
											
											if(!empty($companyJobProfileId['CompanyJobContractType']) and ($companyJobProfileId['CompanyJobContractType']['salary']<>'')):
												$salario = $Salarios[$companyJobProfileId['CompanyJobContractType']['salary']];
											else:
												$salario = '';
											endif
									?>
								<option value=<?php echo $companyJobProfileId['id']; ?> > <?php echo $folio.' '.$companyJobProfileId['job_name'].' '.$salario; ?></option>
									<?php 
										endforeach;
									?>
							</select>		
					   </center>
					</fieldset>
					<div class="modal-footer">
						<?= $this->Form->button('<i class="glyphicon glyphicon-ok-sign"></i>&nbsp; Enviar',['type' => 'submit', 'div' => 'form-group','escape' => false,'class' => 'btn btn-default']); ?>
						<?= $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Correo-->
	<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content fondoBti">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" style="color: #fff">Envio de correo electrónico </h4>
				</div>
				<div class="modal-body col-md-12">
					<?= $this->Form->create('Company', [
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
								'action' => 'companyEmailNotification',]); ?>
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
	
	<?php
		echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar Foto',							
		['controller'=>'Companies',
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