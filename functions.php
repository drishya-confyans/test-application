<?php
if (isset($_POST["numOfDo"])) {
    $numOfDo = $_POST["numOfDo"];
    $numOfCall = $_POST["numOfCall"];

    $data = file_get_contents('TRR-SO-10.json');
// $os=[12,17,32,3,4,7,16,30];//count 28
// $os=[3,4,7,16,30];//count 31
// for ($i = 1; $i <= 36; $i++) {
//     if (!in_array($i, $os)) {
//         $whare_house[] = $i;
//     }
// }
//var_dump(count($whare_house));
    $whare_house = [
        '17',
        '12',
        '32',
    ];
    $service_level = "2";
// $service_level = [
//     '2',
//     '3',
//     '4',
//     '5',
//     '14',
// ];

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
        $result[$i]['sales_order_time'] = date('H:i:s', time());
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
            $result[$i]['delivery_orders'][$j]['tracking_number'] = 'TRA-' . $unq . '-' . (101 + $ord_no);
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

            for ($k = 0; $k < 1; $k++) {
                $item_no = $io++;
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_number'] = 'ITEM-' . $unq . '-' . $i . $j . (101 + $item_no);
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_sku_number'] = 'SKU-' . $unq . '-' . $i . $j . (101 + $item_no);;
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_description'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_description'];
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_quantity'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_quantity'];
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_unit_of_measurement'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_unit_of_measurement'];
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_length'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_length'];
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_width'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_width'];
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_height'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_height'];
                $result[$i]['delivery_orders'][$j]['delivery_order_items'][$k]['item_dim_weight'] = $data[0]['delivery_orders'][0]['delivery_order_items'][0]['item_dim_weight'];
            }
        }

    }
    echo json_encode(array('success' => 1, "payload" => $result));
}

if (isset($_POST["payload"])) {
    $payload = $_POST["payload"];
    $data = json_decode($payload, true);
    count($data);
    $result = [];
    for ($i = 0; $i < count($data); $i++) {
        $result_json = json_encode($data[$i]);
        $result[$i]['request_time'] = date('Y-m-d H:i:s');
        $result[$i]['request_json']=$data[$i];
        $response = callApi('http://35.238.192.10:5001/v1/t8n_density', $result_json);
        if ($response) {
            $result[$i]['response_time'] = date('Y-m-d H:i:s');
            $date1Timestamp = strtotime($result[$i]['request_time']);
            $date2Timestamp = strtotime($result[$i]['response_time']);
            $difference = $date2Timestamp - $date1Timestamp;
            $result[$i]['time_difference']=$difference;
            $d=json_decode($response,true);
            $result[$i]['response']=$d;
            $result[$i]['sales_order_number']=$d['result'][0]['sales_order_number'];
        }
    }
    echo json_encode(array('success' => 1, "payload" => $result));
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


