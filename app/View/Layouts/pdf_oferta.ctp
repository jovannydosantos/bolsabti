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
			echo 'SISBUT UNAM';
		?>
		</title>
		
        <?php
		echo $this->Html->meta(array(
			'name' => 'viewport', 
			'content' => 'width=device-width, initial-scale=0', 
			
			'http-equiv' => "X-UA-Compatible"
		));
		echo $this->Html->meta ( 'favicon.ico', '/img/SISBUTicon.png', array (
			'type' => 'icon' 
		) );
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
    </head>
	
    <body class="unresponsive" onselectstart="return false;" ondragstart="return false;"  style="overflow: auto;">
		  
		<div class="header">
			<div class="row">
				<div style="position:relative; margin: 0 auto; left: 0; right: 0; width:1280px;text-align: center; min-width: 580px; max-width: 1280px"  >
					<?php echo $this->Html->image('student/headerPage.png',
											array(
												'alt' => 'Registro primera vez imagen', 
												'style'=> 'align-self: center; image-rendering: auto; width: 100%;',
												'class' => 'img-responsive center-block"',
					)); ?>
				</div>
			</div>
		</div>
	
		<div class="content" style="margin-top: 30px;" >
			<center>
				<div class="row">
					<div style="width:1280px;">
						<div class="col-md-12">
							<?php echo $this->fetch('content'); ?> 
						</div>
					</div>
				</div>
			</center>
		</div>

		<div class="footer" id="footer" style="text-align: center; min-width: 555px;" >
		
			<div class="col-md-12" style="margin-top: 40px;">
			
				<div class="col-md-12">
					<hr style="border-color: red; color: red; border-width: 4px 0 0;  margin-top: 0px;" size=1>
				</div>
			</div>

			<br /><br /><br /><br /><br /><br /><br />
		
			<div class="col-md-12">
				<p><hr style="border-color: #002377; color: #002377; width: 100%;  border-width: 5px 0 0;" size=1> </p>
			</div>
			<p style="color:#7fa4ff; font-size: 0.96em; line-height:18px;">Hecho en México, todos los derechos reservados 2015. Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica. De otra forma requiere permiso previo por escrito de la institución. Última actualización 14 de Mayo del 2015. Créditos.<br /><br />
			Sitio web administrado por:<br />Dirección General de Orientación y Servicios  Educativos. dgose@unam.mx</p>
		</div>
  </body>
</html>


