## Introduction
This example is using `cURL` (a built-in module in PHP) to connect to the API. Note that this example is for terminal use ONLY. It will NOT work in a browser.

To start with `cURL`, we have to create a `cURL` instance.
```
$curl = curl_init();
```

## Authentication

To authenticate, we have to add our API token into the header of the `cURL` instance, so the server knows who we are.

```
$url = '{{BASE_URL}}';
$api_token = '<your api token>';

curl_setopt_array($curl, array(
	CURLOPT_URL => $url.'/index/ixei',
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
$response = curl_exec($curl);
curl_close($curl);
```

## Result from the API
All the results from the API are in JSON format. So we have to decode it.
```
$data = json_decode($response, TRUE);
echo $data['data']['value'];
```

## Fetching Data with 15 seconds interval
The IX Index series updates their data every 15 seconds. To fetch the data from the API with 15 seconds interval, you can use the code below.
```
while(true)
{
	$response = curl_exec($curl);
	$data = json_decode($response, TRUE);
	echo $data['data']['value'].PHP_EOL;
	sleep(15 - time() % 15);
}

curl_close($curl);

```

## Complete Example

[You can also download the example here.](https://github.com/ix-index/php-example)


```
<?php

$url = '{{BASE_URL}}';
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
	sleep(15 - time() % 15);
}

curl_close($curl);


```