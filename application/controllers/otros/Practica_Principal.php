<?php
class Practica_principal extends CI_Controller{
	
	public $categorias;
	public $carro;
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->library('Carrito');
		$this->carro = new Carrito();
        $this->categorias = array ("array" => $this->Practica_modelo_categorias->rec_categoria());
	}
	
	
	public function index($pag=0){
	
		//$informacion = $this->Practica_modelo_pedidos->id_ultimo();
		//echo $informacion[0];
		//var_dump($informacion[0][1]);
		
	
		
		$desde = $pag;
		//var_dump($desde);
		
		//$categorias = array ("array" => $this->Practica_modelo_categorias->rec_categoria());
		
		$destacan = array ("array" => $this->Practica_modelo_productos->rec_destacados($desde, 	$config['per_page'] = '3'));
		$destacanT = array ("array" => $this->Practica_modelo_productos->rec_destacados_total());
		//echo count($destacanT['array']);
		
		$config['base_url'] = site_url('/Practica_Principal/index');
		$config['total_rows'] = count($destacanT['array']);
		$config['per_page'] = '3';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_menu_p', $destacan);
		$this->load->view('Practica_pie');
		
	}
	
	public function inicioSesion()
	{
		
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('clave', 'Clave', 'required');
		
		if ($this->form_validation->run()==false)
		{
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_menu_inicio');
		$this->load->view('Practica_pie');
		
		}else{
			
			if (count($datosUs = $this->Practica_modelo_usuarios->valida_usuario($this->input->post('nombre'), $this->input->post('clave'))) > 0)
			{
				
				
				
				$this->session->set_userdata("nombre", $this->input->post('nombre'));
				$this->session->set_userdata("dentro", true);
				$this->session->set_userdata("id", $datosUs[0]['idUsuario']);
				$this->session->set_userdata("nombreR", $datosUs[0]['nombre_real_usu']);
				$this->session->set_userdata("apellidos", $datosUs[0]['apellidos_usu']);
				$this->session->set_userdata("direccion", $datosUs[0]['direccion_usu']);
				$this->session->set_userdata("cp", $datosUs[0]['cp_usu']);
				$this->session->set_userdata("prov", $datosUs[0]['cod_prov']);
				
				$this->load->view('Practica_encabezado');
				$this->load->view('Practica_cabecera');
				$this->load->view('Practica_menu_cat', $this->categorias);
				$this->load->view('Practica_exito_validacion');
				$this->load->view('Practica_pie');
				
			}else{
				
			$datos = array ("nombre" => $this->input->post('nombre'),
			                     "clave" => $this->input->post('clave'));
			
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_menu_inicio_fallido', $datos);
		$this->load->view('Practica_pie');
				
			}
			
			
		}
		
		
	}
	
	public function muestraCat($idCat, $pag=0)
	{
/*
$config['base_url'] = 'http://www.your-site.com/index.php/test/page/';
$config['total_rows'] = '200';
$config['per_page'] = '20'; 

$this->pagination->initialize($config); 

echo $this->pagination->create_links();
*/      
		$desde = $pag;
		

		
		$productosCategoria = array ("array" => $this->Practica_modelo_productos->rec_categoria($idCat, $desde, $config['per_page'] = '3'));
		$productosCategoriaT = array ("array" => $this->Practica_modelo_productos->rec_categoria_total($idCat));
		
		$config['base_url'] = site_url('/Practica_Principal/muestraCat/' . $idCat . '/');
		$config['total_rows'] = count($productosCategoriaT['array']);
		$config['per_page'] = '3';
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
        
		
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_menu_p', $productosCategoria);
		$this->load->view('Practica_pie');
		
	}
	
	public function ir_carro()
	{

		$car = $this->carro;

		$productosCarro = array ("array" => $car->get_content(),
		                         "pTotal" => $precioT = array("0"=>$car->precio_total()));
		
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_menu_carro', $productosCarro);
		$this->load->view('Practica_pie');
		
	}

	public function info_producto($id)
	{
	
		
		$infoP = array ("array" => $this->Practica_modelo_productos->recogePorId($id));
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_info_p', $infoP);
		$this->load->view('Practica_pie');
	}
	
	public function aniade_producto($id)
	{
		$infoP = array ("array" => $this->Practica_modelo_productos->recogePorId($id));

    
     	if ($this->input->post('cantidad') == 0)
     	{
     		
     		$this->load->view('Practica_encabezado');
     		$this->load->view('Practica_cabecera');
     		$this->load->view('Practica_menu_cat', $this->categorias);
     		$this->load->view('Practica_al_menos_uno', $infoP);
     		$this->load->view('Practica_pie');
     		
     		
     	}else{
     		
     	$producto = $this->Practica_modelo_productos->recogePorId($id);
     	
     	$cantidad = $this->input->post('cantidad');
     	
     	$precio = $producto[0]['precio_venta'] - ($producto[0]['precio_venta'] / 100 * $producto[0]['descuento_apl']);
        $precio = $precio + ($producto[0]['precio_venta'] / 100 * $producto[0]['iva']);
     	
     	$articulo = array ( "id" => $producto[0]['idProd'],
     		            	"cantidad" => $this->input->post('cantidad'),
     		             	"precio" => round($precio, 2),
                            "nombre" => $producto[0]['nombre']
     	                   ); 
     	
     	$this->carro->add($articulo);
     	
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_aniadir_prod', $infoP);
		$this->load->view('Practica_pie');
		
     	}
     
		
	}
	
	public function vacia_carro()
	{
		$this->carro->destroy();
		
		$productosCarro = array ("array" => $this->carro->get_content(),
		                         "pTotal" => $precioT = array("0"=>$this->carro->precio_total()));
			
			
			$this->load->view('Practica_encabezado');
			$this->load->view('Practica_cabecera');
			$this->load->view('Practica_menu_cat', $this->categorias);
			$this->load->view('Practica_menu_carro', $productosCarro);
			$this->load->view('Practica_pie');
			

	}
  
public function saca_producto($id)
{ 
	
	$this->carro->remove_producto($id);
	
	$productosCarro = array ("array" => $this->carro->get_content(),
		                     "pTotal" => $precioT = array("0"=>$this->carro->precio_total()));
	
	$this->load->view('Practica_encabezado');
	$this->load->view('Practica_cabecera');
	$this->load->view('Practica_menu_cat', $this->categorias);
	$this->load->view('Practica_menu_carro', $productosCarro);
	$this->load->view('Practica_pie');
}


	//Cuando se haga efectiva una venta se mostrará un resumen de los productos vendidos. El usuario recibirá igualmente un correo con la misma información. 

public function resumen_productos()
{
	
	if ($this->session->userdata('dentro') == true){
		
	$productos = $this->carro->get_content();
	
    $precioT = 0;
	
	$this->load->view('Practica_encabezado');
	$this->load->view('Practica_cabecera');
	$this->load->view('Practica_menu_cat', $this->categorias);
	$this->load->view('Practica_encabezado_resumen');
	
	foreach ($productos as $producto):
	
	$infoP = array ("informacion" =>  $this->Practica_modelo_productos->recogePorId($producto['id']),
	                 "infoP" => $producto);
	
	$this->load->view('Practica_resumen', $infoP);
	
	$precio = $infoP["informacion"][0]['precio_venta'];
	$descuento =$infoP["informacion"][0]['descuento_apl'];
	$iva = $infoP["informacion"][0]['iva'];
	
	$precioT += (($precio - (($precio / 100) * $descuento)) + (($precio / 100) * $iva)) * $producto['cantidad'];
	echo $precioT . "<br>";
	endforeach;	
	$infoPie = array ("precio" =>  round($precioT,2),
	                "totalProductos" => $this->carro->articulos_total());
	
	$this->load->view('Practica_pie_resumen',$infoPie);
	$this->load->view('Practica_pie');
	
	}else{
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_no_sesion');
		$this->load->view('Practica_pie');
		
	}
	
}

public function consulta_pedidos()
{
	if ($this->session->userdata('dentro') == true)
	{
		$pedidos = array("pedidos" => $this->Practica_modelo_pedidos->rec_pedidos($this->session->userdata('id')));
		
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		
		if (count($pedidos['pedidos']) > 0)
		{
			
		$this->load->view('Practica_pedidos', $pedidos);
		
		}else{
			
			$this->load->view('Practica_no_pedidos');
			
		}
		$this->load->view('Practica_pie');
		
		
	}else{
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_no_sesion');
		$this->load->view('Practica_pie');
		
	}
	
}
/*
 * ssh-dss AAAAB3NzaC1kc3MAAACBAP1/U4EddRIpUt9KnC7s5Of2EbdSPO9EAMMeP4C2USZpRV1AIlH7WT2NWPq/xfW6MPbLm1Vs14E7gB00b/JmYLdrmVClpJ+f6AR7ECLCT7up1/63xhv4O1fnxqimFQ8E+4P208UewwI1VBNaFpEy9nXzrith1yrv8iIDGZ3RSAHHAAAAFQCXYFCPFSMLzLKSuYKi64QL8Fgc9QAAAIEA9+GghdabPd7LvKtcNrhXuXmUr7v6OuqC+VdMCz0HgmdRWVeOutRZT+ZxBxCBgLRJFnEj6EwoFhO3zwkyjMim4TwWeotUfI0o4KOuHiuzpnWRbqN/C/ohNWLx+2J6ASQ7zKTxvqhRkImog9/hWuWfBpKLZl6Ae1UlZAFMO/7PSSoAAACAWlWuyiYW7q9UKX5FqjC3yHIkB/wkUKKKl9lPIigHb00BDPt5DriGgxZrXBO/GY2ShrkGnmL8TucvePzkfeWJCp4cM2jVN3TSJZ6swVdREvTPnFD7hD5hLydJb+mEAHfZgBTHhjfkF7fvdnqjIpnXQXZrlyhIUCYF3sf/367RBMU= DSA-1024
*/
public function resumen_pedido($id)
{
	if ($this->session->userdata('dentro') == true)
	{
		
	$lineasP = $this->Practica_modelo_pedidos->rec_lineas_pedido($id);
	$datosP = $this->Practica_modelo_pedidos->rec_pedido($id);
	
	//var_dump($datosP[0]);
	$this->load->view('Practica_encabezado');
	$this->load->view('Practica_cabecera');
	$this->load->view('Practica_menu_cat', $this->categorias);
	$this->load->view('Practica_encabezado_resumen_lineas');
	
	$precioT = 0;
	
	foreach ($lineasP as $producto):
	
	$infoP = array ("informacion" =>  $this->Practica_modelo_productos->recogePorId($producto['Producto_idProd']),
			"infoP" => $producto);
	
	$this->load->view('Practica_resumen_lineas', $infoP);
	
	$precioT = $datosP[0]['precio_total'];
	//echo $precioT . "<br>";
	endforeach;
	$infoPie = array ("precio" =>  $precioT,
			"totalProductos" => count($lineasP));
	
	$this->load->view('Practica_pie_resumen_2',$infoPie);
	$this->load->view('Practica_pie');
	
		
	}else{
		
			$this->load->view('Practica_encabezado');
			$this->load->view('Practica_cabecera');
			$this->load->view('Practica_menu_cat', $this->categorias);
			$this->load->view('Practica_no_sesion');
			$this->load->view('Practica_pie');
		
		}
}

public function borra_pedido($id)
{
	if ($this->session->userdata('dentro') == true)
	{
		$this->Practica_modelo_pedidos->borra_pedido($id);
		
		
		$pedidos = array("pedidos" => $this->Practica_modelo_pedidos->rec_pedidos($this->session->userdata('id')));
	
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_pedidos', $pedidos);
		$this->load->view('Practica_pie');
	
	
	}else{
	
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_no_sesion');
		$this->load->view('Practica_pie');
	
	}
	
	
	
}

public function confirma_compra()
{


	if ($this->session->userdata('dentro') == true){
		$infoUsuario = $this->Practica_modelo_usuarios->informacion_usu($this->session->userdata('nombre'));
		
		
		$this->email->from('aula4@iessansebastian.com', 'Administrador');
		$this->email->to($infoUsuario[0]['email_usu']);
		$this->email->subject('Resumen compra');
		//
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.iessansebastian.com';
		$config['smtp_user'] = 'aula4@iessansebastian.com';
		$config['smtp_pass'] = 'daw2alumno';
		$config['mailtype'] = 'html';
		//
		
		$mensaje = "<h1>Resumen Compra</h1><br><table><tr><th>Codigo</th><th>Nombre</th><th>Precio</th>
				<th>Descuento</th><th>IVA</th><th>Cantidad</th><th>Precio Final</th><th>Descripcion</th></tr> ";
	$productos = $this->carro->get_content();
	
    $precioT = 0;
	
	$this->load->view('Practica_encabezado');
	$this->load->view('Practica_cabecera');
	$this->load->view('Practica_menu_cat', $this->categorias);
	$this->load->view('Practica_compra_confirmada');
	$this->load->view('Practica_pie');
	
	foreach ($productos as $producto):
	
	
	$infoP = array ("informacion" =>  $this->Practica_modelo_productos->recogePorId($producto['id']),
	                 "infoP" => $producto);
	
	
	
	
	$precio = $infoP["informacion"][0]['precio_venta'];
	//$descuento =$infoP["informacion"][0]['descuento_apl'];
	//$iva = $infoP["informacion"][0]['iva'];
	
	$precioT += $precio * $producto['cantidad'];
	//echo $precioT . "<br>";
	//
	$descontar = ($infoP["informacion"][0]['precio_venta'] / 100) * $infoP["informacion"][0]['descuento_apl'];
	
	$iva =  ($infoP["informacion"][0]['precio_venta'] / 100) * $infoP["informacion"][0]['iva'];
	
	$precioFinal = $infoP["informacion"][0]['precio_venta'] -  $descontar + $iva;
	
	//
$mensaje = $mensaje . "<tr><td>" .  $infoP["informacion"][0]['codigo'] . "</td><td>" . $infoP["informacion"][0]['nombre'] . "</td><td>" . $infoP["informacion"][0]['precio_venta']
. "</td><td>" . $infoP["informacion"][0]['descuento_apl'] . "</td><td>" . $infoP["informacion"][0]['iva'] . "</td><td>" . $infoP["infoP"]['cantidad'] . "</td><td>" . $precioFinal
."</td><td>" . $infoP["informacion"][0]['descripcion'] . "</td></tr>";
	
    $this->Practica_modelo_productos->disminuye_stock($producto['id'], $producto['cantidad']);

	endforeach;	
	$infoPie = array ("precio" =>  round($precioT,2),
	                "totalProductos" => $this->carro->articulos_total());
	
	
	
	
	$mensaje = $mensaje .  "</table><br>Precio Total: " . $infoPie['precio'] . " E<br>" . "Total productos: " . $infoPie['totalProductos'];
    //echo $mensaje;
	$this->email->message($mensaje);

	if ($this->email->send($config))
	{
		//echo "<pre>\n\nENVIADO CON EXITO\n</pre>";
	}
	else
	{
		echo "</pre>\n\n**** NO SE HA ENVIADO ****</pre>\n";
	}
	//echo $this->email->print_debugger();
	
	//Crear pedido y lineas
	//, $num_productos, $precio_total, $estado_ped, $Usuarios_id_usuario, $nombre_usu, $apellidos_usu, $direccion_ped, $cp_usu, $cod_prov
	if ($this->Practica_modelo_pedidos->nuevo_pedido($infoPie['totalProductos'],$infoPie['precio'] ,"p",
	    $this->session->userdata('id'), $this->session->userdata('nombreR'), 
	    $this->session->userdata('apellidos'),$this->session->userdata('direccion'),
	    $this->session->userdata('cp'), $this->session->userdata('prov')))
	{
		
		$informacion = $this->Practica_modelo_pedidos->id_ultimo();
		//var_dump($informacion);
		foreach ($productos as $producto):
		
		//$informacion = $this->Practica_modelo_productos->recogePorId($producto['id']);
		foreach ($informacion[0] as $inf):
		$idp =  $inf;
		endforeach;
		
		
		$this->Practica_modelo_pedidos->crea_linea_pedido($producto['cantidad'], 
				                                          $producto['precio'],
				                                          $idp,
				                                          $producto['id']);
		
		endforeach;
		
		
	}else{
		
		echo "No se pudo crear el pedido";
	}
	
	
	
	
	
	
	$this->carro->destroy();
	
	}else{
		
		$this->load->view('Practica_encabezado');
		$this->load->view('Practica_cabecera');
		$this->load->view('Practica_menu_cat', $this->categorias);
		$this->load->view('Practica_no_sesion');
		$this->load->view('Practica_pie');
		
	}
}

}