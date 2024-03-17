<?php

$token = '7047137904:AAGNGGGIWfJssjl9qE03zkXFAVKqeJS8DRU';
$chat_id = '-1002039076890';
// $file_url = "https://cdn.shopify.com/s/files/1/0082/5337/4535/files/Christmas_sale_banner.jpg?v=1703162135";
// $image = curl_file_create($file_url, 'image/jpg');

$doc = curl_file_create( "lmao.txt","document/txt");

$url = 'https://api.telegram.org/bot' . $token . '/sendDocument';

$post_fields = array(
    'chat_id' => $chat_id,
    'document' => $doc,
    'caption' => "GG mera bhai"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

echo $result;


?>