<?php 
	$this->layout = 'administrator'; 
?>
	<script>

		function comprueba_extension() {
			var archivo = document.getElementById('AdministratorFilename').value;
			extensiones_permitidas = new Array(".jpg",".jpeg",".png");
		  
			if (!archivo) {
				$.alert({
					    title: '!Aviso!',
					    theme: 'supervan',
					    content: 'No has seleccionado ningún archivo',
					});
				document.getElementById("AdministratorFilename").focus();
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
					$.alert({
					    title: '!Aviso!',
					    theme: 'supervan',
					    content: 'Comprueba la extensión de su archivo a subir. Sólo se pueden subir archivos con extensiones: ' + extensiones_permitidas.join(),
					});
					document.getElementById('AdministratorFilename').value = '';  
					document.getElementById('AdministratorDir').value = '';
					document.getElementById('AdministratorMimetype').value = '';
					document.getElementById('AdministratorFilesize').value = '';
					$("#AdministratorFilename").fileinput('refresh', {previewClass: 'bg-info'});
					return false;
				}else{
					return true;
				}
		   }
		} 
	</script>

	<ol class="breadcrumb">
	 	<li class="active">Foto de perfil</li>
	</ol>	

	<div class="col-md-12">
		<center>
			<br /><h1>Selecciona foto perfil!</h1><hr /><br />
		</center>

		<div class="col-md-6 col-md-offset-3 fondoBti">
			<?php echo $this->Form->create('Administrator',[
								'type' => 'file',
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
										'div' => ['class' => 'form-group'],
										'class' => 'form-control',
										'before' => '<div class="col-md-12">',
										'label' => '',
										'between' => '<div class="col-md-11">',
										'after' => '</div></div>',
										'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;']]
								],
								'action' => 'editPhoto',
								'onsubmit' => 'return comprueba_extension()'
			]); ?>		

			<fieldset style="margin-top: 15px">
				<?= $this->Form->input('Administrator.id'); ?>	
				<?= $this->Form->input('Administrator.filename',['type' => 'file','class' =>'file','placeholder'=>'Selecciona foto']); ?>
				<?= $this->Form->input('Administrator.dir',['type' => 'hidden']); ?>
				<?= $this->Form->input('Administrator.mimetype',['type' => 'hidden']); ?>
				<?= $this->Form->input('Administrator.filesize',['type' => 'hidden']); ?>
				<?= $this->Form->input('Administrator.username',['type' => 'hidden']); ?>
				<?= $this->Form->input('Administrator.password',['type' => 'hidden']); ?>
				<?= $this->Form->input('Administrator.email',['type' => 'hidden']); ?>
				<?= $this->Form->input('Administrator.activation',['type' => 'hidden']); ?>
			</fieldset>	
			
		</div>

		<div class="col-md-6 col-md-offset-3" style="margin-top: 15px">
			<?php if($administrator['Administrator']['filename']<>''): ?>
				<div class="col-md-3 col-md-offset-3">
			<?php else: ?>
				<div class="col-md-3 col-md-offset-4">
			<?php endif; ?>

					<?php echo $this->Form->button('<i class="glyphicon glyphicon-floppy-save"></i>&nbsp;&nbsp; Guardar', array(
									'type' => 'submit',
									'div' => 'form-group',
									'class' => 'btn btnBlue btn-info',
									'escape' => false,
					)); ?>

				</div>

			<?php echo $this->Form->end(); ?>
			
			<?php if($administrator['Administrator']['filename']<>''): ?>
			<div class="col-md-3">
				<?php
					echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp; Eliminar','#',[
									'style' => 'cursor: pointer;',
									'class' => 'btn btn-danger',
									'id' => 'focusPhotoId',
									'onclick' => 'deletePhoto();',
									'escape' => false,
									]);
				?>
			</div>
			<?php endif; ?>
		</div>
	</div>
