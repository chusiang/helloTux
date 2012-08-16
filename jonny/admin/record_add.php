<?php
require_once('../include/configure.php');
session_start();

# - Initialization
$ID="";
$pid="0";	# 若無傳遞 $pid 過來時將會等於 0。
$comment="";

# - 未登入時導回 login.php。
if($_SESSION["login_switch"] != true) {
	header("Location:https://" . $_SERVER['HTTP_HOST'] . "/login.php");
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

if (isset($_POST["comment"])){
	$comment = $_POST["comment"]; 
	//echo $comment;
}

if ($pid > 0) {
	# selected package.
	$rkey = sha1($uid . $pid);		# record password with sha1sum.

	$sql_insert = "INSERT INTO record VALUES (NULL, '$uid', '$pid', '$comment', '$rkey')";
	$result_insert = mysql_query($sql_insert, $connection) or die("錯誤訊息: " . mysql_error());

	//echo "UID = " . $uid . ", PID = " . $pid . ", Comment = " . $comment . "<br>";
	//echo $tmp . "<br>";
	//echo $rkey;
} else {
	# no select package.
	//echo "<script> alert('請選擇套件！') </script>";
}

mysql_close($connection);

# 導回管理頁面。
header("Location:http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php");

?>
