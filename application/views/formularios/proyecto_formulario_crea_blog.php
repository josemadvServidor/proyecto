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

<h1>Formulario creacion de blogs</h1>
<form action="<?=site_url('/proyecto_principal/creablog')?>" method="post">

Titulo <?=form_input("titulo")?> <?=form_error('titulo')?><br>

Proposito con el que crea el blog:<br>
<textarea rows="10" cols="70" name="proposito"></textarea><?=form_error('proposito')?>
<br>
<input type="submit" value="Enviar">
</form><br>


