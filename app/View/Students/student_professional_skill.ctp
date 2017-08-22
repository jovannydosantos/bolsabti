	<?php $this->layout = 'student'; ?>

	<script>
		$(document).ready(function() {
			var $marcados =$("#competenciasContentId input:checked");
			$( ".numeroCompetencias" ).append( $marcados.length);
		});

		function checkCompetencies(indexClass){
			var $marcados =$("#competenciasContentId input:checked");
	        if ($marcados.length > 7){
	        	$.alert({ title: '!Aviso!',type: 'blue',content: 'Le recordamos que tiene un número limitado de opciones.'});
				$("."+indexClass).prop('checked', false);
			} else{
				$( ".numeroCompetencias" ).empty();
				$( ".numeroCompetencias" ).append( $marcados.length);
			}
		}
		
		function validateInputs(){
			var $marcados =$("#competenciasContentId input:checked");
	        if ($marcados.length < 7){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione 7 competencias para continuar.'});
				return false;
			} else{
				return true;
			}
		}

		function src(url){
			$('#myModal').modal('show');
		}

	</script>

	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD">Seleccione siete competencias profesionales (tome en cuenta sus fortalezas).  <img data-toggle="tooltip" data-placement="bottom" title="Conjunto de conocimientos, habilidades, comportamientos y motivaciones que tiene una correlación con el desempeño sobresaliente de las personas en un puesto determinado." class="img-circle cambia" alt="help.png" src="/unam/img/help.png"></p>
    </blockquote>

	<?php
		$resultado = count($Competencias);
		$division = intval($resultado / 2);
		$cont = 0;
	?>
		
		<?php 
			echo $this->Form->create('Student', array(
										'class' => 'form-horizontal', 
										'role' => 'form',
										'inputDefaults' => array(
												'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
												'div' => array('class' => 'form-group row'),
												'class' => 'form-control',
												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
												'between' => ' <div class="col-md-6">',
												'after' => '</div></div>',
												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
										),
										'onsubmit' =>'return validateInputs();',
										'action' => 'studentProfessionalSkill',
			)); ?>		
					
		<div class="col-md-8 col-md-offset-2" style="margin-top: 15px; color: #717171;">
			<div class="panel panel-default">
				<div class="panel-body"  id="competenciasContentId" >
					
					<div class="col-md-6">
						
						<?php foreach($Competencias as $k => $Competencia): ?>
							<?php 
								if($cont == $division):
									echo '</div><div class="col-md-6">';
								endif;
								
								$opcion = '';
								 foreach($CompetenciasAlumno as $k => $CompetenciaAlumno): 
									if($Competencia['Competency']['id'] == $CompetenciaAlumno['StudentProfessionalSkill']['competency_id']):
										$opcion = 'checked';
									endif;
								 endforeach;
								 
								echo $this->Form->checkbox('StudentProfessionalSkill.'.$cont.'.competency_id', array(
											'value' => $Competencia['Competency']['id'],
											'label' => '',
											'checked' => $opcion,
											'style' => 'display: inline',
											'class' => 'competencyClass'.$cont,
											'onClick' => 'checkCompetencies("competencyClass'.$cont.'");',
							));?>
							<span class="titulos"><?php echo $Competencia['Competency']['description']; ?></span>
							<br>
										
						<?php $cont++; endforeach; ?>
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-8 col-md-offset-2" style = "margin-top: -15px;">
			<span style="color:red;">*</span>Competencias Seleccionadas: <span class="numeroCompetencias"> </span>
			<span style="float: right;"><a onclick="src('http://www.vitoria-gasteiz.org/we001/was/we001Action.do?idioma=es&aplicacion=wb021&tabla=contenido&uid=u_107ffc00_138d6267ccb__7fd0');" type="button"  style="margin-bottom: 12px; text-decoration: underline; cursor:pointer">Diccionario de competencias</a><img data-toggle="tooltip" id="" data-placement="top" title="Liga que permite conocer la definición de cada una de las competencias mostradas." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style ="margin-left: 10px;"></span>
		</div>

		
		<div class="col-md-12 text-center">
			<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
			<?= $this->Form->end(); ?>
		</div>	
		
		<div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
			<div class="modal-dialog"  >
				<div class="modal-content" >
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Diccionario de competencias</h4>
					</div>
					<div class="modal-body scrollbar" id="style-2">
						
						<table class="table table-bordered table-condensed table-responsive" style="margin-top: 15px; margin-bottom: 15px;">
							<thead>
							  <tr>
								<th>Competencia</th>
								<th>Definición</th>
							  </tr>
							</thead>
							<tbody>
								<?php	
									foreach($Competencias as $competencia):
										echo '<tr><td>'.$competencia['Competency']['description'].'</td><td>'.$competencia['Competency']['meaning'].'</td></tr>';
									endforeach;
								?>	 
							</tbody>
					  	</table>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btnBlue" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
