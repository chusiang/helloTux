<?php
require_once('include/configure.php');
session_start();

$_SESSION['login_switch']=false;
$_SESSION['ID']="";
$_SESSION['passwd']="";

$ID ="";
$passwd="";

if ( isset($_POST["ID"]) && isset($_POST["passwd"]) ) {

	$ID =$_POST["ID"];
	$passwd=$_POST["passwd"];

	if ($ID !="" && $passwd!="" ) {
		$passwd = substr(md5($passwd),0,32);
		$sql_check_account = "SELECT id, password, level, nick FROM account WHERE id = '$ID' AND password = '$passwd'";
		$result = mysql_query($sql_check_account, $connection) or die(mysql_error());
		mysql_close($connection);

		if (mysql_num_rows($result) == 1) {
			$row_result = mysql_fetch_array($result);

			// - Checkout level.
			$temp=$row_result[2];

			//  - Administrator
			if ($temp == '0') {
				$_SESSION['login_switch'] = true;
				$_SESSION['ID'] = $ID;
				header("Location:http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php");
			}

			//  - users
			if ($temp == '1') {
				$_SESSION['login_switch'] = true;
				$_SESSION['ID'] = $ID;
				header("Location:http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php");
			}
		} else {
			echo "<script> alert('帳號或密碼錯誤') </script>";
		}
	}
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
<script type="text/javascript" src="include/md5.js"></script>
<!--
<script type="text/javascript">
function md5() {
	var hash = calcMD5(document.getElementById("pwd").value);
	alert(hash);
}

function sumbit() {
	var hash = calcMD5(document.getElementById("pwd").value);
	alert(hash);
}
</script>
-->
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
					<li><a href="pkg.php">Package</a></li>
					<li class="selected">Login</li>
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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<a href="index.php">首頁</a> / 登入 <br/><br/>
			</div>

			<!--段落-->
			<div class="paragraph">

				<h1>Login</h1>

				<p align='center'>
				<form id="form_adm" name="form_adm" method="post" action="login.php">

					<table align="center">
						<tr>
							<td>帳戶 <input type="text" name="ID" id="ID"></td>
						</tr>
						<tr>
							<td>密碼 <input type="password" name="passwd" id="passwd"></td>
						</tr>
						<tr>
							<td align="center">
								<!--
								<input type="text" name="passwd" id="passwd" value="">
								<input type="submit" name="btn_login" id="btn_login" value="登 入" onCliek="md5()">
								-->
								<input type="submit" name="btn_login" id="btn_login" value="登 入">
								<input type="reset" name="btn_cancel" id="btn_cancel" value="清 除">
							</td>
						</tr>
					</table>
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
