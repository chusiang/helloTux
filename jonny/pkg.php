<?php require("../include/configure.php"); ?>

<?php

# Initialization.
$lang = "正體中文";

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

function fnLoad($lang){

	$sql = "select pkg_name, name, info_en, info_tw from ubuntu where status = 1 order by name asc";
	$result = mysql_query($sql);
	$btnInstall = " 安裝 ";

	echo "<table class=table_dark>";

	switch ($lang) {

	case '正體中文':
		$btnInstall = " 安裝 ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>套件</th> <th>敘述</th></tr>";

		# 列出所有套件資訊。
		while (list($pkg, $name, $info_en, $info_tw) = mysql_fetch_row($result)) {
			echo "<tr><td><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$info_tw </td></tr>";
		}
		break;

	case 'English':
		$btnInstall = " Install ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>Package</th> <th>Info</th></tr>";

		# list all package record.
		while (list($pkg, $name, $info_en, $info_tw) = mysql_fetch_row($result)) {
			echo "<tr><td><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$info_en </td></tr>";
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
	<form name="lang_switch" method="post" action="index.php">

		<select name="lang" size="1">
			<option>----</option>
			<option>正體中文</option>
			<option>English</option>
		</select>
		<input type="submit" name="lang_switch" value="切換語系">
	</form>
</div>

<h1><span class="h1">= helloTux dev =</span></h1>

<div>
	<span class="Comment"># 目前只支援有預裝 AptURL 的 Ubuntu。</span> <br>
<div>

<div>
	<form name="form_main" method="post" action="" enctype="text/plain">

<?php
fnLoad($lang);
?>

	</form>
</div>

<div>
	<span class="Comment">&quot; ---------------------------------- </span><br>
	<span class="Comment">&quot; 凍仁翔 (Chu-Siang, Lai)</span><br>
	<span class="Comment">&quot; <a href="https://github.com/chusaing/helloTux" target="_blank">https://github.com/chusaing/helloTux</a></span><br>
	<span class="Comment">&quot; ---------------------------------- </span><br>
</div>

</body>
<html>
