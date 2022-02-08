<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("",//put your api key
                  ""));//put your token
$payload = Array(
    'purpose' => 'Buy Food',
    'amount' => '259',
    'phone' => '9999999999',
    'buyer_name' => 'SUmit singh',
    'redirect_url' => 'http://localhost/tem_proj1/pixie/test.php',
    'send_email' => true,
    'webhook' => 'http://www.example.com/webhook/',
    'send_sms' => true,
    'email' => '',//put your email here
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

// echo $response;
$response = json_decode($response);
echo "<pre>";
print_r($response);

?>
