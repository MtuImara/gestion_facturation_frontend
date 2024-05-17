<?php

$headers = [
    // Les entêtes requises
    "Access-Control-Allow-Origin: *",
    "Content-type: application/json; charset= UTF-8",
    "Access-Control-Allow-Methods: PUT",
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://spectacular-reprieve-production.up.railway.app/facturation/api/taux_tvas/{$_POST['id']}");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));

$response = curl_exec($ch);

$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

curl_close($ch);

$datas = json_decode($response, true);

header("Location: tva.php");  
    exit();

if ($status_code === 422) {
    
    echo "Invalid data: ";
    print_r($datas["errors"]);
    exit;
}

if ($status_code !== 200) {
    
    echo "Unexpected status code: $status_code";
    //var_dump($datas["data"]);  
    header("Location: tva.php");  
    exit;
}

?>










