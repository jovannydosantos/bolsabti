<?php
	$this->layout = 'register'; 
?>
	<script>
	$(window).load(function() {
		var helpText = [
						"Nueva contraseña",
						"Confirma la contraseña"						
						];
		 
		$('.form-group').each(function(index, element) {
			$(this).find(".cambia").attr("id", index);
			$(this).find('#'+index).attr("data-original-title", helpText[index]);
		});
	});
	</script>
	<div class="container"  >
	
	<div class="row">
			<div class="col-xs-2 col-xs-offset-3 col-sm-2" >
				<img src="/unam/img/student/registroPrimeraVez.png" alt="registroPrimeraVez.png" id="idVideoRegister" style="margin-top: -21px;">
			</div>
		</div>
		<div class="row">
						<div class="col-xs-1 col-xs-offset-8 col-sm-1 col-sm-offset-10  col-md-1 col-md-offset-10"  style="height: 0px; margin-top: -90px;" >
				<a onclick="src('#');" data-toggle="modal"  href="#" ><img src="/unam/img/home/video.png" alt="VideoTutorial.png"></a>
			</div>
		</div>
		
<?php	
	echo $this->Form->create('Student', array(
					'class' => 'form-horizontal', 
					'role' => 'form',
					'inputDefaults' => array(
						'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
						'div' => array('class' => 'form-group'),
						'class' => 'form-control',
						'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4control-label '),
						'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
						'between' => '<div class="col-xs-12 col-sm-6 col-md-5 ">',
						'after' => '</div></div>',
						'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
					),
					'action' => 'updatePassword'
	)); ?>
<br>
	
<div style="background-color: #835B06;  margin-bottom: 150px; margin-top: 130px; padding: 50px 0px 30px;" class="col-xs-12 col-sm-6 col-md-7 col-sm-offset-2 col-md-offset-0 col-centered  ">
	<?php echo $this->Session->flash(); ?>
	<center  style="margin-top: -25px; padding-bottom: 30px;" ><b style=" font-size: 20px; color: #231F20">Recuperar contraseña</b></center>
	
	<fieldset style="padding-top: 20px;">
	<?php echo $this->Form->input('cod', array(					
					'label' => array(
						'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
						'text' => 'código de verificación',
						),
					'placeholder' => 'código de verificación',
					'default' => $this->request->query('cod'),
					'type' => 'hidden',
	)); ?>
	<?php echo $this->Form->input('id', array(					
					'label' => array(
						'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
						'text' => 'id de usuario',
						),
					'placeholder' => 'id de usuario',
					'default' => $this->request->query('id'),
					'type' => 'hidden',
	)); ?>
    <?php echo $this->Form->input('password', array(	
					'before' => '<div class="col-md-12 ">',
					'label' => array(
						'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
						'text' => 'Escriba su nueva contraseña'),
					'placeholder' => 'Escriba su nueva contraseña'
	)); ?>
	<?php echo $this->Form->input('password_confirm', array(
					'before' => '<div class="col-md-12 ">',
					'type' => 'password',
					'label' => array(
						'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
						'text' => 'Confirme su nueva contraseña'),
					'placeholder' => 'Confirme su nueva contraseña'
	)); ?>	
	<?php echo $this->Form->submit('Enviar', array(
			'div' => 'form-group',
					'class' => 'btn btnBlue btn-default col-md-2 col-md-offset-5 ',
					'style'=> 'background-color: #283274; margin-top: 30px;'
		)); ?>
	</fieldset>
</div>
</div>