<?php
header('Content-Type: text/html; charset=iso-8859-1');
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    echo $data;
}
?>