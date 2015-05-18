<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a class="btn btn-primary btn-sm" href="<?=site_url('proyecto_principal/')?>">Inicio  <span class="glyphicon glyphicon-home"></span></a></li>
<?php if ($this->session->userdata('dentro') == false){?>

<?php }else{?>
	

<li><a class="btn btn-lg btn-default" href="<?=site_url('/proyecto_principal/creablog')?>">Crear nuevo blog</a></li>
<?php } ?>
</ul>
<ul class="nav navbar-nav navbar-right">

<form action="<?=site_url('proyecto_principal/buscaBlogs')?>" method="post">

<li><input class="form-control" placeholder="texto a buscar" type="text" name="buscab"></li>
<li><input class="btn btn-default" type="submit" value="Buscar"></li>

</form>
</ul>
</div>


<?php 
if ($this->session->userdata('dentro')){
    $blogs = $this->proyecto_modelo_blog->blogsUsu($this->session->userdata('id'));
 	?><div class="panel panel-default">
    	<div class="panel-heading"><h2>Blogs que administra:</h2></div>
    	<div class="panel-body"><?php 
    if (count($blogs) > 0)
    {
    	?>
    	
    
    <?php
    	foreach ($blogs as $blog)
    	{
    		
    		$blogInf = $this->proyecto_modelo_blog->devblog($blog['idblog']);
    		
    		?>
    		
    		<a  class="btn btn-primary btn-sm" href="<?=site_url('/proyecto_principal/muestraBlog/' . $blogInf[0]['id'])?>"><?=$blogInf[0]['titulo']?>  </a>
    		<?php 
    	}
    	?>
    	<?php 
    }else{
?>    	

<p>Aun no administra ningun blog</p>
<?php 
    }
    ?>
    </div>
    	</div>
    <?php 
    }
?>