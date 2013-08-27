<?php
require_once('../include/configure.php');
session_start();

# - 未登入時導回 403.php。
if($_SESSION["login_switch"] != true) {
	header("Location:http://" . $_SERVER['HTTP_HOST'] . "/403.php");
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

		$sql_search = "select pid, pkg_name, name, desc_en, desc_tw from ubuntu where pkg_name like '%" . $search_txt . "%' and status = 1";
		$result_search = mysql_query($sql_search) or die(mysql_error());

		# 列出所有套件資訊。
		echo "<br />";
		echo "搜尋結果: <br />";
		echo "<form name=add_record method=post action=record_add.php>";
		echo "<table class='dark'>";
		echo "<tr><th></th> <th>套件</th> <th>Description</th> <th>敘述</th> </tr>";

		while (list($pid, $pkg, $name, $desc_en, $desc_tw) = mysql_fetch_row($result_search)) {
			echo "<tr>
				<td><input type=radio name=pid id=pid value=$pid></td>
				<td><a href=apt://$pkg>$name</a></td>
				<td>$desc_en</td>
				<td>$desc_tw</td>
				</tr>";
		}

		echo "</table><br>
			個人備註:
			<input type=text name=comment id=comment size=40></textarea> <br><br>
			<center>
			<input type=submit name=btnAdd id=btnAdd value=$btnAdd>
			<input type=button name=btnCancel id=btnCancel value=$btnCancel onClick=location.href='view.php'; />
			</center>
			<!--
			<textarea name=comment id=comment cols=30 rows=2></textarea> 
			-->
			</form>";
	}
}


?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keyword" content="ubuntu, apt, apturl"/>
	<meta name="author" content="凍仁翔 (Chu-Siang, Lai) - jonny (at) drx.tw, CSS: Violet - violet (at) drx.tw"/>
	<link type="text/css" href="../include/violet.css" rel="stylesheet">
	<script type="text/javascript" src="../include/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../include/selectd-to-install-ubuntu.js"></script>
	<title>helloTux</title>
</head>

<body>

<div id="container">

	<!--頁首-->
	<header>
		<nav id="top">
<?php
include '../frame_header.php';
?>
		</nav>
	</header>

	<!--外框架圍繞內容-->
	<div id="wrapper">

		<nav id="menu_h">
			<ul>

				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?></li>
				<li><a href="http://note.drx.tw" target="_blank">部落格</a></li>
				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/pkg.php>套件清單</a>"; ?></li>
				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php>個人套件管理</a>"; ?></li>
			</ul>
		</nav>

		<!--側邊欄-->
		<aside>
<?php
include '../frame_sidebar.php';
?>
		</aside>

		<!--內容-->
		<div id="content">

			<!--麵包屑-->
			<div id="breadcrumbs">
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?> / <?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php>個人套件管理</a>"; ?> / 新增套件 <br/><br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>Add Package with Search</h1>

				<p>
<?php

fnLoad($lang);

mysql_close($connection);

?>
				</p>

			</section>
		</div>

		<footer>
<?php
include '../frame_footer.php';
?>
		</footer>
	</div>
</div>

</body>
</html>
