<?php
//reparus erm
//управление ресурсами

//index.php?a=(GET строка, либо index.php, либо файл найден)
//из а вытаскиваем параметры роутером и отправляем их в контроллер
//rewrite to like site.com/main_screen/30/40
//cookies: session 

//no params - check session - login or main screen

/*
spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/' . $className . '.php';
});*/
//error_reporting(0); //todo ВРЕМЕННО!





require_once('./db-helper.php');
require_once('./router.php');
require_once('./controller.php');


session_start();	//Обязательно перед контроллером и роутером!

echo "<a href='/login/' >Войти</a>  <a href='/register/' >Регистрация</a> 
<a href='/logout/' >Выход</a> <a href='/erm/orders/' >Заказы</a> <a href='/erm/' >ERM</a><br>";
echo "post, get request: ";
var_dump($_REQUEST);



//Точка входа, роутер:
//Обрабатывает запрос и возвращает вальдный контроллер и разбирает параметры (get, post)
$router = new Router();
$route_controller = $router->run();
echo "Route controller: ";
var_dump($route_controller);

$parameters=$route_controller;

//0 индекс всегда контроллер, остальное опционально

//Создаем контроллер с параметрами и запускаем вывод результата
$controller = new Controller($parameters);
$controller->run();






//echo 'Page a= $page_req: '.$page_req;
//echo '<br>';
//echo 'Actual page: '.$page;
//echo '<br> Session:';
//var_dump($_SESSION['user']);
//echo '<br>';

//if ($_POST['captcha']!='76890')	
//{echo 'Captcha is wrong <br>';}







/*
//Вывод отладки
echo "---------------------------------------";
echo '<br>Request: <br>';
var_dump($_REQUEST);	
echo '<br>';

echo '<br>Session: <br>';
var_dump($_SESSION['user']);*/

?>