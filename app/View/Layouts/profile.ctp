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
			'content' => 'width=device-width, initial-scale=0', 
			
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
		  
	<div class="header">
		<div class="row">
				<?php echo $this->Html->image('student/headerPage.png',
										array(
											'alt' => 'Registro primera vez imagen', 
											'style'=> 'align-self: center; image-rendering: -moz-crisp-edges; width: 100%; min-width: 495px;',
											'class' => 'class="img-responsive center-block"',
											'url' => array(
													'controller'=>'pages',
													'action'=>'display',
													'home'),
				)); ?>
		</div>
	</div>
	
	
		
	 <div class="parallax">
	  
		<div id="wrapper" style="min-width: 480px;">
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
						<li class="text-center" style="background-color: rgb(66, 106, 210); padding-top: 30px; border-bottom-width: 0px; margin-bottom: 0px; padding-bottom: 30px;">
							<div class="grises">
							<p>Bienvenido(a),</p>
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
							<?php
							if (isset($student)):
								if(isset($student['Student']['filename'])):
									echo $this->Html->image('uploads/student/filename/'.$student['Student']['filename'],
													array(
														'alt' => 'Profile Photo',
														'width' => '130px',
														'height' => '150px',
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
							
						</li>
						<li>
							<a href="http://localhost/unam/Students/usuario" class="brown activo">Mi perfil</a>
						</li>
						<li>
							<a  href="http://localhost/unam/Students/usuario" class="brown">Mi currículum</a>
						</li>
						<li>
							<a   href="http://localhost/unam/Students/usuario" class="brown">Enviar mi CV</a>
						</li>	
						<li>
							<a  href="http://localhost/unam/Students/usuario" class="brown">Buscar ofertas</a>
						</li>
						<li>
							<a  href="http://localhost/unam/Students/usuario" class="brown">Administrar ofertas </a>
						</li>					
					</ul>    
				</div>
			</nav>  
		</div>	
	</div>
	
	<?php echo $this->fetch('content'); ?>  

	<div class="footer" id="footer" style="text-align: center; min-width: 480px;">
		<a href="#" style="color:#7fa4ff; text-decoration: underline;">Aviso de Privacidad</a>
		
		<div class="row">
			<hr style="border-color: red; color: red;  border-width: 4px 0 0;  width: 90%;" size=1> 
		 </div>
		 
		 
		<div class="row">
			<div class="col-xs-4 col-sm-2 ">
					<img src="/unam/img/home/1.png" alt="...">
				<p class="justify">Descripción imagen</p>
			</div>
			<div class="col-xs-4 col-sm-2">
					<img src="/unam/img/home/1.png" alt="...">
				<p>Descripción imagen</p>
			</div>
			<div class="col-xs-4 col-sm-2">
					<img src="/unam/img/home/1.png" alt="...">
				<p>Descripción imagen</p>
			</div>
			<div class="col-xs-4 col-sm-2">
					<img src="/unam/img/home/1.png" alt="...">
				<p>Descripción imagen</p>
			</div>
			<div class="col-xs-4 col-sm-2">
					<img src="/unam/img/home/1.png" alt="...">
				<p>Descripción imagen</p>
			</div>
			<div class="col-xs-4 col-sm-2">
					<img src="/unam/img/home/1.png" alt="...">
				<p>Descripción imagen</p>
			</div>
			
		</div>
		
        <hr style="border-color: #002377; color: #002377; width: 93%;  border-width: 4px 0 0;" size=1> 
		<p style="color:#7fa4ff; margin-left: 15px; ">Hecho en México, todos los derechos reservados 2016. Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica. De otra forma requiere permiso previo por escrito de la institución. Última actualización 15 de Septiembre del 2016. Créditos.<br /><br />
		Sitio web administrado por:<br />Dirección General de Orientación y Atención Educativa. dgose@unam.mx</p>
		<p style="color:#7fa4ff; margin-left: 15px">Sitio web administrado por:</p>
		<p style="color:#7fa4ff; margin-left: 15px">Dirección General de Orientación y Servicios  Educativos. dgose@unam.mx</p>
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