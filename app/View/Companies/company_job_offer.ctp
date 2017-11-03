<?php 
	$this->layout = 'company'; 
?>
	<script>
		$(document).ready(function() {
			var helpText = [
							"Si el responsable de la oferta es el mismo que el contacto dado de alta en el registro, seleccione Si y automáticamente se llenarán los campos con la información proporcionada. En caso de seleccionar No le pedimos ingresar los datos para seguir con el registro de la oferta.", 
							"", 
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"Dirección electrónica otorgada por la empresa o institución al responsable de la oferta.",
							"",
							"Si desea mantener la confidencialidad de la empresa ofertante, seleccione Si y escriba en el recuadro de abajo el nombre de la empresa que se mostrará en la oferta o déjelo vacío para que solo aparezca el letrero: “Confidencial”. Si selecciona Si en esta opción, los datos de contacto del responsable de la oferta tampoco aparecerán.",
							"",
							"Si desea mantener ocultos los datos de contacto del responsable de la oferta, seleccione Si"
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});	
			
			desabilityOptions();
			desabilityconfidencial();
			copyEmail();
		});
	
	function copyEmail(){
		document.getElementById("CompanyJobOfferCompanyEmailConfirm").value = document.getElementById("CompanyJobOfferCompanyEmail").value ;
	}
	
		
	function desabilityOptions(){
		if(document.getElementById("CompanyJobOfferSameContact").value == 'n') {  
			$('#mismoContactoId').show();
		} else {
			$('#mismoContactoId').hide();
		}
	}
	
	
	
	function vaciarCajas(){
		$('#CompanyJobOfferResponsibleName').val('');
		$('#CompanyJobOfferResponsibleLastName').val('');
		$('#CompanyJobOfferResponsibleSecondLastName').val('');
		$('#CompanyJobOfferResponsiblePosition').val('');
		$('#CompanyJobOfferResponsibleLongDistanceCod').val('');
		$('#CompanyJobOfferResponsibleTelephone').val('');
		$('#CompanyJobOfferResponsiblePhoneExtension').val('');
		$('#CompanyJobOfferResponsibleLongDistanceCodCellPhone').val('');
		$('#CompanyJobOfferResponsibleCellPhone').val('');
		$('#CompanyJobOfferCompanyEmail').val('');
		$('#CompanyJobOfferCompanyEmailConfirm').val('');
		
		
			
			if(document.getElementById("CompanyJobOfferSameContactS").value == 's') {  
				  var disabilityValue = 's';
			} else if(document.getElementById("CompanyJobOfferSameContactS").value == 'n'){
				 var disabilityValue = 'n';   
			}else{
				var disabilityValue = '';  
			}
			
			if (disabilityValue == 'n'){
				$("#mismoContactoId").show();
			} else {
				$("#mismoContactoId").hide();
			}	
	}
	
	
	function desabilityconfidencial(){
		if(document.getElementById("CompanyJobOfferConfidentialJobOffer").value == 'n') {  
			$('#bloque1').show();
			 $('#CompanyJobOfferCompanyName').val('');
		} else {
			$('#bloque1').hide();
		}
	}
	

	
	function validateInputs(){
				
		if(document.getElementById("CompanyJobOfferSameContact").value == 's') {  
				var value1 = 's';  
		} else if(document.getElementById("CompanyJobOfferSameContact").value == 'n') {  
				var value1 = 'n';  
		} else{
			var value1 = '';  
			
		}
		
			
			if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleName').value == '')){
				//jAlert('', 'Mensaje');
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el nombre'});
				document.getElementById('CompanyJobOfferResponsibleName').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleLastName').value == '')){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el apellido paterno'});
				document.getElementById('CompanyJobOfferResponsibleLastName').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsiblePosition').value == '')){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el cargo'});
				document.getElementById('CompanyJobOfferResponsiblePosition').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleLongDistanceCod').value == '')){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese la lada'});
				document.getElementById('CompanyJobOfferResponsibleLongDistanceCod').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleTelephone').value == '')){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el teléfono de contacto'});
				document.getElementById('CompanyJobOfferResponsibleTelephone').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferCompanyEmail').value == '')){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el correo institucional'});
				document.getElementById('CompanyJobOfferCompanyEmail').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferCompanyEmailConfirm').value == '')){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese la confirmación del correo institucional'});
				document.getElementById('CompanyJobOfferCompanyEmailConfirm').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferCompanyEmail').value != document.getElementById('CompanyJobOfferCompanyEmailConfirm').value)){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Los correos electrónicos no coinciden'});
				document.getElementById('CompanyJobOfferCompanyEmail').focus();
				return false;
			}
			else {
				return true;
			}			
	}
	</script>

	
<div class="col-md-12">
	<?= $this->Form->create('Company', [
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
								'action' => 'companyJobOffer',
								'onsubmit' =>'return validateInputs();']); 
	?>
	<fieldset>
		<div class="col-md-6">
			<div class="col-md-12">
			
			<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobOffer.same_contact', ['type' => 'select','default'=> 0,'empty' => '¿Son los mismos datos del contacto de registro?','options' => $options,'onchange' => 'desabilityOptions()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
			?>
			</div>
	
			<div id="mismoContactoId" style="display:none">
				<div class="col-md-12">
					<?= $this->Form->input('CompanyJobOffer.responsible_name', ['placeholder' => 'Nombre']); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->input('CompanyJobOffer.responsible_last_name', ['placeholder' => 'Apellido paterno']); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->input('CompanyJobOffer.responsible_second_last_name', ['placeholder' => 'Apellido materno']); ?>
				</div>
				<div class="col-md-12">
					<?= $this->Form->input('CompanyJobOffer.responsible_position', ['placeholder' => 'Cargo']); ?>
				</div>
				<div class="col-md-3">
					<?= $this->Form->input('CompanyJobOffer.responsible_long_distance_cod', ['placeholder' => 'Lada','maxlength' => '5']); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->input('CompanyJobOffer.responsible_telephone', ['placeholder' => 'Telefono de contacto','maxlength' => '10']); ?>
				</div>
				<div class="col-md-3">
					<?= $this->Form->input('CompanyJobOffer.responsible_phone_extension', ['placeholder' => 'Extension','maxlength' => '5']); ?>
				</div>
				<div class="col-md-3">
					<?= $this->Form->input('CompanyJobOffer.responsible_long_distance_cod_cell_phone', ['placeholder' => 'Lada','maxlength' => '5']); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->input('CompanyJobOffer.responsible_cell_phone', ['placeholder' => 'Telefono celular','maxlength' => '10']); ?>
				</div>
				<div class="col-md-12">
					<?= $this->Form->input('CompanyJobOffer.company_email', ['placeholder' => 'Correo institucional']); ?>
				</div>
				<div class="col-md-12">
					<?= $this->Form->input('CompanyJobOffer.company_email_confirm', ['placeholder' => 'Confirmar correo institucional']); ?>
				</div>
			</div>
		</div>
	

		<div class="col-md-6">
			<div class="col-md-12">
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobOffer.confidential_job_offer', ['type' => 'select','default'=> 0,'empty' => '¿Oferta confidencial?','options' => $options,'onchange' => 'desabilityconfidencial()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
			</div>
			<div id="bloque1" style="display: none">	
				<div class="col-md-12">
					<?= $this->Form->input('CompanyJobOffer.company_name', ['placeholder' => 'Nombre de la empresa o institución que aparecerá en la oferta']); ?>
				</div>
			</div>	
			<div class="col-md-12">
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobOffer.show_details_responsible', ['type' => 'select','default'=> 0,'empty' => '¿Mostrar datos del reponsable de la oferta?','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
			</div>	

			<div class="col-md-12" style="margin-top: 30px;">				
				<?php if(($this->Session->check('CompanyJobOffer.id') == true) and (!empty($this->request->data))): ?>
				<div class="col-md-6">
					<?php else:;?>
					<div class="col-md-6 col-md-offset-2">
						<?php endif; ?>
						<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary btn-bti','escape' => false]);
						echo $this->Form->end(); 
						?>
					</div>
					<?php if(($this->Session->check('CompanyJobOffer.id') == true) and (!empty($this->request->data))): ?>
					<div class="col-md-6">
						<div class="btn-group">
							<?php echo $this->Html->link('Continuar &nbsp; <i class="glyphicon glyphicon-arrow-right"></i>',
							array(
								'controller'=>'Companies',
								'action'=>'companyJobProfile',
							),
							array(
								'class' => 'btn btn-primary btn-bti',
							//	'style' => 'width: 130px;',
								'escape' => false,
								)	
							); 	?> 
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>	

	</fieldset>	
</div>
	
	
	