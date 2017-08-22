<?php 
	$this->layout = 'student'; 
?>
<?= $this->element('contadorCaracteres'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		var contResponsabilidades = 1;
		var contLogros = 1;
		pais();

		<?php if($totalPuestos>0): ?>
			$("#StudentInterestJobBusinessActivity").prop('disabled', true);
		<?php endif; ?>
		 
	 	//Fecha inicio.
		 $('#StudentWorkAreaStartDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentWorkAreaStartDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentWorkAreaStartDateDay').prepend('<option value="" selected>DD</option>');
			//Fecha termino.
		 $('#StudentWorkAreaEndDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentWorkAreaEndDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentWorkAreaEndDateDay').prepend('<option value="" selected>DD</option>');

		$("#agregarResponsabilidad").click(function(e) { 
			var numResponsabilidades = $(".responsabilidadesClass");
			
			if(numResponsabilidades.length >= 5){	
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puede agregar hasta 5 responsabilidades para cada puesto'});		
				return false;
			} else{
				var string = 
						'<div class="divResponsabilidades" id="divResponId'+contResponsabilidades+'">'+
							'<div class="form-group required"><label for="StudentResponsability'+contResponsabilidades+'Responsability" class="col-md-12 control-label"></label><div class="col-md-12"><textarea name="data[StudentResponsability]['+contResponsabilidades+'][responsability]" class="form-control responsabilidadesClass" placeholder="Responsabilidad" style="max-width: 660px; max-height: 280px;" maxlength="210" onkeypress="caracteresCont(&#34;StudentResponsability'+contResponsabilidades+'Responsability&#34;, &#34;contadorResponsabilidades'+contResponsabilidades+'&#34;,210)" cols="30" rows="6" id="StudentResponsability'+contResponsabilidades+'Responsability" required="required"></textarea></div>'+
								'<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">'+
									'<span id="contadorResponsabilidades'+contResponsabilidades+'">0/210</span><span> caracteres máx.</span>'+
								'</div>'+
							'</div>'+
							'<button type="button" class="btn btn-danger btn-sm" onclick="deleteDiv(&#34;divResponId'+contResponsabilidades+'&#34;);" style="margin-top: -70px;"><i class="glyphicon glyphicon-trash"></i></button>'+
						'</div>';

				$("#contenedorResponsabilidades").append(string);
				contResponsabilidades++;
			}
		});
		
		$("#agregarLogro").click(function(e) { 
			var numLogros = $(".logrosClass");
		
			if(numLogros.length >= 5){			
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Sólo puede agregar hasta 5 logros para cada puesto'});
				return false;
			} else{
				var string = 
							'<div class="divLogros" id="divLogroId'+contLogros+'">'+
								'<div class="form-group required"><label for="StudentAchievement'+contLogros+'Achievement" class="col-md-12 control-label"></label><div class="col-md-12"><textarea name="data[StudentAchievement]['+contLogros+'][achievement]" class="form-control logrosClass" placeholder="Logro" style="max-width: 660px; max-height: 280px;" maxlength="210" onkeypress="caracteresCont(&quot;StudentAchievement'+contLogros+'Achievement&quot;, &quot;contadorLogros'+contLogros+'&quot;,210)" cols="30" rows="6" id="StudentAchievement'+contLogros+'Achievement" required="required"></textarea></div>'+
									'<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">'+
										'<span id="contadorLogros'+contLogros+'">0/210</span><span> caracteres máx.</span>'+
									'</div>'+
								'</div>'+
								'<button type="button" class="btn btn-danger btn-sm" onclick="deleteDiv(&#34;divLogroId'+contLogros+'&#34;);" style="margin-top: -70px;"><i class="glyphicon glyphicon-trash"></i></button>'+
							'</div>';	
		
				$("#contenedorLogros").append(string);
				contLogros++;
			}
		});
		
		resetFechaTermino();
	});	

	function resetFechaTermino(){
		if(($("#StudentWorkAreaCurrent").val() == 's')){
			document.getElementById('StudentWorkAreaEndDateYear').options[0].selected = 'selected';
			document.getElementById('StudentWorkAreaEndDateMonth').options[0].selected = 'selected';
			document.getElementById('StudentWorkAreaEndDateDay').options[0].selected = 'selected'; }
		$('.selectpicker').selectpicker('refresh');
	}

	function restart(){
		var textBox = document.getElementById("StudentProfessionalExperienceOther");
		var textLength = textBox.value.length;
		if(textLength > 0)
		{
			document.getElementById('StudentProfessionalExperienceContractType').options[0].selected = 'selected';
		} else {
		}
		$('.selectpicker').selectpicker('refresh');
	}
	
	function pais(){
		var pais = $( "#StudentProfessionalExperienceCountry option:selected" ).text();
		if(pais == "México"){
			$("#divEstado").show();
		} else{
			$("#divEstado").hide();
			document.getElementById('StudentProfessionalExperienceState').options[0].selected = 'selected';
		}
		$('.selectpicker').selectpicker('refresh');
	}
	
	function validateInputs(){
		var valueInput = $('#StudentProfessionalExperienceOther').val();
		var valueSelected = $('#StudentProfessionalExperienceContractType').val();
		var pais = $( "#StudentProfessionalExperienceCountry option:selected" ).text();
		
		if ((valueInput == '') && (valueSelected == '')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Indique el tipo de contrato'});
			return false;
		} else
		if((pais == "México") && ( $( "#StudentProfessionalExperienceState" ).val() == '')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione el estado'});
			return false;
		} else{
			$("#StudentInterestJobBusinessActivity").prop('disabled', false);
			return true;
		}
	}	
	
	function countWorkAreas(){
		var numPuestos = $(".puestos");
		var actual = $('#StudentWorkAreaCurrent').val();
		var yearInicio = $('#StudentWorkAreaStartDateYear').val();
		var mesInicio = $('#StudentWorkAreaStartDateMonth').val();
		var diaInicio = $('#StudentWorkAreaStartDateDay').val();
		var yearTermino = $('#StudentWorkAreaEndDateYear').val();
		var mesTermino = $('#StudentWorkAreaEndDateMonth').val();
		var diaTermino = $('#StudentWorkAreaEndDateDay').val();
		var responsabilidadesVacias = 0;
		var logrosVacios = 0;

		$(".responsabilidadesClass").each(function(){
			if($(this).val()==''){
				responsabilidadesVacias++;
			}
	    });

		$(".logrosClass").each(function(){
			if($(this).val()==''){
				logrosVacios++;
			}
	    });
		
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
		} else 
		if((pais == "México") && ( $( "#StudentProfessionalExperienceState" ).val() == '')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione el estado'});
			return false;
		} 
		if(responsabilidadesVacias>0){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese texto para todas las responsabilidades'});
			return false;
		}else
		if(logrosVacios>0){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese texto para todos los logros'});
			return false;
		}else
		if(numPuestos.length >= 3){			
			$.alert({ title: '!Aviso!',type: 'red',content: 'Sólo puede agregar hasta 3 puestos para la empresa'});
			return false;
			return false;
		} else{
			return true;
		}
	}	

	function deleteDiv(id){	
		$.confirm({
		    title: 'Confirmación!',
		    icon: 'glyphicon glyphicon-warning-sign',
		    type: 'red',
		    content: '¿Realmente desea eliminar este registro?',
		    buttons: {
		        aceptar: function () {
					$(this).parent('div').remove();
					$('#'+id).remove();
		        },
		        cancelar: function () {
		            // $.alert({ title: '!Aviso!',type: 'red',content: 'Opción cancelada'});
		        },
		    }
		});
	}

</script>
	<ol class="breadcrumb">
	    <li><?= $this->Html->link('Experiencia Profesional', ['controller'=>'Students','action' => 'studentProfessionalExperience'] );?></li>
	 	<li class="active"><?= 'Editando experiencia en "<label>'.$this->request->data['StudentProfessionalExperience']['company_name'].'"</label>, tambien puede agregar puestos.'?></li>
	 </ol>

	<div class="col-md-12">	
		<?php foreach($experiencias as $k => $experiencia): ?>
			<?php echo $this->Form->postLink(''); ?>	
			<?php
				if(empty($experiencia['StudentWorkArea'])):
					echo '<div class="col-md-12" style="margin-top: 10px; border-left: 6px solid #f55858; color: #9a9a9a">Sin puestos</div>';
				endif;
			?>			
			<?php foreach($experiencia['StudentWorkArea'] as $k => $puesto): ?>
				<div class="col-md-6" style="margin-top: 10px; border-left: 6px solid #f2933f; background-color: #f8f8f8;">				
					<?php echo $puesto['job_name']; ?>
				</div>
				<div class="col-md-6" style="margin-top: 3px;">

					<?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp; Editar', 
										['controller'=>'Students',
										'action'=>'editStudentWorkArea',$puesto['id']],
										['class' => 'btn btn-primary btn-sm',
										'escape' => false]); ?>
					<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar', '#',[
										'onclick' =>"return confirma('Puesto".$puesto['id']."');",
										'class' => 'btn btn-danger btn-sm',
										'escape'=> false]);?>
					<div style="display: none">
					<?= $this->Form->postLink('Eliminar',							
										['controller'=>'Students',
										'action'=>'deleteStudentWorkArea',$puesto['id']],
										['id'=>'eliminarPuesto'.$puesto['id']]); ?>
					</div>

				</div>
				<?php endforeach; ?>
								
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
									'action' => 'editStudentProfessionalExperience',
									'onsubmit' =>'return validateInputs();']); ?>
			<fieldset>

				<?= $this->Form->input('StudentProfessionalExperience.id'); ?>

				<?= $this->Form->input('StudentProfessionalExperience.contract_type', ['type'=>'select','options' => $TiposContratos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Tipo de contrato','onchange'=> 'restart();']); ?>

				<?= $this->Form->input('StudentProfessionalExperience.other', ['placeholder' => 'Otro tipo de contrato','onblur' => 'restart()']); ?>

				<?= $this->Form->input('StudentProfessionalExperience.country', ['type'=>'select','options' => $Paises,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'País','onchange'=> 'pais();']); ?>

				<div id="divEstado">
					<?= $this->Form->input('StudentProfessionalExperience.state', ['type'=>'select','options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Estado / Entidad federativa']); ?>	
				</div>

				<?= $this->Form->input('StudentProfessionalExperience.company_name', ['placeholder' => 'Empresa / Institución']); ?>

				<?= $this->Form->input('StudentProfessionalExperience.company_rotation', ['type' => 'select','options' => $Giros,'placeholder' => 'Empresa / Institución','id'=> 'StudentInterestJobBusinessActivity','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0','empty' => 'Giro']); ?>

			</fieldset>

			<div class="col-md-12 text-center">
				<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
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
									'action' => 'studentStudentWorkArea',
									'onsubmit' =>'return countWorkAreas();']); ?>	
			<fieldset>										
				
				<?= $this->Form->input('StudentWorkArea.student_professional_experience_id', ['value' => $this->Session->read('StudentProfessionalExperienceId'),'type'=>'hidden']); ?>

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
				
								<label style="font-weight: normal;margin-top: 3px;">Responsabilidad(es):</label>
				<?= $this->Form->input('StudentResponsability.0.responsability', ['placeholder' => 'Responsabilidad','type'=>'textarea','class' => 'form-control responsabilidadesClass','style' => 'max-width: 660px; max-height: 280px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentResponsability0Responsability", "contadorResponsabilidades0",210)']); ?>
				
				<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
					<span id="contadorResponsabilidades0">0/210</span><span> caracteres máx.</span>
				</div>

				<div id="contenedorResponsabilidades"></div> 
				
				<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
					<span> Agregar otra responsabilidad (máx.5)</span>
					<button type="button" class="btn btn-default btn-sm" id="agregarResponsabilidad">
			          <span class="glyphicon glyphicon-plus-sign"></span>
			        </button>
				</div>

				<label style="font-weight: normal;margin-top: 3px;">Logro(s):</label>
				<?= $this->Form->input('StudentAchievement.0.achievement', ['placeholder' => 'Logro','type'=>'textarea','class'=>'form-control logrosClass','style' => 'max-width: 660px; max-height: 280px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentAchievement0Achievement", "contadorLogros0",210)']); ?>
				
				<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
					<span id="contadorLogros0">0/210</span><span> caracteres máx.</span>
				</div>

				<div id="contenedorLogros"></div>

				<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
					<span> Agregar otro logro (máx.5)</span>
					<button type="button" class="btn btn-default btn-sm" id="agregarLogro">
			          <span class="glyphicon glyphicon-plus-sign"></span>
			        </button>
				</div>

			</fieldset>

			<div class="col-md-12 text-center">
				<?= $this->Form->button('<span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	

		</div>	
	</div>	
	
	<?= $this->element('scriptGiros'); ?>