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
    	<div class="panel-heading"><h2>Formulario creacion de blogs</h2></div>
    	<div class="panel-body">
<form role="form" action="<?=site_url('/proyecto_principal/creablog')?>" method="post">
  <div class="form-group">
    <label for="titulo"><h3>Titulo</h3></label>
    <input type="text" class="form-control"  id="titulo" name="titulo" value="<?php if ($_POST){echo $_POST['titulo'];}?>"> <?=form_error('titulo')?>
  </div>
  <div class="form-group">
    <label for="proposito"><h3>Proposito con el que se crea el blog</h3></label>
    <textarea class="form-control" rows="4" name="proposito" id="proposito"><?php if ($_POST){echo $_POST['proposito'];}?></textarea><?=form_error('proposito')?>
  </div>
  <input type="submit" class="btn btn-default" value="Crear el blog">
  </form>
  </div></div>