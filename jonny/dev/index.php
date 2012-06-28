<?php require("../include/configure.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" href="../include/fu.css" rel="stylesheet">
<script type="text/javascript" src="../include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../include/select-install.js"></script>

<title>helloTux dev</title>
</head>

<body>

<h1><span class="h1">= helloTux dev =</span></h1>

<h2><span class="h2">== for Ubuntu ==</span></h2>

<form name="form_main" method="post" action="" enctype="text/plain">

<div>

<?php

$sql = "select ubuntu.package, name, info_tw, info_en from main, ubuntu where ssn=pid order by name asc";
$result = mysql_query($sql);

while (list($pkg, $name, $info_tw, $info_en) = mysql_fetch_row($result)) {
	echo "<input name='chkbox[]' type='checkbox'' value=$pkg> <a href=apt://$pkg>$name</a> - $info_en <br>";
}

?>
</div>

<div>
	<span class="Comment">&quot; ---------------------------------- </span><br>
	<input name="chkboxClickAll" id="chkboxClickAll" type="checkbox"> 全選/取消 <br><br>
	<input name="btnInstall" id="btnInstall" type="button" value="&nbsp;安裝&nbsp;">
</div>
</form>
<br>
<div>
	<span class="Comment">&quot; ---------------------------------- </span><br>
	<span class="Comment">&quot; 凍仁翔 (Chu-Siang, Lai)</span><br>
	<span class="Comment">&quot; <a href="https://github.com/chusaing/helloTux" target="_blank">https://github.com/chusaing/helloTux</a></span><br>
	<span class="Comment">&quot; ---------------------------------- </span><br>
</div>

</body>
<html>
