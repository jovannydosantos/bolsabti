
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <?= $this->Html->charset(); ?>

  <title>
    <?= 'Bolsa bti' ?>
  </title>

  <?= $this->Html->meta(array(
    'name' => 'viewport', 
    'content' => 'width=device-width, initial-scale=1', 
    'http-equiv' => "X-UA-Compatible"
    )); ?>

  <?= $this->Html->meta ( 'favicon.ico', '/img/SISBUTicon.png', array (
    'type' => 'icon' 
    ) ); ?>

  <?= $this->Html->css(['bootstrap-select.min','bootstrap.min','fileinput.min','bootstrap-responsive.min','btiStyle','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css','menu']) ?>
  <?= $this->Html->script(['jquery-3.1.1.min','bootstrap.min','fileinput.min','bootstrap-select.min','jquery.alerts','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js','menu']) ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>   

</head>

<body>

  <div class="wrap">
    <nav class="nav-bar navbar-inverse" role="navigation">
        <div id ="top-menu" class="container-fluid active">
            <a class="navbar-brand" href="#">Brand</a>
            <ul class="nav navbar-nav">        
                <form id="qform" class="navbar-form pull-left" role="search">
                   <input type="text" class="form-control" placeholder="Search" />                        
                 </form>
                <li class="dropdown movable">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="fa fa-4x fa-child"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><span class="fa fa-user"></span>My Profile</a></li>
                        <li><a href="#"><span class="fa fa-gear"></span>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><span class="fa fa-power-off"></span>Logout</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>      
    </nav>
    <aside id="side-menu" class="aside" role="navigation">            
          <ul class="nav nav-list accordion">                    
            <li class="nav-header">
              <div class="link"><i class="fa fa-lg fa-globe"></i>Portal<i class="fa fa-chevron-down"></i></div>
              <ul class="submenu">
                <li><a href="#">Dashboard</a></li>  
                <li><a href="#">Settings</a></li>  
                <li><a href="#">Administration</a></li>  
              </ul>
            </li>
            
            <li class="nav-header">
              <div class="link"><i class="fa fa-lg fa-users"></i>Users<i class="fa fa-chevron-down"></i></div>
              <ul class="submenu">
                <li><a href="#">Users</a></li>
                <li><a href="#">New User</a></li>
              </ul>
            </li>
            
            <li class="nav-header">
              <div class="link"><i class="fa fa-cloud"></i>Sites<i class="fa fa-chevron-down"></i></div>
              <ul class="submenu">
                <li><a href="#">Search Sites</a></li>
                <li><a href="#">New Site</a></li>
                <li><a href="#">Jobs</a></li>
              </ul>
            </li>  
            
             <li class="nav-header">
              <div class="link"><i class="fa fa-lg fa-map-marker"></i>Zones<i class="fa fa-chevron-down"></i></div>
              <ul class="submenu">
                <li><a href="#">Search Zones</a></li>
                <li><a href="#">New Zone</a></li>
              </ul>
            </li>
            
            <li class="nav-header">
              <div class="link"><i class="fa fa-lg fa-file-image-o"></i>Reports<i class="fa fa-chevron-down"></i></div>
              <ul class="submenu">
                <li><a href="#">Entries</a></li> 
                <li><a href="#">Redirects</a></li> 
                <li><a href="#">Pingbacks</a></li>          
                <li><a href="#">Tags</a></li>
              </ul>
            </li>
            
        </ul>
    </aside>
    
    <!--Body content-->
    <div class="content">
      <div class="top-bar">       
        <a href="#menu" class="side-menu-link burger"> 
          <span class='burger_inside' id='bgrOne'></span>
          <span class='burger_inside' id='bgrTwo'></span>
          <span class='burger_inside' id='bgrThree'></span>
        </a>      
      </div>
      <section class="content-inner">
        <h2>Sample</h2>
        <h3>A responsive Top and Side Menu, resize your browser to find out</h3>
      </section>
    </div>  
    
  </div>
</body>
</html>