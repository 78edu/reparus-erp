<?php




//Вызывается из класса controller
$erm_request = $this->parameters;

if (isset($_SESSION["user"]))
		{$su=$_SESSION['user']; echo "<hr> Hello,"; var_dump($su);
			
			
			
if (($erm_request[0]=="erm") and (isset(($erm_request[1]))) and ($erm_request[1]=="orders"))
{
//Выводит 4 кнопки действия, 10 последних заказов
$db = new SQLiteConnection();
$db->connect();

$actions = $db->readSettings();


echo "<hr>";
if (isset($_POST['delete-order-id']))
{
echo "isset";
$a=	intval($_POST['delete-order-id']);
var_dump($a);
$res = $db->deleteOrder(	$a);
	
var_dump($res);
}
if (isset($_POST['order-action']))
{
echo "order action is set:";
if($_POST['order-action']=="new")
{
echo "new<br>";	
$safe=$db->xssSafe($_POST);
$db->addOrder($safe);	
}
if($_POST['order-action']=="edit")
{
echo "edit<br>";
$safe=$db->xssSafe($_POST);
$db->editOrder($safe);		
}
}

echo "<hr>";
echo "<br>";
echo "Все действия с заказами - добавление, удаление, изменение: ID при создании игнорируется, изменение по id";
 echo '<form action="/erm/orders/" method="post" >
        <label for="delete-order-id" class="">ID в базе</label>
        <input type="text" name="delete-order-id"  placeholder="ID в базе" required>
        <button type="submit">Удалить</button>
      </form><br>';
	  
	  
$b=$db->returnOrdersArray();	  
//var_dump($b);
$cb=count($b);



echo '<form action="/erm/orders/" method="post" >';
foreach ($b as $key => $value) {
	
$label=$b[$key][0];
$name=$b[$key][1];
echo "<label for='$name' class=''>$label</label>
<input type='text' name='$name'  placeholder='$label' required>
<br>\n";
	
}	 

		echo '<br><input type="radio" checked id="new-order"
     name="order-action" value="new" required>
    <label for="new-order">Новый заказ</label>

    <input type="radio" id="edit-order"
     name="order-action" value="edit" required>
    <label for="edit-order">Редактировать</label>';
		
	echo 	'
        <button type="submit">Отправить</button>
      </form><br>';
 
echo "<hr>";
$i=0;
/*
echo "Быстрые ссылки:<br>";
for ($i=1;$i<5;$i++)
{echo "Действие".$i.": ".$actions["action".strval($i)]."<br>";}
	echo "<hr>";*/
$r=0;	
if (isset($r))
{	
$r = $db->readOrders();
$s = count($r);	
	
for ($i=0;$i<$s;$i++)
{
	
	echo 'Заказ:'.$r[$i]["id"];
	echo "| Код заказа:".$r[$i]["code"];
    echo "| Устройство:".$r[$i]["device"];
	echo "| Неисправность:".$r[$i]["problem"];
	echo "| Сроки: с:".$r[$i]["accept_date"]." до: ".$r[$i]["release_date"];
	echo "| Стоимость клиенту:".$r[$i]["price"];
	echo "| Заметки:".$r[$i]["notes"];
	echo "| Запчасти:".$r[$i]["parts_code"];
	echo "<hr>";
}
}}
		}else{echo "<br>You're not logged in"; 
/* echo '<head>
<meta http-equiv="refresh" content="1;URL=/login/" />
</head> ';*/
}//if session user isset


echo "<hr> Route request:  ";
var_dump($erm_request);
var_dump($db->prepareQueryFromArray2($b));
echo "<hr>";


?>