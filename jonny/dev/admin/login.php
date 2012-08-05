<?php
require_once('../../include/configure.php');
session_start();
$_SESSION['login_switch']=false;
$_SESSION['ID']="";
$_SESSION['passwd']="";

$ID ="";
$passwd="";

if(isset($_POST["ID"])) {
	$ID =$_POST["ID"];
}
if(isset($_POST["passwd"])) {
	$passwd=$_POST["passwd"];
}

if(isset($_POST["ID"])){  

	if($ID !="" && $passwd!="" ){
		$passwd = substr(md5($passwd),0,32);
		$SQL = "SELECT id, password, level, nick FROM account WHERE id = '$ID' AND password = '$passwd'";
		$result = mysql_query($SQL, $connection) or die(mysql_error());

		if(mysql_num_rows($result) == 1 ) {
			$row_result = mysql_fetch_array($result);

			// - Checkout level.
			$temp=$row_result[2];	

			//  - Administrator
			if($temp == '0'){
				$_SESSION['login_switch']=true;
				$_SESSION['ID']=$ID;
				header("Location:adm.php");
			}

			//  - users
			if($temp == '1'){ 
				$_SESSION['login_switch']=true;
				$_SESSION['ID']=$ID;
				header("Location:adm.php");
			}
		}
		else{	  	  
			echo "<script> alert('帳號或密碼錯誤') </script>";
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" href="../../include/fu.css" rel="stylesheet">
<script type="text/javascript" src="../../include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../include/select-install.js"></script>

<title>helloTux dev</title>
</head>

<body>

<h1><span class="h1">= helloTux dev =</span></h1>

<h2><span class="h2">== Login ==</span></h2>

<form id="form_adm" name="form_adm" method="post" action="login.php">

	<table>
		<tr>
			<td>帳戶 <input type="text" name="ID" id="ID"></td>
		</tr>
		<tr>
			<td>密碼 <input type="password" name="passwd" id="passwd"></td>
		</tr>
		<tr>
			<td><center><input type="submit" name="btn_login" id="btn_login" value="登 入"></center></td>
		</tr>
	</table>
</form>

<div>
	<span class="Comment">&quot; ----------------------------------------------------------- </span><br>
	<span class="Comment">&quot; Welcome to helloTux, and please enter your ID and password. </span><br>
	<span class="Comment">&quot; ----------------------------------------------------------- </span><br>
</div>

</body>
<html>
