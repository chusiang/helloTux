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

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
$lang = "正體中文";

if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

# - 取得使用者相關資料。
$sql_uid = "select uid, nick, mail, link from account where id = '$ID'";
$result_uid = mysql_query($sql_uid);
list($uid, $nick, $mail, $link) = mysql_fetch_row($result_uid);

# Display all record.
function fnLoad($lang, $sql_record){

	$result_record = mysql_query($sql_record);

	$btnInstall = " 安裝 ";
	$btnAdd = " 新增 ";
	$btnDel = " 刪除 ";

	echo "<table class=table_dark>";

	switch ($lang) {

	case '正體中文':
		$btnInstall = " 安裝 ";
		$btnAdd = " 新增 ";
		$btnDel = " 刪除 ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>套件</th> <th>敘述</th> <th>備註</th></tr>";

		# 列出所有套件資訊。
		while (list($rid, $uid, $pid, $note, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_record)) {
			echo "<tr><td><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$info_tw </td><td>$note</td></tr>";
		}

		break;

	case 'English':
		$btnInstall = " Install ";
		$btnAdd = " Add ";
		$btnDel = " Delete ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>Package</th> <th>Info</th> <th>Note</th></tr>";

		# list all package record.
		while (list($rid, $uid, $pid, $note, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_record)) {
			echo "<tr><td><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$info_en </td> <td>$note</td> </tr>";
		}

		break;

	default:

		break;
	}

	echo "
		</table>
		<div>
		<p>
		<form name=add_record method=post action=search.php>
		<input type=submit name=btnAdd id=btnAdd value=$btnAdd>
		<!--
		<input type=button name=btnInstall id=btnInstall value=$btnInstall>
		<input type=button name=btnDel id=btnDel value=$btnDel>
		-->
		</form>
		</p>
		</div>";

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

fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = $uid");

?>
<!--

# view, add, del of package list ......

-->

<div>
	<span class="Comment">&quot; -------------------------------------------------------------- </span><br>
	<span class="Comment">&quot; Now, you can manage your package list with helloTux, enjoy it. </span><br>
	<span class="Comment">&quot; -------------------------------------------------------------- </span><br>
</div>

</body>
<html>
