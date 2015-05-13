<div>

<a href="<?=site_url('proyecto_principal/')?>">Pagina de inicio</a>
<?php if ($this->session->userdata('dentro') == false){?>
<a href="<?=site_url('proyecto_usuario/inicio_sesion')?>">Iniciar Sesion</a>
<a href="<?=site_url('proyecto_usuario/creaUsuario')?>">Registrarse</a>
<?php }else{?>
	
	<p>Usuario: <?=$this->session->userdata('id')?></p>
	<a href="<?=site_url('/proyecto_usuario/modifica_datos')?>">Modificar la informacion de usuario</a>
	<p><a href="<?=site_url('/proyecto_usuario/cierra_sesion')?>">Cerrar sesion</a></p>
    <p><a href="<?=site_url('/proyecto_principal/creablog')?>">Crear nuevo blog</a></p>
<?php 
    $blogs = $this->proyecto_modelo_blog->blogsUsu($this->session->userdata('id'));
 
    if (count($blogs) > 0)
    {
    	?><div class="guardablogs"><p>Blogs que administra:</p>
    	<?php
    	foreach ($blogs as $blog)
    	{
    		
    		$blogInf = $this->proyecto_modelo_blog->devblog($blog['idblog']);
    		
    		?>
    		
    		<a href="<?=site_url('/proyecto_principal/muestraBlog/' . $blogInf[0]['id'])?>"><?=$blogInf[0]['titulo']?></a>
    		<?php 
    	}
    	?>
    	</div>
    	<?php 
    }else{
?>    	

<p>Aun no administra ningun blog</p>
<?php 
    }

}?>
</div>