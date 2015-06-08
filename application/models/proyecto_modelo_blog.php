<?php
Class proyecto_modelo_blog extends CI_Model{

	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}
	
	/**
	 * Devulve un array con los blogs que contengan una determinada cadena 
	 * de texto en su titulo o su objetivo
	 * @param string $cadena Cadena a buscar
	 */
function dev_blogs_coinciden($cadena)
{
	
	return $this->db->query("select * from blog
			                 where 
		  	                       habilitada = 1 and
			                       (titulo LIKE '%$cadena%' or
			                       objetivo LIKE '%$cadena%')")->result_array();
	
}
	
/**
 * Devulve un array con los articulos que contengan una determinada cadena 
 * de texto en su titulo, su introduccion o su texto.
 * @param string $cadena Cadena a buscar
 */
function dev_articulos_coinciden($cadena)
{

	return $this->db->query("select a.titulo, a.textoc, a.intro, a.fecha, a.idusucrea, a.id 
							 from articulo a, blog b
			                 where (a.titulo LIKE '%$cadena%' or
			                       a.textoc LIKE '%$cadena%' or 
			                       a.intro LIKE '%$cadena%') and
			                       b.id = a.idblog and
			                       b.habilitada = 1")->result_array();

}

/**
 * Crea un blog con la informacion enviada
 * @param string $idusu id del usuario que pide su creacion.
 * @param string $titulo titulo del blog
 * @param string $proposito proposito del blog
 * @return boolean
 */
	function creaBlog($idusu, $titulo, $proposito,$usuario_c,$habilitado)
	{
		$nofallos = true;

		//Fecha actual para insertar
		$ahora = date('Y-m-d H:i:s');
		
		if ($this->db->query("insert into blog values (null,\"" . $this->db->escape_str($titulo) . "\",\"" . $this->db->escape_str($proposito) . "\", '$ahora','" . $this->db->escape_str($usuario_c) . "',$habilitado)") == false)
		{
			$nofallos = false;
		}
		
		//Recogemos el id del ultimo blogs creado para poder utilizarlo en 
		//la insercion de la tabla de administracion
		$maxid = $this->db->query("SELECT * FROM blog ORDER BY id DESC LIMIT 1")->result_array();
		
	
		
		if ($this->db->query("insert into administra values (null, \"$idusu\",". $maxid[0]['id']. ")")==false)
		{
			$nofallos = false;
			
		}
		
		return $nofallos;
		
	}
	
	/**
	 * Deshabilita o habilita un blog
	 * @param unknown $id
	 */
	function cambiaEstadoBlog($id)
	{
		$blog = $this->devBlog($id);
		$blog = $blog[0];
		if ($blog['habilitada'])
		{
			
			return $this->db->query("update blog set habilitada=0
				                    	where id = $id");
			
		}else{
			
			return $this->db->query("update blog set habilitada=1
					where id = $id");
			
		}
		
	}
	
	/**
	 * Devulve los datos de un blog
	 * @param int $id id del blog a buscar
	 */
	function devBlog($id)
	{
		
		return $this->db->query("select * from blog where id = $id and habilitada=1")->result_array();
		
	}
	
	/**
	 * Devuelve los articulos de un determinado blog en un array
	 * @param int $id id del blog
	 */
	function devArts($id){
		
		return $this->db->query("select * from articulo where idblog = $id")->result_array();
		
	}
	
	
	
	/**
	 * Devuelve todos los blogs
	 */
	function devBlogsT(){
	
		return $this->db->query("select * from blog where habilitada = 1")->result_array();
	
	}
	
	
	/**
	 * Modifica la informacion de un articulo
	 * @param int $id id del articulo
	 * @param string $titulo Nuevo titulo del articulo
	 * @param string $introduccion Nueva introduccion del articulo
	 * @param string $textoc Nuevo texto completo del articulo
	 */
	function actualiza_info_art($id, $titulo, $introduccion, $textoc)
	{
		$titulo = $this->db->escape_str($titulo);
		$introduccion = $this->db->escape_str($introduccion);
		$textoc = $this->db->escape_str($textoc);
		
		return $this->db->query("update articulo set titulo='$titulo', 
				                                     intro='$introduccion',
				                                     textoc='$textoc'
				                  where id = $id");
		
	}
	
	/**
	 * Elimina un comentario
	 * @param unknown $id id del comentario a eliminar
	 */
	function eliminaComentario($id)
	{
		
		
		return $this->db->query("delete from contenido where id=$id");
		
	}
	
	/**
	 * Comprueba si un usuario es el creador de un articulo
	 * @param unknown $art
	 * @param unknown $usu
	 */
	function compCreadorArt($art, $usu)
	{
		$creador = $this->db->query("select * from articulo where id = $art and idusucrea = '$usu'")->result_array();
		if (count($creador) > 0)
		{
			
			return true;
			
		}else {
			
			return false;
			
		}
	}
	
	/**
	 * Recoge los comentarios de un determinado articulo
	 * @param int $id id del articulo
	 */
function recogeCont($id)
{
	
	return $this->db->query("select * from contenido where idart = $id")->result_array();
	
}
	
/**
 * Devuelve el ultimo articulo creado.
 */
function ultimoArt()
{
	return $this->db->query("SELECT * FROM articulo ORDER BY id DESC LIMIT 1")->result_array();
	
}
	
/**
 * Devuelve los blogs en los que un usuario tiene permisos de administracion
 * @param unknown $idusu
 */
	function blogsUsu($idusu)
	{
		
		
		return $this->db->query("select a.id, a.idusu, a.idblog from administra a, blog b
				                 where a.idusu = \"$idusu\" and
									   b.id = a.idblog and 
									   b.habilitada = 1")->result_array();
		
	}

	
	
	/**
	 * Comprueba si un determinado usuario tiene permisos 
	 * sobre un determinado blog
	 * @param int $blog id del blog
	 * @param string $usuario id del usuario
	 * @return boolean
	 */
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
	
	/**
	 * Crea un articulo co la informacion enviada
	 * @param int $idblog id del blog al que pertenecera
	 * @param string $idusu id del usuario que lo crea
	 * @param string $intro Introduccion del articulo
	 * @param string $titulo Titulo del articulo
	 * @param string $textoc Texto Completo del articulo
	 */
	function creaArticulo($idblog, $idusu, $intro, $titulo, $textoc)
	{
	
		$ahora = date('Y-m-d H:i:s');
		
		$intro=  $this->db->escape_str($intro);
		$titulo = $this->db->escape_str($titulo);
		$textoc= $this->db->escape_str($textoc);
		
		return $this->db->query("insert into articulo values (null, '$ahora', $idblog,\"$intro\" ,\"$titulo\", \"$textoc\", \"$idusu\")");
		
     }
     
     /**
      * Modifica la informacion de un blog
      * @param string $titulo Nuevo titulo
      * @param string $proposito Nuevo proposito
      * @param int $id id del blog
      */
     function cambia_info_blog($titulo, $proposito, $id)
     {
     	$titulo= $this->db->escape_str($titulo);
     	$proposito= $this->db->escape_str($proposito);
     	
     	return $this->db->query("update blog set titulo='$titulo',
     			objetivo='$proposito'
     			where id = $id");
     	
     }
	
     /**
      * Elimina todos los comentarios de un determinado articulo
      * @param int $idart id del articulo
      */
     function borraComentarios($idart)
     {
     	
     	return $this->db->query("delete from contenido where idart=$idart");
     	
     }
     
     /**
      * Elimina un articulo
      * @param int $id id del articulo
      */
     function eliminaArticulo($id)
     {
     	
     	return $this->db->query("delete from articulo where id=$id");
     	
     }
     
     /**
      * Recoge los blogs mas recientes
      */
     function recogeUltimosBlog()
     {
     	
     	return $this->db->query("SELECT * FROM blog WHERE habilitada = 1 ORDER BY fecha_c DESC LIMIT 3")->result_array();
     	
     }
     
     /**
      *Comprueba si unusuario es creador de un blog
      */
     function compCreador($id, $blog)
     {
     
     	$blogs = $this->db->query("SELECT * FROM blog WHERE habilitada = 1 and id_usu_c = '$id' and id = $blog")->result_array();
      
     	if (count($blogs) > 0)
     	{
     		
     		return true;
     		
     	}else{
     		
     		return false;
     	}
     	
     }
     
     /**
      * Recoge el ultimo blog que s ehaya creado
      */
     function recogeUltimoBlog()
     {
     
     	return $this->db->query("SELECT * FROM blog ORDER BY fecha_c DESC LIMIT 1")->result_array();
     
     }
     
     /**
      * Recoge la informacion de un articulo
      * @param int $id id del articulo
      */
     function rec_info_art($id)
     {
     
     	return $this->db->query("SELECT * FROM articulo where id = '$id'")->result_array();
     
     }
     
     /**
      * Inserta un comentario nuevo
      * @param unknown $idart id del articulo al qu pertenece el comentario
      * @param unknown $texto texto del comentario
      * @param unknown $usuario id del usuario que lo inserta
      */
     function inserta_comentario($idart, $texto,$usuario)
     {
     	$ahora = date('Y-m-d H:i:s');
     	
     	return $this->db->query("insert into contenido values (null, $idart, '$texto', '$ahora','$usuario')");
     }
}