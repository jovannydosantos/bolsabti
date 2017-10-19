	<?php 
		foreach($administradores as $k => $administrador):
	?>
		<div class="col-md-10 col-md-offset-1 sombra" style="border: 1px solid #1a75bb; margin-bottom: 15px; background: url('/bolsabti/img/satinweave.png');">    
			
			<div class="col-md-2 visible-lg visible-md text-center" style="margin-top: 3%; padding-left: 0px; padding-right: 0px;">
				<?php
					$url = WWW_ROOT.'img/uploads/administrator/filename/'.$administrador['Administrator']['filename'];
					if( (!isset($administrador)) || (!isset($administrador['Administrator']['filename']) || (!file_exists( $url )) || (($administrador['Administrator']['filename'] == '')))):
						echo $this->Html->image('company/imagenNoEncontrada.png',['style'=>'width:85%; height: 100%; ' ]);
					else:
						echo $this->Html->image('uploads/administrator/filename/'.$administrador['Administrator']['filename'],['style'=>'width:100%; height: 100%; image-rendering: pixelated;' ]);
					endif;
				?>			
				<p style="margin-top: 5px; font-size: 11px">
					<?php echo $administrador['AdministratorProfile']['contact_name'].' '.$administrador['AdministratorProfile']['contact_last_name'].' '.$administrador['AdministratorProfile']['contact_second_last_name']; ?>
				</p>
			</div>

			<div class="col-md-6" style="margin-top: 20px;font-size: 14px">
				<?php
					$caracteres = strlen($administrador['Administrator']['id']);
					$faltantes = 5 - $caracteres;	
					if($faltantes > 0):
						$ceros = '';
						for($cont=0; $cont<=$faltantes;$cont++):
							$ceros .= '0';
						endfor;
						$folio = $ceros.$administrador['Administrator']['id'];
					else:
						$folio = strlen($administrador['Administrator']['id']);
					endif;
				?>
				<span><strong>Folio: </strong><?php echo $folio; ?></span><br />
				<?php 
					if($administrador['AdministratorProfile']['institution']<>''):
						echo '<span><strong>Escuela / Facultad: </strong><span style="font-weight: normal;">'.$EscuelasFacultades[$administrador['AdministratorProfile']['institution']].'</span></span><br />';
					else:
						echo '<span><strong>Escuela / Facultad: <</strong>span style="font-weight: normal;">Sin especificar</span></span><br />';
					endif;
				?>
				<span><strong>Cargo: </strong><span style="font-weight: normal;"><?php  echo $administrador['AdministratorProfile']['contact_position']; ?> </span></span><br />
				<?php 
					echo ($administrador['AdministratorProfile']['telephone'] <> '') ? '<span><strong>Teléfono: </strong><span style="font-weight: normal;">'. $administrador['AdministratorProfile']['long_distance_cod'].$administrador['AdministratorProfile']['telephone'].'</span></span><br />' : '';
					echo ($administrador['AdministratorProfile']['cell_phone'] <> '') ? '<span><strong>Celular: </strong><span style="font-weight: normal;">'.$administrador['AdministratorProfile']['long_distance_cod_cell_phone'].$administrador['AdministratorProfile']['cell_phone'] . '</span></span>' : '';
				?>
			</div>
		
			<div class="col-md-4" style="margin-top: 15px;"><center>
				<?php
				 // Descativar - Activar Administrador
				 if($administrador['Administrator']['role'] == 'administrator'):
					echo $this->Html->image('student/activa.png',
								['title' => 'Administrador activo click para desactivar',
								'class' => 'class="img-responsive center-block"',
								'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
								'onclick' => 'avisoAdmin();']);
				else:
					if($administrador['Administrator']['id'] == $this->Session->read('Auth.User.id')):
						echo $this->Html->image('student/activa.png',
									['title' => 'Administrador activo click para desactivar',
									'class' => 'class="img-responsive center-block"',
									'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
									'onclick' => 'avisoSameAdmin();']);									
					else:
						if($administrador['Administrator']['status'] == 0):
							$imagen = 'student/noActiva.png';
						else:
							$imagen = 'student/activa.png';
						endif;

						echo $this->Html->image($imagen,
									['title' => 	'Administrador inactivo click para activar',
									'style' => 	'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
									'class' => 	'class="img-responsive center-block"',
									'url' => [	'controller'=>'Administrators',
												'action'=>'enableDisableAdministrator',
												'?' => ['id' => $administrador['Administrator']['id'],
														'estatus' => $administrador['Administrator']['status']]]]);
					endif;
				endif;
				?>
				<?= $this->Html->image('administrator/arroba.png',
									['title' => 'Enviar correo',
									'class' => 'class="img-responsive center-block"',
									'onclick' => 'saveEmailNotification("'.$administrador['Administrator']['email'].'");',
									'style' => 'width: 20px; height: 20px; margin-right: 6px;cursor: pointer;',
									]);?>
				<?php 
					 // Eliminar administrador
					if($administrador['Administrator']['role']<>'administrator'):
					 echo $this->Html->image('student/eliminar.png',
									['title' => 'Eliminar administrador',
									'style' => 'width: 20px; height: 20px; margin-right: 10px; cursor: pointer;',
									'class' => 'class="img-responsive center-block"',
									'id' => 'focusAdminId'.$administrador['Administrator']['id'],
									'onclick' => 'deleteRegister('.$administrador['Administrator']['id'].',"'.$administrador['Administrator']['username'].'");']);
							
					 echo $this->Form->postLink($this->Html->image('student/eliminar.png',
											array('alt' => 'Eliminar administrador', 'title' =>'Eliminar administrador', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteStudentId'.$administrador['Administrator']['id'] )), 
											array('action' => 'deleteAdministrator',$administrador['Administrator']['id']), 
											array('escape' => false));
					endif;
					?>
				</center>
			</div>
		
			<div class="col-md-4" style="margin-top: 15px;"><center>
					<span><strong>Correo electrónico: </strong></span><span style="font-weight: normal;"><?php  echo $administrador['Administrator']['email']; ?> </span><br />
					<span><strong>Usuario: </strong></span><span style="font-weight: normal;"><?php  echo $administrador['Administrator']['username']; ?> </span>
					<?php
					if(($administrador['Administrator']['role'] == 'administrator') and ($this->Session->read('Auth.User.role') == 'subadministrator')):	
						echo $this->Form->button('Editar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-pencil"></i>', 
												['type' => 'button',
												'div' => 'form-group',
												'class' => 'btn btn btn-bti col-md-12',
												'style' => 'margin-top: 5px;',
												'escape' => false,
												'onclick' => 'avisoAdmin('.$administrador['Administrator']['id'].');']);
					else:
						echo $this->Html->link('Editar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-pencil"></i>', 
											['controller'=>'Administrators',
											'action'=>'editAdministratorProfile', $administrador['Administrator']['id']],
											['class' => 'btn btn btn-bti col-md-12',
											'style' => 'margin-top: 5px;',
											'escape' => false]); 	
					endif;
					?>
			</center></div>
		</div>
<?php endforeach; ?>