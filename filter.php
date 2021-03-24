<?php

class DataFilter{
	
public static function filterSQL($data){

$r = str_ireplace('"','',$data);
$r = str_ireplace("'",'',$r);
$r = str_ireplace("+",'',$r);
$r = str_ireplace("OR",'',$r);
$r = str_ireplace("AND",'',$r);//Неправильно And aND и т.п. пройдут
$r = str_ireplace("://",'',$r);
$r = str_ireplace("SELECT",'',$r);
//дописать
//использовать prepared statements

return $data;
}	
	
public static function filterXSS($data){


$r=htmlspecialchars($data);
$r=strip_tags($r);

//дописать

return $r;
}	
	
	
	
	

	
	
	
}


var_dump(DataFilter::filterXSS("'\<alert>"));