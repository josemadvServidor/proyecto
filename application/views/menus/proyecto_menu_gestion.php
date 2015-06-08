<div class="panel panel-default">
<div class="panel-heading"><h2>Gestion de usuarios administradores del blog <?=$blog[0]['titulo']?></h2></div>
<div class="panel-body">
<div  class="col-md-8">
<div class="table-responsive">
  <table class="table">
    <tr>
<th>Administradores</th>
<th>Permisos</th>
</tr>
<tr>
<?php foreach ($usuariosAdmin as $usuario){?>
<td>

<?=$usuario['idusu']?>
</td>
<td>
<?php 
if ($this->proyecto_modelo_blog->compCreador($this->session->userdata('id'), $blog[0]['id']) 
|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
{
	
	if (!$this->proyecto_modelo_blog->compCreador($usuario['idusu'],$blog[0]['id']))
	{
		?>
		<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/retiraPermiso/'.$blog[0]['id'] . '/' .$usuario['idusu'] )?>" >Retirar permisos</a>
		<?php 
	}else{
		?>
		<h3>Creador</h3>
		<?php 

	}
	
}
?>
</td></tr>
<?php }?>

  </table>
</div>
</div>
<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/nuevoPermiso/'.$blog[0]['id'])?>">Otorgar permisos</a>

</div>
</div>