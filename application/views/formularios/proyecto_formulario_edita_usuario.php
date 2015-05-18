<div class="panel panel-default">
    	<div class="panel-heading"><h2>Formulario de edicion de datos de usuario</h2></div>
    	<div class="panel-body">
<form role="form"  action="<?=site_url('proyecto_usuario/modifica_datos')?>" method="post">
  <div class="form-group">
    <label for="nombre"><h3>Nombre de usuario:</h3></label>
    <input type="text" class="form-control"  id="nombre" name="nombre" value="<?=$datos['id']?>"> <?=form_error('nombre')?>
  </div>
  
   <div class="form-group">
    <label for="clave"><h3>Clave:</h3></label>
    <input type="text" class="form-control"  id="clave" name="clave" value="<?=$datos['clave']?>"> <?=form_error('clave')?>
  </div>
  
    <div class="form-group">
    <label for="conf_clave"><h3>Confirma clave:</h3></label>
    <input type="text" class="form-control"  id="conf_clave" name="conf_clave" value="<?=$datos['clave']?>"> <?=form_error('conf_clave')?>
  </div>
  
      <div class="form-group">
    <label for="nombre_r"><h3>Nombre Real:</h3></label>
    <input type="text" class="form-control"  id="nombre_r" name="nombre_r" value="<?=$datos['nombre_real']?>"> <?=form_error('nombre_r')?>
  </div>
  
     <div class="form-group">
    <label for="apellidos"><h3>Apellidos:</h3></label>
    <input type="text" class="form-control"  id="apellidos" name="apellidos" value="<?=$datos['apellidos']?>"> <?=form_error('apellidos')?>
  </div>
  
      <div class="form-group">
    <label for="email"><h3>Email:</h3></label>
    <input type="text" class="form-control"  id="email" name="email" value="<?=$datos['email']?>"> <?=form_error('email')?>
  </div>
  
  
  <input type="submit" class="btn btn-default" value="Cambiar datos">
  </form>
  </div></div>