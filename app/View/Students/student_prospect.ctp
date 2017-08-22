<?php 
	$this->layout = 'student'; 
?>
<script>
	$(document).ready(function() {
		desabilityMobility();
		desabilityMobility2();
	});	

	function counttGiros(){
		var numGiros = $(".giros");
		if(numGiros.length >= 4){	
			$.alert({ title: '!Aviso!',type: 'red',content: 'Sólo puede agregar hasta 4 giros'});
			return false;
		} else{
			return true;
		}
	}	
	
	function desabilityMobility(){
		if($('#StudentProspectCanTravel').val() == 's'){
			$("#bloque2").show();
		} else {		
			$("#bloque2").hide();
		}
	}
	
	function desabilityMobility2(){
		if($('#StudentProspectChangeResidence').val() == 's'){
			$("#bloque3").show();
		} else {		
			$("#bloque3").hide();
		}
	}
	
	function validateInputs(){	
		if((($('#StudentProspectCanTravel').val()) == 's') && ($('#StudentProspectCanTravelOption').val()=='')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione una opción en disponibilidad para viajar'});
		} else 
		if(($('#StudentProspectChangeResidence').val() == 's') && ($('#StudentProspectChangeResidenceOption').val()=='')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione una opción en disponibilidad para cambiar de residencia'});
		} else {
			return true;
		}
		return false;
	}
</script>
	
	<blockquote style="padding-top: 0px; padding-bottom: 0px; margin-top: 15px">
        <p style="color: #588BAD">Indique sus preferencias laborales.</p>
    </blockquote>

    <div class="col-md-12">	
		<?php echo $this->Form->postLink(''); ?>
		<?php foreach($interesesArea as $k => $area): ?>
		<div class="col-md-4 giros" style="margin-top: 10px; border-left: 6px solid #1a75bb; background-color: #f8f8f8;">
			<?php echo $area['Rotation']['rotation']; ?>
		</div>
		<div class="col-md-8" style="margin-top: 3px;">
			<?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp; Editar', 
					['controller'=>'Students',
					'action'=>'editStudentInterestJob',$area['StudentInterestJob']['id']],
					['class' => 'btn btn-primary btn-sm',
					'escape' => false]); ?>
			<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar', '#',[
									'onclick' =>"return confirma('Preferencia".$area['StudentInterestJob']['id']."');",
									'class' => 'btn btn-danger btn-sm',
									'escape'=> false]); ?>
			<div style="display: none">
			<?= $this->Form->postLink('Eliminar',							
					['controller'=>'Students',
					'action'=>'deleteStudentInterestJob',$area['StudentInterestJob']['id']],
					['id'=>'eliminarPreferencia'.$area['StudentInterestJob']['id']]	
			); 	?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
				
		<div class="col-md-12" style="margin-top: 30px;">	
			<div class="col-md-6">
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
									'action' => 'studentInterestJob',
									'onsubmit' =>'return counttGiros();']); ?>
					<fieldset>
						<?= $this->Form->input('StudentInterestJob.business_activity', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro de interés']); ?>

						<?= $this->Form->input('StudentInterestJob.interest_area_id', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Área de interés']); ?>
					</fieldset>

					<div class="col-md-12 text-center">
						<?= $this->Form->button('<span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
						<?= $this->Form->end(); ?>
					</div>	
			</div>
			
			<div class="col-md-6">	

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
										'action' => 'studentProspect',
										'onsubmit' =>'return validateInputs();']); ?>
					<fieldset>

					<?= $this->Form->input('StudentProspect.id'); ?>
				
					<?= $this->Form->input('StudentProspect.sector', ['type'=>'select','options' => $Sectores,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Sector']); ?>	
					
					<?= $this->Form->input('StudentProspect.contract_type', ['type'=>'select','options' => $TiposContratos,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Tipo de contrato']); ?>	

					<?= $this->Form->input('StudentProspect.workday', ['type'=>'select','options' => $JornadasLaborales,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Jornada laboral']); ?>	

					<?= $this->Form->input('StudentProspect.economic_pretension', ['type'=>'select','options' => $Salarios,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Pretensiones económicas']); ?>	

					<?php $options = array('s' => 'Si', 'n' => 'No'); ?>
					<?= $this->Form->input('StudentProspect.can_travel', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Disponibilidad para viajar','onChange' => 'desabilityMobility()']); ?>	

					<div id="bloque2">
						<?php $options = array('1' => 'Dentro del país', '2' => 'Fuera del país'); ?>
						<?= $this->Form->input('StudentProspect.can_travel_option', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Opciones para viajar']); ?>	
					</div>
							
					<?php $options = array('s' => 'Si', 'n' => 'No'); ?>
					<?= $this->Form->input('StudentProspect.change_residence', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Disponibilidad para cambiar de residencia','onChange'=>'desabilityMobility2()']); ?>	

					<div id="bloque3">
						<?php $options = array('1' => 'Dentro del país', '2' => 'Fuera del país'); ?>
						<?= $this->Form->input('StudentProspect.change_residence_option', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'false','default'=>'0', 'empty' => 'Opciones para cambiar de residencia']); ?>	
					</div>
							
					</fieldset>

					<div class="col-md-12 text-center">
						<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
						<?= $this->Form->end(); ?>
					</div>	

			</div>
		</div>

	<?= $this->element('scriptGirosStudentProspect'); ?>