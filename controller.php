<?php

class Controller {
	
public $parameters;

function __construct($a){
$this->parameters = $a;
//Храним массив параметров.
//$this->parameters[0] - контроллер
}	

public function renderPage($template,$template_array){
//todo добавить замену из массива	
$a=file_get_contents('./templates/'.$template.'.html');
$html_out = str_ireplace('{{user-name}}' ,"Пользователь",$a);
echo $html_out;	
//echo "FUNCTION TEST";
	
}
public function prepareData($template){
//	
$a=file_get_contents('./templates/'.$template.'.html');
echo $a;	
}
	
public function run(){
$cnt_req = $this->parameters[0];
//Должен быть валидный контроллер!!!	


//-------------------------------------------Обработка контроллерами:

//Выход из аккаунта
if ($cnt_req=='logout')
{ 
require_once("controllers/logout.php");

}
//--------------------logout

if ($cnt_req=='login')
{ 
require_once("controllers/login.php");
}
//--------------------login

if ($cnt_req=="register")
{
require_once("controllers/register.php");
}
//--------------------register

//Само приложение
//Вторым параметром передается экран
//Затем что-то в get
//Остальное в POST
if ($cnt_req=='erm')
{ 
//var_dump($this->parameters);
//echo "<br>";	
require_once("controllers/erm.php");
}
/*
if ($cnt_req=='orders')
{ 
require_once("controllers/orders.php");
}
if ($cnt_req=='sales')
{ 
require_once("controllers/sales.php");
}
if ($cnt_req=='stock')
{ 
require_once("controllers/stock.php");
}
if ($cnt_req=='cash-register')
{ 
require_once("controllers/cash-register.php");
}*/
//-------------------------------------------Обработка контроллерами^ конец списка
//---------------------run()	
}



}
//class controller
?>