<?php


if (!isset($_SESSION["user"]) )
{
//echo "Вы не вошли";
echo '<h2 class="btn btn-lg btn-danger btn-block">Ошибка</h2>';
//Нужен редирект
$this->renderPage('login',$templ_array);
}

if (isset($_SESSION["user"]) )
{
echo "Вы вошли<br>";

$username = $_SESSION["user"]["login"];
$templ_array=["{{user-name}}"=>$username];
var_dump($templ_array);
$this->renderPage('main_screen',$templ_array);
}


//var_dump($_SESSION["user"]);
//$db_user = $db->getUserByLogin($req_login);





?>