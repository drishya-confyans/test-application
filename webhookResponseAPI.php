<?php

$data = file_get_contents('webhook-payloads.json');

$data = json_decode($data, true);



$params = (array) json_decode(file_get_contents('php://input'), TRUE);
if ($params) {
    $result = [];
    foreach ($data as $key => $val) {
        if($key==$params['transaction_id']){
        $data[$key]['response'] = $params;
        }
    }
    file_put_contents('webhook-payloads.json', json_encode($data));
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}

function callApi($url, $params)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $params,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1ODczNjgzMzcsIm5iZiI6MTU4NzM2ODMzNywianRpIjoiOGY5YjdkNzQtOWJmZC00YmY4LThkYmItYzZlNDA4MjcxODJhIiwiZXhwIjoxNjE4OTA0MzM3LCJpZGVudGl0eSI6InRycnQ4biIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyJ9.qDwaBvPlnNJW8iM7nG4PISN41ZzNz_yFj_rfnGo7n6o"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}


?>
