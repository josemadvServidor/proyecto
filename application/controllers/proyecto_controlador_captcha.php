<?php 
class Proyecto_controlador_captcha extends CI_Controller{


public function __construct(){

	parent::__construct();
	
	 define("ASSETS_DIR", APPPATH.'../Assets/');
	
	//Cargamos los modelos
	$this->load->model('proyecto_modelo_blog');
	$this->load->model('proyecto_modelo_usuario');


}
// Función que queremos probar

public function gen_captcha()
{
	
$this->captcha();
}

public function captcha()
{

	 
	$captchaTextSize = 7;
	do {
		 
		//$Hash = microtime( ) * mktime( ); ** ERROR **
		$Hash = microtime( ) * time( ); // Es time, no mktime
		
		preg_replace( '([1aeilou0])', "", $Hash );
	} while( strlen( $Hash ) < $captchaTextSize );
	 
	$key = substr( $Hash, 0, $captchaTextSize );

	
	//$this->session->set['captcha']= $key; // Cambiado para hacer pruebas
	$this->session->set_userdata("captcha", $key);
	//$captchaImage = imagecreatefrompng(site_url('../Assets/png/captcha.png')); 
	// LA RUTA ESTÁ MAL, NO DEBE SER UNA URL, SINO UNA RUTA DEL SERVIDOR COMO 
	// APP_PATH/assets/....
	$captchaImage = imagecreatefrompng(ASSETS_DIR.'png/captcha2.png');// Cambiado para hacer pruebas
	
	$textColor = imagecolorallocate( $captchaImage, 0, 0, 102 );
	 
	$lineColor = imagecolorallocate( $captchaImage, 15, 103, 103 );

	 
	//$imageInfo = getimagesize( site_url('../Assets/png/captcha.png' ));
	$imageInfo = getimagesize(ASSETS_DIR.'png/captcha2.png');// Cambiado para hacer pruebas
	
	$linesToDraw = 10;

	for( $i = 0; $i < $linesToDraw; $i++ ) {

		$xStart = mt_rand( 0, $imageInfo[ 0 ] );
		$xEnd = mt_rand( 0, $imageInfo[ 0 ] );

		imageline( $captchaImage, $xStart, 0, $xEnd, $imageInfo[1], $lineColor );
	}

	// Cambiado para pruebas
	//imagettftext( $captchaImage, 20, 0, 35, 35, $textColor, site_url('../Assets/ttf/A Charming Font Superexpanded.ttf'), $key );
	
	// Ejemplo de texto en GD: http://www.desarrolloweb.com/articulos/gd-ejemplos.html 
	
	// las fuentes utilizadas deben estar en un fichero en el servidor. Tienes fuentes en http://www.1001freefonts.com/ 
	// o buscando en google "font ttf free".
	// En la función haces referencia a donde las tienes almancenadas. En mi caso me he bajado algunas y las he situado
	// en la carpeta font
	
	
	imagettftext( $captchaImage, 25 /*size*/, 0/*angle*/, 5/*x*/, 35/*y*/, $textColor/*color*/,ASSETS_DIR .'../Assets/ttf/Gardenia.ttf'/*font*/, $key/*text*/ );
	
	//exit;
	
	// NO tiene sentido la siguiente línea, lo que tenemos es que devolver la imagen generada
	//return imagepng($captchaImage);
	
	//Dibujar la imagen
	// Esto hace que se envie la imagen generada
	header("Content-type: image/png");
	
	// Necsario para que el navegador no almacene la imagen en cache
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: ".gmdate('D, d M Y H:i:s', time()-(/*una semana*/ 3600*24*7))); // Fecha en el pasado	
	
	imagepng($captchaImage);
	imagedestroy($captchaImage);
	exit;
	// A partir de aquí no se ejecuta NADA

}
}