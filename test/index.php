<?php
include("php/getinfo.php");
$code = new clientGetObj;
$strBrowser = $code->getBrowse();//瀏覽器：
$strIP = $code->getIP();//IP地址：
$strOS = $code->getOS();//操作系統： 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><!-- InstanceBegin template="/Templates/main.dwt" codeOutsideHTMLIsLocked="false" -->
	<HEAD>
		<META CONTENT="text/html; charset=utf-8" HTTP-EQUIV="Content-Type">
		<META NAME="Generator" CONTENT="PhotoImpact">
		<META NAME="PhotoImpact Document" CONTENT="C:\Documents and Settings\student\桌面\chusiang.lai\0330title.ufo">
		<!-- InstanceBeginEditable name="doctitle" -->
		<title>凍仁的筆記</title>
		<!-- InstanceEndEditable -->
	<style type="text/css">
<!--
a:link {
	text-decoration: none;
	color: #999999;
}
a:visited {
	text-decoration: none;
	color: #CCCCCC;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style1 {
	color: #FFFFFF;
	font-size: 12px;
}
body {
	background-color: #333333;
}
.lineDark {
	border: thin solid #1C1C1C;
}
-->
    </style>

    <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</HEAD>

	<BODY TOPMARGIN="0" LEFTMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
	<table width="740" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#1C1C1C" bgcolor="#1C1C1C" class="lineDark">
      <tr>
        <td width="740" height="140"><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
          <TR>
            <TD COLSPAN="7"><IMG SRC="images/0401title_1.jpg" WIDTH="270" BORDER="0" HEIGHT="135"></TD>
            <TD COLSPAN="5"><IMG SRC="images/0401title_2.jpg" WIDTH="470" BORDER="0" HEIGHT="135"></TD>
          </TR>
          <TR>
            <TD><a href="index.php"><IMG SRC="images/0401title_3.jpg" WIDTH="71" BORDER="0" HEIGHT="25"></a></TD>
            <TD><IMG SRC="images/0401title_4.jpg" WIDTH="8" BORDER="0" HEIGHT="25"></TD>
            <TD><a href="http://jonny.ubuntu-tw.net/2009/12/blog-post.html" target="_blank"><IMG SRC="images/0401title_5.jpg" WIDTH="52" BORDER="0" HEIGHT="25"></a></TD>
            <TD><IMG SRC="images/0401title_6.jpg" WIDTH="8" BORDER="0" HEIGHT="25"></TD>
            <TD><a href="http://www.ubuntu-tw.org" target="_blank"><IMG SRC="images/0401title_7.jpg" WIDTH="103" BORDER="0" HEIGHT="25"></a></TD>
            <TD><IMG SRC="images/0401title_8.jpg" WIDTH="10" BORDER="0" HEIGHT="25"></TD>
            <TD COLSPAN="3"><a href="wiki/" target="_blank"><IMG SRC="images/0401title_9.jpg" WIDTH="68" BORDER="0" HEIGHT="25"></a></TD>
            <TD COLSPAN="3"><IMG SRC="images/0401title_10.jpg" WIDTH="420" BORDER="0" HEIGHT="25"></TD>
          </TR>
          <TR>
            <TD COLSPAN="3"><a href="http://jonny.ubuntu-tw.net/p/about-chu-siang-lai.html" target="_blank"><IMG SRC="images/0401title_11.jpg" WIDTH="131" BORDER="0" HEIGHT="50"></a></TD>
            <!-- <TD COLSPAN="5"><a href="command.html"><IMG SRC="images/0401title_12.jpg" WIDTH="166" BORDER="0" HEIGHT="50"></a></TD> -->
            <TD COLSPAN="5"><IMG SRC="images/0401title_12.jpg" WIDTH="166" BORDER="0" HEIGHT="50"></TD>
            <TD COLSPAN="2"><a href="http://jonny.ubuntu-tw.net/search/label/Desktop%20%7C%20%E6%A1%8C%E9%9D%A2" target="_blank"><IMG SRC="images/0401title_13.jpg" WIDTH="153" BORDER="0" HEIGHT="50"></a></TD>
            <TD><a href="http://jonnyubuntu.blogspot.com/search/label/Browsers%20|%20%E7%80%8F%E8%A6%BD%E5%99%A8" target="_blank"><IMG SRC="images/0401title_14.jpg" WIDTH="139" BORDER="0" HEIGHT="50"></a></TD>
            <TD><a href="http://jonny.ubuntu-tw.net/search/label/Themes%20%7C%20%E4%BD%88%E6%99%AF%E7%BE%8E%E5%8C%96" target="_blank"><IMG SRC="images/0401title_15.jpg" WIDTH="151" BORDER="0" HEIGHT="50"></a></TD>
          </TR>
          <TR>
            <TD><IMG SRC="images/space.gif" WIDTH="71" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="8" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="52" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="8" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="103" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="10" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="18" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="27" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="23" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="130" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="139" BORDER="0" HEIGHT="1"></TD>
            <TD><IMG SRC="images/space.gif" WIDTH="151" BORDER="0" HEIGHT="1"></TD>
          </TR>
        </TABLE></td>
      </tr>
      <tr>
        <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="EditRegionTODO" -->
<h2>關於 Drx.tw</h2>
<b>Drx</b> 是「凍仁翔」中翻英的簡寫，底子不夠厚的凍仁將在這個小小據點練習些伺服器管理、網站架設以及 DNS 控管.. 等等的網路服務。 
<ul>
  <li>Nick Name: 凍仁翔</li>
  <li>E-mail: <i>jonny (at) ubuntu-tw.org</i></li>
  <li>Links: <i><a href="http://jonny.ubuntu-tw.net" target="_blank">Blog</a> / <a href="http://www.facebook.com/chusiang.lai" target="_blank">Facebook</a> / <a href="http://www.plurk.com/chusiang" target="_blank"><i>Plurk</i></a></i></li>
</ul>

<br>
<br>

<ul>
<font size="1">
  <li>Your IP: <?php echo "<font color='#FF0000'>".$strIP."</font>" ?></li>
  <li>Your Browser: <?php echo "<font color='#FF0000'>".$strBrowser."</font>" ?></li>
  <li>Your OS: <?php echo "<font color='#FF0000'>".$strOS."</font>" ?></li>
</font>
</ul>

<br>
<br>
<br>
<br>
<!-- InstanceEndEditable --></td>
      </tr>
      <tr>
        <td height="50" align="center" bgcolor="#1C1C1C"><p class="style1">
	<img alt="UTF-8" src="http://lh3.ggpht.com/_FHQ0woljQMg/SrzU-rLY1YI/AAAAAAAAB5g/8V8WOBnJCi8/s800/utf8zhtw.jpg" border="0" height="15" width="80"></a>
	<a href="http://zh.wikipedia.org/w/index.php?title=%e5%8f%b0%e7%81%a3&amp;variant=zh-tw" title="本 bolg 作者來自台灣"> <img alt="Taiwan" src="http://lh6.ggpht.com/_FHQ0woljQMg/SrzQ7w-6FgI/AAAAAAAAByU/QWjD5DCX-9o/s800/taiwan.jpg" border="0" height="15" width="80"></a>
	<a href="http://jonnyubuntu.blogspot.com/2008/02/firefox.html" title="希望大家能用更好的瀏覽器來取代 ie，以追求更佳的網頁瀏覽品質"><img alt="No IE" src="http://lh6.ggpht.com/_FHQ0woljQMg/SrzQ4UrA48I/AAAAAAAABxg/QA1-q5nIT48/s800/noIE_button_80x15_2.jpg" border="0" height="15" width="80"></a>
	<a href="http://look.urs.tw/show.php?blogid=59898"><img class=" isutibyqahpoaujwxlzp" alt="Add Look" src="http://images.look.urs.tw/images/addbloglook.php?BlogID=59898" title="部落格觀察" border="0"></a>
	<a href="http://whos.amung.us/show/um9r1aql"><img alt="Online counter" src="http://whos.amung.us/swidget/um9r1aql.gif" title="線上人數" border="0" height="15" width="80"></a>
	<a href="http://creativecommons.org/licenses/by-nc-sa/2.5/tw/" title="本著作採用 創用cc 姓名標示-非商業性-相同方式分享 2.5 台灣 授權條款授權."><img alt="cc" src="http://lh4.ggpht.com/_FHQ0woljQMg/SrzQurHx2vI/AAAAAAAABvQ/KorDFDYPRh4/s800/cc80x15.jpg" border="0" height="15" width="80"></a><br>
	<font size=1>建議使用 Firefox 或 Chrome 並於 1024x768 解析度下為最佳瀏覽效果。</font></p></td>
      </tr>
    </table>
</BODY>
<!-- InstanceEnd --></HTML>
