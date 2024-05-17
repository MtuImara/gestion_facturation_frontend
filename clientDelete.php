<?php

    $headers = [
        // Les entêtes requises
        "Access-Control-Allow-Origin: *",
        "Content-type: application/json; charset= UTF-8",
        "Access-Control-Allow-Methods: DELETE"
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://spectacular-reprieve-production.up.railway.app/facturation/api/taux_tvas/{$_POST['id']}");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

    $response = curl_exec($ch);

    $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

    curl_close($ch);

    $data = json_decode($response, true);

    header("Location: client.php");  
    exit();

    if ($status_code !== 204) {
        
        echo "Unexpected status code: $status_code";
        var_dump($data);    
        exit;
    }

?>