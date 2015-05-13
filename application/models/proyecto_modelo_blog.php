<?php
Class proyecto_modelo_blog extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}
	
function dev_blogs_coinciden($cadena)
{
	
	return $this->db->query("select * from blog
			                 where titulo LIKE '%$cadena%' or
			                       objetivo LIKE '%$cadena%'")->result_array();
	
}
	
function dev_articulos_coinciden($cadena)
{

	return $this->db->query("select * from articulo
			                 where titulo LIKE '%$cadena%' or
			                       textoc LIKE '%$cadena%' or 
			                       intro LIKE '%$cadena%'")->result_array();

}

	function creaBlog($idusu, $titulo, $proposito)
	{
		$nofallos = true;

		$ahora = date('Y-m-d H:i:s');
		
		if ($this->db->query("insert into blog values (null,\"$titulo\",\"$proposito\", '$ahora')") == false)
		{
			$nofallos = false;
		}
		$maxid = $this->db->query("SELECT * FROM blog ORDER BY id DESC LIMIT 1;")->result_array();
		
	
		
		if ($this->db->query("insert into administra values (null, \"$idusu\",". $maxid[0]['id']. ")")==false)
		{
			$nofallos = false;
			
		}
		
		return $nofallos;
		
	}
	
	function devBlog($id)
	{
		
		return $this->db->query("select * from blog where id = $id")->result_array();
		
	}
	
	function devArts($id){
		
		return $this->db->query("select * from articulo where idblog = $id")->result_array();
		
	}
	
	function actualiza_info_art($id, $titulo, $introduccion, $textoc)
	{
		
		
		
		return $this->db->query("update articulo set titulo='$titulo', 
				                                     intro='$introduccion',
				                                     textoc='$textoc'
				                  where id = $id");
		
	}
	
	function eliminaComentario($id)
	{
		
		
		return $this->db->query("delete from contenido where id=$id");
		
	}
	
function recogeCont($id)
{
	
	return $this->db->query("select * from contenido where idart = $id")->result_array();
	
}
	
function ultimoArt()
{
	return $this->db->query("SELECT * FROM articulo ORDER BY id DESC LIMIT 1;")->result_array();
	
}
	
	function blogsUsu($idusu)
	{
		
		
		return $this->db->query("select * from administra where idusu = \"$idusu\"")->result_array();
		
	}

	
	
	
	function compAdmin($blog, $usuario)
	{
		
		$comprobar = $this->db->query("select * from administra where idusu = \"$usuario\" and idblog= $blog ")->result_array();
		if (count($comprobar) > 0)
		{
			return true;
			
		}else{
			
			return false;
			
		}
	}
	
	function creaArticulo($idblog, $idusu, $intro, $titulo, $textoc)
	{
	
		$ahora = date('Y-m-d H:i:s');
		
		return $this->db->query("insert into articulo values (null, '$ahora', $idblog,\"$intro\" ,\"$titulo\", \"$textoc\", \"$idusu\")");
		
     }
     
     function cambia_info_blog($titulo, $proposito, $id)
     {
     	return $this->db->query("update blog set titulo='$titulo',
     			objetivo='$proposito'
     			where id = $id");
     	
     }
	
     function borraComentarios($idart)
     {
     	
     	return $this->db->query("delete from contenido where idart=$idart");
     	
     }
     
     function eliminaArticulo($id)
     {
     	
     	return $this->db->query("delete from articulo where id=$id");
     	
     }
     
     function recogeUltimosBlog()
     {
     	
     	return $this->db->query("SELECT * FROM blog ORDER BY fecha_c DESC LIMIT 3;")->result_array();
     	
     }
     
     function recogeUltimoBlog()
     {
     
     	return $this->db->query("SELECT * FROM blog ORDER BY fecha_c DESC LIMIT ;")->result_array();
     
     }
     
     function rec_info_art($id)
     {
     
     	return $this->db->query("SELECT * FROM articulo where id = '$id';")->result_array();
     
     }
     
     
     function inserta_comentario($idart, $texto,$usuario)
     {
     	$ahora = date('Y-m-d H:i:s');
     	
     	return $this->db->query("insert into contenido values (null, $idart, '$texto', '$ahora','$usuario')");
     }
}