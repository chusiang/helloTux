<?php

if (isset($_POST["custom_id"])) {
	$custom_id = $_POST["custom_id"];
	header("Location:http://" . $_SERVER['HTTP_HOST'] . "/custom.php?id=$custom_id");
}

echo "

<a class='accesskey' href='#' accesskey='R' title='左方相關連結區塊'>:::</a><br/>
<div class='menu_vertical'>

	<form name=custom_switch method=post action=>
		<input type=text name=custom_id id=custom_id size=12 value=jonny>
		<input type=submit name=btnCustom id=btnCustom value=GO>
	</form>

	 <a href='http://whos.amung.us/show/um9r1aql'><img src='http://whos.amung.us/swidget/um9r1aql.gif' alt='Online counter' title='線上人數' border='0' width='80' height='15' /></a>

</div>

";

/*

	<ul>
		<li><a href='#'>選單連結1</a></li>
		<li><a href='#'>選單連結2</a></li>
		<li><a href='#'>選單連結3</a></li>
		<li><a href='#'>選單連結4</a></li>
		<li><a href='#'>選單連結5</a></li>
		<li><a href='#'>選單連結6</a></li>
	</ul>
 */

?>
