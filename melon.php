<?php

function nama() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $ex = curl_exec($ch);
    preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
    $fullName = $name[2][mt_rand(0, 14)];
    $nameParts = explode(' ', $fullName);
    
    if (count($nameParts) > 2) {
        $firstName = $nameParts[0];
        $lastName = $nameParts[1];
    } else {
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
    }
    
    return [$firstName, $lastName];
}
$cookieFile = "cookie.txt";

$requests = [
    [
        "url" => "https://coco-melon.madusirup.store/",
        "method" => "GET",
        "headers" => [
            'sec-ch-ua: "Android WebView";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
            "sec-ch-ua-mobile: ?1",
            'sec-ch-ua-platform: "Android"',
            "upgrade-insecure-requests: 1",
            "user-agent: Mozilla/5.0 (Linux; Android 13; M2101K6G Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.7049.4 Mobile Safari/537.36",
            "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
            "sec-fetch-site: none",
            "sec-fetch-mode: navigate",
            "sec-fetch-user: ?1",
            "sec-fetch-dest: document",
            "accept-language: en-US,en;q=0.9",
            "priority: u=0, i"
        ]
    ],
    [
        "url" => "https://www.clarity.ms/tag/qgdpiuncvq",
        "method" => "GET",
        "headers" => [
            "Host: www.clarity.ms",
            'sec-ch-ua-platform: "Android"',
            "user-agent: Mozilla/5.0 (Linux; Android 13; M2101K6G Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.7049.4 Mobile Safari/537.36",
            'sec-ch-ua: "Android WebView";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
            "sec-ch-ua-mobile: ?1",
            "accept: */*",
            "sec-fetch-site: cross-site",
            "sec-fetch-mode: no-cors",
            "sec-fetch-dest: script",
            "sec-fetch-storage-access: active",
            "referer: https://squashorange.madusirup.store/",
            "accept-language: en-US,en;q=0.9"
        ]
    ],
    [
        "url" => "https://c.bing.com/c.gif?ctsa=mr&CtsSyncId=38CF20CAC7824DA5B3EFA2A50FCAAF9B&RedC=c.clarity.ms&MXFR=326B5D1B8CD4668B26BA48B088D46896",
        "method" => "GET",
        "headers" => [
            "Host: c.bing.com",
            'sec-ch-ua-platform: "Android"',
            "user-agent: Mozilla/5.0 (Linux; Android 13; M2101K6G Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.7049.4 Mobile Safari/537.36",
            'sec-ch-ua: "Android WebView";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
            "sec-ch-ua-mobile: ?1",
            "accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8",
            "sec-fetch-site: cross-site",
            "sec-fetch-mode: no-cors",
            "sec-fetch-dest: image",
            "sec-fetch-storage-access: active",
            "referer: https://squashorange.madusirup.store/",
            "accept-language: en-US,en;q=0.9",
            "priority: i"
        ]
    ],
    [
        "url" => "https://c.clarity.ms/c.gif",
        "method" => "GET",
        "headers" => [
            "Host: c.clarity.ms",
            'sec-ch-ua-platform: "Android"',
            "user-agent: Mozilla/5.0 (Linux; Android 13; M2101K6G Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.7049.4 Mobile Safari/537.36",
            'sec-ch-ua: "Android WebView";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
            "sec-ch-ua-mobile: ?1",
            "accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8",
            "sec-fetch-site: cross-site",
            "sec-fetch-mode: no-cors",
            "sec-fetch-dest: image",
            "sec-fetch-storage-access: active",
            "referer: https://squashorange.madusirup.store/",
            "accept-language: en-US,en;q=0.9",
            "priority: i"
        ]
    ]
];

function sendCurlRequest($url, $method, $headers, $cookieFile, $data = null) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_COOKIEJAR => $cookieFile,
        CURLOPT_COOKIEFILE => $cookieFile,
        CURLOPT_CUSTOMREQUEST => $method
    ]);

    if ($method === "POST" && $data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
//foreach ($dotEmails as $email) {
//    echo $email . PHP_EOL;
foreach ($requests as $req) {
    $response = sendCurlRequest($req['url'], $req['method'], $req['headers'], $cookieFile, $req['data'] ?? null);
    echo "Response from: " . $req['url'] . "\n" . $response . "\n\n";
}

//list($firstName, $lastName) = nama();
$firstName = "suhandri";
$lastName = "doyok";
$nama = $firstName." ".$lastName;
echo "$nama\n";
$serviceUrl = "https://coco-melon.madusirup.store/services/";
$serviceHeaders = [
    "Host: coco-melon.madusirup.store",
    "sec-ch-ua-platform: \"Android\"",
    "x-requested-with: XMLHttpRequest",
    "user-agent: Mozilla/5.0 (Linux; Android 13; M2101K6G Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.7049.4 Mobile Safari/537.36",
    "accept: */*",
    'sec-ch-ua: "Android WebView";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
    "sec-ch-ua-mobile: ?1",
    "origin: https://coco-melon.madusirup.store",
    "sec-fetch-site: same-origin",
    "sec-fetch-mode: cors",
    "sec-fetch-dest: empty",
    "referer: https://coco-melon.madusirup.store/",
    "accept-language: en-US,en;q=0.9",
//    "cookie: _clck=k5gyn6%7C2%7Cfu3%7C0%7C1895; _clsk=1xbfcy2%7C1741637962898%7C1%7C1%7Cb.clarity.ms%2Fcollect; PHPSESSID=23f036859001e7dcb7a15f1d254ff7ce",
    "priority: u=1, i"
];

$serviceData = "name=$firstName+$lastName&email=".urlencode($firstName.$lastName.rand(111,999)."@gmail.com")."&phone_no=0838".rand(10000000,99999999);
 echo $serviceData;
$response = sendCurlRequests($serviceUrl, "POST", $serviceHeaders, $cookieFile, $serviceData);
$responseJson = json_decode($response, true);

if ($responseJson["Status"] === true && isset($responseJson["Data"])) {
    $imageUrl = $responseJson["Data"];

$cookieFile = "cookie.txt";
$imageFile = 'melon_'.$firstName.$lastName.rand(1111,9999).".png";
$headers = [
    'sec-ch-ua-platform: Android',
    "user-agent: Mozilla/5.0 (Linux; Android 13; M2101K6G Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.7049.4 Mobile Safari/537.36",
    'sec-ch-ua: Android WebView;v=135, Not-A.Brand;v=8, Chromium;v=135',
    "sec-ch-ua-mobile: ?1",
    "accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8",
    "sec-fetch-site: same-origin",
    "sec-fetch-mode: no-cors",
    "sec-fetch-dest: image",
    "referer: https://squashorange.madusirup.store/",
    "accept-language: en-US,en;q=0.9"
];

//
$headerString = "";
foreach ($headers as $header) {
    $headerString .= "--header=\"$header\" ";
}

// 
$wgetCommand = "wget --load-cookies=$cookieFile $headerString -O $imageFile $imageUrl";

// 
shell_exec($wgetCommand);

echo "Gambar disimpan sebagai: $imageFile\n";
readline("ganti ip lalu enter");
system('rm -rf cookie.txt');
system('php manual.php');
} else {
    echo "Gagal mendapatkan URL gambar.\n";
}
//}
function sendCurlRequests($url, $method, $headers, $cookieFile, $data = null) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_COOKIEJAR => $cookieFile,
        CURLOPT_COOKIEFILE => $cookieFile,
        CURLOPT_CUSTOMREQUEST => $method
    ]);

    if ($method === "POST" && $data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $response = curl_exec($ch);
    curl_close($ch);
    echo $response."\n";
    return $response;
}