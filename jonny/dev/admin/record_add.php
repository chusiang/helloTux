<?php
require_once('../../include/configure.php');
session_start();

# - Initialization
$ID="";
$pid="";
$note="";

# - 未登入時導回 login.php。
if($_SESSION["login_switch"] != true) {
	header("Location:login.php");
}

# - 取得使用者 ID。
if (isset($_SESSION["ID"])) {
	$ID=$_SESSION["ID"];
}

# - 取得使用者相關資料。
$sql_uid = "select uid from account where id = '$ID'";
$result_uid = mysql_query($sql_uid);
list($uid) = mysql_fetch_row($result_uid);
//echo $uid . "<br>";

if (isset($_POST["pid"])){
	$pid = $_POST["pid"]; 
	//echo $pid . "<br>";
}

if (isset($_POST["note"])){
	$note = $_POST["note"]; 
	//echo $note;
}

$sql_insert = "INSERT INTO record VALUES (NULL, '$uid', '$pid', '$note')";
$result_insert = mysql_query($sql_insert, $connection) or die("錯誤訊息: " . mysql_error());

header("Location:adm.php");

?>
