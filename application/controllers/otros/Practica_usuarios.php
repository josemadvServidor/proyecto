<?php

class Practica_usuarios extends CI_Controller{

	public function index(){

		

	}
	
	public $categorias;
	public $carro;
	
	public function __construct(){
	
		parent::__construct();
	
		$this->load->library('Carrito');
		$this->carro = new Carrito();
		$this->categorias = array ("array" => $this->Practica_modelo_categorias->rec_categoria());
	}
	
	
	public function cierre_sesion(){
		
 $this->session->sess_destroy();
  

    $this->load->view('Practica_encabezado');
    $this->load->view('Practica_cabecera');
    $this->load->view('Practica_menu_cat', $this->categorias);
    $this->load->view('Practica_cierre_sesion');
    $this->load->view('Practica_pie');
  

	}

	
	
	public function creaUsuario()
	{
		
			$this->form_validation->set_rules('dni', 'DNI', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('clave', 'Clave', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email| required');
            $this->form_validation->set_rules('nombreR', 'Nombre Real', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->form_validation->set_rules('dir', 'Direccion', 'required');
            $this->form_validation->set_rules('cp', 'Codigo Postal', 'required|min_length[5]|max_length[5]| numeric');
            
           
			$provincias = array ("provincias" => $this->Practica_modelo_provincias->rec_provincias());
  
			
			if ($this->form_validation->run()==false)
			{
				
				
				$this->load->view('Practica_encabezado');
				$this->load->view('Practica_cabecera');
				$this->load->view('Practica_menu_cat', $this->categorias);

				$this->load->view('Practica_formulario_usuarios', $provincias);
				$this->load->view('Practica_pie');
				
			}else{
				
				
				$nuevoUs = $this->Practica_modelo_usuarios->nuevo_usuario($this->input->post('dni'), $this->input->post('nombre'), 
						                                       $this->input->post('clave'), $this->input->post('email'),
						                                       $this->input->post('nombreR'), $this->input->post('apellidos'),
						                                       $this->input->post('dir'), $this->input->post('cp'), 
						                                       $this->input->post('provincia'));
				
				if ($nuevoUs)
				{
					$this->session->set_userdata("nombre", $this->input->post('nombre'));
					$this->session->set_userdata("dentro", true);
					
					$this->load->view('Practica_encabezado');
					$this->load->view('Practica_cabecera');
					$this->load->view('Practica_menu_cat', $this->categorias);
					$this->load->view('Practica_creacion_usu_correcta');
					$this->load->view('Practica_pie');
					
				}else{
					
					$this->load->view('Practica_encabezado');
					$this->load->view('Practica_cabecera');
					$this->load->view('Practica_menu_cat', $this->categorias);
					$this->load->view('Practica_creacion_usu_fallida');
					$this->load->view('Practica_pie');
					
				}

				
			}
		
	}
	
   
	public function mod_datos()
	{
		$this->form_validation->set_rules('dni', 'DNI', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email| required');
		$this->form_validation->set_rules('nombreR', 'Nombre Real', 'required');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
		$this->form_validation->set_rules('dir', 'Direccion', 'required');
		$this->form_validation->set_rules('cp', 'Codigo Postal', 'required|min_length[5]|max_length[5]| numeric');
	
		$datos = array ("provincias" => $this->Practica_modelo_provincias->rec_provincias(),
		                 "infoUs" => $this->Practica_modelo_usuarios->informacion_usu($this->session->userdata('nombre')));
		
			
		if ($this->form_validation->run()==false)
		{
		
		
			$this->load->view('Practica_encabezado');
			$this->load->view('Practica_cabecera');
			$this->load->view('Practica_menu_cat', $this->categorias);
			
			$this->load->view('Practica_formulario_mod_usuarios', $datos);
			$this->load->view('Practica_pie');
		
		}else{
		
		
			$ModUs = $this->Practica_modelo_usuarios->actualiza_u($this->session->userdata('nombre'),$this->input->post('dni'), $this->input->post('email'),
					$this->input->post('nombreR'), $this->input->post('apellidos'),
					$this->input->post('dir'), $this->input->post('cp'),
					$this->input->post('provincia'));
		
			if ($ModUs)
			{
					
				$this->load->view('Practica_encabezado');
				$this->load->view('Practica_cabecera');
				$this->load->view('Practica_menu_cat', $this->categorias);
				$this->load->view('Practica_mod_usu_correcta');
				$this->load->view('Practica_pie');
					
			}else{
					
				$this->load->view('Practica_encabezado');
				$this->load->view('Practica_cabecera');
				$this->load->view('Practica_menu_cat', $this->categorias);
				$this->load->view('Practica_mod_usu_fallida');
				$this->load->view('Practica_pie');
					
			}
		
		
		}
		
		
	}
	
}