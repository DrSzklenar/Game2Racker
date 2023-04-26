<?php
function getData($url = "",  $postFields = "")
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => array(
            'Client-ID: 1gdsndj0p60xua0ac6a6n7kcldeho8',
            'Authorization: Bearer im5fl0se5llzvdjv4py7eyvbsnaijk',
            'Content-Type: text/plain',
            'Cookie: __cf_bm=i6Ct3Bu80LLr8boRVUD1wxvgulosh8XFKTwuawwkfJQ-1678262079-0-AS34GswIhE0/1Ex1L6yfy/Av/Bcd19Ks+BwZ4W9MqR2TanALgtaOjKY62QlTvCm+BpUKZUqUeQ+J7autpnE0eo4='
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
?>