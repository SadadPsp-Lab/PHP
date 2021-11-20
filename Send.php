<?php
//Prepare data
session_start();
include_once("function.php");

$key = "YourKey";
$MerchantId = "YourMerchantId";
$TerminalId = "YourTerminalId";
$Amount = 0; //YourAmount (Rials)
$OrderId = "YourOrderId";
$LocalDateTime = date("m/d/Y g:i:s a");
$ReturnUrl = "http://YourSite.Com/verify.php";
$SignData = encrypt_pkcs7("$TerminalId;$OrderId;$Amount", "$key");

$data = array(
    'TerminalId' => $TerminalId,
    'MerchantId' => $MerchantId,
    'Amount' => $Amount,
    'SignData' => $SignData,
    'ReturnUrl' => $ReturnUrl,
    'LocalDateTime' => $LocalDateTime,
    'OrderId' => $OrderId
);

$result = CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest', $data);

if ($result->ResCode == 0) {
    $Token = $result->Token;
    $url = "https://sadad.shaparak.ir/VPG/Purchase?Token=$Token";
    header("Location:$url");
}
else {
    var_dump($result->Description);
}

?>