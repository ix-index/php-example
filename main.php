<?php

$url = 'https://api.ix-index.com/v1';
$api_token = '<your api token>';

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => $url.'/index/ixci',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	CURLOPT_HTTPHEADER => array(
		'Authorization: Bearer '.$api_token
	),
));

while(true)
{
	$response = curl_exec($curl);
	$data = json_decode($response, TRUE);
	echo $data['data']['value'].PHP_EOL;
	sleep(15);
}

curl_close($curl);

