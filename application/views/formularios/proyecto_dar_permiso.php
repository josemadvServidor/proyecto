<h1>Otorgar permiso sobre el blog <?=$blog[0]['titulo']?></h1>

<form method="post" action="<?=site_url('proyecto_usuario/nuevoPermiso/' . $blog[0]['id'])?>">
Nombre del usuario: <input type="text" name="busca"><?=form_error('busca')?>
<input type="submit" value="Buscar Usuario">

</form>
<a href="<?=site_url('proyecto_principal/muestraBlog/' . $blog[0]['id'])?>">Volver al blog</a>