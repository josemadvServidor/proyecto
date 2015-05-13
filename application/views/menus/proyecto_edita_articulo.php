<a href="<?=site_url('proyecto_principal/muestraArticulo/'. $id)?>">Volver a modo normal</a>
<br>
<h1>Formulario de edicion de articulos</h1>

<form method="post" action="<?=site_url('proyecto_principal/edicionArticulo/'. $id)?>">
<p>Titulo <input type="text" value="<?=$titulo?>" name="titulo"></p>
<p>Introduccion <input type="text" value="<?=$introduccion?>" name="introduccion"></p>
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
<textarea rows="10" cols="50" name="textoc">
<?=$textoc?>
</textarea><br>
<input type="submit" value="Guardar los cambios">
</form>
<br>
<br>
<h2>Comentarios:</h2>
<br>
<br>
<script type="text/javascript">


</script>
<?php 
foreach ($comentarios as $coment)
{
	$tam = strlen($coment['texto']);
	
?>
<div>
<?php 



if ($this->proyecto_modelo_usuario->comp_administrador($coment['idusu']))
{
		
	$usr = $coment['idusu'] . "(administrador) ";
		
}else{
	
	$usr = $coment['idusu'];
	
}
?>

	<input type="text" readonly="readonly"size="<?=$tam + 40?>"value="<?=$coment['texto']."\n Dejado por el usuario " . $usr . " en el " . $coment['fecha_c']?>"> 
	
	<?php if (!$this->proyecto_modelo_usuario->comp_administrador($coment['idusu'])){?>
	<br><a href="<?=site_url('proyecto_principal/elimina_comentario/'. $coment['id'] .'/'. $id)?>">Eliminar el comentario</a>
<?php }?>
	</div><br>
	<?php 
}

?>
