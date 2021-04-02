<?php

// BY BLACKWIDO - CopyRight To https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c For WebHooks cuRL
$ping1 = "X.X.X.X"; // CHANGE BY DNS / IP
$ping2 = "X.X.X.X"; // CHANGE BY DNS / IP
$ping3 = "X.X.X.X"; // CHANGE BY DNS / IP


function ping($host, $port, $timeout) {
    $tB = microtime(true);
    $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
    if (!$fP) { return "down"; }
    $tA = microtime(true);
    return round((($tA - $tB) * 1000), 0)." ms";
}
$status1 = ping($ping1, 80, 10); // IP, PORT, TIMEOUT
$status2 = ping($ping2, 80, 10); // IP, PORT, TIMEOUT
$status3 = ping($ping3, 80, 10);    // IP, PORT, TIMEOUT


if ($status1 != 0 ) {
    $check1 = "🟢"; }
else {

    $check1 = "🔴";
    $status1 = "--";

}
if ($status2 != 0 ) {
    $check2 = "🟢"; }
else {

    $check2 = "🔴";
    $status2 = "--";

}
if ($status3 != 0 ) {
    $check3 = "🟢"; }
else {

    $check3 = "🔴";
    $status3 = "--";

}
if( ($check1 == "🔴") || ($check2 == "🔴") || ($check3 == "🔴")){
    $info = "Un des serveurs ne répond pas"; // IF SOMETHING IS NOT GOOD

}
else{
    $info = "Tout les services sont UP !"; // IF EVERYTHING IS OK

}

$webhookurl = "WEBHOOKURL"; // YOUR WEBHOOK URL
$time = date('H:i');
$timestamp = date("c", strtotime("now"));
// CHANGE "description": " '.$check1.' Node Jeu ['.$status1.']\n\n'.$check2.' Node Teamspeak ['.$status2.']\n\n'.$check3.' Node Web ['.$status3.']", WITH YOUR CUSTOM NODE
$json_data =
    '{
  "content": null,
  "embeds": [
    {
      "title": "Status",
      "description": " '.$check1.' Node Jeu ['.$status1.']\n\n'.$check2.' Node Teamspeak ['.$status2.']\n\n'.$check3.' Node Web ['.$status3.']",
      "color": 5814783,
      "fields": [
        {
          "name": "Info :",
          "value": "'.$info.'"
        }
      ],
      "footer": {
        "text": "By @BlackWido |Tchoin <3#2167"
            },
      "timestamp": "'.$timestamp.'"
    }
  ]
}';


$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
//echo $response;
curl_close($ch);