<h1>Solicitud de identificacion</h1>
<form method="post" action="<?=site_url('proyecto_usuario/recupera_clave')?>">
Nombre de usuario: <?=form_input("id")?> <?=form_error('id')?><br>
<input type="submit" value="Enviar clave nueva a mi email">
</form>