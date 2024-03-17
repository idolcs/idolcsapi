<?php

// $bot_id = "7047137904:AAGNGGGIWfJssjl9qE03zkXFAVKqeJS8DRU";
// $chat_id = "-4109489115";
// $message = "Hello";

// $final_url = "https://api.telegram.org/bot" .$bot_id . "/sendMessage?chat_id=". $chat_id ."&text=" . $message;
// $final_url = "https://api.telegram.org/bot" .$bot_id . "/sendDocument?chat_id=". $chat_id ."&text=" . $message . "&document=https://dl91era.com/images/logo-black.svg";

// $req = file_get_contents($final_url);

// print_r($req); 






$token = '7047137904:AAGNGGGIWfJssjl9qE03zkXFAVKqeJS8DRU';
$chat_id = '-1002039076890';
$file_url = "https://cdn.shopify.com/s/files/1/0082/5337/4535/files/Christmas_sale_banner.jpg?v=1703162135";
$image = curl_file_create($file_url, 'image/jpg');

$url = 'https://api.telegram.org/bot' . $token . '/sendPhoto';

$post_fields = array(
    'chat_id' => $chat_id,
    'photo' => $image,
    'caption' => "<b>GG mera bhai</b>\nDurka woh <u>rishtedaa</u>r",
    'parse_mode' => "html"
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

<!-- AgACAgUAAx0EeYnYGgADAmX1xs7GnCrGW9NRsdtdwjhG5NH4AALKuDEbbQ2oV2N8rHQVD8K4AQADAgADcwADNAQ -->