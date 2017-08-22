<?php $this->layout = 'student'; ?>
	<script>
		function viewSearch(){
			 selectedIndex = document.getElementById("StudentLimit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById("limitRequest").submit();
			 }
		}
	</script>

	<ol class="breadcrumb">
	    <li><?= $this->Html->link('Mi perfil', ['controller'=>'Students','action' => 'profile'] );?></li>
	 	<li class="active">Recomendaciones</li>
	</ol>

	<?php if(isset($ofertas)): 
			if(empty($ofertas)):
				echo '<div class="col-md-12" style="margin-top: 15px;">';
				echo '<p style="font-size: 22px;">Sin ofertas recomendadas</p></div>';
			else:
	?>
				<div class="col-md-3" style="margin-top: 15px;">
					<?= $this->Form->create('Student', [
										'class' => 'form-horizontal',
										'id' => 'limitRequest',
										'role' => 'form',
										'inputDefaults' => [
															'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
															'div' => ['class' => 'form-group'],
															'class' => 'form-control',
															'before' => '<div class="col-md-12 ">',
															'between' => ' <div class="col-md-11">',
															'after' => '</div></div>',
															'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]],
										'action' => 'profile',
						]); ?>
					<?php 	$options = ['5'=> 5, '10'=> 10, '25' => 25, '50' => 50, '100' => 100];
							echo $this->Form->input('limit',[
																'onchange' => 'viewSearch()' ,
																'type'=>'select',
																'selected' => $this->Session->read('limit'),
																'label' =>'',
																'class'=>'form-control selectpicker show-tick show-menu-arrow',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja']); ?>
					<?= $this->Form->end(); ?>	
				</div>

				<div class="col-md-12 scrollbar" id="style-2" >
					
					<?= $this->element('ofertas'); ?>

				</div>

	<?php 
			endif;
		endif; 
	?>

	