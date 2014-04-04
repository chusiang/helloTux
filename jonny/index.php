<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw" manifest="hellotux.manifest">

<head>
	<title>helloTux</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keyword" content="ubuntu, apt, apturl"/>
	<meta name="author" content="Developer: 凍仁翔 - jonny (at) drx.tw; Desgin: Violet - violet (at) drx.tw"/>
	<link href="include/bootstrap.min.css" type="text/css" rel="stylesheet">
	<link href="include/violet.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="include/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="include/bootstrap.min.js"></script>

	<!--[if lt IE 9]>
		<script src="include/html5shiv.js"></script>
	<![endif]-->

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
				<li id="selected">首頁</li>
				<li><a href="http://note.drx.tw" target="_blank">部落格</a></li>
				<li><?php echo "<a href=http://" . $_SERVER['HTTP_HOST'] . "/pkg.php>套件清單</a>"; ?></li>
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
						<li><mark>helloTux</mark> 是一個提供管理並分享套件列表的網站。其一詞來自每個學程式的人都會寫到「Hello World」，而接觸 Linux 的人都知道其吉祥物的名稱是 Tux，於是「Hello Tux」就這樣誕生了！ <small>[1]</small></li>

						<li>其中文名稱尚未定案，目前有「企鵝您好」、「塔克斯您好」... 等。</li>

						<li>舊版網址為 <a href="old/ubuntu-11.10.html" target="_blank">old/ubuntu-11.10.html</a>。</li>

						<li>目前使用到的技術有 Linux, Apache, Nginx, MySQL, PHP, jQuery, CSS, HTML5。</li>

						<li>此專案使用 <a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GPL v2 or later</a> 授權，其主要目的是讓使用者直接<b>使用瀏覽器安裝 Linux 套件</b>並<b>擁有專屬套件列表</b>，換句話說這會是個 Linux 版的 <a href="http://gfx.tw/" target="_blank">抓火狐</a>，現階段將以 Ubuntu 的 AptURL 為主，後期會試著將 OpenSUSE 的 One-Click 整合進來。</li>
					</ul>
				</p>
				<p>
					<small><span class="Comment">[1] 我們改變世界了！ Hello World → Hello Tux。</span></small>
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-28258381-2', 'drx.tw');
  ga('send', 'pageview');

</script>

</body>
</html>
