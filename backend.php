<?php

// Retrieve the token from the request
$token = $_POST['token'];

// Set your secret key
\Stripe\Stripe::setApiKey('YOUR_SECRET_KEY');

// Make cURL request to Stripe API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'amount' => 1000, // Amount in cents
'currency' => 'usd',
'source' => $token,
]));
curl_setopt($ch, CURLOPT_POST, 1);
$headers = [
'Authorization: Bearer YOUR_SECRET_KEY',
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)){
echo 'Curl error: ' . curl_error($ch);
}

// Close cURL session handle
curl_close($ch);

// Handle response
echo $response;
?>
