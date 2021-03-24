<?php

class Router{
//Маршруты
/*private $routes;

function __construct($routesPath){
// Получаем конфигурацию из файла.
$this->routes = include($routesPath);

 }
 */
 
function run(){
//Выполняет обработку маршрутов
$page_req = $_GET['a'];
//Строка, где указывается маршрут.
$segments = explode('/',$page_req);	

switch($segments[0]){
		case "login":
			$controller[0]='login';
			break;
		case "register":
			$controller[0]='register';
			break;
		case "logout":
			$controller[0]='logout';
			break;
		case "erm":
			$controller[0]='erm';
			if (isset($segments[1]))
			{
			$controller[1]=$segments[1];
			}
			break;
		default:
			$controller[0]='login';
			break;
	}
//echo "controller:";	
//var_dump($controller);

//Контроллер - это массив, 0 - всегда сам контроллер, 1-беск. его параметры
return $controller;

//request controller : real controller
//$test_routes = ['login'=>'login', 'register'=>'register','main_screen'=>'main_screen'];
//Лишнее
	
}
}
?>