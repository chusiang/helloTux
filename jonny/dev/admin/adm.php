<?php
require_once('../../include/configure.php');
session_start();

if($_SESSION["login_switch"] != true) {
	header("Location:login.php");
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

<div class="login">
	<form name="login" method="post" action="adm.php">

	</form>
</div>

<h1><span class="h1">= helloTux dev =</span></h1>

<h2><span class="h2">== Admin ==</span></h2>

<!--

# view, add, del of package list ......

-->

<div>
	<span class="Comment">&quot; -------------------------------------------------------------- </span><br>
	<span class="Comment">&quot; Now, you can manage your package list with helloTux, enjoy it. </span><br>
	<span class="Comment">&quot; -------------------------------------------------------------- </span><br>
</div>

</body>
<html>
