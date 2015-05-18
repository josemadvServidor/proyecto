<div class="panel panel-default">
<div class="panel-heading"><h2>Gestion de usuarios administradores del blog <?=$blog[0]['titulo']?></h2></div>
<div class="panel-body">
<div  class="col-md-8">
<div class="table-responsive">
  <table class="table">
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
</div>
</div>
<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/nuevoPermiso/'.$blog[0]['id'])?>">Otorgar permisos</a>

</div>
</div>