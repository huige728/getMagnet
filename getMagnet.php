<?php

$site = 'http://thzvv.net';//网站地址


require_once 'BEncode.php';
require_once 'BDecode.php';

require_once 'functions.php';

require_once 'simple_html_dom.php';




//获取有码区数据，按发布时间排序//http://thzvv.net/forum.php?mod=forumdisplay&fid=220&orderby=dateline&filter=author&orderby=dateline&page=1

$html = str_get_html(curlGet("$site/forum.php?mod=forumdisplay&fid=220&orderby=dateline&filter=author&orderby=dateline&page=1"));

$i=0;

foreach ($html->find('tbody[id=separatorline] a[class=showcontent y]') as $a_id){
	
	$get_id = $a_id->id;	


	$get_M_id = substr($get_id,strripos($get_id,"_")+1);		
	echo getMagnet($site,$get_M_id);

	
	$i++;
}

