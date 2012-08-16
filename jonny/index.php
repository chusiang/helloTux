<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
	<div id="header">
		<div id="header_menu">
			<ul class="navigation_menu">
				<li><a href="#" accesskey="U" title="上方功能區塊">:::</a> </li>
				<li><a href="#">網站導覽</a></li>
			</ul>
		</div>
	</div>

	<!--外框架圍繞內容-->
	<div id="wrapper">

		<div id="menu_main">
			<div class="menu_level">
				<ul>
					<li class="selected">Home</li>
					<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/pkg.php>Package</a>"; ?></li>
					<li><?php echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/login.php>Login</a>"; ?></li>
				</ul>
			</div>
		</div>

		<!--側邊欄-->
		<div id="sidebar">
<?php
include 'frame_sidebar.php';
?>
		</div>

		<!--內容-->
		<div id="content">
			<!--麵包屑-->
			<div class="breadcrumbs">
				<a class="accesskey" href="#" accesskey="C" title="中央內容區塊">:::</a> 現在位置：首頁<br/>
			</div>
			<!--段落-->
			<div class="paragraph">

				<h1>About</h1>

				<p>
				<ul>
					<li>此專案宗旨在於讓<b>使用者直接使用瀏覽器安裝 Linux 套件</b>，換句話說這會是個 Linux 版的<a href="http://gfx.tw/" target="_blank">抓火狐</a>，現階段將以 Ubuntu 的 AptURL 為主，後期會試著將 OpenSUSE 的 One-Click 整合進來。</li>

					<li><b>helloTux</b> 一詞來自每個學程式的人都會寫到「Hello World」，而接觸 Linux 的人都知道其吉祥物的名稱是 Tux，於是「Hello Tux」就這樣誕生了！ [註1]</li>

					<li>其中文名稱尚未定案，目前有「企鵝您好」、「塔克斯您好」...</li>

					<li>舊版網址為 <a href="old/ubuntu-11.10.html" target="_blank">old/ubuntu-11.10.html</a>。</li>

					<li>目前使用到的技術有 Linux, Apache, MySQL, PHP, jQuery, CSS。</li>
				</ul>

				<span class="Comment">[註1] 我們改變世界了！ Hello World → Hello Tux。</span>
				</p>
			</div>
		</div>

		<div id="footer">
<?php
include 'frame_footer.php';
?>
		</div>
	</div>
</div>

</body>
</html>
