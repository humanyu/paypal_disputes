<?php 
date_default_timezone_set('Asia/Kolkata');//country india time zone
include('token.php');//check file exist
$Results=[];
function getData($url){
global $token;////global initialize to token
$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization:Bearer '.$token));
		      curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
		curl_setopt($ch, CURLOPT_ENCODING, ''); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_URL, $url);
            $ret = curl_exec($ch);
			curl_close($ch);
			return json_decode($ret,true);
			}
$AllData=getData('https://api.sandbox.paypal.com/v1/customer/disputes?page_size=50&start_time='.$_GET['start_date'].'T'.date('H:i:s').'.000Z');//call a dispute list api
if(!empty($AllData['items'])){
			$Results=$AllData['items'];	
			if(!empty($AllData['links'][2])){//if we got next data
			//Note- Here we can call iterate using while loop. If dispute list are more than 100
			$AllData2=getData($AllData['links'][2]['href']);//
			if(!empty($AllData2['items'])){
			$Results=array_merge($Results,$AllData2['items']);//merge dispute list data
			} 
			}
}
if(!empty($Results)){
		$arr = array('dataDispute' => $Results, 'status' => 1);//return dispute list data
} else {
$arr = array( 'status' => 0,'dataDispute' => '');	
}
header('Content-Type: application/json');
echo json_encode($arr);die;

?>