<?php

$ch = require "../init_curl.php";

curl_setopt($ch, CURLOPT_URL, "http://192.168.20.64:8085/facturation/api/gestion_client/");
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));

$response = curl_exec($ch);

$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);


if($e = curl_error($ch)){
    echo $e;
}
else{
    $data["data"]["contents"] = json_decode($response);
}

curl_close($ch);

?>











