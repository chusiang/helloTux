<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw" manifest="hellotux.manifest">
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
			<ul>
				<li><a href="#" accesskey="U" title="上方功能區塊">:::</a> </li>
				<!--
				<li><a href="#">網站導覽</a></li>
				-->
			</ul>
		</nav>
	</header>

	<!--外框架圍繞內容-->
	<div id="wrapper">

		<nav id="menu_h">
			<ul>
				<li id="selected">Home</li>
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
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：首頁<br/>
			</div>

			<!--段落-->
			<section id="paragraph">

				<h1>About</h1>

				<p>
				<ul>
					<li>此專案使用 <a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GPL v2 or later</a> 授權，其主要目的是讓使用者直接<b>使用瀏覽器安裝 Linux 套件</b>，並<b>擁有專屬套件列表</b>，換句話說這會是個 Linux 版的 <a href="http://gfx.tw/" target="_blank">抓火狐</a>，現階段將以 Ubuntu 的 AptURL 為主，後期會試著將 OpenSUSE 的 One-Click 整合進來。</li>

					<li><mark>helloTux</mark> 一詞來自每個學程式的人都會寫到「Hello World」，而接觸 Linux 的人都知道其吉祥物的名稱是 Tux，於是「Hello Tux」就這樣誕生了！ [註1]</li>

					<li>其中文名稱尚未定案，目前有「企鵝您好」、「塔克斯您好」...</li>

					<li>舊版網址為 <a href="old/ubuntu-11.10.html" target="_blank">old/ubuntu-11.10.html</a>。</li>

					<li>目前使用到的技術有 Linux, Apache, Nginx, MySQL, PHP, jQuery, CSS。</li>
				</ul>
				</p>

				<p>
					<small><span class="Comment">[註] 我們改變世界了！ Hello World → Hello Tux。</span></small>
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
