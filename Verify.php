<?php
include_once("function.php");
$key="YourKey";
$OrderId=$_POST["OrderId"];
$Token=$_POST["token"];
$ResCode=$_POST["ResCode"];
if($ResCode==0)
{
	$verifyData = array('Token'=>$Token,'SignData'=>encrypt_pkcs7($Token,$key));
	$str_data = json_encode($verifyData);				
	$res=CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify',$str_data);
	$arrres=json_decode($res);
}
if($arrres->ResCode!=-1 && $arrres->ResCode==0)
{
	//Save $arrres->RetrivalRefNo,$arrres->SystemTraceNo,$arrres->OrderId to DataBase
	echo "شماره سفارش:".$OrderId."<br>"."شماره پیگیری : ".$arrres->SystemTraceNo."<br>"."شماره مرجع:".
	$arrres->RetrivalRefNo."<br> اطلاعات بالا را جهت پیگیری های بعدی یادداشت نمایید."."<br>";
}
else
	echo "تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.";	
?>
