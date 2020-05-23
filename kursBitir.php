<?php

set_time_limit(-1);

/* BU DEGERLERI DEGISTIRIN*/
$cookie = "Bu alanı doldurunuz!";
$kursURL = "https://www.btkakademi.gov.tr/portal/course/css-7453";
/* BU DEGERLERI DEGISTIRIN*/


$kursID = explode("/", $kursURL)[5];


function btkAkademiTamamla($i, $cookie, $url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.btkakademi.gov.tr/portal/course/deliver/update-attempt/{$i}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"successStatus\":\"SUCCESS\",\"completionPercentage\":100,\"successPercentage\":100,\"attemptDuration\":95,\"totalDuration\":1000,\"newAttempt\":false,\"duration\":95,\"lastPosition\":422}",
        CURLOPT_HTTPHEADER => array(
            "Connection: keep-alive",
            "Accept: application/json, text/plain, */*",
            "X-CSRF-TOKEN: e1c922a6-429d-484f-8f95-710219e6bf03",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36 OPR/68.0.3618.125",
            "Content-Type: application/json;charset=UTF-8",
            "Origin: https://www.btkakademi.gov.tr",
            "Sec-Fetch-Site: same-origin",
            "Sec-Fetch-Mode: cors",
            "Sec-Fetch-Dest: empty",
            "Referer: {$url}",
            "Accept-Language: en-US,en;q=0.9",
            "Cookie: {$cookie}"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

function siteGet($url, $cookie){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "{$url}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Connection: keep-alive",
            "Accept: application/json, text/plain, */*",
            "X-CSRF-TOKEN: e1c922a6-429d-484f-8f95-710219e6bf03",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36 OPR/68.0.3618.125",
            "Content-Type: application/json;charset=UTF-8",
            "Origin: https://www.btkakademi.gov.tr",
            "Sec-Fetch-Site: same-origin",
            "Sec-Fetch-Mode: cors",
            "Sec-Fetch-Dest: empty",
            "Referer: {$url}",
            "Accept-Language: en-US,en;q=0.9",
            "Cookie: {$cookie}"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

$re = '/<a href=".portal.course.deliver.'.$kursID.'.selectCourseId=(.*?)">/m';
$str = siteGet($kursURL, $cookie);

preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

$veriler = [];




foreach ($matches as $mm){
    $veriler[] = $mm[1];
}

foreach ($veriler as $id){
    btkAkademiTamamla($id, $cookie, $kursURL);
}
