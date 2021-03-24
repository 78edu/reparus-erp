<?php


if($_POST['inputPassword']!=$_POST['repeatPassword'])
{echo '<h2 class="btn btn-lg btn-danger btn-block">Пароли не совпадают</h2>';}	
	
if (($_POST['captcha']=='76890') and ($_POST['inputPassword']===$_POST['repeatPassword']))
{
echo '1.registering...<br>';	
$req_login=$_POST['rlogin'];
$req_pass=$_POST['inputPassword'];	
//$req_pass=$_POST['password'];		
	
$db = new SQLiteConnection();
$db->connect();
if ($db != null){
echo '2.DB Connected...<br>';}
else{echo '2.DB connection failed.<br>';}
$db_user = $db->registerUser($req_login,$req_pass);
if ($db_user!=false)
{echo '<h2 class="btn btn-lg btn-success btn-block">Пользователь зарегистрирован</h2>';}
else
{echo '<h2 class="btn btn-lg btn-danger btn-block">Регистрация не удалась!</h2>';}
}
//else - вывод одной ошибки на все

if (isset($_POST['captcha']) and ($_POST['captcha']!='76890') ){
echo '<h2 class="btn btn-lg btn-danger btn-block">Неправильный код!</h2>';
}
$this->renderPage('register',$templ_array);

?>