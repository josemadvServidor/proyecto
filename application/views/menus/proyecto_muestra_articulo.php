<?php 

if ($this->session->userdata('dentro'))
{
	
	if($this->proyecto_modelo_blog->compAdmin($idb,$this->session->userdata('id')) || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){
		?>
	<p><a href="<?=site_url('proyecto_principal/edicionArticulo/' . $id)?>">Pasar a modo edicion</a></p>
	<?php } 
	}
?>
<h1><?=$titulo?></h1>
<h2><?=$introduccion?></h2>
<a name="fb_share" type="button" share_url=""></a> 

<?=$textoc?>
<br>
<br>
<h2>Comentarios:</h2>
<br>
<br>
Introduzca un comentario:<br>
<form method="post" action="<?=site_url('proyecto_principal/introduce_comentario/'. $id)?>">

<textarea rows="10" cols="50" name="comentario"></textarea>
<br>
<img src="<?=site_url('../Assets/png/captcha.png')?>" border="0" />
<br>
  <input type="text" name="code" width="25" />
<br><input type="submit" name="Enviar" value="Publicar comentario">
</form>

<?php 
foreach ($comentarios as $coment)
{
?>
<div>

	<textarea rows="10" cols="50"  readonly="readonly">
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
/*
foreach ($contenidos as $cont)
{
	
	if ($contenido['tipo'] == "imagen")
	{
		?>
				<img WIDTH="50"  HEIGHT="50" src="<?=$contenido['texto']?>">
				<?php 
			}
			
			if ($contenido['tipo'] == "parrafo")
			{
				?>
				<p><?=$contenido['texto']?></p>
				<?php 
			}
			
			if ($contenido['tipo'] == "enlace")
			{
				?>
						<a href="<?=$contenido['texto']?>"><?=$contenido['texto']?></a>
						<?php 
			}
			
	
}
*/
?>