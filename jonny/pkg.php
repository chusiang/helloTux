<?php require("include/configure.php"); ?>

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
	//$btnReset = " 清除 ";



	switch ($lang) {

	case '正體中文':
		$btnInstall = " 安裝 ";
		//$btnReset = " 清除 ";

		echo "<span class=Comment># 目前只支援有預裝 AptURL 的 Ubuntu。</span> <br>";
		echo "<table class=table_dark>";
		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>套件</th> <th>敘述</th></tr>";

		# 列出所有套件資訊。
		while (list($pkg, $name, $info_en, $info_tw) = mysql_fetch_row($result)) {
			echo "<tr><td align=center><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$info_tw </td></tr>";
		}
		break;

	case 'English':
		$btnInstall = " Install ";
		//$btnReset = " Reset ";

		echo "<span class=Comment># Now, The site only support Ubuntu with AptURL.</span> <br>";
		echo "<table class=table_dark>";
		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>Package</th> <th>Info</th></tr>";

		# list all package record.
		while (list($pkg, $name, $info_en, $info_tw) = mysql_fetch_row($result)) {
			echo "<tr><td align=center><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$info_en </td></tr>";
		}
		break;

	default:
		break;
	}

	echo "
		</table>
		<br>
		<p align=center>
		<input type=button name=btnInstall id=btnInstall value=$btnInstall>
		</p>";

	//<input type=reset name=btnReset id=btnReset value=$btnReset>
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keyword" content="ubuntu, apt, apturl"/>
<meta name="author" content="凍仁翔 (Chu-Siang, Lai) - jonny (at) drx.tw, CSS: Violet - violet (at) drx.tw"/>
<title>helloTux</title>
<link href="include/violet.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="include/select-install.js"></script>
</head>

<body>

<div id="container">

	<!--頁首-->
	<div id="header">
		<div id="header_menu">
<?php
include 'frame_header.php';
?>
		</div>
	</div>

	<!--外框架圍繞內容-->
	<div id="wrapper">

		<div id="menu_main">
			<div class="menu_level">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li class="selected">Package</li>
					<li><a href="login.php">Login</a></li>
				</ul>
			</div>
		</div>

		<!--側邊欄-->
		<div id="sidebar">
<?php
include 'frame_sidebar.php';
?>
		</div>

		<!--內容-->
		<div id="content">

			<!--麵包屑-->
			<div class="breadcrumbs">
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<a href="index.php">首頁</a> / 套件清單 <br/><br/>
			</div>

			<!--段落-->
			<div class="paragraph">

				<h1>Package List</h1>

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

				<p>
				<form name="form_main" method="post" action="" enctype="text/plain">

<?php
fnLoad($lang);
?>

				</form>
				</p>
			</div>
		</div>

		<div id="footer">
<?php
include 'frame_footer.php';
?>
		</div>
	</div>
</div>

</body>
</html>
