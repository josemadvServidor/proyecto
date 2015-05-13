<?php
Class Practica_modelo_productos extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	function rec_destacados_total()
	{
		/*
		 * 
		 select * from producto where 
	destacado = TRUE and 
    oculto_p = FALSE and 
    stock_disp > 0 and
    (
        fecha_ini is null and fecha_fin is null
        or
        fecha_ini is null and fecha_fin >= now()
        or 
        fecha_fin is null and fecha_ini <= now()
        or
        fecha_ini<=now() and fecha_fin>=now()
    )
		 */
		//$ahora = date('Y-m-d H:i:s');
		
		$pDest = $this->db->query(" select * from producto where 
	destacado = TRUE and 
    oculto_p = FALSE and 
    stock_disp > 0 and
    (
        fecha_ini is null and fecha_fin is null
        or
        fecha_ini is null and fecha_fin >= now()
        or 
        fecha_fin is null and fecha_ini <= now()
        or
        fecha_ini<=now() and fecha_fin>=now()
    )");
		
		return $pDest->result_array();
	}
	
	function rec_destacados($desde, $numReg)
	{
		//$ahora = date('Y-m-d H:i:s');
		
		$pDest = $this->db->query("select * from producto where 
	destacado = TRUE and 
    oculto_p = FALSE and 
    stock_disp > 0 and
    (
        fecha_ini is null and fecha_fin is null
        or
        fecha_ini is null and fecha_fin >= now()
        or 
        fecha_fin is null and fecha_ini <= now()
        or
        fecha_ini<=now() and fecha_fin>=now()
    ) Limit $desde, $numReg");
		
		
		return $pDest->result_array();
	}
	
	function rec_categoria($categoria, $desde, $numR)
	{
		$pCat = $this->db->query("select * from producto where Categoria_idCat = $categoria 
				                                         and oculto_p = FALSE
				                                         and stock_disp > 0 Limit $desde, $numR");
	
		return $pCat->result_array();
	}
	
	function rec_categoria_total($categoria)
	{
		$pCat = $this->db->query("select * from producto where Categoria_idCat = $categoria
				and oculto_p = FALSE
				and stock_disp > 0");
	
				return $pCat->result_array();
	}
	
	function disminuye_stock($id, $cant)
	{
		$dis_stock = $this->db->query("update producto set stock_disp = stock_disp - $cant where idProd = $id");
	
		return $dis_stock;
	}
	
	function recogePorId($id)
	{
		$prod = $this->db->query("select * from producto where idProd = $id");
	
		return $prod->result_array();
	}
	
}
