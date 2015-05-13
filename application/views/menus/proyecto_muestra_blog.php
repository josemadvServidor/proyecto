<h1><?=$titulo?></h1>

<?php 

if ($this->session->userdata('dentro'))
{
	if($this->proyecto_modelo_blog->compAdmin($idblog,$this->session->userdata('id'))){
		?>
	<p><a href="<?=site_url('proyecto_principal/editaBlog/' . $idblog)?>">Pasar a modo edicion</a></p>
	<p><a href="<?=site_url('/proyecto_principal/creaArticulo/'.$idblog)?>">Crear nuevo articulo</a></p>

	<?php 
	}else if ($this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
	{
		?>
		<p><a href="<?=site_url('proyecto_principal/editaBlog/' . $idblog)?>">Pasar a modo edicion</a></p>
	<?php 
	} 
	}

?>

<p>Tema principal del blog: <?=$proposito?></p>
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
<span class="verArt"><a  href="<?=site_url('proyecto_principal/muestraArticulo/'. $articulo['id'])?>">Ver el articulo completo</a>  </span>
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
