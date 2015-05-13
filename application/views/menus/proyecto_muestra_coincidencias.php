<h1>Ha habido <?=count($usuarios)?> coincidencias</h1>

<table>
<tr>
<th>
Usuarios
</th>
</tr>

<?php 
foreach ($usuarios as $usuario){
	?>
	<tr><td><?=$usuario['id']?></td><td>
	
	<?php 
	
	if ($this->proyecto_modelo_blog->compAdmin($blog[0]['id'],$usuario['id']))
	{
		
		echo "Ya posee un permiso de administracion";
	}else{
		
     ?>
     <a href="<?=site_url('proyecto_usuario/daPermiso/' . $usuario['id'] . '/' . $blog[0]['id'] . '/' . $cadena)?>">Dar permisos</a>
   <?php 
	}
	
	?>

	</td></tr>
	
	    <?php
}
?>

</table>