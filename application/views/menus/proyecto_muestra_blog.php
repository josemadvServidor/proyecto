
<div class="panel panel-default">
<div class="panel-heading"><h2><?=$titulo?>
</h2></div>
    	<div class="panel-body">
<?php
if ($this->session->userdata('dentro'))
{
	if($this->proyecto_modelo_blog->compAdmin($idblog,$this->session->userdata('id')) || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
    {
    	?>
    	<a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_principal/editaBlog/' . $idblog)?>">Editar el blog</a>
    	<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_principal/creaArticulo/'.$idblog)?>">Crear nuevo articulo</a>
    	<?php 
    }
}
		?>

<h3>Tema principal del blog: <?=$proposito?></h3>
<a name="fb_share" type="button" share_url=""></a> 
<?php 
if (count($articulos) > 0){
foreach ($articulos as $articulo)
{
	?>
	<div class="artic">
	
	<h2 ><span class="margenT"><?=$articulo['titulo']?></span></h2>
	<p class="margenT">Creado el <?=$articulo['fecha']?> <span > por el usuario <?=$articulo['idusucrea']?></span> </p><br>
	<p class="margenT"><?=$articulo['intro']?></p><br>
<span class="verArt"><a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_principal/muestraArticulo/'. $articulo['id'])?>">Leer mas</a>  </span>
<span class="verArtD"><a name="fb_share" type="button" share_url="<?=site_url('/proyecto_principal/muestraArticulo/'. $articulo['id'])?>"></a></span>
	
	</div>
	<?php 
}

}else{
	
?>

<p>El blog aun no posee articulos</p>


<?php 
}
?>
</div></div>
