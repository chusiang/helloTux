<?php

if (isset($_POST['custom_id'])) {
	$custom_id = $_POST['custom_id'];
	header("Location:http://" . $_SERVER['HTTP_HOST'] . "/custom.php?id=$custom_id");
}

echo "
	<br />

	<div id='breadcrumbs'>
		<a class='accesskey' href='#' accesskey='R' title='左方相關連結區塊'>:::</a> 側邊欄 <br />
	</div>

	<section id='paragraph'>

		<p>
			<ul>
				<li>
					前往自訂頁面 <br />
				
					<form name='custom_switch' method='post' action=''>
						<input type='submit' name='btnCustom' id='btnCustom' value='hello'>
						<input type='text' name='custom_id' id='custom_id' size='5' value='tux'>
					</form>
					
				</li>
				<li>
					Wedgits <br />
					<a href='http://whos.amung.us/show/um9r1aql'><img src='http://whos.amung.us/swidget/um9r1aql.gif' alt='Online counter' title='線上人數' border='0' width='80' height='15' /></a>
				</li>
			</ul>
		</p>

	</section>
";
