<h1>Formulario de edicion de datos de usuario</h1>

<form action="<?=site_url('proyecto_usuario/modifica_datos')?>" method="post">
Nombre de usuario: <?=form_input("nombre", $datos['id'])?> <?=form_error('nombre')?><br>
Clave: <?=form_input("clave", $datos['clave'])?> <?=form_error('clave')?><br>
Confirma clave: <?=form_input("conf_clave", $datos['clave'])?> <?=form_error('conf_clave')?><br>
Nombre Real: <?=form_input("nombre_r",  $datos['nombre_real'])?><?=form_error('nombre_r')?><br>
Apellidos: <?=form_input("apellidos", $datos['apellidos'])?><?=form_error('apellidos')?><br>
Email: <?=form_input("email", $datos['email'])?> <?=form_error('email')?><br>
<input type="submit" value="Enviar">
</form>