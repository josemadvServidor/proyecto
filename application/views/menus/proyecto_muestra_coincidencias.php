<div class="panel panel-default">
<div class="panel-heading"><h2>Ha habido <?=count($usuarios)?> coincidencias</h2></div>
<div class="panel-body">
<div  class="col-md-8">
<div class="table-responsive">
  <table class="table">
<tr>
<th>
<h2>Usuarios</h2>
</th>
<th>
<h2>Permisos</h2>
</th>
</tr>

<?php 
foreach ($usuarios as $usuario){
	?>
	<tr><td><?=$usuario['id']?></td><td>
	
	<?php 
	
	if ($this->proyecto_modelo_blog->compAdmin($blog[0]['id'],$usuario['id']))
	{
		
		echo "Ya posee un permiso de administracion para este blog";
	}else{
		
     ?>
     <a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_usuario/daPermiso/' . $usuario['id'] . '/' . $blog[0]['id'] . '/' . $cadena)?>">Dar permisos</a>
   <?php 
	}
	
	?>

	</td></tr>
	
	    <?php
}
?>

</table>
</div>
</div>
<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/nuevoPermiso/'.$blog[0]['id'])?>">Buscar mas</a>

</div>
</div>