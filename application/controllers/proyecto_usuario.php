<?php

class proyecto_usuario extends CI_Controller{



public function __construct(){
		
		parent::__construct();
		$this->load->model('proyecto_modelo_blog');
		$this->load->model('proyecto_modelo_usuario');
	
		
}


public function nuevoPermiso($idb)
{
	
	if ($this->session->userdata('dentro'))
	{
	
		if($this->proyecto_modelo_blog->compAdmin($idb,$this->session->userdata('id'))
				|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
		{
	
			$datos = array(
	
					"blog" => $this->proyecto_modelo_blog->devblog($idb)	
						
			);
	

			$this->form_validation->set_rules('busca', 'Buscar Nombre', 'required|callback_hayCoincidencias');
				
			$this->form_validation->set_message('hayCoincidencias', "No se han encontrado coincidencias para el nombre enviado");
				
			if ($this->form_validation->run()==false)
			{
			
			$this->load->view('plantilla/proyecto_encabezado');
			$this->load->view('plantilla/proyecto_cabecera');
			$this->load->view('formularios/proyecto_dar_permiso',$datos);
			$this->load->view('plantilla/proyecto_pie');
			
			}else{
			   
				
				$cadena = $this->input->post('busca');
			
				$usuarios = $this->proyecto_modelo_usuario->recogeParecidos($cadena);
			
				$datos = array(
							
						"usuarios" => $usuarios,
						"blog" => $this->proyecto_modelo_blog->devblog($idb),
						"cadena" =>$cadena
				);
			
				$this->load->view('plantilla/proyecto_encabezado');
				$this->load->view('plantilla/proyecto_cabecera');
				$this->load->view('menus/proyecto_muestra_coincidencias',$datos);
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

public function daPermiso($idusu, $idblog, $cadena)
{
	
	if ($this->proyecto_modelo_usuario->permiso_administracion($idusu, $idblog))
	{
		
		
			
		$usuarios = $this->proyecto_modelo_usuario->recogeParecidos($cadena);
			
		$datos = array(
					
				"usuarios" => $usuarios,
				"blog" => $this->proyecto_modelo_blog->devblog($idblog),
				"cadena" => $cadena
		);
			
		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('menus/proyecto_muestra_coincidencias',$datos);
		$this->load->view('plantilla/proyecto_pie');
		
		
	}else{
		
		echo "Ha ocurrido un problema durante la creacion del permiso";
		
	}
	
	
}

public function gestionPermisos($idb)
{
	
	
	if ($this->session->userdata('dentro'))
	{

	    if($this->proyecto_modelo_blog->compAdmin($idb,$this->session->userdata('id'))
				|| $this->proyecto_modelo_usuario->comp_administrador($this->session->userdata('id')))
		{
				
			$datos = array(
				
				"usuariosAdmin" => $this->proyecto_modelo_usuario->administran($idb),
				"blog" => $this->proyecto_modelo_blog->devblog($idb)	
					
			);
			
			
			
			$this->load->view('plantilla/proyecto_encabezado');
			$this->load->view('plantilla/proyecto_cabecera');
			$this->load->view('menus/proyecto_menu_gestion',$datos);
			$this->load->view('plantilla/proyecto_pie');
			
			
		}
	
	}else{
	
		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('errores/proyecto_no_sesion');
		$this->load->view('plantilla/proyecto_pie');
	
	
	}
	
}

public function hayCoincidencias($cadena)
{
	$usuarios = $this->proyecto_modelo_usuario->recogeParecidos($cadena);

	if (count($usuarios) > 0)
	{

		return true;
	}else{


		return false;

	}

}


	public function inicio_sesion()
	{
		
	$this->form_validation->set_rules('id', 'Id', 'required');
	$this->form_validation->set_rules('clave', 'Clave', 'required');
		
		if ($this->form_validation->run()==false)
		{
		
		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('formularios/proyecto_menu_inicio_sesion');
		$this->load->view('plantilla/proyecto_pie');
		
		}else{
		//	if (count($datosUs = $this->practica_modelo_usuarios->valida_usuario($this->input->post('nombre'), $this->input->post('clave'))) > 0)
			//$valida = $this->proyecto_modelo_usuario->valida_usuario($this->input->post('id'), $this->input->post('clave'));
			
			if ($this->proyecto_modelo_usuario->valida_usuario($this->input->post('id'), $this->input->post('clave')))
			{
				
				
				
				$this->session->set_userdata("id", $this->input->post('id'));
				$this->session->set_userdata("dentro", true);
				
				
		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('proyecto_exito_inicio_sesion');
		$this->load->view('plantilla/proyecto_pie');
				
			}else{
				
			$datos = array ("id" => $this->input->post('id'),
			                "clave" => $this->input->post('clave'));
			
		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('formularios/proyecto_menu_inicio_fallido', $datos);
		$this->load->view('plantilla/proyecto_pie');
				
			}
			
			
		}
		
		
	}


	public function modifica_datos()
	{
		
		
		$this->form_validation->set_rules('clave', 'Clave', 'required|matches[conf_clave]');
		$this->form_validation->set_rules('conf_clave', 'Confirmar clave', 'required');
		$this->form_validation->set_rules('nombre_r', 'Nombre real', 'required');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		
		
		if ($this->form_validation->run()==false)
		{
				
			$info = $this->proyecto_modelo_usuario->informacion_usu($this->session->userdata('id'));
			
			$datos = array("datos" => $info[0]);
			
			$this->load->view('plantilla/proyecto_encabezado');
			$this->load->view('plantilla/proyecto_cabecera');
			$this->load->view('formularios/proyecto_formulario_edita_usuario', $datos);
			$this->load->view('plantilla/proyecto_pie');
		
		}else{
				
		
			$clave = $this->input->post('clave');
			$nombreR= $this->input->post('nombre_r');
			$apellidos= $this->input->post('apellidos');
			$email = $this->input->post('email');
				
			if ( $this->proyecto_modelo_usuario->editaUsuario($this->session->userdata('id'),$clave, $nombreR, $apellidos, $email)== true)
			{
					
		
					
				$datos = array(
							
						"id" => $this->session->userdata('id'),
		
				);
					
		
				
					
				$this->load->view('plantilla/proyecto_encabezado');
				$this->load->view('plantilla/proyecto_cabecera');
				$this->load->view('proyecto_exito_edicion_usu', $datos);
				$this->load->view('plantilla/proyecto_pie');
					
					
			}else{
		
				$this->load->view('plantilla/proyecto_encabezado');
				$this->load->view('plantilla/proyecto_cabecera');
				$this->load->view('errores/proyecto_fallo_edicion_usu', $datos);
				$this->load->view('plantilla/proyecto_pie');
		
			}
		
		
		}
			
		
		
	}
	
	public function recupera_clave()
	{
		
		$this->form_validation->set_rules('id', 'Identificacion', 'required|callback_usado');
		
		$this->form_validation->set_message('usado', "El nombre de usuario que a indicado no existe");
		
		if ($this->form_validation->run()==false)
		{
				
			$this->load->view('plantilla/proyecto_encabezado');
			$this->load->view('plantilla/proyecto_cabecera');
			$this->load->view('formularios/proyecto_formulario_recup_clave');
			$this->load->view('plantilla/proyecto_pie');
		
			
			
		}else{
			
			
			$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
			$numerodeletras=10; //numero de letras para generar el texto
			$mensaje = ""; //variable para almacenar la cadena generada
			for($i=0;$i<$numerodeletras;$i++)
			{
			$mensaje .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres
			entre el rango 0 a Numero de letras que tiene la cadena */
			}
				
			$id = $this->input->post('id');
			
			$infoUs = $this->proyecto_modelo_usuario->informacion_usu($id);
				
			
			$email=$infoUs[0]['email'];
			
		   
			
			if ($this->proyecto_modelo_usuario->cambia_clave($id, $mensaje)){
		 
			$mensaje = "La nueva clave es " . $mensaje;
		
			
		
			
			$this->email->from('aula4@iessansebastian.com', 'Administrador');
			$this->email->to($email);
			$this->email->subject('Nueva Clave');
			$this->email->message($mensaje);
							
			if ($this->email->send())
			{
				$this->load->view('plantilla/proyecto_encabezado');
		     	$this->load->view('plantilla/proyecto_cabecera');
				$this->load->view('proyecto_nueva_clave_cor');
				$this->load->view('plantilla/proyecto_pie');
			
						}
						else
		                  	{
								echo "</pre>\n\n**** NO SE HA ENVIADO ****</pre>\n";
		                 	}
			
			
			}else {
				
				echo "Hubo problemas al actualizar la informacion de usuario";
				
			}
		}
		
	}
	
   
	public function noUsado($id)
	{
		
		return $this->proyecto_modelo_usuario->comp_usado($id);
		
	}
	 
	
	public function usado($id)
	{
	 if($this->proyecto_modelo_usuario->comp_usado($id))
	 {
		return false;
	 }else{
	 	
	 	return true;
	 }
	
	}
	
	public function creaUsuario()
	{

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|callback_noUsado');
		$this->form_validation->set_rules('clave', 'Clave', 'required|matches[conf_clave]');
		$this->form_validation->set_rules('conf_clave', 'Confirmar clave', 'required');
		$this->form_validation->set_rules('nombre_r', 'Nombre real', 'required');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		$this->form_validation->set_message('noUsado', "El nombre de usuario ya esta en uso");
		
		if ($this->form_validation->run()==false)
		{
			
		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('formularios/proyecto_formulario_crea_usuario');
		$this->load->view('plantilla/proyecto_pie');
		
		}else{
			
					$id= $this->input->post('nombre');
					$clave = $this->input->post('clave');
					$nombreR= $this->input->post('nombre_r');
					$apellidos= $this->input->post('apellidos');
					$email = $this->input->post('email');
					
					if ( $this->proyecto_modelo_usuario->creaUsuario($id, $clave, $nombreR, $apellidos, $email)== true)
					{
			
						
			
						$datos = array(
			
								"id" => $id,
								
			                           );
			
						
						$this->session->set_userdata("id", $id);
						$this->session->set_userdata("dentro", true);
			
						$this->load->view('plantilla/proyecto_encabezado');
						$this->load->view('plantilla/proyecto_cabecera');
						$this->load->view('proyecto_exito_crea_usu', $datos);
						$this->load->view('plantilla/proyecto_pie');
			
			
					}else{
						
						$this->load->view('plantilla/proyecto_encabezado');
						$this->load->view('plantilla/proyecto_cabecera');
						$this->load->view('errores/proyecto_fallo_crea_usu', $datos);
						$this->load->view('plantilla/proyecto_pie');
						
					}
						
						
				}
			
			
			
			
			
		


	}
	
	public function cierra_sesion()
	{
		$this->session->sess_destroy();
		

		$this->load->view('plantilla/proyecto_encabezado');
		$this->load->view('plantilla/proyecto_cabecera');
		$this->load->view('proyecto_cierre_sesion');
		$this->load->view('plantilla/proyecto_pie');
		
	}



}
