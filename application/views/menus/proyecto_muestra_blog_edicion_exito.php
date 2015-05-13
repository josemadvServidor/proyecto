<script type="text/javascript">

tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
       
    ]
});
</script>
<h1>Modo edicion</h1>
<h1>La modificacion de datos se realizo sin problemas</h1>
<p><a href="<?=site_url('/proyecto_principal/muestraBlog/'.$idblog)?>">Volver al modo normal</a></p>
<p><a href="<?=site_url('/proyecto_usuario/gestionPermisos/'.$idblog)?>">Gestionar permisos de administracion</a></p>
<form method="post" action="<?=site_url('proyecto_principal/editaBlog/'.$idblog)?>">
<p>Titulo: <?=form_input('titulo',$titulo)?></p>

<p>Tema principal del blog: <textarea name="proposito"><?=$proposito?></textarea></p>
<input type="submit" value="Cambiar datos">
</form>
<?php 
if (count($articulos) > 0){
foreach ($articulos as $articulo)
{
	?>
	<div class="artic">
	
	<h2 ><span class="margenT"><?=$articulo['titulo']?></span></h2>
	<p class="margenT">Creado el <?=$articulo['fecha']?> <span > por el usuario <?=$articulo['idusucrea']?></span> </p><br>
	<p class="margenT"><?=$articulo['intro']?></p><br>
<span class="verArt"><a  href="<?=site_url('proyecto_principal/muestraArticulo/'. $articulo['id'])?>">Ver el articulo completo</a>
<a  href="<?=site_url('proyecto_principal/edicionArticulo/'. $articulo['id'])?>">Editar el articulo</a>
<a  href="<?=site_url('proyecto_principal/confirmaEliminaArticulo/'. $articulo['id'])?>">Eliminar el articulo</a></span>
	
	</div>
	<?php 
	/*
	$contenidos = $this->proyecto_modelo_blog->recogeCont($articulo['id']);
	
	foreach ($contenidos as $contenido)
	{
		
		if ($contenido['tipo'] == "imagen")
		{
			?>
			<img WIDTH="50"  HEIGHT="50" src="<?=$contenido['texto']?>">
			<?php 
		}
		
		if ($contenido['tipo'] == "parrafo")
		{
			?>
			<p><?=$contenido['texto']?></p>
			<?php 
		}
		
		if ($contenido['tipo'] == "enlace")
		{
			?>
					<a href="<?=$contenido['texto']?>"><?=$contenido['texto']?></a>
					<?php 
		}
		
	}
	*/
}

}else{
	
?>

<p>El blog aun no posee articulos</p>


<?php 
}
?>


