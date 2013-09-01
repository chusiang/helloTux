<?php require("include/configure.php"); ?>

<?php

# Initialization.
$lang = "正體中文";

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

function fnLoad($lang){

	$sql = "select pkg_name, name, desc_en, desc_tw from ubuntu where status = 1 order by name asc";
	$result = mysql_query($sql) or die(mysql_error());
	$btnInstall = "安裝";


	switch ($lang) {

	case '正體中文':
		$btnInstall = "安裝";

		echo "<span class=Comment># 目前只支援有預裝 AptURL 的 Ubuntu。</span> <br>";
		echo "<table class=dark>";
		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>套件</th> <th>敘述</th></tr>";

		# 列出所有套件資訊。
		while (list($pkg, $name, $desc_en, $desc_tw) = mysql_fetch_row($result)) {
			echo "<tr><td align=center><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$desc_tw </td></tr>";
		}
		break;

	case 'English':
		$btnInstall = "Install";
		//$btnReset = " Reset ";

		echo "<span class=Comment># Now, The site only support Ubuntu with AptURL.</span> <br>";
		echo "<table class=dark>";
		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>Package</th> <th>Description</th></tr>";

		# list all package record.
		while (list($pkg, $name, $desc_en, $desc_tw) = mysql_fetch_row($result)) {
			echo "<tr><td align=center><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$desc_en </td></tr>";
		}
		break;

	default:
		break;
	}

	echo "
		</table>
		<br>
		<p align=center>
		<input type='button' name='btnInstall' id='btnInstall' value='$btnInstall' class='btn'>
		</p>";
}

?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">

<head>
	<title>helloTux</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keyword" content="ubuntu, apt, apturl"/>
	<meta name="author" content="Developer: 凍仁翔 - jonny (at) drx.tw; Desgin: Violet - violet (at) drx.tw"/>
	<link href="include/bootstrap.min.css" type="text/css" rel="stylesheet">
	<link href="include/violet.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="include/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="include/bootstrap.min.js"></script>
	<script type="text/javascript" src="include/selectd-to-install-ubuntu.js"></script>

	<!--[if lt IE 9]>
		<script src="include/html5shiv.js"></script>
	<![endif]-->

</head>

<body>

<div id="container">

	<!--頁首-->
	<header>
		<nav id="top">
<?php
include 'frame_header.php';
?>
		</nav>
	</header>

	<!--外框架圍繞內容-->
	<div id="wrapper">

		<nav id="menu_h">
			<ul>
				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?></li>
				<li><a href="http://note.drx.tw" target="_blank">部落格</a></li>
				<li id="selected">套件清單</li>
			</ul>
		</nav>

		<!--側邊欄-->
		<aside>
<?php
include 'frame_sidebar.php';
?>
		</aside>

		<!--內容-->
		<div id="content">

			<!--麵包屑-->
			<div id="breadcrumbs">
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?> / 套件清單 <br/><br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>Package List</h1>

				<p>
				<div class="lang">
					<form name="lang_switch" method="post" action="">
						<select name="lang" size="1" style="width: 110px;">
							<option>----</option>
							<option>正體中文</option>
							<option>English</option>
						</select>
						<br />
						<input type="submit" name="lang_switch" value="切換語系" class="btn">
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
			</section>
		</div>

		<footer>
<?php
include 'frame_footer.php';
?>
		</footer>
	</div>
</div>

</body>
</html>
