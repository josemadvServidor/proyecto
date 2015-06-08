<!DOCTYPE html>
<html>
<head>
<link type="text/css" href="<?=site_url('../Assets/css/css.css')?>" rel="stylesheet">
<script type="text/javascript" src="<?=site_url('../Assets/js/tinymce/tinymce.min.js')?>"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<!-- Versión compilada y comprimida del CSS de Bootstrap -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
 
<!-- Tema opcional -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
 

<meta charset="UTF-8">
</head>
<body class="cuerpo">


<nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"  data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand">Proyecto Josema</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
       
  <?php 
  
  // ERROR en la clase
  // <div class="collapse navbar-collapse ** OJO AL PUNTO *** .navbar-ex1-collapse">
   
  ?>
       
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
     <li><a href="<?=site_url('proyecto_principal/')?>">Inicio
     <span class="glyphicon glyphicon-home"></span></a>
     </li>
     
       <?php if ($this->session->userdata('dentro')){?>
       
      <li><a href="<?=site_url('/proyecto_principal/creablog')?>">Crear nuevo blog</a></li>
      
      <?php }?>
    </ul>
 
    <form  method="post" action="<?=site_url('proyecto_principal/buscaBlogs')?>"class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input class="form-control" placeholder="texto a buscar" type="text" name="buscab">
      </div>
      <button type="submit" class="btn btn-default">Buscar</button>
    </form>
    
   
 
    <ul class="nav navbar-nav navbar-right">
    
    <?php if ($this->session->userdata('dentro')){?>
    
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         Usuario: <?=$this->session->userdata('id')?>(conectado) <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?=site_url('/proyecto_usuario/cierra_sesion')?>">Cerrar sesion  
				<span class="glyphicon glyphicon-off"></span>
			</a></li>
          <li><a href="<?=site_url('/proyecto_usuario/modifica_datos')?>">
          Modificar la informacion de usuario<span class="glyphicon glyphicon-cog"></span>
			</a></li> 
<?php if($this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){ ?>
           <li class="divider"></li>
         
           <li><a href="<?=site_url('/proyecto_usuario/gestiona_usuarios')?>">Gestionar usuarios<span class="glyphicon glyphicon-cog"></span>
			</a></li>
<?php }?>
          
        </ul>
      </li>
     <?php  }else{ ?>

      <li><a href="<?=site_url('proyecto_usuario/inicio_sesion')?>">Iniciar Sesion</a></li>
	  <li><a href="<?=site_url('proyecto_usuario/creaUsuario')?>">Registrarse</a></li>
     	
     	
     	
     	<?php 
     }?> 
    </ul>
  </div>
</nav>
<?php /*?>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li>
				<h1>Proyecto Josem</h1>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
<?php if ($this->session->userdata('dentro') == false){?>


<li><a class="btn btn-primary btn-sm"
				href="<?=site_url('proyecto_usuario/inicio_sesion')?>">Iniciar
					Sesion</a></li>
			<li><a class="btn btn-primary btn-sm"
				href="<?=site_url('proyecto_usuario/creaUsuario')?>">Registrarse</a></li>
<?php }else{?>
	<?php if($this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){ ?>
<li><a class="btn btn-primary btn-sm"
				href="<?=site_url('/proyecto_usuario/gestiona_usuarios')?>">Gestionar
					usuarios<span class="glyphicon glyphicon-cog"></span>
			</a></li>
<?php }?>
<li><a class="btn btn-primary btn-sm"
				href="<?=site_url('/proyecto_usuario/modifica_datos')?>">Modificar
					la informacion de usuario<span class="glyphicon glyphicon-cog"></span>
			</a></li>

			<li><a class="btn btn-lg btn-default"
				href="<?=site_url('/proyecto_usuario/cierra_sesion')?>">Usuario: <?=$this->session->userdata('id')?>(conectado) Cerrar sesion  <span
					class="glyphicon glyphicon-off"></span>
			</a></li>

<?php } ?>
</ul>
	</div>

	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li><a class="btn btn-primary btn-sm"
				href="<?=site_url('proyecto_principal/')?>">Inicio <span
					class="glyphicon glyphicon-home"></span></a></li>
<?php if ($this->session->userdata('dentro') == false){?>

<?php }else{?>
	

<li><a class="btn btn-lg btn-default"
				href="<?=site_url('/proyecto_principal/creablog')?>">Crear nuevo
					blog</a></li>
<?php } ?>
</ul>
		<ul class="nav navbar-nav navbar-right">

			<form action="<?=site_url('proyecto_principal/buscaBlogs')?>"
				method="post">

				<li><input class="form-control" placeholder="texto a buscar"
					type="text" name="buscab"></li>
				<li><input class="btn btn-default" type="submit" value="Buscar"></li>

			</form>
		</ul>
	</div><?php */?>


<?php
if ($this->session->userdata ( 'dentro' )) {
	$blogs = $this->proyecto_modelo_blog->blogsUsu ( $this->session->userdata ( 'id' ) );
	?><div class="panel panel-default">
		<div class="panel-heading">
			<h2>Blogs que administra:</h2>
		</div>
		<div class="panel-body"><?php
	if (count ( $blogs ) > 0) {
		?>
    	
    
    <?php
		foreach ( $blogs as $blog ) {
			
			$blogInf = $this->proyecto_modelo_blog->devblog ( $blog ['idblog'] );
			
			?>
    		
    		<a class="btn btn-primary btn-sm"
				href="<?=site_url('/proyecto_principal/muestraBlog/' . $blogInf[0]['id'])?>"><?=$blogInf[0]['titulo']?>  </a>
    		<?php 
    	}
    	?>
    	<?php 
    }else{
?>    	

<p>Aun no administra ningun blog</p>
<?php 
    }
    ?>
    </div>
	</div>
    <?php 
    }
?>
<?=$cuerpo?>



	<!-- Bootstrap core JavaScript
================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script
		src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
		
		
<?php if (FALSE ) :
// NO INCLUIDO 

// REVISA LOS ENLACES QUE HAS PUESTO PUES ALGUNO NO FUNCIONA, CREO
?>		
<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>


 <script src="<?=site_url('../Assets/jquery/jquery-1.11.3.min.js')?>" type="text/javascript"></script> 
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<?php endif; ?>		
</body>
</html>