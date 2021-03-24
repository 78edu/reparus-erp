<?php

//Выводит заказы постранично
$db = new SQLiteConnection();
$db->connect();

$actions = $db->readSettings();
$r = $db->readOrders();
$s = count($r);
$i=0;

/*
for ($i=1;$i<5;$i++)
{echo "Действие".$i.": ".$actions["action".strval($i)]."<br>";}
	echo "<hr>";*/



	
for ($i=1;$i<$s;$i++)
{
	
	echo 'Заказ:'.strval($i);
	echo "| Код заказа:".$r[$i]["code"];
    echo "| Устройство:".$r[$i]["device"];
	echo "| Неисправность:".$r[$i]["problem"];
	echo "| Сроки:".$r[$i]["accept-date"]." - ".$r[$i]["release-date"];
	echo "| Стоимость клиенту:".$r[$i]["price"];
	echo "| Заметки:".$r[$i]["notes"];
	echo "| Запчасти:".$r[$i]["parts-code"];
	echo "<hr>";
}

?>