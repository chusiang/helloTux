<?php
require_once('../../include/configure.php');
session_start();

# - 未登入時導回 login.php。
if($_SESSION["login_switch"] != true) {
	header("Location:login.php");
}

# - 取得使用者 ID。
if (isset($_SESSION["ID"])) {
	$ID=$_SESSION["ID"];
}

# - 取得 rid 及 rkey，若資料庫無符合的資料將導回 view.php。
if (isset($_GET["rid"]) && isset($_GET["rkey"])) {
	$rid = $_GET["rid"];
	$rkey = $_GET["rkey"];

	$sql_check = "SELECT rid, rkey FROM record WHERE rid = '$rid' AND rkey = '$rkey'";
	$result_check = mysql_query($sql_check, $connection) or die(mysql_error());

	if (mysql_num_rows($result_check) == 0) {
		header("Location:view.php");
	}

}

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
$lang = "正體中文";
$btnSearch = "搜尋";

if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

# 若點選修改按鈕，則寫入資料庫。
if (isset($_POST["btnModify"])){
	$rid = $_POST["rid"];
	$rkey = $_POST["rkey"];
	$note_modify = $_POST["note_modify"];

	$sql_modify = "UPDATE `record` SET `note` = '$note_modify' WHERE `rid` = $rid and rkey = '$rkey'";
	$result_modify = mysql_query($sql_modify);

	//echo $note_modify . "<br>" . $sql_modify;

	# 導回管理頁面。
	header("Location:view.php");

}


function fnLoad($lang, $sql_get){

	$result_get = mysql_query($sql_get);
	$btnModify = " 修改 ";

	echo "<form name=modify_record method=post action=>";

	switch ($lang) {

	case '正體中文':
		$btnModify = " 修改 ";

		# 列出所有套件資訊。
		echo "<br>";
		echo "<table class=table_dark>";
		echo "<tr>
			<th>套件</th>
			<th>敘述</th>
			<th>備註</th>
			</tr>";

		while (list($rid, $uid, $pid, $note, $rkey, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_get)) {
			echo "<tr>
				<input type=hidden name=rid id=rid value=$rid>
				<input type=hidden name=rkey id=rkey value=$rkey>
				<td><a href=apt://$pkg>$name</a></td>
				<td>$info_tw</td>
				<td><textarea name=note_modify id=note_modify cols=30 rows=3>$note</textarea></td>
				</tr>";
		}

		echo "</table>";

		echo "<br>
			<input type=submit name=btnModify id=btnModify value=$btnModify> <br> <br>
		</form>";
		break;

	case 'English':
		$btnModify = " Modify ";

		# 列出所有套件資訊。
		echo "<br>";
		echo "<table class=table_dark>";
		echo "<tr>
			<th>Package</th>
			<th>Info</th>
			<th>Note</th>
			</tr>";

		while (list($rid, $uid, $pid, $note, $rkey, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_get)) {
			echo "<tr>
				<input type=hidden name=rid id=rid value=$rid>
				<input type=hidden name=rkey id=rkey value=$rkey>
				<td><a href=apt://$pkg>$name</a></td>
				<td>$info_en</td>
				<td><textarea name=note_modify id=note_modify cols=30 rows=3>$note</textarea></td>
				</tr>";
		}

		echo "</table>";
		echo "<br>
			<input type=submit name=btnModify id=btnModify value=$btnModify> <br> <br>
		</form>";
		break;

	default:
		break;
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" href="../../include/fu.css" rel="stylesheet">
<script type="text/javascript" src="../../include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../include/select-install.js"></script>

<title>helloTux dev</title>
</head>

<body>

<div class="lang">
	<form name="lang_switch" method="post" action="">
		<select name="lang" size="1">
			<option>----</option>
			<option>正體中文</option>
			<option>English</option>
		</select>
		<input type="submit" name="lang_switch" value="切換語系">
	</form>
</div>

<h1><span class="h1">= helloTux dev =</span></h1>

<h2><span class="h2">== Admin ==</span></h2>

<?php

fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where rid = $rid and rkey = '$rkey'");

mysql_close($connection);

?>

<br>

<div>
	<span class="Comment">&quot; -------------------------------------------------------------- </span><br>
	<span class="Comment">&quot; Now, you can manage your package list with helloTux, enjoy it. </span><br>
	<span class="Comment">&quot; -------------------------------------------------------------- </span><br>
</div>

</body>
<html>
