



	<div class="panel panel-default">
    	<div class="panel-heading"><h2>Inicio de sesion</h2><a class="btn btn-default" href="<?=site_url('/proyecto_usuario/creaUsuario')?>">Nuevo usuario</a>
<a class="btn btn-default" href="<?=site_url('/proyecto_usuario/recupera_clave')?>">He olvidado mi clave</a></div>
    	<div class="panel-body">
    	<div class="alert alert-danger"><h2>Error: Combinacion invalida de nombre de usuario y clave. Puede que su cuenta haya quedado inhabilitada</h2>
		<form class="form-horizontal" role="form" action="<?=site_url('/proyecto_usuario/inicio_sesion')?>" method="post">
 
   		
    <div class="form-group ">
    <label for="idUsu"><h3>Nombre de usuario:</h3></label>
    <input type="text" class="form-control"  id="idUsu" value="<?=$id?>" name="id" "> <?=form_error('id')?>
  </div>
    	 
    <div class="form-group">
    <label for="claveusu"><h3>Clave:</h3></label>
    <input type="password" class="form-control"  id="claveusu"  value="<?=$clave?>" name="clave" "> <?=form_error('clave')?>
  </div>
 </div>
   		
    
   
 
   		 <input type="submit" class="btn btn-default"> 
    
</form>


</div></div>