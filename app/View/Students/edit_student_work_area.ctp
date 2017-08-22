<?php 
	$this->layout = 'student'; 
?>
	<?= $this->element('contadorCaracteres'); ?>
<script>
	$(document).ready(function() {
		
		$('#loading').show();
		$.get('http://localhost/bolsabti/app/webroot/php/derpAreas.php',{giro: <?php echo $this->request->data['StudentProfessionalExperience']['company_rotation']; ?>},function(JSON)
			{
				$('#StudentInterestJobInterestAreaId').empty();
				$('#StudentInterestJobInterestAreaId').append('<option value="">Área de experiencia</option>');
				
				var waitCount = 0;
				$.each(JSON, function(key, val){
					waitCount++;
				});

				$.each(JSON, function(key, val){
					if(val.id == '<?php echo $this->request->data['StudentWorkArea']['experience_area']; ?>'){
						$('#StudentInterestJobInterestAreaId').append('<option value="' + val.id + '"selected>' + val.area + '</option>');
					}else{
						$('#StudentInterestJobInterestAreaId').append('<option value="' + val.id + '">' + val.area + '</option>');
					}
					
					if (--waitCount == 0) {
						$('#loading').hide();
						$('.selectpicker').selectpicker('refresh');
					}

				});
			});
		
	      //Fecha inicio.
		 $('#StudentWorkAreaStartDateYear').prepend('<option value="">AAAA</option>');
		 $('#StudentWorkAreaStartDateMonth').prepend('<option value="">MM</option>');
		 $('#StudentWorkAreaStartDateDay').prepend('<option value="">DD</option>');

	 	$('#StudentWorkAreaEndDateYear').prepend('<option value="">AAAA</option>');
		$('#StudentWorkAreaEndDateMonth').prepend('<option value="">MM</option>');
		$('#StudentWorkAreaEndDateDay').prepend('<option value="">DD</option>');
		
		resetFechaTermino();
	});	

	function resetFechaTermino(){
		if(($("#StudentWorkAreaCurrent").val() == 's')){
			document.getElementById('StudentWorkAreaEndDateYear').options[0].selected = 'selected';
			document.getElementById('StudentWorkAreaEndDateMonth').options[0].selected = 'selected';
			document.getElementById('StudentWorkAreaEndDateDay').options[0].selected = 'selected'; }
		$('.selectpicker').selectpicker('refresh');
	}

	function countResponsabilies(){
		var numResponsabilidades = $(".responsabilidades");
		if(numResponsabilidades.length >= 5){			
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puede agregar hasta 5 responsabilidades para cada puesto'});
			return false;
		} else{
		return true;
		}
	}
	
	function counttAchievements(){
		var numLogros = $(".logros");
		if(numLogros.length >= 5){			
			$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puede agregar hasta 5 logros para cada puesto'});
			return false;
		} else{
			return true;
		}
	}	
	
	function validateInputs(){
		var actual = $('#StudentWorkAreaCurrent').val();
		var yearInicio = $('#StudentWorkAreaStartDateYear').val();
		var mesInicio = $('#StudentWorkAreaStartDateMonth').val();
		var diaInicio = $('#StudentWorkAreaStartDateDay').val();
		var yearTermino = $('#StudentWorkAreaEndDateYear').val();
		var mesTermino = $('#StudentWorkAreaEndDateMonth').val();
		var diaTermino = $('#StudentWorkAreaEndDateDay').val();
		
		if (((yearInicio=='') || (mesInicio=='') || (diaInicio==''))){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione la fecha completa de inicio en el puesto'});
			return false;
		} else 
		if (((yearTermino=='') || (mesTermino=='') || (diaTermino=='')) && (actual == '')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione la fecha de término en el puesto o especifíque si es actual'});
			return false;
		} else 
		if (((yearTermino=='') || (mesTermino=='') || (diaTermino=='')) && (actual == 'n')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione la fecha de término en el puesto'});
			return false;
		} else 
		if ((actual == 'n' || actual == '') && (((yearTermino<=yearInicio) && (mesTermino<=mesInicio)) || (yearTermino<yearInicio ))) {
			$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha de inicio debe ser menor a la de término'});
			return false;
		} else { 
			return true;
		}
	}	

</script>
	
	<ol class="breadcrumb">
	    <li><?= $this->Html->link('Experiencia Profesional', ['controller'=>'Students','action' => 'studentProfessionalExperience'] );?></li>
	    <li><?= $this->Html->link($this->request->data['StudentProfessionalExperience']['company_name'], ['controller'=>'Students','action' => 'editStudentProfessionalExperience',$this->request->data['StudentProfessionalExperience']['id']] );?></li>
	 	<li class="active"><?= 'Editando <label> "'.$this->request->data['StudentWorkArea']['job_name'].'"</label> tambien puede agregar responsabilidades y logros'; ?></li>
	</ol>
	
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
									'action' => 'editStudentWorkArea',
									'onsubmit' =>'return validateInputs();']); ?>

			<fieldset>

				<?= $this->Form->input('StudentWorkArea.id'); ?>
		
					<?= $this->Form->input('StudentWorkArea.job_name', ['placeholder' => 'Puesto']); ?>
				
				<?= $this->Form->input('StudentWorkArea.experience_area', ['type'=>'select','id' => 'StudentInterestJobInterestAreaId','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => "true",'default'=>'0', 'empty' => 'Área de experiencia']); ?>

				<div class="asterisk">*</div>
				<label style="font-weight: normal;margin-top: 3px;">Fecha de inicio</label>
				<?= $this->Form->input('StudentWorkArea.start_date', [
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'data-width'=> '160px',
											'dateFormat' => 'YMD',
											'separator' => '',
											'minYear' => date('Y') - 200,
											'maxYear' => date('Y') - 0]); ?>

				<div class="asterisk">*</div>
				<label style="font-weight: normal;margin-top: 3px;">Fecha de término</label>
				<?= $this->Form->input('StudentWorkArea.end_date', [
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'data-width'=> '160px',
											'dateFormat' => 'YMD',
											'separator' => '',
											'minYear' => date('Y') - 200,
											'maxYear' => date('Y') - 0,
											'onChange' => 'resetFechaTermino();']); ?>

				<div class="asterisk">*</div>
				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('StudentWorkArea.current', ['type' => 'select','default'=> 0,'empty' => '¿Fecha actual en el puesto?','options' => $options,'onchange' => 'resetFechaTermino()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>
			</fieldset>

			<div class="col-md-12 text-center">
				<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	
		</div>

		<div  class="col-md-6" >
			<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD">Responsabilidades:</p>
			    </blockquote>
				
					<?php foreach($puestos as $k => $puesto): ?>
						<?php
							if(empty($puesto['StudentResponsability'])):
								echo '<div class="col-md-12" style="margin-top: 10px; border-left: 6px solid #f55858; color: #9a9a9a">Sin responsabilidades</div>';
							endif;
						?>
						<?php foreach($puesto['StudentResponsability'] as $k => $responsabilidad): ?>
							<?php echo $this->Form->postLink(''); ?>
							<div class="col-md-9" style="margin-top: 10px; border-left: 6px solid #f2933f; background-color: #f8f8f8;">				
								<?php echo $responsabilidad['responsability']; ?>
							</div>
							<div class="col-md-3 responsabilidades" style="margin-top: 3px;">
								
								<?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>',							
										['controller'=>'Students',
										'action'=>'editStudentResponsability',$responsabilidad['id']],
										['class' => 'btn btn-primary btn-sm',
										'escape' => false]); ?>
								<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', '#',[
										'onclick' =>"return confirma('Responsabilidad".$responsabilidad['id']."');",
										'class' => 'btn btn-danger btn-sm',
										'escape'=> false]);?>
								<div style="display: none">
								<?= $this->Form->postLink('Eliminar',							
										['controller'=>'Students',
										'action'=>'deleteStudentResponsability',$responsabilidad['id']],
										['id'=>'eliminarResponsabilidad'.$responsabilidad['id']]); ?>
								</div>		
							</div>
						<?php endforeach; ?>
					<?php endforeach; ?>
			</div>

			<div class="col-md-12">
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
									'action' => 'studentStudentResponsability',
									'onsubmit' =>'return countResponsabilies();']); ?>
		
				<fieldset>	
					
					<?= $this->Form->input('StudentResponsability.student_work_area_id',['type'=>'hidden','value' => $this->Session->read('editStudentWorkAreaId')]); ?>

					<?= $this->Form->input('StudentResponsability.responsability', ['placeholder' => 'Responsabilidad','type'=>'textarea','class' => 'form-control responsabilidadesClass','style' => 'max-width: 660px; max-height: 280px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentResponsabilityResponsability", "contadorResponsabilidades0",210)']); ?>
					<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
						<span id="contadorResponsabilidades0">0/210</span><span> caracteres máx.</span>
					</div>

				</fieldset>

				<div class="col-md-12 text-center">
					<?= $this->Form->button('<span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
					<?= $this->Form->end(); ?>
				</div>
			</div>		

			<div class="col-md-12">
				<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
			        <p style="color: #588BAD">Logro(s):</p>
			    </blockquote>

						<?php foreach($puestos as $k => $puesto): ?>
							<?php
								if(empty($puesto['StudentAchievement'])):
									echo '<div class="col-md-12" style="margin-top: 10px; border-left: 6px solid #f55858; color: #9a9a9a">Sin logros</div>';
								endif;
							?>
							<?php foreach($puesto['StudentAchievement'] as $k => $logro): ?>
								<?php echo $this->Form->postLink(''); ?>
								<div class="col-md-9" style="margin-top: 10px; border-left: 6px solid #f2933f; background-color: #f8f8f8;">				
									<?php echo $logro['achievement']; ?>
								</div>
								<div class="col-md-3 logros" style="margin-top: 3px;">
									
									<?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>',							
											['controller'=>'Students',
											'action'=>'editStudentAchievement',$logro['id']],
											['class' => 'btn btn-primary btn-sm',
											'escape' => false]); ?>
									<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', '#',[
											'onclick' =>"return confirma('Logro".$logro['id']."');",
											'class' => 'btn btn-danger btn-sm',
											'escape'=> false]);?>
									<div style="display: none">
									<?= $this->Form->postLink('Eliminar',							
											['controller'=>'Students',
											'action'=>'deleteStudentAchievement',$logro['id']],
											['id'=>'eliminarLogro'.$logro['id']]); ?>
									</div>		

							</div>
							<?php endforeach; ?>
						<?php endforeach; ?>
			</div>	

			<div class="col-md-12">
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
										'action' => 'studentAchievement',
										'onsubmit' =>'return counttAchievements();']); ?>
					<fieldset>	

						<?= $this->Form->input('StudentAchievement.student_work_area_id',['type'=>'hidden','value' => $this->Session->read('editStudentWorkAreaId')]); ?>

						<?= $this->Form->input('StudentAchievement.achievement', ['placeholder' => 'Logro','type'=>'textarea','class'=>'form-control logrosClass','style' => 'max-width: 660px; max-height: 280px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentAchievementAchievement", "contadorLogros0",210)']); ?>

						<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
							<span id="contadorLogros0">0/210</span><span> caracteres máx.</span>
						</div>

					</fieldset>

					<div class="col-md-12 text-center">
						<?= $this->Form->button('<span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
						<?= $this->Form->end(); ?>
					</div>
			</div>
		</div>
	</div>
