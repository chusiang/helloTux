<?php
require_once('../include/configure.php');
session_start();

# - 未登入時導回 login.php。
if($_SESSION["login_switch"] != true) {
	header("Location:../login.php");
}

# - 取得使用者 ID。
if (isset($_SESSION["ID"])) {
	$ID=$_SESSION["ID"];
}

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
$lang = "正體中文";
//$btnSearch = "搜尋";

//if (isset($_POST["lang"])){
//	$lang = $_POST["lang"]; 
//}

function fnLoad($lang){

	$btnInstall = " 安裝 ";
	$btnSearch = "搜尋";
	$btnCancel = " 取消 ";
	$btnAdd = " 新增 ";

	echo "<form name=search_record method=post action=>";

	switch ($lang) {

	case '正體中文':
		$btnSearch = "搜尋";
		$btnCancel = " 取消 ";
		$btnInstall = " 安裝 ";
		$btnAdd = " 新增 ";
		break;

	case 'English':
		$btnSearch = " Search ";
		$btnCancel = " Cancel ";
		$btnInstall = " Install ";
		$btnAdd = " Add ";
		break;

	default:
		break;
	}

	echo "<center>
		<input type=text name=search_txt id=search_txt>
		<input type=submit name=btnSearch id=btnSearch value=$btnSearch>
		<input type=button name=btnCancel id=btnCancel value=$btnCancel onClick=location.href='view.php'; />
</center>
		</form>";

	if (isset($_POST["search_txt"])) {
		$search_txt = $_POST["search_txt"];

		$sql_search = "select pid, pkg_name, name, info_en, info_tw from ubuntu where pkg_name like '%" . $search_txt . "%' and status = 1";
		$result_search = mysql_query($sql_search);

		# 列出所有套件資訊。
		echo "<br><hr>";
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

		echo "</table><br>
			<span class=Comment># 備註: </span>
			<input type=text name=note id=note size=40></textarea> <br><br>
			<center>
				<input type=submit name=btnAdd id=btnAdd value=$btnAdd>
				<input type=button name=btnCancel id=btnCancel value=$btnCancel onClick=location.href='view.php'; />
			</center>
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
<meta name="keyword" content="ubuntu, apt, apturl"/>
<meta name="author" content="凍仁翔 (Chu-Siang, Lai) - jonny (at) drx.tw, CSS: Violet - violet (at) drx.tw"/>
<link type="text/css" href="../include/violet.css" rel="stylesheet">
<script type="text/javascript" src="../include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../include/select-install.js"></script>
<title>helloTux</title>
</head>

<body>

<div id="container">

<!--頁首-->
<div id="header">
	<div id="header_menu">
<?php
include '../frame_header.php';
?>
	</div>
</div>

<!--外框架圍繞內容-->
<div id="wrapper">

	<div id="menu_main">
		<div class="menu_level">
			<ul>
				<li><a href="../index.php">Home</a></li>
				<li><a href="../pkg.php">Package</a></li>
				<li><a href="view.php">View</a></li>
				<li class="selected">Add</li>
			</ul>
		</div>
	</div>

	<!--側邊欄-->
	<div id="sidebar">
<?php
include '../frame_sidebar.php';
?>
	</div>

	<!--內容-->
	<div id="content">

		<!--麵包屑-->
		<div class="breadcrumbs">
			<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<a href="../index.php">首頁</a> / <a href="view.php">套件管理</a> / 新增套件 <br/><br/>
		</div>

		<!--段落-->
		<div class="paragraph">

			<h1>Add of Admin</h1>

			<!--
			<p>
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
			</p>
			-->

			<p>

<?php

fnLoad($lang);

mysql_close($connection);

?>
			</p>

		</div>
	</div>

	<div id="footer">
<?php
include '../frame_footer.php';
?>
	</div>
</div>
</div>

</body>
</html>
