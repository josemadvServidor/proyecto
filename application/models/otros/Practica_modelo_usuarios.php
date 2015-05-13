<?php
Class Practica_modelo_usuarios extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}
	
	function actualiza_u($nombre, $dni,$email, $nombreR, $apellidos, $dir, $cp, $cod_prov)
	{
		$acUser = $this->db->query("update usuarios set dni_usu = \"$dni\",
				                                        email_usu = \"$email\",
				                                        nombre_real_usu = \"$nombreR\",
				                                        apellidos_usu = \"$apellidos\",
				                                        direccion_usu = \"$dir\",
				                                        cp_usu = \"$cp\",
				                                        cod_prov = \"$cod_prov\" 
				                   where nombre_usu = \"$nombre\"");
		
		return $acUser;
		
	}
	
	function informacion_usu($nombre)
	{
		$info = $this->db->query("select * from usuarios
				where nombre_usu = \"$nombre\"
				");
		
		return $info->result_array();
		
	}
	
	function nuevo_usuario($dni, $nombre, $contrasenia, $email, $nombreR, $apellidos, $dir, $cp, $cod_prov)
	{
	
		
		
			
		return $usuarioNuevo = $this->db->query("insert into usuarios 
				values (null, '$dni','$nombre','$contrasenia','$email','$nombreR',
				'$apellidos','$dir','$cp','$cod_prov')");
	
	}
	
	
	function valida_usuario($nombre, $clave)
	{
		return $valida = $this->db->query("select * from usuarios 
				                   where nombre_usu = \"$nombre\" 
				                   and contrasenia_usu =\"$clave\"")->result_array();
		/*
		$resultados = count($valida);
		
		if ($resultados == 0)
		{
			
			return false;
			
		}else{
			
			return $valida;
		}
		*/
	}
	

}