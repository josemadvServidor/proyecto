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
<div class="panel-heading"><h2>Modo edicion:<?=$titulo?><?php
if ($this->session->userdata('dentro'))
{
	if($this->proyecto_modelo_blog->compAdmin($idblog,$this->session->userdata('id')) || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
    {
    	?>
    	
    	<a  class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_usuario/gestionPermisos/'.$idblog)?>">Gestionar permisos de administracion</a>
    	<a class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_principal/muestraBlog/'.$idblog)?>">Volver al modo visualizacion</a>
    	<?php 
    }
}
		?>
</h2></div>
    	<div class="panel-body">
    	
    	
    	
    	<form role="form"  action="<?=site_url('proyecto_principal/editaBlog/'.$idblog)?>" method="post">
  <div class="form-group">
    <label for="titulo"><h3>Titulo</h3></label>
    <input type="text" class="form-control"  id="titulo" name="titulo" value="<?=$titulo?>"> <?=form_error('titulo')?>
  </div>
  <div class="form-group">
    <label for="proposito"><h3>Proposito con el que se crea el blog:</h3></label>
    <textarea class="form-control" rows="4" name="proposito" id="proposito"><?=$proposito?></textarea><?=form_error('proposito')?>
  </div>
  <input type="submit" class="btn btn-default" value="Cambiar datos">
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
<span class="verArt"><a  class="btn btn-lg btn-default" href="<?=site_url('proyecto_principal/muestraArticulo/'. $articulo['id'])?>">Ver el articulo completo</a>
<a  class="btn btn-lg btn-default" href="<?=site_url('proyecto_principal/edicionArticulo/'. $articulo['id'])?>">Editar el articulo  <span class="glyphicon glyphicon-pencil"></span> </a>
<a class="btn btn-lg btn-default"  href="<?=site_url('proyecto_principal/confirmaEliminaArticulo/'. $articulo['id'])?>">Eliminar el articulo <span class="glyphicon glyphicon-trash"></span></a></span>
	
	</div>
	<?php 
}

}else{
	
?>

<p>El blog aun no posee articulos</p>


<?php 
}
?>
</div>
