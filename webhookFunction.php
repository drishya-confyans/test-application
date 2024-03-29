<?php
require "config.php";
$con2 = getdb();
if (isset($_POST["numOfDo"])) {
    $numOfDo = $_POST["numOfDo"];
    $numOfCall = $_POST["numOfCall"];

    $data = file_get_contents('TRR-SO-10.json');
    $whare_house = [
        '17',
        '12',
        '32',
    ];
    $service_level = "2";
    $result = [];
    $data = json_decode($data, true);
    $on = 0;
    $io = 0;
    $unq = time();
    $no_of_sales_order = $numOfCall;

    for ($i = 0; $i < $no_of_sales_order; $i++) {
        $result[$i]['retailer_code'] = "TRR";
        $result[$i]['sales_order_number'] = 'T8N_DEV_' . $unq . '-' . (1001 + $i);//'SO-1604683341-'. (1001 + $i); //'SO-' . $unq . '-' . (1001 + $i);
        $result[$i]['customer_promised_date_sales'] = $data[0]['customer_promised_date_sales'];
        $result[$i]['sales_order_date'] = date('Y-m-d');
        $do = $numOfDo;//rand(1,5);
        for ($j = 0; $j < $do; $j++) {
            $wareHouse = $whare_house[rand(1, 3) - 1];
            $serviceLevel = $service_level;//[rand(1, 5) - 1];
            $ord_no = $on++;
            $result[$i]['delivery_orders'][$j]['warehouse_order_number'] = 'W-' . $unq . '-' . (101 + $ord_no);
            $result[$i]['delivery_orders'][$j]['delivery_order_number'] = 'DO-' . $unq . '-' . (101 + $ord_no);
            $result[$i]['delivery_orders'][$j]['customer_promised_date_delivery'] = $data[0]['delivery_orders'][0]['customer_promised_date_delivery'];
            $result[$i]['delivery_orders'][$j]['sales_order_line_number'] = $j + 1;
            $result[$i]['delivery_orders'][$j]['carrier'] = $data[0]['delivery_orders'][0]['carrier'];
            $result[$i]['delivery_orders'][$j]['service_level'] = $serviceLevel;//$data[0]['delivery_orders'][0]['service_level'] ;
            $result[$i]['delivery_orders'][$j]['tracking_number'] = '';
            $result[$i]['delivery_orders'][$j]['warehouse_code'] = $wareHouse;
            $result[$i]['delivery_orders'][$j]['weight_unit_of_measure'] = $data[0]['delivery_orders'][0]['weight_unit_of_measure'];
            $result[$i]['delivery_orders'][$j]['weight'] = $data[0]['delivery_orders'][0]['weight'];
            $result[$i]['delivery_orders'][$j]['ship_to_street1'] = $data[0]['delivery_orders'][0]['ship_to_street1'];
            $result[$i]['delivery_orders'][$j]['ship_to_street2'] = $data[0]['delivery_orders'][0]['ship_to_street2'];
            $result[$i]['delivery_orders'][$j]['ship_to_street3'] = $data[0]['delivery_orders'][0]['ship_to_street3'];
            $result[$i]['delivery_orders'][$j]['ship_to_city'] = $data[0]['delivery_orders'][0]['ship_to_city'];
            $result[$i]['delivery_orders'][$j]['ship_to_state'] = $data[0]['delivery_orders'][0]['ship_to_state'];
            $result[$i]['delivery_orders'][$j]['ship_to_country'] = $data[0]['delivery_orders'][0]['ship_to_country'];
            $result[$i]['delivery_orders'][$j]['ship_to_postal_code'] = $data[0]['delivery_orders'][0]['ship_to_postal_code'];
            $result[$i]['delivery_orders'][$j]['ship_to_longitude'] = $data[0]['delivery_orders'][0]['ship_to_longitude'];
            $result[$i]['delivery_orders'][$j]['ship_to_latitude'] = $data[0]['delivery_orders'][0]['ship_to_latitude'];
            $result[$i]['delivery_orders'][$j]['ship_to_timezone'] = "America/Los_Angeles";//$data[0]['delivery_orders'][0]['ship_to_timezone'];
            // for ($k = 0; $k < 1; $k++) {
            //     $item_no = $io++;
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_number'] = 'ITEM-' . $unq . '-' . $i . $j . (101 + $item_no);
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_sku_number'] = 'SKU-' . $unq . '-' . $i . $j . (101 + $item_no);;
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_description'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_description'];
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_quantity'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_quantity'];
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_unit_of_measurement'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_unit_of_measurement'];
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_length'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_length'];
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_width'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_width'];
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_height'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_height'];
            //     $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_dim_weight'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_dim_weight'];
            // }
        }
    }
    echo json_encode(array('success' => 1, "payload" => $result));
}

if (isset($_POST["req_payload"])) {
    // $data = file_get_contents('webhook-payloads.json');
    // $data = json_decode($data, true);
    $data=[];
    $query = "SELECT * from webhook_tbl ORDER BY id DESC";
    $result = mysqli_query($con2, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['transaction_id']] = [
            "request" => $row['request_payload'],
            "sales_order_number" => $row['sales_order_number'],
            "response" => $row['response_payload'],
            "request_time" => $row['request_time'],
            "response_time" => isset($row['response_time'])?$row['response_time']:'',
        ]; 
    }


    echo json_encode(array('success' => 1, "payload" => $data));
}

if (isset($_POST["payload"])) {
    
    $response_file = 'webhook-payloads.json';
    $res1 = file_put_contents($response_file, '');
    $con = getdb();
    $payload = $_POST["payload"];
    $data = json_decode($payload, true);
    count($data);
    $result = [];
    $result1 = [];
    $dataresponse = [];
    for ($i = 0; $i < count($data); $i++) {
        $result_json = json_encode($data[$i]);
        $response = callApi('https://api-test.t8notch.com/v2/t8n_density', $result_json);
        if ($response) {
            $d = json_decode($response, true);
            $result[$d['transaction_id']] = [
                "request" => $data[$i],
                "response" => 'waiting',
            ];
            $result1[$i]['transaction_id'] = $d['transaction_id'];
            $result1[$i]['sales_order_number'] = $data[$i]['sales_order_number'];
            $result1[$i]['response'] = 'waiting';
            $result1[$i]['request_time'] = date('Y-m-d H:i:s');
            $result1[$i]['response_time'] = "";
            // $_SESSION["payload"][$d['transaction_id']]=$result;

            $tid=$d['transaction_id'];
            $sales_order_number=$data[$i]['sales_order_number'];
            $req=json_encode($data[$i]);
            $res="waiting";
            $request_time=$result1[$i]['request_time'];

            $sql = "INSERT into  webhook_tbl (transaction_id,sales_order_number,request_payload,response_payload,request_time) 
            values ('" . $tid . "','".$sales_order_number."','" . $req . "','" . $res . "','" . $request_time . "')";
             $result = mysqli_query($con, $sql);
             if (!$result) {
                 echo ("Error description: " . mysqli_error($con));
                 return false;
             }


        }
    }
    $result_json = json_encode($result);
    $response_file = 'webhook-payloads.json';
    $res1 = file_put_contents($response_file, $result_json);

    echo json_encode(array('success' => 1, "payload" => $result1));
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
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MjkxODc0NTMsIm5iZiI6MTYyOTE4NzQ1MywianRpIjoiOTA0NTMwMzUtYWYyNC00YjBmLThlMTQtMDAzMmMxMGRjYmU0IiwiZXhwIjoxNjYwNzIzNDUzLCJpZGVudGl0eSI6InRycnQ4biIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InVzZXJuYW1lIjoidHJydDhuIiwicmV0YWlsZXJfY29kZSI6bnVsbCwidXNlcl90eXBlIjpudWxsfX0.tPtClBe3tfUKXnavu45vpkXDRIH6l5xwFeDCLWsMEEU"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}


if(isset($_POST["ClearTable"])){
    $conDEL = getdb();
    $query = "delete from webhook_tbl where 1=1;";
    $deleteResult = mysqli_query($conDEL, $query);
    if ($deleteResult){
        echo json_encode(array('success' => 1));
    }else{
        echo json_encode(array('success' => 0));
    }
}
?>


