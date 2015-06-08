

<div class="panel panel-default">
<div class="panel-heading"><h2><?=$titulo?></h2>

<a name="fb_share" type="button" share_url=""></a> </div>

    	<div class="panel-body">

<?php 

if ($this->session->userdata('dentro'))
{
	
	if($this->proyecto_modelo_blog->compCreadorArt($id,$this->session->userdata('id')) || 
	   $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){
		?>
	<a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_principal/edicionArticulo/' . $id)?>">Editar el articulo</a>
	<?php } 
	}
?>
<h2><?=$introduccion?></h2>
<div class="row">
 <div class="col-xs-12 col-md-8 textoart" >
 
<?=$textoc?>

 </div>
 </div>
</div>
<div class="panel-heading"><h2>Comentarios:</h2></div>
<div class="panel-body">
<h3>Introduzca un comentario:</h3>
<form method="post" action="<?=site_url('proyecto_principal/introduce_comentario/'. $id)?>">

<textarea class="form-control" rows="3" name="comentario"></textarea>
<br>
<img src="<?=site_url('/proyecto_controlador_captcha/captcha')?>" border="0" />
<br>
  <input type="text" name="captcha" width="25" value="" /><?=form_error('captcha')?>
<br><input class="btn btn-default btn-xs" type="submit" name="Enviar" value="Publicar comentario">
</form>
<?php 


foreach ($comentarios as $coment)
{
?>
<div>

	<textarea class="form-control" rows="3"  readonly="readonly">
	<?=$coment['texto']."\n Dejado por el usuario " . $coment['idusu']?>
<?php 
if ($this->proyecto_modelo_usuario->comp_administrador($coment['idusu']))
{
		
	echo"(administrador) ";
		
}
?>
	<?=" en el " . $coment['fecha_c']?>
	</textarea>
</div>
	<?php 
}

?></div>
</div>
