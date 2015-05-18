<?php
class Proyecto_principal extends CI_Controller{
	

	
public function __construct(){
		
		parent::__construct();
		$this->load->model('proyecto_modelo_blog');
		$this->load->model('proyecto_modelo_usuario');
	
		
}
	
	public function index(){
		
		$blogs = $this->proyecto_modelo_blog->recogeUltimosBlog();
		
		
	
		$datos = array ("blogs" => $blogs);
		
		
		
		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('menus/proyecto_menu_inicio',$datos);
		$this->load->view('plantilla/proyecto_pie');
		
	}

   

   public function creablog()
   {
   	if ($this->session->userdata('dentro') == true)
   	{
   		
   		
   		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
   		$this->form_validation->set_rules('proposito', 'Proposito', 'required');
   		
   		if ($this->form_validation->run()==false)
   		{
   		
   		$this->load->view('plantilla/proyecto_encabezado');
   		$this->load->view('plantilla/proyecto_cabecera');
   		$this->load->view('formularios/proyecto_formulario_crea_blog');
   		$this->load->view('plantilla/proyecto_pie');
   		
   		
   		}else{
   			
   			
   			$titulo =$this->input->post('titulo');
   			$proposito =$this->input->post('proposito');
   			
   			if ($this->proyecto_modelo_blog->creaBlog($this->session->userdata('id'), $titulo, $proposito))
   			{
   				
   				$ultimo = $this->proyecto_modelo_blog->recogeUltimosBlog();
   				
   				
   				$datos = array("id" => $ultimo[0]['id']);
   				
   				
   				$this->load->view('plantilla/proyecto_encabezado');
   				$this->load->view('plantilla/proyecto_cabecera');
   				$this->load->view('proyecto_formulario_crea_blog_exito',$datos);
   				$this->load->view('plantilla/proyecto_pie');
   				
   			}else{
   				
   				$this->load->view('plantilla/proyecto_encabezado');
   				$this->load->view('plantilla/proyecto_cabecera');
   				$this->load->view('errores/proyecto_formulario_crea_blog_fallo');
   				$this->load->view('plantilla/proyecto_pie');
   				
   			}
   			
   		}
   		
   		
   	}else{
   		
   		$this->load->view('plantilla/proyecto_encabezado');
   		$this->load->view('plantilla/proyecto_cabecera');
   		$this->load->view('errores/proyecto_no_sesion');
   		$this->load->view('plantilla/proyecto_pie');
   		
   		
   	}
   	
   	
   	
   }
   
   
   public function captcha()
   {
   	
   	//
   	$captchaTextSize = 7;
   	do {
   		// Generamos un string aleatorio
   		$Hash = microtime( ) * mktime( );
   		// Eliminamos cualquier caracter extraño
   		preg_replace( '([1aeilou0])', "", $Hash );
   	} while( strlen( $Hash ) < $captchaTextSize );
   	// necesitamos sólo 7 caracteres para este captcha
   	$key = substr( $Hash, 0, $captchaTextSize );
   	// Guardamos la clave en la variable de sesión. La clave esta encriptada.
   	$this->session->set_userdata("captcha", $key);
   	
   	$captchaImage = imagecreatefrompng(site_url('../Assets/png/captcha.png'));
   	/*
   	 Seleccionamos un color de texto. Cómo nuestro fondo es un verde agua, escogeremos un cólor verde para el texto. El color del texto es, preferentemente, el mismo que el del background, aunque un poco más oscuro para poder distnguirlo.
   	*/
   	$textColor = imagecolorallocate( $captchaImage, 31, 118, 92 );
   	/*
   	 Seleccionamos un color para las líneas que queremos se dibujen en nuestro captcha. En este caso usaremos una mezcla entre verde y azul
   	*/
   	$lineColor = imagecolorallocate( $captchaImage, 15, 103, 103 );
   	
   	// recuperamos el parametro tamaño de imagen
   	$imageInfo = getimagesize( site_url('../Assets/png/captcha.png' ));
   	// decidimos cuantas líneas queremos dibujar
   	$linesToDraw = 10;
   	// Añadimos las líneas de manera aleatoria
   	for( $i = 0; $i < $linesToDraw; $i++ ) {
   		// utilizamos la función mt_rand()
   		$xStart = mt_rand( 0, $imageInfo[ 0 ] );
   		$xEnd = mt_rand( 0, $imageInfo[ 0 ] );
   		// Dibujamos la linea en el captcha
   		imageline( $captchaImage, $xStart, 0, $xEnd, $imageInfo[1], $lineColor );
   	}
   	/*
   	 Escribimos nuestro string aleatoriamente, utilizando una fuente true type. En este caso, estamos utilizando BitStream Vera Sans Bold, pero podemos utilizar cualquier otra.
   	*/
   	imagettftext( $captchaImage, 20, 0, 35, 35, $textColor, site_url('../Assets/ttf/A Charming Font Superexpanded.ttf'), $key );
   	/*
   	 Mostramos nuestra imagen. Preparamos las cabeceras de la imagen previniendo que no se almacenen en la cache del navegado
   	*/
   	header ( "Content-type: image/png" );
   	header("Cache-Control: no-cache, must-revalidate");

   	header("ragma: no-cache");
   	 
   	
   	imagepng($captchaImage);
   	 	 return imagepng($captchaImage);
   	 echo imagepng($captchaImage);
   	
   }
   
   public function buscaBlogs()
   {
   	
   	$cadena = $this->input->post('buscab');
   	
   	$blogs = $this->proyecto_modelo_blog->dev_blogs_coinciden($cadena);
   	$articulos = $this->proyecto_modelo_blog->dev_articulos_coinciden($cadena);
   	
   	
   	$datos = array (
   			
   			"blogs" => $blogs,
   			"articulos" => $articulos
   			
   	);
   	
   	$this->load->view('plantilla/proyecto_encabezado');
   	$this->load->view('plantilla/proyecto_cabecera');
   	$this->load->view('menus/proyecto_muestra_coincidencias_blog', $datos);
   	$this->load->view('plantilla/proyecto_pie');
   	
   }
   
   public function muestraBlog($id)
   {
   	$blog = $this->proyecto_modelo_blog->devblog($id);
    
   	$datos = array(
   		      'titulo'=>$blog[0]['titulo'],
   			  'articulos'=>$this->proyecto_modelo_blog->devarts($id),
   	          'idblog'=>$blog[0]['id'],
   	          'proposito'=>$blog[0]['objetivo']);
   	
   	$this->load->view('plantilla/proyecto_encabezado');
   	$this->load->view('plantilla/proyecto_cabecera');
   	$this->load->view('menus/proyecto_muestra_blog', $datos);
   	$this->load->view('plantilla/proyecto_pie');
   	
   	
   }
   
   public function editaBlog($blog)
   {
   	
   	if ($this->session->userdata('dentro'))
   	{
   	   if($this->proyecto_modelo_blog->compAdmin($blog,$this->session->userdata('id'))
   	    || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){
   			
   	   	$blogInfo = $this->proyecto_modelo_blog->devblog($blog);
   	   	$articulos = $this->proyecto_modelo_blog->devArts($blog);
   	   	
   	   	$datos = array(
   	   			'titulo'=>$blogInfo[0]['titulo'],
   	   			'articulos'=>$articulos,
   	   			'idblog'=>$blogInfo[0]['id'],
   	   			'proposito'=>$blogInfo[0]['objetivo']);
   	   	
   	   	
   	   	$this->form_validation->set_rules('titulo', 'Titulo', 'required');
   	   	$this->form_validation->set_rules('proposito', 'Proposito', 'required');
   	   	
   	   	
   	   	if ($this->form_validation->run()==false)
   	   	{
   	   	
   	   	$this->load->view('plantilla/proyecto_encabezado');
   	   	$this->load->view('plantilla/proyecto_cabecera');
   	   	$this->load->view('menus/proyecto_muestra_blog_edicion', $datos);
   	   	$this->load->view('plantilla/proyecto_pie');
   	   	
   	   	}else{
   	   		
   	   		
   	   		$tit = $this->input->post('titulo');
   	   		$prop =$this->input->post('proposito');
   	   		
   	   		if ($this->proyecto_modelo_blog->cambia_info_blog($tit, $prop, $blog)){
   	   		
   	   			
   	   			$blogInfo = $this->proyecto_modelo_blog->devblog($blog);
   	   			$articulos = $this->proyecto_modelo_blog->devArts($blog);
   	   			
   	   			$datos = array(
   	   					'titulo'=>$blogInfo[0]['titulo'],
   	   					'articulos'=>$articulos,
   	   					'idblog'=>$blogInfo[0]['id'],
   	   					'proposito'=>$blogInfo[0]['objetivo']);
   	   			
   	   			
   	   		$this->load->view('plantilla/proyecto_encabezado');
   	   		$this->load->view('plantilla/proyecto_cabecera');
   	   		$this->load->view('menus/proyecto_muestra_blog', $datos);
   	   		$this->load->view('plantilla/proyecto_pie');
   	   		
   	   		}
   	   		
   	   	}
   	   	
   		}else{
   			
   			$this->load->view('plantilla/encabezado');
   			$this->load->view('plantilla/cabecera');
   			$this->load->view('errores/no_valido');
   			$this->load->view('plantilla/pie');
   			
   		}
   	
   	}else{
   		
   		$this->load->view('plantilla/proyecto_encabezado');
   		$this->load->view('plantilla/proyecto_cabecera');
   		$this->load->view('errores/proyecto_no_sesion');
   		$this->load->view('plantilla/proyecto_pie');
   		
   		
   	}
   		
   	
   }
   
   
   public function edicionArticulo($id)
   {
   	$articulo =  $this->proyecto_modelo_blog->rec_info_art($id);
   	
   	$datos = array(
   				
   			"id" => $id,
   			"titulo" => $articulo[0]['titulo'],
   			"introduccion" => $articulo[0]['intro'],
   			"textoc" => $articulo[0]['textoc'],
   			"comentarios" => $this->proyecto_modelo_blog->recogeCont($id)
   	
   	);
   	
   	
   	$this->form_validation->set_rules('titulo', 'Titulo', 'required');
   	$this->form_validation->set_rules('introduccion', 'Introduccion', 'required');
   	$this->form_validation->set_rules('textoc', 'Texto Completo', 'required');
   	 
   	if ($this->form_validation->run()==false)
   	{
   	
   	
   	$this->load->view('plantilla/proyecto_encabezado');
   	$this->load->view('plantilla/proyecto_cabecera');
   	$this->load->view('menus/proyecto_edita_articulo', $datos);
   	$this->load->view('plantilla/proyecto_pie');
   	
   	}else{
   		
   		$titulo =$this->input->post('titulo');
   		$introduccion =$this->input->post('introduccion');
   		$textoc =$this->input->post('textoc');
   		
   		
   		
   		
   		if ($this->proyecto_modelo_blog->actualiza_info_art($id, $titulo, $introduccion, $textoc))
   		{
   			
   			$datos = array("id" => $id);
   			
   			$this->load->view('plantilla/proyecto_encabezado');
   			$this->load->view('plantilla/proyecto_cabecera');
   			$this->load->view('proyecto_exito_act', $datos);
   			$this->load->view('plantilla/proyecto_pie');
   			
   		}else{
   			
   			
   			$this->load->view('plantilla/proyecto_encabezado');
   			$this->load->view('plantilla/proyecto_cabecera');
   			$this->load->view('errores/proyecto_fallo_act');
   			$this->load->view('plantilla/proyecto_pie');
   			
   			
   		}
   		
   	}
   	
   }
   
   public function elimina_comentario($id,$idart)
   {
   	
   	if ($this->proyecto_modelo_blog->eliminaComentario($id))
   	{
   	
   		$datos = array("id" => $idart);
   	
   		
   		
   			$this->load->view('plantilla/proyecto_encabezado');
         	$this->load->view('plantilla/proyecto_cabecera');
         	$this->load->view('exito_edita_articulo', $datos);
        	$this->load->view('plantilla/proyecto_pie');
   	
   	}
   	
   	
   }
   
   public function muestraArticulo($id)
   {
   	
   	$articulo =  $this->proyecto_modelo_blog->rec_info_art($id);
   	
   	$datos = array(
   				
   			"id" => $id,
   			"titulo" => $articulo[0]['titulo'],
   			"introduccion" => $articulo[0]['intro'],
   			"textoc" => $articulo[0]['textoc'],
   			"comentarios" => $this->proyecto_modelo_blog->recogeCont($id),
   	        "idb" =>$articulo[0]['idblog']
   	);
   	
   	$this->load->view('plantilla/proyecto_encabezado');
   	$this->load->view('plantilla/proyecto_cabecera');
   	$this->load->view('menus/proyecto_muestra_articulo', $datos);
   	$this->load->view('plantilla/proyecto_pie');
   	
   	
   }
   
   public function confirmaEliminaArticulo($id)
   {
   	if ($this->session->userdata('dentro'))
   	{
   		
   		$articulo = $this->proyecto_modelo_blog->rec_info_art($id);
   		$articulo = $articulo[0];
   		
   		$blog = $this->proyecto_modelo_blog->devBlog($articulo['idblog']);
   		$blog = $blog[0];
   		
   		if($this->proyecto_modelo_blog->compAdmin($blog['id'],$this->session->userdata('id'))
   		|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
   		{
   	     
   			$datos= array(
   					"id" => $id
   			);
   			
   			$this->load->view('plantilla/proyecto_encabezado');
   			$this->load->view('plantilla/proyecto_cabecera');
   			$this->load->view('menus/proyecto_seguridad_eliminacion',$datos);
   			$this->load->view('plantilla/proyecto_pie');
   	
   	
   		}else{
   	
   			$this->load->view('plantilla/proyecto_encabezado');
   			$this->load->view('plantilla/proyecto_cabecera');
   			$this->load->view('errores/proyecto_no_valido');
   			$this->load->view('plantilla/proyecto_pie');
   	
   		}
   	
   	}else{
   		 
   		$this->load->view('plantilla/proyecto_encabezado');
   		$this->load->view('plantilla/proyecto_cabecera');
   		$this->load->view('errores/proyecto_no_sesion');
   		$this->load->view('plantilla/proyecto_pie');
   		 
   		 
   	}
   	
   	
   }
   
   public function eliminaArticulo($id)
   {
   	if ($this->session->userdata('dentro'))
   	{
   		 
   		$articulo = $this->proyecto_modelo_blog->rec_info_art($id);
   		$articulo = $articulo[0];
   		 
   		$blog = $this->proyecto_modelo_blog->devBlog($articulo['idblog']);
   		$blog = $blog[0];
   		 
   		if($this->proyecto_modelo_blog->compAdmin($blog['id'],$this->session->userdata('id'))
   		|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
   		{
   			 
   			$this->proyecto_modelo_blog->borraComentarios($id);
   			
   			if ($this->proyecto_modelo_blog->eliminaArticulo($id)){
   				
   				
   			
   			$this->load->view('plantilla/proyecto_encabezado');
   			$this->load->view('plantilla/proyecto_cabecera');
   			$this->load->view('proyecto_exito_eliminacion_art');
   			$this->load->view('plantilla/proyecto_pie');
   			
   			
   			}
   	
   		}else{
   	
   			$this->load->view('plantilla/proyecto_encabezado');
   			$this->load->view('plantilla/proyecto_cabecera');
   			$this->load->view('errores/proyecto_no_valido');
   			$this->load->view('plantilla/proyecto_pie');
   	
   		}
   	
   	}else{
   	
   		$this->load->view('plantilla/proyecto_encabezado');
   		$this->load->view('plantilla/proyecto_cabecera');
   		$this->load->view('errores/proyecto_no_sesion');
   		$this->load->view('plantilla/proyecto_pie');
   	
   	
   	}

   }
   
   
 public function creaArticulo($idblog)
 {
 	if ($this->session->userdata('dentro') == true)
 	{
 		if ( $this->proyecto_modelo_blog->compAdmin($idblog,$this->session->userdata('id'))== true)
 		{
 		    $idb = array ("idb" => $idblog);
 			
 			$this->form_validation->set_rules('introduccion', 'Introduccion', 'required');
 			$this->form_validation->set_rules('titulo', 'Titulo', 'required');
 			$this->form_validation->set_rules('textoc', 'Texto Completo', 'required');
 			 
 			if ($this->form_validation->run()==false)
 			{
 				 
 				$this->load->view('plantilla/proyecto_encabezado');
 				$this->load->view('plantilla/proyecto_cabecera');
 				$this->load->view('formularios/proyecto_formulario_crea_articulo', $idb);
 				$this->load->view('plantilla/proyecto_pie');
 				 
 				 
 			}else{
 				
 				$titulo= $this->input->post('titulo');
 				$intro = $this->input->post('introduccion');
 				$textoc= $this->input->post('textoc');
 				
 				if ( $this->proyecto_modelo_blog->creaArticulo($idblog, $this->session->userdata('id'), $intro,$titulo, $textoc)== true)
 				{
 					
 					$ultimoArticulo =  $this->proyecto_modelo_blog->ultimoArt();
 					
 					$datos = array(
 						
 						"id" => $ultimoArticulo[0]['id'],
 						"titulo" => $titulo,
 						"introduccion" => $intro,
 						"textoc" => $textoc,
 						"comentarios" => $this->proyecto_modelo_blog->recogeCont($ultimoArticulo[0]['id']),
 						"idb" => $idblog
 					);
 					
 					
 					$this->load->view('plantilla/proyecto_encabezado');
 					$this->load->view('plantilla/proyecto_cabecera');
 					$this->load->view('menus/proyecto_muestra_articulo', $datos);
 					$this->load->view('plantilla/proyecto_pie');
 					
 					
 				}
 				
 				
 			}
 	
 			}else{
 				 
 				$this->load->view('plantilla/proyecto_encabezado');
 				$this->load->view('plantilla/proyecto_cabecera');
 				$this->load->view('errores/proyecto_no_valido');
 				$this->load->view('plantilla/proyecto_pie');
	 
 			}

 	}else{
   		
   		$this->load->view('plantilla/proyecto_encabezado');
   		$this->load->view('plantilla/proyecto_cabecera');
   		$this->load->view('errores/proyecto_no_sesion');
   		$this->load->view('plantilla/proyecto_pie');
   		
   		
   	}
 	
 	
 	
 }
 
 public function introduce_comentario($idart)
 {
 	$usuario ="";
 	
 	if ($this->session->userdata('dentro'))
 	{
 		$usuario =$this->session->userdata('id');
 		
 	}else{
 		
 		$usuario ="anonimo";
 		
 	}
 	
 	$articulo =  $this->proyecto_modelo_blog->rec_info_art($idart);
 	
 	
 	
 	$datos = array(
 				
 			"id" => $idart,
 			"titulo" => $articulo[0]['titulo'],
 			"introduccion" => $articulo[0]['intro'],
 			"textoc" => $articulo[0]['textoc'],
 			"comentarios" => $this->proyecto_modelo_blog->recogeCont($idart),
 			"idb" =>$articulo[0]['idblog']
 	);
 
 	
 	

 	
 	$this->form_validation->set_rules('comentario', 'Comentario', 'required');
 	
 		
 	if ($this->form_validation->run()==false)
 	{
 	
 			
 			
 		$this->load->view('plantilla/proyecto_encabezado');
 		$this->load->view('plantilla/proyecto_cabecera');
 		$this->load->view('menus/proyecto_muestra_articulo', $datos);
 		$this->load->view('plantilla/proyecto_pie');
 	
 	
 	}else{
 		
 		
 		$texto =$this->input->post('comentario'); 
 		
 		
 		
 		if($this->proyecto_modelo_blog->inserta_comentario($idart, $texto,$usuario)){
 		
 		$datos = array(
 				
 			"id" => $idart,
 			"titulo" => $articulo[0]['titulo'],
 			"introduccion" => $articulo[0]['intro'],
 			"textoc" => $articulo[0]['textoc'],
 			"comentarios" => $this->proyecto_modelo_blog->recogeCont($idart),
 			"idb" =>$articulo[0]['idblog']
 	);
 	
 		
 		$this->load->view('plantilla/proyecto_encabezado');
 		$this->load->view('plantilla/proyecto_cabecera');
 		$this->load->view('menus/proyecto_muestra_articulo', $datos);
 		$this->load->view('plantilla/proyecto_pie');
 		
 		}
 		
 	}
 	
 	
 	
 }
 
   
   

}
