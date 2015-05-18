<div class="panel panel-default">
<div class="panel-heading"><h2>Otorgar permiso sobre el blog <?=$blog[0]['titulo']?></h2></div>
<div class="panel-body">

<form role="form" action="<?=site_url('proyecto_usuario/nuevoPermiso/' . $blog[0]['id'])?>" method="post">
  <div class="form-group">
    <label for="busca"><h3>Nombre del usuario: </h3></label>
    <input type="text" class="form-control"  id="busca" name="busca" ><?=form_error('busca')?>
  </div>
<input class="btn btn-default" type="submit" value="Buscar Usuario">
</div>
</div>