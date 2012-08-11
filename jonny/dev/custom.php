<?php
require("../include/configure.php");

# - 取得使用者名稱(id)。
if (isset($_GET["id"])) {
	$id = $_GET["id"];
}

# - 取得使用者相關資料。
$sql_uid = "select uid, nick, mail, link from account where id = '$id'";
$result_uid = mysql_query($sql_uid);
list($uid, $nick, $mail, $link) = mysql_fetch_row($result_uid);

function fnLoad_record() {
	while (list($rid, $uid, $pid, $note, $pid2, $pkg, $name, $info_en, $info_tw) = mysql_fetch_row($result_record)) {
		echo "<input name='chkbox[]' type='checkbox' value=$pkg> <a href=apt://$pkg>$name</a> - $info_tw <br>";
	}
}

# Initialization.
$lang = "正體中文";

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

function fnLoad($lang, $sql){

	$sql_record = $sql;
	$result_record = mysql_query($sql_record);

	$chkbox_click_all = " 全選/取消 ";
	$btnInstall = " 安裝 ";

	echo "<table class=table_dark>";

	switch ($lang) {

	case '正體中文':
		$btnInstall = " 安裝 ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>套件</th> <th>敘述</th> <th>備註</th></tr>";

		# 列出所有套件資訊。
		while (list($rid, $uid, $pid, $note, $rkey, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_record)) {
			echo "<tr><td><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$info_tw </td><td>$note</td></tr>";
		}

		break;

	case 'English':
		$btnInstall = " Install ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>Package</th> <th>Info</th> <th>Note</th></tr>";

		# list all package record.
		while (list($rid, $uid, $pid, $note, $rkey, $pid2, $pkg, $name, $status ,$info_en, $info_tw) = mysql_fetch_row($result_record)) {
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
		<input type=button name=btnInstall id=btnInstall value=$btnInstall>
		</p>
		</div>";

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" href="../include/fu.css" rel="stylesheet">
<script type="text/javascript" src="../include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../include/select-install.js"></script>

<title>helloTux dev</title>
</head>

<body>

<div class="lang">
<form name="lang_switch" method="post" action="custom.php?id=<?php echo $id; ?>">

		<select name="lang" size="1">
			<option>----</option>
			<option>正體中文</option>
			<option>English</option>
		</select>
		<input type="submit" name="lang_switch" value="切換語系">
	</form>
</div>

<h1><span class="h1">= helloTux dev =</span></h1>

<h2><span class="h2">== <?php echo $id; ?>`s Package List ==</span></h2>

<div>
	<span class="Comment"># 目前只支援有預裝 AptURL 的 Ubuntu。</span> <br>
<div>

<form name="form_main" method="post" action="" enctype="text/plain">

	<div>

<?php

# - 合併 record 及 ubuntu 兩表格。
fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = $uid");

?>
	</div>

	<!--
	<div>
		<span class="Comment">&quot; ---------------------------------- </span><br>
		<input name="chkboxClickAll" id="chkboxClickAll" type="checkbox"> 全選/取消 <br><br>
		<input name="btnInstall" id="btnInstall" type="button" value="&nbsp;安裝&nbsp;">
	</div>
-->
</form>

<div>
	<span class="Comment">&quot; ---------------------------------- </span><br>
	<span class="Comment">&quot; <?php echo $nick; ?> </span><br>
	<span class="Comment">&quot; <a href=<?php echo $link; ?> target="_blank"><?php echo $link; ?></a></span><br>
	<span class="Comment">&quot; ---------------------------------- </span><br>
</div>

</body>
<html>
