<?php
//Создает базу для начала использования


//"CREATE TABLE 'users' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT 0 ,'login' TEXT,'pass' TEXT,'mail' TEXT,'date' TEXT,'rights' TEXT, 'reserved4' TEXT)"
//"CREATE TABLE 'orders' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'code' TEXT, 'device' TEXT, 'problem' TEXT, 'price' TEXT, 'accept-date' TEXT, 'release-date' TEXT, 'notes' TEXT, 'reserved1' TEXT, 'reserved2' TEXT)"
//"CREATE TABLE 'sales' ('id' INTEGER PRIMARY KEY NOT NULL, 'code' TEXT, 'name' TEXT, 'date' TEXT, 'sale_price' TEXT, 'real_price' TEXT, 'reserved1' TEXT, 'reserved2' TEXT)"
//"CREATE TABLE 'stock' ('id' INTEGER PRIMARY KEY NOT NULL, 'code' TEXT, 'name' TEXT, 'qty' TEXT, 'date-in' TEXT, 'price-in' TEXT, 'r1' TEXT, 'r2' TEXT)"
//"CREATE TABLE 'cash-register' ('id' INTEGER PRIMARY KEY NOT NULL, 'balance' TEXT, 'date' TEXT, 'by-user' TEXT, 'notes' TEXT)"
//CREATE TABLE 'reparus_settings' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'name' TEXT, 'value' TEXT)   
class SQLiteConnection {
  private $pdo;
  public $path =  'reparus_db';
 
public function connect() {	
    if ($this->pdo == null) {
    $this->pdo = new \PDO("sqlite:" .$this->path);
	echo "Connected/created:".$this->path;
	echo "<br>";
}
}

public function createTables(){
/*INSERT INTO "users" ("login","pass","reserved1","reserved2","reserved3") VALUES ('root','A797040FDBC65726AA56D6A7BE3B5AF48CDB7528','pass sha1(sha1(root)-root)','','')*/

$stmt = $this->pdo->query("CREATE TABLE 'users' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT 0 ,'login' TEXT,'pass' TEXT,'mail' TEXT,'date' TEXT,'rights' TEXT, 'reserved4' TEXT)");
if ($stmt!=false)
{echo "Users table created.<br>";}
else
{echo "Users table not created or exists.<br>";}
$stmt = $this->pdo->query("CREATE TABLE 'orders' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'code' TEXT, 'device' TEXT, 'problem' TEXT, 'price' TEXT, 'accept-date' TEXT, 'release-date' TEXT, 'notes' TEXT, 'reserved1' TEXT, 'reserved2' TEXT)");
if ($stmt!=false)
{echo "Orders table created.<br>";}
else
{echo "Orders table not created or exists.<br>";}
$stmt = $this->pdo->query("CREATE TABLE 'sales' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'code' TEXT, 'name' TEXT, 'date' TEXT, 'sale_price' TEXT, 'real_price' TEXT, 'reserved1' TEXT, 'reserved2' TEXT)");
if ($stmt!=false)
{echo "Sales table created.<br>";}
else
{echo "Sales table not created or exists.<br>";}
$stmt = $this->pdo->query("CREATE TABLE 'stock' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'code' TEXT, 'name' TEXT, 'qty' TEXT, 'date-in' TEXT, 'price-in' TEXT, 'r1' TEXT, 'r2' TEXT)");
if ($stmt!=false)
{echo "Stock table created.<br>";}
else
{echo "Stock table not created or exists.<br>";}
$stmt = $this->pdo->query("CREATE TABLE 'cash-register' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'operation_balance' TEXT, 'balance_after' TEXT, 'date' TEXT, 'by-user' TEXT, 'notes' TEXT, 'order-sale-code' TEXT)");
if ($stmt!=false)
{echo "Cash-register table created.<br>";}
else
{echo "Cash-register table not created or exists.<br>";}
$stmt = $this->pdo->query("CREATE TABLE 'reparus_settings' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'name' TEXT, 'value' TEXT)");
if ($stmt!=false)
{echo "Reparus_settings table created.<br>";}
else
{echo "Reparus_settings table not created or exists.<br>";}
}

public function setDefaultAdmin(){
$stmt = $this->pdo->query('INSERT INTO "users" ("id", "login","pass","mail","date","rights","reserved4") VALUES (0, "root","A797040FDBC65726AA56D6A7BE3B5AF48CDB7528","pass sha1(sha1(root)-root)","","role-admin","")');
if ($stmt!=false)
{echo "User root:root (role-admin) is set.<br>";}
else
{echo "User root:root (role-admin)is not created or exists.<br>";}

}

}

$a = new SQLiteConnection();

$a->connect();
$a->createTables();
$a->setDefaultAdmin();

?>
