<?php
class Proyecto_principal extends CI_Controller{
	
	
	
public function __construct(){
		
		parent::__construct();
		
		
		
		//Cargamos los modelos
		$this->load->model('proyecto_modelo_blog');
		$this->load->model('proyecto_modelo_usuario');
	
		
}
	/**
	 * Acceso por defecto
	 */
	public function index(){
		
		
		//$blogs = $this->proyecto_modelo_blog->recogeUltimosBlog();
		
		
	    //Recogemos y guardamos los blogs que se mostaran en el menu de inicio
		$datos = array ("blogs" => $this->proyecto_modelo_blog->recogeUltimosBlog());
		
		
		
			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_menu_inicio',$datos, true)
 					]);
		
		
	}

     /**
	 * Aceso a creacion de blogs
	 */
   public function creablog()
   {
   	//Comprobamos que haya un usuario conectado
   	if ($this->session->userdata('dentro') == true)
   	{
   		
   		//Establecemos las reglas del formulario
   		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
   		$this->form_validation->set_rules('proposito', 'Proposito', 'required');
   		
   		if ($this->form_validation->run()==false)
   		{
   		
   		$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('formularios/proyecto_formulario_crea_blog',null,true)
 					]);
   		
   		
   		
   		}else{
   			
   			//Recogemos los campos del formulario
   			$titulo =$this->input->post('titulo');
   			$proposito =$this->input->post('proposito');
   			
   			//Creamos el blog
   			if ($this->proyecto_modelo_blog->creaBlog($this->session->userdata('id'), $titulo, $proposito, $this->session->userdata('id'), true))
   			{
   				
   				//Recogemos el blog una vez creado
   				$ultimo = $this->proyecto_modelo_blog->recogeUltimoBlog();
   				
   				//Alamcenamos la id del blog para enviarla la vista
   				$datos = array("id" => $ultimo[0]['id']);
   				
   				$this->load->view('plantilla/plantilla', [
   						'cuerpo'=>$this->load->view('proyecto_formulario_crea_blog_exito',$datos, true)
   						]);
   				 
   				
   				
   				
   			}else{
   				//Si no se inserta correctamente el blog lo notificamos
   				$this->load->view('plantilla/plantilla', [
   						'cuerpo'=>$this->load->view('errores/proyecto_formulario_crea_blog_fallo',null,true)
   						]);
   				
   				
   			}
   			
   		}
   		
   		
   	}else{
   		//Si no ahi un usuario conectado lo notificamos
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_sesion',null,true)
 					]);
   		
   		
   	}
   	
   	
   	
   }
   
   
  
   /**
    * Busca blogs y articulos basandose en una cadena de texto
    */
   public function buscaBlogs()
   {
   	//Cadena a comprobar
   	$cadena = $this->input->post('buscab');
   	
   	//Recoge los blogs y articulos con coincidencias
   	$blogs = $this->proyecto_modelo_blog->dev_blogs_coinciden($cadena);
   	$articulos = $this->proyecto_modelo_blog->dev_articulos_coinciden($cadena);
   	
   	//Los almacena para enviarlos a la vista
   	$datos = array (
   			
   			"blogs" => $blogs,
   			"articulos" => $articulos
   			
   	);
   	
  	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_muestra_coincidencias_blog', $datos, true)
 					]);
   	
   	
   }
   
   /**
    * Muestra un blog
    * @param int $id id del blog
    */
   public function muestraBlog($id)
   {
  
   	//Recogemos la informacin del blog
   	$blog = $this->proyecto_modelo_blog->devblog($id);
   	
   	//Almacenamos la informacion necesaria
   	$datos = array(
   		      'titulo'=>$blog[0]['titulo'],
   			  'articulos'=>$this->proyecto_modelo_blog->devarts($id),//Recogemos los articulos del blog
   	          'idblog'=>$blog[0]['id'],
   	          'proposito'=>$blog[0]['objetivo']);
   	
   	  	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_muestra_blog', $datos,true)
 					]);
   	
   	
   	
   }
   
   /**
    * Modifica la informacion de un blog
    * @param int $blog 
    */
   public function editaBlog($blog)
   {
   	
   	//Comprobamos si ahi un usuario conectado
   	if ($this->session->userdata('dentro'))
   	{
   		//Comprobamos si el usuario conecado tiene permisos sobre el blog 
   		//o si es un administrador de la aplicacion
   	   if($this->proyecto_modelo_blog->compAdmin($blog,$this->session->userdata('id'))
   	    || $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id'))){
   			
   	   	//Recogemos la informacion del blog y sus articulos
   	   	$blogInfo = $this->proyecto_modelo_blog->devblog($blog);
   	   	$articulos = $this->proyecto_modelo_blog->devArts($blog);
   	   	
   	   	//Almacenamos la informacion necesaria
   	   	$datos = array(
   	   			'titulo'=>$blogInfo[0]['titulo'],
   	   			'articulos'=>$articulos,
   	   			'idblog'=>$blogInfo[0]['id'],
   	   			'proposito'=>$blogInfo[0]['objetivo']);
   	   	
   	   	//Establecemos las normas de validacion
   	   	$this->form_validation->set_rules('titulo', 'Titulo', 'required');
   	   	$this->form_validation->set_rules('proposito', 'Proposito', 'required');
   	   	
   	   	
   	   	if ($this->form_validation->run()==false)
   	   	{
   	   	
   	   	  	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_muestra_blog_edicion', $datos,true)
 					]);
   	   	
   	   	
   	   	}else{
   	   		
   	   		//Recogemos los campos del formulario
   	   		$tit = $this->input->post('titulo');
   	   		$prop =$this->input->post('proposito');
   	   		
   	   		
   	   		if ($this->proyecto_modelo_blog->cambia_info_blog($tit, $prop, $blog)){
   	   		
   	   			//Si la modificacion se completa recogemos la informacion
   	   			// actualizada a mostrar
   	   			$blogInfo = $this->proyecto_modelo_blog->devblog($blog);
   	   			$articulos = $this->proyecto_modelo_blog->devArts($blog);
   	   			//Almacenamos la informacion
   	   			$datos = array(
   	   					'titulo'=>$blogInfo[0]['titulo'],
   	   					'articulos'=>$articulos,
   	   					'idblog'=>$blogInfo[0]['id'],
   	   					'proposito'=>$blogInfo[0]['objetivo']);
   	   			
   	   			
   	   			  	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>	$this->load->view('menus/proyecto_muestra_blog', $datos,true)
 					]);
   	   	
   	   	
   	   		
   	   		}
   	   		
   	   	}
   	   	
   		}else{
   			//Si el usuario no es valido lo notificamos
   				$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_valido',null,true)
 					]);
   			
   		}
   	
   	}else{
   		//Si no ahi usuarios conectados lo notificamos
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_sesion',null,true)
 					]);
   		
   		
   	}
   		
   	
   }
   
   /**
    * Edita un articulo
    * @param int $id id del articulo
    */
   public function edicionArticulo($id)
   {
   	//Recogemos la informacion del articulo
   	$articulo =  $this->proyecto_modelo_blog->rec_info_art($id);
   	//La almacenamos
   	$datos = array(
   				
   			"id" => $id,
   			"titulo" => $articulo[0]['titulo'],
   			"introduccion" => $articulo[0]['intro'],
   			"textoc" => $articulo[0]['textoc'],
   			"comentarios" => $this->proyecto_modelo_blog->recogeCont($id)
   	
   	);
   	
   	//Establecemos la normas de validacion
   	$this->form_validation->set_rules('titulo', 'Titulo', 'required');
   	$this->form_validation->set_rules('introduccion', 'Introduccion', 'required');
   	$this->form_validation->set_rules('textoc', 'Texto Completo', 'required');
   	 
   	if ($this->form_validation->run()==false)
   	{
   	
   	
     	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_edita_articulo', $datos,true)
 					]);
   	   	
  
   	
   	}else{
   		
   		//Recogemos los campos del formulario
   		$titulo =$this->input->post('titulo');
   		$introduccion =$this->input->post('introduccion');
   		$textoc =$this->input->post('textoc');
   		
   		//Realizamos la modificacion
   		if ($this->proyecto_modelo_blog->actualiza_info_art($id, $titulo, $introduccion, $textoc))
   		{
   			//Si sale bien almacenamos la id del articulo
   			$datos = array("id" => $id);
   			
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('proyecto_exito_act', $datos,true)
 					]);
   			
   			
   		}else{
   			
   			//Si sale mal lo notificamos
   				$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_fallo_act',null,true)
 					]);
   			
   			
   		}
   		
   	}
   	
   }
   
   /**
    * Eliina un comentario
    * @param int $id id del comentario
    * @param int $idart id del articulo al que pertenece el comentario
    */
   public function elimina_comentario($id,$idart)
   {
   	
   	//Eliminamos el comentario
   	if ($this->proyecto_modelo_blog->eliminaComentario($id))
   	{
   	
   		//Si se elimina con exito se envia a la vista el id del articulo 
   		//para permitir acceder a el mediante un link
   		$datos = array("id" => $idart);
   	
   		
   		
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('exito_edita_articulo', $datos,true)
 					]);
         	
   	
   	}
  	
   }
   
   /**
    * Muestra un articulo
    * @param int $id id del articulo
    */
   public function muestraArticulo($id)
   {
   	//Recogemos la informacion del articulo
   	$articulo =  $this->proyecto_modelo_blog->rec_info_art($id);
   	
   	//Almacenamos a informacion que s eenviara a la vista
   	$datos = array(
   				
   			"id" => $id,
   			"titulo" => $articulo[0]['titulo'],
   			"introduccion" => $articulo[0]['intro'],
   			"textoc" => $articulo[0]['textoc'],
   			"comentarios" => $this->proyecto_modelo_blog->recogeCont($id),
   	        "idb" =>$articulo[0]['idblog']
   	);
   	
   	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_muestra_articulo', $datos,true)
 					]);
   	
   	
   	
   }
   
   /**
    * Pide confirmacion para la aeliminacion de un articulo
    * @param unknown $id id del articulo
    */
   public function confirmaEliminaArticulo($id)
   {
   	//Comprueba que haya un usuario conectado
   	if ($this->session->userdata('dentro'))
   	{
   		
   		$articulo = $this->proyecto_modelo_blog->rec_info_art($id);
   		$articulo = $articulo[0];
   		
   		$blog = $this->proyecto_modelo_blog->devBlog($articulo['idblog']);
   		$blog = $blog[0];
   		
   		//Se asegura de que el usuario tenga permiso sobre el blog al que pertenece
   		//el articulo o de que sea un administrador
   		if($this->proyecto_modelo_blog->compAdmin($blog['id'],$this->session->userdata('id'))
   		|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
   		{
   	     
   			$datos= array(
   					"id" => $id
   			);
   			
   			   	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>	$this->load->view('menus/proyecto_seguridad_eliminacion',$datos,true)
 					]);
   		
   	
   		}else{
   	     
   			//Si no es un usuario valido lo notifica
   				$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_valido',null,true)
 					]);
   	
   		}
   	
   	}else{
   		 
   		//Si no ahi usuarios conectados lo notifica
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/sesion',null,true)
 					]);
   		 
   	}

   }
   
   /**
    * Elimina un articulo
    * @param int $id id del articulo
    */
   public function eliminaArticulo($id)
   {
   	//Comprueba que haya un usuario conectado
   	if ($this->session->userdata('dentro'))
   	{
   		 
   		$articulo = $this->proyecto_modelo_blog->rec_info_art($id);
   		$articulo = $articulo[0];
   		 
   		$blog = $this->proyecto_modelo_blog->devBlog($articulo['idblog']);
   		$blog = $blog[0];
   		 
   		//Se asegura de que el usuario tenga permiso sobre el blog al que pertenece
   		//el articulo o de que sea un administrador
   		if($this->proyecto_modelo_blog->compAdmin($blog['id'],$this->session->userdata('id'))
   		|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
   		{
   			 //Borra los comentarios del articulo
   			$this->proyecto_modelo_blog->borraComentarios($id);
   			
   			//Elimina el articulo
   			if ($this->proyecto_modelo_blog->eliminaArticulo($id)){
   				
   				
   			
   			   	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>	$this->load->view('proyecto_exito_eliminacion_art',null,true)
   			
 					]);
   			
   			
   			}
   	
   		}else{
   			//Si no es un usuario valido lo notifica
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_valido',null,true)
 					]);
   	
   		}
   	
   	}else{
   		//Si no ahi usuarios conectados lo notifica
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_sesion',null,true)
 					]);
   	
   	
   	}

   }
   
   /**
    * Crea un articulo
    * @param int $idblog id del blog al que pertenecera el articulo
    */
 public function creaArticulo($idblog)
 {
 	//Comprueba que haya un usuario conectado
 	if ($this->session->userdata('dentro') == true)
 	{
 		//Comprueba si el usuario tiene permisos de administracion sobre el blog
 		if ( $this->proyecto_modelo_blog->compAdmin($idblog,$this->session->userdata('id'))== true)
 		{
 		    $idb = array ("idb" => $idblog);
 			
 		    //Establecemos las normas de validacion
 			$this->form_validation->set_rules('introduccion', 'Introduccion', 'required');
 			$this->form_validation->set_rules('titulo', 'Titulo', 'required');
 			$this->form_validation->set_rules('textoc', 'Texto Completo', 'required');
 			 
 			if ($this->form_validation->run()==false)
 			{
 				 
 				 	$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>	$this->load->view('formularios/proyecto_formulario_crea_articulo', $idb,true)
   			
 					]);
 				
 				 
 				 
 			}else{
 				
 				//Recogemos los campos del formulario
 				$titulo= $this->input->post('titulo');
 				$intro = $this->input->post('introduccion');
 				$textoc= $this->input->post('textoc');
 				
 				//Creamos el articulo
 				if ( $this->proyecto_modelo_blog->creaArticulo($idblog, $this->session->userdata('id'), $intro,$titulo, $textoc)== true)
 				{
 					//Buscamos el articulo recien creado para mostrarlo
 					$ultimoArticulo =  $this->proyecto_modelo_blog->ultimoArt();
 					
 					$datos = array(
 						
 						"id" => $ultimoArticulo[0]['id'],
 						"titulo" => $titulo,
 						"introduccion" => $intro,
 						"textoc" => $textoc,
 						"comentarios" => $this->proyecto_modelo_blog->recogeCont($ultimoArticulo[0]['id']),
 						"idb" => $idblog
 					);
 					
 					
 					
 				
 					$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_muestra_articulo', $datos, TRUE)
 					]);
 					
 					
 				}
 				
 				
 			}
 	
 			}else{
 				 //Si el usuario no es valido lo notoficamos
 				 
 				
 				$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_valido',null,true)
 					]);
 				
 			
	 
 			}

 	}else{
   		//Si no ahi usuarios conectados lo notificamos
   		$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_sesion',null,true)
 					]);
   		
   		
   		
   	}
 }
 
 public function eliminaBlog($id)
 {
 	
 	if ($this->session->userdata('dentro'))
 	{
 		 
 
 		//Se asegura de que el usuario tenga permiso sobre el blog al que pertenece
 		//el articulo o de que sea un administrador
 		if($this->proyecto_modelo_blog->compAdmin($id,$this->session->userdata('id'))
 				|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
 		       {
 		       	
 		       	if($this->proyecto_modelo_blog->cambiaEstadoBlog($id))
 		       	{
 		       		$this->load->view('plantilla/plantilla', [
 		       				'cuerpo'=>$this->load->view('blog_eliminado',null,true)
 		       				]);
 		       		
 		       	}
 			
 			
 		       }else{
   	     
   			//Si no es un usuario valido lo notifica
   				$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/proyecto_no_valido',null,true)
 					]);
   	
   		}
   	
   	}else{
   		 
   		//Si no ahi usuarios conectados lo notifica
   			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('errores/sesion',null,true)
 					]);
   		 
   	}
 	
 }
 
 public function compruebaCaptcha($cadena)
 {
 	
 	if ($cadena == $this->session->userdata('captcha'))
 	{
 		return true;
 		
 	}else{
 		
 		return false;
 	}
 	
 }
 
 /**
  * Inreoduce un comentario
  * @param int $idart id del articulo en el que se comenta
  */
 public function introduce_comentario($idart)
 {
 	
 	$usuario ="";
 	
 	if ($this->session->userdata('dentro'))
 	{
 		//Si ahi usuarios conectados comentamos con el nombre de usuario
 		$usuario =$this->session->userdata('id');
 		
 	}else{
 		//Si no los ahi se comenta como anonimo
 		$usuario ="anonimo";
 		
 	}
 	
 	//Recogemos la informacion del articulo
 	$articulo =  $this->proyecto_modelo_blog->rec_info_art($idart);
 	
 	$datos = array(
 				
 			"id" => $idart,
 			"titulo" => $articulo[0]['titulo'],
 			"introduccion" => $articulo[0]['intro'],
 			"textoc" => $articulo[0]['textoc'],
 			"comentarios" => $this->proyecto_modelo_blog->recogeCont($idart),
 			"idb" =>$articulo[0]['idblog']
 	);
 
 	//Establecemos las normas de validacion
 	$this->form_validation->set_rules('comentario', 'Comentario', 'required');
 	$this->form_validation->set_rules('captcha', 'Texto del captcha', 'required|callback_compruebaCaptcha');
 		
 	$this->form_validation->set_message('compruebaCaptcha', "El texto enviado no coincide");
 	
 	if ($this->form_validation->run()==false)
 	{
 	
 			
 			
 			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_muestra_articulo', $datos, TRUE)
 					]);
 		
 		
 	
 	
 	}else{
 		
 		//Recogemos el campo del formulario
 		$texto =$this->input->post('comentario'); 
 		//Insertamos el comentario
 		if($this->proyecto_modelo_blog->inserta_comentario($idart, $texto,$usuario)){
 		
 		$datos = array(
 				
 			"id" => $idart,
 			"titulo" => $articulo[0]['titulo'],
 			"introduccion" => $articulo[0]['intro'],
 			"textoc" => $articulo[0]['textoc'],
 			"comentarios" => $this->proyecto_modelo_blog->recogeCont($idart),
 			"idb" =>$articulo[0]['idblog']
 	);
 	
 		
 			$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('menus/proyecto_muestra_articulo', $datos, TRUE)
 					]);
 		
 		}
 		
 	}

 }
 
	public function subir()
	{	
		$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('formularios/proyecto_formulario_imagen', null, TRUE)
 					]);
	}
	
 public function subirImg()
 {
 	
 	$config['upload_path'] = realpath(APPPATH.'/../Assets/subidas/');
 	$config['allowed_types'] = 'png|jpg|gif';
 	
 	
 	$this->load->library('upload', $config);
 	
 	
 	if ( ! $this->upload->do_upload('archivo'))
 	{
 		
 		$datos = array('error' => $this->upload->display_errors());
 			
 		$this->load->view('plantilla/plantilla', [
 							'cuerpo'=>$this->load->view('formularios/proyecto_formulario_imagen', $datos, TRUE)
 					]);
 	}
 	else
 	{
 		
 		$data = array('upload_data' => $this->upload->data());
 			
 		$this->load->view('plantilla/plantilla', [
 				'cuerpo'=>$this->load->view('proyecto_exito_subida', $data, TRUE)
 				]);
 		
 		
 	}
 }
   
   

}
