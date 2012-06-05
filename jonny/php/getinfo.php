<?php class clientGetObj {

function getBrowse() {
	global $_SERVER;
	$Agent = $_SERVER['HTTP_USER_AGENT'];
	$browser = '';
	$browserver = '';
	$Browser = array('Lynx', 'MOSAIC', 'AOL', 'Opera', 'JAVA', 'MacWeb', 'WebExplorer', 'OmniWeb');

	for ($i = 0; $i <= 7; $i ++) {
		if (strpos($Agent, $Browsers[$i])) {
			$browser = $Browsers[$i];
			$browserver = '';
		}
	}

	if (ereg('Mozilla', $Agent) && !ereg('MSIE', $Agent)) {
		$temp = explode('(', $Agent);
		$Part = $temp[0];
		$temp = explode('/', $Part);
		$browserver = $temp[1];
		$temp = explode(' ', $browserver);
		$browserver = $temp[0];
		$browserver = preg_replace('/([d.]+)/', '1', $browserver);
		$browserver = $browserver;
		$browser = 'Netscape Navigator';
	}

	if (ereg('Mozilla', $Agent) && ereg('Opera', $Agent)) {
		$temp = explode('(', $Agent);
		$Part = $temp[1];
		$temp = explode(')', $Part);
		$browserver = $temp[1];
		$temp = explode(' ', $browserver);
		$browserver = $temp[2];
		$browserver = preg_replace('/([d.]+)/', '1', $browserver);
		$browserver = $browserver;
		$browser = 'Opera';
	}

	if (ereg('Mozilla', $Agent) && ereg('MSIE', $Agent)) {
		$temp = explode('(', $Agent);
		$Part = $temp[1];
		$temp = explode(';', $Part);
		$Part = $temp[1];
		$temp = explode(' ', $Part);
		$browserver = $temp[2];
		$browserver = preg_replace('/([d.]+)/','1',$browserver);
		$browserver = $browserver;
		$browser = 'Internet Explorer';
	}

	if ($browser != '') {
		$browseinfo = $browser.' '.$browserver;
	} else {
		$browseinfo = false;
	}
	return $browseinfo;
}
	
function getIP () {
	global $_SERVER;

	if (getenv('HTTP_CLIENT_IP')) {
		$ip = getenv('HTTP_CLIENT_IP'); 
	} else if (getenv('HTTP_X_FORWARDED_FOR')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	} else if (getenv('REMOTE_ADDR')) {
		$ip = getenv('REMOTE_ADDR');
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
	
function getOS () {
	global $_SERVER;
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$os = false;

	if (eregi('win', $agent) && strpos($agent, '95')) {
		$os = 'Windows 95';
	} else if (eregi('win 9x', $agent) && strpos($agent, '4.90')) {
		$os = 'Windows ME';
	} else if (eregi('win', $agent) && ereg('98', $agent)) {
		$os = 'Windows 98';
	} else if (eregi('win', $agent) && eregi('nt 5.1', $agent)) {
		$os = 'Windows XP';
	} else if (eregi('win', $agent) && eregi('nt 5', $agent)) {
		$os = 'Windows 2000';
	} else if (eregi('win', $agent) && eregi('nt', $agent)) {
		$os = 'Windows NT';
	} else if (eregi('win', $agent) && ereg('32', $agent)) {
		$os = 'Windows 32';
	} else if (eregi('linux', $agent)) {
		$os = 'Linux';
	} else if (eregi('unix', $agent)) {
		$os = 'Unix';
	} else if (eregi('sun', $agent) && eregi('os', $agent)) {
		$os = 'SunOS';
	} else if (eregi('ibm', $agent) && eregi('os', $agent)) {
		$os = 'IBM OS/2';
	} else if (eregi('Mac', $agent) && eregi('PC', $agent)) {
		$os = 'Macintosh';
	} else if (eregi('PowerPC', $agent)) {
		$os = 'PowerPC';
	} else if (eregi('AIX', $agent)) {
		$os = 'AIX';
	} else if (eregi('HPUX', $agent)) {
		$os = 'HPUX';
	} else if (eregi('NetBSD', $agent)) {
		$os = 'NetBSD';
	} else if (eregi('BSD', $agent)) {
		$os = 'BSD';
	} else if (ereg('OSF1', $agent)) {
		$os = 'OSF1';
	} else if (ereg('IRIX', $agent)){
		$os = 'IRIX';
	} else if (eregi('FreeBSD', $agent)){
		$os = 'FreeBSD';
	} else if (eregi('teleport', $agent)){
		$os = 'teleport';
	} else if (eregi('flashget', $agent)){
		$os = 'flashget';
	} else if (eregi('webzip', $agent)){
		$os = 'webzip';
	} else if (eregi('offline', $agent)){
		$os = 'offline';
	} else {
		$os = 'Unknown';
	}
	return $os;
}
	
} ?>
