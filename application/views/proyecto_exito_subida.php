<div class="panel panel-default">
    	<div class="panel-heading"><h3>Su archivo fue exitosamente subido!</h3></div>
    	<div class="panel-body">
<h1>Si desea ponerlo en un articulo use la url: <?=base_url('Assets/subidas/'. $upload_data['orig_name'])?></h1>
 		<ul><h1>Datos del archivo:</h1>
 		<?php foreach($upload_data as $item => $value):?>
 		<li><h3><?=$item;?>: <?=$value;?></h3></li>
 		<?php endforeach; ?>
 		</ul>
 		<a class="btn btn-default" href="<?=site_url('proyecto_principal/subir')?>">Subir otro</a>
        </div>
        </div>