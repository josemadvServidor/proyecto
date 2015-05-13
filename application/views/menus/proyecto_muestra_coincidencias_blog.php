<h1>Resultados de la busqueda</h1>
<h3>Resultados de blogs: </h3>
<?php
if (count($blogs > 0)){
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
<?php }
}else{
	
	?>
	<p>No ha habido blogs entre los resultados.</p>
	<?php 
	
}?>

<h3>Resultados de articulos:</h3>
<?php 
if (count($articulos) > 0){
foreach ($articulos as $articulo)
{
	?>
	<div class="artic">
	<h2><?=$articulo['titulo']?></h2>
	<p>Creado el <?=$articulo['fecha']?></p>
	<p><a href="<?=site_url('proyecto_principal/muestraArticulo/' . $articulo['id'])?>">Ver el blog</a>
	<?php 
	if ($this->session->userdata('dentro'))
	{
		if($this->proyecto_modelo_blog->compAdmin($articulo['idblog'],$this->session->userdata('id')) || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){
	?>
	<a href="<?=site_url('proyecto_principal/editaArticulo/' . $articulo['id'])?>">Entrar en modo edicion</a>
	<?php } ?></p>
	
	 <?php
	}
	?>
	</div>
<?php }
  }else{
       	?>
       		<p>No ha habido articulos entre los resultados.</p>
<?php 
       }?>