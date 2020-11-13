<?php 
date_default_timezone_set('Asia/Kolkata'); 
include('token.php');
$Results=[];
function getData($url){
global $token;
$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization:Bearer '.$token));
		   curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
		curl_setopt($ch, CURLOPT_ENCODING, ''); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            $ret = curl_exec($ch);
			curl_close($ch);
			return json_decode($ret,true);
			}
$AllData=getData('https://api.sandbox.paypal.com/v1/customer/disputes?page_size=50&start_time='.$_GET['start_date'].'T'.date('H:i:s').'.000Z');
if(!empty($AllData['items'])){
			$Results=$AllData['items'];	
			if(!empty($AllData['links'][2])){
			$AllData2=getData($AllData['links'][2]['href']);
			if(!empty($AllData2['items'])){
			$Results=array_merge($Results,$AllData2['items']);
			} 
			}
}
if(!empty($Results)){
		$arr = array('dataDispute' => $Results, 'status' => 1);
} else {
$arr = array( 'status' => 0,'dataDispute' => '');	
}
header('Content-Type: application/json');
echo json_encode($arr);die;

?>