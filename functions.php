<?php
error_reporting( E_ALL&~E_NOTICE );

function curlGet($url){
    $header[]= 'user-agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36';  
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$header); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    return curl_exec($curl); 
    curl_close($curl); 
}

function pregTor($content){
    $preg = '/href="imc_attachad-ad.html\\?aid=(\w+)"/is';
    preg_match($preg,$content,$match);
    return $tor='/forum.php?mod=attachment&aid='.$match[1];
}

function getMagnet($site,$M_id){
	$torrent = curlGet($site.pregTor(curlGet("$site/thread-$M_id-1-1.html")));
	$desc = BDecode($torrent);
	$info = $desc['info'];
	$hash = strtoupper(sha1( BEncode($info) ));
	$magnet_txt = sprintf('magnet:?xt=urn:btih:%s&dn=%s', $hash, $info['name'])."<br>";
	return $magnet_txt;
}