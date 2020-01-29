<?php
$timestamp = time();
parse_str($_SERVER['QUERY_STRING'], $qParms);

$secretID = $qParms['ID'];
$secretKEY = $qParms['PASSWORD'];
$ini = parse_ini_file("conf.dat", TRUE);
$logEnabled = $ini['app']['log_enable'];

logEvent("INFO: Incoming request from PWS with data : " . json_encode($qParms) . PHP_EOL);

//logEvent('INFO: Parsed INI to: ' . json_encode($ini) . PHP_EOL);

// General station id/auth
if (($secretID !== $ini['station']['station_secretid']) && ($secretKEY !== $ini['station']['station_secretkey'])) {
    $log = "Provided Secrets were incorrect: ID:'$secretID' and KEY:'$secretKEY' - Going to 401 now" . PHP_EOL;
    logEvent('ERROR: ' . $log . PHP_EOL);
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

$q = $qParms;

// Try getting data into Windy

$windyAPIKey = $ini['windy']['windy_apikey'];
$windyURL = $ini['windy']['windy_url'];
$windyStationID = $ini['windy']['windy_stationID'];

$windyData = [
    'ts' => $timestamp,
    'station' => $windyStationID,
    'temp' => round(floatval(($q['tempf'] - 32) * 0.5556), 1),   // F to C
    'wind' => round(floatval($q['windspeedmph'] / 2.237), 1),   // mph/2,237 = m/s
    'winddir' => intval($q['winddir']),
    'gust' => round(floatval($q['windgustmph'] / 2.237), 1),    // mph/2.237 = m/s
    'rh' => round(intval($q['humidity'])),
    'dewpoint' => round(floatval(($q['dewptf'] -32) * 0.5556), 1),
    'mbar' => round(intval($q['absbaromin'] * 33.86389)), // convert inhg to millibar
    'precip' => round(floatval($q['rainin'] * 25,4), 1),
    'uv' => round(intval($q['UV']))
];

curlConditionsToWindy($windyAPIKey, $windyURL, $windyData);

function curlConditionsToWindy($windyAPIKey, $windyURL, $data) {

    $fullURL = $windyURL . $windyAPIKey;
    $postdata = json_encode($data);

    logEvent("Info before curling to windy: AppID: $windyAPIKey, fullurl: $fullURL, data: " . $postdata . PHP_EOL . PHP_EOL);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => "$fullURL",
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $postdata,
        CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json'),                                                                                
            'Content-Length: ' . strlen($postdata)
        ));

    $response = curl_exec($curl);
    logEvent("INFO: cURL Result (windy) :: " . json_encode($response) . PHP_EOL . PHP_EOL);
    curl_close($curl);
    if (json_encode($response) == "SUCCESS") {
        header("HTTP/1.1 202 Accepted");
        exit;
    }
}

function logEvent($log) {
    global $logEnabled;
    $file = strval($ini['app']['logfile']);
    file_put_contents($file, $log, FILE_APPEND);
}
