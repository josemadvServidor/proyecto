<h1>Inicio de sesion</h1>
<p>Combinacion usuario - clave invalida</p>
<form action="<?=site_url('/proyecto_usuario/inicio_sesion')?>" method="post">
Nombre de Usuario <?=form_input("id",$id)?><br>
Clave <?=form_password("clave",$clave)?><br>
<input type="submit" value="Enviar">
</form><br>
<a href="<?=site_url('/proyecto_usuario/creaUsuario')?>">Nuevo usuario</a>
<a href="<?=site_url('/proyecto_usuario/recupera_clave')?>">He olvidado mi clave</a>
