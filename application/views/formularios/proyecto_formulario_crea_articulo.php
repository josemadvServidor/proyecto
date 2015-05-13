<h1>Formulario de creacion de articulos</h1>

<form action="<?=site_url('/proyecto_principal/creaArticulo/' . $idb)?>" method="post">

Introduccion: <?=form_input("introduccion")?> <?=form_error('introduccion')?><br>
Titulo: <?=form_input("titulo")?> <?=form_error('titulo')?><br>
Texto Completo del articulo: 
<script type="text/javascript">

tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
       
    ]
});
</script>
 <textarea rows="10" cols="50" name="textoc"></textarea><span class="rojo"><?=form_error('textoc')?></span><br><br>
<input type="submit" value="Enviar">
</form><br>
