<h1>Formulario de creacion de usuarios</h1>

<form action="<?=site_url('proyecto_usuario/creaUsuario')?>" method="post">
Nombre de usuario: <?=form_input("nombre")?> <?=form_error('nombre')?><br>
Clave: <?=form_password("clave")?> <?=form_error('clave')?><br>
Confirma clave: <?=form_password("conf_clave")?> <?=form_error('conf_clave')?><br>
Nombre Real: <?=form_input("nombre_r")?> <?=form_error('nombre_r')?><br>
Apellidos: <?=form_input("apellidos")?> <?=form_error('apellidos')?><br>
Email: <?=form_input("email")?> <?=form_error('email')?><br>
<input type="submit" value="Enviar">
</form>
