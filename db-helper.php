<?php
//Работает с базой



class SQLiteConnection {
  private $pdo;
  public $path =  'reparus_db';
 
public function connect() {	
    if ($this->pdo == null) {
    $this->pdo = new PDO("sqlite:" .$this->path);
	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected/created:".$this->path;
	//echo "<br>";
}
}

public function setDefaultAdmin(){
/*INSERT INTO "users" ("login","pass","reserved1","reserved2","reserved3") VALUES ('root','A797040FDBC65726AA56D6A7BE3B5AF48CDB7528','pass sha1(sha1(root)-root)','','')*/
}

public function validateLogin(){  
//
}

public function returnOrdersArray(){
// html string, name in form, db column	
//$a =  ["id","code","device","problem","price","accept-date","release-date","notes","parts-code"]	;
$a["id"]=["ID в базе","order_id","id"];
$a["code"]=["Код заказа","code","code"];
$a["status"]=["Статус заказа","status","status"];
$a["device"]=["Устройство","device","device"];
$a["problem"]=["Неисправность","problem","problem"];
$a["price"]=["Стоимость ремонта","price","price"];
$a["accept_date"]=["Дата приема","accept_date","accept_date"];
$a["release_date"]=["Дата выдачи","release_date","release_date"];
$a["notes"]=["Примечания","notes","notes"];
$a["parts_code"]=["Коды запчастей","parts_code","parts_code"];
return($a);	
}

public function prepareQueryFromArray($array){
$b=$array;
$cb=count($b); 
$ci=0;
$q="INSERT INTO 'orders' ";


/*$q="INSERT INTO 'orders' (";

foreach ($b as $key => $value) {
$col=$b[$key][2];

if($ci===($cb-1))	
{$q=$q."'$col'";}
else
{$q=$q."'$col',";}
$ci++;
}
$q=$q.") VALUES (";*/

$q=$q." VALUES (";
$ci=0;
foreach ($b as $key => $value) {
$name=$b[$key][2]; //имя для форм	
//$d=$_POST[$name]; вариант для запроса как есть
$d=$name;
if($ci===($cb-1))
{$q=$q.":$d";}
else
{$q=$q.":$d,";}
$ci++;

	
}

$q=$q." )";

//var_dump($q);	
return $q;	
	
}


public function prepareQueryFromArray2($array){
	//todo временная функция, объединить с первой, готовит запросы для pdo::prepare
$b=$array;
$cb=count($b); 
$ci=0;
$q="UPDATE 'orders' SET ";


//$q=$q." VALUES (";
$ci=0;
foreach ($b as $key => $value) {
$name=$b[$key][1]; //имя из формы-post	
$col=$b[$key][2]; //поял базы	
//$d=$_POST[$name]; вариант для запроса как есть
$d=$col;
if($ci===($cb-1))
{$q=$q." $d=:$name";}
else
{$q=$q."$d=:$name, ";}
$ci++;

	
}

$q=$q." WHERE id=:order_id";

var_dump($q);	
return $q;	
	
}

public function deleteOrder($del_id){

//echo($del_id);
$dbh = $this->pdo;
$stmt = $dbh->prepare("DELETE FROM 'orders' WHERE id=:del_id");
$stmt->bindParam(':del_id', $del_id, PDO::PARAM_INT);

var_dump($stmt->execute());

$check = $stmt->fetch();
var_dump($check);
echo "Fetch data:";
var_dump($stmt->fetchAll());

}
public function addOrder($post_array){

$a=$post_array; //массив с POST с числами
$b=self::returnOrdersArray(); //guide-массив
$q=self::prepareQueryFromArray($b);

//$q="INSERT INTO 'orders' ('id','code','device','problem','price','accept-date','release-date','notes','parts-code','status') VALUES ('0','TST','Testphone','Разбит экран','10000','01.01.2021','02.02.2022','Заметки Синий корпус','SCR1, BAT1','active')";
//$q="INSERT INTO 'orders' ('id','code','status','device','problem','price','accept-date','release-date','notes','parts-code') VALUES ( :order-id, :code, :status, :device, :problem, :price, :accept-date, :release-date, :notes, :parts-code )";
//$q="INSERT INTO 'orders' VALUES (:id,:code,:status,:device,:problem,:price,:accept_date,:release_date,:notes,:parts_code )" ;
$dbh = $this->pdo;

var_dump($q);
echo "<hr>";
$stmt = $dbh->prepare($q);


echo "<br>";
foreach ($b as $key => $value) {
$name=$b[$key][1]; //имя для форм	
$col=$b[$key][2]; //имя для базы
$val=$post_array[$name];
//to-do - добавить проверку что все поля есть!!!
	
echo "<br>$col : $name : $val ";
///////
$rr=0;
if ($col=="id"){$val=NULL;}
var_dump($stmt->bindValue(":$col", $val ,PDO::PARAM_STR));
}
echo "<hr>";
var_dump($stmt);
var_dump($stmt->execute());

$check = $stmt->fetch();
var_dump($check);
echo "Add :: Затронуто столбцов:";
var_dump($stmt->rowCount());
}

public function editOrder($post_array){

$a=$post_array; //массив с POST с числами
$b=self::returnOrdersArray(); //guide-массив
$q=self::prepareQueryFromArray2($b);
$dbh = $this->pdo;

var_dump($q);
echo "<hr>";
$stmt = $dbh->prepare($q);

echo "<br>";

$ci=0;
foreach ($b as $key => $value) {
$name=$b[$key][1]; //имя  форм	
$col=$b[$key][2]; //имя столбцов
$val=$post_array[$name];
//to-do - добавить проверку что все поля есть!!!

//echo $_POST['order_id'];$_POST['order_id'];
//var_dump($stmt->bindValue(":order_id", $_POST['order_id'] ,PDO::PARAM_STR));

if ($ci>-1)
{	
echo "<br>$col=:$name $col=$val ";
///////
$rr=0;
//if ($col=="id"){$val=NULL;}

var_dump($stmt->bindValue(":$name", $val ,PDO::PARAM_STR));
}
$ci++;
}	

echo "<hr>";
var_dump($stmt);
var_dump($stmt->execute());

$check = $stmt->fetch();
var_dump($check);
echo "Edit :: Затронуто столбцов:";
var_dump($stmt->rowCount());
}



public function readSettings() {

    $stmt = $this->pdo->query('SELECT * FROM "reparus_settings" WHERE 1');
	//var_dump($stmt);
    $settings = [];
while ($row = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {

$size = count($row);

for ($i=0;$i<$size;$i++)
{
$settings = $settings +[$row[$i]["name"]=>$row[$i]["value"]];
}
}
return $settings;
}

public function readOrders() {

    $stmt = $this->pdo->query('SELECT * FROM "orders" WHERE 1');
	//TODO - добавить ограничения чтобы не читать огромное число записей, которые не будут нужны
	//var_dump($stmt);
    $orders = [];
while ($row = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {

/*
$size = count($row);
var_dump($size);
echo "<hr>";

var_dump($row);
echo "<hr>";

for ($i=0;$i<$size;$i++)
{
$order = [ 'id'=>$row[$i]["id"],"code"=>$row[$i]["code"],"device"=>$row[$i]["device"],"problem"=>$row[$i]["problem"],"price"=>$row[$i]["price"],"accept-date"=>$row[$i]["accept-date"],"release-date"=>$row[$i]["release-date"],"notes"=>$row[$i]["notes"],"parts-code"=>$row[$i]["parts-code"]];
$orders = [$i=>$order];
}
}
var_dump($orders);*/
//var_dump($stmt);
//echo "stmt-----";
return $row;
}	
}


public function getUserByLogin( $user_login ) {
	$user_login=strip_tags($user_login);
	$user_login=stripslashes($user_login);
	//todo фильтрация от sql inj
		
	//'SELECT * FROM "users" WHERE "login"="root"'
    $stmt = $this->pdo->query('SELECT * FROM "users" WHERE "login"="'.$user_login.'"');
    $user = [];
while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
$user = ['id' => $row['id'],'login' => $row['login'],'pass' => $row['pass'],'rights' => $row['rights']];}
return $user;
}


public function xssSafe( $post){  //, $guide ) {
	
	
	/*
	//возвращает массив аналогичный _POST, но без лишних ключей  и без xss.
	//Получим все валидные ключи для _POST из guide массива
	$g=$guide;
	$ci=0;
	foreach ($g as $key=>$value){
	$t1=$g[$key][1];
	$t2[$ci]=$t1;
	$ci++;
	}
	//$t2 = все ключи из guide
	$p=$post;
	$cj=count($t2);
for ($cc=0;$cc<$cj;$cc++){
	$valid_key=$t2[$cc];
if (array_key_exists($valid_key,$p))
{
	
	$t3[$valid_key]=htmlspecialchars($p[$valid_key]);
	
	}
}	
	*/
	$p=$post;
	foreach ($p as $key=>$value){
	$s1=htmlspecialchars($value);
	$s2=strip_tags($s1);
		
	$t3[$key]=$s2;
	
	
	}
	
	
	
	
	
	
if (isset($t3)){echo "XSS TEST";var_dump($t3);return($t3);}
else
{return NULL;}
}


public function registerUser( $user_login_reg, $user_pass_reg) {
	$user_login_reg=strip_tags($user_login_reg);
	$user_login_reg=stripslashes($user_login_reg);
	$user_pass_reg=strip_tags($user_pass_reg);
	$user_pass_reg=stripslashes($user_pass_reg);
	//todo фильтрация от sql inj
	$pass_hash_reg = strtoupper(sha1(strtoupper(sha1($user_pass_reg)).'-'.$user_pass_reg));
	echo 'Pass hash:'.$pass_hash_reg.'<br>';
	//Получаем пользователя и проверяем на повтор
	//Если нашли - выход с return
	$check_user=$this->getUserByLogin( $user_login_reg );	
	var_dump($check_user);
	
	if ($check_user!=NULL)
	{echo '<br>User exists'; return false;}
	else
	{
//'SELECT * FROM "users" WHERE "login"="root"'
        $stmt = $this->pdo->query('INSERT INTO "users" ("login","pass","mail","date","rights") VALUES ("'.$user_login_reg.'","'.$pass_hash_reg.'","","","role-user")');
	
		return true;
	}

    }	


 }

