<?php 
ini_set('max_execution_time', 0);
$post_id = "";//id b�i mu?n b�nh lu?n
$token = "";//token c?a b?n
$text = ""; //di?n v�o d�y l?i nh?n b?n mu?n g?i
$url = "https://graph.facebook.com/me/friends?limit=5000&fields=id&access_token=$token";
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => "$url",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_TIMEOUT => 0,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
));
$response = curl_exec($curl);
curl_close($curl);
$data      = json_decode($response,JSON_UNESCAPED_UNICODE);
$datas     = $data["data"];
$message = "";
foreach($datas as $key => $each){
	$message .= "@[".$each["id"].":0] ";
	//c? 5 b?n th� s? tag 1 l?n, tr�nh b? FB hi?u nh?m spam, v� s? t? d?ng tag m?i 10 gi�y cho d?n h?t danh s�ch
	if($key == 5){
		$message .= "
$text";
		$url = "https://graph.facebook.com/$post_id/comments?method=post&message=$message&access_token=$token";
		die($url);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "$url",
			CURLOPT_RETURNTRANSFER => false,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false
		));
		curl_exec($curl);
		curl_close($curl);
		sleep(10);
	}
}
