<?php	
	$this->layout = 'administrator'; 
?>	
	<script type="text/javascript">
		$(document).ready(function() {			
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
				$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha de vencimiento es incorrecta'});
				return false;
			}else{
				return true;
			}
		}
	</script>
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Editar lineamientos de publicación y descarga de cv's.</p>
    </blockquote>

	<div class="col-md-10 col-md-offset-1 fondoBti" style="margin-top: 20px;">
		
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #fff">Fecha de registro: <span style="color: #FFB71F;"><?php  echo ' ' . date("d/m/Y",strtotime($companyData['Company']['created'])); ?></span></p>
	    </blockquote>

		<?= $this->Form->create('Administrator', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => 'form-control',
									'label' => ['class' => 'col-md-4  control-label', 'text'=>'Vigencia de la empresa:'],
									'between' => '<div class="col-md-7">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
								],
								'onsubmit' =>'return validateInputs();',
								'action' => 'companyOfferOption']); ?>
			
			<fieldset>

				<?= $this->Form->input('CompanyOfferOption.id'); ?>
				<?= $this->Form->input('CompanyOfferOption.company_id', ['value' => $companyData['Company']['id'],'type' => 'hidden']); ?>
				
				<?php if(empty($this->request->data)): ?>
					<?= $this->Form->input('CompanyOfferOption.end_date_company', [
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'data-width'=> '33.333%',
													'dateFormat' => 'YMD',
													'separator' => '',
													'minYear' => date('Y') - 3,
													'maxYear' => date('Y') - -1,
													'selected' => date('Y-m-d', strtotime("+1 year")),]); ?>
				<?php else: ?>
					<?= $this->Form->input('CompanyOfferOption.end_date_company', [
													'class' => 'selectpicker show-tick form-control show-menu-arrow',
													'data-width'=> '33.333%',
													'dateFormat' => 'YMD',
													'separator' => '',
													'minYear' => date('Y') - 3,
													'maxYear' => date('Y') - -1]); ?>
				<?php endif; ?>

				<?php $options = array(1 => 'Activa', 0 => 'No activa'); ?>
				<?= $this->Form->input('Company.status', ['type'=>'select','value' => $companyData['Company']['status'],'options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','selected' => $companyData['Company']['status'],'label' => ['class' => 'col-md-3 col-md-offset-1 control-label','text' => 'Estatus de la empresa:','required'=>'required']]); ?>

				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;" class="col-md-7 col-md-offset-4">
			        <p style="color: #fff">Número de ofertas publicadas por Empresa/Institución: <span style="color: #FFB71F;"><?= $ofertasPublicadas; ?></span></p>
			    </blockquote>
				<?= $this->Form->input('CompanyOfferOption.max_offer_publication', ['type'=>'number','label' => ['class' => 'col-md-4 control-label','text' => 'Número de ofertas a publicar:']]); ?>

				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;" class="col-md-7 col-md-offset-4">
			        <p style="color: #fff">Número de cv's extraidos por Empresa/Institución: <span style="color: #FFB71F;"><?= $descargas; ?></span></p>
			    </blockquote>			
				<?= $this->Form->input('CompanyOfferOption.max_cv_download', ['type'=>'number','label' => ['class' => 'col-md-4 control-label','text' => 'Número de currículumn a extraer:']]); ?>
				<div class="col-md-12">
				<label style="color: #fff">Observaciones:</label>
				</div>	
					<?php echo $this->Form->input('CompanyOfferOption.comment', [
																'style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;',
																'maxlength' => '300',
																'before' => '<div class="col-md-12">',
																'between' => '<div class="col-md-12 ">',
																'label' => '']); ?>
				</fieldset>
	</div>

	<div class="col-md-12 text-center" style="margin-top: 15px">
		<?= $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar', 
											['controller'=>'Administrators',
											'action'=>'searchCompany'],
											['class' => 'btn btn-default btnBlue ','style' => 'width: 120px;','escape' => false]); 	?> 
		<?= $this->Form->button('Guardar &nbsp; <i class=" glyphicon glyphicon-floppy-save"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style' => 'width:120px;']);?>
		<?= $this->Form->end(); ?>
	</div>	