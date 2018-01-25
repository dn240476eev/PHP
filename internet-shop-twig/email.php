<?php
$user = 'dn240476eev@gmail.com';
$password = 'Arenda76';
$send_email_url = 'https://esputnik.com/api/v1/message/email';

$from = '"Evta" <dn240476eev@gmail.com>'; // отправитель в формате "Имя" <email@mail.com>
$subject = 'Тестовая тема';
$htmlText = '<html><body><h1>ТЕСТ!</h1></body></html>';
$plainText = 'Простой текст сообщения'; // вариант письма в виде простого текста
$emails = array('mihaskep@gmail.com');
//$emails = array('mihaskep@gmail.com', 'recipient2@mail.com');

$json_value = new stdClass();
$json_value->from = $from;
$json_value->subject = $subject;
$json_value->htmlText = $htmlText;
$json_value->plainText = $plainText;
$json_value->emails = $emails;

send_request($send_email_url, $json_value, $user, $password);

function send_request($url, $json_value, $user, $password) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_value));
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERPWD, $user.':'.$password);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    echo($output);
}