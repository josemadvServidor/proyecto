
<div class="panel panel-default">
    	<div class="panel-heading"><h2>Formulario de creacion de usuarios</h2></div>
    	<div class="panel-body">
<form role="form"  action="<?=site_url('proyecto_usuario/creaUsuario')?>" method="post">
  <div class="form-group">
    <label for="nombre"><h3>Nombre de usuario:</h3></label>
    <input type="text" class="form-control"  id="nombre" name="nombre" value="<?php if ($_POST){echo $_POST['nombre'];}?>"> <?=form_error('nombre')?>
  </div>
  
   <div class="form-group">
    <label for="clave"><h3>Clave:</h3></label>
    <input type="password" class="form-control"  id="clave" name="clave" value="<?php if ($_POST){echo $_POST['clave'];}?>"> <?=form_error('clave')?>
  </div>
  
    <div class="form-group">
    <label for="conf_clave"><h3>Confirma clave:</h3></label>
    <input type="password" class="form-control"  id="conf_clave" name="conf_clave" value=""> <?=form_error('conf_clave')?>
  </div>
  
      <div class="form-group">
    <label for="nombre_r"><h3>Nombre Real:</h3></label>
    <input type="text" class="form-control"  id="nombre_r" name="nombre_r" value="<?php if ($_POST){echo $_POST['nombre_r'];}?>"> <?=form_error('nombre_r')?>
  </div>
  
     <div class="form-group">
    <label for="apellidos"><h3>Apellidos:</h3></label>
    <input type="text" class="form-control"  id="apellidos" name="apellidos" value="<?php if ($_POST){echo $_POST['apellidos'];}?>"> <?=form_error('apellidos')?>
  </div>
  
      <div class="form-group">
    <label for="email"><h3>Email:</h3></label>
    <input type="text" class="form-control"  id="email" name="email" value="<?php if ($_POST){echo $_POST['email'];}?>"> <?=form_error('email')?>
  </div>
  
  
  <input type="submit" class="btn btn-default" value="Crear Usuario">
  </form>
  </div></div>