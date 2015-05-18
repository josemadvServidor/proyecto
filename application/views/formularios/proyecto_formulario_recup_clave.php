<div class="panel panel-default">
    	<div class="panel-heading"><h2>Solicitud de identificacion:</h2></div>
    	<div class="panel-body">

<form role="form" action="<?=site_url('proyecto_usuario/recupera_clave')?>" method="post">
  <div class="form-group">
    <label for="nombre"><h3>Nombre de usuario:</h3></label>
    <input type="text" class="form-control"  id="nombre" name="nombre" value="<?php if ($_POST){echo $_POST['nombre'];}?>"> <?=form_error('nombre')?>
  </div>
<input class="btn btn-default" type="submit" value="Enviar clave nueva a mi email">
</form>

</div></div>

