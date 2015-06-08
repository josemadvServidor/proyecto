<div class="panel panel-default">
<div class="panel-heading"><h2>Gestion de usuarios</h2></div>
<div class="panel-body">
<div  class="col-md-8">
<div class="table-responsive">
  <table class="table">
    <tr>
<th>Id</th>
<th>Fecha alta</th>
<th>Estado</th>
</tr>
<tr>
<?php foreach ($usuarios as $usuario){?>
<td>

<?=$usuario['id']?>
</td>
<td>
<?=$usuario['fecha_alta']?>
</td>

<td>
<?php 
if ($this->proyecto_modelo_usuario->comp_administrador($usuario['id']))
{
	?>
	<h3>Administrador</h3>
	<?php 
}elseif ($usuario['estado'])
{
	?>
	Activo
	<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/cambiaEstado/'.$usuario['id'])?>">Deshabilitar</a>
	<?php 
}
if (!$usuario['estado']){
?>	
Inactivo
<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/cambiaEstado/'.$usuario['id'])?>">Habilitar</a>
<?php 
}



?>
</td>
</tr>
<?php }?>

  </table>
</div>
</div>


</div>
</div>
