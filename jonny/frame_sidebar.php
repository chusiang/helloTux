<?php

if (isset($_POST["custom_id"])) {
	$custom_id = $_POST["custom_id"];
	header("Location:http://" . $_SERVER['HTTP_HOST'] . "/custom.php?id=$custom_id");
}

echo "
	<br>

	<div class=breadcrumbs>
				<a class='accesskey' href='#' accesskey='R' title='左方相關連結區塊'>:::</a>
		<font size=2 color=#7f7f7f>側邊欄</font> <br>
	</div>

	<div class=paragraph>

		<p>
			<ul>
				<li>
					<font size=2 color=#ffffff>前往自訂頁面</font>
				
					<form name=custom_switch method=post action=>
						<input type=submit name=btnCustom id=btnCustom value=hello>
						<input type=text name=custom_id id=custom_id size=7 value=tux>
					</form>
					
				</li>
			</ul>
		</p>

		<p>
			<a href='http://whos.amung.us/show/um9r1aql'><img src='http://whos.amung.us/swidget/um9r1aql.gif' alt='Online counter' title='線上人數' border='0' width='80' height='15' /></a>
		</p>
	</div>

";
