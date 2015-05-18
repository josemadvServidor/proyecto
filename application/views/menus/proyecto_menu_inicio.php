
<div class="panel panel-default">
<div class="panel-heading"><h2>Ultimos blogs que han aparecido:</h2></div>
    	<div class="panel-body">

<div class="container show-top-margin separate-rows tall-rows">
<?php 
foreach ($blogs as $blog)
{
	?>
	
	<div class="col-xs-12 col-md-8">
	<h2><?=$blog['titulo']?></h2>
	</div>
	<div class="col-xs-12 col-md-8">
	<p>Creado el <?=$blog['fecha_c']?></p>
	</div>
	<div class="col-xs-12 col-md-8">
	<p>Descripcion: <?=$blog['objetivo']?></p>
	</div>
	<div class="col-xs-12 col-md-8">
	<a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_principal/muestraBlog/' . $blog['id'])?>">Ver el blog</a>

	<?php 
	if ($this->session->userdata('dentro'))
	{
		if($this->proyecto_modelo_blog->compAdmin($blog['id'],$this->session->userdata('id')) || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){
	?>
	<div class="col-xs-12 col-md-8">
	<a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_principal/editaBlog/' . $blog['id'])?>">Entrar en modo edicion</a>
	</div><?php } ?>
	
	 <?php
	}
	?>
	</div>
<?php }?>
</div>

</div>
    	</div>

