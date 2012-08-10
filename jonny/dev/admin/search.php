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
$btnSearch = "搜尋";

if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

function fnLoad($lang){

	$btnInstall = " 安裝 ";
	$btnAdd = " 新增 ";
	$btnDel = " 刪除 ";

	echo "<form name=search_record method=post action=>";

	switch ($lang) {

	case '正體中文':
		$btnSearch = "搜尋";
		$btnInstall = " 安裝 ";
		$btnAdd = " 新增 ";
		$btnDel = " 刪除 ";

		echo "<input type=text name=search_txt id=search_txt>
			<input type=submit name=btnSearch id=btnSearch value=$btnSearch";

		break;

	case 'English':
		$btnSearch = " Search ";
		$btnInstall = " Install ";
		$btnAdd = " Add ";
		$btnDel = " Delete ";

		echo "<input type=text name=search_txt id=search_txt>
			<input type=submit name=btnSearch id=btnSearch value=$btnSearch";

		break;

	default:

		break;
	}

	echo "
		<div>
		<!--
		<input type=button name=btnInstall id=btnInstall value=$btnInstall>
		<input type=button name=btnDel id=btnDel value=$btnDel>
		-->
		</form>
		</div>";

	if (isset($_POST["search_txt"])) {
		$search_txt = $_POST["search_txt"];

		$sql_search = "select pid, pkg_name, name, info_en, info_tw from ubuntu where pkg_name like '%" . $search_txt . "%' and status = 1";
		$result_search = mysql_query($sql_search);

		# 列出所有套件資訊。
		echo "<br>";
		echo "<form name=add_record method=post action=record_add.php>";
		echo "<table class=table_dark>";
		echo "<tr><th></th> <th>套件</th> <th>Info</th> <th>敘述</th> </tr>";

		while (list($pid, $pkg, $name, $info_en, $info_tw) = mysql_fetch_row($result_search)) {
			echo "<tr>
				<td><input type=radio name=pid id=pid value=$pid></td>
				<td><a href=apt://$pkg>$name</a></td>
				<td>$info_en</td>
				<td>$info_tw</td>
				</tr>";
		}

		echo "</table>";


		echo "<br>

			<input type=submit name=btnAdd id=btnAdd value=$btnAdd> <br> <br>
			<span class=Comment># 備註: </span>

			<input type=text name=note id=note size=40></textarea> 

			<!--
			<textarea name=note id=note cols=30 rows=2></textarea> 
			-->
		</form>";
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

fnLoad($lang);

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
