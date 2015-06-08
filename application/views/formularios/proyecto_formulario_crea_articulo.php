

<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});

function abreSubida()
{

window.open('<?=site_url('proyecto_principal/subir')?>');
	
}
</script>
<div class="panel panel-default">
    	<div class="panel-heading"><h2>Formulario de creacion de articulos</h2></div>
    	<div class="panel-body">
    	<a class="btn btn-primary btn-sm" onclick="abreSubida()">Subir una imagen</a>
<form role="form" action="<?=site_url('/proyecto_principal/creaArticulo/' . $idb)?>" method="post">
  
   <div class="form-group">
    <label for="titulo"><h3>Titulo</h3></label>
    <input type="text" class="form-control"  id="titulo" name="titulo"  placeholder="Titulo del articulo" value="<?php if ($_POST){echo $_POST['titulo'];}?>"> <?=form_error('titulo')?>
  </div>
  
  <div class="form-group">
    <label for="titulo"><h3>Introduccion</h3></label>
    <input type="text" class="form-control"  id="introduccion" name="introduccion"  placeholder="Texto que se mostrara junto al titulo del articulo antes de acceder a el" value="<?php if ($_POST){echo $_POST['introduccion'];}?>"> <?=form_error('introduccion')?>
  </div>
 
  <div class="form-group">
    <label for="textoc"><h3>Texto Completo del articulo:</h3> </label>
    <textarea class="form-control" rows="4" name="textoc" id="textoc"><?php if ($_POST){echo $_POST['textoc'];}?></textarea><?=form_error('textoc')?>
  </div>
  <input type="submit" class="btn btn-default" value="Guardar el articulo">
  </form>
  </div></div>