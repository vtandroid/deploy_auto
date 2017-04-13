<?php
if (isset($_POST['url']) ) {
	$url = $_POST['url'];
 $ch = curl_init($url);
 $headers = [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Accept-Encoding: gzip, deflate',
    'Accept-Language: en-US,en;q=0.5',
    'Cache-Control: no-cache',
    'Content-Type: application/x-www-form-urlencoded; charset=utf-8'
];
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HEADER,$headers);
 curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
 
 $data = curl_exec($ch);
 curl_close($ch);
 echo $data;
}
?>
