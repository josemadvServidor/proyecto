<?php
class que_tal extends CI_Controller{
	
	public function index(){
		
		$this->load->view('que_tal');
		
	}
	/*4. A�adir la acci�n �CuentaNumeros� al controlador �Que_Tal_Estas� 
	 * la cual recibir� como par�metro un n�mero y mostrar� por pantalla
	 *  los n�meros menores que el pasado como par�metro. 
Por defecto si no se indica ning�n n�mero se tomar� el valor 10.
Incluir en  el men� de Hola_Mundo enlaces para que nos muestre los n�meros 
menores que 5, 10 y 100.*/
	public function CuentaNumeros($ini = 10)
	{
		while($ini >= 0)
		{
			echo $ini . "<br>";
			$ini--;
		}
		
	}
	
}
