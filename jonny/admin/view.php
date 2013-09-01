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

if (isset($_SESSION["level"])) {
	$level=$_SESSION["level"];
}

# 若 $_POST["lang"] 存在，則將其值丟入 $lang。
$lang = "正體中文";

if (isset($_POST["lang"])){
	$lang = $_POST["lang"]; 
}

# - 取得使用者相關資料。

# - drop SQL Injection Attack.
$sql_uid = sprintf("select uid, nick, mail, link from account where id = '%s'",
            mysql_real_escape_string($ID));

//$sql_uid = "select uid, nick, mail, link from account where id = '$ID'";

$result_uid = mysql_query($sql_uid) or die(mysql_error());
list($uid, $nick, $mail, $link) = mysql_fetch_row($result_uid);

# Display all record.
function fnLoad($lang, $sql_record){

	$result_record = mysql_query($sql_record) or die(mysql_error());

	$btnInstall = "安裝";
	$btnAdd = "新增";
	$btnModify = "修改";
	$btnDel = "刪除";
	$aryRid = array();

	echo "<form name='del_record' method='post' action=''>";
	echo "<table class='dark'>";

	switch ($lang) {

	case '正體中文':
		$btnInstall = "安裝";
		$btnAdd = "新增";
		$btnModify = "修改";
		$btnDel = "刪除";

		echo "<tr><th><input type='checkbox' name='chkClick_all' id='chkClick_all'></th> <th>套件</th> <th>敘述</th> <th>備註</th></tr>";

		$i = 0;

		# 列出所有套件資訊。
		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_record)) {

			$aryRid[$i] = $rid;

			echo "<tr>
				<td align='center'><input name='chkbox[]' type='checkbox' value=$rid></td>
				<td><a href='apt://$pkg'>$name</a> <br /> <button type='button' name='btnModify' id='btnModify' class='btn' onClick=location.href='modify.php?rid=$rid&rkey=$rkey';>$btnModify</button> </td>
				<td>$desc_tw</td>
				<td>$comment</td>

				</tr>";

			//echo $aryRid[$i];		#debug
			$i ++;
		}

		//echo count($aryRid);		#debug
		break;

	case 'English':
		$btnInstall = "Install";
		$btnAdd = "Add";
		$btnModify = "Modify";
		$btnDel = "Delete";

		echo "<tr><th><input type='checkbox' name='chkClick_all' id='chkClick_all'></th> <th>Package</th> <th>Description</th> <th colspan=2>comment</th></tr>";

		$i = 0;

		# list all package record.
		while (list($rid, $uid, $pid, $comment, $rkey, $pid2, $pkg, $name, $status ,$desc_en, $desc_tw) = mysql_fetch_row($result_record)) {

			$aryRid[$i] = $rid;

			echo "<tr>
				<td align='center'><input name='chkbox[]' type='checkbox' value=$rid></td>
				<td><a href='apt://$pkg'>$name</a> <br /> <button type='button' name='btnModify' id='btnModify' class='btn' onClick=location.href='modify.php?rid=$rid&rkey=$rkey';>$btnModify</button> </td>
				<td>$desc_en</td>
				<td>$comment</td>
				</tr>";

			$i ++;
		}

		break;

	default:
		break;
	}


	echo "</table>";

	echo "<br>
			<div align='center'>
				<button type='button' name='btnAdd' id='btnAdd' class='btn' onClick=location.href='add.php'; />$btnAdd</button>
				<button type='submit' name='btnDel' id='btnDel' class='btn btn-danger'>$btnDel</button>
			</div>
		</form>";

	//<span class=Comment> ---- </span><br>

}

# - 當 chkbox 被選取(checked)，且按下(click) 刪除 按鈕時，會將其 rid 傳入 $value。
if(isset($_POST['chkbox'])) {
	foreach($_POST['chkbox'] as $key => $value){

		# 批次刪除
		if(isset($_POST['btnDel'])) {

			$sql_del = sprintf("DELETE FROM `record` WHERE `rid` = '%s'",
				mysql_real_escape_string($value));

			//$sql_del = "DELETE FROM `record` WHERE `rid` = $value";
			$result_del = mysql_query($sql_del) or die(mysql_error());
		}
	}
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
	<script type="text/javascript" src="../include/selectd-to-install-ubuntu.js"></script>

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
<?php
//if ($level == 0) {
//	echo "<li><a href=http://" . $_SERVER['HTTP_HOST'] . "/admin/adm.php>Admin</a></li>";
//}
?>
				<li id="selected">個人套件管理</li>
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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?> / 個人套件管理 <br/><br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>Private Package List Manage</h1>

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
$sql_join = sprintf("select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = '%s'",
            mysql_real_escape_string($uid));

fnLoad($lang, $sql_join);

//fnLoad($lang, "select a.*, b.* from record as a left join ubuntu as b on a.pid = b.pid where uid = $uid");

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
