<?php
ini_set('max_execution_time', 0);
$token      = "";
$id_can_xoa = "";
$link       = "https://graph.facebook.com/$id_can_xoa/feed?fields=id&limit=5000&access_token=$token";
while (true) {
   $curl    = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $link,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data     = json_decode($response,JSON_UNESCAPED_UNICODE);
    $datas = $data["data"];
    foreach($datas as $each){
        $id_lay = $each["id"];
        $link   = "https://graph.facebook.com/$id_lay?method=delete&access_token=$token";
        $curl   = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));
        curl_exec($curl);
        curl_close($curl);
        sleep(5);
    }
    if(!empty($data["paging"]["next"])){
        $link = $data["paging"]["next"];
    }
    else{
        break;
    }
}

?>
