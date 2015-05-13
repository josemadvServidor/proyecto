<?php
Class Practica_modelo_categorias extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	function rec_categoria()
	{
		$pCat = $this->db->query("select * from categoria where oculto = FALSE");

		return $pCat->result_array();
	}

	}
