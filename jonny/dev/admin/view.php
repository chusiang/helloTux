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
	$btnModify = " 修改 ";
	$btnDel = " 刪除 ";
	$aryRid = array();

	echo "<form name=del_record method=post action=>";
	echo "<table class=table_dark>";

	switch ($lang) {

	case '正體中文':
		$btnInstall = " 安裝 ";
		$btnAdd = " 新增 ";
		$btnModify = " 修改 ";
		$btnDel = " 刪除 ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>套件</th> <th>敘述</th> <th colspan=2>備註</th></tr>";

		$i = 0;

		# 列出所有套件資訊。
		while (list($rid, $uid, $pid, $note, $rkey, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_record)) {

			$aryRid[$i] = $rid;

			echo "<tr>
				<td><input name='chkbox[]' type='checkbox' value=$rid></td>
				<td><a href=apt://$pkg>$name</a></td>
				<td>$info_tw</td>
				<td>$note</td>
				<td><input type=button name=btnModify id=btnModify value=$btnModify onClick=location.href='modify.php?rid=$rid&rkey=$rkey'; /></td>
		
				</tr>";

			//echo $aryRid[$i];		#debug
			$i ++;
		}

		//echo count($aryRid);		#debug
		break;

	case 'English':
		$btnInstall = " Install ";
		$btnAdd = " Add ";
		$btnModify = " Modify ";
		$btnDel = " Delete ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>Package</th> <th>Info</th> <th>Note</th></tr>";

		$i = 0;

		# list all package record.
		while (list($rid, $uid, $pid, $note, $rkey, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_record)) {

			$aryRid[$i] = $rid;

			echo "<tr>
				<td><input name='chkbox[]' type='checkbox' value=$rid></td>
				<td><a href=apt://$pkg>$name</a></td>
				<td>$info_en</td>
				<td>$note</td>
				<td><input type=button name=btnModify id=btnModify value=$btnModify onClick=location.href='modify.php?rid=$rid&rkey=$rkey'; /></td>
				</tr>";

			$i ++;
		}

		break;

	default:

		break;
	}


	echo "</table>";

	echo "<br>
		<input type=submit name=btnDel id=btnDel value=$btnDel> <br>
		<span class=Comment> ---- </span><br>
		<input type=button name=btnAdd id=btnAdd value=$btnAdd onClick=location.href='search.php'; />
		</form>";

}

# - 當 chkbox 被選取(checked)，且按下(click) 刪除 按鈕時，會將其 rid 傳入 $value。
if(isset($_POST['chkbox'])) {
	foreach($_POST['chkbox'] as $key => $value){

		# 批次刪除
		if(isset($_POST['btnDel'])) {
			$sql_del = "DELETE FROM `record` WHERE `rid` = $value";
			$result_del = mysql_query($sql_del) or die(mysql_error());
		}
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

fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = $uid");

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
