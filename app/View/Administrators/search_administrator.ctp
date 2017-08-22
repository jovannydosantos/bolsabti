	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		$(document).ready(function() {
			
			init_contadorTa("messageIdEmail","contadorTaComentario2", 632);
			updateContadorTa("messageIdEmail","contadorTaComentario2", 632);
			
			//Contador de caracteres para las notificaciones telefónicas 
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
		
			typeSearch();
		});
			
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("AdministratorCriterio").selectedIndex;
			if(selectedIndexTypeSearch==4){
				$("#idDivBuscar").hide();
				$("#idDivBuscarSelect").show();
				$('#CompanyBuscar').val('');
				
			} else {
				$("#idDivBuscar").show();
				$("#idDivBuscarSelect").hide();
				document.getElementById('AdministratorBuscarEscuelaFacultad').options[0].selected = 'selected';
			}
			
			if(selectedIndexTypeSearch==1){
				$("#AdministratorBuscar").attr("placeholder", "Ingrese el nombre(s)");
			}
			else
				if(selectedIndexTypeSearch==2){
					$("#AdministratorBuscar").attr("placeholder", "Ingrese el apellido(s)");
				}
				else
					if(selectedIndexTypeSearch==3){
						$("#AdministratorBuscar").attr("placeholder", "Ingrese el correo electrónico");
					}
					else
						if(selectedIndexTypeSearch==4){
							$("#AdministratorBuscar").attr("placeholder", "Seleccione la Ecuela / Facultad");
						}
						else{
							$("#AdministratorBuscar").attr("placeholder", "Nombre administrador / Correo electrónico / Folio ");
					}
		}
		
		function deleteAdministrador(param, name){
				document.getElementById('focusAdminId'+param).scrollIntoView();
				if(param==1){
					jAlert('El administrador principal no puede ser eliminado');
				}else{
					jConfirm('¿Realmente desea eliminar a este administrador: '+name+'?', 'Confirmación', function(r){
						if( r ){
							$("#deleteAdminId"+param).click();
						}
					});
				}
		}
		
		function avisoSameAdmin(){
			jAlert('El mismo administrador no puede cambiar su estatus', 'Mensaje');
			return false;
		}
		
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			selectedIndexCarrera = document.getElementById("AdministratorBuscarEscuelaFacultad").selectedIndex;
			
			if(selectedIndex == 0){
				$( "#AdministratorCriterio" ).focus();
				jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
				document.getElementById('AdministratorCriterio').focus();
				return false;
			} else 
			if((selectedIndex != 4) && (document.getElementById('AdministratorBuscar').value == '')){
				jAlert('Ingrese la palabra a buscar', 'Mensaje');
				document.getElementById('AdministratorBuscar').focus();
				return false;
			} else 
			if((selectedIndex == 4) && (selectedIndexCarrera==0)){
				jAlert('Seleccione la Escuela/Facultad', 'Mensaje');
				document.getElementById('AdministratorBuscarEscuelaFacultad').focus();
				return false;
			}else {
				return true;
			}
		}
		
		function saveEmailNotification(email){
				document.getElementById('StudentEmailTo').value = email;
				$('#myModalMail').modal('show');
		}
			
		function cambiarContenido(){
				var archivo = document.getElementById('StudentFile').value;
				extensiones_permitidas = new Array(".jpg",".pdf");
				mierror = "";

				if (!archivo) {
						jAlert('No se ha adjuntado ningún archivo', 'Mensaje');
						document.getElementById('StudentFile').scrollIntoView();
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
							jAlert("Compruebe la extensión de su archivo. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(), 'Mensaje');
							document.getElementById('StudentFile').scrollIntoView();
							deleteText();
							return false;
						}else{
							document.getElementById("textFile").innerHTML = document.getElementById('StudentFile').value + '<button id="deleteTextId" onclick="deleteText();" class="btnBlue" style="margin-left: 10px;" >x</button>';
							return false;
						}
				   }
		}
			
		function deleteText(){
			document.getElementById("textFile").innerHTML = '';
			document.getElementById('StudentFile').value = '';  
			return false;
		}
		
		function sendPaginado(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById("sendPaginadoForm").submit();
			 }
		}
	</script>
	
	<div class="col-md-12">	
		<?php echo $this->Session->flash(); ?>	
	</div>
	
	<div class="col-md-12" style="margin-bottom: 10px;">
		<p>El sistema buscará por el siguiente criterio: nombre(s), apellidos(s), correo electrónico o escuela / facultad.</p>
	</div>
	
	<div class="col-md-9"  style="padding-left: 0px;">
				<?php 
					echo $this->Form->create('Administrator', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-12">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'searchAdministrator',
									'onsubmit' =>'return validateEmpty();'
					)); ?>		
					<fieldset>
						<div class="col-md-7" style="padding-right: 0px;" id="idDivBuscar">
						<?php echo $this->Form->input('Buscar', array(
																'before' => '<div class="col-md-12" style="padding-left: 0px;">',
																'label' =>'',
																'value'	=> $this->Session->read('palabraBuscada'), 
																'placeholder' => 'Buscar...',
																
						));	?>
						</div>
						<div class="col-md-7" style="padding-right: 0px;" id="idDivBuscarSelect">
						<?php echo $this->Form->input('buscarEscuelaFacultad', array(
																'before' => '<div class="col-md-12" style="padding-left: 0px;">',
																'type' => 'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'value'	=> $this->Session->read('palabraBuscada'), 
																'label' =>'',
																'options' => $EscuelasFacultades, 'default'=>'0', 'empty' => 'Escuelas / Facultades'
						));	?>
						</div>
						<div  class="col-md-4" style="padding-left: 0px; padding-right: 0px;">
						<?php 	$options = array('1' => 'Nombre(s)', '2' => 'Apellidos(s)', '3' => 'Correo electrónico', '4' =>'Escuela / Facultad');
								echo $this->Form->input('criterio', array(
														'type'=>'select',
														'selected' => $this->Session->read('tipoBusqueda'),
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'before' => '<div class="col-md-12" style="padding-left: 0px;">',
														'label' =>'',
														'onchange' => 'typeSearch()',
														'options' => $options,'default'=>'0', 'empty' => 'Criterio de búsqueda'
								)); ?>
						</div>

						<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>
						
						<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
							<?php 
							echo $this->Form->button(
													'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
													array(
														'type' => 'submit',
														'div' => 'form-group',
														'class' => 'btn btnBlue btn-default',
														'style' => 'width: 130px;',
														'escape' => false,
													)
							);

							echo $this->Form->end(); 
							?>
							<img data-toggle="tooltip" id="" data-placement="top" title="El sistema realiza búsquedas escribiendo alguna(s) palabra(s) clave(s) en el campo abierto. Ejemplos:  Juan, González, apérez@unam.mx, Facultad de filosofía y letras" alt="help.png" src="/unam/img/help.png" style="margin-left: 220%; margin-top: -90%;" class="img-circle cambia">
						</div>
					</fieldset>
	</div>
	
	
		<div class="col-md-8"  style="padding-left: 0px;">
			<?php if(isset($administradores)): 
					if(empty($administradores)):
						echo '<div class="col-md-9"  style="padding-left: 0px; margin-left: 15px">';
							echo '<p style="font-size: 22px; ">Sin resultados</p>';
						echo '</div>';
					else:
			?>
			
				<div class="col-md-12">
					<p style=" margin-left: 15px">Resultados de Búsqueda</p>
				</div>
				
				<div class="col-md-3" >
						<?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Administrators',
																	'action'=>'searchAdministratorsExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 160px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
				</div>
	
				<div class="col-md-5">
					<?php 	
							echo $this->Form->create('Administrator', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'id' => 'sendPaginadoForm',
									'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-12">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'searchAdministrator',
							)); 
					
							$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
							echo $this->Form->input('Company.limite', array(
																'onchange' => 'sendPaginado()',
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'id'=> 'limit',
																'before' => '<div class="col-md-12 "',
																'selected' => $this->Session->read('limiteAdmin'),
																'label' =>'',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
					)); 
					
					echo $this->Form->end(); 
						
					?>
				</div>
			
		</div>
			
		<div class="col-md-10" style="max-height: 840px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-top: 10px;">
					
					<?php 
						foreach($administradores as $k => $administrador):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 135px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 0px; right: -25px;">    
						
							<div class="col-md-6" style="margin-top: 10px; text-align: left; margin-left: 20px; margin-top: 20px; margin-bottom: 20px;">
								<?php
									$caracteres = strlen($administrador['Administrator']['id']);
									$faltantes = 5 - $caracteres;	
									if($faltantes > 0):
										$ceros = '';
										for($cont=0; $cont<=$faltantes;$cont++):
											$ceros .= '0';
										endfor;
										$folio = $ceros.$administrador['Administrator']['id'];
									else:
										$folio = strlen($administrador['Administrator']['id']);
									endif;
								?>
								<p class="blackText">Folio: <?php echo $folio; ?></p>
								<p class="blackText">Nombre: <span style="font-weight: normal;"><?php  echo $administrador['AdministratorProfile']['contact_name']; ?> </span></p>
								<p class="blackText">Apellido paterno: <span style="font-weight: normal;"><?php  echo $administrador['AdministratorProfile']['contact_last_name']; ?> </span></p>
								<p class="blackText">Apellido materno: <span style="font-weight: normal;"><?php  echo $administrador['AdministratorProfile']['contact_second_last_name']; ?> </span></p>
								<?php 
									if($administrador['AdministratorProfile']['institution']<>''):
										echo '<p class="blackText">Escuela / Facultad: <span style="font-weight: normal;">'.$EscuelasFacultades[$administrador['AdministratorProfile']['institution']].'</span></p>';
									else:
										echo '<p class="blackText">Escuela / Facultad: <span style="font-weight: normal;">Sin especificar</span></p>';
									endif;
								?>
								<p class="blackText">Cargo: <span style="font-weight: normal;"><?php  echo $administrador['AdministratorProfile']['contact_position']; ?> </span></p>
								<?php 
									echo ($administrador['AdministratorProfile']['telephone'] <> '') ? '<p class="blackText">Teléfono: <span style="font-weight: normal;">'. $administrador['AdministratorProfile']['long_distance_cod'].$administrador['AdministratorProfile']['telephone'].'</span></p>' : '';
									echo ($administrador['AdministratorProfile']['cell_phone'] <> '') ? '<p class="blackText">Celular: <span style="font-weight: normal;">'.$administrador['AdministratorProfile']['long_distance_cod_cell_phone'].$administrador['AdministratorProfile']['cell_phone'] . '</span></p>' : '';
								?>

							</div>
						
							<div style="background: #58595B; float: right;  height: 30px; padding-left: 15px;">
								<div style="margin-top: 3px" class="grises2">
								<?php 
								 // Descativar - Activar Administrador
								 if($administrador['Administrator']['role'] == 'administrator'):
									echo $this->Html->image('student/activa.png',
											array(
												'title' => 'Administrador activo click para desactivar',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
												'onclick' => 'avisoAdmin();',
		
									));
								else:
									if($administrador['Administrator']['id'] == $this->Session->read('Auth.User.id')):
										echo $this->Html->image('student/activa.png',
												array(
													'title' => 'Administrador activo click para desactivar',
													'class' => 'class="img-responsive center-block"',
													'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
													'onclick' => 'avisoSameAdmin();',
			
										));
									
									else:
										if($administrador['Administrator']['status'] == 0):
											echo $this->Html->image('student/noActiva.png',
												array(
													'title' => 'Administrador inactivo click para activar',
													'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
													'class' => 'class="img-responsive center-block"',
													'url' => array(
																	'controller'=>'Administrators',
																	'action'=>'enableDisableAdministrator',
																	'?' => array(
																				'id' => $administrador['Administrator']['id'],
																				'estatus' => $administrador['Administrator']['status'],
																			)
																	),
													)
											);
										else:
											echo $this->Html->image('student/activa.png',
												array(
													'title' => 'Administrador activo click para desactivar',
													'class' => 'class="img-responsive center-block"',
													'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
													'url' => array(
																	'controller'=>'Administrators',
																	'action'=>'enableDisableAdministrator',
																	'?' => array(
																				'id' => $administrador['Administrator']['id'],
																				'estatus' => $administrador['Administrator']['status'],
																			)
																	),
												));
										endif;
									endif;
								endif;
								?>
								<?php 
									echo $this->Html->image('administrator/arroba.png',
												array(
													'title' => 'Enviar correo',
													'class' => 'class="img-responsive center-block"',
													'onclick' => 'saveEmailNotification("'.$administrador['Administrator']['email'].'");',
													'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
													)
													);	
									
								?>
								<?php 
									 // Eliminar administrador
									 echo $this->Html->image('student/eliminar.png',
												array(
													'title' => 'Eliminar administrador',
													'style' => 'width: 20px; height: 20px; margin-right: 10px; cursor: pointer;',
													'class' => 'class="img-responsive center-block"',
													'id' => 'focusAdminId'.$administrador['Administrator']['id'],
													'onclick' => 'deleteAdministrador('.$administrador['Administrator']['id'].',"'.$administrador['Administrator']['username'].'");'
													)
											);
											
									 echo $this->Form->postLink(
															$this->Html->image('student/eliminar.png',
															array('alt' => 'Eliminar administrador', 'title' =>'Eliminar administrador', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteAdminId'.$administrador['Administrator']['id'] )), 
															array('action' => 'deleteAdministrator',$administrador['Administrator']['id']), 
															array('escape' => false) 
															);
									?>
								</div>
							</div>
						
							<div class="col-xs-5" style="margin-top: 10px; text-align: left; padding-right: 0px; padding-left: 0px;  margin-top: 15px; margin-bottom: 20px;">
									<p class="blackText">Correo electrónico: <span style="font-weight: normal;"><?php  echo $administrador['Administrator']['email']; ?> </span></p>
									<p class="blackText">Usuario: <span style="font-weight: normal;"><?php  echo $administrador['Administrator']['username']; ?> </span></p>
									<?php
									if(($administrador['Administrator']['role'] == 'administrator') and ($this->Session->read('Auth.User.role') == 'subadministrator')):	
										echo $this->Form->button(
															'Editar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-pencil"></i>', 
															array(
																'type' => 'button',
																'div' => 'form-group',
																'class' => 'btn btnRed col-md-8',
																'style' => 'margin-top: 20px; margin-left: 115px;',
																'escape' => false,
																'onclick' => 'avisoAdmin('.$administrador['Administrator']['id'].');',
															)
										);
									else:
										echo $this->Html->link(
															'Editar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-pencil"></i>', 
															array(
																'controller'=>'Administrators',
																'action'=>'editAdministratorProfile', $administrador['Administrator']['id']),
															array(
																'class' => 'btn btnRed col-md-8',
																'style' => 'margin-top: 20px; margin-left: 115px;',
																'escape' => false)	
									); 	
									endif;
									?>
								
							</div>
						
						</div>
					<?php endforeach; ?>
			<?php 
					endif;
				endif; 
			?>
		</div>
		
		<div class="col-md-11" style="margin-left:17px;">
		<?php 
			if(!empty($administrador)):
		?>
		<p>
			<?php echo $this->Paginator->counter(
			array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
			); ?>
		</p>
		
		<div class="pagin">
			<?php echo $this->Paginator->first('<< primero');?>
			<?php echo $this->Paginator->prev('< anterior', array(), null, array('class' => 'prev disabled')); ?>
			<?php echo $this->Paginator->numbers(array('separator'=>'')); ?>
			<?php echo $this->Paginator->next('siguiente >', array(), null, array('class' => 'next disabled'));?>
			<?php echo $this->Paginator->last('último >>');?>
		</div>	
		
		<?php endif; ?>
		</div>
		
		
		<!--Form para envio de correo -->
		<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Envio de correo electrónico </h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 440px;">
									<?php
										echo $this->Form->create('Administrator', array(
														'type' => 'file',
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " >',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
														),
														'action' => 'sendEmailAdministrator'
									)); ?>
										<style type="text/css">
											.upload {
												width: 154px;
												height: 35px;
												background: url("<?php echo $this->webroot; ?>/img/adjuntarboton.png");
												overflow: hidden;
												background-repeat-x: no-repeat;
												background-repeat:no-repeat;
												margin-left: 35px;
												margin-top: -28px;
											}
										</style>

										<fieldset style="margin-top: 30px;">
											
											<?php echo $this->Form->input('Student.emailTo', array(
																					'readonly' => 'readonly',
																					'before' => '<div class="col-md-9 ">',	
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'style' => 'left: 6px;',
																									'text' => '',
																								),
																					'placeholder' => 'Correo',
											)); ?>
											<?php echo $this->Form->input('Student.CC', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style'	=> 'margin-left: -15px;',		
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CC:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CC',
											)); ?>
											<?php echo $this->Form->input('Student.CCO', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style' => 'margin-left: -15px;',			
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CCO:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CCO',
											)); ?>
											<?php echo $this->Form->input('Student.title', array(
																					'before' => '<div class="col-md-9 "><img data-toggle="tooltip" id="" data-placement="top" title="Ingresar asunto del mensaje, breve y conciso." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 8px;">',
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'style' => 'margin-left: -5px;',				
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 5px;',
																									),
																					'placeholder' => 'Título',
											)); ?>
											
											<?php echo $this->Form->input('Student.file', array(
																					'type' => 'file',
																					'before' => '<div class="col-md-12 ">',
																					'between' => '<div class="col-xs-11 col-sm-9 col-md-8 upload">',
																					'style' => 'display: block !important;
																														width: 157px !important;
																														height: 57px !important;
																														opacity: 0 !important;
																														overflow: hidden !important;
																														background-repeat-y: no-repeat;
																														cursor: pointer;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-6 col-md-3 control-label',
																									'text' => 'máx. 200kb'
																									),
																					'onchange' => 'cambiarContenido()'
																					
											)); ?>
											<div class="col-md-12" >
												<p id="textFile" style="border-top-width: 0px; margin-left: 18px; "></p>
											</div>
											<?php echo $this->Form->input('Student.message', array(	
																						'type' => 'textarea',
																						'rows' => '5',
																						'cols' => '5',
																						'maxlength' => '632',
																						'id' => 'messageIdEmail',
																						'before' => '<div class="col-md-12 ">',
																						'style' => 'margin-left: -25px; resize: vertical; min-height: 75px;  max-height: 150px; height: 130px;',
																						'label' => array(
																										'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																										'text' => '',
																										'style' => 'margin-top: -5px;left: -7px;',
																						),
																						'placeholder' => 'Cuerpo del correo'
											)); ?>
											<div class="col-md-11 form-group row" style="text-align: right; top: -10px; margin-left: 7px; margin-bottom: 0px;padding-right: 22px;">
												<span id="contadorTaComentario2" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span>
												<img data-toggle="tooltip" id="" data-placement="left" title="Mensaje que le será enviado al candidato" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -55px;">
											</div>
													
											<?php echo $this->Form->input('Student.sign', array(	
																					'before' => '<div class="col-md-6 "><img data-toggle="tooltip" id="" data-placement="top" title="Texto de identificación que será presentado en todos los correos que envíe.Se sugiere los siguientes datos: nombre, cargo y empresa, teléfono de contacto, redes sociales." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: -5px;margin-top: 8px;">',
																					'style' => 'margin-left: -10px;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 10px;',
																									),
																					'placeholder' => 'Firma',
																					'between' => '<div class="col-xs-11 col-sm-8 col-md-4 ">',

											)); ?>
										</fieldset>

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Enviar',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-3 col-md-offset-8'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>