<?php
/* Config DB */
$config = array(
	"db_host" => "localhost", // HOST ของเซิฟเวอร์ฐานข้อมูล
	"db_db" => "example_db", // ชื่อฐานข้อมูล
	"db_user" => "root", // ชื่อผู้ใช้
	"db_pass" => "", // รหัสผ่าน
);

/* Function DB Connect */
try{
	$new_pdo = new PDO("mysql:charset=UTF8;host=".$config['db_host'].";dbname=".$config['db_db'].";", $config['db_user'], $config['db_pass']);

	function query($sql, $array = array()) {
	    global $new_pdo;
	    $q = $new_pdo->prepare($sql);
	    $q->execute($array);
	    return $q;
	}
}
catch(PDOException $e){
	die($e->getMessage());
}
?>



วิธีการใช้งาน
การเรียกใช้ข้อมูลบรรทัดเดียว
query("SQL COMMAND", array(ITEM))->fetch(); การเรียกข้อมูลบรรทัดเดียวเป็น Array 1 ชั้น
ยกตัวอย่างเช่น
$db = query("SELECT * FROM accounts WHERE user = ? AND pass = ?", array($user, $pass))->fetch();
การเรียกใช้ Field เพียงแค่ $db["user"];

การเรียกใช้ข้อมูลจำนวนมาก
query("SQL COMMAND", array(ITEM))->fetchAll(); การเรียกข้อมูลหลายบรรทัดเป็น Array 2 ชั้น
ยกตัวอย่างเช่น
$db = query("SELECT * FROM information_tb")->fetchAll();
จะเห็นได้ว่าไม่จำเป็นต้องมี parameter array() ตามก็ได้ถ้าหาข้อมูลไม่มีการกำหนดเป็นตัวแปร
วิธีการเรียกใช้งานอาจจะทำได้หลายแบบ แต่ขอเสนอวิธีที่ง่ายคือ
foreach() เป็น Function Loop ที่จะทำงานจำนวนครั้งเท่าจำนวนข้อมูลของตัวแปร
วิธีการใช้งาน foreach()

foreach($db as $data) {
	echo $data["num"];
	echo $data["info"];
}

ตัวแปร $data จะคล้ายๆกับการเรียกข้อมูลแบบที่ 1 เพียงแค่เราเก็บข้อมูลมาอยู่ในตัวแปร $db เพียงตัวเดียว
