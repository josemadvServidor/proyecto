<?php

Class Practica_modelo_pedidos extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	function rec_pedidos($id)
	{
		$pUs = $this->db->query("select * from pedido where Usuarios_idUsuario = $id");

		return $pUs->result_array();
	}
	
	function rec_pedido($id)
	{
		$pUs = $this->db->query("select * from pedido where id_pedido = $id");
	
		return $pUs->result_array();
	}
	
	function rec_lineas_pedido($id)
	{
		$lineas = $this->db->query("select * from linea_ped where pedido_id_pedido = $id");
	
		return $lineas->result_array();
	}
	
	function nuevo_pedido($num_productos, $precio_total, $estado_ped, $Usuarios_id_usuario,
                          $nombre_usu, $apellidos_usu, $direccion_ped, $cp_usu, $cod_prov)
	{
		return $PedidoNuevo = $this->db->query("insert into pedido 
				values (null,'$num_productos','$precio_total','$estado_ped','$Usuarios_id_usuario',
				'$nombre_usu','$apellidos_usu','$direccion_ped','$cp_usu','$cod_prov')");
	
	}
	
	function crea_linea_pedido($cantidad, $precio, $idPedido, $idProd)
	{
		return $lineaNueva = $this->db->query("insert into linea_ped
				values (null, $cantidad,$precio,$idPedido,$idProd)");
		
	}
	
	function id_ultimo()
	{
		return $lineaNueva = $this->db->query("select max(id_pedido) from pedido")->result_array();
		
	}

	function borra_pedido($id)
	{
		
		$this->db->query("delete from linea_ped where pedido_id_pedido = $id");
	
		return $this->db->query("delete from pedido where id_pedido = $id");
	}
	
}