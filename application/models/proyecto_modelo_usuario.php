<?php
Class proyecto_modelo_usuario extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}
	
	/**
	 * Crea un nuevo permiso de administracion
	 * @param string $usuario id del usuario
	 * @param int $blog id del blog
	 */
	function permiso_administracion($usuario, $blog)
	{
		
		return $this->db->query("insert into administra 
				values (null,'$usuario',$blog)");;
		
		
	}
	
	function retiraPermiso($id, $blog)
	{
		
		return $this->db->query("delete from administra where idusu='$id' and idblog=$blog");
		
	}
	
	/**
	 * Devuelve la informacion de un usuario
	 * @param string $nombre id del usuario
	 */
	function informacion_usu($nombre)
	{
		$info = $this->db->query("select * from usuario
				where id = \"$nombre\"
				");
		
		return $info->result_array();
		
	}
	
	/**
	 * Recoge todos los usuarios
	 */
	function recogeUsuarios()
	{
		
		return $this->db->query("select * from usuario order by id")->result_array();
		
	}
	
	/**
	 * Comprueba si un determinado id de usuario ya esta en uso
	 * @param string $id id a comprobar
	 * @return boolean
	 */
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
	
	/**
	 * Comprueba si un determinado usuario es un administrador de la aplicacion
	 * @param string $id id del usuario
	 * @return boolean
	 */
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
	
	/**
	 * Devuelve los id de los uaurios que administren un blog
	 * @param int $blog id del blog
	 */
	function administran($blog)
	{
		
		return $this->db->query("select * from administra 
				                   where idblog = \"$blog\" ")->result_array();
		
	}
	
	/**
	 * Recoge los uaurios que contengan una cadena en su id
	 * @param string $cadena
	 */
	function recogeParecidos($cadena)
	{

		return $this->db->query("select * from usuario
				where id LIKE '%$cadena%' ")->result_array();
		
		
	}
	
	/**
	 * Cambia la clave de un usuario
	 * @param string $id id del usuario
	 * @param string $clave Nueva clave
	 * @return unknown
	 */
	function cambia_clave($id, $clave)
	{
	
		$cambiaClave = $this->db->query("update usuario set clave = '$clave' where id = '$id'");
	
		return $cambiaClave;
	}
	
	/**
	 * Modifica la informacion de un uaurio
	 * @param unknown $id id del usuario
	 * @param unknown $clave nueva clave del usuario
	 * @param unknown $nombreR nuevo nombre real del usuario
	 * @param unknown $apellidos nuevos apellidos del usuario
	 * @param unknown $email nuevo email del usuario
	 */
	function editaUsuario($id, $clave, $nombreR, $apellidos, $email)
	{

		return $this->db->query("update usuario set clave = '$clave',
				nombre_real = '$nombreR',
				apellidos = '$apellidos',
				email = '$email'
				where id = '$id'");
		
	}
	
	/**
	 * Crea un usuario nuevo
	 * @param string $id id del usuario
	 * @param string $clave Clave del usuario
	 * @param string $nombreR nombre real del usuario
	 * @param string $apellidos apellidos del usuario
	 * @param string $email email del usuario
	 */
	function creaUsuario($id, $clave, $nombreR, $apellidos, $email)
	{

		//Registra el momento de la insercion
		$ahora = date('Y-m-d H:i:s');
		
		return $usuarioNuevo = $this->db->query("insert into usuario 
				values ('$id', '$clave',1,0,'$nombreR','$apellidos','$ahora','$email')");
	
	}
	
	/**
	 * Comprueba si un usuario existe
	 * @param string $nombre Identificador a comprobar
	 * @param string $clave Clave a comprobar
	 * @return boolean
	 */
	function valida_usuario($nombre, $clave)
	{
		
		$validar = $this->db->query("select * from usuario 
				                   where id = \"$nombre\" 
				                   and clave =\"$clave\"
								   and estado = 1 ")->result_array();
		
		
		
		if (count($validar) > 0)
		{
			
		return true;
		
		}else{
			
			return false;
		}
	
	}
	
	/**
	 * Deshabilita o habilita a un usuario
	 * @param string $id id del usuario
	 */
	function cambiaEstado($id)
	{
		$estado;
		$usuario = $this->informacion_usu($id);
		$usuario = $usuario[0];
		
		if ($usuario['estado'])
		{
			
		$estado = 0;	
		
		}else{
			
			$estado = 1;
			
		}
		
		return $this->db->query("update usuario set estado = $estado
									where id = '$id'");
		
		
	}
	
	/**
	 * Comprueba si un usuario es quien escribio un comentario
	 * @param unknown $usu
	 * @param unknown $comentario
	 * @return boolean
	 */
	function comp_escritor($usu, $comentario)
	{
		
		
		$escritor = $this->db->query("select * from contenido
				where id = $comentario and
				idusu = '$usu'
				")->result_array();
		
				if (count($escritor) > 0)
				return true;
				else
					return false;
		
	}

}