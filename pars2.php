<?php
include_once('simple_html_dom.php');
header('Content-type: text/html; charset=utf-8');

function curl_get($url, $referer='https://www.google.com.ua'){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data=curl_exec($ch);
    curl_close($ch);
    return $data;
}

$host = 'localhost'; // адрес сервера 
$database = 'temperature'; // имя базы данных
$user = 'admin'; // имя пользователя
$password = '12345'; // пароль

if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

$html=curl_get('http://www.meteoservice.ru/');
$dom=str_get_html($html);
$e=$dom->find('.large-2',3);
$ukr=$e->find('ul li');

foreach($ukr as $ukr1){ 
    $a=$ukr1->find('a',0);
    $one=curl_get('http://www.meteoservice.ru/'.$a->href);
    $dom1=str_get_html($one);  
    $с1=$dom1->find('.temperature',3);
    $tobd=$с1->plaintext;
    $tobd1=$ukr1->plaintext;
     $query = query("INSERT INTO "$database" (name_sitie, temperature) VALUES('$tobd1', '$tobd')");
    

?>