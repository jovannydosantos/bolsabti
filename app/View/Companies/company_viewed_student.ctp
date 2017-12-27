<?php 
	$this->layout = 'company'; 
?>

<script>
		$(document).ready(function() {
			
			init_contadorTa("StudentTelephoneNotificationMessage","contadorTaComentario", 316);
			updateContadorTa("StudentTelephoneNotificationMessage","contadorTaComentario", 316);
			
			init_contadorTa("StudentPersonalNotificationMessage","contadorTaComentarioPropuesta", 316);
			updateContadorTa("StudentPersonalNotificationMessage","contadorTaComentarioPropuesta", 316);
			
			init_contadorTa("messageIdEmail","contadorTaComentario2", 632);
			updateContadorTa("messageIdEmail","contadorTaComentario2", 632);
			
			 $('#StudentTelephoneNotificationDateYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentTelephoneNotificationDateMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentTelephoneNotificationDateDay').prepend('<option value="" selected>DD</option>');
			 
			 $('#StudentPersonalNotificationDateYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentPersonalNotificationDateMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentPersonalNotificationDateDay').prepend('<option value="" selected>DD</option>');
			 
			 $('#StudentPropuestaFechaYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentPropuestaFechaMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentPropuestaFechaDay').prepend('<option value="" selected>DD</option>');
			 
			 $('#StudentReportarContratacionFechaContratacionYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentReportarContratacionFechaContratacionMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentReportarContratacionFechaContratacionDay').prepend('<option value="" selected>DD</option>');
		});
	
		//Contador de caracteres para las notificaciones telefónicas 
	
		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
				document.getElementById("CompanyCompanyViewedStudentForm").submit();
			 }
		}
		
</script>
	
<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
	<p style="color: #588BAD;">Candidatos mas vistos por empresas</p>
</blockquote>

<div class="col-md-12" >
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
						'action' => 'companyViewedStudent',
						'onsubmit' =>'return validateEmpty();']); ?>

	<fieldset>
		<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>

							<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
								<?php 
								echo $this->Form->end(); 
								?>
							</div>
	</fieldset>
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<label> Resultados de busqueda</label>
	</div>
</div>

<div class="col-md-3">
		<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'id'=> 'limit','class' => 'selectpicker show-tick form-control show-menu-arrow','selected' => $this->Session->read('limit'),'default'=>'0', 'empty' => 'Resultados por hoja','onchange' => 'sendLimit()']); ?>	
</div>

<div class="col-md-9">
	<div class="col-md-4">
	 <?php 	echo $this->Html->link(
									'Descargar Excel &nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
											array(
													'controller'=>'Companies',
													'action'=>'companyViewedStudentExcel',
												),
												array(
													'class' => 'btn btn-primary',
													'style'=>'margin-top: 7px;',
													'escape' => false,
													)	
								); 
		?>
	</div>
</div>

<?php if(isset($candidatos)): 
		if(empty($candidatos)):
			echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin resultados</p></div>';
		else:
?>

<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
	<?= $this->element('candidatos'); ?>
</div>					

<?php 
		endif;
	endif; 
?>