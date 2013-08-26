<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keyword" content="ubuntu, apt, apturl"/>
	<meta name="author" content="Developer: 凍仁翔 - jonny (at) drx.tw; Desgin: Violet - violet (at) drx.tw"/>
	<title>helloTux</title>
	<link href="include/violet.css" type="text/css" rel="stylesheet">
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
				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>Home</a>"; ?></li>
				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/pkg.php>Package</a>"; ?></li>
				<li><?php echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/login.php>Login</a>"; ?></li>
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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：<?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/index.php>首頁</a>"; ?> / 找不到網頁 <br/><br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>找不到網頁</h1>

				<p>
					<ul>
						<li>您要求的網頁 "<?php echo $_SERVER["REQUEST_URI"]; ?>" 不存在。</li>
						<li>請使用 <input type ="button" onclick="history.back()" value="回上頁" class="form-submit" ></input> 或 <input type ="button" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']; ?>';" value="回首頁" class="form-submit" ></input> 按鈕移至其他連結。</li>
						<!--
						<li>若持續出現此錯誤畫面請<a href="contact.php">聯絡我們</a>，謝謝。</li>
						-->
					</ul>
				</p>

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
