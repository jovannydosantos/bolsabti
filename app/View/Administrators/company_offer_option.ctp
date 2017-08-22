<?php	
	$this->layout = 'administrator'; 
?>	

	<script>
		
		$(document).ready(function() {
			$("#CompanyOfferOptionEndDateCompanyYear").css("width", "65px");
			$("#CompanyOfferOptionEndDateCompanyMonth").css("width", "90px");
			$("#CompanyOfferOptionEndDateCompanyDay").css("width", "60px");
				
			<?php 
				if(!empty($companyData)):
			?>
					var valueSelected = <?php echo $companyData['Company']['status']; ?>;
					$('#CompanyStatus option[value='+valueSelected+']').attr('selected','selected');
			<?php 
				endif;
			?>
		});
	
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
	
	function validateInputs(){
				
		var fecha = document.getElementById('CompanyOfferOptionEndDateCompanyDay').value	+ "/" +
					document.getElementById('CompanyOfferOptionEndDateCompanyMonth').value	+ "/" +
					document.getElementById('CompanyOfferOptionEndDateCompanyYear').value;
	
		vigenciaFecha = validarFecha(fecha);
		
		if(vigenciaFecha == false){
			jAlert('La fecha de vencimiento es incorrecta', 'Mensaje');
			document.getElementById('CompanyOfferOptionEndDateCompanyDay').focus();
			return false;
		}else{
			return true;
		}
	}
	</script>
	
	<style>
	
	</style>
	
		<div class="col-md-12">
		
			<div id="loading" class="modal">
				<p><img src="<?php echo $this->webroot; ?>/img/loading.gif"  style="width: 20px; height: 20px;" /> Cargando catálogo...</p>
			</div>
		
			<?php echo $this->Session->flash(); ?>
			
			<div style="background-color: #835B06;" class="col-md-8 col-md-offset-2">
			
			<?php	echo $this->Form->create('Administrator', array(
							// 'type' => 'file',
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'label' => array('class' => 'col-md-2 control-label '),
								'before' => '<div class="col-md-12 ">',
								'between' => '<div class="col-md-6 ">',
								'after' => '</div></div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
							),
							'onsubmit' =>'return validateInputs();',
							'action' => 'companyOfferOption',
			)); ?>		
			
			
				<fieldset>
					<div class="form-group" style="margin-top: 15px;">
						<div class="col-md-11">
							<label class="col-md-6 control-label" > Fecha de registro:</label>
							<div class="col-md-2 ">
								<label style="margin-bottom: 0px; margin-top: 5px;"><?php  echo ' ' . date("d/m/Y",strtotime($companyData['Company']['created'])); ?></label>
							</div>
						</div>
					</div>

					<?php echo $this->Form->input('CompanyOfferOption.id'); ?>
					
					<?php echo $this->Form->input('CompanyOfferOption.company_id', array(
																'value' => $companyData['Company']['id'],
																'type' => 'hidden'
					
					)); ?>
					<?php if(empty($this->request->data)): ?>
					<?php echo $this->Form->input('CompanyOfferOption.end_date_company', array(	
																'before' => '<div class="col-md-11" >',
																'between' => '<div class="col-md-6" style="padding-right: 0px;">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-6 control-label ',
																			'text' => 'Vigencia de la empresa: '),
																'style' => 'width: 90px; margin-right: 8px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-group form-inline'),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - -5,
																'maxYear' => date('Y') - 0,
																'selected' => date('Y-m-d', strtotime("+1 year")),
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
					)); ?>
					<?php else: ?>
					<?php echo $this->Form->input('CompanyOfferOption.end_date_company', array(	
																'before' => '<div class="col-md-11" >',
																'between' => '<div class="col-md-6" style="padding-right: 0px;">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-6 control-label ',
																			'text' => 'Vigencia de la empresa: '),
																'style' => 'width: 90px; margin-right: 8px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-group form-inline'),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - -5,
																'maxYear' => date('Y') - 0,
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
					)); ?>
					<?php endif; ?>
					<?php 
					$options = array(1 => 'Activa', 0 => 'No activa');
					echo $this->Form->input('Company.status', array(
																'type' => 'select',
																'before' => '<div class="col-md-11">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'between' => '<div class="col-md-3 ">',
																'value' => $companyData['Company']['status'],
																'selected' => $companyData['Company']['status'],
																'label' => array(
																			'class' => 'col-md-6 control-label',
																			'text' => 'Estatus de la empresa:',
																			),
																'options' => $options,
					)); 
					?>
					
					<?php echo $this->Form->input('CompanyOfferOption.max_offer_publication', array(
																'type' => 'text',
																'before' => '<div class="col-md-11" >',
																'between' => '<div class="col-md-3 ">',
																'label' => array(
																			'class' => 'col-md-6 control-label',
																			'text' => 'Número de ofertas a publicar:',
																			),
					)); ?>
					
					<div class="form-group" style="margin-top: 15px;">
						<div class="col-md-11">
							<label class="col-md-6 control-label">Número de ofertas publicadas:</label>
							<div class="col-md-2 ">
								<label style="margin-bottom: 0px; margin-top: 5px;"><?php echo $ofertasPublicadas; ?></label>
							</div>
						</div>
					</div>
					
					<?php echo $this->Form->input('CompanyOfferOption.max_cv_download', array(
																'type' => 'text',
																'before' => '<div class="col-md-11">',
																'between' => '<div class="col-md-3 ">',
																'label' => array(
																			'class' => 'col-md-6 control-label',
																			'text' => 'Número de currículumn a extraer:',
																			),
					)); ?>
					
					<div class="form-group" style="margin-top: 15px;">
						<div class="col-md-11">
							<label class="col-md-6 control-label">Número de curriculums extraidos:</label>
							<div class="col-md-2 ">
								<label style="margin-bottom: 0px; margin-top: 5px;"><?php  echo $descargas; ?></label>
							</div>
						</div>
					</div>
					
					<div class="col-md-12" style="text-align: left;" >
					   <p>Observaciones:</p>
					</div>
					<?php echo $this->Form->input('CompanyOfferOption.comment', array(
																'style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;',
																'maxlength' => '300',
																'before' => '<div class="col-md-12">',
																'between' => '<div class="col-md-12 ">',
																'label' => '',
					)); ?>
				</fieldset>
				
			</div>
		
			<div class="col-md-5 col-md-offset-4" style="margin-top: 20px;">
				<div class="col-md-3">
					<?php 
						echo $this->Html->link(
											'<i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar', 
														array(
															'controller'=>'Administrators',
															'action'=>'searchCompany',
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'width: 120px;',
															'escape' => false,
															)	
						); 	?> 
				</div>
				<div class="col-md-4">
					<?php 	echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',array(
														'type' => 'submit', 
														'div' => 'form-group',
														'escape' => false,
														'class' => 'btn btnBlue btn-default col-md-offset-5',
														'style' => 'width:120px;'
								));
								echo $this->Form->end(); 
					?>
				</div>
				
				
			</div>
		</div>
	
	