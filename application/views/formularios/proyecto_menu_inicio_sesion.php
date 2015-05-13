<h1>Inicio de sesion</h1>
<?php echo validation_errors();?>
<form action="<?=site_url('/proyecto_usuario/inicio_sesion')?>" method="post">

Nombre de Usuario <?=form_input("id")?> <?=form_error('id')?><br>
Clave <?=form_password("clave")?> <?=form_error('clave')?><br>

<input type="submit" value="Enviar">
</form><br>
<a href="<?=site_url('/proyecto_usuario/creaUsuario')?>">Nuevo usuario</a>
<a href="<?=site_url('/proyecto_usuario/recupera_clave')?>">He olvidado mi clave</a>
<br>