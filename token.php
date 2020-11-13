<?php 

$myFile="token.json";
//$myFile=$_SERVER["DOCUMENT_ROOT"]."/humanyu/paypal/token.json";
if (file_exists($myFile)) {
  $strJsonFileContents = file_get_contents($myFile);
  $js = json_decode($strJsonFileContents,true);

  if(($js['start_time']+$js['expires_in'])-1000 < time()){
$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: x-www-form-urlencoded','Authorization:Basic '.base64_encode('AQx8PD6thVrXMIyWNNwobejuBfaGRZJ8qco---nBYF1Q1iQcp5t-CUKUil2o4BRqSD8fv8297IeQivU1:EG_lC_06lOwlZYseiol-1yWxgRl0C4vu--COLDP2Cby7BsZDplhXVr8P7Z4hN1Ssq5TjsudpljB9xKZD')));
		    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $ret = curl_exec($ch);
			//curl_close($ch);
			//print_r(json_decode($ret,true));die;
			$js=json_decode($ret,true);
			
			$js['start_time']=time();
		 $retVal = json_encode($js,true);
			$fh = fopen($myFile, 'w') or die('no create file');
	fwrite($fh, $retVal);
fclose($fh); 
			
  }
} else {
$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: x-www-form-urlencoded','Authorization:Basic '.base64_encode('AQx8PD6thVrXMIyWNNwobejuBfaGRZJ8qco---nBYF1Q1iQcp5t-CUKUil2o4BRqSD8fv8297IeQivU1:EG_lC_06lOwlZYseiol-1yWxgRl0C4vu--COLDP2Cby7BsZDplhXVr8P7Z4hN1Ssq5TjsudpljB9xKZD')));
		    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $ret = curl_exec($ch);
			//curl_close($ch);
			$js = json_decode($ret,true);
         $js['start_time']=time();
		 $retVal = json_encode($js,true);
			$fh = fopen($myFile, 'w') or die('no create file');
	fwrite($fh, $retVal);
fclose($fh);	
	
}
$token= $js['access_token'];
?>