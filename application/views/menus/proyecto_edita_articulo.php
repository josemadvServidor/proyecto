

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


<div class="panel panel-default">
<div class="panel-heading"><h2>Formulario de edicion de articulos<a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_principal/muestraArticulo/'. $id)?>">Volver a modo normal</a></h2></div>
<div class="panel-body">




<form role="form" action="<?=site_url('proyecto_principal/edicionArticulo/'. $id)?>" method="post">
  <div class="form-group">
    <label for="titulo"><h3>Introduccion</h3></label>
    <input type="text" class="form-control"  id="introduccion" name="introduccion" value="<?=$introduccion?>"> <?=form_error('introduccion')?>
  </div>
  <div class="form-group">
    <label for="titulo"><h3>Titulo</h3></label>
    <input type="text" class="form-control"  id="titulo" name="titulo" value="<?=$titulo?>"> <?=form_error('titulo')?>
  </div>
  <div class="form-group">
    <label for="textoc"><h3>Texto Completo del articulo:</h3> </label>
    <textarea class="form-control" rows="4" name="textoc" id="textoc"><?=$textoc?></textarea><?=form_error('textoc')?>
  </div>
<input class="btn btn-default" type="submit" value="Guardar los cambios">
  </form>





</div>
<div class="panel-heading"><h2>Comentarios:</h2></div>
<div class="panel-body">

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

	<input type="text" class="form-control"  readonly="readonly"size="<?=$tam + 40?>"value="<?=$coment['texto']."\n Dejado por el usuario " . $usr . " en el " . $coment['fecha_c']?>"> 
	
	<?php if (!$this->proyecto_modelo_usuario->comp_administrador($coment['idusu'])){?>
	<br><a href="<?=site_url('proyecto_principal/elimina_comentario/'. $coment['id'] .'/'. $id)?>">Eliminar el comentario</a>
<?php }?>
	</div><br>
	<?php 
}

?></div>
</div>

