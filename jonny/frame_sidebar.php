<?php

if (isset($_POST['custom_id'])) {
	$custom_id = $_POST['custom_id'];
	header("Location:http://" . $_SERVER['HTTP_HOST'] . "/custom.php?id=$custom_id");
}

?>

<br />

<div id='breadcrumbs'>
	<a class='accesskey' href='#' accesskey='R' title='左方相關連結區塊'>:::</a> 

<?php

# - 取得使用者 ID 且不為空時。
if (isset($_SESSION["ID"]) && $_SESSION["ID"] !="") {
	$ID=$_SESSION["ID"];
	echo "Hi, $ID <a href=https://" .$_SERVER['HTTP_HOST'] . "/login.php>[登出]</a>";
} else {
	echo "Hi, Guest <a href=https://" .$_SERVER['HTTP_HOST'] . "/login.php>[登錄]</a>";
}

?>
</div>

<section id='paragraph'>

	<p>
		<ul>
			<li>
				前往自訂頁面 <br />
			
				<form name='custom_switch' method='post' action=''>
					<input type='text' name='custom_id' id='custom_id' value='tux' class='input-small search-query' style='width: 60px;'>
					<button type='submit' name='btnCustom' id='btnCustom' class='btn'>hello</button>
				</form>
				
			</li>
			<li>
				Wedgits <br />
				<a href='http://whos.amung.us/show/um9r1aql'><img src='http://whos.amung.us/swidget/um9r1aql.gif' alt='Online counter' title='線上人數' border='0' width='80' height='15' /></a>
			</li>
		</ul>
	</p>

</section>
