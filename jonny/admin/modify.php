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

# - 取得 rid 及 rkey，若資料庫無符合的資料將導回 view.php。
if (isset($_GET["rid"]) && isset($_GET["rkey"])) {
	$rid = $_GET["rid"];
	$rkey = $_GET["rkey"];

	# - drop SQL Injection Attack.
	$sql_check = sprintf("SELECT rid, rkey FROM record WHERE rid = '%s' AND rkey = '%s'",
            mysql_real_escape_string($rid),
            mysql_real_escape_string($rkey));

	//$sql_check = "SELECT rid, rkey FROM record WHERE rid = '$rid' AND rkey = '$rkey'";
	$result_check = mysql_query($sql_check, $connection) or die(mysql_error());

	if (mysql_num_rows($result_check) == 0) {
		header("Location:http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php");
	}
}

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
$lang = "正體中文";
$btnSearch = "搜尋";

if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

# 若點選修改按鈕，則寫入資料庫。
if (isset($_POST["btnModify"])){
	$rid = $_POST["rid"];
	$rkey = $_POST["rkey"];
	$comment_modify = $_POST["comment_modify"];

	$sql_modify = "UPDATE `record` SET `comment` = '$comment_modify' WHERE `rid` = $rid and rkey = '$rkey'";
	$result_modify = mysql_query($sql_modify);

	//echo $comment_modify . "<br>" . $sql_modify;

	# 導回管理頁面。
	header("Location:http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php");
}


function fnLoad($lang, $sql_get){

	$result_get = mysql_query($sql_get) or die(mysql_error());
	$btnModify = "修改";
	$btnCancel = "取消";

	echo "<form name='modify_record' method='post' action=''>";
	echo "<table class='dark'>";

	switch ($lang) {

	case '正體中文':
		$btnModify = "修改";
		$btnCancel = "取消";

		# 列出所有套件資訊。
		echo "<tr>
			<th>套件</th>
			<th>敘述</th>
			<th>備註</th>
			</tr>";

		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_get)) {
			echo "<tr>
				<input type='hidden' name='rid' id='rid' value='$rid'>
				<input type='hidden' name='rkey' id='rkey' value='$rkey'>
				<td><a href='apt://$pkg'>$name</a></td>
				<td>$desc_tw</td>
				<td><textarea name='comment_modify' id='comment_modify' rows='5'>$comment</textarea></td>
				</tr>";
		}

		break;

	case 'English':
		$btnModify = "Modify";
		$btnCancel = "Cancel";

		# 列出所有套件資訊。
		echo "<tr>
			<th>Package</th>
			<th>Description</th>
			<th>Comment</th>
			</tr>";

		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_get)) {
			echo "<tr>
				<input type='hidden' name='rid' id='rid' value='$rid'>
				<input type='hidden' name='rkey' id='rkey' value='$rkey'>
				<td><a href='apt://$pkg'>$name</a></td>
				<td>$desc_en</td>
				<td><textarea name='comment_modify' id='comment_modify' rows='5'>$comment</textarea></td>
				</tr>";
		}

		break;

	default:
		break;
	}

	echo "</table>";
	echo "<br>
	<div align='center'>
		<button type='submit' name='btnModify' id='btnModify' class='btn'>$btnModify</button>
		<button type='button' name='btnCancel' id='btnCancel' class='btn' onClick=location.href='view.php';>$btnCancel</button>
	</div>
		</form>";
}

?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">
<head>
	<title>helloTux</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keyword" content="ubuntu, apt, apturl"/>
	<meta name="author" content="Developer: 凍仁翔 - jonny (at) drx.tw; Desgin: Violet - violet (at) drx.tw"/>
	<link href="../include/bootstrap.min.css" type="text/css" rel="stylesheet">
	<link href="../include/violet.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="../include/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../include/bootstrap.min.js"></script>

	<!--[if lt IE 9]>
		<script src="../include/html5shiv.js"></script>
	<![endif]-->

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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?> / <?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php>個人套件管理</a>"; ?> / 修改備註 <br/><br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>Modify of Admin</h1>

				<p>
				<div class="lang">
					<form name="lang_switch" method="post" action="">
						<select name="lang" size="1" style="width: 110px;">
							<option>----</option>
							<option>正體中文</option>
							<option>English</option>
						</select>
						<button type="submit" name="lang_switch" class="btn">切換語系</button>
					</form>
				</div>
				</p>

				<p>
<?php

# - drop SQL Injection Attack.
$sql_join = sprintf("select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where rid = '%s' and rkey = '%s'",
            mysql_real_escape_string($rid),
            mysql_real_escape_string($rkey));

fnLoad($lang, $sql_join);

//fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where rid = $rid and rkey = '$rkey'");

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
