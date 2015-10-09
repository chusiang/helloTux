<?php
require("include/configure.php");

# - 取得使用者名稱(id)。
if (isset($_GET["id"])) {
	$id = $_GET["id"];
}

# - 取得使用者相關資料。
#  - drop SQL Injection Attack.
$sql_uid = sprintf("select uid, nick, mail, link from account where id = '%s'",
            mysql_real_escape_string($id));

//$sql_uid = "select uid, nick, mail, link from account where id = '$id'";

$result_uid = mysql_query($sql_uid);
list($uid, $nick, $mail, $link) = mysql_fetch_row($result_uid);

function fnLoad_record() {
	while (list($rid, $uid, $pid, $comment, $pid2, $pkg, $name, $desc_en, $desc_tw) = mysql_fetch_row($result_record)) {
		echo "<input name='chkbox[]' type='checkbox' value=$pkg> <a href=apt://$pkg>$name</a> - $desc_tw <br>";
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
	$result_record = mysql_query($sql_record) or die(mysql_error());

	$chkbox_click_all = " 全選/取消 ";
	$btnInstall = " 安裝 ";

	echo "<table class='dark'>";

	switch ($lang) {

	case '正體中文':
		$btnInstall = " 安裝 ";

		echo "<tr><th><input type='checkbox' name='chkClick_all' id='chkClick_all'></th> <th>套件</th> <th>敘述</th> <th>備註</th></tr>";

		# 列出所有套件資訊。
		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_record)) {
			echo "<tr><td align='center'><input name='chkbox[]' type='checkbox' value='$pkg'></td> <td><a href='apt://$pkg'>$name</a></td> <td>$desc_tw </td><td>$comment</td></tr>";
		}

		break;

	case 'English':
		$btnInstall = "Install";

		echo "<tr><th><input type='checkbox' name='chkClick_all' id='chkClick_all'></th> <th>Package</th> <th>Description</th> <th>Comment</th></tr>";

		# list all package record.
		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_record)) {
			echo "<tr><td align='center'><input name='chkbox[]' type='checkbox' value='$pkg'></td> <td><a href='apt://$pkg'>$name</a></td> <td>$desc_en</td> <td>$comment</td> </tr>";
		}

		break;

	default:

		break;
	}

	echo "
		</table>
		<br>
		<p align='center'>
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
				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/pkg.php>套件清單</a>"; ?></li>
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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?> / 個人套件列表 <br/><br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>Package List of <?php echo $id; ?></h1>

				<p>
				<div class="lang">
					<form name="lang_switch" method="post" action="custom.php?id=<?php echo $id; ?>">

						<select name="lang" size="1" style="width: 110px;">
							<option>----</option>
							<option>正體中文</option>
							<option>English</option>
						</select>
						<input type="submit" name="lang_switch" value="切換語系" class="btn">
					</form>
				</div>
				</p>

				<p>
				<form name="form_main" method="post" action="" enctype="text/plain">

<?php

# - 合併 record 及 ubuntu 兩表格。

#  - drop SQL Injection Attack.
$sql_join = sprintf("select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = '%s'",
            mysql_real_escape_string($uid));

fnLoad($lang, $sql_join);

//fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = $uid");

?>
				</form>
				</p>

			</section>
		</div>

		<footer>
<?php
include 'frame_footer.php';
include 'ga.php';
?>
		</footer>
	</div>
</div>

</body>
</html>
