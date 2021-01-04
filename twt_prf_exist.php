<?php
$baseUrl = 'https://www.twitter.com/';
$userNames = array("user01","user02","user03");


foreach($userNames as $userName) {
        $data = curl_get($baseUrl.$userName);
        $userExist = strpos($data,"Sorry, that page doesn’t exist!");
        if ($userExist !== false) {
                echo $userName." existiert derzeit nicht <br />";
        } else {
                echo $userName." existiert <br />";
        }
}

// function copied from
// https://stackoverflow.com/questions/11484964/getting-tweets-by-hashtags-via-file-get-contents
function curl_get($url){
    $return = '';
    (function_exists('curl_init')) ? '' : die('keine curl schnittstelle');

    $curl = curl_init();
    $header[0] = "Accept: text/xml,application/xml,application/json,application/xhtml+xml,";
    $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
    $header[] = "Cache-Control: max-age=0";
    $header[] = "Connection: keep-alive";
    $header[] = "Keep-Alive: 300";
    $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $header[] = "Accept-Language: en-us,en;q=0.5";

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, true);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
?>
