<!DOCTYPE html>
<html>
<head>
<link type="text/css" href="<?=site_url('../Assets/css/css.css')?>" rel="stylesheet">

<meta charset="UTF-8">
</head>
<body class="cuerpo">
<script type="text/javascript" src="<?=site_url('../Assets/js/tinymce/tinymce.min.js')?>"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<!-- Versión compilada y comprimida del CSS de Bootstrap -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
 
<!-- Tema opcional -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
 
<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>




<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li> <h1>Proyecto Josem</h1></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<?php if ($this->session->userdata('dentro') == false){?>


<li><a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_usuario/inicio_sesion')?>">Iniciar Sesion</a></li>
<li><a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_usuario/creaUsuario')?>">Registrarse</a></li>
<?php }else{?>
	<?php if($this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){ ?>
<li><a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/gestiona_usuarios')?>">Gestionar usuarios<span class="glyphicon glyphicon-cog"></span></a> </li>
<?php }?>
<li><a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/modifica_datos')?>">Modificar la informacion de usuario<span class="glyphicon glyphicon-cog"></span></a> </li>

<li><a class="btn btn-lg btn-default" href="<?=site_url('/proyecto_usuario/cierra_sesion')?>">Usuario: <?=$this->session->userdata('id')?>(conectado) Cerrar sesion  <span class="glyphicon glyphicon-off"></span> </a></li>

<?php } ?>
</ul>
</div>

