<?php
require("include/configure.php");

# - 取得使用者名稱(id)。
if (isset($_GET["id"])) {
	$id = $_GET["id"];
}

# - 取得使用者相關資料。
$sql_uid = "select uid, nick, mail, link from account where id = '$id'";
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
	$result_record = mysql_query($sql_record);

	$chkbox_click_all = " 全選/取消 ";
	$btnInstall = " 安裝 ";

	echo "<table class=table_dark>";

	switch ($lang) {

	case '正體中文':
		$btnInstall = " 安裝 ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>套件</th> <th>敘述</th> <th>備註</th></tr>";

		# 列出所有套件資訊。
		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_record)) {
			echo "<tr><td align=center><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$desc_tw </td><td>$comment</td></tr>";
		}

		break;

	case 'English':
		$btnInstall = " Install ";

		echo "<tr><th><input type=checkbox name=chkClick_all id=chkClick_all></th> <th>Package</th> <th>Description</th> <th>Comment</th></tr>";

		# list all package record.
		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_record)) {
			echo "<tr><td align=center><input name='chkbox[]' type='checkbox' value=$pkg></td> <td><a href=apt://$pkg>$name</a></td> <td>$desc_en </td> <td>$comment</td> </tr>";
		}

		break;

	default:

		break;
	}

	echo "
		</table>
		<br>
		<p align='center'>
		<input type=button name=btnInstall id=btnInstall value=$btnInstall>
		</p>";

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keyword" content="ubuntu, apt, apturl"/>
<meta name="author" content="Developer: 凍仁翔 - jonny (at) drx.tw; Desgin: Violet - violet (at) drx.tw"/>
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
					<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>Home</a>"; ?></li>
					<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/pkg.php>Package</a>"; ?></li>
					<li class="selected">Custom</li>
					<li><?php echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/login.php>Login</a>"; ?></li>
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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<a href="index.php">首頁</a> / 個人套件清單 <br/><br/>
			</div>

			<!--段落-->
			<div class="paragraph">

				<h1>Custom</h1>
				<h2><?php echo $id; ?>`s Package List</h2>

				<p>
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
				</p>

				<p>
				<form name="form_main" method="post" action="" enctype="text/plain">

<?php

# - 合併 record 及 ubuntu 兩表格。
fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = $uid");

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
