<form action="<?=site_url('proyecto_principal/buscaBlogs')?>" method="post">

Buscar: <input type="text" name="buscab"><br>
<input type="submit" value="Buscar">
</form>
<p>Ultimos blogs que han aparecido: </p>
<?php 
foreach ($blogs as $blog)
{
	?>
	<div class="artic">
	<h2><?=$blog['titulo']?></h2>
	<p>Creado el <?=$blog['fecha_c']?></p>
	<p>Descripcion: <?=$blog['objetivo']?></p>
	<p><a href="<?=site_url('proyecto_principal/muestraBlog/' . $blog['id'])?>">Ver el blog</a>
	<?php 
	if ($this->session->userdata('dentro'))
	{
		if($this->proyecto_modelo_blog->compAdmin($blog['id'],$this->session->userdata('id')) || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){
	?>
	<a href="<?=site_url('proyecto_principal/editaBlog/' . $blog['id'])?>">Entrar en modo edicion</a>
	<?php } ?></p>
	
	 <?php
	}
	?>
	</div>
<?php }?>



