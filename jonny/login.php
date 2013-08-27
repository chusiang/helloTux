<?php
require_once('include/configure.php');
session_start();

$_SESSION['login_switch']=false;
$_SESSION['ID']="";
$_SESSION['passwd']="";
$_SESSION['level']="";

$ID ="";
$passwd="";

if ( isset($_POST["ID"]) && isset($_POST["passwd"]) ) {

	$ID =$_POST["ID"];
	$passwd=$_POST["passwd"];

	if ($ID !="" && $passwd!="" ) {
		$passwd = substr(md5($passwd),0,32);

		# - drop SQL Injection Attack.
		//$sql_check_account = "SELECT id, password, level, nick FROM account WHERE id = '{$ID}' AND password = '{$passwd}'";
		$sql_check_account = sprintf("SELECT id, password, level, nick FROM account WHERE id = '%s' AND password = '%s'",
            mysql_real_escape_string($ID),
            mysql_real_escape_string($passwd));

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
				$_SESSION['level'] = $level;
				header("Location:http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php");
			}

			//  - users
			if ($temp == '1') {
				$_SESSION['login_switch'] = true;
				$_SESSION['ID'] = $ID;
				$_SESSION['level'] = $level;
				header("Location:http://" . $_SERVER['HTTP_HOST'] . "/admin/view.php");
			}
		} else {
			echo "<script> alert('帳號或密碼錯誤') </script>";
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
	<link href="include/violet.css" type="text/css" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="include/html5shiv.js"></script>
	<![endif]-->

	<!--
	<script type="text/javascript" src="include/md5.js"></script>
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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?> / 登入 <br/><br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>Login</h1>

				<div align="center">
					<form id="form_adm" name="form_adm" method="post" action="login.php">

						帳戶 <input type="text" name="ID" id="ID"> <br />
						密碼 <input type="password" name="passwd" id="passwd"> <br /> <br />
						<!--
							<input type="text" name="passwd" id="passwd" value="">
							<input type="submit" name="btn_login" id="btn_login" value="登 入" onCliek="md5()">
						-->
						<input type="submit" name="btn_login" id="btn_login" value="登 入"> 
						<input type="reset" name="btn_cancel" id="btn_cancel" value="清 除">
					</form>
				</div>

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
