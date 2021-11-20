<?php

include_once("function.php");

$key = "YourKey";
$OrderId = $_POST["OrderId"];
$Token = $_POST["token"];
$ResCode = $_POST["ResCode"];

if ($ResCode == 0) {
    $verifyData = array(
        'Token' => $Token,
        'SignData' => encrypt_pkcs7($Token, $key)
    );

    $result = CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $verifyData);
}
if ($result->ResCode != -1 && $result->ResCode == 0) {
    /*
     * Save this Data To DataBase
     * --------------------------
     * $result->RetrivalRefNo
     * $result->SystemTraceNo
     * $result->OrderId
     */
    echo "شماره سفارش:" . $OrderId . "<br>" . "شماره پیگیری : " . $result->SystemTraceNo . "<br>" . "شماره مرجع:" .
        $result->RetrivalRefNo . "<br> اطلاعات بالا را جهت پیگیری های بعدی یادداشت نمایید." . "<br>";
}
else
    echo "تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.";

?>