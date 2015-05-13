<?php
Class proyecto_modelo_usuario extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}
	
	function permiso_administracion($usuario, $blog)
	{
		
		return $this->db->query("insert into administra 
				values (null,'$usuario',$blog)");;
		
		
	}
	
	function informacion_usu($nombre)
	{
		$info = $this->db->query("select * from usuario
				where id = \"$nombre\"
				");
		
		return $info->result_array();
		
	}
	
	function comp_usado($id)
	{
		
		$comp = $this->db->query("select * from usuario
				where id = \"$id\"
				")->result_array();
		
		
		if (count($comp) > 0)
		{
			return false;
		}else{
			
			return true;
			
		}
		
		
	}
	
	function comp_administrador($id)
	{
	
		$administrador = $this->db->query("select * from usuario 
				                           where id = '$id' and
				                                  administrador = true
				                          ")->result_array();
	
		if (count($administrador) > 0)
		return true;
		else
			return false;
	}
	
	function administran($blog)
	{
		
		return $this->db->query("select * from administra 
				                   where idblog = \"$blog\" ")->result_array();
		
	}
	
	function recogeParecidos($cadena)
	{

		return $this->db->query("select * from usuario
				where id LIKE '%$cadena%' ")->result_array();
		
		
	}
	
	function cambia_clave($id, $clave)
	{
	
		$cambiaClave = $this->db->query("update usuario set clave = '$clave' where id = '$id'");
	
		return $cambiaClave;
	}
	
	
	function editaUsuario($id, $clave, $nombreR, $apellidos, $email)
	{
		
		
		
		
		return $this->db->query("update usuario set clave = '$clave',
				nombre_real = '$nombreR',
				apellidos = '$apellidos',
				email = '$email'
				where id = '$id'");
		
	}
	
	function creaUsuario($id, $clave, $nombreR, $apellidos, $email)
	{

		$ahora = date('Y-m-d H:i:s');
		
		return $usuarioNuevo = $this->db->query("insert into usuario 
				values ('$id', '$clave','activo',0,'$nombreR','$apellidos','$ahora','$email')");
	
	}
	
	
	function valida_usuario($nombre, $clave)
	{
		
		$validar = $this->db->query("select * from usuario 
				                   where id = \"$nombre\" 
				                   and clave =\"$clave\"")->result_array();
		
		
		
		if (count($validar) > 0)
		{
			
		return true;
		
		}else{
			
			return false;
		}
	
	}
	

}