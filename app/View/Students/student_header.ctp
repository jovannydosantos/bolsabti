<?php 
	$this->layout = 'student'; 
?>
<script>
	$(document).ready(function() {
		caracteresCont("StudentHeaderHeader","contadorEncabezado", 120);
		desabilityHeader();
	});	

	function desabilityHeader(){ 
		
		if($("#StudentHeaderTypeHeader").val()==''){
			$("#StudentHeaderHeader").val('');
			$("#bloque1").hide();
		}else{
			$("#bloque1").show();
		}

		<?php if(isset($student['StudentHeader']['type_header'] )): ?>
		if($("#StudentHeaderTypeHeader").val() != <?= $student['StudentHeader']['type_header'] ?>) {
			$("#StudentHeaderHeader").val('');
		}
		<?php endif; ?>


		
		if($("#StudentHeaderTypeHeader").val()==1) {  
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Estudiante 8° Semestre de Ingeniería en Computación");
        } else 
		if($("#StudentHeaderTypeHeader").val()==2) {  
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Egresado de Ingeniería en Computación");
		}else 
		if($("#StudentHeaderTypeHeader").val()==3) {   
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Titulado de Ingeniería en Computación");
		}else
		if($("#StudentHeaderTypeHeader").val()==4) {    
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Con grado en el Posgrado de Ingeniería en Ciencias e Ingeniería de la Computación");
		}else
		if($("#StudentHeaderTypeHeader").val()==5) {   
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Estudiante 6º semestre de Contaduría con experiencia de seis meses en auditoría");
		}else
		if($("#StudentHeaderTypeHeader").val()==6) {   
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Egresado de Ingeniería en Computación");
		}else
		if($("#StudentHeaderTypeHeader").val()==7) {    
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Egresada de Maestría en Derecho Laboral, con 8 años de experiencia en litigio");
		}else
		if($("#StudentHeaderTypeHeader").val()==8) {    
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Cirujano Dentista ");
		}else
		if($("#StudentHeaderTypeHeader").val()==9) {  
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Ingeniero en Computación 7 años de experiencia en sistemas en línea ");
		}else
		if($("#StudentHeaderTypeHeader").val()==10) {  
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Doctora en Economía Financiera ");
		}else
		if($("#StudentHeaderTypeHeader").val()==11) {  
			$("#StudentHeaderHeader").attr("placeholder", "Ej.: Maestra en Ciencias de la Educación, 5 años de experiencia en investigación educativa ");
		}
	}

	function validateInputs(){
		if(($('#StudentHeaderTypeHeader').val() >0) && ($('#StudentHeaderHeader').val()=='')) {
			$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese su encabezado para continuar'});
			return false;
		}else{
			return true;
		}
	}
</script>
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">En el encabezado del currículum se recomienda incorporar lo que en el perfil del puesto requiere.</p>
    </blockquote>

    <div class="col-md-12" style="margin-top: 15px;">	
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
									'action' => 'studentHeader',
									'onsubmit' =>'return validateInputs();']); ?>

			<div class="col-md-8 col-md-offset-2">

				<?= $this->Form->input('StudentHeader.id'); ?>

				<?php $options = array('1' => 'Estudiante','5'=> 'Estudiante con experiencia','2'=> 'Egresado', '6'=> 'Egresado sin experiencia', '7'=> 'Egresado con experiencia','3'=> 'Titulado','8'=> 'Titulado sin experiencia','9'=> 'Titulado con experiencia', '4' => 'Con grado','10'=> 'Con grado sin experiencia', '11'=> 'Con grado con experiencia'); ?>
				<?= $this->Form->input('StudentHeader.type_header', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Tipo de encabezado','onchange'=> 'desabilityHeader();']); ?>

				<div id="bloque1">	

					<?= $this->Form->input('StudentHeader.header', ['placeholder' => 'Escribir encabezado de currículum','type'=>'textarea','class' => 'form-control responsabilidadesClass','style' => 'height: 35px; max-height: 55px; min-height: 35px; resize: vertical;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentHeaderHeader", "contadorEncabezado",210)']); ?>
					<div class="col-md-12" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
						<span id="contadorEncabezado">0/210</span><span> caracteres máx.</span>
					</div>

				</div>
			</div>	
				
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default" style="background-color: #FFFFFF">
				  <div class="panel-body" style="text-align: center;">
						<?php 
							if($student['StudentHeader']['header'] <> ''):
								echo '<span style="color:#000; font-size: 14px;">'.$student['StudentHeader']['header'].'<br></span>';
							endif;
							echo '<b style="font-size: 20px; color:#000;">'.$student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' '.$student['StudentProfile']['second_last_name'].'</b><br>'; 
							echo ($student['StudentProfile']['street'] <> '') ? '<span style="color:#000; font-size: 14px;"> ' . $student['StudentProfile']['street'].' '.$student['StudentProfile']['subdivision'].' '.$student['StudentProfile']['city']. '</span><br>': '';
							echo '<span style="color:#000; font-size: 14px;"> ' . $student['StudentProfile']['date_of_birth']. '</span><br>';
							echo ($student['StudentProfile']['telephone_contact'] <> '') ? '<span style="color:#000; font-size: 14px;"> ' . $student['StudentProfile']['telephone_contact'].' '.$student['StudentProfile']['cell_phone'] . '</span><br>' : '';
							echo '<span style="color:#000; font-size: 14px;"> ' . $student['Student']['email'] . '</span>';
						?>
						<br>
				  </div>
				</div>
			</div>
	</div>

	<div class="col-md-12 text-center">
		<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>	
		
	<div class="col-md-8 col-md-offset-2" style="top: -45px; left: 11px;">
		<a type="button" data-toggle="modal" data-target="#myModal" style="cursor:pointer;color: #7FA4FF; font-size: 16px;">Ver ejemplos</a>
	</div>

	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" style=" text-align: left;">Ejemplos de encabezado</h4>
			</div>
			<div class="modal-body scrollbar" id="style-2">
				 <div class="col-md-12"><label>Estimado universitario, se sugiere si eres:</label></div>
				 <form role="form">
					  <div class="form-group">
						<label for="email">*Estudiante:</label>
						<input type="text" class="form-control" id="email" value="Estudiante 8° Semestre de Ingeniería en Computación">
					  </div>
					  <div class="form-group">
						<label for="email">*Estudiante con experiencia:</label>
						<input type="text" class="form-control" id="email" value="Estudiante 6º semestre de Contaduría con experiencia de seis meses en auditoría">
					  </div>
					  <div class="form-group">
						<label for="email">*Egresado:</label>
						<input type="text" class="form-control" id="email" value="Egresado de Ingeniería en Computación">
					  </div>
					  <div class="form-group">
						<label for="email">*Egresado sin experiencia:</label>
						<input type="text" class="form-control" id="email" value="Egresado de Ingeniería en Computación">
					  </div>
					  <div class="form-group">
						<label for="email">*Egresado con experiencia:</label>
						<input type="text" class="form-control" id="email" value="Egresada de Maestría en Derecho Laboral, con 8 años de experiencia en litigio">
					  </div>
					  <div class="form-group">
						<label for="email">*Titulado:</label>
						<input type="text" class="form-control" id="email" value="Titulado de Ingeniería en Computación">
					  </div>
					  <div class="form-group">
						<label for="email">*Titulado sin experiencia:</label>
						<input type="text" class="form-control" id="email" value="Cirujano Dentista ">
					  </div>
					  <div class="form-group">
						<label for="email">*Titulado sin experiencia:</label>
						<input type="text" class="form-control" id="email" value="Ingeniero en Computación 7 años de experiencia en sistemas en línea ">
					  </div>
					  <div class="form-group">
						<label for="email">*Con grado:</label>
						<input type="text" class="form-control" id="email" value="Con grado en el Posgrado de Ingeniería en Ciencias e Ingeniería de la Computación">
					  </div>
					  <div class="form-group">
						<label for="email">*Con grado sin experiencia:</label>
						<input type="text" class="form-control" id="email" value="Doctora en Economía Financiera">
					  </div>
						<div class="form-group">
						<label for="email">*Con grado con experiencia:</label>
						<input type="text" class="form-control" id="email" value="Maestra en Ciencias de la Educación, 5 años de experiencia en investigación educativa ">
					  </div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btnBlue" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	  </div>
	</div>

	<?= $this->element('contadorCaracteres'); ?>