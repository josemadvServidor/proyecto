<?php if (isset($error)) {var_dump($error);}?>
<div class="panel panel-default">
    	<div class="panel-heading"><h2>Formulario de subida de imagenes</h2></div>
    	<div class="panel-body">
<form role="form" action="<?=site_url('proyecto_principal/subirImg')?>" method="post" enctype="multipart/form-data">
<input class="form-control" type="file" name="archivo">
<input class="btn btn-default" type="submit" value="Subir">
</form>
</div></div>