<h1>Gestion de usuarios administradores del blog <?=$blog[0]['titulo']?></h1>

<table>
<tr>
<th>Administradores</th>
</tr>
<tr>
<?php foreach ($usuariosAdmin as $usuario){?>
<td>

<?=$usuario['idusu']?>
</td>
<?php }?>
</tr>
</table>
<a href="<?=site_url('/proyecto_usuario/nuevoPermiso/'.$blog[0]['id'])?>">Otorgar permisos</a>

