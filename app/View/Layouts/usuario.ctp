<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<?php 
			echo $this->Html->charset(); 
		?>
		
        <title>
		<?php 
			echo $this->fetch('title');
		?>
		</title>
		
        <?php
		echo $this->Html->meta(array(
			'name' => 'viewport', 
			'content' => 'width=device-width, initial-scale=1.0',  
			'http-equiv' => "X-UA-Compatible"
		));
		echo $this->Html->meta('icon');

		echo $this->Html->css(array(
			'https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css',
			'bootstrap.min',
			'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
			'wow-animate',
			'unam-style',
			'morris-0.4.3.min',
			'custom',
			'http://fonts.googleapis.com/css?family=Open+Sans',
			));
		
		echo $this->Html->script(array(
			'vendor/modernizr-2.6.2-respond-1.1.0.min',
			'vendor/jquery-1.11.1.min',
			'jquery.min',
			'jquery-ui-1.8.23.custom.min',
			'vendor/wow-animate',			
			'vendor/bootstrap.min',
			'jquery.metisMenu',
			'morris/raphael-2.1.0.min',
			'userMain',
			'morris/morris',
			'custom',
			'https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js',
			'https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js',
		));
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');		
		?>
	<script>
        new WOW ({
          animateClass: 'animated',
          offset:  100
        }).init();

		$('.creload').on('click', function() {
			var mySrc = $(this).prev().attr('src');
			var glue = '?';
			if(mySrc.indexOf('?')!=-1)  {
				glue = '&';
			}
			$(this).prev().attr('src', mySrc + glue + new Date().getTime());
			return false;
		});
	</script>
    </head>
    <body onselectstart="return false;" ondragstart="return false;">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="header" id="top">
        <div class="header"  >
			<nav class="navbar navbar-inverse" role="navigation" style="background-color: #044c89 !important; min-height: 75px; text-align: center; ">
				<div class="container" style="height: 75px;">
					<?php 
					echo 
					$this->Html->link(
						$this->Html->image(
							"student/logo.png",
							array("alt" => "logo")) . ' Universidad Nacional' . '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'Autónoma de México',					
							array('controller'=>'pages',
								'action'=>'display',
								'home'),
							array(
								'class'=>'navbar-brand',
								'escape' => false,
								'style' => ' margin-left: 0; padding-bottom: 0; padding-right: 0; padding-top: 0; height: 75px;')							
					); 
					?>
				</div>
			</nav>
		</div> 
		
        <nav class="navbar navbar-inverse" role="navigation" style="background-color: #e1b715 !important; ">
          <div class="container" style="clear: none;">
              <div class="navbar-header">
                  <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
					<?php 
					echo 
					$this->Html->link(
						'Bolsa Universitaria de Trabajo', 
						array(
							'controller'=>'pages',
							'action'=>'display',
							'home'),
						array(
							'class'=>'navbar-brand',
							'escape' => false)	
					); 
					?>
              </div>

              <div id="main-nav" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
				   <li><?php 
				   echo $this->Html->link(
						'<span class="fa fa-home" ></span> Inicio', 
						array(
							'controller'=>'pages',
							'action'=>'display',
							'home'),
						array(
							'escape' => false)	
					); 
				   ?></li>
				  <li><?php 
				   echo $this->Html->link(
						'<span class="fa fa-external-link"></span> Portal BUT', 
						'http://www.dgoserver.unam.mx/portaldgose/bolsa-trabajo/htmls/index.html',
						array(
							'escape' => false,
							'target' => '_blank')	
					); 
				   ?></li>
				  <li><?php 
				   echo $this->Html->link(
						'<span class="fa fa-phone"></span> Contáctanos', 
						array(
							'controller'=>'Students',
							'action'=>'login'),
						array(
							'escape' => false)	
					); 
				   ?></li>
				  <li>
					<?php 
					  if($this->Session->check('Auth.User')):
					  else:
							echo '<strong style="padding-top: 15px; line-height: 20px; display: block; position: relative;">Ingresar como:</strong>';
					  endif;
					?>
				    </li>
				  <li><?php 
				  if($this->Session->read('Auth.User.role') === 'student'):
						echo $this->Html->link(
							'<span class="fa fa-sign-out"></span> Cerrar Sesión', 
							array(
								'controller'=>'Students',
								'action'=>'logout'),
							array(
								'escape' => false)	
						);
					else:
						if($this->Session->read('Auth.User.role') == ''):
							echo $this->Html->link(
								'<span class="fa fa-user"></span> Alumno', 
								array(
									'controller'=>'Students',
									'action'=>'login'),
								array(
									'escape' => false)	
							); 
						endif;
					endif;
				   ?></li>
				    <li><?php 
				   if($this->Session->read('Auth.User.role') === 'company'):
						echo $this->Html->link(
							'<span class="fa fa-sign-out"></span> Cerrar Sesión', 
							array(
								'controller'=>'Companies',
								'action'=>'logout'),
							array(
								'escape' => false)	
						);
					else:
						if($this->Session->read('Auth.User.role') == ''):
							echo $this->Html->link(
								'<span class="fa fa-building-o"></span> Empresa', 
								array(
									'controller'=>'Companies',
									'action'=>'login'),
								array(
									'escape' => false)	
							); 
						endif;
					endif;
				   ?></li>
				   <?php 
					if($this->Session->check('Auth.User')):
					?>
					   <li>			
						<?php 
						 if($this->Session->read('Auth.User.role') === 'company'):
						   echo $this->Html->link(
								'<span class="fa fa-building-o"></span>'. $this->Session->read('Auth.User.StudentProfile.name'), 
								array(
									'controller'=>'Companies',
									'action'=>'usuarios'),
								array(
									'style' => 'text-color: black',
									'escape' => false)	
							);
						else:
						 if($this->Session->read('Auth.User.role') === 'student'):
						 echo $this->Html->link(
								'<span class="fa fa-user"></span>'. $this->Session->read('Auth.User.StudentProfile.name'), 
								array(
									'controller'=>'Students',
									'action'=>'usuarios'),
								array(
									'style' => 'text-color: black',
									'escape' => false)	
							);
						endif;
						endif;
						
					   ?></li>				   
					<?php endif; ?>			  
                </ul>
              </div>
      		</div>
      </nav>
    </div>

    <div class="parallax">
	  
		<div id="wrapper">
					<nav class="navbar-default navbar-side" role="navigation">
					<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
				</div>
				<div class="sidebar-collapse">
					<ul class="nav" id="main-menu">
						<li class="text-center">
							<div class="grises">
							<?php

							if (isset($student)):
								if(isset($student['Student']['filename'])):
									echo $this->Html->image('uploads/student/filename/'.$student['Student']['filename'],
													array(
														'alt' => 'Profile Photo',
														'width' => '200px',
														'height' => '200px',
														'url' => array(
															'controller'=>'Students',
															'action'=>'updateRegister', $this->Session->read('Auth.User.id'))
													));
									else:
										echo $this->Html->image('student/avatar.png',
														array(
															'alt' => 'Profile Photo',
															'width' => '200px',
															'height' => '200px',
															'url' => array(
																'controller'=>'Students',
																'action'=>'updateRegister', $this->Session->read('Auth.User.id'))
														));
									endif;
							endif;
							?>
							</div>
							<!--img src="/unam/img/find_user.png" class="user-image img-responsive"/-->
							<p style="padding-top: 0;">	
							<?php 
								if (isset($student)):
									if(isset($student['StudentProfile']['name'])):
										echo $this->Html->link(
											$student['StudentProfile']['name'].
										' '.$student['StudentProfile']['last_name'], 
										array(
											'controller'=>'Students',
											'action'=>'usuario'),
										array(
											'escape' => false)	
										); 
									endif;
								endif;
							?></p>
						</li>
						<li>
							<a class="active-menu"  href="#"><i class="fa fa-home fa-2x"></i> Inicio</a>
						</li>
						<li>
							<a  href="http://localhost/unam/Students/usuario"><i class="fa fa-edit fa-2x"></i>Mi perfil</a>
						</li>
						<li>
							<a  href="http://localhost/unam/Students/usuario"><i class="fa fa-pencil fa-2x"></i>Mi currículum</a>
						</li>
						<li>
							<a   href="http://localhost/unam/Students/usuario"><i class="fa fa-eye fa-2x"></i> Enviar mi CV</a>
						</li>	
						<li>
							<a  href="http://localhost/unam/Students/usuario"><i class="fa fa-th-list fa-2x"></i>Buscar ofertas</a>
						</li>
						<li>
							<a  href="http://localhost/unam/Students/usuario"><i class="fa fa-key fa-2x"></i>Administrar ofertas </a>
						</li>					
					</ul>    
				</div>
			</nav>  

			<div id="container" >
				
				<?php echo $this->fetch('content'); ?>
				
			</div>
		</div>
		
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="social-icons">
                <ul>
					<li>
						<?php 
						echo $this->Html->link(
							'<span class="fa fa-facebook"></span>', 
							'https://www.facebook.com/UNAM.MX.Oficial',
							array(
								'escape' => false,
								'target' => '_blank')	
						); 
						?>
					</li>
					<li>
						<?php 
						echo $this->Html->link(
							'<span class="fa fa-twitter"></span>', 
							'https://twitter.com/unam_mx',
							array(
								'escape' => false,
								'target' => '_blank')	
						); 
						?>
					</li>
					<li>
						<?php 
						echo $this->Html->link(
							'<span class="fa fa-phone"></span>', 
							'http://www.directorio.unam.mx/consultasvarias.htm',
							array(
								'escape' => false,
								'target' => '_blank')	
						); 
						?>
					</li>
					<li>
						<?php 
						echo $this->Html->link(
							'<span class="fa fa-youtube"></span>', 
							'https://www.youtube.com/user/unam',
							array(
								'escape' => false,
								'target' => '_blank')	
						); 
						?>
					</li>
					<li>
						<?php 
						echo $this->Html->link(
							'<span class="fa fa-video-camera"></span>', 
							'http://webcast.unam.mx/',
							array(
								'escape' => false,
								'target' => '_blank')	
						); 
						?>
					</li>
					<li>
						<?php 
						echo $this->Html->link(
							'<span class="fa fa-link"></span>', 
							'http://www.unam.mx/pagina/es/37/sitios-web-en-la-unam',
							array(
								'escape' => false,
								'target' => '_blank')	
						); 
						?>
					</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="copyright-text">
              <p>Designed by: <a href="www.kaitensoft.com">Kaitensoft</a></p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="third-arrow">
              <a href="#" class="scroll-link btn btn-dark" data-id="top"><i class="fa fa-angle-up"></i></a>
            </div>
          </div>
        </div>
      </footer>
    </div>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stop();"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Video Tutorial</h4>
				</div>
				<div class="modal-body">
					<iframe id="iframeVideo" src=""  width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="stop();">Close</button>
				</div>
			</div>
		</div>
	</div>     
	
  </body>
</html>
