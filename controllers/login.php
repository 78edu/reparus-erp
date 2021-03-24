<?php
if ($_POST['captcha']=='76890')
{
echo 'captcha is ok <br>';
//$_POST['login']==='test' & $_POST['password']==='test')

$req_login=$_POST['rlogin'];
$req_pass=$_POST['password'];
//пароль = sha1(sha1(pass).'-pass')
//todo фильтр от sql inj

$db = new SQLiteConnection();
$db->connect();
if ($db != null){
echo 'DB Connected <br>';}
else{
echo 'Whoops, could not connect to the SQLite database! <br>';}

$db_user = $db->getUserByLogin($req_login);//нашли юзера в базе и возвращаем его, без него входа нет

$pass_hash = strtoupper(sha1(strtoupper(sha1($req_pass)).'-'.$req_pass));

echo 'Login pass hash:'.$pass_hash;
echo '<br>';
echo 'DB user login:'.$db_user["login"];
echo '<br>'.'DB USER vardump:';
var_dump( $db_user);
echo '<br>';
if (($db_user['login']===$req_login) and ($db_user['pass']===$pass_hash))
{
echo 'SESSION IS SET!	';


echo '<head>
<meta http-equiv="refresh" content="1;URL=/erm/orders" />
</head> ';
//временно, переделать на редиректы




$_SESSION["user"]=$db_user;	 //у phpsessid есть user, который есть в базе.
}
else
{echo '<h2 class="btn btn-lg btn-danger btn-block">Ошибка входа</h2>';}
}
if (isset($_POST['captcha']) and ($_POST['captcha']!='76890') ){
echo '<h2 class="btn btn-lg btn-danger btn-block">Неправильный код!</h2>';
}
$this->renderPage('login',$templ_array);
	?>